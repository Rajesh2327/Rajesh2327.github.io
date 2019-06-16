
<?php
include("includes/header.php");
include("includes/config.php");
session_start();
include("includes/functions.php");

if(logged_in())
{
	header("location:index.php");
}
else if(isset($_COOKIE['name']))
{
	//echo "your logged in through cookies";
	$email=$_COOKIE['name'];

$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
$id=$retrive['id'];
$firstname=$retrive['first_name'];
$lastname=$retrive['last_name'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
	<link href="css/style.css" rel="stylesheet" type="text/css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style type="text/css">

	#body-bg
	{
		background-color: #efefef;
	}
	
</style>
</head>
<body id='body-bg'>
	<div class='container' style='background-color:#fff; margin-top:20px; padding-top: 10px; margin-bottom: 20px;width: 1200px;height:550px;'>
		<h2 align='center' style='color:#ff5c33'> Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?></h2>
	<a href='Logout.php'><button class='btn btn-outline-success' style='float:right;'>Logout</button></a>
	<a href='change-password.php?id=<?php echo $id;?>'><button class='btn btn-outline-primary' style='float:left;'>Change Password</button></a><br><br><br>
		<center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail' style='width: 200px; height: 200px;'></center>
	</div>
	
</body>
</html>
<?php
}
else
{
	//echo "your logged in through session";

	$email=$_SESSION['mail'];
	$result=mysqli_query($con,"SELECT id,first_name,last_name,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
$id=$retrive['id'];
$firstname=$retrive['first_name'];
$lastname=$retrive['last_name'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<meta charset="utf-8">    
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" >
	<link href="css/style.css" rel="stylesheet" type="text/css" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style type="text/css">

	#body-bg
	{
		background-color: #efefef;
	}
	
</style>
</head>
<body id='body-bg'>
	<div class='container' style='background-color:#fff; margin-top:20px; padding-top: 10px; margin-bottom: 20px;width: 1200px;height:550px;'>
		<h2 align='center' style='color:#ff5c33'> Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?></h2>
	<a href='Logout.php'><button class='btn btn-outline-success' style='float:right;'>Logout</button></a>
	<a href='change-password.php?id=<?php echo $id;?>'><button class='btn btn-outline-primary' style='float:left;'>Change Password</button></a><br><br><br>
		<center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail' style='width: 200px; height: 200px;'></center>
	</div>
	
</body>
</html>
<?php
}
?>