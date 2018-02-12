<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<style>
#imagePreview {
    width: 170px;
    height: 200px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>
<section class="content">
<div class="row">
	<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border" style="text-align:center">
					<h3 class="box-title">Data User</h3>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-sm-2">
						<input onkeyup="searchData(this.value);" type="text" name="search" class="form-control" placeholder="Username">
					</div>
					<div class="col-sm-3">
						<button onclick="openFormRoom()" type="button" class="btn btn-sm btn-primary">
										<i class="fa fa-plus"></i>  Add User
								</button>
					</div>
				</div>
				<br/>
				<div class="box-body" style="width:99%">
					<table id="jqGrid"></table>
					<div id="jqGridPagerData"></div>
				</div>
			</div>
		</div>


    <div class="col-lg-12">
  	<div class="modal fade" id="modal_form">
  			<div class="modal-dialog modal-lg" style="width:35%">
  				<div class="modal-content">
            <form class="form-horizontal form-label-left" action="user/prosess_adding" id="form_user" enctype="multipart/form-data" method="post">
  	            <div class="modal-header" style="text-align:center">
  	    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  	    					<h4 class="modal-title"><b></b></h4>
  	    				</div>
		  					<div class="modal-body">
									<div role="tabpanel" style="height:325px">
	                    <!-- Nav tabs -->
	                    <ul class="nav nav-tabs" role="tablist">
	                        <li role="presentation" class="active"><a href="#dataUser" aria-controls="dataUser" role="tab" data-toggle="tab">Data User</a>

	                        </li>
	                        <li role="presentation"><a href="#photoTab" aria-controls="photoTab" role="tab" data-toggle="tab">Photo</a>

	                        </li>
	                    </ul>
	                    <!-- Tab panes -->
	                    <div class="tab-content">
	                        <div role="tabpanel" class="tab-pane active" id="dataUser">
														<div class="modal-body form">
																<div class="form-group">
										                 <div class="col-md-6">
										                   <div class="input-group">
										                     <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-user"></i></span>
										                     <input type="text" class="form-control" name="username" id="username" placeholder="Username" style="height:36px">
										                   </div>
										                 </div>

										                 <div class="col-md-6">
										                   <div class="input-group">
										                     <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="height:36px">
										                     <span class="input-group-addon" aria-hidden="true"><i class="fa fa-code"></i></span>
										                    </div>
										                  </div>
										            </div>

										            <div class="form-group">
										                 <div class="col-md-6">
										                     <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" style="height:36px">
										                 </div>

										                 <div class="col-md-6">
										                      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
										                  </div>
										             </div>

										             <div class="form-group">
										                 <div class="col-md-12">
										                   <div class="input-group">
										                     <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-home"></i></span>
										                     <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Address" style="height:35px">
										                   </div>
										                 </div>
										              </div>

										              <div class="form-group">
										                  <div class="col-md-6">
										                    <div class="input-group">
										                     <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-earphone"></i></span>
										                     <input type="text" class="form-control" name="telpon" id="telpon" placeholder="Phone">
										                   </div>
										               </div>

										               		<div class="col-md-6">
										                    <div class="input-group">
										                      <input type="text" class="form-control" name="email" id="email" placeholder="Email">
										                      <span class="input-group-addon" aria-hidden="true"><i class="fa fa-envelope"></i></span>
										                    </div>
										                  </div>
										               </div>

										               <div class="form-group">
										                 <div class="col-md-12">
										                   <select name="group_id" id="group_id" class="form-control" style="width: 100%;">
										                     <option value="">--</option>
										                     <?php foreach ($userlevelList as $isi) {
										                       echo ('<option value="'.$isi->group_id.'">'.$isi->Description.'</option>');
										                     } ?>
										                   </select>
										                 </div>
										               </div>

																	 <!-- <div class="form-group">
										                 <div class="col-md-12">
										                   <input type="file" class="form-control" name="photo_file" id="photo_file">
										                 </div>
										               </div> -->
							              </div>
													</div>


	                        <div role="tabpanel" class="tab-pane" id="photoTab">
														<div class="modal-body form">
																	<div class="form-group">
																		<div class="col-md-12" style="left:125px">
																			<!-- <div id="imagePreview"></div> -->
																			<img src="<?=$theme_url?>user-image/admin2.jpg" class="photo" id="imagePreview" alt="User Image">
																		</div>
																	</div>
																	 <div class="form-group">
										                 <div class="col-md-12">
										                   <input type="file" class="form-control" name="photo_file" id="photo_file">
										                 </div>
										               </div>
							              </div>
													</div>
	                    </div>
	                </div>
		  	          <div class="ln_solid"></div>

		    	        <div class="modal-footer">
		    	          <div style="text-align: center">
		                    <input type="hidden" name="user_id" id="user_id" />
		                    <input type="hidden" name="unique_id" id="unique_id" />
		    	              <button type="submit" id="btnSubmit" class="btn btn-sm btn-primary">Save</button>
		    	              <button type="reset" class="btn btn-sm btn-danger"
			                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
		    	          </div>
		    	        </div>
		  	          </div>
    	        </form>
              <!-- /.modal-content -->
  					</div>
  				</div>
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
        "jspage"					: 	'js/page/user'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
