<?php
session_start();
require('functions.php');

$conn = db_conn();

$hour = date('H');
$minutes = date('i');

$logged_name = $_SESSION['logged_name'];

$lat = (float)$_POST["lat"];
$long = (float)$_POST["long"];

$sql="UPDATE Delivery SET STATUS=1 ,Busy=0, Starthour='$hour',Startmin='$minutes',Latitude='$lat',Longitude='$long' WHERE Username='$logged_name'";
if(!mysqli_query($conn,$sql)){
	echo "problem in Delivery";		
}


db_disconn($conn);

//prwta prepei na alla3w kapoia flags kai na arxisw tin vardia  j meta paw sto delivery_order_html.php
header('Location: delivery_order_html.php');
exit;

?>
