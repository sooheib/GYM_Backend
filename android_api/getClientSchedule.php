<?php
$host='us-cdbr-azure-southcentral-f.cloudapp.net';
$username='bf0159e2d750c0';
$pwd='22c2d784';
$db="acsm_93cc7376b391fec";
$con=mysqli_connect($host,$username,$pwd,$db) or die('Unable to connect');
if(mysqli_connect_error($con))
{
    echo "Failed to Connect to Database ".mysqli_connect_error();
}
$client_id = $_POST['clientID'];

  echo $client_id ;

$sql="SELECT r.client_id,r.schedule_id,s.day,s.startTime,c.course_code,c.course_desc,c.course_cover,u.last_name,u.photo,
ro.room_number
FROM reservation_t r,schedule_t s,course_t c,user_t u,room_t ro WHERE (r.schedule_id=s.schedule_id
AND c.course_crn=s.course_crn AND s.teacher_id =u.employee_id AND ro.room_id=s.room_id AND u.admin =0
)";
$result=mysqli_query($con,$sql);
if($result)
{
    while($row=mysqli_fetch_array($result))
    {
        $data[]=$row;
         echo $clientID;

    }

    print(json_encode($data));
}
else
{
 echo "Could not booked";
   echo "GOOD" ;

}
mysqli_close($con);
?>