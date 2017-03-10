<?php ob_start(); ?>
<?php
include('partials/_dbinfo.inc.php');
include('partials/_adminlock.php');
?>
<!DOCTYPE html>
<html>
<head>
	    <title>GBC Mini-Scheduling System - Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="stylesheet" media="screen">
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootbox.min.js"></script>
     </head>
<body>
<div class="container">
  <?php
  include "partials/_header.php";
  ?>

  <ul class="nav nav-tabs">
    <li id="admin" >
      <a href="admin.php">Current Schedule</a>
    </li>
      <li><a href="users.php">U</a></li>

      <li id="teachers"><a href="teachers.php">Teachers</a></li>

    <li id="courses"><a href="courses.php">Courses</a></li>
     <li id="sections"><a href="sections.php">Sections</a></li>
    <li id="rooms"><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>
  </ul>

  <div class="well">
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
      <?php

      if(isset($_GET['client'])){
          echo "<h3>Add a Client</h3>";
          include('partials/_users_form.php');
          echo "<div class='controls'><a href='users.php' class='btn'>Cancel</a><input type='submit' name='addClient' class='btn btn-primary' value='Save'/>";
      }

      	if(isset($_GET['teacher'])){
          echo "<h3>Add a Teacher</h3>";
      		include('partials/_teacher_form.php');
          echo "<div class='controls'><a href='teachers.php' class='btn'>Cancel</a><input type='submit' name='addUser' class='btn btn-primary' value='Save'/>";
        }
      if(isset($_GET['event'])){
          echo "<h3>Add an Event</h3>";
          include('partials/_event_form.php');
          echo "<div class='controls'><a href='event.php' class='btn'>Cancel</a>
<input type='submit' name='addEvent1' class='btn btn-primary' value='Save'/>";
      }
        if(isset($_GET['section'])){
          echo "<h3>Add a Section</h3>";
          include('partials/_section_form.php');
          echo "<div class='controls'><a href='sections.php' class='btn'>Cancel</a><input type='submit' name='addSection' class='btn btn-primary' value='Save'/>";
        }
        if(isset($_GET['course'])){
          echo "<h3>Add a Course</h3>";
          include('partials/_course_form.php');
          echo "<div class='controls'><a href='courses.php' class='btn'>Cancel</a>
<input type='submit' name='addCourse' class='btn btn-primary' value='Save'/>";
        }

      if(isset($_GET['schedule1'])){
          echo "<h3>Add a Schedule</h3>";
          include('partials/_schedule1_form.php');
          echo "<div class='controls'><a href='schedule1.php' class='btn'>Cancel</a>
<input type='submit' name='addSchedule1' class='btn btn-primary' value='Save'/>";
      }

        if(isset($_GET['room'])){
          echo "<h3>Add a Room</h3>";
          include('part
          ials/_room_form.php');
          echo "<div class='controls'><a href='rooms.php' class='btn'>Cancel</a><input type='submit' name='addRoom' class='btn btn-primary' value='Save'/>";
        }
        if(isset($_GET['semester'])){
          echo "<h3>Add a Semester</h3>";
          include('partials/_semester_form.php');
          echo "<div class='controls'><a href='semesters.php' class='btn'>Cancel</a><input type='submit' name='addSemester' class='btn btn-primary' value='Save'/>";
        }
      ?>
      </div>
    </form>

  </div>



</div>
<script>
 var url = $(location).attr('href').split('?');
    if($.inArray('teacher', url) > -1)
      $("#teachers").addClass("active");
    else if($.inArray('section', url) > -1)
      $("#sections").addClass("active");
    else if($.inArray('course', url) > -1)
      $("#courses").addClass("active");
    else if($.inArray('room', url) > -1)
      $("#rooms").addClass("active");
    else if($.inArray('semester', url) > -1)
      $("#semesters").addClass("active");
  $(document).ready(function(){  
      if($('#semesterForm')){
        $('#start, #end').datepicker( { changeYear: true, changeMonth: true } );
        $("#semesterForm").submit(function(){
             var errors=""; 
            if($('#start').val() > $('#end').val())
              errors += "Please select an ending date later than the starting date<br>";
            if(errors != ""){
              $('#response').html(errors);
              return false;
            }
            var y = $('#start').val().split("/");
            y = y[2];
            $('#semesterForm').append(
              $('<input/>')
                  .attr('type', 'hidden')
                  .attr('id', 'year')
                  .attr('name', 'year')
                  .val(y)
            );
            return  true;
        });
      }
      if($('#courseForm')){
        $("#courseForm").submit(function(){
         var errors=""; 
          if($('#crn').val().length != 5 || isNaN($('#crn').val()))
            errors += "Course code must be a 5 digit entry<br>";
          if(errors != ""){
            $('#response').html(errors);
            return false;
          }
          return true;
        });
      }
  })
</script>
</body>
</html>