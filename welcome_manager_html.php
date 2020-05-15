<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>

        <meta charset="utf-8">
        <title>CoffeeBreak</title>
		<link rel="icon" type="image/png" sizes="32x32" href="favicon_transp.png">
		<style>
		
		
		body {
			background-image: url("coffee_time.jpg");
		}
        
		.header {
		 text-align: center;
         color: #ffffff;
		 font-size: 150px;
		 font-family: Georgia, serif;
		 font-style: italic;
		}
		
		.logout_btn {
		position:absolute; 
		top:0; 
		right:0;
	  
		}
		
		.buttonHover1:hover {
        background-color: red;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		.buttonHover2:hover {
        background-color: #1062e8;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		.buttonHover3:hover {
        background-color: green;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		.update_btn, .orders_btn {
		float: left;
		margin-left: 25%;
		
		
		
		}
		
		
		</style>
    </head>
    <body>
	
	<div class="welcome">
	<span style="font-size:35px; color: white; background-color: purple;">Welcome, <?php echo "manager ";echo  $_SESSION['logged_name']; ?>					</span>
	</div>
	
	<div class="header">
	<p style="margin-top: 0px; text-shadow: 5px 5px #ff0000;">CoffeeBreak</p>
	</div>
	
	<form action="/logout.php">
	<div class="logout_btn">
        <button class="buttonHover1" type="submit" style="height:40px; width:200px; font-size: 15px; border-radius: 25px; border: 5px solid red;">Αποσύνδεση</button>
	</div>
	</form>	
	
	<div class="update_btn">
        <button class="buttonHover2" type="button" Onclick="location.href='updatestock_html.php' " style="height:100px; width:845px; font-size: 40px;  border: 5px solid #1062e8;">Ενημέρωση Προϊόντων</button>
	</div>
	
	<div class="orders_btn">
        <button class="buttonHover3" type="button" Onclick="location.href='managers_view_html.php' " style="height:100px; width:845px; font-size: 40px;  border: 5px solid green;">Τρέχουσες Παραγγελίες</button>
	</div>

	
    </body>
</html>
