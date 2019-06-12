<?php
   session_start();
   $iqrn = $_SESSION['iqrn'];
   $db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
	$query = "SELECT * FROM claimdata WHERE iqrn = '$iqrn'"; 
	$results = mysqli_query($db, $query); 
	$row = mysqli_fetch_assoc($results);
	$querytwo = "SELECT * FROM automotive_impact WHERE accident_ref_no = '".$row['accident_ref_no']."'"; 
	$resultstwo = mysqli_query($db, $querytwo); 
	$rowtwo = mysqli_fetch_assoc($resultstwo);
	$impact_id=$rowtwo['impact_id'];
?>
 <script src="../../js/sweetalert/dist/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="../../js/sweetalert/dist/sweetalert.css">
<script>
var iqrn = <?php echo $iqrn ?>;
var impact_id = <?php echo $impact_id ?>;
window.onload = function () {
	swal({
		title: "For Reference",
		text: "I.Q.R.N. Generated: <b>"+iqrn+"</b>, based upon the Impact ID of <b>"+impact_id+"</b>",
		type: "info",
		confirmButtonColor: '#3399ff',
		confirmButtonText: 'Alright!',
		html: true
	},
	function(isConfirm){
		if (isConfirm){
			location.href = "file_iqrn.php";
		}
	});
}   

</script>