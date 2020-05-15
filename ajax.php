<?php
session_start();

require("functions.php");

$conn = db_conn();

$manager = $_SESSION['logged_name'];

$sql = "SELECT Name FROM Shop WHERE Manager='$manager' ";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$shop = $row['Name'];

mysqli_free_result($result);

$sql="SELECT OrderNum , Address , OrderDelivery , Price FROM Orders WHERE OrderShop='$shop' AND OrderStatus=1";
$result = mysqli_query($conn,$sql);

$ordernum = array();
$address = array();
$orderdelivery = array();
$price = array();


while($row = mysqli_fetch_assoc($result)) {
	
	$ordernum[] = $row['OrderNum'];
	$address[] = $row['Address'];
	$orderdelivery[] = $row['OrderDelivery'];
	$price[] = $row['Price'];
}

mysqli_free_result($result);

db_disconn($conn);


$count = count($ordernum);

$data = array();

$data[0]=$ordernum;
$data[1]=$address;
$data[2]=$orderdelivery;
$data[3]=$price;
$data[4]=$shop;
$data[5]=$count;


echo json_encode($data);



?>
