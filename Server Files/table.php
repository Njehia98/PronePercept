<?php
$page = $_SERVER['PHP_SELF'];
$sec = "86400";

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

	<title>Impact Data</title>

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


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
     <script src="js/sweetalert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="js/sweetalert/dist/sweetalert.css">
  <script>
  
  function refreshData()
	{
		x = 1;  // 5 Seconds
		
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("temp").innerHTML = xmlhttp.responseText;
			}
        };
		xmlhttp.open("GET","constant_updates.php",true);
        xmlhttp.send();

		setTimeout(refreshData, x*1000);
	}

	refreshData(); // execute function

	/*
window.onload = function () {
	swal({
		title: "<b>NEW</b> Accident Discovered!",
		text: "Dear <em>emergency responder</em> - a new accident has been detected using <b>Prone Percept</b> since you were last here. Kindly view details of the incident as soon as possible.",
		type: "success",
		confirmButtonColor: '#FF0000',
		confirmButtonText: 'Got it!',
		closeOnConfirm: true,
		html: true,
	});
} 
*/  

</script>
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
                <li class="active">
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
				<li>
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
                    <a class="navbar-brand" href="#">Impact Data</a>
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div style="padding-top:10px;">
		<a style="text-decoration:none;color:blue;text-align:center;padding-left:15px;" href="login_panel.php?msg=logout"><span style="font-size:11px;text-align:center">(LOG OUT)</span></a>
<div class="content" style="padding-top:27px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="font-weight:100;">Results for <span style="font-weight:bold;">Today</span></h4>
                                <p class="category">Showing Automotive Impact Data</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>IMPACT ID</th>
                                    	<th>ACCIDENT REF. NO.</th>
										<th>V.I.N.</th>
                                    	<th>GPS COORDINATES</th>
                                    	<th>IMPACT SIDE</th>
                                    	<th>SPEED</th>
                                    	<th>TIME</th>
										<th>VEHICLE(S) INVOLVED</th>
                                    </thead>
                                    <tbody id = "temp">
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="font-weight:100;">Results for <span style="font-weight:bold;">this Month (<?php echo date('F'); ?>)</span></h4>
                                <p class="category">Showing Automotive Impact Data</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>IMPACT ID</th>
                                    	<th>ACCIDENT REF. NO.</th>
										<th>V.I.N</th>
                                    	<th>GPS COORDINATES</th>
                                    	<th>IMPACT SIDE</th>
                                    	<th>SPEED</th>
                                    	<th>TIME</th>
										<th>VEHICLE(S) INVOLVED</th>
                                    </thead>
                                    <tbody>
                                        <?php
										$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
										date_default_timezone_set('GMT');
										$current_year = date('Y');
										$current_month = date('F');
										$current_date = date('d');
										$current_hour = date('H');
										$current_minute = date('i');
										$current_second = date('s');
										$sql_statement  = 'SELECT * FROM automotive_impact ORDER BY impact_id DESC'; 
										$result = mysqli_query($db, $sql_statement);
											while ($row = mysqli_fetch_assoc($result)) {
												if ($current_month == $row['month'] && $current_year == $row['year'] && $current_date != $row['date']) {
										
										?>
										<tr>
                                        	<td><?php echo $row['impact_id']; ?></td>
                                        	<td><?php echo $row['accident_ref_no']; ?></td>
                                        	<td><a style="color:blue" href="car_details.php?q=<?php echo $row['vin_no']; ?>"><?php echo $row['vin_no']; ?></a></td>
                                        	<td><span style="font-size:10px;"><?php echo $row['gps_coord']; ?></span><br/><a target="_blank" href="http://www.google.com/maps/place/<?php echo $row['gps_coord'];?>/@<?php echo $row['gps_coord'];?>,17z"><i class="fa fa-external-link" aria-hidden="true"></i> View in Google Maps</a></td>
                                        	<td><?php echo $row['side']; ?></td>
                                        	<td><?php echo $row['speed']; ?></td>
                                        	<td><?php echo $row['date'] . " " . $row['month'] . ", " . $row['year'] . " (" . $row['hour'] . ":" . $row['minute'] . ":" . $row['second'] . ")"; ?> GMT</td>
                                        	<td style="font-size:10px;">
											
											<?php 
												$sql_statement  = 'SELECT * FROM automotive_impact ORDER BY impact_id ASC'; 
												$resulttwo = mysqli_query($db, $sql_statement);
												while ($rowtwo = mysqli_fetch_array($resulttwo)) {
													if ($row['accident_ref_no'] == $rowtwo['accident_ref_no']) {
															
														echo $rowtwo['vin_no']."<br/>";
														
													}
												}
												
											?>
											<a href="accident_details.php?q=<?php echo $row['accident_ref_no']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> View Full Record</a>
										</td>
										</tr>
                                        <?php
												}
											}
										?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					<div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">ALL</span> Previous Results</h4>
                                <p class="category">Showing Automotive Impact Data</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>IMPACT ID</th>
                                    	<th>ACCIDENT REF. NO.</th>
										<th>V.I.N</th>
                                    	<th>GPS COORDINATES</th>
                                    	<th>IMPACT SIDE</th>
                                    	<th>SPEED</th>
                                    	<th>TIME</th>
										<th>VEHICLE(S) INVOLVED</th>
                                    </thead>
                                    <tbody>
                                        <?php
										
										$current_year = date('Y');
										$current_month = date('F');
										$current_date = date('d');
										$current_hour = date('H');
										$current_minute = date('i');
										$current_second = date('s');
										$sql_statement  = 'SELECT * FROM automotive_impact ORDER BY impact_id DESC'; 
										$result = mysqli_query($db, $sql_statement);
											while ($row = mysqli_fetch_assoc($result)) {
												if ($current_month != $row['month']) {
										
										?>
										<tr>
                                        	<td><?php echo $row['impact_id']; ?></td>
                                        	<td><?php echo $row['accident_ref_no']; ?></td>
                                        	<td><a style="color:blue" href="car_details.php?q=<?php echo $row['vin_no']; ?>"><?php echo $row['vin_no']; ?></a></td>
                                        	<td><span style="font-size:10px;"><?php echo $row['gps_coord']; ?></span><br/><a target="_blank" href="http://www.google.com/maps/place/<?php echo $row['gps_coord'];?>/@<?php echo $row['gps_coord'];?>,17z"><i class="fa fa-external-link" aria-hidden="true"></i> View in Google Maps</a></td>
                                        	<td><?php echo $row['side']; ?></td>
                                        	<td><?php echo $row['speed']; ?></td>
                                        	<td><?php echo $row['date'] . " " . $row['month'] . ", " . $row['year'] . " (" . $row['hour'] . ":" . $row['minute'] . ":" . $row['second'] . ")"; ?> GMT</td>
                                        <td style="font-size:10px;">
											
											<?php 
												$sql_statement  = 'SELECT * FROM automotive_impact ORDER BY impact_id ASC'; 
												$resulttwo = mysqli_query($db, $sql_statement);
												while ($rowtwo = mysqli_fetch_array($resulttwo)) {
													if ($row['accident_ref_no'] == $rowtwo['accident_ref_no']) {
															
														echo $rowtwo['vin_no']."<br/>";
														
													}
												}
												
											?>
											<a href="accident_details.php?q=<?php echo $row['accident_ref_no']; ?>"><i class="fa fa-external-link" aria-hidden="true"></i> View Full Record</a>
										</td>
										</tr>
                                        <?php
												}
											}
										?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

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
