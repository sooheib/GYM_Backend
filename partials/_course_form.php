<form id="courseForm" action="query_service.php" method="post" enctype="multipart/form-data"  class="form-horizontal">
    <!--<div class="control-group">-->
    <!-- <label class='control-label' for='crn'>Course CRN</label> -->
    <!--  <div class='controls'> -->
    <!--    <input type='text' id='crn' name='crn' value=''>-->
    <!--  </div>-->
    <!--</div>-->
    <div class="control-group">
        <label class='control-label' for='desc'>Course Description</label>
        <div class='controls'>
            <input type='text' id='desc' name='desc' value=''>
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='code'>Course Name</label>
        <div class='controls'>
            <input type='text' id='code' name='code' value=''>
        </div>

        <div class="control-group">
            <label class='control-label' for='cov'>Course Cover</label>
            <div class='controls'>
                <input type="file" id="cov" name="cov" accept="image/*">
            </div>
        </div>
        <div class="control-group">
            <label class='control-label' for='code'>Course Max Capacity</label>
            <div class='controls'>
                <input type='number' id='capacity' name='capacity' value=''>
            </div>

</form>