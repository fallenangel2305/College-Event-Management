<?php
// Check existence of ItemID parameter before processing further
if(isset($_GET["ItemID"]) && !empty(trim($_GET["ItemID"]))){
    // Include config file
    include('security.php');
    
    // Prepare a select statement
    $sql = "SELECT * FROM `itemdetails` WHERE ItemID = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["ItemID"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $ItemName = $row["ItemName"];
                $Gender = $row["Gender"];
                $Type = $row["Type"];
				$Participants = $row["Participants"];
				$Pinnany = $row["Pinnany"];
				$Duration = $row["Duration"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>ItemName</label>
                        <p><b><?php echo $row["ItemName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["Gender"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Participants</label>
                        <p><b><?php echo $row["Participants"]; ?></b></p>
                    </div>
					<div class="form-group">
                        <label>Pinnany</label>
                        <p><b><?php echo $row["Pinnany"]; ?></b></p>
                    </div>
					<div class="form-group">
                        <label>Duration (min)</label>
                        <p><b><?php echo $row["Duration"]; ?></b></p>
                    </div>
					<p><a href="admin.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
