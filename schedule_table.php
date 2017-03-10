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
    <script src="js/jquery-1.9.1.min.js"></script>
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
      <li><a href="schedule1.php">Schedule</a></li>
      <li><a href="event.php">Events</a></li>
      <li><a href="users.php">Clients</a></li>

      <li ><a href="teachers.php">Teachers</a></li>
    <li><a href="courses.php">Courses</a></li>
     <li><a href="sections.php">Sections</a></li>
    <li><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>
  </ul>

  <?php include "partials/_search_table.php";  ?>
  
  <a href="schedule.php?add"><button class="pull-right btn btn-primary">Schedule An Event</button></a>
  <div class="clear"></div>
  <?php 
    $result = select("schedule_t","");
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
        <th> Schedule ID  </th>
        <th> Semester ID</th>
        <th> Section ID </th>
        <th> Course  </th>
        <th> Day </th>
        <th> Start Time  </th>
        <th> End Time  </th>
        <th> Trainer ID</th>
      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"schedule_id");
        $semester=mysql_result($result,$i,"semester_id");
        $section=mysql_result($result,$i,"section_id");
        $crn=mysql_result($result,$i,"course_crn");
        $day=mysql_result($result,$i,"day");
        $start=mysql_result($result,$i,"startTime");
        $end=mysql_result($result,$i,"endTime");
        $teacher=mysql_result($result,$i,"teacher_id");
    ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $semester; ?>  </td>
    <td> <?php echo $section; ?>  </td>
    <td> <?php echo $crn; ?>  </td>
    <td> <?php echo $day; ?>  </td>
    <td> <?php echo $start; ?>  </td>
    <td> <?php echo $end; ?>  </td>
    <td> <?php echo $teacher; ?>  </td>
    <td> <a href="schedule.php?event=<?php echo $id?>">Edit/Delete</a></td>
    </tr>

    <?php
        $i++;
      }
    ?>

    </tbody>
  </table>

</div>
</body>
</html>