<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>CoffeeBreak</title>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_transp.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
   
     html, body {
        background-image: url("coffee_time.jpg");
        height: 100%;
        margin: 0;
        padding: 0;
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
 
        #myTable thead tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid white;
        background-color: purple;
        }
		
		#myTable tbody tr {
		background:white;
		color:black;
		}
 
        #myTable tr.header {
        /* Add a grey background color to the table header and on hover */
        background-color: purple;
        }
       
       
   
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
   
    <div>
      <table id="myTable">
	  <thead>
	  <tr>
				   <th>Αριθμός παραγγελίας</th>
                   <th>Διεύθυνση παραγγελίας</th>
                   <th>Κατάστημα</th>
                   <th>Όνομα Delivera</th>
				   <th>Ποσό παραγγελίας</th>
	</tr>			
	</thead>
	<tbody></tbody>
				  </table>
    </div>
	
	
		<script>
		
		
		function loadTable(data) {
    var table = '';
    var counter = data[5];
    for(var i=0; i<counter; i++){
        table += '<tr>'+
                  '<td>'+ data[0][i] +'</td>'+
                  '<td>'+ data[1][i]+'</td>'+
                  '<td>'+ data[4]+'</td>'+
                  '<td>'+ data[2][i]+'</td>'+
                  '<td>'+ data[3][i]+'</td>'+
                '</tr>';
    }
	
    $('#myTable tbody').html(table);
  }

  function serverRequest() {
    $.ajax({
	url:"ajax.php",      
	success: function(result){
	var data = JSON.parse(result);
        loadTable(data);
		
      },
      error: function(error) {
        alert("Connection problem. Please try again later!");
        console.log(error);
      }
    });
  }

  


  $(document).ready(function() {
		
		serverRequest();
        setInterval(serverRequest, 3000);
  });
		
		
	</script>
</body>
</html>
