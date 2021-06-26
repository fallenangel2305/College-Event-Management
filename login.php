<?php
include('security.php');

$msg="";
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$userType = $_POST['userType'];

    $sql = "SELECT * FROM `profilereg` WHERE username=?  AND email=? AND password=? AND user_type=?";
	$stmt = $conn->prepare($sql);
	
	$stmt->bind_param("ssss",$username,$email,$password,$userType);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	
	session_regenerate_id();
	$_SESSION['username'] = $row['username'];
	$_SESSION['role'] = $row['user_type'];
	
	if($result->num_rows==1 && $_SESSION['role']=="student"){
		header('location:student.php');
	}
	else if($result->num_rows==1 && $_SESSION['role']=="judge"){
		header('location:judge.php');
	}
	else if($result->num_rows==1 && $_SESSION['role']=="admin"){
		header('location:admin.php');
	}
	else{
		$msg = "Username or Email id or Password is Incorrect!";
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
	
	<?php include 'includes/head.php'; ?>
	<?php include 'includes/scripts.php'; ?>
	<?php include 'code.php'; ?>

<body>
	<!--- Navigation -->
	
		<?php $page = 'home'; include 'includes/navbar.php'; ?>
	
	<!--- End Navigation -->
	
	<!--- Start Jumbotron -->
	<div class="jumbotron">
	
		<div class="container">
			
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-5 bg-light mt-5 px-0">
						<h3 class="text-center text-light bg-success p-3">
						LOGIN</h3>
						<form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="p-4">
							<div class="form-group">
								<input type="text" name="username" class="form-control form-control-lg"
								 placeholder="username" required>
							</div>
							<div class="form-group">
								<input type="email" name="email" class="form-control form-control-lg"
								 placeholder="email" required>
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control form-control-lg"
								 placeholder="password" required>
							</div>
							<div class="form-group lead">
								<label for="userType">I am a :</label>
								<input type="radio" name="userType" value="student" 
								 class="custom-radio" required>&nbsp;Student |
								 
								 <input type="radio" name="userType" value="judge" 
								 class="custom-radio" required>&nbsp;Judge |
								 
								 <input type="radio" name="userType" value="admin" 
								 class="custom-radio" required>&nbsp;Admin 
								 
								 <div class="form-group">
									<input type="submit" name="login" class="btn btn-success btn-block">
									<a href="registration.php">Create new account</a>
								 </div>
								 <h5 class="text-danger text-center"><?= $msg; ?></h5>
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