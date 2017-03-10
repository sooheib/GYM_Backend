<?php
//$host='us-cdbr-azure-southcentral-f.cloudapp.net';
//$username='bf0159e2d750c0';
//$pwd='22c2d784';
//$db="acsm_93cc7376b391fec";

$host='localhost';
$username='root';
$pwd='root';
$db="SPARTAGYM";
$con=mysqli_connect($host,$username,$pwd,$db) or die('Unable to connect');
if(mysqli_connect_error($con))
{
    echo "Failed to Connect to Database ".mysqli_connect_error();
}

//get the employee details
$id = $data['reservation_id'];
$schedule_id = $data['schedule_id'];
$user_id = $data['user_id'];
$reservation_num = $data['reservation_num'];

//insert into mysql table
$sql = "INSERT INTO reservation_t(reservation_id, schedule_id, user_id, reservation_num)
    VALUES('$id', '$schedule_id', '$user_id', '$reservation_num')";
$result=mysqli_query($con,$sql);
if($result)
{
    while($row=mysqli_fetch_array($result))
    {
        $data[]=$row;
    }

    print(json_encode($data));
}
mysqli_close($con);
?>