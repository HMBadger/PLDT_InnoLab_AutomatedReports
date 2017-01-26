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
                <a href="pie_alphasme.php">Alpha VS SME</a>
              </li>
			  <li>
                <a href="pie_companies.php">All Visitor Group (Pie Chart)</a>
              </li>
			  <li>
                <a href="pie_activities.php">All Activities (Donut Chart)</a>
              </li>
			  <li>
                <a href="pie_categories.php">Visitor Category (Pie Chart)</a>
              </li>
              <li>
                <a href="column_activity.php">All Activities (Bar Chart)</a>
              </li>
			  <li>
                <a href="column_group.php">All Visitor Group (Bar Chart)</a>
              </li>
			   <li>
                <a href="column_category.php">Visitor Category (Bar Chart)</a>
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

			   <ol class="breadcrumb">
							<li class="active">
                                <i class="fa fa-users"></i> <a href="pie_chart.php"> Company vs Company </a>
                            </li>

                            <li>
                                <i class="fa fa-suitcase"></i>  <a href="pie_companies.php">All Companies</a>
                            </li>

							<li>
                                <i class="fa fa-wrench"></i>  <a href="pie_activities.php">All Activities</a>
                            </li>

							<li>
                                <i class="fa fa-money"></i>  <a href="pie_categories.php">Revenue vs Non-Revenue</a>
                            </li>


                </ol>


              <div class="row" style="margin-bottom: 40px">

                <div class="col-md-5">
                 	<select name="txtYears" id="txtYears" class="form-control" style="width: 100%!important">
						  <?php
						  $sqlyear = "SELECT DISTINCT YEAR(ReportDate) AS YEARS FROM ict_database.tblreports";
						  $queryyear = mysqli_query($conn, $sqlyear);
						  while($row = mysqli_fetch_array($queryyear)){
							?>
							<option value="<?php echo $row['YEARS'] ?>" name="txtYearString"><?php echo $row['YEARS'] ?></option>
							<?php
						  }?>
					</select>&nbsp;&nbsp;
                </div>

				<div class="col-md-5">

				 <select name="branchName" id="branchName" class="form-control">
				  <?php
				  require '../../database/config.php';
				  $sql = "SELECT * FROM ict_database.tbllocation WHERE LocationIsActive = 1";
				  $query = mysqli_query($conn,$sql);
				  while($row=mysqli_fetch_array($query))
				  {
					$loc_id = $row['LocationID'];
					$loc_name = $row['LocationName'];
					echo "<option value=\"$loc_id\">$loc_name</option>";
				  }
				  ?>
				</select>&nbsp; &nbsp;
                </div>


                <div class="col-md-2">
						<input type="button" class="btn btn-primary"
                          id="btnGenPie"
                          value="Generate Pie Chart"
                          />
                </div>



              </div>



            </div>
          </div>
          <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
          <div id="png"></div>
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
                        title: 'Activity Chart',
                         pieHole: 0.5,
                    };

      var chart = new google.visualization.PieChart( document.getElementById( 'piechart_3d' ) );
      chart.draw( data, options );
      document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Printable version</a>';
    }

    /**CLICK EVENT TO DRAW CHART ON BUTTON CLICK**/
    function initializeGraph(){
      $(document).ready(function(){
        $( "#btnGenPie" ).on( "click", function()
                                        {
                                            //
												var rYear = $( "#txtYears").val();
												var bName = $( "#branchName").val();
                                            //
                                            // drawChart();
                                            $.ajax({
                                              url:      'ajax_PieActivities.php',
											  type:     'POST',
                                              dataType: 'JSON',
											  data:     {
                                                            txtYears: rYear,
															branchName: bName,
                                                        },


                                                 success:  function( data )
                                                        {
                                                            var arr = [ "Activity", "Percentage" ];

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
											   $("#piechart_3d").html("");
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
