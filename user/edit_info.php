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
		<div id="page-wrapper">
			<div class="container-fluid">
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

				<div class="row">
					<div class="col-md-6">
						<!--Date-->
						<div class="form-group">
							<label>Date</label>
							<input name="txtDateRep" class="form-control" type="date" />
						</div>

						<!--Location-->
						<label>Location</label><br />
						<div class="form-group" style="display:flex">

							<select name="opLocRep" class="form-control">
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

							<select name="optGroupRep" class="form-control">
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

							<select name="optCatRep" class="form-control">
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

					<div class="col-md-6">
						<!--Client-->
						<div class="form-group">
							<label>Event Name/Client Name</label>
							<input name="txtClientRep" class="form-control" type="text" />
						</div>
						<!--PIC-->
						<div class="form-group">
							<?php
								$sql = "SELECT ReportCName on db_innolab.tblreport WHERE ReportID = " .$_GET['eds'];
								$query = mysqli_query($conn,$sql);
								$data=mysqli_fetch_array($query);
							?>
							<label>Person In Charge</label>
							<input name="txtPicRep" class="form-control" type="text" value="<?php echo $data['ReportCName']?>">
						</div>
						<!--Activity-->
						<label>Activity</label><br />
						<div class="form-group" style="display:flex">
							<select name="optActRep" class="form-control">
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
