<?php
session_start();
require("functions.php");

$conn=db_conn();


$greek = (int)$_POST["greek"];
$frappe = (int)$_POST["frappe"];
$espresso = (int)$_POST["espresso"]; 
$cappuccino = (int)$_POST["cappuccino"];
$french = (int)$_POST["french"];


$cheesepie = (int)$_POST["cheesepie"];
$spinachpie = (int)$_POST["spinachpie"];
$koulouri = (int)$_POST["koulouri"];
$toast = (int)$_POST["toast"];
$cake = (int)$_POST["cake"];


$sql = "SELECT Shopstock FROM Stock WHERE CheesePie >= '$cheesepie' AND SpinachPie >= '$spinachpie' AND Koulouri >= '$koulouri' AND Toast >= '$toast' AND Cake >= '$cake'" ;

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0 ){

	$available_shops = array();
	
	while($row = mysqli_fetch_assoc($result)) {
		$available_shops[] = $row['Shopstock'];
    	}

	$_SESSION['available_shops'] = $available_shops;
	$ordernum = "order".(rand() + time());
	$order_array = array("ordernum"=>$ordernum,"greek"=>$greek , "frappe"=>$frappe , "espresso"=>$espresso , "cappuccino"=>$cappuccino,"french"=>$french,"cheesepie"=>$cheesepie,"spinachpie"=>$spinachpie,"koulouri"=>$koulouri,"toast"=>$toast,"cake"=>$cake);  
	$_SESSION['order'] = $order_array;//vazw oli tin paraggelia sto session gia na tin exw meta tin dieuthinsi
	mysqli_free_result($result);
	header("Location:order_map.html"); //tha pigenei stin epilogi dieuthinsis
	exit;


}else{

	header("Location:failed_order_html.php");
	exit;
}

db_disconn($conn);

?>
