<?php
require_once('../../database/config.php');
?>
<!--/PHP Configuration File-->
<!DOCTYPE html>
<!--PHP Configuration File-->
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
  <!--Company Logo-->
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
              <a href="javascript:;" data-toggle="collapse" data-target="#main"><i class="fa fa-fw fa-arrows-v"></i> Maintenance <i class="fa fa-fw fa-caret-down"></i></a>
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
                  <a href="../tables/visit_reports.php">Innolab Yearly Report</a>
                </li>
                <li>
                  <a href="../tables/visit_summary.php">Innolab Visit Summary</a>
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
              <h1 class="page-header">
                Pie Graph
                <small>Activity Chart</small>
              </h1>

              <div class="row" style="margin-bottom: 40px">
			  
                <div class="col-md-5">
                  <label>From:</label>
                  <input name="txtDateFrom" id="txtDateFrom" class="form-control" type="date">
                </div>
				
                <div class="col-md-5">
                  <label>To:</label>
                  <input name="txtDateTo" id="txtDateTo" class="form-control" type="date">
                </div>
				
				 <div class="col-md-2" style="margin-top:2%">
                  
                  <input type="button" class="btn btn-primary"  
                          id="btnGenPie" 
                          value="Generate Pie Chart"
                          />

                </div>
				
              </div>

            
            </div>
          </div>
          <div id="piechart_3d" style="width: 1000px; height: 500px;"></div>
        </div>
      </div>
    </div>

		  
	
	
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Google Chart-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">

    // $( document ).ready(
    //                     function() 
    //                     {
    //                         drawChart();
    //                     }
    //               );

    function drawChart( arr ) {

      // var arr = [
      //             [ 'Company', 'Percentage' ],
      //             [ 'PLDT GlobalNation', 12 ],
      //             [ 'Globe', 22 ],
      //             [ 'Others', null ],
      //           ];

      var data = google.visualization.arrayToDataTable( arr );

      console.log( arr );
      console.log( data );

      var options = {
                        title: 'Companies Chart',
                        is3D: true,
                    };

      var chart = new google.visualization.PieChart( document.getElementById( 'piechart_3d' ) );
      chart.draw( data, options );
    }

    /**CLICK EVENT TO DRAW CHART ON BUTTON CLICK**/
    function initializeGraph(){
      $(document).ready(function(){
        $( "#btnGenPie" ).on( "click", function()
                                        {
                                            // 
                                        
                                            // 
                                            // drawChart();
                                            $.ajax({
                                              url:      'ajax_PieCompanies.php',
											  type:     'POST',
                                              dataType: 'JSON',
                                              
                                                 success:  function( data )
                                                        {
                                                            var arr = [ "Company", "Percentage" ];

                                                            data.sort(function(a, b){
                                                              return a[1]-b[1];
                                                            });
                                                            
                                                            data.push( arr );
                                                            data.reverse();

                                                            drawChart( data );
                                                        }
                                            })
                                            .done(function( data ) {
                                              console.log("success");
                                              // console.log( data );
                                            })
                                            .fail(function( data ) {
                                              console.log("error");
                                              // console.log( data );
                                            })
                                            .always(function( data ) {
                                              console.log("complete");
                                              // console.log( data );
                                            });
                                            
                                        }
                            );
      });
    }

    /**INITIALIZE CHART DRAW**/
    google.setOnLoadCallback(initializeGraph);
    google.charts.load("current", {packages:["corechart"]});
    </script>

  </form>
</body>
</html>