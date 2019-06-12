<?php
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');

if (!$db)
{
print "<h1>Unable to Connect to MySQL</h1>";
}
if ($_GET['prmt'] == 'arn') {

$arn = $_GET['arn'];
$vin = $_GET['vin'];
$counter = 0;

$queryone = "SELECT * FROM automotive_impact WHERE accident_ref_no = '$arn'"; 
$resultsone = mysqli_query($db, $queryone); 
$rowone = mysqli_fetch_assoc($resultsone);
if ($rowone == "") {
	echo 'invalidarn';
	$counter++;
}

$querytwo = "SELECT * FROM automotive_impact WHERE vin_no = '$vin'"; 
$resultstwo = mysqli_query($db, $querytwo); 
$rowtwo = mysqli_fetch_assoc($resultstwo);
if ($rowtwo == "") {
	echo 'invalidvin';
	$counter++;
}

if ($counter == 0) {

	$querythree = "SELECT * FROM automotive_impact WHERE vin_no = '$vin' && accident_ref_no = '$arn'"; 
	$resultsthree = mysqli_query($db, $querythree); 
	$rowthree = mysqli_fetch_assoc($resultsthree);
	if ($rowthree == "") {
		echo 'donotmatch';
	}
	else if ($rowthree != "") {
		session_start();
		
		$insurer_username = $_SESSION['insurer_username'];
		$impact_id = $rowthree['impact_id'];
		
		$queryfour = "INSERT INTO `claimdata`(`iqrn`, `accident_ref_no`, `vin_no`, `authorize`, `insurer_username`) VALUES (NULL, '$arn', '$vin', 'NO', '$insurer_username')"; 
		$resultsfour = mysqli_query($db, $queryfour); 
		
		$id ="SELECT iqrn FROM claimdata ORDER BY iqrn DESC LIMIT 1";
		$result = mysqli_query($db,$id);
		$row = mysqli_fetch_assoc($result);
		$iqrn = $row['iqrn'];
		
		$subject = "New Claim from Insurer - I.Q.R.N.: $iqrn!";
		$message = "<span style = 'font-size:16px;font-family:verdana'>Dear 911 Administrator,<br/><br/>An Insurer has registered a new claim asking for information regarding <b>Impact ID: $impact_id.</b><br/><span style='font-style:italic;font-size:14px;'>Please attend to this affair as soon as possible, and authorize this incident, based on the <b>I.Q.R.N.: $iqrn</b>.</span><br/><br/>Sincerely,<br/>Automotive Collision Detection Network</span>";
		$to = "om.mailme2002@gmail.com";
		$type = "HTML"; // or HTML
		$charset = "utf-8";
		$mail = "no-reply@".str_replace("www.", "", $_SERVER['SERVER_NAME']);
		$uniqid   = md5(uniqid(time()));
		$headers  = "From: ".$mail."\n";
		$headers .= "Reply-to: ".$mail."\n";
		$headers .= "Return-Path: ".$mail."\n";
		$headers .= "Message-ID: <".$uniqid."@".$_SERVER['SERVER_NAME'].">\n";
		$headers .= "MIME-Version: 1.0"."\n";
		$headers .= "Date: ".gmdate("D, d M Y H:i:s", time())."\n";
		$headers .= "X-Priority: 3"."\n";
		$headers .= "X-MSMail-Priority: Normal"."\n";
		$headers .= "Content-type: text/".$type.";charset=".$charset."\n";
		$headers .= "Content-transfer-encoding: 7bit";

		mail($to, $subject, $message, $headers);		
		echo 'perfectmatch';
	}
	
	session_start();
	$_SESSION['iqrn'] = $iqrn;
}
}
else if ($_GET['prmt'] == 'date') {

$dateone = $_GET['dateone'];
$datetwo = $_GET['datetwo'];
$month = $_GET['month'];
$year = $_GET['year'];
$vin = $_GET['vin'];
$counter = 0;

$querytwo = "SELECT * FROM automotive_impact WHERE vin_no = '$vin'"; 
$resultstwo = mysqli_query($db, $querytwo); 
$rowtwo = mysqli_fetch_assoc($resultstwo);
if ($rowtwo == "") {
	echo 'invalidvin';
	$counter++;
}

if ($counter == 0) {

	$querythree = "SELECT * FROM automotive_impact WHERE year = '$year' && month = '$month' && date >= $dateone && date <= $datetwo"; 
	$resultsthree = mysqli_query($db, $querythree); 
	$rowthree = mysqli_fetch_assoc($resultsthree);
	if ($rowthree == "") {
		echo 'donotmatch';
	}
	else if ($rowthree != "") {
		session_start();
		
		$insurer_username = $_SESSION['insurer_username'];
		$impact_id = $rowthree['impact_id'];
		
		$queryone = "SELECT * FROM automotive_impact WHERE impact_id=$impact_id"; 
		$resultsone = mysqli_query($db, $queryone); 
		$rowone = mysqli_fetch_assoc($resultsone);
		$arn=$rowone['accident_ref_no'];
		
		$queryfour = "INSERT INTO `claimdata`(`iqrn`, `accident_ref_no`, `vin_no`, `authorize`, `insurer_username`) VALUES (NULL, '$arn', '$vin', 'NO', '$insurer_username')"; 
		$resultsfour = mysqli_query($db, $queryfour); 
		
		$id ="SELECT iqrn FROM claimdata ORDER BY iqrn DESC LIMIT 1";
		$result = mysqli_query($db,$id);
		$row = mysqli_fetch_assoc($result);
		$iqrn = $row['iqrn'];
		
		$subject = "New Claim from Insurer - I.Q.R.N.: $iqrn!";
		$message = "<span style = 'font-size:16px;font-family:verdana'>Dear 911 Administrator,<br/><br/>An Insurer has registered a new claim asking for information regarding <b>Impact ID: $impact_id.</b><br/><span style='font-style:italic;font-size:14px;'>Please attend to this affair as soon as possible, and authorize this incident, based on the <b>I.Q.R.N.: $iqrn</b>.</span><br/><br/>Sincerely,<br/>Automotive Collision Detection Network</span>";
		$to = "om.mailme2002@gmail.com";
		$type = "HTML"; // or HTML
		$charset = "utf-8";
		$mail = "no-reply@".str_replace("www.", "", $_SERVER['SERVER_NAME']);
		$uniqid   = md5(uniqid(time()));
		$headers  = "From: ".$mail."\n";
		$headers .= "Reply-to: ".$mail."\n";
		$headers .= "Return-Path: ".$mail."\n";
		$headers .= "Message-ID: <".$uniqid."@".$_SERVER['SERVER_NAME'].">\n";
		$headers .= "MIME-Version: 1.0"."\n";
		$headers .= "Date: ".gmdate("D, d M Y H:i:s", time())."\n";
		$headers .= "X-Priority: 3"."\n";
		$headers .= "X-MSMail-Priority: Normal"."\n";
		$headers .= "Content-type: text/".$type.";charset=".$charset."\n";
		$headers .= "Content-transfer-encoding: 7bit";

		mail($to, $subject, $message, $headers);		
		echo 'perfectmatch';
	}
	
	session_start();
	$_SESSION['iqrn'] = $iqrn;
}
}
?>