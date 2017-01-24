<?php

    require('../../database/config.php');

    // $array[]= array( "Category", "Percentage" );
    // $array2[]= array();

   

  
				
	$repYear = $_POST[ 'txtYears' ];

	$getCategories = "SELECT COUNT(ReportCategory) AS RepCat, CategoryName, ReportID, ReportDate
	FROM ict_database.tblreports r LEFT JOIN ict_database.tblcategory c ON
	r.ReportCategory = c.CategoryID WHERE YEAR(ReportDate) = '$repYear' AND ReportIsActive = 1 AND CategoryIsActive = 1 GROUP BY ReportCategory";
   

    $exec   = mysqli_query( $conn, $getCategories );
   

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'CategoryName' ], (float)$row[ 'RepCat' ] );//echo  "['".$row[ 'CategoryName' ]."', ".$row[ 'CategoryCTR' ]."], ";
    }

  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
?>