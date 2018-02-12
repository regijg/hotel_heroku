<link href="<?=$theme_url?>vendors/formvalidation/dist/css/formValidation.css" rel='stylesheet' type='text/css' />
<link href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" rel='stylesheet' type='text/css' />

<style>
input.no_line {
  border-bottom:none;
  border-left:none;
  border-right:none;
  border-top:none;
 }
</style>

<section class="content">
<div class="row">
	<div class="col-lg-12">
    <form action="javascript:;" method="post" id="form_registrasi_tamu">
			<div class="box box-primary">
				<div class="box-header with-border" style="text-align:center">
					<h3 class="box-title">DAFTAR TAMU WISMA</h3>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-sm-2">
            <label>Nama / No Registrasi</label>
						<input onkeyup="searchData(this.value);" type="text" name="search" class="form-control">
					</div>
          <div class="col-sm-2">
            <label>From</label>
            <div class="input-group date" id="in_date_start_div">
              <input type="text" class="form-control" name="in_date_start" id="in_date_start">
              <span class="input-group-addon" aria-hidden="true"><i class="fa fa-calendar"></i></span>
            </div>
					</div>
          <div class="col-sm-2">
            <label>To</label>
            <div class="input-group date" id="in_date_end_div">
              <input type="text" class="form-control" name="in_date_end" id="in_date_end">
              <span class="input-group-addon" aria-hidden="true"><i class="fa fa-calendar"></i></span>
            </div>
					</div>
          <div class="col-sm-2" style="top:5px; left:-15px">
              <br>
              <button type="button" class="btn btn-xs btn-primary" onclick="setDateRange()" style="height:30px"> Search</i></button>
              <button type="button" class="btn btn-xs btn-danger" onclick="resetData(this.value)" style="height:30px"><i class="fa fa-undo"></i> Reset</button>
					</div>
          <!-- <div class="col-sm-2">
						<input type="text" name="periode" id="periode" class="form-control" placeholder="Periode">
					</div> -->
          <!-- <div class="col-sm-2">
						<input type="text" name="in_date" id="in_date_start" class="form-control" placeholder="Nama or No-Reg">
					</div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-default" onclick="setNama()"><i class="fa fa-search"></i></button>
					</div> -->
          <br></br>
				</div>
        <!-- <div class="form-group">



        </div> -->
				<div class="box-body" style="width:99%">
					<table id="jqGridDataTamu"></table>
					<div id="jqGridPagerData"></div>
				</div>
			</div>
    </form>
		</div>


    <!-- MODAL REGISTRASI UMUM ROOM START -->
		<div class="modal fade" id="modal_registrasi_umum">
        <div class="modal-dialog modal-lg" style="width:850px">
          <div class="modal-content">
            <form class="form-horizontal form-label-left" action="javascript:;" id="form_registrasi_umum" method="post">
            <div class="modal-body">
              <div class="modal-body form">
								<div class="row">
									<!-- <div class="col-lg-12">
										<div class="form-group" style="height:10px">
					            <label class="col-lg-2">No Registrasi </label>
					            <div class="col-lg-4" style="left:-50px;top: -6px;">
					              <input class="form-control no_line" type="text" name="reg_no" id="reg_no">
					            </div>
					          </div>
									</div>
									<div class="col-lg-12">
										<div class="form-group" style="height:10px">
					            <label class="col-lg-2">Nama </label>
					            <div class="col-lg-4" style="left:-50px;top: -6px;">
					              <input class="form-control no_line" type="text" name="nama" id="nama">
					            </div>
					          </div>
									</div>
									<div class="col-lg-12">
										<div class="form-group" style="height:10px">
					            <label class="col-lg-2">Dari Kamar </label>
					            <div class="col-lg-2" style="left:-50px;top: -6px;">
					              <input class="form-control no_line" type="text" name="room_number_lama" id="room_number_lama">
					            </div>
					          </div>
									</div> -->
                  <div class="col-lg-6">
                    <table class="table table-hover table-responsive">
                      <thead>
                        <tr>
                          <th style="width:125px">Asal Kamar</th>
                          <th>Nama</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input type="text" class="form-control" name="room_number_lama" id="room_number_lama">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="nama" id="nama">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
								</div>
								<!-- <hr> -->
                <div class="row">
                  <div class="col-lg-12">
                    <div id="table-template-booking">
                      <table class="table table-hover table-responsive" id="tabel_layanan">
                        <thead>
                          <tr>
                            <th>Pilih Kamar</th>
                            <th style="width:125px">Tipe Kamar</th>
                            <th style="width:125px">Harga</th>
                            <th style="width:40px">Tamu</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody id="row_layanan">
                              <tr id="row">
                                  <td>
                                    <select name="room_number" id="room_number" class="form-control select2" onchange="ambilRoomNumber(this.value, this.id)">
                                      <option value=""></option>
                                      <?php foreach ($roomList as $isi) if ($isi->room_status == 1) {
                                        $status = 'Check-IN';
                                        echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.'</option>');
                                      } {?>
                                      <?php }?>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="rate_name" id="rate_name" placeholder="Tipe Kamar" style="width:125px">
                                  </td>
                                  <td>
                                    <input type="hidden" class="form-control" name="price" id="price" placeholder="Harga">
                                    <input type="text" class="form-control" id="price_fake" placeholder="Harga" style="width:125px">
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="person" id="person" placeholder="Jumlah" style="width:40px">
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan">
                                  </td>
                                </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="col-lg-9">
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <input type="hidden" class="form-control" name="resv_id_switch" id="resv_id_switch" style="width:95px" readonly>
                        <input type="hidden" class="form-control" name="row_id" id="row_id" style="width:95px" readonly>
                        <input type="hidden" name="flag_" id="flag_">
                        <div class="col-md-12" style="text-align:right">
                          <button type="submit" class="btn btn-sm btn-primary">Save</button>
                          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <div class="col-lg-12">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- MODAL REGISTRASI DIKLAT ROOM END -->
</div>
</section>

<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/registrasi'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
