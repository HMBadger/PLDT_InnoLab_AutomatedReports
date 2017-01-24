<?php

    require('../../database/config.php');

    // $array[]= array( "Activity", "Percentage" );
    // $array2[]= array();
	
	$repYear = $_POST[ 'txtYears' ];

	$getActivities = "SELECT COUNT(ReportActivity) AS RepAct, ActivityName, ReportID, ReportDate
	FROM ict_database.tblreports r LEFT JOIN ict_database.tblactivity a ON
	r.ReportActivity = a.ActivityID WHERE YEAR(ReportDate) = '$repYear' AND ReportIsActive = 1 AND ActivityIsActive = 1 GROUP BY ReportActivity";
   


    $exec   = mysqli_query( $conn, $getActivities );
    while( $row = mysqli_fetch_array( $exec ) )
		
    {
        $array[] = array( $row[ 'ActivityName' ], (float)$row[ 'RepAct' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
    }
  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
?>