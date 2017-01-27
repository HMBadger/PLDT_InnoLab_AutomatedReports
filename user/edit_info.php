<?php
require_once('../database/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Reports</title>
	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../css/sb-admin.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link rel="icon" href="../images/innolablogo.png">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
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
					<a class="navbar-brand" href="../index.php">PLDT Innolab Report Generator</a>
				</div>
				<!-- Top Menu Items -->
				<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						  <li >
                <a style="color:#ff8080!important" href="index.php"> <i class="fa fa-info-circle" aria-hidden="true"></i> Add Information</a>
            </li>
            <li>
                <a href="view_info.php"> <i class="fa fa-file-text" aria-hidden="true"></i> View Information </a>
            </li>

<li>
            <a href="javascript:;" data-toggle="collapse" data-target="#tables"><i class="fa fa-list-alt" aria-hidden="true"></i> Reports<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="tables" class="collapse">
              <li>
                <a href="tables/visit_reports.php">Innolab Yearly Report</a>
              </li>
              <li>
                <a href="tables/visit_summary.php">Innolab Visit Summary</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-line-chart" aria-hidden="true"></i> Charts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
              <li>
                <a href="graphs/pie_alphasme.php">Alpha VS SME</a>
              </li>
			  <li>
                <a href="graphs/pie_companies.php">All Visitor Group (Pie Chart)</a>
              </li>
			  <li>
                <a href="graphs/pie_activities.php">All Activities (Donut Chart)</a>
              </li>
			  <li>
                <a href="graphs/pie_categories.php">Visitor Category (Pie Chart)</a>
              </li>
              <li>
                <a href="graphs/column_activity.php">All Activities (Bar Chart)</a>
              </li>
			  <li>
                <a href="graphs/column_group.php">All Visitor Group (Bar Chart)</a>
              </li>
			   <li>
                <a href="graphs/column_category.php">Visitor Category (Bar Chart)</a>
              </li>
            </ul>
          </li>

					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
			<div id="page-wrapper">
					<?php
					$id = $_GET['id'];
					if(isset($id)){
						$sql = "SELECT * FROM ict_database.tblreports WHERE ReportID='$id' AND ReportIsActive = 1";
						$query = mysqli_query($conn,$sql);
						$info=mysqli_fetch_array($query);
						?>
					<div class="container-fluid">

						<?php
						if(isset($_POST['btnSubmit']))
						{
							$repID = $_POST['txtIdRep'];
							$repDate = $_POST['txtDateRep'];
							$repLoc = $_POST['optLocRep'];
							$repGroup = $_POST['optGroupRep'];
							$repCat = $_POST['optCatRep'];
							$repClient = $_POST['txtClientRep'];
							$repPic = $_POST['txtPicRep'];
							$repAct = $_POST['optActRep'];

							$sql = "SELECT ReportID from ict_database.tblreports where ReportID= '$repID'";
							$query = mysqli_query($conn, $sql);

							if(mysqli_num_rows($query) > 0)
							{
								$sql = "UPDATE ict_database.tblreports
								set  ReportDate = '$repDate', ReportLoc = '$repLoc', ReportGroup = '$repGroup', ReportCategory = '$repCat', ReportClient = '$repClient', ReportPerson = '$repPic', ReportActivity = '$repAct'
								where ReportID = '$repID'";
								header('Location: view_info.php');
								$query = mysqli_query($conn, $sql);
								if($query)
								{
									$strMessage = "Data Successfully Edited!";
								}
								else
								{
									$strMessage = "<label style='color:red;'>Error:</label> Data Not Edited.";
								}
							}
						}
						?>
						<div class="row">
							<div class="col-md-6">
								<!--Hidden ID-->
								<div class="form-group">
									<input name="txtIdRep" class="form-control" type="hidden"
									value="<?php echo $info['ReportID']?>" />
								</div>
								<!--Date-->
								<div class="form-group">
									<label>Date</label>
									<input name="txtDateRep" class="form-control" type="date" value="<?php echo $info['ReportDate']?>" />
								</div>
								<!--Location-->
								<label>Location</label><br />
								<div class="form-group" style="display:flex">
									<select name="optLocRep" class="form-control" value="<?php echo $info['ReportLoc']?>">
										<?php
										$sql = "SELECT * FROM ict_database.tbllocation WHERE LocationIsActive = 1";
										$query = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_array($query)){
											$loc_id = $row['LocationID'];
											$loc_name = $row['LocationName'];
											echo "<option value=\"$loc_id\">$loc_name</option>";
										}
										?>
									</select>
								</div>
								<!--Visitor-->
								<label>Visitor Group</label><br />
								<div class="form-group" style="display:flex">
									<select name="optGroupRep" class="form-control" value="<?php echo $info['ReportGroup']?>">
										<?php
										$sql = "SELECT * FROM ict_database.tblgroup WHERE GroupIsActive = 1";
										$query = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_array($query)){
											$grp_id = $row['GroupID'];
											$grp_name = $row['GroupName'];
											echo "<option value=\"$grp_id\">$grp_name</option>";
										}
										?>
									</select>
								</div>
								<!--Category-->
								<label>Category</label><br />
								<div class="form-group" style="display:flex">
									<select name="optCatRep" class="form-control" value="<?php echo $info['ReportCategory']?>">
										<?php
										$sql = "SELECT * FROM ict_database.tblcategory WHERE CategoryIsActive = 1";
										$query = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_array($query)){
											$cat_id = $row['CategoryID'];
											$cat_name = $row['CategoryName'];
											echo "<option value=\"$cat_id\">$cat_name</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6"><br>
								<!--Client-->
								<div class="form-group">
									<label>Event Name/Visitor Name</label>
									<input name="txtClientRep" class="form-control" type="text" value="<?php echo $info['ReportClient']?>"/>
								</div>
								<!--PIC-->
								<div class="form-group">
									<label>Person In Charge</label>
									<input name="txtPicRep" class="form-control" type="text" value="<?php echo $info['ReportPerson']?>">
								</div>
								<!--Activity-->
								<label>Activity</label><br />
								<div class="form-group" style="display:flex">
									<select name="optActRep" class="form-control" value="<?php echo $info['ReportActivity']?>">
										<?php
										$sql = "SELECT * FROM ict_database.tblactivity WHERE ActivityIsActive = 1";
										$query = mysqli_query($conn, $sql);
										while($row = mysqli_fetch_array($query)){
											$act_id = $row['ActivityID'];
											$act_name = $row['ActivityName'];
											echo "<option value=\"$act_id\">$act_name</option>";
										}
										?>
									</select>
								</div>
							</div>
							<center><input class="btn btn-lg btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="SAVE"></center>
						</div>
						<?php
					}
					else{
						echo "<script>location.href='view_info.php'</script>";
					}
					?>
					<div class="table-responsive">
						<table id="tb" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Actions</th>
									<th>Reservation Date</th>
									<th>Location</th>
									<th>Visitor Group</th>
									<th>Category</th>
									<th>Visitor Name/Event</th>
									<th>Person In Charge</th>
									<th>Activity</th>
								</tr>
							</thead>
							<tbody>
								<?php
								  $sql = "SELECT * FROM ict_database.tblreports r
								  left join ict_database.tbllocation l
								  ON r.ReportLoc =   l.LocationID
								  left join ict_database.tblgroup g
								  ON r.ReportGroup = g.GroupID
								  left join ict_database.tblcategory c
								  ON r.ReportCategory = c.CategoryID
								  left join ict_database.tblactivity a
								  ON r.ReportActivity = a.ActivityID
								  WHERE ReportIsActive = 1";
								  $query = mysqli_query($conn, $sql);
								  while($row = mysqli_fetch_array($query)){
									?>
									<tr>
										<td><a href="edit_info.php?id= <?php echo $row['ReportID']?>" class="btn btn-primary"> Edit</a>
											<a  onclick="return confirm('Delete Data?')" href="delete_report.php?del = <?php echo $row['ReportID']?>" class="btn btn-danger" >Delete</a>
										</td>
										 <td><?php echo $row['ReportDate']?></td>
										  <td><?php echo $row['LocationName']?></td>
										  <td><?php echo $row['GroupName']?></td>
										  <td><?php echo $row['CategoryName']?></td>
										  <td><?php echo $row['ReportClient']?></td>
										  <td><?php echo $row['ReportPerson']?></td>
										  <td><?php echo $row['ActivityName']?></td>
									</tr>
									<?php
								} //while
								?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>


		<!-- jQuery -->
		<script src="../js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<script>
		$(document).ready(function() {
			$('#tb').DataTable();
		} );
		</script>

	</form>
</body>

</html>
