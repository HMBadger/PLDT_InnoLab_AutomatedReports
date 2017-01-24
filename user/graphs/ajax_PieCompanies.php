<?php

    require('../../database/config.php');

    // $array[]= array( "Company", "Percentage" );
    // $array2[]= array();
	

	$repYear = $_POST[ 'txtYears' ];
	$branName = $_POST[ 'branchName' ];
	
	$getCompanies = "SELECT COUNT(ReportGroup) AS RepCom, GroupName, ReportID, ReportDate
	FROM ict_database.tblreports r LEFT JOIN ict_database.tbllocation l ON
	r.ReportLoc = l.LocationID LEFT JOIN ict_database.tblgroup g ON
	r.ReportGroup = g.GroupID WHERE YEAR(ReportDate) = '$repYear' AND ReportLoc = '$branName' AND LocationIsActive = 1 AND ReportIsActive = 1 AND GroupIsActive = 1 GROUP BY ReportGroup";
   
   
	
	$exec   = mysqli_query( $conn, $getCompanies );
	while( $row = mysqli_fetch_array( $exec ) )
	 
    {
        $array[] = array( $row[ 'GroupName' ], (float)$row[ 'RepCom' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
    }
	
	



    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
	
	
?>