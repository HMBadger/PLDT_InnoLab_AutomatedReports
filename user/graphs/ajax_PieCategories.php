<?php

    require('../../database/config.php');

    // $array[]= array( "Category", "Percentage" );
    // $array2[]= array();

   

  
				
	$repYear = $_POST[ 'txtYears' ];
	$branName = $_POST[ 'branchName' ];

	$getCategories = "SELECT COUNT(ReportCategory) AS RepCat, CategoryName, ReportID, ReportDate
	FROM ict_database.tblreports r LEFT JOIN ict_database.tblcategory c ON
	r.ReportCategory = c.CategoryID LEFT JOIN ict_database.tbllocation l ON
	r.ReportLoc = l.LocationID WHERE YEAR(ReportDate) = '$repYear' AND ReportLoc = '$branName' AND LocationIsActive = 1 AND ReportIsActive = 1 AND CategoryIsActive = 1 GROUP BY ReportCategory";
   

    $exec   = mysqli_query( $conn, $getCategories );
   

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'CategoryName' ], (float)$row[ 'RepCat' ] );//echo  "['".$row[ 'CategoryName' ]."', ".$row[ 'CategoryCTR' ]."], ";
    }

  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
?>