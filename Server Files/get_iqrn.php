<?php
?>
<option selected = 'true' value="" disabled='disabled'>Please select an I.Q.R.N.:</option>
<option disabled='disabled' value="">----</option>
<?php
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
$sql_statement  = "SELECT * FROM claimdata INNER JOIN automotive_impact ON claimdata.vin_no = automotive_impact.vin_no AND claimdata.accident_ref_no = automotive_impact.accident_ref_no JOIN car_details ON automotive_impact.vin_no = car_details.vin_no WHERE car_details.region = '".$_POST['region']."' && claimdata.authorize = 'NO'"; 
$result = mysqli_query($db, $sql_statement);
while ($row = mysqli_fetch_assoc($result)) {
?>
<option value="<?php echo $row['iqrn'] ?>"><?php echo $row['iqrn'] ?></option>
<?php

}
?>