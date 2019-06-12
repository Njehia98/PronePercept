<?php
$page = $_SERVER['PHP_SELF'];
//$sec = "5";

	 session_start();
	 $_SESSION['hello'] = "hello";
	 unset($_SESSION['hello']);
	   	  if(isset($_SESSION['login_status_admin']) == ""  ) {
		header('Location: login_panel.php');   
   }


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Email Insurer</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	
	<script src="js/sweetalert/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="js/sweetalert/dist/sweetalert.css">
	
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
	
	<script src="js/jquery-2.1.1.js" type="text/javascript"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    
	<script>
		
function validation() {
			
var region = document.getElementById('region').value;
var iqrn = document.getElementById('iqrn').value;
if (region == "" && iqrn == "") {
swal({
	title: "Unable to process input!",
	text: "Please enter both the parameters - <b>Region & I.Q.R.N.</b> to continue!",
	type: "warning",
	confirmButtonColor: '#ff9933',
	confirmButtonText: 'Okay!',
	html: true
});
	
}
else if (region == "") {
swal({
		title: "Unable to process input!",
		text: "Please choose the <b>region</b> to continue!",
		type: "warning",
		confirmButtonColor: '#ff9933',
		confirmButtonText: 'Okay!',
		html: true
	});
	
}
else if (iqrn == "") {
swal({
		title: "Unable to process input!",
		text: "Please choose the <b>I.Q.R.N.</b> to continue!",
		type: "warning",
		confirmButtonColor: '#ff9933',
		confirmButtonText: 'Okay!',
		html: true
	});
}
else if (document.getElementById("sortpicture").files.length == 0){
swal({
		title: "Unable to process input!",
		text: "Please attach a <b>PDF/Image file</b> to continue!",
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
			 
					 var code = xmlhttp.responseText;
					 swal({
							title: "Processing...",
							text: "Please wait, while your inputs are being processed.",
							type: "info",
							showConfirmButton: false
						});
					
				}
			};
			xmlhttp.open("GET","email_insurer_info.php?iqrn="+iqrn,true);
			xmlhttp.send(); 
			
			var file_data = jQuery('#sortpicture').prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('file', file_data);
								  
			jQuery.ajax({
				url: 'file_upload.php', // point to server-side PHP script 
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(php_script_response){
					swal({
							title: "I.Q.R.N. Successfully Authorized!",
							text: "You have successfully authorized the <b>I.Q.R.N.:"+iqrn+"</b>! The insurer is now able to view all the details pertaining to this record, including the file that you have attached. An email has also been sent to the insurer, regarding this clearance.",
							type: "success",
							confirmButtonColor: 'green',
							confirmButtonText: 'Sounds Good!',
							html: true
						});
				}
			 });
			 
			var wrapper = document.getElementById("wrapper");
			wrapper.style.display = 'none';
	
}

}
		
		function getiqrn(val) {
			$.ajax({
			type: "POST",
			url: "get_iqrn.php",
			data: 'region=' + val,
			success: function(data){
				$("#iqrn").html(data);
			}
			});
		}
	</script>
	
	<style>
label.dropdown select {
	padding: 10px 42px 10px 10px;
	background: #f8f8f8;
	color: #444;
	border: 1px solid #aaa;
	border-radius: 0;
	display: inline-block;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	cursor: pointer;
	outline: none;
	font-weight:100;
	font-size:16px;
}
label.dropdown select:-moz-focusring {
	color: transparent;
	text-shadow: 0 0 0 #444;
}
label.dropdown select::-ms-expand {
	display: none;
}

label.dropdown { position: relative; }
label.dropdown:after {
	content: '>';
	font: 16px Consolas, monospace;
	color: #444;
	-webkit-transform: rotate(90deg);
	-moz-transform: rotate(90deg);
	-ms-transform: rotate(90deg);
	transform: rotate(90deg);
	right: 2px;
	top: -3px;
	border-bottom: 1px solid #aaa;
	position: absolute;
	pointer-events: none;
	width: 35px;
	margin-top:12px;
	padding: 0 0 5px 0;
	text-indent: 14px;
}
html, body {
	padding: 0;
	margin: 0;
	width: 100%;
	height: 100%;
}
a {
	cursor:pointer;
}
.biliboard {
	width: 400px;
	padding: 18px;
	text-align: center;
	position: relative;
	background: #fff;
	color: #333;
}
	</style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                 <a class="simple-text" style="font-size:28px;font-weight:bold">
                    A. C. D. N.<br/><span style="font-size:15px;">Navigation System</span>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="table.php">
                        <i class="pe-7s-note2"></i>
                        <p>Impact Data</p>
                    </a>
                </li>
				<li>
                    <a href="car.php">
                        <i class="pe-7s-server"></i>
                        <p>Car Information</p>
                    </a>
                </li>
				<li>
                    <a href="accident.php">
                        <i class="pe-7s-network"></i>
                        <p>Accident Records</p>
                    </a>
                </li>
				<li class="active">
                    <a href="email_insurer.php">
                        <i class="pe-7s-mail-open-file"></i>
                        <p>Email Insurer</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

         

        

<div class="main-panel">
<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Email Insurer</a>
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
		<div style="padding-top:10px;">
		<a style="text-decoration:none;color:blue;text-align:center;padding-left:15px;" href="login_panel.php?msg=logout"><span style="font-size:11px;text-align:center">(LOG OUT)</span></a>
 <section class="demo">
	
<div style="padding-top:30px;padding-left:15px;">
	<label class="dropdown">
		<select onChange="getiqrn(this.value);" id='region'>
			<option selected = 'true' value="" disabled='disabled'>Please select a region:</option>
			<option disabled='disabled' value="">----</option>
				<?php
					$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
					$sql_statement  = 'SELECT * FROM region'; 
					$result = mysqli_query($db, $sql_statement);
						while ($row = mysqli_fetch_assoc($result)) {
				?>
						<option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
				<?php
									
					}
				?>

		</select>
	</label>
</div>
	
<div style="padding-top:10px;padding-left:15px;">
	<label class="dropdown">
		<select id = 'iqrn'>
			<option selected = 'true' value="" disabled='disabled'>Choose a region before I.Q.R.N.:</option>
			<option disabled='disabled' value="">----</option>
		</select>
	</label>
	<br/><br/><br/>
	<input type="file" name="uploaded_file" id="sortpicture"><br>
      <br/><br/>
<a class="biliboard radial" onclick = 'validation()' style='font-size:17px;color:grey;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Authorize</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>	  
</div>

</section>	
</div>
</div> 
</div>

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
