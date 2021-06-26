<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$RegNo = (isset($_POST['RegNo']) ? $_POST['RegNo'] : '');
$StaffID = (isset($_POST['StaffID']) ? $_POST['StaffID'] : '');
$Remark = (isset($_POST['Remark']) ? $_POST['Remark'] : '');


$RegNo_err = "";
$StaffID_err = "";
$Remark_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate RegNo
    $input_Reg_No = trim($_POST["RegNo"]);
    if(empty($input_Reg_No)){
        $RegNo_err = "Please enter a RegNo.";
    } elseif(!ctype_digit($input_Reg_No)){
        $RegNo_err = "Please enter a integer value.";
    }  else{
        $RegNo = $input_Reg_No;
    }
	
	// Validate StaffID
    $input_StaffID = trim($_POST["StaffID"]);
    if(empty($input_StaffID)){
        $StaffID_err = "Please enter a StaffID.";
    } elseif(!ctype_digit($input_StaffID)){
        $StaffID_err = "Please enter a integer value.";
    }  else{
        $StaffID = $input_StaffID;
    }
    
    
    // Validate Remark
    $input_Remark = trim($_POST["Remark"]);
    if(empty($input_Remark)){
        $Remark_err = "Please enter the Remark.";     
    } else{
        $Remark = $input_Remark;
    }
    
	
    // Check input errors before inserting in database
    if(empty($RegNo_err) && empty($StaffID_err) && empty($Remark_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO complaints (RegNo, StaffID, Remark) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_Reg_No, $param_StaffID, $param_Remark);
            
            // Set parameters
           
            $param_Reg_No = $RegNo;
            $param_StaffID = $StaffID;
            $param_Remark = $Remark;
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: student.php");
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
                    <h2 class="mt-5">Register a Complaint to Admin</h2>
                    <p>Please fill this form for any complaints.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
						<div class="form-group">
                            <label>Register No</label>
                            <input type="text" name="RegNo" class="form-control <?php echo (!empty($RegNo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $RegNo; ?>">
                            <span class="invalid-feedback"><?php echo $RegNo_err;?></span>
                        </div>
						
						<div class="form-group">
                            <label>Staff ID</label>
                            <input type="text" name="StaffID" class="form-control <?php echo (!empty($StaffID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $StaffID; ?>">
                            <span class="invalid-feedback"><?php echo $StaffID_err;?></span>
                        </div>
						
                       <div class="form-group">
                            <label>Message</label>
                            <input type="text" name="Remark" class="form-control <?php echo (!empty($Remark_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Remark; ?>">
                            <span class="invalid-feedback"><?php echo $Remark_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="student.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>