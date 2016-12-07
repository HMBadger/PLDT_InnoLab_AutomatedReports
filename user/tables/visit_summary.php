<?php
require_once('../../database/config.php');

?>
<!DOCTYPE HTML>
<html lang ="en">
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
  <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="../../images/innolablogo.png">
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
            <a href="javascript:;" data-toggle="collapse" data-target="#main"><i class="fa fa-fw fa-arrows-v"></i>Maintenance<i class="fa fa-fw fa-caret-down"></i></a>
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
                <a href="visit_reports.php">Innolab Yearly Report</a>
              </li>
              <li>
                <a href="#">Innolab Visit Summary</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </nav>
    <form method="post">
      <div id="page-wrapper">
        <div class="container-fluid"><br>
          <h1>PLDT Innolab Reports</h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-dashboard"></i>Add Information</a></li>
            <li class="active"><i class="fa fa-table"></i> Tables</li>
          </ol>
          <div class="row" style="margin-bottom: 40px">
            <div class="col-md-5">
              <label>From:</label>
              <input name="txtDateFrom" id="txtDateFrom" class="form-control" type="date">
            </div>
            <div class="col-md-5">
              <label>To:</label>
              <input name="txtDateTo" id="txtDateTo" class="form-control" type="date">
            </div>
            <div class="col-md-2">
              <input class="btn btn-lg btn-primary" type="submit" name="btnGenReport" value="Generate Table"/>
            </div>
          </div>
          <div class="row">
            <input type="button" onclick="tableToExcel('tabreport')" value="Export to Excel">
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="tabreport" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Innolab Branch</th>
                      <th>Revenue Generating Visit</th>
                      <th>Non Revenue Generating Visit</th>
                      <th>Total Visits</th>
                    </tr>
                  </thead>
                  <tbody>
										<?php
											$summary_sql = "SELECT * FROM ict_database.tbllocation l
											LEFT JOIN ict_database.tblcategory c
											ON l.LocationID = c.CategoryID
											WHERE LocationIsActive = 1 AND CategoryIsActive = 1";
											$query = mysqli_query($conn, $summary_sql);
											while($row = mysqli_fetch_array($query)){?>
												<tr>
												<td>
												<?php echo $row['LocationName'] ?>
												</td>
												<td>
													<?php echo $row['CategoryName']?>
												</td>
												</tr>
												<?php
											}//while
										?>
                  </tbody>
                </table>
              </div><!--#table-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="../../js/bootstrap.min.js"></script>
  <!--Custom Scripts-->
  <script>
  $(document).ready(function() {
    $('#tabreport').DataTable();
  } );
  </script>



  <script type="text/javascript">
  var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
      window.location.href = uri + base64(format(template, ctx))
    }
  })()
  </script>

</script>



</div>
</body>
</html>
