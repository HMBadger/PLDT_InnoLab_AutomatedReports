<?php
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

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
left join ict_database.tblactivity a
ON r.ReportActivity = a.ActivityID
WHERE ReportIsActive = 1";
$res= mysqli_query($conn, $sql);

/** Error reporting */
error_reporting(E_ALL);

$objPHPExcel = new PHPExcel();

if(!$res){
	die("Error");
}


$col = 0;
$row = 1;

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->setCellValue("A1", "Report Date");
$objPHPExcel->getActiveSheet()->setCellValue("B1", "Report Location");
$objPHPExcel->getActiveSheet()->setCellValue("C1", "Report Group");
$objPHPExcel->getActiveSheet()->setCellValue("D1", "Report Category");
$objPHPExcel->getActiveSheet()->setCellValue("E1", "Report Client");
$objPHPExcel->getActiveSheet()->setCellValue("F1", "Report Person");
$objPHPExcel->getActiveSheet()->setCellValue("G1", "Report Activity");

$objPHPExcel -> getActiveSheet() -> getColumnDimension("A") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("B") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("C") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("D") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("E") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("F") -> setAutoSize(true);
$objPHPExcel -> getActiveSheet() -> getColumnDimension("G") -> setAutoSize(true);
while($mrow = mysqli_fetch_assoc($res)) {
	$col = 0;
	foreach($mrow as $key=>$value) {
		$objPHPExcel->getActiveSheet()->setCellValue("A1" .$row, $mrow['ReportDate']);
		$objPHPExcel->getActiveSheet()->setCellValue("B1" . $row, $mrow['LocationName']);
		$objPHPExcel->getActiveSheet()->setCellValue("C1" . $row, $mrow['GroupName']);
		$objPHPExcel->getActiveSheet()->setCellValue("D1" . $row, $mrow['CategoryName']);
		$objPHPExcel->getActiveSheet()->setCellValue("E1" . $row, $mrow['ReportClient']);
		$objPHPExcel->getActiveSheet()->setCellValue("F1" . $row, $mrow['ReportPerson']);
		$objPHPExcel->getActiveSheet()->setCellValue("G1" . $row, $mrow['ActivityName']);
		$col++;
	}
	$row++;
}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Save Excel 2007 file
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="report.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


exit;
?>
