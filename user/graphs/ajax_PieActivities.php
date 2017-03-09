<?php

require('../../database/config.php');

$repYear = $_POST[ 'txtYears' ];
$branName = $_POST[ 'branchName' ];

$getActivities = "SELECT COUNT(ReportActivity) AS RepAct, ActivityName, ReportID, ReportDate
FROM ict_database.tblreports r LEFT JOIN ict_database.tblactivity a ON
r.ReportActivity = a.ActivityID LEFT JOIN ict_database.tbllocation l ON
r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND ReportIsActive = 1 AND ActivityIsActive = 1 AND ReportLoc = '$branName' AND LocationIsActive = 1 AND ReportIsActive = 1 GROUP BY ReportActivity";

$exec   = mysqli_query( $conn, $getActivities );
while( $row = mysqli_fetch_array( $exec ) )

{
  $array[] = array( $row[ 'ActivityName' ], (float)$row[ 'RepAct' ] );
}

echo json_encode( $array );

?>
