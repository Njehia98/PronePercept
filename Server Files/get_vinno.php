<?php
?>
<option selected = 'true' disabled='disabled'>Please select a V.I.N.:</option>
<option disabled='disabled'>----</option>
<?php
$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
$sql_statement  = "SELECT * FROM car_details WHERE region='".$_POST['region']."'"; 
$result = mysqli_query($db, $sql_statement);
while ($row = mysqli_fetch_assoc($result)) {
?>
<option value="<?php echo $row['vin_no'] ?>"><?php echo $row['vin_no'] ?></option>
<?php

}
?>