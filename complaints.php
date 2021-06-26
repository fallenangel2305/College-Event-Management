<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	
</head>

<body>
	<!--- Navigation -->
	<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
		<?php $page = 'complaints'; include 'includes/navbar.php'; ?>
	</nav>
	<!--- End Navigation -->
	
	<div class="row mt-5">
		<div class="col-12 text-center mt-1">
			
			
		</div>
		
	</div>


<?php 
if(isset($_POST['submit'])){
    if(mail($_POST['email'],$_POST['subject'],$_POST['message'])){
		echo"
		<script> 
			Swal.fire({
			  icon: 'success',
			  title: 'Successfully sent',
			})
		</script>";
	}else{
		echo"
		<script> 
			Swal.fire({
			  icon: 'error',
			  title: 'Failed',
			})
		</script>";
		
	}
  }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="http://dinus.org/assets/mail/mailtip.css"/>
<script type="text/javascript" src="http://dinus.org/assets/mail/jquery.mailtip.js"></script>

<div class="container">
	<div class="row">
		<center><h2>Form Complaints Or Suggestions Via E-mail</h2></center>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12 row" style="padding:0px;margin-bottom:10px;">
                            
                            <div class="col-md-2">
                                <img src="http://dinus.org/img/fakultas/FIK/cs/cs.svg">
                                <div style="margin-left:30px;">
                                    <img src="http://dinus.org/img/fakultas/FIK/cs/cs.png" width="70px" height="70px" class="img-circle" style="border:3px solid #052C52;">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <hr>
                                <p style="padding-left:55px;font-size:1.3em;"><strong>Admin</strong></p>
                                
                            </div>
                            
                            
                        </div>

                        <form action="" method="post">
                            <table class="table">
                                <tr>
                                    <td>
                                        <input type="hidden" name="email" class="form-control"  id="mailtip2" value="naasalanbarret9@gmail.com">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" name="subject" type="text" placeholder="Subject">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea class="form-control" name="message" rows="4" placeholder="Message text . . ."></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" class="btn btn-danger btn-sm" style="width: 100%;"><i class="fa fa-envelope-o" style="padding-right: 5px;"></i> Send</button>
                                    </td>
                                </tr>
                            </table>

                        </form>
                    </div>
                </div>

            </div>

        </div>
	</div>
</div>


	
	<!--- Start Footer -->
	<footer>
		<?php include 'includes/footer.php'; ?>
	</footer>
	<!--- End of Footer -->

<!--- Script Source Files -->
  
  
<!--- End of Script Source Files -->

</body>
</html>