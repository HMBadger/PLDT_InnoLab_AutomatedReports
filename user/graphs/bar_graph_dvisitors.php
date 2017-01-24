<?php
require_once('../../database/config.php');
$repYear = $_POST['yearSelect'];
$branName = $_POST['branchName'];

$getVisitors = "SELECT COUNT(ReportGroup) AS RepVis, GroupName, ReportDate
FROM ict_database.tblreports r LEFT JOIN ict_database.tblgroup v ON
r.ReportGroup = v.GroupID LEFT JOIN
ict_database.tbllocation l
ON r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND ReportLoc = '$branName'
AND LocationIsActive = 1 AND ReportIsActive = 1 AND GroupIsActive = 1 GROUP BY ReportGroup";

$exec = mysqli_query($conn, $getVisitors);
if (!$exec) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}

while($row = mysqli_fetch_assoc($exec)){
  $array[] = array($row['GroupName'], (float)$row['RepVis']);
}

echo json_encode($array);

?>
