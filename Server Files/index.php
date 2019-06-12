<?php
	 session_start();
	 $_SESSION['hello'] = "hello";
	 unset($_SESSION['hello']);
	   	  if(isset($_SESSION['login_status_admin']) == ""  ) {
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

	<title>Dashboard</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<script src="js/sweetalert/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="js/sweetalert/dist/sweetalert.css">
	<script>
function handleClick() {
  if (document.getElementById('someSwitchOptionPrimary').checked) 
  {
     var cb = 'checked';
  }
  else {
	 var cb = 'unchecked';
  }
	
		$.ajax({
			type: "POST",
			url: "email_sending.php",
			data: 'nine_one_one=' + cb,
			success: function(data){
				if (cb == "checked") {
					swal({
						title: "Action Successful!",
						text: "The <b>911</b> police departments, from now on <span style='font-style:italic'>will</span> be notified of any accidents!",
						type: "info",
						confirmButtonText: 'Alright!',
						closeOnConfirm: true,
						html: true
					},
					function(isConfirm){
					if (isConfirm){
						location.href = 'index.php';
					}
					});
				}
				if (cb == "unchecked") {
					swal({
						title: "Action Successful!",
						text: "The <b>911</b> police departments, from now on <span style='font-style:italic'>won't</span> be notified of any accidents!",
						type: "info",
						confirmButtonText: 'Alright!',
						closeOnConfirm: true,
						html: true
					},
					function(isConfirm){
					if (isConfirm){
						location.href = 'index.php';
					}
					});
				}
			}
			});
}

	</script>

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

	<style>
.material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
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
                <li class="active">
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
				<li>
                    <a href="email_insurer.php">
                        <i class="pe-7s-mail-open-file"></i>
                        <p>Email Insurer</p>
                    </a>
                </li>
				<br/><br/>
				<!-- List group -->
                    <li>
                        <a>
						<i class="pe-7s-users"></i>
                        <p><span style='font-size:12px;'>EMAIL 911?</span>
                        <span class="material-switch pull-right">
                            <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox" <?php 
							$query = "SELECT * FROM `email`";
							$result = mysqli_query($db,$query);
							$row = mysqli_fetch_assoc($result);
							echo $row['nine_one_one']; ?> onclick='handleClick();'/>
                            <label for="someSwitchOptionPrimary" class="label-primary"></label>
                        </span></p>
						</a>
                    </li>
				 
            </ul>
    	</div>
    </div>

         

        

<div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" >
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    
                    <ul class="nav navbar-nav navbar-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
		<div style="padding-top:10px;">
		<a style="text-decoration:none;color:blue;text-align:center;padding-left:15px;" href="login_panel.php?msg=logout"><span style="font-size:11px;text-align:center">(LOG OUT)</span></a>

        <div style="text-align:center;font-size:45px;margin-top:20px;padding-left:15px;padding-right:15px;margin-bottom:20px;"><div style="line-height:40px;font-weight:bold">Automotive Collision Detection Network</div>
		<div style="text-align:center;font-size:25px;margin-top:20px;padding-left:15px;padding-right:15px;margin-bottom:20px;"><div style="line-height:30px;font-weight:bold">Welcome 911 Administrator</div>
		<div style="text-align:center;font-size:13px;margin-top:20px;">
		The high demand of automobiles today, has increased traffic hazards and statistically road accidents. Life of drivers/passengers is under high risk.<br/>
This project is a centralized system which can detect automotive vehicle accidents significantly in real time, allowing 911 to rush the needed support, to the appropriate location without someone physically calling for support, potentially saving lives.<br/>
It essentially communicates the information to a 911 administrator by appending it to their server’s database & through emailing; covering geographical coordinates, the time, impact angle, Vehicle Identification No. (V.I.N.), for involved vehicles, etc.; clustering them based on an Accident Reference No. (A.R.N.).<br/>
When an accident claim is received by the insurer from their client, a request of authorization (of viewing the accident details) can be initiated (if the insurer is tied up with 911, and has an account with the system) to the 911 administrator, after filing an Information Query Request No. (I.Q.R.N.).<br/>
Upon receiving this request from a specific registered insurer, the 911 administrator has the right to provide them with the appropriate accident details, and may also attach an additional file (PDF/Word/Text/Image), with incident survey details, if any. Then the insurer can view all this information from their dashboard.<br/>
The accident can be detected precisely with the help of the microcontroller and piezoelectric sensors that will have to be implemented in each vehicle. Then the Ethernet shield/module at the administrator’s end, turns that incoming data over to a web PHP script after it has been communicated via radio modules. A dynamic web application has been built for all the server-side functionalities.<br/>
This system provides the optimum solution for detecting such collisions in the most feasible way. Being a very reliable and cost efficient network, it has the potential to save thousands of lives, of people who die each year because of being left stranded after an accident too long, along with significantly decreasing the amount fake insurance claims, and hit-and-run cases.

<br/><br/><span style="font-style:italic;font-size:11px;">You can view the entire process/mechanism
		in the video below. (If you have any questions/concerns, you can contact me via my <a href = "http://www.omagarwal.net">website</a>)
		</span></div>

		<h3 style="text-align:center">Project Walk-through <b>(TEDxMSVU)</b></h3>
		<style>
		.video-container iframe {
			max-width: 800px;
			width:100%;
			height:370px;
			margin:0 auto;
		}
		</style>
		<div class="video-container" ><iframe style="position:absolute;left:0;right:0;margin-left:auto;margin-right:auto;" src="https://www.youtube.com/embed/qr8q_sNHzLw"  frameborder="0" allowfullscreen></iframe></div>
		<div style="padding-bottom:410px"></div>
		<!--<h5>This component has been intentionally removed.</h5>-->
		 
		 </div>
		
		</div>
		
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

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-display2',
            	message: "Welcome to this <b>Automotive Collision Detection Network</b> - A peice of software to detect motor vehicle accidents!"

            },{
                type: 'danger',
                timer: 4000
            });

    	});
	</script>

</html>
