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
  <!-- Data table -->
  <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
          <a class="navbar-brand" href="index.html">Report Generator</a>
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
              <a href="tables/visit_reports.php"><i class="fa fa-table" aria-hidden="true"></i> Yearly Report</a>
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
        <div class="container-fluid"><br>
          <div class="table-responsive">
            <form method="post">
              <table id="tabreport" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Select Actions</th>
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
                  WHERE ReportIsActive = 1
                  AND LocationIsActive = 1 AND GroupIsActive = 1 AND CategoryIsActive = 1
                  AND ActivityIsActive = 1";
                  $query = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                      <td><a href="edit_info.php?id= <?php echo $row['ReportID']?>" class="btn btn-primary"> Edit</a>
					  <a  onclick="return confirm('Delete Data?')" href="delete_report.php?del= <?php echo $row['ReportID']?>" class="btn btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>

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
            </form>
          </div><!--#table-->
        </div>
      </div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#tabreport').DataTable();
    } );
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
  </form>
</body>
</html>
