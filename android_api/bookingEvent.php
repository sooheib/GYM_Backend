<?php   
        require_once '../../dbConfi.php';
		$client_id=$_POST['userID'];
		//$client_id=2;
		$idEventId=$_POST['eventID'];
	//	$idScheduleId=6;
		$js=array();
try {


						$stmt = $db_con->prepare("INSERT INTO reservationEvent_t(client_id, event_id) VALUES (?,?)");
							if($stmt->execute(array($client_id,$idEventId)))
							{      $stmt=null;
							
								        $stmt = $db_con->prepare("UPDATE event_t set event_countReserved = event_countReserved + 1
                                         WHERE event_id =:id");
								        			

                                         if($stmt->execute(array(":id"=>$idEventId)))
                                            {
                                                	$arrayName = array('code' => "succes");
                                            }
								
							}
							
						


}
		
	catch(PDOException $e){
			//echo $e->getMessage();
$arrayName = array('code' => "failed");
		}
									array_push($js, $arrayName);

									echo json_encode($js);				




