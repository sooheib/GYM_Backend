<form id="userForm" action="query_service.php" method="post" enctype="multipart/form-data"   class="form-horizontal">

    <div class="control-group">
        <label class='control-label' for='crn'>Client ID</label>
        <div class='controls'>
            <input type='text' id='idC' name='idC' value=''>
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='desc'>Client Name</label>
        <div class='controls'>
            <input type='text' id='nameC' name='nameC' value=''>
        </div>
    </div>
    <div class="control-group">
        <label class='control-label' for='code'>Client Email</label>
        <div class='controls'>
            <input type='text' id='emailC' name='emailC' value=''>
        </div>
        <br>

        <div class="control-group">
            <label class='control-label' for='cover'>Client Password</label>
            <div class='controls'>
                <input type='tel' id='epassword' name='epassword' value="">

            </div>
        </div>


        <div class="control-group">
            <label class='control-label' for='cov'>Client Photo</label>
            <div class='controls'>
                <input type="file" id="photou" name="photou" accept="image/*">
            </div>
        </div>