<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $client_id = (int) $_POST['client_id'];

    require_once('dbConnect.php');

    $sql = "DELETE FROM reservation_t WHERE $client_id =client_id";

    if(mysqli_query($con,$sql)){
        echo "Successfully deleted";
    }else{
        echo "Could not deleted";
        echo $client_id ;
        echo $schedule_id ;

    }
}else{
    echo 'error';
}
