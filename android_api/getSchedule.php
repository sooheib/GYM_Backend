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
$sql="SELECT s.schedule_id, s.day, s.startTime,c.course_code,c.course_desc,c.course_cover,c.course_maxCapacity,u.last_name,u.photo,
r.room_number ,s.countMumber ,c.course_maxCapacity,sem.startDate,u.employee_id
FROM schedule_t s, course_t c, user_t u,room_t r,section_t se,semester_t sem WHERE (c.course_crn =s.course_crn
AND s.teacher_id =u.employee_id AND r.room_id=s.room_id AND u.admin =0 AND s.semester_id=sem.semester_id)";
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