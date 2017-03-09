<?php

require('../../database/config.php');

$grpOne = $_POST[ 'GroupOne' ];
$grpTwo = $_POST[ 'GroupTwo' ];
$repYear = $_POST[ 'txtYears' ];

$query = "SELECT COUNT(ReportID) as rID, GroupName FROM ict_database.tblreports r
LEFT JOIN ict_database.tblgroup g
ON r.ReportGroup = g.GroupID WHERE ReportIsActive = 1 AND GroupID = '$grpOne' AND YEAR( ReportDate ) = '$repYear' AND GroupIsActive = 1 ";

$query2 = "SELECT COUNT(ReportID) as rID, GroupName FROM ict_database.tblreports r
LEFT JOIN ict_database.tblgroup g
ON r.ReportGroup = g.GroupID WHERE ReportIsActive = 1 AND GroupID = '$grpTwo' AND YEAR( ReportDate ) = '$repYear' AND GroupIsActive = 1 ";

$exec   = mysqli_query( $conn, $query);
$exec2  = mysqli_query( $conn, $query2);

while( $row = mysqli_fetch_array( $exec ) )
{
  $array[] = array( $row[ 'GroupName' ], (float)$row[ 'rID' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
}

while( $row2 = mysqli_fetch_array( $exec2 ) )
{
  $array[] = array( $row2[ 'GroupName' ], (float)$row2[ 'rID' ] );//echo  "['".$row[ 'GroupName' ]."', ".$row[ 'GroupCTR' ]."], ";
}

$getOthers =   "SELECT COUNT(ReportID) as SubTotal  FROM ict_database.tblreports r
LEFT JOIN ict_database.tblgroup g
ON r.ReportGroup = g.GroupID WHERE GroupID != '$grpOne' AND GroupID != '$grpTwo' AND ReportIsActive = 1 AND YEAR( ReportDate ) = '$repYear' AND GroupIsActive = 1 ";

$exec2  = mysqli_query( $conn, $getOthers );
$row2   = mysqli_fetch_array( $exec2 );

$array[] = array( "Others", (float)$row2[ 'SubTotal' ] );//echo "['Others', ".$row2['SubTotal']."]";

echo json_encode( $array );
