<?php
ob_start();
session_start();
$_SESSION['hello'] = "hello";
unset($_SESSION['hello']);
session_destroy();
?>
<script>
window.onload = function() {
<?php
if ($_GET['msg'] == 'logout') {
?>
swal({
title: "Logged Out!",
text: "You have successfully logged out and ended your session!",
type: "success",
confirmButtonColor: '#009900',
confirmButtonText: 'Sounds Good!',
closeOnConfirm: false,
html: true,
},
function (isConfirm) {
	if (isConfirm) {
		location.href = 'login_panel.php';
	}
});
<?php 
}
?>
}
</script>
<script>
function validation() {
	var username = document.getElementById('form-username').value;
	var password = document.getElementById('form-password').value;
	if (username == "") {
		swal({
		title: "Required Username!",
		text: "You must enter your username to LOG IN!",
		type: "warning",
		confirmButtonColor: '#ff9933',
		confirmButtonText: 'Okay!',
		html: true
	});
	}
	else if (password == "") {
		swal({
		title: "Required Password!",
		text: "You must enter your password to LOG IN!",
		type: "warning",
		confirmButtonColor: '#ff9933',
		confirmButtonText: 'Okay!',
		html: true
	});
	}
	else {
		
	    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
			xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var href = xmlhttp.responseText;
				if (href == 'wrongpassword') {
					swal({
						title: "Invalid Credentials!",
						text: "Your username and password are incorrect!",
						type: "error",
						confirmButtonColor: 'red',
						confirmButtonText: 'Okay!',
						html: true
					});
				}
				else {
				location.href = href;
				}
            }
        }
		xmlhttp.open("GET","login_info.php?username="+username+"&password="+password,true);
        xmlhttp.send();
	}
}
</script>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>LOG IN</title>
  <script src="js/sweetalert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="js/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>
<div class="container">
<div id="login">
<form>
<h1 style="font-size:60px;">Welcome<br/><br/></h1><div style="font-size:15px;"><b style="font-weight:bold"><br/>Trial Purposes Credentials - </b></div><br/><h6 style="font-size:10px;"><b style="font-weight:bold">(911 administrator)</b>: Username - <i style="font-style:italic">admin</i> | Password - <i style="font-style:italic">pass</i></h6><h6 style="font-size:10px;"><b style="font-weight:bold">(Insurer)</b>: Username - <i style="font-style:italic">om</i> | Password - <i style="font-style:italic">pass</i></h6><br/>
<fieldset class="clearfix">
<p><span class="fontawesome-user"></span><input type="text" placeholder="Username" id='form-username'>
<p><span class="fontawesome-lock"></span><input type="password" placeholder="Password" id='form-password'>
<p>
</fieldset>
</form>
<input type="submit" value="Sign In" onclick='validation()'></p>
<p><a href="http://www.omagarwal.net" class="blue">Who am I</a><span class="fontawesome-arrow-right"></span></p>
</div> <!-- end login -->
</div>
</body>
</html>
