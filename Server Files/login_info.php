<?php
	$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
	$sql_statement = "SELECT * FROM insurer WHERE insurer_username = '".$_GET["username"]."' && insurer_password = '".$_GET["password"]."'"; 
	$result = mysqli_query($db, $sql_statement);
	$row = mysqli_fetch_assoc($result);
	
if($_GET['username'] == "admin" && $_GET['password'] == "pass") { 
	session_start();
	$_SESSION['login_status_admin'] = "activate";
	echo 'index.php';
}
elseif ($row['insurer'] != "") {
	session_start();
	$_SESSION['login_status_insurer'] = "activate";
	$_SESSION['insurer_username'] = "".$_GET['username']."";
	echo 'view_iqrn.php';
}
else {
	echo 'wrongpassword';
}

?>