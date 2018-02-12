<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<style>
.form-group {
  position: relative;
  margin-bottom: 1.5rem;
}

.form-control-placeholder {
  position: absolute;
  top: 0;
  padding: 7px 0 0 13px;
  transition: all 200ms;
  opacity: 0.5;
}

.form-control:focus + .form-control-placeholder,
.form-control:valid + .form-control-placeholder {
  font-size: 100%;
  transform: translate3d(0, -100%, 0);
  opacity: 1;
}
</style>
<section class="content">

    <!-- <div class="col-md-5">
        <select class="form-control select2" id="lantaibooking" value="floorbooking" name="floorbooking" style="width: 100%;">
          <option value="">--</option>
          <option value="1">Lantai 1</option>
          <option value="2">Lantai 2</option>
          <option value="3">Lantai 3</option>
          <option value="4">Lantai 4</option>
        </select>
    </div>
    <div class="col-md-5">
        <select class="form-control select2" multiple="multiple" id="roombooking" data-placeholder="Select a State" style="width: 100%;">
            <?php foreach ($rooms as $isi) if ($isi->room_status == 1) {
              $status = 'Check-IN';
              echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.' - '.$status.'</option>');
            } {?>
            <?php }?>
        </select>
    </div> -->
  <div class="col-lg-12" style="right:-80px">
      <div class="col-lg-10"></div>
      <button type="button" class="btn btn-sm btn-primary" onclick="openFormRoom()">Booking Room</button>
  </div>
  <div style="margin:4%"></div>
<div class="row">
	<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border" style="text-align:center">
					<h3 class="box-title">Booking Data</h3>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-sm-2">
						<input onkeyup="searchData(this.value);" type="text" name="search" class="form-control" placeholder="Nama or No-Resv">
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
    <div class="modal fade" id="modal_booking">
        <div class="modal-dialog modal-lg" style="width:850px">
          <div class="modal-content" style="height:580px">
            <form class="form-horizontal form-label-left" action="javascript:;" id="form_booking" method="post">
                <!-- <div class="modal-header" style="text-align:center">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><b>Booking Room</b></h4>
                </div> -->
            <div class="modal-body">
              <div class="modal-body form">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
												<div class="col-md-2">
													<div class="controlsDeactive">
				                    <input type="text" class="form-control floatLabel" name="resv_no" id="resv_no" value="<?= $kodeunik ?>" style="background-color:#f7f9fb" readonly>
                            <label for="resv_no">No. Registrasi</label>
                          </div>
												</div>
			                </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-md-6">
                        <div class="controlsDeactive">
                          <input type="text" class="form-control floatLabel" name="nama_pemesan" id="nama_pemesan">
                          <label for="nama_pemesan"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Nama</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="controlsDeactive">
                          <input type="text" class="form-control floatLabel" name="telpon" id="telpon">
                          <label for="telpon"><i class="glyphicon glyphicon-earphone"></i>&nbsp;&nbsp;Telpon</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="controlsDeactive">
                      <input type="text" class="form-control floatLabel" name="alamat" id="alamat">
                      <label for="alamat"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;Alamat</label>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="col-md-2">
                        <div class="controlsDeactive">
                          <input type="text" class="form-control floatLabel" name="resv_date" id="resv_date" value="<?php echo date("d-m-Y")?>" data-date-format='dd-m-yyyy' style="width:115px;background-color:#fff" readonly>
                          <label for="resv_date" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Tgl Reservasi</label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="controlsDeactive">
                          <input type="text" class="form-control floatLabel" id="resv_in_fake" onchange="tanggalMasukFake()">
                          <label for="resv_in_fake" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Check-IN</label>
                          <input type="hidden" class="form-control" name="resv_in" id="resv_in" style="width:95px;">
                        </div>
                      </div>
                      <div class="col-md-1" style="top:7px; color:red; left:-12px">s.d</div>
                      <div class="col-md-2" style="left:-48px">
                        <div class="controlsDeactive">
                          <input type="text" class="form-control floatLabel" id="resv_out_fake" onchange="tanggalKeluarFake()">
                          <label for="resv_out_fake" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Check-OUT</label>
                          <input type="hidden" class="form-control" name="resv_out" id="resv_out" onchange="hitung_durasi_tgl();" style="width:95px;">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="controlsDeactive" style="left:-45px">
                          <input type="text" class="form-control floatLabel" name="in_time" id="in_time" data-date-format='H:i'>
                          <label for="in_time" class="label-date"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;In Time</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="controlsDeactive" style="left:-45px">
                          <i class="fa fa-sort"></i>
                          <select name="resv_status" id="resv_status" class="form-control floatLabel">
                            <option value="1">Outstanding</option>
                            <option value="2">Confirm</option>
                            <option value="3">Cancel</option>
                          </select>
                          <label for="resv_status">Status</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr/>

                <div class="row">
                  <div class="col-lg-12">
                    <div id="table-template-booking">
                      <table class="table table-hover table-responsive" id="tabel_layanan">
                        <thead>
                          <tr>
                            <th>No. Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Harga</th>
                            <th>Hari</th>
                            <th>Tamu</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody id="row_layanan">
                              <tr id="row">
                                  <td>
                                    <div class="controlsDeactive">
                                      <select name="room_number" id="room_number" class="form-control floatLabel" onchange="ambilRoomNumber(this.value, this.id)" style="width:200px">
                                        <option value=""></option>
                                        <?php foreach ($roomList as $isi) if ($isi->room_status == 1) {
                                          $status = 'Check-IN';
                                          echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.' - '.$isi->rate_name.'</option>');
                                        } {?>
                                        <?php }?>
                                      </select>
                                    </div>
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="rate_name" id="rate_name" placeholder="Tipe Kamar">
                                  </td>
                                  <td>
                                    <input type="hidden" class="form-control" name="tarif_umum" id="tarif_umum" placeholder="Harga">
                                    <input type="text" class="form-control" id="tarif_umum_fake" placeholder="Harga" style="width:125px">
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" id="hari" onkeyup="hitungTotalPembayaranKamar();" style="width:40px">
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="person" id="person" style="width:40px">
                                  </td>
                                  <td>
                                    <input type="hidden" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah">
                                    <input type="text" class="form-control" id="jumlah_fake" placeholder="Jumlah" style="width:125px">
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
                  <div class="col-md-3">
                    <div class="controlsDeactive">
                      <input class="form-control" type="hidden" style="text-align: right; width:167px" name="subtotal" id="subtotal">
                      <input type="text" class="form-control floatLabel" style="text-align: right; width:167px" id="subtotal_fake">
                      <label for="subtotal_fake"><i class="fa fa-money"></i>&nbsp;&nbsp;SUBTOTAL</label>
                    </div>
                  </div>
                </div><br>

                <div class="row">
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-3">
                    <div class="controlsDeactive" style="left:-45px">
                      <i class="fa fa-sort"></i>
                      <select class="form-control floatLabel" id="deposit_type" name="deposit_type" style="width:100%">
                        <option value="1">Tunai</option>
                        <option value="2">Debit</option>
                        <option value="3">Kredit</option>
                      </select>
                      <label for="deposit_type">Pembayaran Deposit</label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <!-- <div class="form-group">
                      <div class="col-md-12">
                        <input class="form-control" type="hidden" style="text-align: right; width:167px" name="deposit" id="deposit">
                        <input class="form-control" type="text" style="text-align: right; width:167px" id="deposit_fake" onkeyup="depositeFake()">
                        <label class="form-control-placeholder" for="deposit" style="font-size:10px">DEPOSIT</label>
                      </div>
                    </div> -->
                    <div class="controlsDeactive">
                      <input class="form-control" type="hidden" style="text-align: right; width:167px" name="deposit" id="deposit">
                      <input class="form-control" type="text" style="text-align: right; width:167px" id="deposit_fake" onkeyup="depositeFake()">
                      <label for="deposit_fake"><i class="fa fa-money"></i>&nbsp;&nbsp;DEPOSIT</label>
                    </div>
                  </div>
                </div> <br>

                <div class="row">
                    <div class="col-lg-9">
                        <!-- <textarea class="form-control" type="text" name="description" id="description" style="font-size: 12px;height: 85px;"></textArea>
                        <label class="form-control-placeholder" for="description">Catatan</label> -->
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
                </div>


              </div>
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
        "jspage"					: 	'js/page/reservasi'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
