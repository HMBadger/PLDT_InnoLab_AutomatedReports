<?php
  require('../../database/config.php');


  $getVisitors = "SELECT COUNT(ReportID) as rID, ActivityName, ReportDate FROM ict_database.tblreports r
  LEFT JOIN ict_database.tblactivity g
  ON r.ReportActivity = g.ActivityID
  WHERE g.ActivityIsActive = 1 AND YEAR(ReportDate) = '2016'";
  $getVis = "SELECT COUNT(ReportID) as rID, ActivityName FROM ict_database.tblactivity a
  LEFT JOIN ict_database.tblreports r
  ON r.ReportActivity = a.ActivityID";



  $execVisitors = mysqli_query($conn, $getVisitors);

  if (!$execVisitors) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

  while($row = mysqli_fetch_assoc($execVisitors)){
    $array[] = array($row['ActivityName'], (float)$row['rID']);
  }

  echo json_encode($array);
 ?>
