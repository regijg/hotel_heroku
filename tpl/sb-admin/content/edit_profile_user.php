<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<style>
#imagePreview {
    width: 100px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>

<selection>
	<div class="row">
    <div class="col-lg-12"><br><hr>
        <!-- <h1>Edit Profile</h1>
      	<hr> -->
      <!-- left column -->
      <div class="col-md-3">
        <form class="form-horizontal" action="edit_profile/prosess_upload" enctype="multipart/form-data" method="post" id="form_edit_photo">
        <?php foreach ($userList as $data) { ?>
            <div class="text-center">
              <img src="<?=$theme_url?>user-image/<?= $data->photo_file ?>" class="avatar img-circle" alt="User Image" id="imagePreview">
              <input type="file" class="form-control" name="photo_file" id="photo_file">
              <input class="form-control" type="hidden" name="user_id" value="<?= $data->user_id ?>">
              <h6><button type="submit" class="btn btn-sm btn-primary">Upload</button></h6>

            </div>
        <?php } ?>
      </form>
      </div>

      <!-- edit form column -->

      <form class="form-horizontal" action="javascript:;" method="post" id="form_edit_profile">
      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>
          <?php foreach ($userList as $data) {?>
            <div class="form-group">
              <label class="col-lg-3 control-label">First name:</label>
              <div class="col-lg-4">
                <input class="form-control" type="hidden" name="user_id" value="<?= $data->user_id ?>">
                <input class="form-control" type="text" name="first_name" id="first_name" value="<?= $data->first_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Last name:</label>
              <div class="col-lg-4">
                <input class="form-control" type="text" name="last_name" name="last_name" value="<?= $data->last_name ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-4">
                <textArea class="form-control" type="text" name="alamat" id="alamat" style="height:80px"><?= $data->alamat ?></textArea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Phone:</label>
              <div class="col-lg-4">
                <input class="form-control" type="text" name="telpon" id="telpon" value="<?= $data->telpon ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">Email:</label>
              <div class="col-lg-4">
                <input class="form-control" type="text" name="email" id="email" value="<?= $data->email ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Username:</label>
              <div class="col-md-4">
                <input class="form-control" type="text" name="username" id="username" value="<?= $data->username ?>">
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-md-3 control-label">Staff:</label>
              <div class="col-md-4">
                <select name="group_id" id="group_id" class="form-control" style="width: 100%;">
                  <option value="">--</option>
                  <?php foreach ($userlevelList as $isi) {
                    echo ('<option value="'.$isi->group_id.'">'.$isi->Description.'</option>');
                  } ?>
                </select>
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-md-3 control-label">Password:</label>
              <div class="col-md-4">
                <input class="form-control" type="password" name="password" id="password">
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-md-3 control-label">Confirm password:</label>
              <div class="col-md-4">
                <input class="form-control" type="password" name="password2" id="password2">
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-md-3 control-label"></label>
              <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Save Changes">
                <span></span>
                <input type="reset" class="btn btn-danger" value="Cancel">
              </div>
            </div>
          <?php } ?>
      </div>
    </form>
  </div>
</div>
</div>
</section>

<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/editprofile'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
