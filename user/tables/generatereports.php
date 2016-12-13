<?php
require_once('../../database/config.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/Writer/Excel5.php');
require_once ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php');

if(!empty($_POST['txtYears'])){
  $yr = $_POST['txtYears'];
}
else {
  $yr = date("Y");
}

$gensql = "SELECT * FROM ict_database.tblreports r
left join ict_database.tbllocation l
ON r.ReportLoc =   l.LocationID
left join ict_database.tblgroup g
ON r.ReportGroup = g.GroupID
left join ict_database.tblvisitors v
ON r.ReportVisitor = v.VisitorID
left join ict_database.tblcategory c
ON r.ReportCategory = c.CategoryID
left join ict_database.tblactivity a
ON r.ReportActivity = a.ActivityID
WHERE ReportIsActive = 1 AND YEAR(ReportDate) = '$yr'";
$genquery = mysqli_query($conn, $gensql);
while($row=mysqli_fetch_array($genquery)){
echo "<tr>";
echo "<td>" .date('F d, Y',strtotime($row['ReportDate'])). "</td>";
echo "<td>" .$row['LocationName']. "</td>";
echo "<td>" .$row['GroupName']. "</td>";
echo "<td>" .$row['VisitorName']. "</td>";
echo "<td>" .$row['CategoryName']. "</td>";
echo "<td>" .$row['ReportClient']. "</td>";
echo "<td>" .$row['ReportPerson']."</td>";
echo "<td>" .$row['ActivityName']."</td>";
echo "</tr>";
}//while

?>
