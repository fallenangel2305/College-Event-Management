<?php
// Include config file
include('security.php');
 
// Define variables and initialize with empty values

$username = (isset($_POST['username']) ? $_POST['username'] : '');
$email = (isset($_POST['email']) ? $_POST['email'] : '');
$password = (isset($_POST['password']) ? $_POST['password'] : '');
$user_type = (isset($_POST['user_type']) ? $_POST['user_type'] : '');

$username_err = "";
$email_err = "";
$password_err = "";
$user_type_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	// Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter the username.";     
    } else{
        $username = $input_username;
    }
	
	// Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter the email.";     
    } else{
        $email = $input_email;
    }
	
	// Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter the password.";     
    } else{
        $password = $input_password;
    }
    
	// Validate UserType
    $input_user_type = trim($_POST["user_type"]);
    if(empty($input_user_type)){
        $user_type_err = "Please enter the usertype.";     
    } else{
        $user_type = $input_user_type;
    }
	
	
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($user_type_err)){
        // Prepare an insert statement
		
        $sql = "INSERT INTO profilereg (username, email, password, user_type) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $param_user_type);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = $password;
			$param_user_type = $user_type;
           
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: login.php");
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
	
	<?php include 'includes/head.php'; ?>
	<?php include 'includes/scripts.php'; ?>
	

<body>
	<!--- Navigation 
	
		 <?php $page = 'home'; include 'includes/navbar.php'; ?> -->
	
	<!--- End Navigation -->
	
	<!--- Start Jumbotron -->
	<div class="jumbotron">
	
		<div class="container">
			
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-5 bg-light mt-5 px-0">
						<h3 class="text-center text-light bg-success p-3">
						Registration</h3>
						<form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="p-4">
							<div class="form-group">
								<input type="text" name="username" class="form-control form-control-lg"
								 placeholder="username" required>
							</div>
							<div class="form-group">
								<input type="text" name="email" class="form-control form-control-lg"
								 placeholder="email" required>
							</div>
							<div class="form-group">
								<input type="text" name="password" class="form-control form-control-lg"
								 placeholder="password" required>
							</div>
							
							<div class="form-group lead">
								<label for="user_type">I am a :</label>
								
								 <input type="radio" name="user_type" value="admin" 
								 class="custom-radio" required>&nbsp;Admin |
								 
								 <input type="radio" name="user_type" value="student" 
								 class="custom-radio" required>&nbsp;Student 
								 
								 <input type="radio" name="user_type" value="judge" 
								 class="custom-radio" required>&nbsp;Judge 
								 
							<div class="form-group">
								<input type="hidden" name="Status" class="form-control form-control-lg"
								 value='pending' required>
							</div>
							
								 <div class="form-group">
									<input type="submit" name="login" class="btn btn-success btn-block">
									<a href="login.php">Back</a>
								 </div>
								 
							</div>
						</form>
					</div>
				</div>
			</div>
			
			
		</div><!--- End Container -->
	</div>
	<!--- End Jumbotron -->
	
	
	
	
		<!--- Start Footer -->
	<footer>
		<?php include 'includes/footer.php'; ?>
	</footer>
	<!--- End of Footer -->

<!--- Script Source Files -->
  
<!--- End of Script Source Files -->

</body>
</html>