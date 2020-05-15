<?php
session_start();
require('functions.php');
date_default_timezone_set('Europe/Helsinki'); 
$logged_name = $_SESSION['logged_name'];

$conn = db_conn();

$sql="SELECT OrderNum,Latitude,Longitude FROM Orders WHERE OrderDelivery='queue' AND OrderStatus=1";
$result=mysqli_query($conn,$sql);
if($result->num_rows>=1){
    $row=mysqli_fetch_assoc($result);
    $update_ordernum = $row['OrderNum'];
    $queue_lat=$row['Latitude'];
    $queue_lon=$row['Longitude'];
    mysqli_free_result($result);
    
    $sql="SELECT Latitude,Longitude FROM Delivery WHERE Username= '$logged_name'";
    $result=mysqli_query($conn,$result);
    $row=mysqli_fetch_assoc($result);
    $delivery_lat=$row['Latitude'];
    $delivery_lon=$row['Longitude'];

    $dis = distance($queue_lat,$queue_lon,$delivery_lat,$delivery_lon);
    $dis = $dis/1000;
    
    $sql="UPDATE Orders SET OrderDelivery='$logged_name',Distance='$dis' WHERE OrderNum='$update_ordernum' ";
    if(!mysqli_query($conn,$sql)){
        echo "problem in query";
    }
    
    mysqli_free_result($result);
    
    $sql="UPDATE Delivery SET CurrentOrderNum='$update_ordernum' WHERE Username='$logged_name' ";
    if(!mysqli_query($conn,$sql)){
        echo "error update ordernum(que)";
    }
    
    
}

mysqli_free_result($result);


$sql="SELECT OrderNum , Address , OrderShop , Latitude,Longitude,Comments,Price FROM Orders WHERE OrderDelivery='$logged_name' AND OrderStatus=1";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$ordernum = $row['OrderNum'];
$address = $row['Address'];
$ordershop = $row['OrderShop'];
$lat = $row['Latitude'];
$lon = $row['Longitude'];
$comments = $row['Comments'];
$price = $row['Price'];
$time = date('m/d/Y h:i:s a', time());
mysqli_free_result($result);



db_disconn($conn);

?>

<!DOCTYPE html>
<html>
  <head>

    <meta http-equiv="refresh" content="180">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>CoffeeBreak</title>
	<link rel="icon" type="image/png" sizes="32x32" href="favicon_transp.png">
    <style>
	
	 #map {
        height: 300px;
        width: 50%;
		left: 25%;
		
       }
     
     
      html, body {
		background-image: url("coffee_time.jpg");
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  
	  .logout_btn {
		position:absolute; 
		top:0; 
		right:0;
	  
	  }
	  
	  .status_btn {
		position:absolute; 
		bottom: 0;
		left: 45%;
	  }
	  
	  
	  
	  
	  .buttonHover1:hover {
        background-color: red;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		.buttonHover2:hover {
        background-color: green;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		#myTable {
		border-collapse: collapse; /* Collapse borders */
		width: 100%; /* Full-width */
		border: 1px solid white; /* Add a grey border */
		font-size: 20px; /* Increase font-size */
		color:white;
		}

		#myTable th, #myTable td {
		text-align: left; /* Left-align text */
		padding: 12px; /* Add padding */
		}

		#myTable tr {
		/* Add a bottom border to all table rows */
		border-bottom: 1px solid white;
		background-color: purple;
		}

		#myTable tr.header {
		/* Add a grey background color to the table header and on hover */
		background-color: purple;
		}
		
		
	
			
    </style>
  </head>
  <body>
  
  
  <p align="center" style="font-family: Georgia,serif; font-size:100px; font-style: italic; color:white;  margin-bottom: 20px; margin-top: 0px; text-shadow: 5px 5px #ff0000;">CoffeeBreak</p>
    
	
	<form action="/logout_delivery.php">
	<div class="logout_btn">
        <button class="buttonHover1" type="submit" style="height:40px; width:200px; font-size: 15px; border-radius: 25px; border: 5px solid red;">Λήξη βάρδιας</button>
	</div>
	</form>	
	
	
	
	<form action="/order_delivered.php" method="post">
	<div class="table">
	<table id="myTable">
  <tr class="header">
    <th style="width:20%;">Αριθμός παραγγελίας</th>
    <th style="width:20%;">Διεύθυνση</th>
	<th style="width:20%;">Κατάστημα</th>
	<th style="width:20%;">Τιμή</th>
	<th style="width:20%;">Σχόλια</th>
	<th style="width:20%;">Ώρα παραγγελίας</th>
  </tr>
  <tr>
    <td><?php echo $ordernum; ?></td>
    <td><?php echo $address; ?></td>
	<td><?php echo $ordershop; ?></td>
	<td>&euro;<?php echo $price; ?></td>
	<td><?php echo $comments; ?></td>
	<td><?php echo $time; ?></td>
  </tr>
  
</table>
</div>

<div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lon; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNq9sbi2H_cpnxJJzRy34RenH2qVECJUY&callback=initMap">
    </script>


	
	
	
	
	
	
	<div class="status_btn">
        <button class="buttonHover2" type="submit" style="height:150px; width:150px; font-size: 20px; border-radius: 50%; border: 5px solid green;">Παραδόθηκε</button>
	</div>
	
	
	
	
	
	
	
   
		 
  </body>
</html>
