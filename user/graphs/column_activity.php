<?php
require_once('../../database/config.php');
include('gen.php');
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
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
              <a style="color:#ff8080!important" href="../index.php"> <i class="fa fa-info-circle" aria-hidden="true"></i> Add Information</a>
            </li>
            <li>
              <a href="../view_info.php"> <i class="fa fa-file-text" aria-hidden="true"></i> View Information </a>
            </li>

            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#tables"><i class="fa fa-list-alt" aria-hidden="true"></i> Reports<i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="tables" class="collapse">
                <li>
                  <a href="../tables/visit_reports.php">Innolab Yearly Report</a>
                </li>
                <li>
                  <a href="../tables/visit_summary.php">Innolab Visit Summary</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-line-chart" aria-hidden="true"></i> Charts <i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="demo" class="collapse">
                <li>
                  <a href="=pie_alphasme.php">Alpha VS SME</a>
                </li>
                <li>
                  <a href="pie_companies.php">All Visitor Group (Pie Chart)</a>
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
          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">PLDT Innolab<small>&nbsp;Summary of Activities</small></h1>
              <ol class="breadcrumb">
                <li><i class="fa fa-users"></i> <a href="column_activity.php">PLDT Innolab Activities</a></li>
                <li class="active"><i class="fa fa-suitcase"></i> <a href="column_category.php">Revenue vs Non Revenue Visits</a></li>
                <li><i class="fa fa-wrench"></i> <a href="column_group.php">PLDT Innolab Visitors</a></li>
              </ol>
              <!-- /Page Heading -->

              <!--Page Content-->
              <div class="row" style="margin-bottom: 40px">
                <div class="col-md-4">
                  <select id="yearActivity" name="yearActivity" class="form-control" style="width: 80%!important">
                    <?php
                    $yearSql = "SELECT DISTINCT YEAR(ReportDate) AS YEARS FROM ict_database.tblreports";
                    $yearQuery = mysqli_query($conn, $yearSql);
                    while($row = mysqli_fetch_array($yearQuery)){
                      ?>
                      <option value="<?php echo $row['YEARS'] ?>" name="txtYear"><?php echo $row['YEARS'] ?></option>
                      <?php
                    }?>
                  </select>
                </div>

                <div class="col-md-4">
                  <select name="branchActivity" id="branchActivity" class="form-control" style="width: 80%!important">
                    <?php
                    $sql = "SELECT * FROM ict_database.tbllocation WHERE LocationIsActive = 1";
                    $query = mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($query))
                    {
                      $loc_id = $row['LocationID'];
                      $loc_name = $row['LocationName'];
                      echo "<option value=\"$loc_id\">$loc_name</option>";
                    ?>
                      <?php
                    }?>
                  </select>
                </div>

                <div class="col-md-4">
                  <input class="btn btn-primary" type="button" id="btnColAct" value="Generate Column Chart"/>
                  <input onclick="gen.php" class="btn btn-primary" type="submit" id="btnGenEx" name="btnGenEx" value="Generate Excel File"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div id="columnActivity" style="width: 100%; height: 500px;"></div>
                  <div id="png"></div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function drawBarGraph(arr){
      var data = google.visualization.arrayToDataTable( arr );
      console.log(arr);
      console.log(data);
      var options = {
                        title: 'Viewing Column Chart',
                        scaleType: 'log',
                        format: 'none'
                    };
      var chart = new google.visualization.ColumnChart( document.getElementById( 'columnActivity' ) );
      chart.draw( data, options );
      chart.addEventListener("change",
        document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Printable version</a>';
    );
    }
    function initializeGraph(){
      $(document).ready(function(){
        $( "#btnColAct" ).on( "click", function()
                                        {
                                          var rYear = $( "#yearActivity").val();
                  												var bName = $( "#branchActivity").val();
                                            $.ajax({
                                              url:      'ajax_ColumnActivity.php',
                                              type:     'POST',
                                              dataType: 'JSON',
                                              data:     {
                                                          yearActivity: rYear,
                                                          branchActivity: bName,
                                                        },
                                              success:  function( data )
                                                        {
                                                          var arr = [ "Activity", "Count" ];
                                                          data.push( arr );
                                                          data.reverse();
                                                          drawBarGraph( data );
                                                        }
                                            })
                                            .done(function( data ) {
                                              console.log("success");
                                              // console.log( data );
                                            })
                                            .fail(function( data ) {
                                              console.log("error");
                                              // console.log( data );
                                              $("#columnActivity").html("");
                                            })
                                            .always(function( data ) {

                                              console.log("complete");
                                              // console.log( data );
                                            });
                                        }
                            );
      });
    }
    google.setOnLoadCallback(initializeGraph);
    google.charts.load("current", {packages:["corechart"]});
    </script>
  </form>
</body>
</html>
