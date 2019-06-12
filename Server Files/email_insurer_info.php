<?php
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');

if (!$db)
{
print "<h1>Unable to Connect to MySQL</h1>";
}

$iqrn = $_GET['iqrn'];

$queryone = "UPDATE claimdata SET authorize = 'YES' WHERE iqrn = '$iqrn'"; 
$resultsone = mysqli_query($db, $queryone); 


	$subject = "I.Q.R.N.: $iqrn has just been authorized!";
	$message = "<span style = 'font-size:16px;font-family:verdana'>Dear Insurer,<br/><br/>A 911 administaror has reviewed, and authorized your recent claim asking for information regarding <b>I.Q.R.N.: $iqrn.</b><br/><span style='font-style:italic;font-size:14px;'>You can now view all the required details regarding this incident, including the additional file the administrator has uploaded for your convenience.</span><br/><br/>Sincerely,<br/>Automotive Collision Detection Network</span>";
	
	$query = "SELECT * FROM claimdata WHERE iqrn = '$iqrn'"; 
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	
	$querytwo = "SELECT * FROM insurer WHERE insurer_username = '".$row['insurer_username']."'"; 
	$resultstwo = mysqli_query($db, $querytwo);
	$rowtwo = mysqli_fetch_assoc($resultstwo);
	
	$to = $rowtwo['insurer_email'];
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

	session_start();
$_SESSION['report'] = $iqrn;	
?>