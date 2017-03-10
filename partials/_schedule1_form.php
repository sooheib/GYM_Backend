<form id="schedule1Form" action="query_service.php" method="post"  class="form-horizontal">
    <div class="span12">
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
                        if (isset($post)) {
                            if($post[0]['semester'] == $id) {
                                $sel = 'selected="selected"';
                            }
                            else {
                                $sel = '';
                            }
                        }
                        echo "<option $sel value='$id'>$quarter $year</option>";
                        $i++;
                    }
                    ?>
                </select>
            </div>
        </div>
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
                        $course=mysql_result($result,$i,"course_code");

                        if (isset($post)) {
                            if($post[0]['crn'] == $crn) {
                                $sel = 'selected="selected"';
                            }
                            else {
                                $sel = '';
                            }
                        }
                        echo "<option $sel value='$crn'>$course</option>";
                        $i++;
                    }
                    ?>
                </select>
            </div>
        </div>

    </div>

    <div class="span12">

    <div class="control-group">
        <label class='control-label' for='sstart'>Semester Start Date</label>
        <div class='controls'>
            <input id="start" name="start" size="10" class="hasDatepick">
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='code'>Semester End Date</label>
        <div class='controls'>
            <input id="end" name="end" size="10" class="hasDatepick">
        </div>
    </div>


    <div class="control-group">
        <label class='control-label' for='start'>Start Time</label>
        <div class='controls'>
            <select name="startt" id="startt">
                <?php
                for($i=6;$i<=23;$i+=1) {
                    if (isset($post)) {
                        if($post[0]['start'] == $i.':00') {
                            $sel = 'selected="selected"';
                        }
                        else {
                            $sel = '';
                        }
                    }
                    echo "<option $sel value='$i:00'>$i:00</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='end'>End Time</label>
        <div class='controls'>
            <select name="endd" id="endd">
                <?php
                for($i=7;$i<=24;$i+=1) {
                    if (isset($post)) {
                        if($post[0]['end'] == $i.':00') {
                            $sel = 'selected="selected"';
                        }
                        else {
                            $sel = '';
                        }
                    }
                    echo "<option $sel value='$i:00'>$i:00</option>";
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
                    $result = select("room_t","room_type='FIT'");
                    $count=mysql_num_rows($result);
                    $i=0;
                    while ($i < $count) {
                        $id=mysql_result($result,$i,"room_id");
                        $room=mysql_result($result,$i,"room_number");
                        $type=mysql_result($result,$i,"room_type");
                        if (isset($post)) {
                            if($post[0]['room'] == $id) {
                                $sel = 'selected="selected"';
                            }
                            else {
                                $sel = '';
                            }
                        }
                        echo "<option $sel value='$id'>$room ($type)</option>";
                        $i++;
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class='control-label' for='teacher'>Teacher</label>
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
                        if (isset($post)) {
                            if($post[0]['teacher'] == $id) {
                                $sel = 'selected="selected"';
                            }
                            else {
                                $sel = '';
                            }
                        }
                        echo "<option $sel value='$id'>$first $last</option>";
                        $i++;
                    }
                    ?>
                </select>
            </div>
        </div>

        </div>

