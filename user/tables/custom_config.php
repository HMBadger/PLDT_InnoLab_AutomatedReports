<?php
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (PHP_SAPI == 'cli')
die('This example should only be run from a Web Browser');

	$objPHPExcel = new PHPExcel();
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	// Save Excel 2007 file
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
	while($exrow = mysqli_fetch_assoc($query)) {
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
	header('Content-Disposition: attachment;filename="report.xls"');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;

?>
