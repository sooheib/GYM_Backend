<form id="scheduleForm" action="query_service.php" method="post"  class="form-horizontal">
<div class="row">
  <div class="span6">
    <div class="control-group">
     <label class='control-label' for='semester'>Semester</label> 
      <div class='controls'> 
        <select name="semester" id="semester" >
          <?php 
            $result = select("semester_t","");
            $count=mysql_num_rows($result);
            $i=0;
            while ($i < $count) {
              $id=mysql_result($result,$i,"semester_id");
              $year=mysql_result($result,$i,"year");
              $quarter=mysql_result($result,$i,"quarter");
              echo "<option value='$id'>$quarter $year</option>";
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
     <label class='control-label' for='day'>Day</label> 
      <div class='controls'> 
       <select name="day" id="day">
        <option value="monday">Monday</option>
        <option value="tuesday">Tuesday</option>
        <option value="wednesday">Wednesday</option>
        <option value="thursday">Thursday</option>
        <option value="friday">Friday</option>
           <option value="saturday">Saturday</option>
           <option value="sunday">Sunday</option>

       </select>

      </div>
    </div>
     <div class="control-group">
     <label class='control-label' for='start'>Start Time</label> 
      <div class='controls'> 
        <select name="start" id="start">
          <?php 
            for($i=6;$i<=22;$i+=1)
              echo "<option value='$i:00'>$i:00</option>";
          ?>
        </select>
      </div>
    </div>
     <div class="control-group">
     <label class='control-label' for='end'>End Time</label> 
      <div class='controls'> 
        <select name="end" id="end">
          <?php 
            for($i=7;$i<=23;$i+=1)
              echo "<option value='$i:00'>$i:00</option>";
          ?>
        </select>
      </div>
    </div>
  </div>
  <div class="span6">
    <div class="control-group">
     <label class='control-label' for='crn'>Course</label>
      <div class='controls'> 
        <select name="crn" id="crn">
          <?php 
            $result = select("course_t","");
            $count=mysql_num_rows($result);
            $i=0;
            while ($i < $count) {
              $crn=mysql_result($result,$i,"course_crn");
              $desc=mysql_result($result,$i,"course_desc");
              echo "<option value='$crn'>$crn $desc</option>";
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
     <label class='control-label' for='room'>Room</label> 
      <div class='controls'> 
        <select name="room" id="room">
          <?php 
            $result = select("room_t","");
            $count=mysql_num_rows($result);
            $i=0;
            while ($i < $count) {
              $id=mysql_result($result,$i,"room_id");
              $room=mysql_result($result,$i,"room_number");
              $type=mysql_result($result,$i,"room_type");
              echo "<option value='$id'>$room ($type)</option>";
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
     <label class='control-label' for='teacher'>Trainer</label>
      <div class='controls'> 
        <select name="teacher" id="teacher">
          <?php 
            $result = select("user_t","admin <> 1");
            $count=mysql_num_rows($result);
            $i=0;
            while ($i < $count) {
              $id=mysql_result($result,$i,"employee_id");
              $first=mysql_result($result,$i,"first_name");
              $last=mysql_result($result,$i,"last_name");
              echo "<option value='$id'>$first $last</option>";
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
     <label class='control-label' for='section'>Section</label> 
      <div class='controls'> 
        <select name="section" id="section">
          <?php 
            $result = select("section_t","");
            $count=mysql_num_rows($result);
            $i=0;
            while ($i < $count) {
              $id=mysql_result($result,$i,"section_id");
              $name=mysql_result($result,$i,"section_name");
              echo "<option value='$id'>$name</option>";
              $i++;
            }
          ?>
        </select>
      </div>
    </div>
  </div>