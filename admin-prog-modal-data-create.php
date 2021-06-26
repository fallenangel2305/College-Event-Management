<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$ItemName = (isset($_POST['ItemName']) ? $_POST['ItemName'] : '');
$Gender = (isset($_POST['Gender']) ? $_POST['Gender'] : '');
$Type = (isset($_POST['Type']) ? $_POST['Type'] : '');
$Participants = (isset($_POST['Participants']) ? $_POST['Participants'] : '');
$Pinnany = (isset($_POST['Pinnany']) ? $_POST['Pinnany'] : '');
$Duration = (isset($_POST['Duration']) ? $_POST['Duration'] : '');

$ItemName_err = "";
$Gender_err = "";
$Type_err = "";
$Participants_err = "";
$Pinnany_err = "";
$Duration_err = "";
 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate ItemName
    $input_ItemName = trim($_POST["ItemName"]);
    if(empty($input_ItemName)){
        $ItemName_err = "Please enter a ItemName.";
    }  else{
        $ItemName = $input_ItemName;
    }
    
    // Validate Gender
    $input_Gender = trim($_POST["Gender"]);
    if(empty($input_Gender)){
        $Gender_err = "Please enter a Gender.";     
    } else{
        $Gender = $input_Gender;
    }
    
    // Validate Type
    $input_Type = trim($_POST["Type"]);
    if(empty($input_Type)){
        $Type_err = "Please enter the Type.";     
    } else{
        $Type = $input_Type;
    }
    
	// Validate Participants
    $input_Participants = trim($_POST["Participants"]);
    if(empty($input_Participants)){
        $Participants_err = "Please enter the number of participants.";     
    } else{
        $Participants = $input_Participants;
    }
	
	// Validate Pinnany
    $input_Pinnany = trim($_POST["Pinnany"]);
    if(empty($input_Pinnany)){
        $Pinnany_err = "Please enter the number of pinnany.";     
    } else{
        $Pinnany = $input_Pinnany;
    }
	
	// Validate Duration
    $input_Duration = trim($_POST["Duration"]);
    if(empty($input_Duration)){
        $Duration_err = "Please enter the duration (min).";     
    } else{
        $Duration = $input_Duration;
    }
	
    // Check input errors before inserting in database
    if(empty($ItemName_err) && empty($Gender_err) && empty($Type_err) && empty($Participants_err) && empty($Pinnany_err) && empty($Duration_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO itemdetails (ItemName, Gender, Type, Participants, Pinnany, Duration) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_ItemName, $param_Gender, $param_Type, $param_Participants, $param_Pinnany, $param_Duration);
            
            // Set parameters
            $param_ItemName = $ItemName;
            $param_Gender = $Gender;
            $param_Type = $Type;
			$param_Participants = $Participants;
            $param_Pinnany = $Pinnany;
            $param_Duration = $Duration;
            
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
                    <h2 class="mt-5">Create Program</h2>
                    <p>Please fill this form and submit to add program record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="ItemName" class="form-control <?php echo (!empty($ItemName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ItemName; ?>">
                            <span class="invalid-feedback"><?php echo $ItemName_err;?></span>
                        </div>
                       <div class="form-group">
                            <label>Gender</label>
                            <input type="text" name="Gender" class="form-control <?php echo (!empty($Gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Gender; ?>">
                            <span class="invalid-feedback"><?php echo $Gender_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="Type" class="form-control <?php echo (!empty($Type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Type; ?>">
                            <span class="invalid-feedback"><?php echo $Type_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Participants</label>
                            <input type="text" name="Participants" class="form-control <?php echo (!empty($Participants_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Participants; ?>">
                            <span class="invalid-feedback"><?php echo $Participants_err;?></span>
                        </div>
						<div class="form-group">
                            <label>Pinnany</label>
                            <input type="text" name="Pinnany" class="form-control <?php echo (!empty($Pinnany_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Pinnany; ?>">
                            <span class="invalid-feedback"><?php echo $Pinnany_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" name="Duration" class="form-control <?php echo (!empty($Duration_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Duration; ?>">
                            <span class="invalid-feedback"><?php echo $Duration_err;?></span>
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