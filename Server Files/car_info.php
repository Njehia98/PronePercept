
<?php
	if(isset($_POST['vinno'])) {
		$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
		$sql_statement  = 'SELECT * FROM car_details WHERE vinno = '.$_POST['vinno'].''; 
		$result = mysqli_query($db, $sql_statement);						
?>
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
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_POST['vinno'].'"';
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
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_POST['vinno'].'"';
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
								
								$sql_statement  = 'SELECT * FROM car_details WHERE vin_no = "'.$_POST['vinno'].'"';
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
	
	$sql_statement  = 'SELECT * FROM automotive_impact WHERE vin_no = "'.$_POST['vinno'].'"  ORDER BY impact_id DESC';
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
								$sql_statement  = 'SELECT * FROM automotive_impact WHERE vin_no = "'.$_POST['vinno'].'" ORDER BY impact_id DESC';
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
