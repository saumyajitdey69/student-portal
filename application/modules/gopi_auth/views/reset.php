<legend>password Reset</legend>
   <div class="" id="status-report"></div>
    <div class="tab-pane active" id="reset">
        <br>
        <form class="form" role="form" id="reset-form">
            <div class="form-group">
                <input required type="password" id="inputPassword-password1" name="password1" class="form-control" placeholder="Password" autofocus>
            </div>
            <div class="form-group">
                <input required type="password" id="inputPassword-password2" name="password2" class="form-control" placeholder="Retype Password">
            </div>
            <div class="form-group">
                <input type="hidden" id="activationLink" name="activationLink" value="<?php echo $activation_link;?>">
            </div>
            <div class="form-group">
                <button class="btn btn-md btn-primary ">Update Password</button>
            </div>
        </form>
    </div>
    <div id="loading" class="hidden">
        <img src="<?php echo asset_url(); ?>images/loading.gif" alt="Loading">
    </div>