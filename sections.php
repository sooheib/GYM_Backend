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
      <li><a href="users/index.php">Clients</a></li>
      <li ><a href="teachers.php">Trainers</a></li>
    <li ><a href="courses.php">Courses</a></li>
     <li class="active"><a href="sections.php">Sections</a></li>
    <li><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>
  </ul>

  <?php include "partials/_search_table.php";  ?>
  
  <a href="add.php?section"><button class="pull-right btn btn-primary">Add A Section</button></a>
  <div class="clear"></div>
    <?php 
      $result = select("section_t","");
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
        <th> Section ID  </th>
        <th> Section Name  </th>
        <th> Section Description  </th>
        <th> Section Size  </th>
      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"section_id");
        $name=mysql_result($result,$i,"section_name");
        $desc=mysql_result($result,$i,"section_desc");
        $size=mysql_result($result,$i,"section_size");
    ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $name; ?>  </td>
    <td> <?php echo $desc; ?>  </td>
    <td> <?php echo $size; ?>  </td>
    <td> <a href="admin.php?section=<?php echo $id ?>">Schedule</a></td>
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
        <?php include('partials/_section_form.php') ?>
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
      var dataObj = { sectionID : clickedID };
      $.ajax({
        type: 'POST',
        url: 'query_service.php',
        data: dataObj,
        dataType: 'JSON',
        success: function(response)
        {
          $('#details').show().modal({ backdrop: true });
          $('#detailsID').html("ID: " + response[0]['id']);
          $('#name').val(response[0]['name']);
          $('#desc').val(response[0]['desc']);
          $('#size').val(response[0]['size']);
          $('#details').append(
            $('<input/>')
                .attr('type', 'hidden')
                .attr('id', 'editSection')
                .attr('name', 'editSection')
                .val(clickedID)
          );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){alert("fail: " + errorThrown);}
      });
      $("#modalSave").on("click", function(e){
          e.preventDefault();
          var clickedID = $("#editSection").val();
          var dataObj = { editSection : clickedID,  name : $("#name").val(), desc : $("#desc").val(), size : $("#size").val() };
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