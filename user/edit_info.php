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
					<a class="navbar-brand" href="../index.php">Reports</a>
				</div>
				<!-- Top Menu Items -->
				<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Graphs <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo" class="collapse">
								<li>
									<a href="#">Table</a>
								</li>
								<li>
									<a href="#">Pie Graph</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;" data-toggle="collapse" data-target="#main"><i class="fa fa-fw fa-arrows-v"></i> Maintenance <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="main" class="collapse">
								<li>
									<a href="index.php"> Add Information</a>
								</li>
								<li>
									<a href="#">View Information </a>
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
						$sql = "Select * from db_innolab.tblreport where ReportID='$id'";
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

							$sql = "select ReportID from db_innolab.tblreport where ReportID= '$repID'";
							$query = mysqli_query($conn, $sql);
							if(mysqli_num_rows($query) > 0)
							{
								header('Location: view_info.php');
								$sql = "update db_innolab.tblreport
								set  ReportDate = '$repDate' ReportLoc = '$repLoc' ReportGroup = '$repGroup' 		ReportCateg = '$repCat' ReportCName = '$repClient' ReportPerson = '$repPic' ReportAct = '$repAct'
								where ReportID = '$repID'
								";
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
								$sql = "SELECT * FROM db_innolab.tbllocation";
								$query = mysqli_query($conn, $sql);

								while($row = mysqli_fetch_array($query)){
									$loc_id = $row['Location_ID'];
									$loc_name = $row['Location_Name'];
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
								$sql = "SELECT * FROM db_innolab.tblgroup";
								$query = mysqli_query($conn, $sql);

								while($row = mysqli_fetch_array($query)){
									$grp_id = $row['Group_ID'];
									$grp_name = $row['Group_Vis'];
									echo "<option value=\"$grp_id\">$grp_name</option>";
								}
								?>
							</select>
						</div>

						<!--Category-->
						<label>Visitor Category</label><br />
						<div class="form-group" style="display:flex">

							<select name="optCatRep" class="form-control" value="<?php echo $info['ReportCateg']?>">
								<?php
								$sql = "SELECT * FROM db_innolab.tblcategory";
								$query = mysqli_query($conn, $sql);

								while($row = mysqli_fetch_array($query)){
									$cat_id = $row['Categ_ID'];
									$cat_name = $row['Categ_Name'];
									echo "<option value=\"$cat_id\">$cat_name</option>";
								}
								?>
							</select>
						</div>
					</div>

					<div class="col-md-6"><br>
						<!--Client-->
						<div class="form-group">
							<label>Event Name/Client Name</label>
							<input name="txtClientRep" class="form-control" type="text" value="<?php echo $info['ReportCName']?>"/>
						</div>
						<!--PIC-->
						<div class="form-group">
							<label>Person In Charge</label>
							<input name="txtPicRep" class="form-control" type="text" value="<?php echo $info['ReportPerson']?>">
						</div>
						<!--Activity-->
						<label>Activity</label><br />
						<div class="form-group" style="display:flex">
							<select name="optActRep" class="form-control" value="<?php echo $info['ReportAct']?>">
								<?php
								$sql = "SELECT * FROM db_innolab.tblactivity";
								$query = mysqli_query($conn, $sql);

								while($row = mysqli_fetch_array($query)){
									$act_id = $row['Activity_ID'];
									$act_name = $row['Activity_Name'];
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
								<th>Visit Category</th>
								<th>Client Name/Event</th>
								<th>Person In Charge</th>
								<th>Activity</th>
							</tr>
						</thead>
						<tbody>
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