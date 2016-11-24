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
                  <a href="../index.php"> Add Information</a>
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
          <form method="post">


          <div class="container form-group" >
            <div class="row">
              <div class="col-xs-1">
                <label>ID: &nbsp;</label>
              </div>
              <div class="col-xs-11">
                <input name ="txtGrpID" class="form-control disabled" type="text" style="width:20%" disabled>
              </div>
              <br><br>
              <div class="col-xs-1">
                <label>Visitor Group: &nbsp;</label>
              </div>
              <div class="col-xs-11">
                <input name="txtNameGrp" class="form-control disabled" type="text" style="width:20%">
              </div><br><br>
              <div class="col-xs-11 offset col-xs-.5">
                <input class="btn btn-primary" style="width:15%!important;" name="btnSubmit" id="btnSubmit" value="ADD" type="submit">
              </div>
            </div>
          </div>
          </form>
          <?php
          if(isset($_POST['btnSubmit']))
          {
            $grpName = $_POST['txtNameGrp'];
            $insert = "INSERT INTO db_innolab.tblgroup(Group_Vis) values ('$grpName');";
            $exec = mysqli_query($conn, $insert);
            if($exec)
            {
              echo "<br>Group: ".$grpName." has been added!";
            }
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
                $sql = "Select * from db_innolab.tblgroup";
                $query = mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($query)){
                  ?>
                  <tr>
                    <td><a href="group_update.php?id=	<?php echo $row['Group_ID']?>" class="btn btn-primary"> Edit</a>
                      <a href="group_delete.php?del= <?php echo $row['Group_ID']?>" onclick="return confirm('Delete Data?')"  class="btn btn-danger" >Delete</a>
                    </td>
                    <td><?php echo $row['Group_ID']?></td>
                    <td><?php echo $row['Group_Vis']?></td>
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
