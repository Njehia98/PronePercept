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
						<h4 class="title" style="font-weight:100;"><span style="font-weight:bold;">A.R.N. & V.I.N.</span></h4>
						<p class="category">Here is the viewable inputted information for the selected I.Q.R.N</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover">
							<thead>
								<th>A.R.N.</th>
								<th>V.I.N.</th>
							</thead>
							<tbody>
								<?php
								
								$sql_statement  = 'SELECT * FROM claimdata WHERE iqrn = "'.$_POST['iqrn'].'" ORDER BY iqrn DESC'; 
								$result = mysqli_query($db, $sql_statement);
									while ($row = mysqli_fetch_assoc($result)) {
										
								?>
								<tr>
									<td><?php echo $row['accident_ref_no']; ?></td>
									<td><?php echo $row['vin_no']; ?></a></td>
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
<?php } ?>