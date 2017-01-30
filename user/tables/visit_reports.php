<?php
session_start();
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
include ('btex.php');
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
                <a href="visit_reports.php">Innolab Yearly Report</a>
              </li>
              <li>
                <a href="visit_summary.php">Innolab Visit Summary</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-line-chart" aria-hidden="true"></i> Charts <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
              <li>
                <a href="../graphs/pie_alphasme.php">Alpha VS SME</a>
              </li>
			  <li>
                <a href="../graphs/pie_companies.php">All Visitor Group (Pie Chart)</a>
              </li>
			  <li>
                <a href="../graphs/pie_activities.php">All Activities (Donut Chart)</a>
              </li>
			  <li>
                <a href="../graphs/pie_categories.php">Visitor Category (Pie Chart)</a>
              </li>
              <li>
                <a href="../graphs/column_activity.php">All Activities (Bar Chart)</a>
              </li>
			  <li>
                <a href="../graphs/column_group.php">All Visitor Group (Bar Chart)</a>
              </li>
			   <li>
                <a href="../graphs/column_category.php">Visitor Category (Bar Chart)</a>
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
          <h1>PLDT Innolab Yearly Report</h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-dashboard"></i>Add Information</a></li>
            <li class="active"><i class="fa fa-table"></i> Tables</li>
          </ol>
          <div style="display:flex">
            <div class="row">
              <div class="col-md-6">
                <select name="txtYears" id="txtYears" class="form-control" style="width: 100%!important">
                  <?php
                  $sqlyear = "SELECT DISTINCT YEAR(ReportDate) AS YEARS FROM ict_database.tblreports
                  WHERE ReportIsActive = 1";
                  $queryyear = mysqli_query($conn, $sqlyear);
                  while($row = mysqli_fetch_array($queryyear)){
                    ?>
                    <option value="<?php echo $row['YEARS'] ?>" name="txtYearString"><?php echo $row['YEARS'] ?></option>
                    <?php
                  }?>
                </select>&nbsp;&nbsp;
              </div>
              <div class="col-md-6">
<input onclick="generatereports.php" class="btn btn-primary" type="submit" name="btnGenReport" value="Generate Table"/>
              </div>
            </div>


          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="tabreport" name="tabreport" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Reservation Date</th>
                      <th>Location</th>
                      <th>Visitor Group</th>
                      <th>Category</th>
                      <th>Client Name/Event</th>
                      <th>Person In Charge</th>
                      <th>Activity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include 'generatereports.php'; ?>
                  </tbody>
                </table>
              </div><!--#table-->
            </div>
          </div>
        </div>
        <!--GENERATE EXCEL FILE
        <a href="excel_config.php" name="genExcel">Generate Excel File(.xls)</a>
        <input onclick="btex.php" class="btn btn-primary" type="submit" name="btnGenEx" value="Generate Excel" style="width: 20%!important"/>
        <!--/GENERATE EXCEL FILE-->

        <input type="button" onclick="tableToExcel('tabreport')" value="Export to Excel">
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
</div>
</body>
</html>
