<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
include("includes/functions.php");
$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname='';$lastname='';$email='';$date='';$image='';
$id=$_GET['user'];
if(isset($id))
{
$result=mysqli_query($con,"SELECT first_name,last_name,dob,mail,img FROM users WHERE id='$id'");
	$retrive=mysqli_fetch_array($result);//fetching data from database
	$name=$retrive['first_name'];
	$last=$retrive['last_name'];
	$dob=$retrive['dob'];
	$mail=$retrive['mail'];
	$image=$retrive['img'];
}
if(isset($_POST['submit']))
{
	$firstname=$_POST['fname'];
	$lastname=$_POST['lname'];
	$email=$_POST['mail2'];
	$date=$_POST['dob2'];
	$image=$_POST['img2'];
	if(strlen($firstname)<3)
	{
		$msg="<div class='error'>First name must contain atleast 3 characters</div>";
	}

	else if(strlen($lastname)<3)
	{
		$msg2="<div class='error'>Last name must contain atleast 3 characters</div>";
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$msg3="<div class='error'>Enter Valid Email</div>";
	}
	else if(empty($date))
	{
		$msg4="<div class='error'>Please Enter Your DOB</div>";
	}
		else if($image=='')
	{
		$msg5="<div class='error'>Please Upload Your Profile Image</div>";
	}
	else
	{
	
		mysqli_query($con,"UPDATE users SET first_name='$firstname',last_name='$lastname',mail='$email',dob='$date',img='$image' WHERE id='$id'");//update user deatails to database
	echo "<script type=\"text/javascript\">window.alert('User details updated Successfully');
window.location.href = '/project/admin-panel.php';</script>"; 
exit;
		$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
			
	}


}
?>
	<title>Update User</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
	<link href="css/style.css" rel="stylesheet" type="text/css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	#body-bg
	{
		background: url("images/update-admin.jpg") center no-repeat fixed;
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
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Sign Up</a>
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
 	<a href='admin-panel.php'><button class='btn btn-danger' style='float:right;'>Back to Admin Panel</button></a>
 	<div class='login-form col-md-4'>

 		
 		<div class='jumbotron'>
 			<h3 align='center' style='color:#a517ba'>Update User Details</h3><br>
 			<?php echo $msg9; ?></br>
 			<form method='post'>
 				<div class="form-group">
 				<label>First Name:</label>
 				<input type='text input-group-text' name='fname' placeholder=" Your First Name" class='form-control' value='<?php echo $name; ?>'>
 				<?php echo $msg; ?>
 			</div>
 			<div class="form-group">
 				<label>Last Name:</label>
 				<input type='text' name='lname' placeholder="Your Last Name" class='form-control' value='<?php echo $last; ?>' >
 				<?php echo $msg2; ?>
 			</div>
 			<div class="form-group">
 				<label>Email:</label>
 				<input type='email' name='mail2' placeholder="Your Email" class='form-control' value='<?php echo $mail; ?>' >
 				<?php echo $msg3; ?>
 			</div>
 			<div class="form-group">
 				<label>Date of Birth:</label>
 				<input type='date' name='dob2' placeholder="" class='form-control' value='<?php echo $dob; ?>' >
 				<?php echo $msg4; ?>
 			</div>
 				<div class="form-group">
 				<label>Profile Image:</label>
 				<input type='file' name='img2' value='<?php echo $image; ?>'/>
 				<?php echo $msg5; ?>
 			</div>
 			<center><input type='submit' value='Update' name='submit' class='btn btn-success' /></center>
 			</form>
 		</div>
 	</div>
 </div>
</body>
</html>