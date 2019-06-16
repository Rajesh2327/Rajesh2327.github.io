<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
include("includes/functions.php");
session_start();
$msg='';$msg2='';
$fname='';
if(isset($_POST['submit']))
{
	$fname=$_POST['name'];
	$password=$_POST['pass'];
	if(empty($fname))
	{
		$msg='<div class="error">Please enter Username</div>';
	}
	else if(empty($password))
	{
		$msg2='<div class="error">Please enter your password</div>';
	}
	else 
	{
		$pass=mysqli_query($con,"SELECT password FROM admin WHERE name='$fname'");
		$pass_w=mysqli_fetch_array($pass);
		$dpass=$pass_w['password'];
		if($password!=$dpass)
		{
			$msg2='<div class="error">Password is Wrong</div>';
		}
		else
		{
			$_SESSION['name']=$fname;
		
			header("location:admin-panel.php");
		}
	}

}

?>
<title>Admin Login</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
	<link href="css/style.css" rel="stylesheet" type="text/css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	#body-bg
	{
		background: url("images/admin.jpg") center no-repeat fixed;
	}
</style>
<body id='body-bg'>
	<section id="nav-bar">
<nav class="navbar navbar-expand-lg ">
  <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars" aria-hidden="true"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Sign up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
  </div>
</nav>
</section>
	<div class='container'>
		<div class='login-form  offset-md-8 col-md-4'>
			<div class='jumbotron' style='margin-top: 50px; padding-top: 20px; padding-bottom: 10px;'>
				<h2 align='center' style='color:#a517ba'>Admin Login </h2></br>
				<form method='post'>
					<div class='form-group'>
						<label>Username:</label>
						<input type='text' name='name' class='form-control' placeholder='Enter Username' value='<?php echo $fname; ?>' />
					<?php echo $msg; ?>
					</div>
					<div class='form-group'>
						<label>Password:</label>
						<input type='password' name='pass' placeholder='Enter Your Password' class='form-control' />
						<?php echo $msg2; ?>

					</div>
					<div class='form-group'>
						<center><input type='submit' name='submit' value='Login' class='btn btn-success'></br>
					</div>
				</form>
			</div>
			
		</div>
		
	</div>
</body>
</html>