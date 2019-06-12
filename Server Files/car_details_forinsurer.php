<?php
$page = $_SERVER['PHP_SELF'];
//$sec = "5";

	 session_start();
	 $_SESSION['hello'] = "hello";
	 unset($_SESSION['hello']);
	   	  if(isset($_SESSION['login_status_insurer']) == ""  ) {
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
	
	<title>Car Information</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	
	
	
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
		function getvinno(val) {
			$.ajax({
			type: "POST",
			url: "get_vinno.php",
			data: 'region=' + val,
			success: function(data){
				$("#vinno").html(data);
			}
			});
		}
		function getcarinfo(val) {
			$.ajax({
			type: "POST",
			url: "car_info.php",
			data: 'vinno=' + val,
			success: function(data){
				$("#carinfo").html(data);
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

	</style>
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
                        <i class="pe-7s-credit"></i>
                        <p>Car Information</p>
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
                    <a class="navbar-brand" href="#">Car Information</a>
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
       <div style="padding-top:10px;">
		<a style="text-decoration:none;color:blue;text-align:center;padding-left:15px;" href="view_iqrn.php"><span style="font-size:11px;text-align:center">(GO BACK)</span></a>
 <section class="demo">
						
<?php
	if(isset($_GET['q'])) {
		$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
		$sql_statement  = 'SELECT * FROM car_details WHERE vinno = '.$_GET['q'].''; 
		$result = mysqli_query($db, $sql_statement);						
?>
<h3 class="title" style="font-weight:100;padding-left:15px;">Showing Results for: <span style="font-weight:bold;font-size:20px"><?php echo $_GET['q']; ?></span></h4>

<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;">Car <span style="font-weight:bold;">Distinction</span></h4>
						<p class="category">Here is the appropriate data for the selected V.I.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>V.I.N</th>
								<th>OWNER</th>
								<th>MASTER NO.</th>
								<th>MAKE</th>
								<th>MODEL</th>
								<th>YEAR</th>
							</thead>
							<tbody>
								<?php
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_GET['q'].'"';
								$result = mysqli_query($db, $sql_statement);
								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td><a style="color:blue" style="font-size:10px;"><?php echo $row['vin_no']; ?></a></td>
									<td><span style="font-size:14px;"><?php echo $row['owner']; ?></td>
									<td style="font-size:14px;"><?php echo $row['master_no']; ?></td>
									<td style="font-size:14px;"><?php echo $row['make']; ?></td>
									<td style="font-size:14px;"><?php echo $row['model']; ?></td>
									<td style="font-size:14px;"><?php echo $row['year']; ?></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;">Car <span style="font-weight:bold;">Specs</span></h4>
						<p class="category">Here is the appropriate data for the selected V.I.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>COLOR</th>
								<th>TYPE</th>
								<th>CYLINDER</th>
								<th>FUEL</th>
								<th>WEIGHT (KG)</th>
								<th>REGION</th>
							</thead>
							<tbody>
								<?php
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_GET['q'].'"';
								$result = mysqli_query($db, $sql_statement);
								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td style="font-size:14px;"><?php echo $row['color']; ?></td>
									<td style="font-size:14px;"><?php echo $row['type']; ?></td>
									<td style="font-size:14px;"><?php echo $row['cylinder']; ?></td>
									<td style="font-size:14px;"><?php echo $row['fuel']; ?></td>
									<td style="font-size:14px;"><?php echo $row['weight_kg']; ?></td>
									<td style="font-size:14px;"><?php echo $row['region']; ?></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;">Insurance <span style="font-weight:bold;">Details</span></h4>
						<p class="category">Here is the appropriate data for the selected V.I.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>INSURANCE POLICY NO.</th>
								<th>INSURER</th>
								<th>AGENCY (PROVIDER)</th>
							</thead>
							<tbody>
								<?php
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_GET['q'].'"';
								$result = mysqli_query($db, $sql_statement);
								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td style="font-size:14px;"><?php echo $row['insurance_policy_no']; ?></td>
									<td style="font-size:14px;"><?php echo $row['insurer']; ?></td>
									<td style="font-size:14px;"><?php echo $row['insurance_agency']; ?></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
	
	$sql_statement  = 'SELECT * FROM automotive_impact WHERE vin_no = "'.$_GET['q'].'"  ORDER BY impact_id DESC';
	$result = mysqli_query($db, $sql_statement);
	$rowcount=mysqli_num_rows($result);
	if ($rowcount == 0) {

	?>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">No</span> Accident History</h4>
						<p class="category">No appropriate data for the selected V.I.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>IMPACT ID</th>
								<th>ACCIDENT REF. NO.</th>
								<th>GPS COORDINATES</th>
								<th>IMPACT SIDE</th>
								<th>SPEED</th>
								<th>TIME</th>
								<th>VEHICLE(S) INVOLVED</th>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	
	}
	else {
		
	?>
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;">Accident <span style="font-weight:bold;">History</span></h4>
						<p class="category">Here is the appropriate data for the selected V.I.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>IMPACT ID</th>
								<th>ACCIDENT REF. NO.</th>
								<th>GPS COORDINATES</th>
								<th>IMPACT SIDE</th>
								<th>SPEED</th>
								<th>TIME</th>
								<th>VEHICLE(S) INVOLVED</th>
							</thead>
							<tbody>
								<?php
								$sql_statement  = 'SELECT * FROM automotive_impact WHERE vin_no = "'.$_GET['q'].'"  ORDER BY impact_id DESC';
								$result = mysqli_query($db, $sql_statement);
								$rowcount=mysqli_num_rows($result);
								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
                                        	<td><?php echo $row['impact_id']; ?></td>
                                        	<td><?php echo $row['accident_ref_no']; ?></td>
                                        	<td><span style="font-size:10px;"><?php echo $row['gps_coord']; ?></span><br/><a target="_blank" href="http://www.google.com/maps/place/<?php echo $row['gps_coord'];?>/@<?php echo $row['gps_coord'];?>,17z"><i class="fa fa-external-link" aria-hidden="true"></i> View in Google Maps</a></td>
                                        	<td><?php echo $row['side']; ?></td>
                                        	<td><?php echo $row['speed']; ?></td>
                                        	<td><?php echo $row['date'] . " " . $row['month'] . ", " . $row['year'] . " (" . $row['hour'] . ":" . $row['minute'] . ":" . $row['second'] . ")"; ?></td>
                                        	<td style="font-size:10px;">
											
											<?php 
												$sql_statement  = 'SELECT * FROM automotive_impact ORDER BY impact_id ASC'; 
												$resulttwo = mysqli_query($db, $sql_statement);
												while ($rowtwo = mysqli_fetch_array($resulttwo)) {
													if ($row['year'] == $rowtwo['year'] && $row['month'] == $rowtwo['month'] && $row['date'] == $rowtwo['date']) {
														if ($row['vin_no'] != $rowtwo['vin_no'] && $row['hour'] == $rowtwo['hour'] && $row['minute'] == $rowtwo['minute'] && $row['second'] == $rowtwo['second']) {
															
														echo $rowtwo['vin_no']."<br/>";
														
														}
													}
												}
											
											
											?>
											<a href="accident_details.php?q=<?php echo $row['accident_ref_no']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> View Full Record</a>
										</td>
										</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>	
</div>

	<?php } ?>		
</section>	
</div>
       
								


    </div> </div>

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