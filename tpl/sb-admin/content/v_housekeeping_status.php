<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<style type='text/css'>
input.tarif_checkout_umum {
  border-bottom: 1px solid #ccc;
  border-left:none;
  border-right:none;
  border-top:none;
 }
input.billingdet_payment_total_checkout_umum {
   border-bottom: 1px solid #ccc;
   border-left:none;
   border-right:none;
   border-top:none;
  }
input.payment_total_checkout_umum {
    border-bottom: 1px solid #ccc;
    border-left:none;
    border-right:none;
    border-top:none;
   }
input.kembalian {
     border-bottom: 1px solid #ccc;
     border-left:none;
     border-right:none;
     border-top:none;
    }

.preloader {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background-color: #fff;
		}
		.preloader .loading {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%,-50%);
		font: 14px arial;
	}
</style>
<section class="content">

<!-- <div class="preloader">
			<div class="loading">
				<img src="<?=$theme_url?>assets/images/loading.gif" width="200">
				<p style="text-align:center">Harap Tunggu</p>
			</div>
</div> -->

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
</section>

<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/checkinout'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
