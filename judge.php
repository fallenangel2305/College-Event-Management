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


<?php
	session_start();
	
	if(!isset($_SESSION['username']) || $_SESSION['role']!="judge"){
		header("location:index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

	<?php include 'includes/head.php'; ?>
	<?php include 'includes/scripts.php'; ?>

<body>
	<!--- Navigation -->
	
		<?php $page = 'home'; include 'includes/navbar.php'; ?>
	
	<!--- End Navigation -->
		
	

	
	<div class="col-12 mt-3">
	<div class="container-fluid">
	
	<div class="row">
	

	  
	  
	  <div class="col-md-4">
		<div class="text-left"  >
						<div class="container">
						
												<!-- Button trigger modal -->


				<!-- Program-List Modal -->
				<div class="modal fade" id="program-list" tabindex="-1" aria-labelledby="program-list" aria-hidden="true">
				  <div class="modal-dialog modal-xl">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Program List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						
						<?php include 'student-prog-modal-data.php'; ?>	
						
					  </div>
					  <div class="modal-footer">
						
						
						<button type="button"  onclick="window.print()" class="btn btn-primary">Print</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						
					  </div>
					</div>
				  </div>
				</div>
				
				
				<!-- Judge Modal -->
				<div class="modal fade" id="judge-marks" tabindex="-1" aria-labelledby="judge-marks" aria-hidden="true">
				  <div class="modal-dialog modal-xl">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Judges List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
							
						<a href= 'judge-marks-modal-data.php'> ADD Marks </a>	
						
					  </div>
					  <div class="modal-footer">
						
						
						<button type="button"  onclick="window.print()" class="btn btn-primary">Print</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						
					  </div>
					</div>
				  </div>
				</div>
				
				
				
				
				<!-- Complaints Modal -->
				<div class="modal fade" id="complaints-admin" tabindex="-1" aria-labelledby="complaints-admin" aria-hidden="true">
				  <div class="modal-dialog modal-xl">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Complaints List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
							
						<?php include 'admin-complaint-modal-data.php'; ?>	
						
					  </div>
					  <div class="modal-footer">
						
						
						<button type="button"  onclick="window.print()" class="btn btn-primary">Print</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						
					  </div>
					</div>
				  </div>
				</div>
				
								  
			  <table class="table">
				<thead>
				  <tr>
					<th>
					
					
					<div class="container">
								<div class="card>
									<h2>Program List</h2>
								</div>
								<div class="card">
									<div class="card-body">
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#program-list">
										  Program List
										</button>
									</div>
								</div>
						</div>
						
					
					
					</th>
					
				  </tr>
				</thead>
				<thead>
				  <tr>
					<th>
						
						
						<div class="container">
								<div class="card>
									<h2>Judge List</h2>
								</div>
								<div class="card">
									<div class="card-body">
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#judge-marks">
										  Mark Entering 
										</button>
									</div>
								</div>
						</div>
						</div>
						
						
					</th>
				  </tr>
				</thead>
				
				
				  <tr>
					<th>
					
						<div class="container">
								<div class="card>
									<h2>Complaints List</h2>
								</div>
								<div class="card">
									<div class="card-body">
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#complaints-admin">
										  Complaints
										</button>
									</div>
								</div>
						</div>
						</div>
					
					</th>
				  </tr>
				</thead>
			  </table>
			  
			</div>

			
			</div>
		</div>
		
		<div class="col-md-8">
	  
		<div class="text-right"  >
				<h2><?= $_SESSION['role']; ?></h2>
				<h5><?= $_SESSION['username']; ?></h5>
				
		</div>
	  </div>
	
	  
	  </div>
	   
	</div>
	
	</div>
	</div>
	
	</br></br></br></br></br></br></br></br></br></br>
		
<!--- Start Footer -->
	<footer>
		<?php include 'includes/footer.php'; ?>
	</footer>
	<!--- End of Footer -->

<!--- Script Source Files -->
  
<!--- End of Script Source Files -->

</body>
</html>

