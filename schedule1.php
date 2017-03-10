<?php ob_start(); ?>
<?php
include('partials/_dbinfo.inc.php');
include('partials/_adminlock.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>SPARTAX GYM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet" media="screen">
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
    <style>
        .clear{
            height: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    include "partials/_header.php";
    ?>

    <ul class="nav nav-tabs">
        <li >
            <a href="admin.php">Current Schedule</a>
        </li>
        <li class="active"><a href="schedule1.php" >Schedule</a></li>
        <li><a href="event.php">Events</a></li>
        <li><a href="users.php">Clients</a></li>
        <li ><a href="teachers.php">Teachers</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="sections.php">Sections</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li><a href="semesters.php">Semesters</a></li>
    </ul>

    <?php include "partials/_search_table.php";  ?>

    <a href="add.php?schedule1"><button class="pull-right btn btn-primary">Schedule An Event</button></a>
    <div class="clear"></div>
    <?php
    $result = select("schedule_tt","");
    $count=mysql_num_rows($result);
    ?>
    <?php
    if(isset($_SESSION['errors'])){
        $errors = array($_SESSION['errors']);
        unset($_SESSION['errors']);
        foreach($errors as $e){
            foreach($e as $r)
                echo "<span style='color:red;'> $r <br></span>";
        }
    }
    ?>
    <div id="response" style="color: red;"></div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th> Schedule ID </th>
            <th> StartDate </th>
            <th> EndDate </th>
            <th> StarTime </th>
            <th> EndTime  </th>
            <th> Trainer ID</th>
            <th> Course ID </th>
            <th> Room ID </th>
            <th> Semester ID</th>
        </tr>
        </thead>

        <tbody class="searchable">
        <?php
        $i=0;
        while ($i < $count) {
            $id=mysql_result($result,$i,"schedule_id");
            $startdate=mysql_result($result,$i,"startDate");
            $enddate=mysql_result($result,$i,"endDate");
            $starttime=mysql_result($result,$i,"startTime");
            $endtime=mysql_result($result,$i,"endTime");
            $trainer=mysql_result($result,$i,"trainer_id");
            $course=mysql_result($result,$i,"course_id");
            $room=mysql_result($result,$i,"room_id");
            $semester=mysql_result($result,$i,"semester_id");
            ?>
            <tr>
                <td> <?php echo $id; ?>  </td>
                <td> <?php echo $startdate; ?>  </td>
                <td> <?php echo $enddate; ?>  </td>
                <td> <?php echo $starttime; ?>  </td>
                <td> <?php echo $endtime; ?>  </td>
                <td> <?php echo $trainer; ?>  </td>
                <td> <?php echo $course; ?>  </td>
                <td> <?php echo $room; ?>  </td>
                <td> <?php echo $semester; ?>  </td>
                <td> <a href="schedule.php?event=<?php echo $id?>">Edit/Delete</a></td>
            </tr>

            <?php
            $i++;
        }
        ?>

        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            $('#start, #end').datepicker( { changeYear: true, changeMonth: true } );
        })
    </script>

</div>
</body>
</html>