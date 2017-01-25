<?php
require_once('../../database/config.php');
$repYear = $_POST['yearSelect'];
$branName = $_POST['branchName'];

$getrev = "SELECT COUNT(ReportCategory) AS RepCat, CategoryName, ReportDate
FROM ict_database.tblreports r LEFT JOIN ict_database.tblcategory c
ON r.ReportActivity = c.CategoryID
LEFT JOIN ict_database.tbllocation l
ON r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND
ReportLoc = '$branName' AND LocationIsActive = 1 AND
ReportIsActive = 1 AND CategoryIsActive = 1 AND CategoryID = 1 GROUP BY ReportCategory";

$getnon = "SELECT COUNT(ReportCategory) AS RepCats, CategoryName, ReportDate
FROM ict_database.tblreports r LEFT JOIN ict_database.tblcategory c
ON r.ReportActivity = c.CategoryID
LEFT JOIN ict_database.tbllocation l
ON r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND
ReportLoc = '$branName' AND LocationIsActive = 1 AND
ReportIsActive = 1 AND CategoryIsActive = 1 AND CategoryID = 2 GROUP BY ReportCategory";

$exec = mysqli_query($conn, $getrev);
$exec2 = mysqli_query($conn, $getnon);

if (!$exec) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
if (!$exec2) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}

while($row = mysqli_fetch_array($exec)){
  $array[] = array($row['CategoryName'], (float)$row['RepCat']);
}

while($row2 = mysqli_fetch_array($exec2)){
  $array[] = array($rowp['CategoryName'], (float)$row['RepCats']);
}

echo json_encode($array);

?>
