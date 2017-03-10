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
        <li  class="active" ><a href="users.php">Clients</a></li>
        <li ><a href="teachers.php">Trainers</a></li>
        <li ><a href="courses.php">Courses</a></li>
        <li><a href="sections.php">Sections</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li><a href="semesters.php">Semesters</a></li>
    </ul>

    <?php include "partials/_search_table.php";  ?>

    <a href="add.php?client"><button class="pull-right btn btn-primary">Add A Client</button></a>
    <div class="clear"></div>
    <?php
    $result = select("users","");
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
            <th> User Id </th>
            <th> User Name</th>
            <th> User Email </th>
            <th>User password</th>
            <th>photo</th>
        </tr>
        </thead>

        <tbody class="searchable">
        <?php
        $i=0;
        while ($i < $count) {
            $id=mysql_result($result,$i,"id");
            $name=mysql_result($result,$i,"name");
            $email=mysql_result($result,$i,"email");
            $epassword=mysql_result($result,$i,"password");
            $photo=mysql_result($result,$i,"photo");


            ?>
            <tr>
                <td> <?php echo $id; ?>  </td>
                <td> <?php echo $name; ?>  </td>
                <td> <?php echo $email; ?>  </td>
                <td> <?php echo $epassword; ?>  </td>
                <td><img width="20%" height="20%" src="partials/client_images/<?php echo $photo; ?>"/></td>


                <td> <a href="admin.php?crn=<?php echo $id ?>">Schedule</a></td>
                <td> <a href="#" class="details-click" data-detail-id="<?php echo $id ?>">Edit</a></td>
                <td> <a href="#" class="delete-click" data-detail-id="<?php echo $id ?>">Delete</a> </td>
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
            <?php include('partials/_users_form.php') ?>
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
            var dataObj = { clientID : clickedID };
            $.ajax({
                type: 'POST',
                url: 'query_service.php',
                data: dataObj,
                dataType: 'JSON',
                success: function(response)
                {
                    $('#details').show().modal({ backdrop: true });
                    $('#detailsID').html("ID: " + response[0]['id']);
                    $('#idC').val(response[0]['id']);
                    $('#nameC').val(response[0]['name']);
                    $('#emailC').val(response[0]['email']);
                    $('#epassword').val(response[0]['epassword']);
                    $('#photou').val(response[0]['photo']);

                    $('#details').append(
                        $('<input/>')
                            .attr('type', 'hidden')
                            .attr('id', 'editClient')
                            .attr('name', 'editClient')
                            .val(clickedID)
                    );
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error retrieving data: " + errorThrown); }
            });
            $("#modalSave").on("click", function(e){
                e.preventDefault();
                var clickedID = $("#editClient").val();
                var dataObj = { editClient : clickedID,id : $("#idC").val() name : $("#nameC").val(), email : $("#emailC").val(),epassowrd : $("#epassword").val(),
                    photo : $("#photou").val() };
                $.ajax({
                    type: 'POST',
                    url: 'query_service.php',
                    data: dataObj,
                    dataType: 'JSON',
                    success: function(response){
                        window.location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){$("#response")
                        .html("error: " + errorThrown);}
                });
            });
        });
        $(document).ready(function(){
            $("#userForm").submit(function(){
                var errors="";
                if($('#id').val().length != 8 || isNaN($('#id').val()))
                    errors += "Course code must be a 8 digit entry<br>";
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