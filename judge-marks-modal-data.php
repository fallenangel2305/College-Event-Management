<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$ItemID = (isset($_POST['ItemID']) ? $_POST['ItemID'] : '');
$ItemName = (isset($_POST['ItemName']) ? $_POST['ItemName'] : '');
$Reg_No = (isset($_POST['Reg_No']) ? $_POST['Reg_No'] : '');
$Chest_No = (isset($_POST['Chest_No']) ? $_POST['Chest_No'] : '');
$ISpresent = (isset($_POST['ISpresent']) ? $_POST['ISpresent'] : '');
$Mark1 = (isset($_POST['Mark1']) ? $_POST['Mark1'] : '');
$Mark2 = (isset($_POST['Mark2']) ? $_POST['Mark2'] : '');
$Mark3 = (isset($_POST['Mark3']) ? $_POST['Mark3'] : '');
$Total = (isset($_POST['Total']) ? $_POST['Total'] : '');
$Grade = (isset($_POST['Grade']) ? $_POST['Grade'] : '');
$Remark = (isset($_POST['Remark']) ? $_POST['Remark'] : '');

$ItemID_err = "";
$ItemName_err = "";
$Reg_No_err = "";
$Chest_No_err = "";
$ISpresent_err = "";
$Mark1_err = "";
$Mark2_err = "";
$Mark3_err = "";
$Total_err = "";
$Grade = "";
$Remark_err = "";
 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate ItemID
    $input_ItemID = trim($_POST["ItemID"]);
    if(empty($input_ItemID)){
        $ItemID_err = "Please enter a ItemID.";
    }  else{
        $ItemID = $input_ItemID;
    }
    
    // Validate ItemName
    $input_ItemName = trim($_POST["ItemName"]);
    if(empty($input_ItemName)){
        $ItemName_err = "Please enter a ItemName.";     
    } else{
        $ItemName = $input_ItemName;
    }
    
    // Validate Reg_No
    $input_Reg_No = trim($_POST["Reg_No"]);
    if(empty($input_Reg_No)){
        $Reg_No_err = "Please enter the Reg_No.";     
    } else{
        $Reg_No = $input_Reg_No;
    }
    
	// Validate Chest_No
    $input_Chest_No = trim($_POST["Chest_No"]);
    if(empty($input_Chest_No)){
        $Chest_No_err = "Please enter the number of Chest_No.";     
    } else{
        $Chest_No = $input_Chest_No;
    }
	
	// Validate ISpresent
    $input_ISpresent = trim($_POST["ISpresent"]);
    if(empty($input_ISpresent)){
        $ISpresent_err = "Please enter the number of ISpresent.";     
    } else{
        $ISpresent = $input_ISpresent;
    }
	
	// Validate Mark1
    $input_Mark1 = trim($_POST["Mark1"]);
    if(empty($input_Mark1)){
        $Mark1_err = "Please enter the Mark1.";     
    } else{
        $Mark1 = $input_Mark1;
    }
	
	// Validate Mark2
    $input_Mark2 = trim($_POST["Mark2"]);
    if(empty($input_Mark2)){
        $Mark2_err = "Please enter the Mark2.";     
    } else{
        $Mark2 = $input_Mark2;
    }
	
	// Validate Mark3
    $input_Mark3 = trim($_POST["Mark3"]);
    if(empty($input_Mark3)){
        $Mark3_err = "Please enter the Mark3.";     
    } else{
        $Mark3 = $input_Mark3;
    }
	
	// Validate Total
    $input_Total = trim($_POST["Total"]);
    if(empty($input_Total)){
        $Total_err = "Please enter the Total.";     
    } else{
        $Total = $input_Total;
    }
	
	// Validate Grade
    $input_Grade = trim($_POST["Grade"]);
    if(empty($input_Grade)){
        $Grade_err = "Please enter the Grade.";     
    } else{
        $Grade = $input_Grade;
    }
	
	// Validate Remark
    $input_Remark = trim($_POST["Remark"]);
    if(empty($input_Remark)){
        $Remark_err = "Please enter the Remark.";     
    } else{
        $Remark = $input_Remark;
    }
	
	
	
    // Check input errors before inserting in database
    if(empty($ItemID_err) && empty($ItemName_err) && empty($Reg_No_err) && empty($Chest_No_err) && empty($ISpresent_err) && empty($Mark1_err) && empty($Mark2_err) && empty($Mark3_err) && empty($Total_err) && empty($Grade_err) && empty($Remark_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tabulation (ItemID, ItemName, Reg_No, Chest_No, ISpresent, Mark1, Mark2, Mark3, Total, Grade, Remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss",$param_ItemID, $param_ItemName,  $param_Reg_No,
			$param_Chest_No, $param_ISpresent, $param_Mark1, 
			$param_Mark3,
			$param_Mark3,
			$param_Total,
			$param_Grade, 
			$param_Remark
			);
            
            // Set parameters
            
            $param_ItemID = $ItemID;
			$param_ItemName = $ItemName;
            $param_Reg_No = $Reg_No;
            $param_Chest_No = $Chest_No;
			$param_ISpresent = $ISpresent;
            $param_Mark1 = $Mark1;
            $param_Mark2 = $Mark2;
            $param_Mark3 = $Mark3;
            $param_Total = $Total;
            $param_Grade = $Grade;
            $param_Remark = $Remark;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: judge.php");
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
                    <h2 class="mt-5">Create Program</h2>
                    <p>Please fill this form and submit to add marks to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<div class="form-group">
                            <label>Item ID</label>
                            <input type="text" name="ItemID" class="form-control <?php echo (!empty($ItemID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemID; ?>">
                            <span class="invalid-feedback"><?php echo $ItemID_err;?></span>
                        </div>
						
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="ItemName" class="form-control <?php echo (!empty($ItemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemName; ?>">
                            <span class="invalid-feedback"><?php echo $ItemName_err;?></span>
                        </div>
                       <div class="form-group">
                            <label>Reg No</label>
                            <input type="text" name="Reg_No" class="form-control <?php echo (!empty($Reg_No_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Reg_No; ?>">
                            <span class="invalid-feedback"><?php echo $Reg_No_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Chest No</label>
                            <input type="text" name="Chest_No" class="form-control <?php echo (!empty($Chest_No_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Chest_No; ?>">
                            <span class="invalid-feedback"><?php echo $Chest_No_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Attendance</label>
                            <input type="text" name="ISpresent" class="form-control <?php echo (!empty($ISpresent_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ISpresent; ?>">
                            <span class="invalid-feedback"><?php echo $ISpresent_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Mark 1</label>
                            <input type="text" name="Mark1" class="form-control <?php echo (!empty($Mark1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mark1; ?>">
                            <span class="invalid-feedback"><?php echo $Mark1_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Mark 2</label>
                            <input type="text" name="Mark2" class="form-control <?php echo (!empty($Mark2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mark2; ?>">
                            <span class="invalid-feedback"><?php echo $Mark2_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Mark 3</label>
                            <input type="text" name="Mark3" class="form-control <?php echo (!empty($Mark3_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Mark3; ?>">
                            <span class="invalid-feedback"><?php echo $Mark3_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Total</label>
                            <input type="text" name="Total" class="form-control <?php echo (!empty($Total_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Total; ?>">
                            <span class="invalid-feedback"><?php echo $Total_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Grade</label>
                            <input type="text" name="Grade" class="form-control <?php echo (!empty($Grade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Grade; ?>">
                            <span class="invalid-feedback"><?php echo $Grade_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Remark</label>
                            <input type="text" name="Remark" class="form-control <?php echo (!empty($Remark_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Remark; ?>">
                            <span class="invalid-feedback"><?php echo $Remark_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="judge.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>