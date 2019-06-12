<?php
	 session_start();
	 $_SESSION['hello'] = "hello";
	 unset($_SESSION['hello']);
	   	  if(isset($_SESSION['login_status_insurer']) == ""  ) {
		header('Location: login_panel.php');   
   }
	 
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>File I.Q.R.N.'s</title>

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
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" href="css/contact-form.css">
	<link rel="stylesheet" href="css/style_contact.css">
	<script src="js/jquery.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

<style>

.style input[type="text"] {
  font-family: sans-serif;
  font-size: 18px;
  appearance: none;
  box-shadow: none;
  border-radius: none;
  padding: 10px;
  border: none;
  border-bottom: solid 2px #c9c9c9;
  transition: border 0.3s;
}
.style input[type="text"]:focus,
.style input[type="text"].focus {
  border-bottom: solid 2px #000000;
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

<script>
function validation() {
	if (document.getElementById('radio1').checked) {
	var arn = document.getElementById('arn').value;
	var vin = document.getElementById('vin').value;

	if (arn == "" && vin == "") {
		
	swal({
		title: "Unable to process input!",
		text: "Please enter both the parameters - <b>A.R.N. & V.I.N.</b> to continue!",
		type: "warning",
		confirmButtonColor: '#ff9933',
		confirmButtonText: 'Okay!',
		html: true
	});
		
	}
	else if (arn == "") {

	swal({
			title: "Unable to process input!",
			text: "Please enter the <b>A.R.N.</b> to continue!",
			type: "warning",
			confirmButtonColor: '#ff9933',
			confirmButtonText: 'Okay!',
			html: true
		});
		
	}
	else if (vin == "") {

		swal({
			title: "Unable to process input!",
			text: "Please enter the <b>V.I.N</b> to continue!",
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
						if (code == "invalidarn") {
							swal({
								title: "Invalid A.R.N.!",
								text: "No such record was found, pertaining to the specified A.R.N. (<b>"+arn+"</b>), in the accident entry database. Please enter the correct one to proceed!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "invalidvin") {
							swal({
								title: "Invalid V.I.N.!",
								text: "No such record was found, pertaining to the specified V.I.N (<b>"+vin+"</b>), in the accident entry database. Please enter the correct one to proceed!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "invalidarninvalidvin") {
							swal({
								title: "Invalid A.R.N. & V.I.N.!",
								text: "No such record was found, pertaining to the specified V.I.N (<b>"+vin+"</b>), or A.R.N. (<b>"+arn+"</b>), in the accident entry database. Please enter the right parameters to proceed!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "donotmatch") {
							swal({
								title: "No Record Found!",
								text: "No such accident record of the specified V.I.N (<b>"+vin+"</b>), is linked to the provided A.R.N. (<b>"+arn+"</b>), in the accident entry database. Please enter common parameters for the record to file the claim!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "perfectmatch") {
							swal({
								title: "I.Q.R.N. Successfully Filed!",
								text: "A record, pertaining to the specified V.I.N (<b>"+vin+"</b>), and A.R.N. (<b>"+arn+"</b>), was successfully found in the accident entry database. The 911 administrator has been rightfully informed about your claim, and will attend to your request as soon as possible. You will get an email on your registered address of the affair when this happens!",
								type: "success",
								confirmButtonColor: 'green',
								confirmButtonText: 'Sounds Good!',
								closeOnConfirm: false,
								html: true
							},
							function(isConfirm){
							if (isConfirm){
								location.href = "file_iqrn_backend.php";
							}
							});
						}
					}
				};
				xmlhttp.open("GET","file_iqrn_info.php?arn="+arn+"&vin="+vin+"&prmt=arn",true);
				xmlhttp.send(); 
				swal({
								title: "Processing...",
								text: "Please wait, while your inputs are being processed.",
								type: "info",
								showConfirmButton: false
							});
		
		var wrapper = document.getElementById("wrapper");
		wrapper.style.display = 'none';
		
	}
	}
	else if (document.getElementById('radio2').checked) {
	var vin = document.getElementById('vin').value;
	var dateone = document.getElementById('dateone').value;
	var datetwo = document.getElementById('datetwo').value;
	var month = document.getElementById('month').value;
	var year = document.getElementById('year').value;

		if  (dateone > datetwo) {
			var d1 = datetwo;
			var d2 = dateone;
			
			var dateone = d1;
			var datetwo = d2;
		}
		var datediff = datetwo - dateone;
		if (vin == "") {

			swal({
				title: "Unable to process input!",
				text: "Please enter the <b>V.I.N</b> to continue!",
				type: "warning",
				confirmButtonColor: '#ff9933',
				confirmButtonText: 'Okay!',
				html: true
			});
		}
		
		
		else if (datediff > 15) {
		swal({
			title: "Unable to process input!",
			text: "Please make sure the <b>difference between the two dates is no more that 15 days</b>, to continue!",
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
						if (code == "invalidvin") {
							swal({
								title: "Invalid V.I.N.!",
								text: "No such record was found, pertaining to the specified V.I.N (<b>"+vin+"</b>), in the accident entry database. Please enter the correct one to proceed!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "donotmatch") {
							swal({
								title: "No Record Found!",
								text: "No such accident record of the specified V.I.N (<b>"+vin+"</b>), has been found in the date range of <b>"+dateone+" - "+datetwo+" "+month+", "+year+"</b>, in the accident entry database. Please enter correct parameters for the record to file the claim!",
								type: "error",
								confirmButtonColor: 'red',
								confirmButtonText: 'Okay!',
								html: true
							});
						}
						else if (code == "perfectmatch") {
							swal({
								title: "I.Q.R.N. Successfully Filed!",
								text: "A record, pertaining to the specified V.I.N (<b>"+vin+"</b>), in the date range of <b>"+dateone+" - "+datetwo+" "+month+", "+year+"</b>, was successfully found in the accident entry database. The 911 administrator has been rightfully informed about your claim, and will attend to your request as soon as possible. You will get an email on your registered address of the affair when this happens!",
								type: "success",
								confirmButtonColor: 'green',
								confirmButtonText: 'Sounds Good!',
								closeOnConfirm: false,
								html: true
							},
							function(isConfirm){
							if (isConfirm){
								location.href = "file_iqrn_backend.php";
							}
							});
						}
					}
				};
				xmlhttp.open("GET","file_iqrn_info.php?dateone="+dateone+"&datetwo="+datetwo+"&month="+month+"&year="+year+"&vin="+vin+"&prmt=date",true);
				xmlhttp.send(); 
				swal({
						title: "Processing...",
						text: "Please wait, while your inputs are being processed.",
						type: "info",
						showConfirmButton: false
				});
		
		var wrapper = document.getElementById("wrapper");
		wrapper.style.display = 'none';
		
	}
	}
}

</script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text" style="font-size:28px;font-weight:bold">
                    A. C. D. N.<br/><span style="font-size:15px;">Navigation System</span>
                </a>
            </div>

            <ul class="nav">
                
               <li>
                    <a href="view_iqrn.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>INFO QUERY REQUEST NO.'s</p>
                    </a>
                </li>
				<li class="active">
                    <a href="file_iqrn.php">
                        <i class="pe-7s-note"></i>
                        <p>FILE I.Q.R.N.'s</p>
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
                    <a class="navbar-brand" href="#">File I.Q.R.N.'s</a>
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
       <div style="padding-top:10px;">
		<a style="text-decoration:none;color:blue;text-align:center;padding-left:15px;" href="login_panel.php?msg=logout"><span style="font-size:11px;text-align:center">(LOG OUT)</span></a>
 <section>
	
<div class="style" style="padding-top:30px;padding-left:15px;">
	<div style='font-size:17px;color:grey;margin-bottom:5px;'>Enter V.I.N.<br/></div>
	  <input type="text" style="width:250px;" id='vin'>
		<br/><br/><br/>
		 	<div style='font-size:17px;color:grey'>Is client aware of A.R.N.?<br/><span style='font-size:12px;'>(If not, system will verify through date mechanism)</span></div>
 <span>
 <script>
function func() {
   var one = document.getElementById('one');
   one.style.display = 'block';
   var two = document.getElementById('two');
   two.style.display = 'none';
}
</script>
<input type="radio" name="radio" value = 'YES' id="radio1" class="radio"  onChange="func()" checked/>
<label for="radio1">YES</label><br/><br/><br/><br/>
<div id='one' style="margin-left:20px;"><div style='font-size:17px;color:grey;margin-bottom:5px;'>Enter A.R.N.<br/></div>
<input type="text" style="width:150px;" id='arn'></div>
</span>

<span>
<script>
function fun() {
   var one = document.getElementById('one');
   one.style.display = 'none';
   var two = document.getElementById('two');
   two.style.display = 'block';
}
</script>
<input type="radio" name="radio" value = 'NO' id="radio2" class="radio" onChange="fun()"/>
<label for="radio2">NO</label><br/><br/><br/><br/>
<div id='two' style="margin-left:20px;display:none;"><div style='font-size:17px;color:grey;margin-bottom:5px;'>Enter Approx. Date Range<br/><span style='font-size:12px;'>(The difference between the dates can't be >15 days)</span><br/>
<span style='font-size:15px;'>
<select name = 'dateone' style="width:50px;" id='dateone' style='float:left'>
<?php 

for ($i=1;$i<=31;$i++) {
	if ($i<10) {
		echo "<option>0$i</option>";
	}
	else {
		echo "<option>$i</option>";
	}
}

?>
</select>
<img style='height:80px;position:absolute' src='assets/img/dash.png' />
<img style='height:80px;' src='assets/img/dashbtn.png' />
<select name = 'datetwo' style="width:50px;" id='datetwo' style='float:left'>
<?php 

for ($i=1;$i<=31;$i++) {
	if ($i<10) {
		echo "<option>0$i</option>";
	}
	else {
		echo "<option>$i</option>";
	}
}

?>
</select><br/>
<select name = 'month' style="width:95px;" id='month' size='3' style='float:left'>
<?php 

/* for ($i=1;$i<=12;$i++) {
echo "<option>" . date('F', mktime(0,0,0,$i,1)) . "</option>";
} */

if ("January" == date('F')) {	echo "<option selected='true' value='January'>January</option>";   } else {	echo "<option value='January'>January</option>";  }
if ("February" == date('F')) {	echo "<option selected='true' value='February'>February</option>";   } else {	echo "<option value='February'>February</option>";  }
if ("March" == date('F')) {	echo "<option selected='true' value='March'>March</option>";   } else {	echo "<option value='March'>March</option>";  }
if ("April" == date('F')) {	echo "<option selected='true' value='April'>April</option>";   } else {	echo "<option value='April'>April</option>";  }
if ("May" == date('F')) {	echo "<option selected='true' value='May'>May</option>";   } else {	echo "<option value='May'>May</option>";  }
if ("June" == date('F')) {	echo "<option selected='true' value='June'>June</option>";   } else {	echo "<option value='June'>June</option>";  }
if ("July" == date('F')) {	echo "<option selected='true' value='July'>July</option>";   } else {	echo "<option value='July'>July</option>";  }
if ("August" == date('F')) {	echo "<option selected='true' value='August'>August</option>";   } else {	echo "<option value='August'>August</option>";  }
if ("September" == date('F')) {	echo "<option selected='true' value='September'>September</option>";   } else {	echo "<option value='September'>September</option>";  }
if ("October" == date('F')) {	echo "<option selected='true' value='October'>October</option>";   } else {	echo "<option value='October'>October</option>";  }
if ("November" == date('F')) {	echo "<option selected='true' value='November'>November</option>";   } else {	echo "<option value='November'>November</option>";  }
if ("December" == date('F')) {	echo "<option selected='true' value='December'>December</option>";   } else {	echo "<option value='December'>December</option>";  }?>
</select>
&nbsp;&nbsp;&nbsp;
<select name = 'year' style="width:75px;" id='year' size='3' style='float:left'>
<?php 
echo "<option selected='true'>".date('Y')."</option>";
for ($i= date('Y') - 1;$i >= 2012;$i--) {

echo "<option>$i</option>";
}

?>
</select></span></div></div>
</span>
</h5>
		<br/><br/><br/>
		<a class="biliboard radial" onclick = 'validation()' style='font-size:17px;color:grey;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Submit</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
</div>
<br/><br/><br/>
			
</section>	
</div>
       
								


    </div> </div>

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    


</html>
