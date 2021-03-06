<?php
require_once('../../database/config.php');
?>
<!--/PHP Configuration File-->
<!DOCTYPE html>
<!--PHP Configuration File-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Reports</title>
  <!-- Data table -->
  <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!--Company Logo-->
  <link rel="icon" href="../images/innolablogo.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <form method="post">
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Report Generator</a>
        </div>
        <!-- Top Menu Items -->
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Graphs <i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="demo" class="collapse">
                <li>
                  <a href="pie_chart.php">Pie Graph</a>
                </li>
                <li>
                  <a href="bar_graph.php">Bar Graph</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#main"><i class="fa fa-fw fa-arrows-v"></i> Maintenance <i class="fa fa-fw fa-caret-down"></i></a>
              <ul id="main" class="collapse">
                <li>
                  <a href="../index.php"> Add Information</a>
                </li>
                <li>
                  <a href="../view_info.php">View Information </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="../tables/visit_reports.php"><i class="fa fa-table" aria-hidden="true"></i> Yearly Report</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">
        <div class="container-fluid"><br>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="page-header">
                Pie Graph
                <small>Company vs Company</small>
              </h1>

              <ol class="breadcrumb">
                <li class="active">
                  <i class="fa fa-users"></i> <a href="pie_chart.php"> Company vs Company </a>
                </li>

                <li>
                  <i class="fa fa-suitcase"></i>  <a href="pie_companies.php">All Companies</a>
                </li>

                <li>
                  <i class="fa fa-wrench"></i>  <a href="pie_activities.php">All Activities</a>
                </li>

                <li>
                  <i class="fa fa-money"></i>  <a href="pie_categories.php">Revenue vs Non-Revenue</a>
                </li>


              </ol>

              <div class="row" >
                <div class="col-md-12">

                  <select name="txtYears" id="txtYears" class="form-control" style="width: 100%!important">
                    <?php
                    $sqlyear = "SELECT DISTINCT YEAR(ReportDate) AS YEARS FROM ict_database.tblreports WHERE ReportIsActive = 1";
                    $queryyear = mysqli_query($conn, $sqlyear);
                    while($row = mysqli_fetch_array($queryyear)){
                      ?>
                      <option value="<?php echo $row['YEARS'] ?>" name="txtYearString"><?php echo $row['YEARS'] ?></option>
                      <?php
                    }?>
                  </select>&nbsp;&nbsp;
                </div>


              </div>

              <div class="row" style="margin-bottom: 40px">
                <div class="col-md-5">
                  <label>Company:</label>
                  <select class="form-control"
                  id="GroupOne"
                  name="GroupOne"
                  >
                  <?php

                  $sql =  " SELECT
                  *
                  FROM    ict_database.tblgroup
                  WHERE   GroupIsActive = 1
                  ";

                  $query = mysqli_query( $conn, $sql );

                  while( $row = mysqli_fetch_array( $query ) )
                  {
                    $grp_id   = $row[ 'GroupID' ];
                    $grp_name = $row[ 'GroupName' ];
                    echo "<option value=\"$grp_id\">$grp_name</option>";
                  }

                  ?>
                </select>&nbsp; &nbsp;
              </div>
              <div class="col-md-5">
                <label>Company:</label>
                <select class="form-control"
                id="GroupTwo"
                name="GroupTwo"
                >
                <?php

                $sql =  " SELECT
                *
                FROM    ict_database.tblgroup
                WHERE   GroupIsActive = 1
                ";

                $query = mysqli_query( $conn, $sql );

                while( $row = mysqli_fetch_array( $query ) )
                {
                  $grp_id   = $row[ 'GroupID' ];
                  $grp_name = $row[ 'GroupName' ];
                  echo "<option value=\"$grp_id\">$grp_name</option>";
                }
                ?>
              </select>&nbsp; &nbsp;
            </div>

            <div class="col-md-2" style="margin-top: 2%" >

              <input type="button" class="btn btn-primary"
              id="btnGenPie"
              value="Generate Pie Chart"
              />

            </div>

          </div>
        </div>
      </div>
      <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
      <div id="png"></style>
      </div>
    </div>
  </div>




  <!-- /#wrapper -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../../js/bootstrap.min.js"></script>

  <!-- Google Chart-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

  <script type="text/javascript">

  // $( document ).ready(
  //                     function()
  //                     {
  //                         drawChart();
  //                     }
  //               );

  function drawChart( arr ) {

    // var arr = [
    //             [ 'Company', 'Percentage' ],
    //             [ 'PLDT GlobalNation', 12 ],
    //             [ 'Globe', 22 ],
    //             [ 'Others', null ],
    //           ];

    var data = google.visualization.arrayToDataTable( arr );

    console.log( arr );
    console.log( data );

    var options = {
      title: 'Company vs Company',
      is3D: true,
    };

    var chart = new google.visualization.PieChart( document.getElementById( 'piechart_3d' ) );
    chart.draw( data, options );
    document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '"target="_blank" class="btn btn-primary">Printable version</a>';
  }

  /**CLICK EVENT TO DRAW CHART ON BUTTON CLICK**/
  function initializeGraph(){
    $(document).ready(function(){
      $( "#btnGenPie" ).on( "click", function()
      {
        //
        var gOne = $( "#GroupOne" ).val();
        var gTwo = $( "#GroupTwo" ).val();
        var rYear = $( "#txtYears").val();
        //
        // drawChart();
        $.ajax({
          url:      'ajax_PieChartData.php',
          type:     'POST',
          dataType: 'JSON',
          data:     {
            GroupOne: gOne,
            GroupTwo: gTwo,
            txtYears: rYear,
          },
          success:  function( data )
          {
            var arr = [ "Company", "Percentage" ];

            data.sort(function(a, b){
              return a[1]-b[1];
            });

            data.push( arr );
            data.reverse();

            drawChart( data );
          }
        })
        .done(function( data ) {
          console.log("success");
          // console.log( data );
        })
        .fail(function( data ) {
          console.log("error");
          // console.log( data );
          $("#piechart_3d").html("");
        })
        .always(function( data ) {
          console.log("complete");
          // console.log( data );
        });

      }
    );
  });
}

/**INITIALIZE CHART DRAW**/
google.setOnLoadCallback(initializeGraph);
google.charts.load("current", {packages:["corechart"]});
</script>

</form>
</body>
</html>
