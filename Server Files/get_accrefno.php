<?php
?>
<option selected = 'true' disabled='disabled'>Please select a A.R.N.:</option>
<option disabled='disabled'>----</option>
<?php
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
$sql_statement  = "SELECT DISTINCT accident_ref_no FROM car_details INNER JOIN automotive_impact ON car_details.vin_no=automotive_impact.vin_no WHERE region='".$_POST['region']."'"; 
$result = mysqli_query($db, $sql_statement);
while ($row = mysqli_fetch_assoc($result)) {
?>
<option value="<?php echo $row['accident_ref_no'] ?>"><?php echo $row['accident_ref_no'] ?></option>
<?php

}
?>