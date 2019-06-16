<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
include("includes/functions.php");
$msg='';$msg1='';$msg2='';$msg3='';$msg4='';
$email='';$date='';$password='';$cpassword='';
if(isset($_POST['submit']))
{
$email=$_POST['email'];
$date=$_POST['dob'];
$password=$_POST['pass'];
$cpassword=$_POST['cpass'];
if(empty($email))
 {
	$msg="<div class='error'>Please Enter Your Email</div>";
}
else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
	$msg="<div class='error'>Please Enter Valid Email</div>";
}

 else if(empty($date))

{
  $msg2="<div class='error'>Please enter Your Date of Birth</div>";
}
 else if(empty($password))
{
  $msg3="<div class='error'>Please enter Your New Password</div>";
}
	else if(strlen($password)<5)
	{
		$msg3="<div class='error'>Password must contain atleast 5 characters</div>";
	}

 else if(empty($cpassword))
{
  $msg4="<div class='error'>Please Re-enter Your  Password</div>";
}
else if ($password!=$cpassword)
{
	$msg4="<div class='error'> Password does not match</div>";
}
else if(email_exists($email,$con))
	{
       $result=mysqli_query($con,"SELECT dob FROM users WHERE mail='$email'");
       $retrive=mysqli_fetch_array($result);
       $DOB=$retrive['dob'];
       if($date==$DOB)
       {
       $pass=md5($password);
       mysqli_query($con,"UPDATE users SET password='$pass'");
       echo "<script type=\"text/javascript\">window.alert('Password Changed Successfully');
window.location.href = '/project/index.php';</script>";
       $msg1="<div class='success'> Password changed successfully</div>";
       }
       else
       {
       	$msg2="<div class='error'>Please enter correct Date of Birth</div>";
       }
	}
	else
	{
		$msg="<div class='error'> Email does not Exists</div>";
	}
}
?>
	<title>Forgot Password</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
</head>
<style type="text/css">
	#body-bg
	{
		background: url("images/forgot.jpg") center no-repeat fixed;
	}
</style>
<body id='body-bg' >
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
 	<div class='login-form col-md-4 offset-md-4'>
 		
 		<div class='jumbotron' style='margin-top: 20px;padding-top: 20px; padding-bottom: 30px;'>
 			<h3 align='center' style='color:#a517ba'>Forgot Password</h3><br>
 			<?php echo $msg1; ?>
 			</br>
 			<form method='post'>
 				<div class='form-group'>
 					<label>Email: </label>
 					<input type='email' name='email'  value="<?php echo $email;?>" class='form-control' placeholder='Enter Your Email'>
 					<?php echo $msg; ?>
 				</div>
 				<form method='post'>
 				<div class='form-group'>
 					<label>Date Of Birth: </label>
 					<input type='Date' name='dob' value="<?php echo $date;?>"  class='form-control'>
 					<?php echo $msg2; ?>
 				</div>
 				<form method='post'>
 				<div class='form-group'>
 					<label>New Password: </label>
 					<input type='Password' name='pass'  value="<?php echo $password;?>"  class='form-control' placeholder='Enter Your New Password'>
 					<?php echo $msg3; ?>

 				</div>
 				<form method='post'>
 				<div class='form-group'>
 					<label>Re-enter Password: </label>
 					<input type='password' name='cpass' value="<?php echo $cpassword;?>"  class='form-control' placeholder='Re-enter New password'>
 					<?php echo $msg4; ?>
 				</div>
 				<center><button class='btn btn-success' name='submit'>Submit</button></center>
 				<center><a href='index.php'>Back to Login</a></center>
 			</form>
 			 			
 		</div>
 		

 		
 	</div>
 </div>
</body>
</html>