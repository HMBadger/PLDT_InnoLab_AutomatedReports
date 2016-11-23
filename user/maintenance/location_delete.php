

<?php
require "../../database/config.php";

            if(isset($_POST['btnDelete']))
            {

			  $locID = $_POST['txtIdLoc'];
              $locName = $_POST['txtNameLoc'];


			  $sql = "select Location_ID from db_innolab.tbllocation where Location_ID= '$locID'";
			  $query = mysqli_query($conn, $sql);
              if(mysqli_num_rows($query) > 0)
						{
							$sql = "delete * from db_innolab.tbllocation where Location_ID='$id'";
							$query = mysqli_query($conn, $sql);
									


						}

            }

            ?>



