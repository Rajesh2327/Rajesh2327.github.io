<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
include("includes/functions.php");
$id=$_GET['id'];
$msg='';$msg1='';$msg2='';
if(isset($_POST['submit']))
{
	$password=$_POST['pass'];
	$cpassword=$_POST['cpass'];
 	if(empty($password))
	{
		$msg='<div class="error">Please enter your New password</div>';
	}
	else if(strlen($password)<5)
	{
		$msg="<div class='error'>Password must contain atleast 5 characters</div>";
	}
	else if(empty($cpassword))
	{
		$msg2='<div class="error">Re-enter your password</div>';
	}
	else if ($password!=$cpassword)
{
	$msg2="<div class='error'> Password does not match</div>";
}
else
{
	$pass=md5($password);
	mysqli_query($con,"UPDATE users SET password='$pass' WHERE id='$id'");
	echo "<script type=\"text/javascript\">window.alert('Password Changed Successfully');
window.location.href = '/project/index.php';</script>";
	$msg1="<div class='success'>Password Changed Successfully</div>";
}

}

?>
<title>Change Password</title>
<meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
<link href="css/style.css" rel="stylesheet" type="text/css" >
<style type="text/css">

	#body-bg
	{
		background-color: #efefef;
	}

	
</style>
</head>
<body id='body-bg'>
	<div class='container' style='background-color:#fff; margin-top:20px; padding-top: 50px; margin-bottom: 20px;width: 1200px;height:550px;'>
		<a href='profile.php'><button class='btn btn-outline-primary' style='float:right;'>Back</button></a><br><br>
		<div class='col-md-4 offset-md-4'> 
			<div class='box'>
		<h2 align='center' style='color:#fff'>Change Password</h2>
		<center><?php echo $msg1; ?></center>
		<br>
		<form method='post'>
			<div class='form-group'>
				<label>New Password:</label>
				<input type='Password' name='pass' placeholder='Enter New Password' class='form-control'>
				<?php echo $msg; ?>
			</div>
			<form method='post'>
			<div class='form-group'>
				<label>Re-enter Password:</label>
				<input type='Password' name='cpass' placeholder='Re-enter Password' class='form-control'>
				<?php echo $msg2; ?>
			</div>

			<center><button class='btn btn-primary' name='submit'>submit</button></center>
		</form>
	</div>		
	</div>
</div>
	
</body>
</html>

