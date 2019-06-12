<?php
	if(isset($_POST['iqrn'])) {
		$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
?>
<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">Accident</span> Record</h4>
						<p class="category">Here is the appropriate record for the selected I.Q.R.N.</p>
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
							<tbody>
								<?php
								$sql_statement  = 'SELECT * FROM claimdata WHERE iqrn = "'.$_POST['iqrn'].'" ORDER BY iqrn DESC'; 
								$result = mysqli_query($db, $sql_statement);
								$row = mysqli_fetch_assoc($result);
								$arn = $row['accident_ref_no'];
								
								$sql_statement  = 'SELECT * FROM automotive_impact WHERE accident_ref_no = "'.$arn.'" ORDER BY impact_id DESC'; 
								$result = mysqli_query($db, $sql_statement);
									while ($row = mysqli_fetch_assoc($result)) {
										
								?>
								<tr>
									<td><?php echo $row['impact_id']; ?></td>
									<td><a style="color:blue" href="car_details_forinsurer.php?q=<?php echo $row['vin_no']; ?>"><?php echo $row['vin_no']; ?></a></td>
									<td><span style="font-size:10px;"><?php echo $row['gps_coord']; ?></span><br/><a target="_blank" href="http://www.google.com/maps/place/<?php echo $row['gps_coord'];?>/@<?php echo $row['gps_coord'];?>,17z"><i class="fa fa-external-link" aria-hidden="true"></i> View in Google Maps</a></td>
									<td><?php echo $row['side']; ?></td>
									<td><?php echo $row['speed']; ?></td>
									<td><?php echo $row['date'] . " " . $row['month'] . ", " . $row['year'] . " (" . $row['hour'] . ":" . $row['minute'] . ":" . $row['second'] . ")"; ?></td>
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
</div>
<div class="content" style="padding-top:30px;">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">File</span> Record</h4>
						<p class="category">Here is the associated file for the selected I.Q.R.N.</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>Name</th>
								<th>Type</th>
								<th>Size (KB)</th>
								<th>Download</th>
							</thead>
							<tbody>
								<?php
								$sql_statement  = 'SELECT * FROM file WHERE report_id = "'.$_POST['iqrn'].'"'; 
								$result = mysqli_query($db, $sql_statement);
								$row = mysqli_fetch_assoc($result)
								?>
								<tr>
									<td><?php echo $row['name'] ?></td>
									<td><?php echo $row['mime'] ?></td>
									<td><?php echo $row['size'] ?></td>
									<td><a style="color:red"href="get_file.php?report_id=<?php echo $row['report_id']; ?>"><i class="fa fa-download" aria-hidden="true"></i> Download Provided Media</a></td>
			
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>