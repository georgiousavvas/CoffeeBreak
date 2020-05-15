<?php
session_start();
//to function tha pernei to lat kai long tis dieuthinsis tis paraggelias san parametros,
//tha kalei to function to distance pou eftia3a kai ta vazei se ena array oles tis distance twn magaziwn arxika 
//gia na vrw prwta auto,meta tha kanw kai to idio gia tous delivery
//tha stelnw tin paraggelia ston delivery(na ftia3w allo function gia auto)
//kai tha katoxurwnw tin paraggelia,allazw ta flags kai kanw update to stock

require("functions.php");
$conn = db_conn();



$lat1=$_POST['lat'];
$lon1=$_POST['long'];
$_SESSION['long']=$_POST['long'];
$_SESSION['lat']=$_POST['lat'];
$_SESSION['comments'] = $_POST['comments'];
$_SESSION['address'] = $_POST['address'];

$dist_array = array();
$shop_array = array();



foreach($_SESSION['available_shops'] as $value ){
	$sql="SELECT Latitude,Longitude FROM Shop WHERE Name='$value'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$dist_array[] = distance($lat1,$lon1,$row['Latitude'],$row['Longitude']);
	$dist_shops[] = $value;
	mysqli_free_result($result);
}

$min_index = array_search(min($dist_array),$dist_array);
$closer_shop = $dist_shops[$min_index];


//na thumithw na alla3w to status stin vasi se 0 kai 1 apo energos kai na valw kai ena busy pali 0 kai 1
$sql = "SELECT Username,Latitude,Longitude FROM Delivery WHERE Status='1' AND Busy='0'";//edw sto where na valw kai gia to busy  //MPORW na elegxw kai an einai null to CurrentOrderNum tou Delivery

$result = mysqli_query($conn,$sql);

$dist_array2=array();
$delivery_array = array();

if(mysqli_num_rows($result) > 0){

	while($row = mysqli_fetch_assoc($result)) {
		$dist_array2[] = distance($lat1,$lon1,$row["Latitude"],$row["Longitude"]);
		$delivery_array[] = $row["Username"];
	    }
}else{
    $delivery_array[0]="queue";
    
    
}

$min_index = array_search(min($dist_array2),$dist_array2);
$closer_delivery = $delivery_array[$min_index];

$_SESSION['closer_shop']=$closer_shop;
$_SESSION['closer_delivery']=$closer_delivery;
$_SESSION['delivery_kms'] = min($dist_array2);//gia na ta valw meta gia ton mistho afou oloklirwthei i paraggelia
mysqli_free_result($result);

//Sto $closer_shop kai $closer_delivery uparxei to pio kontino katastima kai deliveras apo tin paraggelia(ta evala kai sto session)

db_disconn($conn);


header("Location: order_completed.php");
exit;

?>
