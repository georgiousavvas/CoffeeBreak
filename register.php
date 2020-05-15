<?php 
session_start();

require("functions.php");

$conn = db_conn();

$email = $_POST["email"];
$pass = $_POST["pswd"];
$repeat = $_POST["pswd-repeat"];
$phone = $_POST["phone"];


if($pass == $repeat){
	//first check if there is already an account
	$sql="SELECT Password FROM Customer WHERE Email='$email'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	if($result->num_rows==1){
	    $_SESSION['logged_name'] = $email;
		header("Location: account_exists_html.php");

	}else{
		//create new account
		$sql="INSERT INTO Customer (Email,Password,Phone) VALUES ('$email','$pass',$phone)";
		if (mysqli_query($conn, $sql)) {
			header("Location: account_created.html");
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	// Free result set
	mysqli_free_result($result);

}else{
	
		header("Location: failed_reg.html");
}


db_disconn($conn);


?>
