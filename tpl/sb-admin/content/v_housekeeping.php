<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />

<section class="content">
  <div class="col-lg-12" style="right:-80px">
      <div class="col-lg-10"></div>
      <button type="button" class="btn btn-sm btn-primary" onclick="openFormRoom()">Check Room</button>
  </div>
  <div style="margin:4%"></div>
<div class="row">
	<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border" style="text-align:center">
					<h3 class="box-title">House Keeping</h3>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-sm-2">
						<input onkeyup="searchData(this.value);" type="text" name="search" class="form-control" placeholder="Nama">
					</div>
				</div>
				<br/>
				<div class="box-body" style="width:99%">
					<table id="jqGrid"></table>
					<div id="jqGridPagerData"></div>
				</div>
			</div>
		</div>

    <!-- MODAL BOOKING ROOM START -->
    <div class="modal fade" id="modal_roomcheck">
        <div class="modal-dialog modal-lg" style="width:400px">
          <div class="modal-content">
            <form class="form-horizontal form-label-left" action="javascript:;" id="form_roomcheck" method="post">
              <!-- <div class="modal-header" style="text-align:center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>PEMERIKSAAN KAMAR</b></h4>
              </div> -->
              <div class="modal-body">
              <div class="modal-body form">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="col-md-12" style="height:40px">
                      <div class="form-group">
                            <div class="col-md-4">
                              <label>Tanggal</label>
                            </div>
                            <div class="col-md-5">
                              <div class="input-group">
                                <input type="text" class="form-control" name="check_date" id="check_date" value="<?php echo date("d-m-Y")?>" data-date-format='dd-m-yyyy' style="width:95px;">
                                <span class="input-group-addon" aria-hidden="true"><i class="fa fa-calendar"></i></span>
                              </div>
                            </div>
                      </div>
                    </div>

                    <div class="col-md-12" style="height:40px">
                      <div class="form-group">
                            <div class="col-md-4">
                              <label>No. Kamar</label>
                            </div>
                            <div class="col-md-7">
                              <select name="room_number" id="room_number" class="form-control select2" onchange="ambilRoomNumber(this.value, this.id)">
                                <option value=""></option>
                                <?php foreach ($roomList as $isi)
                                  echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.'</option>');
                                 {?>
                                <?php }?>
                              </select>
                            </div>
                      </div>
                    </div>

                    <div class="col-md-12" style="height:40px">
                      <div class="form-group">
                            <div class="col-md-4">
                              <label>Status</label>
                            </div>
                            <div class="col-md-7">
                              <select name="room_status" id="room_status" class="form-control">
                                <option value="1">Vacant Clean</option>
                                <option value="4">Out of Order</option>
                              </select>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-6">
                    <div style="background-color:#959aa0; width:140px">
                      <b>Perlengkapan Kamar</b>
                    </div>
                    <hr/>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas1" id="fasilitas1">
                        <label>
                          Bantal
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas2" id="fasilitas2">
                        <label>
                          Guling
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas3" id="fasilitas3">
                        <label>
                          Sprei
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas4" id="fasilitas4">
                        <label>
                          Rak Handuk
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas5" id="fasilitas5">
                        <label>
                          Lampu Meja
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas6" id="fasilitas6">
                        <label>
                          Pendingin Ruangan
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12" style="height:23px">
                      <div class="form-group">
                          <input type="checkbox" class="minimal" name="fasilitas7" id="fasilitas7">
                        <label>
                          Televisi
                        </label>
                      </div>
                    </div>
                  </div>


                  <div class="col-lg-6">
                      <div style="background-color:#959aa0; width:140px">
                        <b>Kondisi Kamar (Baik)</b>
                      </div>
                      <hr/>
                      <div class="col-md-12" style="height:23px">
                        <div class="form-group">
                          <div class="col-md-9">
                            <label>
                              Kamar Mandi
                            </label>
                          </div>
                          <input type="checkbox" class="minimal" name="kamar_mandi" id="kamar_mandi">
                        </div>
                      </div>
                      <div class="col-md-12" style="height:23px">
                        <div class="form-group">
                          <div class="col-md-9">
                            <label>
                              Dinding
                            </label>
                          </div>
                          <input type="checkbox" class="minimal" name="dinding" id="dinding">
                        </div>
                      </div>
                      <div class="col-md-12" style="height:23px">
                        <div class="form-group">
                          <div class="col-md-9">
                            <label>
                              Atap Plafon
                            </label>
                          </div>
                          <input type="checkbox" class="minimal" name="atap_plafon" id="atap_plafon">
                        </div>
                      </div>
                      <div class="col-md-12" style="height:23px">
                        <div class="form-group">
                          <div class="col-md-9">
                            <label>
                              Pintu
                            </label>
                          </div>
                          <input type="checkbox" class="minimal" name="pintu" id="pintu">
                        </div>
                      </div>
                      <div class="col-md-12" style="height:23px">
                        <div class="form-group">
                          <div class="col-md-9">
                            <label>
                              Lain-lain
                            </label>
                          </div>
                          <input type="checkbox" class="minimal" name="lain_lain" id="lain_lain">
                        </div>
                      </div>
                 </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                      <textArea class="form-control" name="keterangan" id="keterangan" placeholder="Kerusakan" style="height:75px"></textArea>
                    </div>
                </div>

                <div style="margin:1%">
                  <button type="submit" class="btn btn-sm btn-primary">Save</button>
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                </div>
              </div>
              <!-- <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
              </div> -->
              </div>
            </form>
            </div>
          </div>
        </div>
        <!-- MODAL BOOKING ROOM END -->
</div>
</section>

<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/housekeeping'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
