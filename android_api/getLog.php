<?php   
        require_once '../../dbConfi.php';
//$client_id=$_POST['userID'];
				$client_id=2;
				$all=array();

try {
								$stmt = $db_con->prepare("SELECT title, EXTRACT(YEAR FROM startdate) AS OrderYear,
															EXTRACT(MONTH FROM startdate) AS OrderMonth,
															EXTRACT(DAY FROM startdate) AS OrderDay,
															DATE_FORMAT(NOW(),' %h:%i %p') as HourDay,
															title FROM `reservation_t`, schedule_t WHERE reservation_t.schedule_id=schedule_t.schedule_id and client_id =? ORDER BY startdate DESC");
								$stmt->execute(array($client_id));		
							 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                while ($row = $stmt->fetch()) {

										
										$d=$row['OrderYear']."-".$row['OrderMonth']."-".$row['OrderDay'];
										$data =array("date"=>$d ,"time"=>$row['HourDay'],"title"=>$row['title']);
										array_push($all, $data);

		  							  }
}
    	catch(PDOException $e){
			echo $e->getMessage();
		}
		    echo(json_encode($all));