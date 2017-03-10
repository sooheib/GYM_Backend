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
        <li ><a href="teachers.php">Trainers</a></li>
        <li  class="active"><a href="courses.php">Courses</a></li>
        <li><a href="sections.php">Sections</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li><a href="semesters.php">Semesters</a></li>
    </ul>

    <?php include "partials/_search_table.php";  ?>

    <a href="add.php?course"><button class="pull-right btn btn-primary">Add A Course</button></a>
    <div class="clear"></div>
    <?php
    $result = select("course_t","");
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
            <th> Course Id </th>
            <th> Course Description</th>
            <th> Course Name </th>
            <th>Course cover</th>
            <th>Course Max Capacity</th>


        </tr>
        </thead>

        <tbody class="searchable">
        <?php
        $i=0;
        while ($i < $count) {
            $crn=mysql_result($result,$i,"course_crn");
            $desc=mysql_result($result,$i,"course_desc");
            $code=mysql_result($result,$i,"course_code");
            $cover=mysql_result($result,$i,"course_cover");
            $capacity=mysql_result($result,$i,"course_maxCapacity");


            ?>
            <tr>
                <td> <?php echo $crn; ?>  </td>
                <td> <?php echo $desc; ?>  </td>
                <td> <?php echo $code; ?>  </td>
                <td><img width="20%" height="20%" src="partials/user_images/<?php echo $cover; ?>"/></td>
                <td> <?php echo $capacity; ?>  </td>

                <td> <a href="admin.php?crn=<?php echo $crn ?>">Schedule</a></td>
                <td> <a href="#" class="details-click" data-detail-id="<?php echo $crn ?>">Edit</a></td>
                <td> <a href="#" class="delete-click" data-detail-id="<?php echo $crn ?>">Delete</a> </td>
            </tr>

            <?php
            $i++;
        }
        ?>

        </tbody>
    </table>

    <?php include('partials/_deleteModal.php') ?>


    <div id="details" class="modal hide">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="detailsID"></h3>
        </div>
        <div class="modal-body">
            <?php include('partials/_course_form.php') ?>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn cl">Close</a>
            <a href="#" class="btn btn-primary" id="modalSave">Save changes</a>
        </div>
    </div>



    <script>
        $(".details-click").on("click", function(e) {
            var clickedID = $(this).data("detail-id");
            var dataObj = { courseID : clickedID };
            $.ajax({
                type: 'POST',
                url: 'query_service.php',
                data: dataObj,
                dataType: 'JSON',
                success: function(response)
                {
                    $('#details').show().modal({ backdrop: true });
                    $('#detailsID').html("CRN: " + response[0]['crn']);
                    $('#crn').val(response[0]['crn']);
                    $('#desc').val(response[0]['desc']);
                    $('#code').val(response[0]['code']);
                    $('#cover').val(response[0]['cover']);
                    $('#capacity').val(response[0]['capacity']);



                    $('#details').append(
                        $('<input/>')
                            .attr('type', 'hidden')
                            .attr('id', 'editCourse')
                            .attr('name', 'editCourse')
                            .val(clickedID)
                    );
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error retrieving data: " + errorThrown); }
            });
            $("#modalSave").on("click", function(e){
                e.preventDefault();
                var clickedID = $("#editCourse").val();
                var dataObj = { editCourse : clickedID, crn : $("#crn").val(),
                    desc : $("#desc").val(), code : $("#code").val(),cover : $("#cover").val(),
                    capacity : $("#capacity").val()};
                $.ajax({
                    type: 'POST',
                    url: 'query_service.php',
                    data: dataObj,
                    dataType: 'JSON',
                    success: function(response){
                        window.location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error: " + errorThrown);}
                });
            });
        });
        $(document).ready(function(){
            $("#courseForm").submit(function(){
                var errors="";
//      if($('#crn').val().length != 2 || isNaN($('#crn').val()))
//        errors += "Course code must be a 5 digit entry<br>";
                if(errors != ""){
                    $('#response').html(errors);
                    return false;
                }
                return true;
            });
        });
    </script>

</div>
</body>
</html>