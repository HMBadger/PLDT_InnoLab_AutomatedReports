<?php 

    require('../../database/config.php');

    $array[]= array( "Company", "Percentage" );

    $grpOne = $_POST[ 'GroupOne' ];
    $grpTwo = $_POST[ 'GroupTwo' ];   

    $query  =   "   SELECT 
                                    GroupName, 
                                    GroupCTR 
                    FROM            ict_database.tblgroup 
                    WHERE           GroupIsActive = 1 
                        AND         GroupID = $grpOne
                ";

    $query2  =   "   SELECT 
                                    GroupName, 
                                    GroupCTR 
                    FROM            ict_database.tblgroup 
                    WHERE           GroupIsActive = 1 
                        AND         GroupID = $grpTwo
                ";


    $exec   = mysqli_query( $conn, $query );
    $exec2  = mysqli_query( $conn, $query2 );

    while( $row = mysqli_fetch_array( $exec ) )
    {
        $array[] = array( $row[ 'GroupName' ], (float)$row[ 'GroupCTR' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
    }

    while( $row2 = mysqli_fetch_array( $exec2 ) )
    {
        $array[] = array( $row2[ 'GroupName' ], (float)$row2[ 'GroupCTR' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
    }

    $getSum =   "   SELECT 
                                SUM( GroupCTR )
                        AS      SubTotal
                    FROM        ict_database.tblgroup 
                    WHERE       GroupIsActive = 1 
                        AND     ( 
                                    GroupID != 2 
                                AND 
                                    GroupID != 4 
                                ) 
                ";

    $exec2  = mysqli_query( $conn, $getSum );
    $row2   = mysqli_fetch_array( $exec2 );

    $array[] = array( "Others", (float)$row2[ 'SubTotal' ] );//echo "['Others', ".$row2['SubTotal']."]";


    echo json_encode( $array );