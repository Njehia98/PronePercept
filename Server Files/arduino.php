<?php

$parameter = $_GET['q'];
$parameter = explode('|', $parameter);

//Sample URL ($_GET['q']): http://www.acdn.omagarwal.net/arduino.php?q=YYY|Z (92%)|45.551944444444445|63.668888888888894|0.09|19|1|5|2|27|19|

$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
date_default_timezone_set('GMT');
										
$year = $parameter[5];
$month = $parameter[6];
$date = $parameter[7];
$hour = $parameter[8];
$minute = $parameter[9];
$second = $parameter[10];

$gps = "".$parameter[2].", ".$parameter[3]."";

if ($parameter[1] == "0") {
	$side = "Front";
}
elseif ($parameter[1] == "1") {
	$side = "Top";
}
elseif ($parameter[1] == "2") {
	$side = "Rear";
}
elseif ($parameter[1] == "3") {
	$side = "Left";
}
elseif ($parameter[1] == "4") {
	$side = "Right";
}
else {
	$side = $parameter[1];
}

$query = "INSERT INTO `automotive_impact`(`impact_id`, `vin_no`, `gps_coord`, `side`, `speed`, `year`, `month`, `date`, `hour`, `minute`, `second`) VALUES (NULL, '".$parameter[0]."', '".$gps."', '".$side."', '".$parameter[4]." mph', '".$year."', '".$month."', '".$date."', '".$hour."', '".$minute."', '".$second."')";
$result = mysqli_query($db,$query);
$hours = array($hour - 1, $hour, $hour + 1);

if ($result) {

$query = "SELECT * FROM `automotive_impact` ORDER BY impact_id DESC LIMIT 0,1";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
$impact_id = $row['impact_id'];

$query = "SELECT * FROM `automotive_impact` ORDER BY impact_id";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);

$counter = 0;

while ($row = mysqli_fetch_assoc($result)) {
	if ($row['year'] == $year && $row['month'] == $month && $row['date'] == $date && in_array($row['hour'], $hours) && $gps == $row['gps_coord'] && $row['vin_no'] != $parameter[0]) {
			$query = "UPDATE `automotive_impact` SET `accident_ref_no`= '".$row['accident_ref_no']."' WHERE `impact_id` = '".$impact_id."'";
			$accrefno = $row['accident_ref_no'];
			$final_result = mysqli_query($db, $query);
			$counter++;
	}
}

if ($counter == 0) {
	$accrefno = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5);	
	$query = "UPDATE `automotive_impact` SET `accident_ref_no`= '".$accrefno."' WHERE `impact_id` = '".$impact_id."'";
	$final_result = mysqli_query($db, $query);
}

$query = "SELECT * FROM `email` WHERE id = 1";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
if ($row['nine_one_one'] == 'checked') {
	
$query = "SELECT * FROM `car_details` WHERE vin_no='$parameter[0]'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);
$phone=$row['security_phone'];

$msg = "<span style = 'font-size:16px;font-family:verdana'>Dear 911 Administrator,<br/><br/>The network have recieved recent knowledge that an unfortunate accident has caused an automotive collision at <b><a href='http://www.google.com/maps/place/$parameter[2]/@$parameter[3],17z' style='color:#33ccff'>this location</a></b>.<br/><br/><b>Details:</b><br/>V.I.N: <b style='color:blue'>$parameter[0]</b><br/>Impact Side: <b style='color:red'>$side</b><br/>Speed: <b style='color:blue'>$parameter[4] mph</b><br/>Driver's Registered Phone #: <b style='color:purple'>$phone</b><br/>A.R.N. Generated: <b style='color:green'>$accrefno</b> <span style='color:pink'>(Impact ID - <b>$impact_id</b>)</span><br/>Detection Time: <b style='color:orange'>$date $month, $year ($hour:$minute:$second) GMT</b><br/><br/>Sincerely,<br/>Automotive Collision Detection Network</span>";

//$to = "911@email.gov";
$to = "om000developer@gmail.com";
$subject = "New Automotive Impact Detected";
$mail = "omagarwal.net";
$type = "HTML"; // or HTML
$charset = "utf-8";
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

mail($to, $subject, $msg, $headers);	

}

}
elseif($_GET['q'] == "") {
	echo "Please don't mess around!";
}
else {
	echo "Oops...Something went wrong!<br/><br/>";
	echo("<b>MySQL No: ".mysqli_errno($db)."</b><br/>");
	echo("<b>MySQL Error: ".mysqli_error($db)."</b><br/>");
	echo("<b>SQL: ".$query."</b><br/>");
	echo("<b>MySQL Affected Rows: ".mysqli_affected_rows($db)."</b><br/>");
				
}
echo "<script>window.close();</script>";
?>