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
      <li><a href="schedule1.php">Schedule</a></li>
      <li><a href="event.php">Events</a></li>
      <li><a href="users.php">Clients</a></li>
      <li ><a href="teachers.php">Trainers</a></li>
    <li><a href="courses.php">Courses</a></li>
     <li><a href="sections.php">Sections</a></li>
    <li><a href="rooms.php">Rooms</a></li>
     <li class="active"><a href="semesters.php">Semesters</a></li>
  </ul>

  <?php include "partials/_search_table.php";  ?>
  <div class="clear"></div>
  <a href="add.php?semester"><button class="pull-right btn btn-primary">Add A Semester</button></a>

  <?php 
    $result = select("semester_t","");
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
        <th> Semester ID  </th>
        <th> Year  </th>
        <th> Quarter  </th>
        <th> Start Date  </th>
        <th> End Date  </th>
      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"semester_id");
        $year=mysql_result($result,$i,"year");
        $quarter=mysql_result($result,$i,"quarter");
        $start=mysql_result($result,$i,"startDate");
        $end=mysql_result($result,$i,"endDate");
    ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $year; ?>  </td>
    <td> <?php echo $quarter; ?>  </td>
    <td> <?php echo $start; ?>  </td>
    <td> <?php echo $end; ?>  </td>
    <td> <a href="admin.php?semester=<?php echo $id ?>">Schedule</a></td>
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
        <?php include('partials/_semester_form.php') ?>
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
      var dataObj = { semesterID : clickedID };
      $.ajax({
        type: 'POST',
        url: 'query_service.php',
        data: dataObj,
        dataType: 'JSON',
        success: function(response)
        {
          $('#details').show().modal({ backdrop: true });
          $('#detailsID').html("ID: " + response[0]['id']);
          $('#quarter').val(response[0]['quarter']);
          $('#start').val(response[0]['start']);
          $('#end').val(response[0]['end']);
          $('#details').append(
            $('<input/>')
                .attr('type', 'hidden')
                .attr('id', 'editSemester')
                .attr('name', 'editSemester')
                .val(clickedID)
          );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error retrieving data: " + errorThrown); }
      });
      $("#modalSave").on("click", function(e){
          e.preventDefault();
          var clickedID = $("#editSemester").val();
          var y = $('#start').val().split("/");
          y = y[2];
          var dataObj = { editSemester : clickedID, year : y, quarter : $("#quarter").val(), start : $("#start").val(), end : $("#end").val() };
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
        $('#start, #end').datepicker( { changeYear: true, changeMonth: true } );
  });
</script>

</div>
</body>
</html>