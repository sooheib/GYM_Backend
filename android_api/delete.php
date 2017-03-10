<?php
	    require_once('dbConnect.php');

	
	
	
	$id= $_POST['clientID'];
	
	echo "wwwwwwww"+$id;
	
	class emp{}
	
	if (empty($id)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Error  Data"; 
		die(json_encode($response));
	} else {
		$query = mysql_query("DELETE FROM reservation_t WHERE client_id=$id");
		
		if ($query) {
			$response = new emp();
			$response->success = 1;
			$response->message = "deleting";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error";
			die(json_encode($response)); 
		}	
	}
?>