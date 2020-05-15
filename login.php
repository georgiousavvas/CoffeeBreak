<?php
session_start();
require("functions.php");

$conn=db_conn();

$name = $_POST['username'];
$pass = $_POST['password'];

$logflag = 0;

// check customer credentials
$sql="SELECT Password FROM Customer WHERE Email='$name' AND Password='$pass'";
$result=mysqli_query($conn,$sql);



$row=mysqli_fetch_assoc($result);
if($result->num_rows==1){
	$logflag = 1;
	$_SESSION['logged_name'] = $name;
	$_SESSION['logged_pass'] = $pass;
	header("Location: welcome_customer_html.php");
}

// Free result set
mysqli_free_result($result);


// check manager credentials
$sql="SELECT Password FROM Manager WHERE Username='$name' AND Password='$pass'";
$result=mysqli_query($conn,$sql);


$row=mysqli_fetch_assoc($result);
if($result->num_rows==1){
	$logflag = 1;
	$_SESSION['logged_name'] = $name;
	$_SESSION['logged_pass'] = $pass;
	header("Location: welcome_manager_html.php");
}

// Free result set
mysqli_free_result($result);


// check delivery credentials
$sql="SELECT Password FROM Delivery WHERE Username='$name' AND Password='$pass'";
$result=mysqli_query($conn,$sql);


$row=mysqli_fetch_assoc($result);
if($result->num_rows==1){
	$logflag = 1;
	$_SESSION['logged_name'] = $name;
	$_SESSION['logged_pass'] = $pass;
	header("Location: welcome_delivery_html.php");
}

// Free result set
mysqli_free_result($result);


if($logflag == 0){
    header("Location: login_failed.html");
}

db_disconn($conn);
?> 
