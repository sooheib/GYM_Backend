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
    <li><a href="courses.php">Courses</a></li>
     <li><a href="sections.php">Sections</a></li>
    <li class="active"><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>
  </ul>

  <?php include "partials/_search_table.php";  ?>
  
  <a href="add.php?room"><button class="pull-right btn btn-primary">Add A Room</button></a>
  <div class="clear"></div>
  <?php 
    $result = select("room_t","");
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
        <th> Room ID  </th>
        <th> Room Size  </th>
        <th> Room Type  </th>
        <th> Room Number  </th>
      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"room_id");
        $size=mysql_result($result,$i,"room_size");
        $type=mysql_result($result,$i,"room_type");
        $number=mysql_result($result,$i,"room_number");
    ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $size; ?>  </td>
    <td> <?php echo $type; ?>  </td>
    <td> <?php echo $number; ?>  </td>
    <td> <a href="admin.php?room=<?php echo $id ?>">Schedule</a></td>
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
        <?php include('partials/_room_form.php') ?>
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
      var dataObj = { roomID : clickedID };
      $.ajax({
        type: 'POST',
        url: 'query_service.php',
        data: dataObj,
        dataType: 'JSON',
        success: function(response)
        {
          $('#details').show().modal({ backdrop: true });
          $('#detailsID').html("ID: " + response[0]['id']);
          $('#size').val(response[0]['size']);
          $('#type').val(response[0]['type']);
          $('#number').val(response[0]['number']);
          $('#details').append(
            $('<input/>')
                .attr('type', 'hidden')
                .attr('id', 'editRoom')
                .attr('name', 'editRoom')
                .val(clickedID)
          );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error retrieving data: " + errorThrown); }
      });
      $("#modalSave").on("click", function(e){
          e.preventDefault();
          var clickedID = $("#editRoom").val();
          var dataObj = { editRoom : clickedID, size : $("#size").val(), type : $("#type").val(), number : $("#number").val() };
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

  </script>

</div>
</body>
</html>