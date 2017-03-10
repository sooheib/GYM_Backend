<?php
    include('_dbinfo.inc.php');
    $sql = <<<SQL
        SELECT *, 
        (SELECT course_desc 
            FROM course_t 
            WHERE schedule_t.course_crn = course_t.course_crn) AS 'name', 
        (SELECT last_name 
            FROM user_t
            WHERE schedule_t.teacher_id = user_t.employee_id) AS 'teacher' 
        FROM schedule_t 
        INNER JOIN semester_t  
        ON schedule_t.semester_id = semester_t.semester_id
SQL;
    if(isset($_POST['teacher'])){
        $teacher = $_POST['teacher'];
        $sql .= " WHERE schedule_t.teacher_id = $teacher";
    }else if(isset($_POST['room'])){
        $room = $_POST['room'];
        $sql .= " WHERE schedule_t.room_id = $room";
    }else if(isset($_POST['crn'])){
        $crn = $_POST['crn'];
        $sql .= " WHERE schedule_t.course_crn = $crn";
    }
    else if(isset($_POST['section'])){
        $section = $_POST['section'];
        $sql .= " WHERE schedule_t.section_id = $section";
    }
    $result=mysql_query($sql);
    $json=array();
    while($row = mysql_fetch_assoc($result))  
    {
        $day = $row['day'];
        $next = strtotime("this $day", strtotime($row['startDate']));
        $firstDate = Date("Y-m-d", $next);
        for($i=0;$i<15;$i++){
            $start = strtotime("$firstDate ". $row['startTime'] . "America/Toronto + $i week");
            $end = strtotime("$firstDate ".  $row['endTime'] . "America/Toronto + $i week");
            $event = array(
                'id' => $row['schedule_id'],
                'title' => $row['course_crn'] . " " . $row['name'] . "\n" . $row['teacher'],
                'start' =>  Date($start),
                'end' =>  Date($end),
                'allDay' => false,
                'url' => "schedule.php?event=".$row['schedule_id']
            );
            array_push($json, $event);
        }
    }
    echo json_encode($json);
?>