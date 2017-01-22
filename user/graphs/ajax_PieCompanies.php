<?php

    require('../../database/config.php');

    // $array[]= array( "Company", "Percentage" );
    // $array2[]= array();

   

    $query  =   "   SELECT
                                    GroupName,
                                    GroupCTR
                    FROM            ict_database.tblgroup
                    WHERE           GroupIsActive = 1
                        
                ";

   


    $exec   = mysqli_query( $conn, $query );
   

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'GroupName' ], (float)$row[ 'GroupCTR' ] );//echo  "['".$row[ 'ActivityName' ]."', ".$row[ 'ActivityCTR' ]."], ";
    }

  

    // arsort( $array );

    echo json_encode( $array );
    // print_r( [ $array ] );
