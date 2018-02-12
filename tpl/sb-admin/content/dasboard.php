<style>
div.icon.guest {
    top: -35px;
}

div.icon.checkin{
    top: -35px;
}

div.icon.checkout {
    top: -35px;
    width: 70px;
}

div.icon.reservasi {
    top: -35px;
    width: 70px;
}

div.value.room_number {
    top: -35px;
}

.lingkarannya-dengan-tulisan {
    color: #fff;
    height: 60px;
    width: 60px;
    text-align: center;
    font-size: 20px;
    line-height: 60px;
    -moz-border-radius:75px;
    -webkit-border-radius: 75px;
    border-bottom:none;
    border-left:none;
    border-right:none;
    border-top:none;
}

.simple-box{
width:5px;
height:5px;
background:lime;
}
</style>

<section class="content-header">
  <h1>
    Dashboard
    <small>Pusat Pengembangan SDM</small>
  </h1>
</section>

<section class="content">
  <?php if ($this->session->userdata('akses') != 3): ?>
    <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= $countDataRegistrasi ?></h3>

                <p>Kamar Terpakai</p>
              </div>
              <div class="icon guest">
                <img src="<?=$theme_url?>images/guest3.png" class="img-circle" alt="User Image" style="width:45px; opacity:0.4">
                <!-- <i class="ion ion-bag"></i> -->
              </div>
              <a href="<?= base_url('/tamu_menginap') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?= $countDataCheckin ?></h3>

                <p>Jumlah Check-IN</p>
              </div>
              <div class="icon checkin">
                <img src="<?=$theme_url?>images/checkin.png" class="img-circle" alt="User Image" style="width:70px; opacity:0.4">
                <!-- <i class="fa fa-bed"></i> -->
              </div>
              <a href="<?= base_url('/tamu_menginap/checkin') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?= $countDataCheckout ?></h3>

                <p>Jumlah Check-OUT</p>
              </div>
              <div class="icon checkout">
                <img src="<?=$theme_url?>images/checkout.png" class="img-circle" alt="User Image" style="width:70px; opacity:0.4">
                <!-- <i class="ion ion-bag"></i> -->
              </div>
              <a href="<?= base_url('/registrasi') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= $countDataReservasi ?></h3>

                <p>Jumlah Reservasi</p>
              </div>
              <div class="icon checkout">
                <img src="<?=$theme_url?>images/reservasi.png" class="img-circle" alt="User Image" style="width:70px; opacity:0.4">
                <!-- <i class="ion ion-bag"></i> -->
              </div>
              <a href="<?= base_url('/reservasi') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
                <!-- reservasi LIST -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">⦁	Rencana Check-IN Hari Ini (Reservations)</h3>
                    <div class="box-tools pull-right">
                      <span class="label label-primary"><?= $countDataReservasiCheckinHariIni ?> New Reservations</span>
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                      <!-- <li> -->
                        <?php foreach ($rencanaCheckinHariIni as $isi)
      				          		if ($isi->resv_status_checkin == 0) {
                              echo ('<li>
                                <input class="lingkarannya-dengan-tulisan" style="background-color: #3c8dbc !important; max-width:60%; font-weight: bold;" value="'.$isi->room_number.'">
                                <a class="users-list-name" href="#">'.$isi->nama_pemesan.'</a>
                                <span class="users-list-date">Today</span>
                              </li>');
                            }else {
                              echo ('<li>
                                <input class="lingkarannya-dengan-tulisan" style="background-color: #3c8dbc !important; max-width:60%; font-weight: bold; color:#000000" value="'.$isi->room_number.'">
                                <a class="users-list-name" href="#">'.$isi->nama_pemesan.'</a>
                                <span class="users-list-date">Today</span>
                              </li>');
                            }
      				          ?>
                    </ul>
                    <!-- /.reservasi-list -->
                  </div>
                  <!-- /.box-body -->
                    <!-- <input type="checkbox"> -->
                  <div class="box-footer">
                    <div class="col-lg-3" style="width:160px"><div class="fa fa-circle"> = Check-IN</div></div>
                    <!-- <div class="col-lg-4"><a href="/reservasi/checkin" class="uppercase">View All Reservastions</a></div> -->

                  </div>
                  <!-- /.box-footer -->
                </div>
                <!--/.box -->
              </div>


              <div class="col-md-6">
                    <!-- reservasi LIST -->
                    <div class="box box-danger">
                      <div class="box-header with-border">
                        <h3 class="box-title">⦁	Rencana Check-OUT Hari Ini (Reservations)</h3>

                        <div class="box-tools pull-right">
                          <span class="label label-danger"><?= $countDataReservasiCheckoutHariIni ?></span>
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                          <!-- <li> -->
                            <?php foreach ($rencanaCheckoutHariIni as $isi)
          				          		echo ('<li>
                                  <input class="lingkarannya-dengan-tulisan" style="background-color: #dd4b39 !important; max-width:60%" value="'.$isi->room_number.'">
                                  <a class="users-list-name" href="#">'.$isi->nama_pemesan.'</a>
                                  <span class="users-list-date">Today</span>
                                </li>');
          				          ?>
                        </ul>
                        <!-- /.reservasi-list -->
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer text-center" style="height:40px">
                        <!-- <a href="javascript:void(0)" class="uppercase">View All Reservastions</a> -->
                      </div>
                      <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                  </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-xs-6">
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Kamar Tersedia (Per Tipe)</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="javascript:;">Superior Room
                    <span class="pull-right text-green"><?= $jumlahKamarTipeSuperiorRoom ?></span></a>
                  </li>
                  <li><a href="javascript:;">Deluxe Room
                    <span class="pull-right text-green"><?= $jumlahKamarTipeDeluxeRoom ?></span></a>
                  </li>
                  <li><a href="javascript:;">Junior Suite
                    <span class="pull-right text-green"><?= $jumlahKamarTipeJuniorSuite ?></span></a>
                  </li>
                  <li><a href="javascript:;">Executive Suite
                    <span class="pull-right text-green"><?= $jumlahKamarTipeExecutiveSuite ?></span></a>
                  </li>
                  <li><a href="javascript:;">Deluxe Royal Room
                    <span class="pull-right text-green"><?= $jumlahKamarTipeDeluxeRoomRoyal ?></span></a>
                  </li>
                  <li><a href="javascript:;">Exclusive Suite Royal
                    <span class="pull-right text-green"><?= $jumlahKamarTipeExecutiveSuiteRoyal ?></span></a>
                  </li>
                  <li><a href="javascript:;">Diplomatic Suite
                    <span class="pull-right text-green"><?= $jumlahKamarTipeDiplomaticSuite ?></span></a>
                  </li>
                  <li><a href="javascript:;">Presidential Suite
                    <span class="pull-right text-green"><?= $jumlahKamarTipePresidentialSuite ?></span></a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
          </div>

          <div class="col-lg-4 col-xs-6">
          <div class="box box-danger">
              <div class="box-header with-border">
                <p class="box-title">Kamar Belum Bisa Digunakan</p>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="javascript:;">Kotor
                    <span class="pull-right text-red"><?= $jumlahKamarKotor ?></span></a>
                  </li>
                  <li><a href="javascript:;">Rusak
                    <span class="pull-right text-red"><?= $jumlahKamarRusak ?></span></a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
          </div>
        </div>
    <?php else:?>
      <div class="row" id="divRow" onload="simpan_pembayaran(this.value)">
      	<div class="col-lg-12">
      				<div class="box-body" style="width:100%" id="myDivRoomBody">
                <!-- <br></br> -->
      					<div class="nav-tabs-custom">
                  <div class="box-body" id="myDivRoom">
      							<div class="tab-content" id="tab_content">
      	              <div class="tab-pane fade active in" id="lantai1">
      				          <?php foreach ($roomListStatus as $isi) if ($isi->room_status == 3) {  $status = 'Vacant Dirty'; ?>
      										    <tr>
      														<div class="col-lg-2 col-xs-4">
      															<div class="small-box" id="room_floor1" style="background-color:#dbdbe4 !important">
      															<div class="inner">
      																<h3><?= $isi->room_number ?><sup style="font-size: 20px"></sup></h3>
      																<p><?= $isi->rate_name ?></p>
      																<input type="hidden" value='.$isi->room_status.' id="room_status"></input>
      															</div>
      															<div class="icon">
      							                  <i class="fa fa-times" style="font-size:50px"></i>
      							                </div>
      																<a href="javascript:;" class="small-box-footer" id="room_status_id">
      																<?= $status ?>
      																	<i class="fa fa-arrow-circle-right"></i>
      																</a>
      															</div>
      														</div>
      											</tr>
      				          <?php }?>
      	              </div>
      	              <!-- /.tab-pane -->
      	            </div>
      						</div>
                  <!-- /.tab-content -->
                </div>
      				</div>
      		</div>
      </div>
  <?php endif; ?>

</section>
<script type="text/javascript">
  require.config({
      baseUrl: baseURL+'tpl/sb-admin/',
      urlArgs: "bust=" + (new Date()).getTime(),
      paths: {
          "core"               		:   'js/main',
					// "jquery": 'jquery-2.2.3',
          // "jspage"					: 	'js/page/peserta'
      }
    });
    require(["core"], function(core) {
        require([
                //  'jspage',
                 'tpl.all'
         ], function(){});
    });
</script>
