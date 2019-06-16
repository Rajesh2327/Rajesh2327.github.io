<?php
include("includes/header.php"); //Consist of header section
include("includes/config.php");//database connection
session_start();
$name=$_SESSION['name'];
if(isset($name))
{
	$result=mysqli_query($con,"SELECT id,first_name,last_name,mail,dob,img FROM users");//fetching data from database
	$row=mysqli_num_rows($result);
	echo "<div class='container'>"."<h3 style='color:#cc0052;'><br>Welcome Amin Panel</h3>"."Total Registered Users:".$row;
	echo "<a href='admin-logout.php'><button class='btn btn-primary' style='float:right;'>Logout</button></a>";
	echo "</br></br>".
	"<table class='table-striped table-bordered table-responsive'>
	<tr align='center' style='color:#cc0052;' >
		<th>S.no</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Date of Birth</th>
		<th>Profile Image</th>
		<th>Delete Users</th>
		<th>Edit User</th>
	</tr>";
$i=0;
while($retrive=mysqli_fetch_array($result))
{
	$id=$retrive['id'];
	$fname=$retrive['first_name'];
	$lname=$retrive['last_name'];
	$mail=$retrive['mail'];
	$date=$retrive['dob'];
	$pro=$retrive['img'];
	echo "<tr align='center' style='color:'>"."<th>".$i=$i+1;"</th>";
	echo "<th>$fname</th>"."<th>$lname</th>"."<th>$mail</th>"."<th>$date</th>"."<th><img src='images/$pro' height='100px' width='100px'></th>"."<th><a href='delete-admin.php?del=$id'><button class='btn btn-danger'>Delete</button></a></th>"."<th><a href='update-admin.php?user=$id'><button class='btn btn-success'>Edit</button></a></th>"."</tr>";
}
echo "</table>";
}
else
{
	header("location:admin.php");
}
?>