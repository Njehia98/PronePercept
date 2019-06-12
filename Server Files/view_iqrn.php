<?php
	 session_start();
	 $_SESSION['hello'] = "hello";
	 unset($_SESSION['hello']);
	   	  if(isset($_SESSION['login_status_insurer']) == ""  ) {
		header('Location: login_panel.php');   
   }
	 $insurer_username = $_SESSION['insurer_username'];
     $db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Info Query Request No.'s</title>

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

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	<script src="js/jquery-2.1.1.js" type="text/javascript"></script>

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

	</style>

<script>
function getpendingiqrninfo(val) {
	$.ajax({
		type: "POST",
		url: "get_pendingiqrninfo.php",
		data: 'iqrn=' + val,
		success: function(data){
		$("#pendingiqrninfo").html(data);
	}
	});
}
function getprocessediqrninfo(val) {
	$.ajax({
		type: "POST",
		url: "get_processediqrninfo.php",
		data: 'iqrn=' + val,
		success: function(data){
		$("#processediqrninfo").html(data);
	}
	});
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
               
               <li class="active">
                    <a href="view_iqrn.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>INFO QUERY REQUEST NO.'s</p>
                    </a>
                </li>
				<li>
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
                    <a class="navbar-brand" href="#">Info Query Request No.'s</a>
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
		<select onChange="getpendingiqrninfo(this.value);">
			<option selected = 'true' disabled='disabled'>Pending I.Q.R.N.'s:</option>
			<option disabled='disabled'>----</option>
				<?php
					$sql_statement  = "SELECT * FROM claimdata WHERE insurer_username = '$insurer_username' && authorize = 'NO'"; 
					$result = mysqli_query($db, $sql_statement);
						while ($row = mysqli_fetch_assoc($result)) {
				?>
						<option value="<?php echo $row['iqrn'] ?>"><?php echo $row['iqrn'] ?></option>
				<?php
					}
				?>
		</select>
	</label>
</div>
<div id="pendingiqrninfo">
<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">No</span> A.R.N. or V.I.N.</h4>
						<p class="category">Please select the I.Q.R.N to view inputted information</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>A.R.N.</th>
								<th>V.I.N.</th>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</div>
<div style="padding-top:10px;padding-left:15px;">
	<label class="dropdown">
		<select onChange="getprocessediqrninfo(this.value);">
			<option selected = 'true' disabled='disabled'>Processed I.Q.R.N.'s:</option>
			<option disabled='disabled'>----</option>
				<?php
					$sql_statement  = "SELECT * FROM claimdata WHERE insurer_username = '$insurer_username' && authorize = 'YES'"; 
					$result = mysqli_query($db, $sql_statement);
						while ($row = mysqli_fetch_assoc($result)) {
				?>
						<option value="<?php echo $row['iqrn'] ?>"><?php echo $row['iqrn'] ?></option>
				<?php
					}
				?>
		</select>
	</label>
</div>
<div id="processediqrninfo">
<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">No</span> Accident Record</h4>
						<p class="category">Please select the I.Q.R.N to view accident record</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>IMPACT ID</th>
								<th>V.I.N.</th>
								<th>GPS COORDINATES</th>
								<th>IMPACT SIDE</th>
								<th>SPEED</th>
								<th>TIME</th>
								
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">No</span> File Record</h4>
						<p class="category">Please select the I.Q.R.N to view associated file</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>Name</th>
								<th>Type</th>
								<th>Size (KB)</th>
								<th>Download</th>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
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
