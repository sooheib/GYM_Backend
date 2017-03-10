<?php   
        require_once '../../dbConfi.php';
		$client_id=$_POST['userID'];
		//$client_id=2;
		$idScheduleId=$_POST['scheduleID'];
	//	$idScheduleId=6;
		$js=array();
try {


						$stmt = $db_con->prepare("DELETE from reservation_t WHERE client_id=$client_id"); 
						
							if($stmt->execute(array($client_id,$idScheduleId)))
							{      $stmt=null;
							
								        $stmt = $db_con->prepare("UPDATE schedule_t set countMumber = countMumber - 1
                                         WHERE schedule_id =:id");
								        			

                                         if($stmt->execute(array(":id"=>$idScheduleId)))
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




