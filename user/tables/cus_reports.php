<?php
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
?>
<!DOCTYPE HTML>
<html lang ="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Reports</title>
	<!-- Data table -->
	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Core CSS -->
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="icon" href="../../images/innolablogo.png">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php">PLDT Innolab Report Generator</a>
			</div>
			<!-- Top Menu Items -->
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Graphs <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="pie_chart.php">Pie Graph</a>
							</li>
							<li>
								<a href="bar_graph.php">Bar Graph</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#main"><i class="fa fa-fw fa-arrows-v"></i>Maintenance<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="main" class="collapse">
							<li>
								<a href="../index.php"> Add Information</a>
							</li>
							<li>
								<a href="../view_info.php">View Information </a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#tables"><i class="fa fa-fw fa-arrows-v"></i>Data Tables<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="tables" class="collapse">
							<li>
								<a href="#">Innolab Yearly Report</a>
							</li>
							<li>
								<a href="visit_summary.php">Innolab Visit Summary</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
		<form method="post">
			<div id="page-wrapper">
				<div class="container-fluid"><br>
					<h1>PLDT Innolab Custom Report</h1>
					<ol class="breadcrumb">
						<li><a href="../index.php"><i class="fa fa-dashboard"></i>Add Information</a></li>
						<li class="active"><i class="fa fa-table"></i> Tables</li>
					</ol>

					<div class="row" style="margin-bottom: 40px">
						<div class="col-md-5">
							<label>From:</label>
							<input name="txtDateFrom" id="txtDateFrom" class="form-control" type="date">
						</div>
						<div class="col-md-5">
							<label>To:</label>
							<input name="txtDateTo" id="txtDateTo" class="form-control" type="date">
						</div>
						<div class="col-md-2">
							<input class="btn btn-lg btn-primary" type="submit" name="btnGenReport" value="Generate Table"/>
						</div>
					</div>

					<!--GENERATE EXCEL FILE-->
					<a href="custom_config.php" name="genExcel" onclick="">Generate Excel File(.xlsx)</a>
					<!--/GENERATE EXCEL FILE-->

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="tabreport" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Reservation Date</th>
											<th>Location</th>
											<th>Visitor Group</th>
											<th>Visitor Category</th>
											<th>Category</th>
											<th>Client Name/Event</th>
											<th>Person In Charge</th>
											<th>Activity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($_POST['btnGenReport'])){
											$dateFrom = mysqli_real_escape_string($conn, $_POST['txtDateFrom']);
											$dateTo = mysqli_real_escape_string($conn, $_POST['txtDateTo']);
											$sql = "SELECT * FROM ict_database.tblreports r
											left join ict_database.tbllocation l
											ON r.ReportLoc =   l.LocationID
											left join ict_database.tblgroup g
											ON r.ReportGroup = g.GroupID
											left join ict_database.tblvisitors v
											ON r.ReportVisitor = v.VisitorID
											left join ict_database.tblcategory c
											ON r.ReportCategory = c.CategoryID
											left join ict_database.tblactivity a
											ON r.ReportActivity = a.ActivityID
											WHERE ReportIsActive = 1  AND ReportDate BETWEEN '$dateFrom' and '$dateTo'";
											$query = mysqli_query($conn, $sql);
											while($row = mysqli_fetch_array($query)){
												?>
												<tr>
													<td><?php echo date('F d, Y',strtotime($row['ReportDate']))?></td>
													<td><?php echo $row['LocationName']?></td>
													<td><?php echo $row['GroupName']?></td>
													<td><?php echo $row['VisitorName']?></td>
													<td><?php echo $row['CategoryName']?></td>
													<td><?php echo $row['ReportClient']?></td>
													<td><?php echo $row['ReportPerson']?></td>
													<td><?php echo $row['ActivityName']?></td>
												</tr>
												<?php
											} //while
										}//genReport
										?>
									</tbody>
								</table>
							</div><!--#table-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="../../js/bootstrap.min.js"></script>
	<!--Custom Scripts-->
	<script>
	$(document).ready(function() {
		$('#tabreport').DataTable();
	} );
	</script>
</div>
</body>
</html>
