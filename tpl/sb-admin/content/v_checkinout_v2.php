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

input.registrasi {
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

      <?=@$widget->list_room?>

			<!-- MODAL UMUM -->
			<div class="col-lg-10 col-md-10 col-sm-10">
	  	<div class="modal fade" id="modal_umum">
	  			<div class="modal-dialog modal-md" style="width:600px">
	  				<div class="modal-content">
	            <form class="form-horizontal form-label-left" action="javascript:;" id="form_umum" method="post">
	  	            <div class="modal-header" style="text-align:center">
	  	    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  	    					<h4 class="modal-title"><b>Registrasi Form</b></h4>
	  	    				</div>
	  					<div class="modal-body">
								<div class="modal-body form">
	                  <div class="row">
											<!-- Informasi Tamu Start -->
											<div class="col-lg-12 col-md-6 col-sm-3" style="height:50px">
			                  <div class="form-group">
			                    <div class="col-lg-6 col-md-4 col-sm-2">
                            <div class="controlsDeactive">
                              <input type="text" class="form-control floatLabel" name="nama" id="nama_umum">
                              <label for="nama_umum"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Nama</label>
                              <input type="hidden" name="reg_no" id="reg_no_umum" value="<?= $kodeunikregistrasiumum ?>">
                            </div>
			                    </div>
                          <div class="col-lg-6 col-md-4 col-sm-2">
                            <div class="controlsDeactive">
                              <input type="text" class="form-control floatLabel" name="no_identitas" id="no_identitas_umum">
                              <label for="no_identitas_umum"><i class="glyphicon glyphicon-pushpin"></i>&nbsp;&nbsp;No. Identitas (KTP)</label>
                            </div>
			                    </div>
			                  </div>
                      </div>
                      <div class="col-lg-12 col-md-5 col-sm-5" style="height:50px">
			                  <div class="form-group">
			                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="controlsDeactive">
                              <input type="text" class="form-control floatLabel" name="alamat" id="alamat_umum">
                              <label for="alamat_umum"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;Alamat</label>
                            </div>
			                    </div>
			                  </div>
                      </div>
                      <div class="col-lg-6 col-md-4 col-sm-2" style="height:30px">
												<div class="form-group">
			                    <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="controlsDeactive">
                              <input type="text" class="form-control floatLabel" name="telpon" id="telpon_umum">
                              <label for="telpon_umum"><i class="glyphicon glyphicon-earphone"></i>&nbsp;&nbsp;Telpon</label>
                            </div>
			                    </div>
			                  </div>
                      </div>
			                  <!-- <div class="form-group" style="height: 25px;">
			                    <div class="col-lg-12 col-md-12 col-sm-12">
			                      <div class="input-group">
			                        <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-briefcase"></i></span>
			                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan_umum" placeholder="Nama Perusahaan" style="height:36px">
			                      </div>
			                    </div>
			                    <div class="col-md-6" style="height: 25px;">
			                      <select name="tamu_kelamin" id="tamu_kelamin" class="form-control" style="width: 100%;">
			                        <option value="">Gender</option>
			                        <option value="L">Laki-laki</option>
			                        <option value="P">Perempuan</option>
			                      </select>
			                    </div>
			                  </div> -->
												<!-- <div class="form-group" style="height: 65px;">
			                    <div class="col-lg-12 col-md-12 col-sm-12">
			                      <div class="input-group">
			                        <span class="input-group-addon" aria-hidden="true" style="height:73px"><i class="glyphicon glyphicon-home"></i></span>
															<textarea class="form-control" name="alamat_kantor" id="alamat_kantor_umum" placeholder="Alamat Kantor" style="height:73px"></textarea>
														</div>
			                    </div>
			                  </div> -->
			                  <!-- <div class="form-group" style="height: 25px;">
			                    <div class="col-lg-12 col-md-12 col-sm-12">
			                      <div class="input-group">
			                        <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-pushpin"></i></span>
			                        <input type="text" class="form-control" name="no_induk" id="no_induk_umum" placeholder="NIP / NIK" style="height:33px">
			                      </div>
			                    </div>
			                    <div class="col-md-6" style="height: 25px;">
			                      <div class="input-group">
			                        <input type="text" class="form-control" name="tamu_email" id="tamu_email" placeholder="Email" style="height:33px">
			                        <span class="input-group-addon" aria-hidden="true"><i class="fa fa-envelope"></i></span>
			                      </div>
			                    </div>
			                  </div> -->
											</div>
                      <hr/>
                      <div class="row">
                        <div class="col-lg-12 col-md-7 col-sm-7" style="height:30px">
  												<div class="form-group">
  														<div class="col-lg-6 col-md-5 col-sm-5">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control floatLabel" name="in_date" id="in_date_umum" data-date-format='d M yyyy' value="<?php echo date("d-m-Y")?>">
                                  <label for="in_date_umum" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Tanggal Check-IN</label>
                                  <input type="hidden" class="form-control" name="in_time" id="in_time_umum" value="<?php echo date("H:i")?>" placeholder="In" style="height:33px">
                                </div>
  														</div>
      												<div class="col-lg-6 col-md-5 col-sm-5">
      													<div class="controlsDeactive">
      														<input type="text" class="form-control floatLabel" name="out_date" id="out_date_umum" data-date-format='d M yyyy'>
      														<label for="out_date_umum" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Tanggal Check-OUT</label>
      													</div>
      												</div>
  			                  </div>
                        </div>
  										</div>
                      <hr/>
                      <div class="row">
                        <div class="col-lg-12">
                          <table class="table table-hover table-responsive">
                            <thead>
                              <tr>
                                <td style="color:#a56e6e;font-weight:bold">No. Kamar</td>
                                <td style="color:#a56e6e;font-weight:bold">Tipe Kamar</td>
                                <td style="color:#a56e6e;font-weight:bold">Lantai</td>
                                <td style="color:#a56e6e;font-weight:bold">Tamu</td>
                                <td style="color:#a56e6e;font-weight:bold">Harga</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="room_number" id="room_number_umum" style="width:80px; background-color:#fff" readonly>
                                  </div>
                                </td>
                                <td>
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="rate_name" id="rate_name_umum" style="width:165px; font-size:13px; background-color:#fff" readonly>
                                    <input type="hidden" class="form-control" name="rate_id" id="rate_id_umum" onchange="ambilHargaRoom(this.value, this.id)">
                                  </div>
                                </td>
                                <td>
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="floor" id="floor_umum" style="width:50px; background-color:#fff" readonly>
                                  </div>
                                </td>
                                <td>
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="person" id="person_umum" style="width:50px">
                                  </div>
                                </td>
                                <td>
                                  <div class="controlsDeactive">
                                    <input type="hidden" class="form-control floatLabel" name="price" id="tarif_umum">
                                    <input type="text" class="form-control" id="tarif_umum_fake" style="width:120px; font-size:13px; background-color:#fff" readonly>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
    												<div class="form-group" style="height: 25px;">
                              <div class="col-lg-4 col-md-4 col-sm-4">
                              </div>
                              <div class="col-lg-4">
                                <div class="controlsDeactive">
                                  <i class="fa fa-sort"></i>
                                  <select class="form-control floatLabel" id="deposit_type" name="deposit_type" style="width:100%">
                                    <option value=""></option>
                                    <option value="1">Tunai</option>
                                    <option value="2">Debit</option>
                                    <option value="3">Kredit</option>
                                  </select>
                                  <label for="deposit_type">Pembayaran Deposit</label>
                                </div>
                              </div>
    													<div class="col-lg-4 col-md-4 col-sm-4" style="left:20px; width:159px;">
    														<div class="controlsDeactive">
                                  <input type="text" class="form-control floatLabel" name="deposit" id="deposit_umum">
                                  <label class="deposit_umum">Deposit</label>
                                </div>
    													</div>
    			                  </div>
                        </div>
                      </div>
                      </div>

                      <div style="text-align: center">
      	    	            <button type="submit" class="btn btn-sm btn-primary">Save</button>
      	    	            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
      	    	        </div>
										</div>
	              </div>
	  	          </div>
	    	        </form>
	  					</div>
	  				</div>
	  			</div>
	  		</div>

						<!-- MODAL CHECKOUT WISMA -->
						<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="modal fade" id="modal_checkout_umum" data-backdrop="static" data-keyboard="false">
								<div class="modal-dialog modal-lg modal-md modal-sm" style="width:70%">
									<div class="modal-content">
										<!-- <div class="modal-header"><center><h4>CHECKOUT TAMU</h4></center></div> -->
										<!-- <input type="text" class="form-control" name="reg_id" id="reg_id"> -->
										<form class="form-horizontal form-label-left" action="javascript:;" id="form_checkout_umum" method="post">
										<div class="modal-body">
											<div class="modal-body form">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <div class="col-lg-2 col-md-3 col-sm-3">
                                <div class="controlsDeactive">
                                  <input class="form-control floatLabel" type="text" name="billing_no_checkout_umum" id="billing_no_checkout_umum" value="<?=$kodeunik?>" readonly placeholder="No Billing">
                                  <label for="billing_no_checkout_umum">No. Billing</label>
                                  <input class="form-control" type="hidden" name="reg_id" id="reg_id_checkout_umum" placeholder="No Billing" readonly  style="width:100px">
                                  <input class="form-control" type="hidden" name="reg_no" id="reg_no" placeholder="No Billing" readonly  style="width:100px">
                                  <input type="hidden" class="form-control" name="billing_date" id="billing_date_checkout_umum" value="<?php echo date("d M Y")?>" data-date-format='d M yyyy' style="height:30px">
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-3 col-sm-3">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control" name="room_number" id="room_number_checkout_umum" readonly>
                                  <label for="room_number">No. Room</label>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="controlsDeactive">
                                  <input type="hidden" class="form-control" name="rate_id_checkout_umum" id="rate_id_checkout_umum">
                                  <input type="text" class="form-control floatLabel" name="rate_name_checkout_umum" id="rate_name_checkout_umum" readonly>
                                  <label for="rate_name_checkout_umum">Tipe Kamar</label>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="controlsDeactive">
                                  <input type="hidden" class="form-control tarif_checkout_umum" name="price_checkout_umum" id="tarif_checkout_umum" readonly style="background-color:white">
                                  <input type="text" class="form-control floatLabel" id="tarif_checkout_umum_fake" readonly style="background-color:white" readonly>
                                  <label for="tarif_checkout_umum_fake">Harga</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-lg-2 col-md-4 col-sm-2">
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="no_identitas_checkout_umum" id="no_identitas_checkout_umum">
                                    <label for="no_identitas_umum"><i class="glyphicon glyphicon-pushpin"></i>&nbsp;&nbsp;No. Identitas</label>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-2">
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="nama_checkout_umum" id="nama_checkout_umum">
                                    <label for="nama_checkout_umum"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Nama</label>
                                  </div>
      			                    </div>
                                <div class="col-lg-5 col-md-4 col-sm-2">
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="alamat_checkout_umum" id="alamat_checkout_umum" placeholder="Alamat">
                                    <label for="alamat_checkout_umum"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;Alamat</label>
                                  </div>
      			                    </div>
                                <div class="col-lg-2 col-md-4 col-sm-2">
                                  <div class="controlsDeactive">
                                    <input type="text" class="form-control floatLabel" name="telpon_checkout_umum" id="telpon_checkout_umum">
                                    <label for="telpon_checkout_umum"><i class="glyphicon glyphicon-earphone"></i>&nbsp;&nbsp;Telpon</label>
                                  </div>
      			                    </div>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">


                            </div>
                          </div>
                        </div> -->

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <div class="col-lg-2 col-md-5 col-sm-5">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control floatLabel" id="in_date_checkout_umum_fake" readonly>
                                  <input type="hidden" class="form-control" name="in_date" onchange="hitung_durasi_tgl();" id="in_date_checkout_umum">
                                  <label for="in_date_checkout_umum_fake" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Tgl Check-IN</label>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-5 col-sm-5">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control floatLabel" id="out_date_checkout_umum_fake" onchange="tanggalKeluarFake()">
                                  <input type="hidden" class="form-control" name="out_date" id="out_date_checkout_umum" placeholder="Out" onchange="hitung_durasi_tgl();" data-date-format='yyyy-mm-dd'>
                                  <label for="out_date_checkout_umum" class="label-date"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Tgl Check-OUT</label>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control" name="out_time" id="out_time_checkout_umum" placeholder="Out" value="<?php echo date("H:i:s")?>" readonly>
                                  <label for="out_time_checkout_umum" class="label-date"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Out Time</span>
                                </div>
                              </div>
                              <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="controlsDeactive">
                                  <input type="text" class="form-control floatLabel" name="hari_checkout_umum" id="hari_checkout_umum" onkeyup="hitungTotalPembayaranKamar();">
                                  <label for="hari_checkout_umum">Hari</span>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-2 col-sm-2">
                                <div class="controlsDeactive">
                                  <input type="hidden" class="form-control" name="billing_total_checkout_umum" id="billing_total_checkout_umum" onkeyup="hitung();">
                                  <input type="text" class="form-control floatLabel" id="billing_total_checkout_umum_fake" readonly>
                                  <label for="billing_total_checkout_umum_fake">Total Tarif Kamar</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

												<div class="row">
														<div class="col-lg-7 col-md-8 col-sm-8">
															<div id="table-template-layanan-pembayaran">
																<table class="table table-striped" id="tabel_layanan">
																	<thead>
																			<tr>
																				<th style="color:#a56e6e">Layanan Kamar</th>
																				<th style="text-align:right;color:#a56e6e">Harga</th>
																				<th style="text-align:center;color:#a56e6e">Qty</th>
																				<th style="text-align:right;color:#a56e6e">Jumlah</th>
																				<th><button title="tambah row" class="btn btn-sm btn-success" type="button" onclick="tambahRowLayanan()" style="margin-top: 3px">+</button></th>
																			</tr>
																	</thead>
																	<tbody id="row_layanan">
																				<?php for ($i=0;$i<1;$i++) { ?>
																				<tr id="row_<?= $i?>">
																						<td>
																							<input class="form-control" type="hidden" name="id_order_[]" id="id_order_<?=$i?>">
                                              <input class="form-control" type="text" name="order_menu_[]" id="order_menu_layanan_<?=$i?>">
																							<!-- <select class="form-control select2" name="order_menu_[]" id="order_menu_layanan_<?=$i?>" style="width:90%" onchange="ambilLayananHitung(this.value, this.id)">
																								<option value=""></option>
																								<?php foreach ($menus as $isi) {?>
																									<option value="<?=$isi->order_menu?>"><?=$isi->order_menu?></option>
																								<?php }?>
																							</select> -->
																						</td>
																						<td style="width:20%"><input class="form-control pmenu" type="text" style="text-align: right" name="price_menu_[]" id="price_menu_<?=$i?>" onclick="priceInput()"  placeholder="Harga"></td>
																						<td style="width:10%"><input class="form-control" type="text" style="text-align: right" name="qty_[]" id="qty_pesanan_<?=$i?>" value="0" onchange="hitungQty(this.id)"></td>
																						<td style="width:20%"><input class="form-control" type="text" style="text-align: right" name="amount_[]" id="jumlah_pesanan_<?=$i?>"  placeholder="Jumlah"></td>
                                            <td><button title="hapus layanan"  type="button" id="butrow_<?= $i?>" onclick="removeRow(this.id)" style="margin-top: 4px"class="btn btn-sm btn-danger">x</button></td>
                                          </tr>
                                          <tr>
                      											<td id ="div_hapus">
                      											<input type="text" id="data_hapus">
                      											</td>
                    											</tr>
																					<?php } ?>
																		</tbody>
																</table>
															</div>
														</div>

														<!-- <div class="col-lg-1"></div> -->

														<div class="col-lg-5 col-md-4 col-sm-4">
															<div class="form-group">
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<!-- <div class="input-group">
																		<span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-phone"></i></span>
																		<input type="text" class="form-control" name="telpon_checkout_umum" id="telpon_checkout_umum" placeholder="Telpon" style="height:36px">
																	</div> -->
																</div>
															</div>
															<div class="box box-primary">
																	<!-- <div class="box-header" style="background-color: gainsboro;"><center><b>PEMBAYARAN</b></center></div> -->
																	<div class="box-body" style="background-color: transparent;">
																		<div id="div_total">
																				<table class="table table-striped" id="tabel_satuan">
																					<div class="form-group">
																						<div class="col-lg-6 col-md-5 col-sm-5">

																						</div>
																						<div class="col-lg-6 col-md-7 col-sm-7">
																							<div class="controlsDeactive">
                                                <input class="form-control billingdet_payment_total_checkout_umum" type="hidden" name="billingdet_payment_total_checkout_umum" id="billingdet_payment_total_checkout_umum" style="margin-top: 6px;text-align:right; font-size:16px">
                                                <input class="form-control floatLabel" type="text" id="billingdet_payment_total_checkout_umum_fake" style="margin-top: 6px;text-align:right; font-size:18px;background-color:#fff" readonly>
                                                <label for="billingdet_payment_total_checkout_umum_fake"><i class="fa fa-money"></i>&nbsp;&nbsp;Total Tagihan</label>
                                              </div>
																						</div>
																					</div>

																					<div class="form-group">
																						<div class="col-lg-6 col-md-5 col-sm-5" style="top:7px">
                                              <div class="controlsDeactive">
                                                <i class="fa fa-sort"></i>
                                                <select class="form-control floatLabel" id="deposit_type" name="deposit_type" style="width:100%">
                                                  <option value=""></option>
                                                  <option value="1">Tunai</option>
                                                  <option value="2">Debit</option>
                                                  <option value="3">Kredit</option>
                                                  <option value="4">Autodebit</option>
                                                </select>
                                                <label for="deposit_type">Cara Pembayaran</label>
                                              </div>
																						</div>
																						<div class="col-lg-6 col-md-7 col-sm-7">
                                              <div class="controlsDeactive">
  																							<input class="form-control payment_total_checkout_umum" type="hidden" name="payment_total_checkout_umum" onkeyup="hitungKembalian();"  id="payment_total_checkout_umum" style="margin-top: 6px;text-align:right; font-size:16px">
                                                <input class="form-control floatLabel" type="text" id="payment_total_checkout_umum_fake" onkeyup="hitungKembalianFake();" style="margin-top: 6px;text-align:right; font-size:18px;">
                                                <label for="payment_total_checkout_umum_fake"><i class="fa fa-money"></i>&nbsp;&nbsp;Uang Diterima</label>
                                              </div>
                                            </div>
																					</div>

                                          <div class="form-group">
																						<div class="col-lg-6 col-md-5 col-sm-5">
																							<!-- <label for="no_order" class="control-label">Kembalian</label> -->
																						</div>
																						<div class="col-lg-6 col-md-7 col-sm-7">
                                              <div class="controlsDeactive">
  																							<input class="form-control kembalian" type="hidden" name="kembalian" id="kembalian" style="margin-top: 6px;text-align:right; font-size:16px" readonly>
                                                <input class="form-control kembalian" type="text" id="kembalian_fake" style="margin-top: 6px;text-align:right; font-size:18px;background-color:#fff" readonly>
                                                <label for="kembalian_fake"><i class="fa fa-money"></i>&nbsp;&nbsp;Kembalian</label>
                                              </div>
                                            </div>
																					</div>
																				</table>
																			</div>
																			<input type="hidden" id="id_pembayaran_switch" name="id_pembayaran_switch">
																			<div class="form-group" id="div_simpan_pembayaran">
																					<p align="center" style="width: 150%;">
                                            <input type="hidden" class="form-control" id="tamu_tipe_checkout" name="tamu_tipe">
																					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
																					<button type="submit" class="btn btn-sm btn-success" name="btn_simpan_pembayaran" id="btn_simpan_pembayaran"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Check Out</button>
                                          <b id="btn-print"> </b>
																					</p>
																			</div>
																	</div>
															</div>
														</div>
													</div>
													<div class="form-group">
													</div>
											</div>
											</div>
											</form>
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
