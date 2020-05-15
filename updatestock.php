<?php
session_start();
require("functions.php");

$conn = db_conn();


$name = $_SESSION['logged_name'];


$cheesepie = (int)$_POST["cheesepie"];
$spinachpie = (int)$_POST["spinachpie"];
$koulouri = (int)$_POST["koulouri"];
$toast = (int)$_POST["toast"];
$cake = (int)$_POST["cake"];

$sql = "SELECT Name FROM Shop WHERE Manager='$name'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$shop = $row["Name"];
mysqli_free_result($result);

$sql = "UPDATE Stock SET Cheesepie='$cheesepie' , Spinachpie='$spinachpie' , Koulouri='$koulouri' , Toast='$toast' ,Cake='$cake' WHERE Shopstock='$shop' ";

if(!mysqli_query($conn,$sql)){

	echo "Error : ".$sql."<br>".mysqli_error($conn);

}else{
	header("Location: stock_updated_html.php");
}
mysqli_free_result($result);


db_disconn($conn);
?>
