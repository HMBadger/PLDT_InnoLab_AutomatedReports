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
        <a class="navbar-brand" href="index.html">Reports</a>
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
                <a href="view.html">View Information </a>
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
			  
                <?php
				require '../database/config.php';
                $sql = "SELECT * from db_innolab.tblreport r
                left join db_innolab.tbllocation l
                ON r.ReportLoc =   l.Location_ID
                left join db_innolab.tblgroup g
                ON r.ReportGroup = g.Group_ID
                left join db_innolab.tblcategory c
                ON r.ReportCateg = c.Categ_ID
                left join db_innolab.tblactivity a
                ON r.ReportAct = a.Activity_ID";
                $query = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($query)){
                  ?>
                  <tr>
                    <td><a href="edit_info.php?id= <?php echo $row['ReportID']?>" class="btn btn-primary"> Edit</a>
                      <a  onclick="return confirm('Delete Data?')" href="delete_report.php?del = <?php echo $row['ReportID']?>" class="btn btn-danger" >Delete</a>
                    </td>
                    <td><?php echo $row['ReportDate']?></td>
                    <td><?php echo $row['Location_Name']?></td>
                    <td><?php echo $row['Group_Vis']?></td>
                    <td><?php echo $row['Categ_Name']?></td>
                    <td><?php echo $row['ReportCName']?></td>
                    <td><?php echo $row['ReportPerson']?></td>
                    <td><?php echo $row['Activity_Name']?></td>
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

</body>
</html>
