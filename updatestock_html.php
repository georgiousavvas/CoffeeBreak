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
		
		 .update_btn {
		 position:absolute;
		 top:70%; 
		 left:35%;
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
		
		.items {
                
				display:flex;
				justify-content: space-between;
				
				
        }
		
		input[type=number]:focus{
				background-color: white;
				outline: 5px solid #1062e8;
				
		)		
			</style>
    </head>
    <body>
	
	<div class="header">
	<p style="margin-top: 0px; text-shadow: 5px 5px #ff0000;">CoffeeBreak</p>
	</div>
	
	<form action="/logout.php">
	<div class="logout_btn">
        <button class="buttonHover1" type="submit" style="height:40px; width:200px; font-size: 15px; border-radius: 25px; border: 5px solid red;">Αποσύνδεση</button>
	</div>
	</form>	
		
	<form action="/updatestock.php" method="POST">
	
	<div class="items">
                    <div class="item1" >
                        <span style=" font-size:25px; color:white; background-color: purple;" >Τυρόπιτα</span>
                        <input type="number" min="0" name="cheesepie" style="width: 50px; height: 30px; font-size: 20px;"  >
                    </div>
					
                    <div class="item2">
                        <span style=" font-size:25px; color:white; background-color: purple;"  >Σπανακόπιτα</span>
                        <input type="number" min="0"
name="spinachpie" style="width: 50px; height: 30px; font-size: 20px;"  >
                    </div>
					
					<div class="item3">
                        <span style=" font-size:25px; color:white; background-color: purple;"  >Κουλούρι</span>
                        <input type="number" min="0" name="koulouri" style="width: 50px; height: 30px; font-size: 20px;"  >
                    </div>
					
					<div class="item4">
                        <span style=" font-size:25px; color:white; background-color: purple;"  >Τοστ</span>
                        <input type="number" min="0" name="toast" style="width: 50px; height: 30px; font-size: 20px;"  >
                    </div>
					
					<div class="item5">
                        <span style=" font-size:25px; color:white; background-color: purple;"  >Κεικ</span>
                        <input type="number" min="0" name="cake" style="width: 50px; height: 30px; font-size: 20px;"  >
                    </div>
					
					<div class="update_btn">
					<button class="buttonHover2" type="submit" style="height:150px; width:500px; font-size: 25px; border: 5px solid green;">Ενημέρωση Αποθέματος</button>
					</div>
     </div>
	
	</form>	
		
		
		
		
		
		
		
		
		
    </body>
</html>		
		
		
