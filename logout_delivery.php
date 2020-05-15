<?php
session_start();
require('functions.php');
//katevazw ta flags kai tupwnw ton mistho tou gia simera
//kai vazw ton mistho tou stin vasi gia na exw ta miniaia gia to xml
$conn = db_conn();

$logged_name = $_SESSION['logged_name'];
$minutes = date('i');
$hour = date('H');
$month = (int)date('m');
$year = date('y');


$sql="SELECT Starthour,Startmin,Name ,Surname FROM Delivery WHERE Username='$logged_name'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$starthour = $row['Starthour'];
$startmin = $row['Startmin'];
$name = $row['Name'];
$surname = $row['Surname'];

$vardia_min = $minutes - $startmin;
$vardia_hour = $hour - $starthour ;

if($vardia_min < 0){
	$vardia_hour = $vardia_hour - 1;
	$vardia_min = 60 + $vardia_min;	
}
if($vardia_hour < 0){
	$vardia_hour = $vardia_hour + 24;
}

$vardia = $vardia_hour.":".$vardia_min;

mysqli_free_result($result);

$sql = "SELECT Orders , Distance , DistancePay ,HourlyPay FROM Salary_Delivery WHERE Username='$logged_name' AND Year='$year' AND Month='$month' ";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);
$orders = $row['Orders'];
$distance = $row['Distance'];
$hourpay = $row['HourlyPay'];
$distancepay = $row['DistancePay'];

mysqli_free_result($result);

$merokamato = ($distance * $distancepay) + ($vardia_hour * $hourpay) + ( ( $vardia_min/60 ) * $hourpay) ;
$merokamato = round($merokamato,2);
//sto merokamato o misthos tou gia simera pou tha tupwsw mazi me ta upoloipa stoixeia

//prepei na midenisw,na valw sto miniaio mistho kai na alla3w flags sto Delivery
$sql = "UPDATE Delivery SET Status=0 ,Busy=0, Starthour=0, Startmin=0 , CurrentOrderNum='NULL' WHERE Username='$logged_name' ";

if(!mysqli_query($conn,$sql)){
	echo "problem in delivery";
}

$sql = "SELECT Amount FROM Salary_Delivery WHERE Username='$logged_name' AND Year='$year' AND Month='$month' ";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$misthos=$merokamato+$row['Amount'];
if($result->num_rows==1){
//uparxei idi kataxorusi gia ton mina ara kanw update to amount
	mysqli_free_result($result);
	$sql = "UPDATE Salary_Delivery SET Amount='$misthos' WHERE  Username='$logged_name' AND Year='$year' AND Month='$month' ";
	if(!mysqli_query($conn,$sql)){
		echo "problem in update salary_delivery";
	}
}else{
//ftiaxnw nea kataxorusi gia to amount tou mina
	$sql = "INSERT INTO Salary_Delivery (Username,Amount,Year,Month) VALUES ('$logged_name','$merokamato','$year','$month') ";
	if(!mysqli_query($conn,$sql)){
		echo "problem in new salary delivery";
	}
}

db_disconn($conn);

?> 


<!DOCTYPE html>
		<html>
  			<head>
			    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
			    <meta charset="utf-8">
		    <title>CoffeeBreak</title>
		<link rel="icon" type="image/png" sizes="32x32" 			href="favicon_transp.png">
    			<style>
			html, body {
			background-image: url("coffee_time.jpg");
        		height: 100%;
        		margin: 0;
        		padding: 0;
      			}
			
			table {
			    font-family: arial, sans-serif;
			    border-collapse: collapse;
			    width: 50%;	
    				margin-top: 150px;
				margin-left:400px;				
			}

			td, th {
    				border: 5px solid #dddddd;
    				text-align: left;
    				padding: 8px;
			}	
            
            tr {
                    background-color: white;
            }
            
            		.home_btn {
	                	position:absolute; 
		                bottom: 10%;
		                left: 45%;
	  }
		
		.buttonHover:hover {
        background-color: red;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
      }
	  
			</style>
			</head>
			<body>
			<div class="error">
				<span style="color:white; font-size:35px; margin-left:45%; background-color: purple; margin-left:30%;">ΛΗΞΗ ΒΑΡΔΙΑΣ -  ΜΙΣΘΟΣ ΗΜΕΡΑΣ</span><br>
<table>
  <tr>
    <th>ΟΝΟΜΑ</th>
  </tr>
  <tr>
    <td><?php echo $name." ".$surname ;?></td>
  </tr>
  <tr>
    <th>ΠΑΡΑΓΓΕΛΙΕΣ</th>
  </tr>
  <tr>
    <td><?php echo $orders ;?></td>
  </tr><tr>
    <th>ΧΙΛΙΟΜΕΤΡΑ</th>
  </tr>
  <tr>
    <td><?php echo $distance ;?></td>
  </tr><tr>
    <th>ΜΙΣΘΟΣ</th>
  </tr>
  <tr>
    <td><?php echo $merokamato ;?></td>
  </tr>
</table>

<div class="home_btn">
        <button class="buttonHover" type="button" Onclick="location.href='index.html' " style="height:160px; width:160px; font-size: 20px; border-radius: 20%; border: 5px solid red;">Αρχική σελίδα</button>
	</div>

			</body>
			</html>


<?php
$conn=db_conn();
$sql="UPDATE Salary_Delivery SET Distance=0 ,Orders=0 WHERE Username='$logged_name' AND Year='$year' AND Month='$month'";

if(!mysqli_query($conn,$sql)){
	echo "problem in reset order/distance";
}

db_disconn($conn);
header('Refresh:60 ; url=logout.php'); //touto en gia redirect se xrono
exit;

?>
