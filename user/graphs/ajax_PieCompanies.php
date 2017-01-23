<?php

    require('../../database/config.php');

    // $array[]= array( "Company", "Percentage" );
    // $array2[]= array();
	

	$repYear = $_POST[ 'txtYears' ];

	$getCompanies =   "SELECT DISTINCT ( ReportID) as AllCompany, GroupName FROM ict_database.tblreports r
    LEFT JOIN ict_database.tblgroup g
    ON r.ReportGroup = g.GroupID WHERE ReportIsActive = 1 AND YEAR( ReportDate ) = '$repYear' and GroupIsActive = 1";
   
    $exec   = mysqli_query( $conn, $getCompanies );
	while( $row = mysqli_fetch_array( $exec ) )
		 
    {
        $array[] = array( $row[ 'GroupName' ], (float)$row[ 'AllCompany' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
    }

 

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
?>