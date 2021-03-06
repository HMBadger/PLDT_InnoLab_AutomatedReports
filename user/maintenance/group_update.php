<?php
require_once('../../database/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Add New Group|PLDT InnoLab</title>
	<!-- Bootstrap Core CSS -->
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../../css/sb-admin.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="../../images/innolablogo.png">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	body{
		overflow-x:hidden;
	}
	</style>
</head>
<body>
	<form method="post">
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
					<a class="navbar-brand" href="../index.php">Report Generator</a>
				</div>
				<!-- Top Menu Items -->
				<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li >
							<a style="color:#ff8080!important" href="../index.php"> <i class="fa fa-info-circle" aria-hidden="true"></i> Add Information</a>
						</li>
						<li>
							<a href="../view_info.php"> <i class="fa fa-file-text" aria-hidden="true"></i> View Information </a>
						</li>

						<li>
							<a href="../tables/visit_reports.php"><i class="fa fa-table" aria-hidden="true"></i> Yearly Report</a>
						</li>

						<li>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-line-chart" aria-hidden="true"></i> Charts <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo" class="collapse">
								<li>
									<a href="../graphs/pie_alphasme.php">Alpha VS SME</a>
								</li>
								<li>
									<a href="../graphs/pie_companies.php">All Visitor Group (Pie Chart)</a>
								</li>
								<li>
									<a href="../graphs/pie_activities.php">All Activities (Donut Chart)</a>
								</li>
								<li>
									<a href="../graphs/pie_categories.php">Visitor Category (Pie Chart)</a>
								</li>
								<li>
									<a href="../graphs/column_activity.php">All Activities (Bar Chart)</a>
								</li>
								<li>
									<a href="../graphs/column_group.php">All Visitor Group (Bar Chart)</a>
								</li>
								<li>
									<a href="../graphs/column_category.php">Visitor Category (Bar Chart)</a>
								</li>
							</ul>
						</li>


					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
			<?php
			if(isset($_POST['btnSubmit']))
			{
				$gID = $_POST['txtGrpID'];
				$grpName = $_POST['txtNameGrp'];
				$sql = "SELECT GroupID from ict_database.tblgroup where GroupID= '$gID'";
				$query = mysqli_query($conn, $sql);
				if(mysqli_num_rows($query) > 0)
				{
					header('Location: vgroup.php');
					$sql = "UPDATE ict_database.tblgroup SET  GroupName = '$grpName' WHERE GroupID = '$gID';";
					$query = mysqli_query($conn, $sql);
					if($query)
					{
						$strMessage = "Location Successfully Edited: $grpName";
					}
					else
					{
						$strMessage = "<label style='color:red;'>Error:</label> Data Not Edited.";
					}
				}

			}
			?>
			<div id="page-wrapper">
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">
								Maintenance
								<small>Report</small>
							</h1>
							<ol class="breadcrumb">
								<li class="active">
									<a href="../index.php"> Back to Maintenance </a>
								</li>
							</ol>
						</div>
					</div>
					<!-- /.row -->
					<?php
					$id = $_GET['id'];
					if(isset($id)){
						$sql = "SELECT * FROM ict_database.tblgroup WHERE GroupID = '$id'";
						$query = mysqli_query($conn,$sql);
						$data=mysqli_fetch_array($query);
						?>
						<div class="container form-group" >
							<div class="row">
								<div class="col-xs-1">
									<label>ID: &nbsp;</label>
								</div>
								<div class="col-xs-11">
									<input name ="txtGrpID" class="form-control" type="text" style="width:20%" value="<?php echo $data['GroupID']?>"  readonly>
								</div>
								<br><br>
								<div class="col-xs-1">
									<label>Visitor Group: &nbsp;</label>
								</div>
								<div class="col-xs-11">
									<input name="txtNameGrp" class="form-control disabled" type="text" style="width:20%" value="<?php echo $data['GroupName']?>">
								</div><br><br>
								<div class="col-xs-11 offset col-xs-.5">
									<input class="btn btn-primary" style="width:15%!important;" name="btnSubmit" id="btnSubmit" value="Save" type="submit">
								</div>
							</div>
						</div>
						<?php
					}
					else{
						echo "<script>location.href='vgroup.php'</script>";
					}
					?>
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Actions</th>
									<th>ID</th>
									<th>Location</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT * FROM ict_database.tblgroup WHERE GroupIsActive = 1";
								$query = mysqli_query($conn,$sql);
								while($row=mysqli_fetch_array($query)){
									?>
									<tr>
										<td><a href="group_update.php?id=	<?php echo $row['GroupID']?>" class="btn btn-primary"> Edit</a>
											<a name="btnDelete" onclick="return confirm('Delete Data?')" href="group_delete.php?del= <?php echo $row['GroupID']?>" class="btn btn-danger" >Delete</a>
										</td>
										<td><?php echo $row['GroupID']?></td>
										<td><?php echo $row['GroupName']?></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
		</div>
		<!-- /#wrapper -->
		<!-- jQuery -->
		<script src="../../js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="../../js/bootstrap.min.js"></script>
	</form>
</body>
</html>
