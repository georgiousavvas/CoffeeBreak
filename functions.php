<?php
//useful functions
//some functions opws to db connect kai db disconnect kai to distance

function db_conn(){
	$servername = "localhost:3306";
	$username = "program1";
	$password = "NEWsavvas1266";
	$dbname = "program1_new_db";

	$conn=mysqli_connect($servername,$username,$password,$dbname);

	// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_set_charset($conn, "utf8");
	return $conn;
}

function db_disconn($conn){
	mysqli_close($conn);
}


function distance($lat1,$lon1,$lat2,$lon2){

	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$km_dist = $miles * 1.609344;
	return $km_dist;
}



?>
