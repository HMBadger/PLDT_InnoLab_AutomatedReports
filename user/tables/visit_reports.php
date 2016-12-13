<?php
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
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
  <?php
  if(isset($_POST['btnGenEx'])){
    /** Error reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');
    $objPHPExcel = new PHPExcel();
    $sql = "SELECT * FROM ict_database.tblreports r
    left join ict_database.tbllocation l
    ON r.ReportLoc =   l.LocationID
    left join ict_database.tblgroup g
    ON r.ReportGroup = g.GroupID
    left join ict_database.tblcategory c
    ON r.ReportCategory = c.CategoryID
    left join ict_database.tblvisitors v
    ON r.ReportVisitor = v.VisitorID
    left join ict_database.tblactivity a
    ON r.ReportActivity = a.ActivityID
    WHERE ReportIsActive = 1 ORDER BY LocationName, ReportDate ASC";
    $res= mysqli_query($conn, $sql);
    /** Error reporting */
    error_reporting(E_ALL);
    $objPHPExcel = new PHPExcel();
    if(!$res){
      die("Error");
    }
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Save Excel 2007 file
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->setCellValue("A1", "Date");
    $objPHPExcel->getActiveSheet()->setCellValue("B1", "Branch");
    $objPHPExcel->getActiveSheet()->setCellValue("C1", "Visitor Group");
    $objPHPExcel->getActiveSheet()->setCellValue("D1", "Visitor Category");
    $objPHPExcel->getActiveSheet()->setCellValue("E1", "Category");
    $objPHPExcel->getActiveSheet()->setCellValue("F1", "Client Name or Event Title");
    $objPHPExcel->getActiveSheet()->setCellValue("G1", "Person In Charge");
    $objPHPExcel->getActiveSheet()->setCellValue("H1", "Activity Type");
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("E") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("F") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("G") -> setAutoSize(true);
    $objPHPExcel -> getActiveSheet() -> getColumnDimension("H") -> setAutoSize(true);
    $rowCount = 2;
    while($exrow = mysqli_fetch_assoc($res)) {
      $objPHPExcel->getActiveSheet()->setCellValue("A" .$rowCount, date('m/d/Y', strtotime($exrow['ReportDate'])));
      $objPHPExcel->getActiveSheet()->setCellValue("B" .$rowCount, $exrow['LocationName']);
      $objPHPExcel->getActiveSheet()->setCellValue("C" .$rowCount, $exrow['GroupName']);
      $objPHPExcel->getActiveSheet()->setCellValue("D" .$rowCount, $exrow['VisitorName']);
      $objPHPExcel->getActiveSheet()->setCellValue("E" .$rowCount, $exrow['CategoryName']);
      $objPHPExcel->getActiveSheet()->setCellValue("F" .$rowCount, $exrow['ReportClient']);
      $objPHPExcel->getActiveSheet()->setCellValue("G" .$rowCount, $exrow['ReportPerson']);
      $objPHPExcel->getActiveSheet()->setCellValue("H" .$rowCount, $exrow['ActivityName']);
      $rowCount++;
    }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="report.xlsx"');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
  }
  ?>
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
                <a href="#">Innolab Yearly Report</a>
              </li>
              <li>
                <a href="visit_summary.php">Innolab Visit Summary</a>
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
            <select name="txtYears" id="txtYears" class="form-control" style="width: 80%!important">
              <?php
              $sqlyear = "SELECT DISTINCT YEAR(ReportDate) AS YEARS FROM ict_database.tblreports";
              $queryyear = mysqli_query($conn, $sqlyear);
              while($row = mysqli_fetch_array($queryyear)){
                ?>
                <option value="<?php echo $row['YEARS'] ?>" name="txtYearString"><?php echo $row['YEARS'] ?></option>
                <?php
              }?>
            </select>&nbsp;&nbsp;
            <input onclick="generatereports.php" class="btn btn-primary" type="submit" name="btnGenReport" value="Generate Table" style="width: 20%!important"/>
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
                      <th>Visitor Category</th>
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
        <!--GENERATE EXCEL FILE-->
        <a href="excel_config.php" name="genExcel">Generate Excel File(.xls)</a>
        <input  class="btn btn-primary" type="submit" name="btnGenEx" value="Generate Table" style="width: 20%!important"/>
        <!--/GENERATE EXCEL FILE-->
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
</div>
</body>
</html>
