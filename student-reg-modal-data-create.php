<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$ItemID = (isset($_POST['ItemID']) ? $_POST['ItemID'] : '');
$ItemName = (isset($_POST['ItemName']) ? $_POST['ItemName'] : '');
$Reg_No = (isset($_POST['Reg_No']) ? $_POST['Reg_No'] : '');
$Name = (isset($_POST['Name']) ? $_POST['Name'] : '');
$Semester = (isset($_POST['Semester']) ? $_POST['Semester'] : '');
$Branch = (isset($_POST['Branch']) ? $_POST['Branch'] : '');
$Type = (isset($_POST['Type']) ? $_POST['Type'] : '');


$ItemID_err = "";
$ItemName_err = "";
$Reg_No_err = "";
$Name_err = "";
$Semester_err = "";
$Branch_err = "";
$Type_err = "";

 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate ItemID
    $input_ItemID = trim($_POST["ItemID"]);
    if(empty($input_ItemID)){
        $ItemID_err = "Please enter a ItemID.";
    } elseif(!ctype_digit($input_ItemID)){
        $ItemID_err = "Please enter a integer value.";
    }  else{
        $ItemID = $input_ItemID;
    }
    
    
    // Validate ItemName
    $input_ItemName = trim($_POST["ItemName"]);
    if(empty($input_ItemName)){
        $ItemName_err = "Please enter the ItemName.";     
    } else{
        $ItemName = $input_ItemName;
    }
    
	// Validate Reg_No
    $input_Reg_No = trim($_POST["Reg_No"]);
    if(empty($input_Reg_No)){
        $Reg_No_err = "Please enter a Reg_No.";     
    } elseif(!ctype_digit($input_Reg_No)){
        $Reg_No_err = "Please enter a integer value.";
    } else{
        $Reg_No = $input_Reg_No;
    }
    
	// Validate Name
    $input_Name = trim($_POST["Name"]);
    if(empty($input_Name)){
        $Name_err = "Please enter the Name.";     
    } else{
        $Name = $input_Name;
    }
	
	// Validate Semester
    $input_Semester = trim($_POST["Semester"]);
    if(empty($input_Semester)){
        $Semester_err = "Please enter a Semester.";     
    } elseif(!ctype_digit($input_Semester)){
        $Semester_err = "Please enter a integer value.";
    } else{
        $Semester = $input_Semester;
    }
	
	// Validate Branch
    $input_Branch = trim($_POST["Branch"]);
    if(empty($input_Branch)){
        $Branch_err = "Please enter the Branch.";     
    } else{
        $Branch = $input_Branch;
    }
	
	// Validate Type
    $input_Type = trim($_POST["Type"]);
    if(empty($input_Type)){
        $Type_err = "Please enter the Type.";     
    } else{
        $Type = $input_Type;
    }
	
    // Check input errors before inserting in database
    if(empty($ItemID_err) && empty($ItemName_err) && empty($Reg_No_err) && empty($Name_err) && empty($Semester_err) && empty($Branch_err) && empty($Type_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO registration (ItemID, ItemName, Reg_No, Name, Semester, Branch, Type) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_ItemID, $param_ItemName, $param_Reg_No, $param_Name, $param_Semester, $param_Branch, $param_Type);
            
            // Set parameters
           
            $param_ItemID = $ItemID;
            $param_ItemName = $ItemName;
            $param_Reg_No = $Reg_No;
            $param_Name = $Name;
            $param_Semester = $Semester;
            $param_Branch = $Branch;
            $param_Type = $Type;
            
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
                    <h2 class="mt-5">Register</h2>
                    <p>Please fill this form and submit to add record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                       <div class="form-group">
                            <label>ItemID</label>
                            <input type="text" name="ItemID" class="form-control <?php echo (!empty($ItemID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemID; ?>">
                            <span class="invalid-feedback"><?php echo $ItemID_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ItemName</label>
                            <input type="text" name="ItemName" class="form-control <?php echo (!empty($ItemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Name; ?>">
                            <span class="invalid-feedback"><?php echo $ItemName_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Reg No</label>
                            <input type="text" name="Reg_No" class="form-control <?php echo (!empty($Reg_No_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Reg_No; ?>">
                            <span class="invalid-feedback"><?php echo $Reg_No_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Name</label>
                            <input type="text" name="Name" class="form-control <?php echo (!empty($Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Name; ?>">
                            <span class="invalid-feedback"><?php echo $Name_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Semester</label>
                            <input type="text" name="Semester" class="form-control <?php echo (!empty($Semester_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Semester; ?>">
                            <span class="invalid-feedback"><?php echo $Semester_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Branch</label>
                            <input type="text" name="Branch" class="form-control <?php echo (!empty($Branch_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Branch; ?>">
                            <span class="invalid-feedback"><?php echo $Branch_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Type</label>
                            <input type="text" name="Type" class="form-control <?php echo (!empty($Type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Type; ?>">
                            <span class="invalid-feedback"><?php echo $Type_err;?></span>
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