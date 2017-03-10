<script>
  $(".delete-click").on("click", function(e) {
    var clickedID = $(this).data("detail-id");

    var url = $(location).attr('href').split('/');
    var dataObj;
      if($.inArray('users.php#', url) > -1 || $.inArray('users.php', url) > -1)
          dataObj = { deleteClient : clickedID };
    if($.inArray('teachers.php#', url) > -1 || $.inArray('teachers.php', url) > -1)
		dataObj = { deleteUser : clickedID };
	else if($.inArray('sections.php#', url) > -1 || $.inArray('sections.php', url) > -1)
		dataObj = { deleteSection : clickedID };
	else if($.inArray('courses.php#', url) > -1 || $.inArray('courses.php', url) > -1)
		dataObj = { deleteCourse : clickedID };
	else if($.inArray('rooms.php#', url) > -1 || $.inArray('rooms.php', url) > -1)
		dataObj = { deleteRoom : clickedID };
	else if($.inArray('semesters.php#', url) > -1 || $.inArray('semesters.php', url) > -1)
		dataObj = { deleteSemester : clickedID };
	else if($.inArray('schedule.php?event='+clickedID+'#', url) > -1 || $.inArray('schedule.php?event='+clickedID, url) > -1)
		dataObj = { deleteEvent : clickedID };
    bootbox.confirm("<strong>Are you sure you would like to delete this record? <br> This is a permanent action.</strong>","Cancel", "Confirm", function(e){
      if(e){ 
	     $.ajax({
	      type: 'POST',
	      url: 'query_service.php',
	      data: dataObj,
	      dataType: 'JSON',
	      success: function(response){
	      	if(response != true){
	      		$('#response').html(response);
	      	}
	      	else{
		      	if($.inArray('schedule.php?event='+clickedID+'#', url) > -1 || $.inArray('schedule.php?event='+clickedID, url) > -1)
		      		window.location.replace("admin.php");
		      	else
	    			window.location.reload();
	    	}
	      },
	      error: function(XMLHttpRequest, textStatus, errorThrown){ $("#response").html(errorThrown);}
	      });
	   }
    });
  });
</script>
