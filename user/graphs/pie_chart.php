<?php
require_once('../../database/config.php');
include 'fusioncharts.php';
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
  <link href="extension-page-style.css" rel="stylesheet" type="text/css"  />
  <link rel="icon" href="../images/innolablogo.png">
  <!-- For chart-->

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
          <a class="navbar-brand" href="index.html">PLDT Innolab Report Generator</a>
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
                  <a href="tables/visit_reports.php">Innolab Yearly Report</a>
                </li>
                <li>
                  <a href="tables/visit_summary.php">Innolab Visit Summary</a>
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
                            <small>Company vs Company</small>
                        </h1>
						
						 <div class="row" style="margin-bottom: 40px">
							<div class="col-md-6">
							  <label>From:</label>
							  <input name="txtDateFrom" id="txtDateFrom" class="form-control" type="date">
							</div>
							<div class="col-md-6">
							  <label>To:</label>
							  <input name="txtDateTo" id="txtDateTo" class="form-control" type="date">
							</div>
						 </div>
						 
						 <div class="row" style="margin-bottom: 40px">
							<div class="col-md-5">
							  <label>Company:</label>
								<select name="optGroupRep" class="form-control" >
								  <?php
								
								  $sql = "SELECT * FROM ict_database.tblgroup WHERE GroupIsActive = 1";
								  $query = mysqli_query($conn,$sql);
								  while($row=mysqli_fetch_array($query))
								  {
									$grp_id = $row['GroupID'];
									$grp_name = $row['GroupName'];
									echo "<option value=\"$grp_id\">$grp_name</option>";
								  } 
								  ?>
								</select>&nbsp; &nbsp; 
							</div>
							<div class="col-md-5">
							  <label>Company:</label>
							  <select name="optGroupRep" class="form-control" >
							  <?php
								  $sql = "SELECT * FROM ict_database.tblgroup WHERE GroupIsActive = 1";
								  $query = mysqli_query($conn,$sql);
								  while($row=mysqli_fetch_array($query))
								  {
									$grp_id = $row['GroupID'];
									$grp_name = $row['GroupName'];
									echo "<option value=\"$grp_id\">$grp_name</option>";
								  } 
								  ?>
								  </select>&nbsp; &nbsp; 
							</div>
							 <div class="col-md-2" style="margin-top:2%">
							 
							  <input class="btn btn-primary" type="submit" name="btnGenPie" value="Generate Pie Chart"/>
							</div>
						 </div>
						 
						 <div id="chart-container">FusionCharts will render here</div> 
						 <?php
							// Create the chart - Pie 3D Chart with data given in constructor parameter // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$annotationChart = new FusionCharts("column2d", "ex1" , "100%", "300", "chart-1", "json", '{
        "chart": {
          "caption": "Top 4 Chocolate Brands Sold",
          "subCaption": "Last Year",
          "yAxisName": "Sales (in USD)",
          "yAxisMaxValue": "120000",
          "showXAxisLine": "0",
          "numberPrefix": "$",
          "theme": "fint",
          "PlotfillAlpha": "0",
          "placeValuesInside": "0",
          "rotateValues": "0",
          "valueFontColor": "#333333",
          "showLabels": "0",
          "chartBottomMargin": "20",
          "plotToolText": "<div>Brand : <b>$label</b><br/>Total Revenue : <b>$$value</b></div>",
        },
        "annotations": {
          "autoScale": "1",
          "scaleImages": "1",
          "origW": "400",
          "origH": "300",
          "groups": [{
            "id": "user-images",
            "items": [{
              "id": "butterFinger-icon",
              "type": "image",
              "url": "http://static.fusioncharts.com/sampledata/images/butterFinger.png",
              "x": "$dataset.0.set.0.CenterX - 28",
              "y": "$dataset.0.set.0.STARTY",
              "xScale": "50",
              "toy": "$dataset.0.set.0.ENDY + 2",
            }, {
              "id": "snickrs-user-icon",
              "type": "image",
              "url": "http://static.fusioncharts.com/sampledata/images/snickrs.png",
              "x": "$dataset.0.set.1.CenterX - 25",
              "y": "$dataset.0.set.1.STARTY",
              "xScale": "50",
              "toy": "$dataset.0.set.1.ENDY + 2",
            }, {
              "id": "coffee_crisp-user-icon",
              "type": "image",
              "url": "http://static.fusioncharts.com/sampledata/images/coffee_crisp.png",
              "x": "$dataset.0.set.2.CenterX - 25",
              "y": "$dataset.0.set.2.STARTY",
              "xScale": "50",
              "toy": "$dataset.0.set.2.ENDY + 2",
            }, {
              "id": "100grand-user-icon",
              "type": "image",
              "url": "http://static.fusioncharts.com/sampledata/images/100grand.png",
              "x": "$dataset.0.set.3.CenterX - 25",
              "y": "$dataset.0.set.3.STARTY",
              "xScale": "50",
              "toy": "$dataset.0.set.3.ENDY + 2",
            }]
          }]
        },
        "data": [{
          "label": "Butterfinger",
          "value": "92000"
        }, {
          "label": "Snickers",
          "value": "87000"
        }, {
          "label": "Coffee Crisp",
          "value": "83000"
        }, {
          "label": "100 Grand",
          "value": "80000"
        }]
      }');
	// Render the chart
	$annotationChart->render();
	?>
                    
                    </div>
                </div>
        </div>
      </div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="fusioncharts-js/fusioncharts.js"></script>
	<script src="fusioncharts-js/fusioncharts.charts.js"></script>
	<script src="fusioncharts-js/fusioncharts.gantt.js"></script>
	<script src="fusioncharts-js/fusioncharts.maps.js"></script>
	<script src="fusioncharts-js/fusioncharts.powercharts.js"></script>
	<script src="fusioncharts-js/fusioncharts.ssgrid.js"></script>
	<script src="fusioncharts-js/fusioncharts.treemap.js"></script>
	<script src="fusioncharts-js/fusioncharts.widgets.js"></script>
	<script src="fusioncharts-js/fusioncharts.zoomscatter.js"></script>
	
   
    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
  </form>
</body>
</html>
