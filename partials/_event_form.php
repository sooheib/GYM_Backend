<form id="eventForm" action="query_service.php" method="post" enctype="multipart/form-data"  class="form-horizontal">


    <div class="control-group">
        <label class='control-label' for='name'>Event Name</label>
        <div class='controls'>
            <input type='text' id='name' name='name' value=''>
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='location'>Event Location</label>
        <div class='controls'>
            <input type='text' id='location' name='location' value=''>
        </div>
    </div>

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
        <label class='control-label' for='name'>Event Description</label>
        <div class='controls'>
            <input type='text' id='description' name='description' value=''>
        </div>
    </div>

    <div class="control-group">
        <label class='control-label' for='cov'>Client Photo</label>
        <div class='controls'>
            <input type="file" id="cover" name="cover" accept="image/*">
        </div>
    </div>

    <div class="control-group">
        <label class='control-label' for='code'>Event Max Capacity</label>
        <div class='controls'>
            <input type='number' id='capacity' name='capacity' value=''>
        </div>

