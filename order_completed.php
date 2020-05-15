<?php
session_start();
//afou exei dwthei i paraggelia,i dieuthinsi kai exei epilegei to magazi kai o deliveras
//na kanw update tin vasi opou prepei
require('functions.php');


$conn=db_conn();

$ordernum = $_SESSION['order']['ordernum'];

$spinachpie = $_SESSION['order']['spinachpie'];
$cheesepie = $_SESSION['order']['cheesepie'];
$koulouri = $_SESSION['order']['koulouri'];
$toast = $_SESSION['order']['toast'];
$cake = $_SESSION['order']['cake'];

$greek = $_SESSION['order']['greek'];
$frappe = $_SESSION['order']['frappe'];
$french = $_SESSION['order']['french'];
$cappuccino = $_SESSION['order']['cappuccino'];
$espresso = $_SESSION['order']['espresso'];

$address = $_SESSION['address'];
$lat = $_SESSION['lat'];
$long = $_SESSION['long'];
$closer_shop = $_SESSION['closer_shop'];
$closer_delivery = $_SESSION['closer_delivery'];
$comments = $_SESSION['comments'];
$delivery_kms = $_SESSION['delivery_kms'];
$logged_name = $_SESSION['logged_name'];



$sql="UPDATE Customer SET OrderNum= '$ordernum' ,Address1='$address',Latitude='$lat',Longitude='$long' WHERE Email= '$logged_name' ";


if(!mysqli_query($conn,$sql)){
	echo "problem in customer";		
}



$sql="UPDATE Delivery SET CurrentOrderNum='$ordernum' , Busy = '1' WHERE Username='$closer_deliver'";


if(!mysqli_query($conn,$sql)){
	echo "problem in delivery";		
}



$sql="INSERT IGNORE INTO Orders (OrderNum,Address,Latitude,Longitude,OrderShop,OrderDelivery,OrderStatus,Greek,Frappe,Espresso,Cappuccino,French,CheesePie,SpinachPie,Koulouri,Toast,Cake,Comments,Distance) VALUES ('$ordernum','$address','$lat','$long','$closer_shop','$closer_delivery','1','$greek','$frappe','$espresso','$cappuccino','$french','$cheesepie','$spinachpie','$koulouri','$toast','$cake','$comments','$delivery_kms')  ";



if(!mysqli_query($conn,$sql)){
	echo "problem in Order";		
}




$sql="UPDATE Stock SET  CheesePie=CheesePie-'$cheesepie' , SpinachPie=SpinachPie-'$spinachpie' ,Koulouri=Koulouri-'$koulouri' ,Toast=Toast-'$toast' ,Cake=Cake-'$cake' WHERE Shopstock='$closer_shop'";


if(!mysqli_query($conn,$sql)){
	echo "problem in Stock";		
}




//upologizw tin timi tis paraggelias gia na tin steilw alla kai gia na kanw update to amount tou katastimatos gia to bonus tou manager
$sql="SELECT * FROM Price";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$pricefood=($cheesepie * $row['CheesePie'])+($spinachpie * $row['SpinachPie'])+($koulouri * $row['Koulouri'])+($toast * $row['Toast'])+($cake * $row['Cake']);
$pricedrink = $greek * $row['Greek'] + $frappe * $row['Frappe'] +$cappuccino * $row['Cappuccino'] +$french * $row['French'] +$espresso * $row['Espresso'] ; 
$price = $pricefood + $pricedrink;
$_SESSION['order_price']=$price;

mysqli_free_result($result);


$sql="UPDATE Orders SET  Price='$price'  WHERE OrderNum='$ordernum'";



if(!mysqli_query($conn,$sql)){
	echo "problem in Order";		
}



mysqli_free_result($result);
//na to ftia3w auto na emfanizei tis paraggelies
header("Location: wait_order.html");


db_disconn($conn);


?>
