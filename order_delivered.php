<?php
session_start();
//afou paradwthei i paraggelia epanaferw ta panta gia na einai etoimos j prosthetw ta posa gia tous misthous tous miniaious
//j kamnw redirect pisw afou kamw ta panta update
require('functions.php');

$conn = db_conn();

$logged_name = $_SESSION['logged_name'];


$sql = "SELECT Latitude , Longitude , Distance , OrderShop ,Price ,OrderNum FROM Orders WHERE OrderDelivery='$logged_name' AND OrderStatus=1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$newlat = $row['Latitude'];
$newlong = $row['Longitude'];
$delivery_distance = $row['Distance'];
$shop = $row['OrderShop'];
$price = $row['Price'];
$ordernum = $row['OrderNum'];

mysqli_free_result($result);


//midenizw to status tis paraggelias gia na min emfanizetai pleon/paradothike
$sql="UPDATE Orders SET OrderStatus='0' WHERE OrderNum='$ordernum'";

if(!mysqli_query($conn,$sql)){
	echo "problem in order";		
}


//na nullarw to order pou einai sundedemeno ston customer
$sql="SELECT Email from Customer WHERE OrderNum='$ordernum'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$customer_name = $row['Email'];

mysqli_free_result($result);

$sql = "UPDATE Customer SET OrderNum='NULL' WHERE Email='$customer_name' ";

if(!mysqli_query($conn,$sql)){
	echo "problem in Customer";		
}



$sql="UPDATE Delivery SET CurrentOrderNum='NULL' , Busy='0' , Latitude='$newlat' , Longitude='$newlong' WHERE Username='$logged_name'";


if(!mysqli_query($conn,$sql)){
	echo "problem in delivery";		
}


//prwta prosthetw sto turnover tin timi tis paraggelias gia to katallilo katastima kai auxanw to orders kai to distance sto daily meter tou delivery
//elegxw an uparxei idi o minas kai o xronos , aliws prosthetw neo entry
//na dw an tha to valw telika giati mporei na to kamnw reset sto logout

$month = (int)date('m');
$year = date('y');

$sql = "SELECT Username from Salary_Delivery WHERE Year='$year' AND Month='$month' AND Username='$logged_name'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($result->num_rows==1){
	//gia na isxuei simainei oti uparxei idi kataxorimeno to amount autou 		tou mina ara tha kanw update
	mysqli_free_result($result);
	$sql = "UPDATE Salary_Delivery SET Orders=Orders+1, Distance = Distance + '$delivery_distance' WHERE Username='$logged_name' AND Year='$year' AND Month='$month' ";

	if(!mysqli_query($conn,$sql)){
		echo "problem in update salary_delivery";		
	}
}else{
//den uparxei i kataxwrisi
	$sql = "INSERT INTO Salary_Delivery (Username,Orders,Distance,Year,Month) VALUES('$logged_name',Orders+1,Distance+'$delivery_distance','$year','$month')";
if(!mysqli_query($conn,$sql)){
		echo "problem in new salary_delivery";		
	}
}

$sql="SELECT Amount FROM Turnover WHERE Shop='$shop' AND Year='$year' AND Month='$month'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

if($result->num_rows>=1){
//uparxei kataxwrisi ara apla prosthetw to poso sto miniaio tziro
	mysqli_free_result($result);
	$sql = "UPDATE Turnover SET Amount=Amount+'$price' WHERE Shop='$shop' AND Year='$year' AND Month='$month'";
	if(!mysqli_query($conn,$sql)){
		echo "problem in update turnover";		
	}
}else{
//new month entry
	$sql="INSERT INTO Turnover(Shop,Year,Month,Amount) VALUES ('$shop','$year','$month','$price')";
	if(!mysqli_query($conn,$sql)){
		echo "problem in new turnover";		
	}
}

//enimerwnw kai ton mistho tou manager
//prwta vriskw pios einai o manager sto shop tis paraggelias

$sql = "SELECT Manager from Shop WHERE Name='$shop' ";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$manager = $row['Manager'];

mysqli_free_result($result);

//pernw to kerdos tou mina kai tou xronou gia to shop pou molis egine i paraggelia

$sql = "SELECT Amount FROM Turnover WHERE Shop='$shop' AND Year='$year' AND Month='$month' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$turnover = $row['Amount'];
mysqli_free_result($result);

//upologizw to mistho tou manager opou einai 800 euro + 2% tou tzirou
$salary = 800 + ($turnover * 0.02);

$sql="SELECT Amount FROM Salary_Manager WHERE Username='$manager' AND Year='$year' AND Month='$month'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

if($result->num_rows>=1){
//uparxei i kataxotusi ara kanw update
	mysqli_free_result($result);
	$sql = " UPDATE Salary_Manager SET Amount='$salary' WHERE Username='$manager' AND Year='$year' AND Month='$month' ";
	if(!mysqli_query($conn,$sql)){
		echo "problem in update salary manager";		
	}
}else{
//den uparxei i kataxorusi ara ftiaxnw kainourgia
	$sql = " INSERT INTO Salary_Manager (Username,Year,Month,Amount) VALUES ('$manager','$year','$month','$salary') ";
	if(!mysqli_query($conn,$sql)){
		echo "problem in new salary manager";		
	}
}

db_disconn();


header('Location:delivery_order_html.php');
exit;

?>
