<?php
	session_start();
	require('functions.php');
	$conn = db_conn();
	
	$sql = "SELECT * FROM Price";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	
	$cheesepie = $row['CheesePie'];
	$spinachpie = $row['SpinachPie'];
	$koulouri = $row['Koulouri'];
	$toast = $row['Toast'];
	$cake = $row['Cake'];

	$greek = $row['Greek'];
	$frappe = $row['Frappe'];
	$french = $row['French'];
	$espresso = $row['Espresso'];
	$cappuccino = $row['Cappuccino'];

	mysqli_free_result($result);
	db_disconn($conn);
	
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <meta charset="utf-8">
    <title>CoffeeBreak</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_transp.png">
    <style>


    html,body {

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

/*.next_btn {
   position:absolute;
   top:70%;
   left:45%;
   }*/

   .buttonHover2:hover {
    background-color: red;
    -webkit-transition-duration: 0.5s;
    transition-duration: 0.5s;
    color: white;
}

input[type=number]:focus{
    background-color: white;
    outline: 5px solid #1062e8;

    )  

table, th, td {
    border: 1px solid red;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: left;
}       

.coffeeTable {
    padding-left: 20%;
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

<div class="error">
				<span style="color:white; font-size:35px; margin-left:30%; background-color: purple; ">Δεν υπάρχουν διαθέσιμα προιόντα</span><br>
				<span style="color:white; font-size:25px; margin-left:30%; background-color: purple; ">για την παραγγελία σας,επιλέξτε κάτι άλλο αν θέλετε</span><br><br>
			</div>
    <form action="/order.php" method="POST" style="padding-left: 32%;">

        <table class="table-bordered coffeeTable">
            <thead class="thead-dark">
                <tr><b style="color:white; font-size:25px; background-color:purple;">Καφέδες</b></tr>
            </thead>
            <tbody>
                <tr>
                  <td>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><b>Ελληνικός</b></span>
                    </div>
                    <input type="number" min="0" class="form-control" name="greek">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $greek;?></b></span>
                </div>
                
            </div>
        </td>
    </tr>
    <tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Frappé</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="frappe">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $frappe;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Espresso</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="espresso">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $espresso;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Cappuccino</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="cappuccino">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $cappuccino;?></b></span>
        </div>
    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Γαλλικός</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="french">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $french;?></b></span>
        </div>

    </div>
</td>
</tr>
    
</tbody>
</table>

<hr />

<table class="table-bordered coffeeTable">
    <thead class="thead-dark">
        <tr><b style="color:white; font-size:25px; background-color:purple;">Σνακ</b></tr>
    </thead>
    <tbody>
        <tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Τυρόπιτα</b><span>
            </div>
            <input type="number" min="0" class="form-control" name="cheesepie">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $cheesepie;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Σπανακόπιτα</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="spinachpie">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $spinachpie;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Κουλούρι</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="koulouri">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $koulouri;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Toast</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="toast">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $toast;?></b></span>
        </div>

    </div>
</td>
</tr>
<tr>
          <td>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Cake</b></span>
            </div>
            <input type="number" min="0" class="form-control" name="cake">
        </div>
    </td>
    <td>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><b>Τιμή :  &euro; <?php echo $cake;?></b></span>
        </div>

    </div>
</td>
</tr>

</tbody>
</table>
<br />
<div class="next_btn">
    <button class="buttonHover2" type="submit"  style="height:70px; width:500px; font-size: 25px; border-radius:5px; border: 2px solid red; margin-left:1px;">Συνέχεια</button>
</div>

</form>

<br /><br /><br /><br />


<script>
    




</script>

</body>
</html>
