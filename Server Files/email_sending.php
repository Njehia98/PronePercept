<?php

if(isset($_POST['nine_one_one'])) {
	
	$db = mysqli_connect('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
	if($_POST['nine_one_one'] == 'checked') {
		$query = "UPDATE email SET nine_one_one = 'checked' WHERE id = 1";
		$result = mysqli_query($db,$query);
		
	}
	elseif($_POST['nine_one_one'] == 'unchecked') {
		$query = "UPDATE email SET nine_one_one = '' WHERE id = 1";
		$result = mysqli_query($db,$query);
		
	}
}


?>