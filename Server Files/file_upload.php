<?php 
//Make sure the file was sent without errors
		
       $dbLink = new mysqli('localhost','omagarwa','Gangoh1976!', 'omagarwa_autocollisdetectnet');
       session_start();
       $last_id = $_SESSION['report'];
        // Gather all required data
        $name = $dbLink->real_escape_string($_FILES['file']['name']);
        $mime = $dbLink->real_escape_string($_FILES['file']['type']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['file']['tmp_name']));
        $size = intval($_FILES['file']['size']);
 if ($data != "") {
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `report_id`, `name`, `mime`, `size`, `data`, `created`
            )
            VALUES (
               '{$last_id}', '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $dbLink->query($query);
 }
		?>