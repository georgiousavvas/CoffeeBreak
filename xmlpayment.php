<?php
//apo to url pernw tis parametrous localhost/xmlpayment.php?month=MONTH_I_WANT&year=YEAR_I_WANT
//kai pernw tis times apo to superglobal $_GET[] => $_GET['month'] kai $_GET['year']
require('functions.php');

$month = (int)$_GET['month'];
$year = $_GET['year'];

$username = array();
$name = array();
$surname = array();
$afm = array();
$amka = array();
$iban = array();
$salary = array();


$conn = db_conn();
mysqli_set_charset($conn, "utf8");//gia na deixnei ta ellinika

$sql = "SELECT Amount,Username FROM Salary_Manager WHERE Year='$year' AND Month='$month' ";
$result = mysqli_query($conn,$sql);



while($row = mysqli_fetch_assoc($result)) {

	$username[] = $row['Username'];
	$nowname = $row['Username'];
	$salary[] = $row['Amount'];
	
	$sql2 = "SELECT Name,Surname,AFM,AMKA,IBAN FROM Manager WHERE Username='$nowname' ";
	$result2 = mysqli_query($conn,$sql2);

	while($row2 = mysqli_fetch_assoc($result2)){
		$name[] = $row2['Name'];
		$surname[] = $row2['Surname'];
		$afm[] = $row2['AFM'];
		$amka[] = $row2['AMKA'];
		$iban[] = $row2['IBAN'];
	}
}

mysqli_free_result($result);
$i = count($salary);
	


header('Content-Type: text/xml');
	
	echo '<xml>
	<header>
		<transaction>
			<period month="' . $_GET['month'] . '" year="' . $_GET['year'] . '"/>
		</transaction>
	</header>
	<body>
		<employees>';


for($j=0; $j<$i; $j++){
echo "
			<employee>
				<firstname>${name[$j]}</firstname>
				<lastname>${surname[$j]}</lastname>
				<amka>${amka[$j]}</amka>
				<afm>${afm[$j]}</afm>
				<iban>${iban[$j]}</iban>
				<amount>${salary[$j]}</amount>
			</employee>";	

}


$username = array();
$name = array();
$surname = array();
$afm = array();
$amka = array();
$iban = array();
$salary = array();



$sql = "SELECT Amount,Username FROM Salary_Delivery WHERE Year='$year' AND Month='$month' ";
$result = mysqli_query($conn,$sql);



while($row = mysqli_fetch_assoc($result)) {

	$username[] = $row['Username'];
	$nowname = $row['Username'];
	$salary[] = $row['Amount'];
	
	$sql2 = "SELECT Name,Surname,AFM,AMKA,IBAN FROM Delivery WHERE Username='$nowname' ";
	$result2 = mysqli_query($conn,$sql2);

	while($row2 = mysqli_fetch_assoc($result2)){
		$name[] = $row2['Name'];
		$surname[] = $row2['Surname'];
		$afm[] = $row2['AFM'];
		$amka[] = $row2['AMKA'];
		$iban[] = $row2['IBAN'];
	}
}

mysqli_free_result($result);
$i = count($salary);

for($j=0; $j<$i; $j++){
echo "
			<employee>
				<firstname>${name[$j]}</firstname>
				<lastname>${surname[$j]}</lastname>
				<amka>${amka[$j]}</amka>
				<afm>${afm[$j]}</afm>
				<iban>${iban[$j]}</iban>
				<amount>${salary[$j]}</amount>
			</employee>";	

}



echo '</employees>
	</body>
</xml>';


db_disconn($conn);

exit;	
?>
