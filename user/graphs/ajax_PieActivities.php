<?php

    require('../../database/config.php');

    // $array[]= array( "Activity", "Percentage" );
    // $array2[]= array();

   

    $query  =   "   SELECT
                                    ActivityName,
                                    ActivityCTR
                    FROM            ict_database.tblactivity
                    WHERE           ActivityIsActive = 1
                        
                ";

   


    $exec   = mysqli_query( $conn, $query );
   

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'ActivityName' ], (float)$row[ 'ActivityCTR' ] );//echo  "['".$row[ 'ActivityName' ]."', ".$row[ 'ActivityCTR' ]."], ";
    }

  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
