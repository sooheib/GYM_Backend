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
      <li class="active"><a href="event.php">Events</a></li>
      <li><a href="users.php">Clients</a></li>
      <li ><a href="teachers.php">Trainers</a></li>
    <li><a href="courses.php">Courses</a></li>
     <li><a href="sections.php">Sections</a></li>
    <li><a href="rooms.php">Rooms</a></li>
     <li><a href="semesters.php">Semesters</a></li>

  </ul>

  <?php include "partials/_search_table.php";  ?>
  <div class="clear"></div>
  <a href="add.php?event"><button class="pull-right btn btn-primary">Add An Event</button></a>

  <?php 
    $result = select("event_t","");
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
        <th> Event ID  </th>
        <th> Event Name  </th>
        <th> Event Location  </th>
        <th> Start Date  </th>
        <th> End Date  </th>
          <th> Event Description  </th>
          <th> Event Cover  </th>
          <th> End Max Capacity  </th>
          <th> Event Reserved  </th>
      </tr>
    </thead>

    <tbody class="searchable">
    <?php
      $i=0;
      while ($i < $count) {
        $id=mysql_result($result,$i,"event_id");
        $name=mysql_result($result,$i,"event_name");
        $location=mysql_result($result,$i,"event_location");
        $startdate=mysql_result($result,$i,"event_startDate");
        $enddate=mysql_result($result,$i,"event_endDate");
          $description=mysql_result($result,$i,"event_description");
          $cover=mysql_result($result,$i,"event_cover");
          $maxcapacity=mysql_result($result,$i,"event_maxCapacity");
          $reserved=mysql_result($result,$i,"event_countReserved");
          ?>
    <tr>
    <td> <?php echo $id; ?>  </td>
    <td> <?php echo $name; ?>  </td>
    <td> <?php echo $location; ?>  </td>
    <td> <?php echo $startdate; ?>  </td>
    <td> <?php echo $enddate; ?>  </td>
        <td> <?php echo $description; ?>  </td>
        <td><img width="20%" height="20%" src="partials/event_images/<?php echo $cover; ?>"/></td>
        <td> <?php echo $maxcapacity; ?>  </td>
        <td> <?php echo $reserved; ?>  </td>

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
        <?php include('partials/_event_form.php') ?>
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
      var dataObj = { eventID : clickedID };
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
                .attr('id', 'editEvent1')
                .attr('name', 'editEvent1')
                .val(clickedID)
          );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){$("#response").html("error retrieving data: " + errorThrown); }
      });
      $("#modalSave").on("click", function(e){
          e.preventDefault();
          var clickedID = $("#editEvent1").val();
          var y = $('#start').val().split("/");
          y = y[2];
          var dataObj = { editEvent1 : clickedID, year : y, quarter : $("#quarter").val(), start : $("#start").val(), end : $("#end").val() };
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
  })
</script>

</div>
</body>
</html>