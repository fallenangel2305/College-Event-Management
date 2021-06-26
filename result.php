<!DOCTYPE html>
<html lang="en">

	<?php include 'includes/head.php'; ?>
	<?php include 'includes/scripts.php'; ?>
	

<body>
	<!--- Navigation -->
	
		<?php $page = 'result'; include 'includes/navbar.php'; ?>
	
	<!--- End Navigation -->
	
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Result List</h2>
						</div>
                    <?php
                    // Include config file
                    include('security.php');
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM `tabulation`";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>ItemID</th>";
                                        echo "<th>ItemName</th>";
                                        echo "<th>Reg_No</th>";
                                        echo "<th>Chest_No</th>";
										echo "<th>ISpresent</th>";
										echo "<th>Mark1</th>";
										echo "<th>Mark2</th>";
										echo "<th>Mark3</th>";
										echo "<th>Total</th>";
										echo "<th>Grade</th>";
										echo "<th>Remark</th>";
										echo "<th>TS</th>";
										echo "<th>&nbsp;&nbsp;Actions&nbsp&nbsp&nbsp;</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['ItemID'] . "</td>";
                                        echo "<td>" . $row['ItemName'] . "</td>";
                                        echo "<td>" . $row['Reg_No'] . "</td>";
										echo "<td>" . $row['Chest_No'] . "</td>";
										echo "<td>" . $row['ISpresent'] . "</td>";
										echo "<td>" . $row['Mark1'] . "</td>";
										echo "<td>" . $row['Mark2'] . "</td>";
										echo "<td>" . $row['Mark3'] . "</td>";
										echo "<td>" . $row['Total'] . "</td>";
										echo "<td>" . $row['Grade'] . "</td>";
										echo "<td>" . $row['Remark'] . "</td>";
										echo "<td>" . $row['TS'] . "</td>";
                                        echo "<td>";
                                           // echo '<a href="admin-prog-modal-data-read.php?ItemID='. $row['ItemID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                           // echo '<a href="admin-prog-modal-data-update.php?ItemID='. $row['ItemID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                           // echo '<a href="admin-prog-modal-data-delete.php?ItemID='. $row['ItemID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>

	
	
	
<!--- Start Footer -->
	<footer>
		<?php include 'includes/footer.php'; ?>
	</footer>
	<!--- End of Footer -->

<!--- Script Source Files -->
  
<!--- End of Script Source Files -->

</body>
</html>
