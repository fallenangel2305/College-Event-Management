<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$StaffID = (isset($_POST['StaffID']) ? $_POST['StaffID'] : '');
$ItemID = (isset($_POST['ItemID']) ? $_POST['ItemID'] : '');
$ItemType = (isset($_POST['ItemType']) ? $_POST['ItemType'] : '');

$StaffID_err = "";
$ItemID_err = "";
$ItemType_err = "";

 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate StaffID
    $input_StaffID = trim($_POST["StaffID"]);
    if(empty($input_StaffID)){
        $StaffID_err = "Please enter a StaffID.";
    } elseif(!ctype_digit($input_StaffID)){
        $StaffID_err = "Please enter a integer value.";
    }  else{
        $StaffID = $input_StaffID;
    }
    
    // Validate ItemID
    $input_ItemID = trim($_POST["ItemID"]);
    if(empty($input_ItemID)){
        $ItemID_err = "Please enter a ItemID.";     
    } elseif(!ctype_digit($input_ItemID)){
        $ItemID_err = "Please enter a integer value.";
    } else{
        $ItemID = $input_ItemID;
    }
    
    // Validate ItemType
    $input_ItemType = trim($_POST["ItemType"]);
    if(empty($input_ItemType)){
        $ItemType_err = "Please enter the ItemType.";     
    } else{
        $ItemType = $input_ItemType;
    }
    
	
    // Check input errors before inserting in database
    if(empty($StaffID_err) && empty($ItemID_err) && empty($ItemType_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO judge (StaffID, ItemID, ItemType) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_StaffID, $param_ItemID, $param_ItemType);
            
            // Set parameters
            $param_StaffID = $StaffID;
            $param_ItemID = $ItemID;
            $param_ItemType = $ItemType;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: admin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Add Judge</h2>
                    <p>Please fill this form and submit to add judge record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>StaffID</label>
                            <input type="text" name="StaffID" class="form-control <?php echo (!empty($StaffID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $StaffID; ?>">
                            <span class="invalid-feedback"><?php echo $StaffID_err;?></span>
                        </div>
                       <div class="form-group">
                            <label>ItemID</label>
                            <input type="text" name="ItemID" class="form-control <?php echo (!empty($ItemID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemID; ?>">
                            <span class="invalid-feedback"><?php echo $ItemID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ItemType</label>
                            <input type="text" name="ItemType" class="form-control <?php echo (!empty($ItemType_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemType; ?>">
                            <span class="invalid-feedback"><?php echo $ItemType_err;?></span>
                        </div>
						
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>