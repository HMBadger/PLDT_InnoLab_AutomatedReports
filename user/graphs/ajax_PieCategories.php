<?php

    require('../../database/config.php');

    // $array[]= array( "Category", "Percentage" );
    // $array2[]= array();

   

    $query  =   "   SELECT
                                    CategoryName,
                                    CategoryCTR
                    FROM            ict_database.tblcategory
                    WHERE           CategoryIsActive = 1
                        
                ";

   


    $exec   = mysqli_query( $conn, $query );
   

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'CategoryName' ], (float)$row[ 'CategoryCTR' ] );//echo  "['".$row[ 'CategoryName' ]."', ".$row[ 'CategoryCTR' ]."], ";
    }

  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
