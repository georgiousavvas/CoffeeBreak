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
		
		 .order_btn {
		 position:fixed;
		 top: 30%;
		 left: 35%;
		
		}
		
		.logout_btn {
		position:absolute; 
		top:0; 
		right:0;
	  
		}
		
		.buttonHover:hover {
        background-color: red;
        -webkit-transition-duration: 0.5s;
		transition-duration: 0.5s;
        color: white;
        }
		
		.header {
		 text-align: center;
         color: #ffffff;
		 font-size: 150px;
		 font-family: Georgia, serif;
		 font-style: italic;
		}
		
		
        </style>
    </head>
    <body>
	
	<div class="welcome">
	<span style="font-size:35px; color: white; background-color: purple;">Welcome, <?php echo $_SESSION['logged_name']; ?></span>
	</div>
	
	<div class="header">
	<p style="margin-top: 0px; text-shadow: 5px 5px #ff0000;">CoffeeBreak</p>
	</div>


	<form action="/logout.php">
	<div class="logout_btn">
        <button class="buttonHover" type="submit" style="height:40px; width:200px; font-size: 15px; border-radius: 25px; border: 5px solid red;">Αποσύνδεση</button>
	</div>
	</form>	
	
	<div class="order_btn">
        <button class="buttonHover" type="button" Onclick="location.href='order_html.php' " style="height:500px; width:500px; font-size: 40px; border-radius: 50%; border: 5px solid red;">Παράγγειλε τώρα ! </button>
	</div>

					


    </body>
</html>
