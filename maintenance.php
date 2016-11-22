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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                                <a href="maintenance.html"> Add Information</a>
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
                                <i class="fa fa-file"></i> Please fill out the form
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <form role="form">

                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date">
                            </div>

							<label>Location</label>
                            <div class="form-group" style="display:flex">
                                <select name="cmbLocation" class="form-control" style="width:80%!important;">
								
                                    <?php 
										require 'dbConnection.php';
										
										$sql = "Select * from db_innolab.tbllocation";
										$query = mysqli_query($conn,$sql);
										
										while($row=mysqli_fetch_array($query))
										{
											$loc_id = $row['Location_ID'];
											$loc_name = $row['Location_Name'];
											
											echo "<option value=\"$loc_id\">$loc_name</option>";
										}
										
									?>
                                </select>&nbsp; &nbsp;
								<a href="location.php" class="btn btn-primary" style="width:18%!important;">ADD</a>
                            </div>
						
							 <label>Visitor Group</label>
                             <div class="form-group" style="display:flex">
                                <select class="form-control" style="width:80%!important;">
                                    <option>Alpha</option>
                                    <option>SME</option>
                                    <option>PGC</option>
                                    <option>Home</option>
                                    <option>PLDT</option>
                                </select>&nbsp; &nbsp;
								<a href="vgroup.php" class="btn btn-primary" style="width:18%!important;">ADD</a>
                            </div>

                            <label>Visitor Category</label>
							<div class="form-group" >
                                <select class="form-control">
                                    <option>Revenue</option>
                                    <option>Non-Revenue</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Client Name or Event</label>
                                <input class="form-control" type="text">
                            </div>

                             <div class="form-group">
                                <label>Person In Charge</label>
                                <input class="form-control" type="text">
                            </div>

                            <label>Activity</label>
							<div class="form-group" style="display:flex">   
                                <select class="form-control" style="width:80%!important;">
                                    <option>Techno Update</option>
                                    <option>Tour</option>
                                    <option>Meeting</option>
                                    <option>Training</option>
                                    <option>Testing</option>
                                </select>&nbsp; &nbsp;
								<a href="activity.php" class="btn btn-primary" style="width:18%!important;">ADD</a>
                            </div>


                       <br>
                       <center>
                           <button class="btn btn-lg btn-primary">ADD INFORMATION</button>
                       </center>    
                       </br>

                </form>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
