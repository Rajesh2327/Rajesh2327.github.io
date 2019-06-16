<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
include("includes/functions.php");//checking database
session_start();
$msg='';$msg2='';$msg3='';$msg4='';$msg5='';$msg6='';$msg7='';$msg8='';$msg9='';
$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
if(isset($_POST['submit']))
{

	$firstname=$_POST['fname'];//Posting values to database
	$lastname=$_POST['lname'];
	$email=$_POST['mail'];
	$date=$_POST['dob'];
	$password=$_POST['pass'];
	$c_password=$_POST['cpass'];
	$image=$_FILES['image']['name'];
	$tmp_image=$_FILES['image']['tmp_name'];
	$size_image=$_FILES['image']['size'];
	$checkbox=isset($_POST['check']);
	//echo $firstname."</br>".$lastname."</br>".$email."</br>".$date."</br>".$password."</br>".$c_password."</br>"// .$image."</br>".$checkbox;
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
	else if(email_exists($email,$con))
	{
       $msg3="<div class='error'> Email Already Exists!</div>";
	}
	else if(empty($date))
	{
		$msg4="<div class='error'>Please Enter Your DOB</div>";
	}
	else if (empty($password)) 
	{
		$msg5="<div class='error'>Please enter Your password </div>";
	}
	else if(strlen($password)<5)
	{
		$msg5="<div class='error'>Password must contain atleast 5 characters</div>";
	}

		else if($password!==$c_password)
	{
		$msg6="<div class='error'>Password is not same</div>";
	}
		else if($image=='')
	{
		$msg7="<div class='error'>Please Upload Your Profile Image</div>";
	}
		else if($size_image>=1000000)
		{
			$msg7="<div class='error'>Please Upload Image lessthan 1 MB </div>";
		}
		else if($checkbox!='on')
	{
		$msg8="<div class='error'>Please Agree the Terms and Conditions</div>";
	}
	else
	{
		$password=md5($password);
		$img_ext=explode(".",$image);
		 $image_ext=$img_ext['1'];
		 $image=rand(1,1000).rand(1,1000).time().".".$image_ext;
		 if($image_ext=='jpg' || $image_ext=='JPG' || $image_ext=='png' || $image_ext=='PNG')
		 {
		 	move_uploaded_file($tmp_image,"images/$image");
		mysqli_query($con,"INSERT INTO users(first_name,last_name,mail,dob,password,img)
			VALUES ('$firstname','$lastname','$email','$date','$password','$image')");//Inserting values 
		$msg9="<div class='success'><center>Your Successfully Registered</center></div>";
		// redirect to login page
		echo "<script type=\"text/javascript\">window.alert('You are Successfully Registered');
		window.location.href = '/project/index.php';</script>";
			require 'PHPMailerAutoload.php';
			require 'credentail.php';

			$mail = new PHPMailer;

			$mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'ABC Institute');
			$mail->addAddress($_POST['mail']);     // Add a recipient
			$mail->addReplyTo(EMAIL);

			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Account Registered';
			$mail->Body    = '<h1 align="center">Hello&nbsp;&nbsp;&nbsp;'.$_POST['fname'].'&nbsp;&nbsp;Your Account is Now Active</h1>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		$firstname='';$lastname='';$email='';$date='';$password='';$c_password='';$image='';
		
			
	}


}
}
?>
	<title>Sign Up Form</title>
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
		background: url("images/signup.jpg") center no-repeat fixed;
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
 	<div class='login-form  col-md-5'>
 		
 		<div class='jumbotron'>
 			<h3 align='center' style='color:#a517ba'>Sign Up Form</h3><br>
 			<?php echo $msg9; ?></br>
 			<form method='post' enctype="multipart/form-data">
 				<div class="form-group">
 				<label>First Name:</label>
 				<input type='text input-group-text' name='fname' placeholder=" Your First Name" class='form-control' value='<?php echo $firstname; ?>'>
 				<?php echo $msg; ?>
 			</div>
 			<div class="form-group">
 				<label>Last Name:</label>
 				<input type='text' name='lname' placeholder="Your Last Name" class='form-control' value='<?php echo $lastname; ?>' >
 				<?php echo $msg2; ?>
 			</div>
 			<div class="form-group">
 				<label>Email:</label>
 				<input type='email' name='mail' placeholder="Your Email" class='form-control' value='<?php echo $email; ?>' >
 				<?php echo $msg3; ?>
 			</div>
 			<div class="form-group">
 				<label>Date of Birth:</label>
 				<input type='date' name='dob' placeholder="" class='form-control' value='<?php echo $date; ?>' >
 				<?php echo $msg4; ?>
 			</div>
 			<div class="form-group">
 				<label>Password:</label>
 				<input type='password' name='pass' placeholder="password" class='form-control'value='<?php echo $password; ?>' >
 				<?php echo $msg5; ?>
 			</div>
 			<div class="form-group">
 				<label>Re-enter password:</label>
 				<input type='password' name='cpass' placeholder="Re-enter password" class='form-control' value='<?php echo $c_password; ?>' >
 				<?php echo $msg6; ?>
 			</div>
 			<div class="form-group">
 				<label>Profile Image:</label>
 				<input type='file' name='image' value='<?php echo $image; ?>'/>
 				<?php echo $msg7; ?>
 			</div>
 			<div class="form-group">
 				<input type='checkbox' name='check' />
 				<?php echo $msg8; ?>
 				I Agree the Terms and Conditions
 			</div></br>
 			<center><input type='submit' value='submit' name='submit' class='btn btn-success' /></center>
 			<center><a href='login.php'>Already Registered</a></center>
 			</form>
 		</div>
 	</div>
 </div>
</body>
</html>