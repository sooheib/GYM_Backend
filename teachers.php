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
      <li class="active"><a href="teachers.php">Trainers</a></li>
    <li><a href="courses.php">Courses</a></li>
     <li><a href="sections.php">Sections</a></li>
    <li><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>
  </ul>

  <?php include "partials/_search_table.php";  ?>
  
  <a href="add.php?teacher"><button class="pull-right btn btn-primary">Add A Trainer</button></a>
  <div class="clear"></div>
  <?php 
    $result = select("user_t", "admin <> 1");
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
        <th> Employee ID  </th>
        <th> First Name  </th>
        <th> Last Name  </th>
        <th> Username  </th>
          <th> Photo</th>

      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"employee_id");
        $user=mysql_result($result,$i,"username");
        $fname=mysql_result($result,$i,"first_name");
        $lname=mysql_result($result,$i,"last_name");
          $cover=mysql_result($result,$i,"photo");

          ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $fname; ?>  </td>
    <td> <?php echo $lname; ?>  </td>
    <td> <?php echo $user; ?>  </td>
        <td><img height="20%" width="20%" src="partials/teacher_photos/<?php echo $cover; ?>"/></td>

        <td> <a href="admin.php?teacher=<?php echo $id ?>">Schedule</a></td>
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
        <?php include('partials/_teacher_form.php') ?>
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
      var dataObj = { userID : clickedID };
      $.ajax({
        type: 'POST',
        url: 'query_service.php',
        data: dataObj,
        dataType: 'JSON',
        success: function(response)
        {
          $('#details').show().modal({ backdrop: true });
          $('#detailsID').html("ID: " + response[0]['id']);
          $('#fName').val(response[0]['first']);
          $('#lName').val(response[0]['last']);
          $('#uName').val(response[0]['user']);
          $('#pass').val(response[0]['pass']);
            $('#cover').val(response[0]['cover']);
            $('#details').append(
            $('<input/>')
                .attr('type', 'hidden')
                .attr('id', 'editUser')
                .attr('name', 'editUser')
                .val(clickedID)
          );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){alert("fail: " + errorThrown);}
      });
      $("#modalSave").on("click", function(e){
          e.preventDefault();
          var clickedID = $("#editUser").val();
          var dataObj = { editUser : clickedID, fName : $("#fName").val(), lName : $("#lName").val(),
              uName : $("#uName").val(), pass : $("#pass").val(),cover : $("#cover").val()  };
        $.ajax({
          type: 'POST',
          url: 'query_service.php',
          data: dataObj,
          dataType: 'JSON',
          success: function(response){
            window.location.reload();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html(errorThrown);}
        });
      });
    });

  </script>

</div>
</body>
</html>