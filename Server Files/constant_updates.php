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
		if ($current_date == $row['date'] && $current_month == $row['month'] && $current_year == $row['year']) {

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