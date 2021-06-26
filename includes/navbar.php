
<?php

// various stuff to determine if use is logged in...
?>

<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><h1>College Event Management</h1></a> <button class="navbar-toggler" data-target="#navbarResponsive" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
				<?php if(!empty($_SESSION['username'])) { //  determine they're logged  ?>
					<li class="nav-item">
						<a class="nav-link <?php if($page =='home'){echo 'active';}?>" href="index.php">Home</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link <?php if($page =='contact-us'){echo 'active';}?>" href="contact-us.php">Contact Us</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link <?php if($page == $_SESSION['role']){echo 'active';}?>" href="<?php echo $_SESSION['role']; ?>.php">My Profile</a>
					</li>
					
					<li class="login">
						<a class="nav-link <?php if($page =='login'){echo 'active';}?>" href="logout.php">Logout</a>
					</li>
				<?php } else { ?>  
					<li class="nav-item">
						<a class="nav-link <?php if($page =='home'){echo 'active';}?>" href="index.php">Home</a>
					</li>
				    <li class="nav-item">
						<a class="nav-link <?php if($page =='result'){echo 'active';}?>" href="result.php">Result</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php if($page =='contact-us'){echo 'active';}?>" href="contact-us.php">Contact Us</a>
					</li>
					<li class="login">
						<a class="nav-link <?php if($page =='login'){echo 'active';}?>" href="login.php">Login</a>
					</li>
				 <?php } ?>
				</ul>
			</div>
		</div>
</nav>