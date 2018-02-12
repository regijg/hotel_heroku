<link href="<?=$theme_url?>assets/main/css/formValidation.css" rel='stylesheet' type='text/css' />
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />

<section class="content-header">
  <h1>

  </h1>
  <ol class="breadcrumb">
		<li><a href="<?= base_url('/tamu_menginap') ?>"><i class="fa fa-circle"></i> TAMU MENGINAP</a></li>
    <li><a href="<?= base_url('/tamu_menginap/checkin') ?>"><i class="fa fa-circle-o"></i> Check-IN</a></li>
    <!-- <li><a href="<?= base_url('/registrasi/checkout') ?>"><i class="fa fa-circle-o"></i> Check-OUT</a></li> -->
  </ol>
</section><br>
<section class="content">
	<div class="box">
	      <div class="box-header" style="text-align:center">
	        <h3 class="box-title">Data Tamu Menginap</h3>
	      </div>
	      <!-- /.box-header -->
	      <div class="box-body">
	        <table id="example1" class="table table-striped table-bordered dt-responsive nowrap">
	          <thead>
	          <tr>
              <th style="font-size:12px; width:90px; text-align:center">Action</th>
							<th style="font-size:12px; width:90px; text-align:center">No Registrasi</th>
							<th style="font-size:12px; width:160px;">Nama</th>
							<th style="font-size:12px;">Alamat</th>
							<th style="font-size:12px; width:100px;">Telpon</th>
							<th style="font-size:12px; width:80px; text-align:center">No. Kamar</th>
							<th style="font-size:12px; text-align:center">Nama Diklat</th>
	          </tr>
	          </thead>
								<tbody>
						<?php foreach ($listDataTamuMenginap as $k) { ?>
								<tr>
                    <td style="font-size:12px; text-align:center">
                      <span>
                        <a class="btn btn-xs btn-success" href="javascript:;" title="Edit" onclick="openEditRegistrasi('<?= $k->reg_id ?>')">
                          <i class="fa fa-edit"></i> Edit</a>
                      </span>
                      <span>
                        <a class="btn btn-xs btn-primary" href="javascript:;" title="Mutasi" onclick="openMutasiRegistrasi('<?= $k->reg_id ?>')">
                          <i class="fa fa-exchange"></i> Mutasi</a>
                      </span>
                    </td>
										<td style="font-size:12px; text-align:center"><?= $k->reg_no ?></td>
										<td style="font-size:12px"><?= $k->nama ?></td>
										<td style="font-size:12px"><?= $k->alamat ?></td>
										<td style="font-size:12px"><?= $k->telpon ?></td>
										<td style="font-size:12px; text-align:center"><?= $k->room_number ?></td>
										<td style="font-size:12px"><?= $k->judul_diklat ?></td>
								</tr>
						<?php } ?>
						</tbody>
	        </table>
	      </div>
	      <!-- /.box-body -->
	</div>

  <!-- MODAL REGISTRASI UMUM EDIT START -->
  <div class="modal fade" id="modal_registrasi_umum_edit">
      <div class="modal-dialog modal-lg" style="width:850px">
        <div class="modal-content">
          <form class="form-horizontal form-label-left" action="javascript:;" id="form_registrasi_umum_edit" method="post">
          <div class="modal-body">
            <div class="modal-body form">
              <!-- <div class="row">
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
                          <input type="text" class="form-control" name="room_number_umum_lama" id="room_number_lama_umum_edit">
                        </td>
                        <td>
                          <input type="text" class="form-control" name="nama_umum_lama" id="nama_umum_edit">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div> -->
              <!-- <hr> -->

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group" style="height: 25px;">
                    <div class="col-md-5">
                      <div class="input-group">
                        <span class="input-group-addon" aria-hidden="true"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="nama_umum" id="nama_umum_edit" placeholder="Nama Lengkap" style="height:36px">
                      </div>
                    </div>
                  </div>
                  <div class="form-group" style="height: 65px;">
                    <div class="col-md-7">
                      <div class="input-group">
                        <span class="input-group-addon" aria-hidden="true" style="height:73px"><i class="glyphicon glyphicon-home"></i></span>
                        <!-- <input type="text" class="form-control" name="tamu_alamat" id="tamu_alamat" placeholder="Address" style="height:80px"> -->
                        <textarea class="form-control" name="alamat_umum" id="alamat_umum" placeholder="Alamat" style="height:73px; width: 364px"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div id="table-template-booking">
                    <table class="table table-hover table-responsive" id="tabel_layanan">
                      <thead>
                        <tr>
                          <th style="width:70px">Kamar</th>
                          <th style="width:125px">Tipe Kamar</th>
                          <th style="width:125px">Harga</th>
                          <th style="width:40px">Tamu</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody id="row_layanan">
                            <tr id="row">
                                <td>
                                  <!-- <select name="room_number_umum" id="room_number_umum_edit" class="form-control select2" onchange="ambilRoomNumberUmum(this.value, this.id)">
                                    <option value=""></option>
                                    <?php foreach ($roomList as $isi) if ($isi->room_status == 1) {
                                      $status = 'Check-IN';
                                      echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.'</option>');
                                    } {?>
                                    <?php }?>
                                  </select> -->
                                  <input type="text" class="form-control" name="room_number_umum" id="room_number_umum_edit" readonly>
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="rate_name_umum" id="rate_name_umum_edit" placeholder="Tipe Kamar" style="width:125px" readonly>
                                </td>
                                <td>
                                  <input type="hidden" class="form-control" name="price_umum" id="price_umum_edit" placeholder="Harga">
                                  <input type="text" class="form-control" id="price_fake_umum_edit" placeholder="Harga" style="width:125px" readonly>
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="person" id="person_umum_edit" style="width:40px">
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="keterangan" id="keterangan_umum_edit" placeholder="Keterangan">
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
                      <input type="hidden" class="form-control" name="reg_id" id="reg_id_umum_edit" style="width:95px" readonly>
                      <!-- <input type="hidden" name="flag_" id="flag_"> -->
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
      <!-- MODAL REGISTRASI UMUM EDIT END -->

      <!-- MODAL REGISTRASI DIKLAT EDIT START -->
      <div class="col-lg-12">
    	<div class="modal fade" id="modal_registrasi_diklat_edit">
    			<div class="modal-dialog modal-lg" style="width:900px">
    				<div class="modal-content">
              <form class="form-horizontal form-label-left" action="javascript:;" method="post" id="form_registrasi_diklat_edit">
    					<div class="modal-body">
    	          <div class="modal-body form">
                    <div class="row">
  										<div class="col-lg-5">
  											<!-- <div class="form-group" style="height: 23px;">
  												<div class="col-lg-3"> <label>No. Kamar</label> </div>
  												<div class="col-lg-3"> <input type="text" class="form-control" name="room_number" id="room_number_lama_diklat" style="font-weight:bold; width:50px" readonly> </div>
    												<div class="col-lg-3"> <label>Lantai</label> </div>
    												<div class="col-lg-3"> <input type="text" class="form-control" name="floor" id="floor_diklat" style="font-weight:bold; width:50px" readonly> </div>
  											</div> -->
                        <table class="table table-hover table-responsive" id="tabel_diklat">
                          <thead>
                            <tr>
                              <th style="width:100px">No. Kamar</th>
                              <th>Tipe Kamar</th>
                              <th style="width:50px">Lantai</th>
                            </tr>
                          </thead>
                          <tbody id="row_layanan">
                                <tr id="row">
                                    <td>
                                      <input type="text" class="form-control" name="room_number" id="room_number_lama_diklat_edit" style="font-weight:bold; width:60px" readonly>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="rate_name_diklat" id="rate_name_diklat_edit" style="font-weight:bold" readonly>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="floor" id="floor_diklat_edit" style="font-weight:bold; width:50px" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
  										</div>
  									</div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div id="table-template-diklat">
                          <table class="table table-hover table-responsive" id="tabel_diklat">
                            <thead>
                              <tr>
                                <th style="width:35%">Kode Diklat</th>
                                <th>Program Diklat</th>
                                <th style="width:125px">Sumber Dana</th>
                              </tr>
                            </thead>
                            <tbody id="row_layanan">
                                  <tr id="row">
                                      <td>
                                        <input type="hidden" class="form-control" name="diklat_id" id="diklat_id_diklat_edit" style="height:30px">
                                          <select class="form-control select2" name="kode_diklat" id="kode_diklat_diklat_edit" style="width:100%" onchange="ambilDataDiklat(this.value, this.id)">
                                            <option value=""></option>
                                            <?php foreach ($diklat_list as $isi) {?>
                                              <option value="<?=$isi->kode_diklat?>"><?=$isi->kode_diklat.' - '.$isi->full_name?></option>
                                            <?php }?>
                                          </select>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="judul_diklat" id="judul_diklat_diklat_edit" placeholder="Program Diklat">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="sumber_dana" id="sumber_dana_diklat_edit" style="width:125px" placeholder="Sumber Dana">
                                      </td>
                                    </tr>
                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
  									<!-- <hr> -->
  									<div class="row">
  										<div class="col-lg-6" id="row_cr_diklat">
  											<div style="background-color:#959aa0; width:120px">
  												<b>INFORMASI TAMU I</b>
  											</div>
  											<hr/>
  											<div class="form-group" style="height: 21px;">
  												<div class="col-lg-4"> <label>No. Registrasi</label> </div>
  												<div class="col-lg-7">
  													<!-- <div class="input-group"> -->
  														<!-- <input type="text" class="form-control" name="no_induk" id="no_induk_diklat" onchange="ambilDataPeserta1(this.value, this.id)" style="height:30px">
  															<span class="input-group-addon" aria-hidden="true"><a onclick="openKodePeserta(this.id)"><i class="glyphicon glyphicon-search"></i></a></span> -->
  												  <!-- </div> -->
                            <?php $attributes = 'id="no_identitas_diklat_edit" name="no_identitas_diklat" onchange="ambilDataPeserta1(this.value, this.id)" class="form-control select2" style="width: 100%;"';
                            echo form_dropdown('no_identitas_diklat', $peserta_list, set_value('no_registrasi'), $attributes); ?>
                            <input type="hidden" class="form-control" name="no_induk" id="no_induk_diklat">
  												</div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Nama Lengkap</label> </div>
  												<div class="col-lg-7"> <input type="text" class="form-control" name="nama" id="nama_diklat_edit"></div>
  											</div>
  											<div class="form-group" style="height: 45px;">
  												<div class="col-lg-4"> <label>Alamat</label> </div>
  												<div class="col-lg-7"> <textArea type="text" class="form-control" name="alamat" id="alamat_diklat_edit"> </textArea></div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Telpon/ HP</label> </div>
  												<div class="col-lg-7"> <input type="text" class="form-control" name="telpon" id="telpon_diklat_edit"> </div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Nama Perusahaan</label> </div>
  												<div class="col-lg-7">
  														<input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan_diklat_edit">
  															<!-- <span class="input-group-addon" aria-hidden="true"><a onclick="openKodePerusahaan(this.id)"><i class="glyphicon glyphicon-search"></i></a></span> -->
  												</div>
  											</div>
  										</div>


  										<div class="col-lg-6">
  											<div style="background-color:#959aa0; width:120px">
  												<b>INFORMASI TAMU II</b>
  											</div>
  											<hr/>
  											<div class="form-group" style="height: 21px;">
  												<div class="col-lg-4"> <label>No. Registrasi</label> </div>
  												<div class="col-lg-7">
  													<!-- <div class="input-group">
  														<input type="text" class="form-control"  name="no_induk2" id="no_induk2_diklat" onchange="ambilDataPeserta2(this.value, this.id)" style="height:30px">
  															<span class="input-group-addon" aria-hidden="true"><a onclick="openKodePeserta2(this.id)"><i class="glyphicon glyphicon-search"></i></a></span>
  												  </div> -->
                            <?php $attributes = 'id="no_identitas2_diklat_edit" name="no_identitas2_diklat" onchange="ambilDataPeserta2(this.value, this.id)" class="form-control select2" style="width: 100%;"';
                            echo form_dropdown('no_identitas2_diklat', $peserta_list, set_value('no_registrasi'), $attributes); ?>
                            <input type="hidden" class="form-control" name="no_induk2" id="no_induk2_diklat">
  												</div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Nama Lengkap</label> </div>
  												<div class="col-lg-7"> <input type="text" class="form-control" name="nama2" id="nama2_diklat_edit"> </div>
  											</div>
  											<div class="form-group" style="height: 45px;">
  												<div class="col-lg-4"> <label>Alamat</label> </div>
  												<div class="col-lg-7"> <textArea type="text" class="form-control" name="alamat2" id="alamat2_diklat_edit"> </textArea></div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Telpon/ HP</label> </div>
  												<div class="col-lg-7"> <input type="text" class="form-control" name="telpon2" id="telpon2_diklat_edit"> </div>
  											</div>
  											<div class="form-group" style="height: 25px;">
  												<div class="col-lg-4"> <label>Nama Perusahaan</label> </div>
  												<div class="col-lg-7">
  														<input type="text" class="form-control" name="nama_perusahaan2" id="nama_perusahaan2_diklat_edit">
  															<!-- <span class="input-group-addon" aria-hidden="true"><a onclick="openKodePerusahaan(this.id)"><i class="glyphicon glyphicon-search"></i></a></span> -->
  												</div>
  											</div>
  										</div>
  									</div>
                    <div class="form-group">
                    </div>
                </div>
    	          <div class="ln_solid"></div>

      	        <div class="modal-footer">
      	          <div style="text-align: center">
                      <input type="hidden" name="tipe_tamu_diklat" id="tipe_tamu_diklat_edit" />
                      <input type="hidden" name="reg_id" id="reg_id_diklat_edit" />
      	              <button type="submit" class="btn btn-sm btn-primary">Save</button>
      	              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
      	          </div>
      	        </div>
    	          </div>
      	        </form>
    					</div>
    				</div>
    			</div>
    		</div>
        <!-- MODAL REGISTRASI DIKLAT EDIT END-->


        <!-- MODAL REGISTRASI UMUM MUTASI START-->
        <div class="modal fade" id="modal_registrasi_umum_mutasi">
            <div class="modal-dialog modal-lg" style="width:850px">
              <div class="modal-content">
                <form class="form-horizontal form-label-left" action="javascript:;" id="form_registrasi_umum_mutasi" method="post">
                <div class="modal-body">
                  <div class="modal-body form">
                    <div class="row">
                      <div class="col-lg-12">
                        <table class="table table-hover table-responsive">
                          <thead>
                            <tr>
                              <th style="width:70px">Kamar</th>
                              <th style="width:250px">Nama</th>
                              <th>Alamat</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" class="form-control" name="room_number_umum_lama" id="room_number_umum_lama_mutasi" readonly>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="nama" id="nama_umum_mutasi" readonly>
                              </td>
                              <td>
                                <input type="text" class="form-control" name="alamat" id="alamat_umum_mutasi" readonly>
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
                                <th style="width:70px">Kamar</th>
                                <th style="width:125px">Tipe Kamar</th>
                                <th style="width:125px">Harga</th>
                                <th style="width:40px">Lantai</th>
                                <th style="width:40px">Tamu</th>
                                <th>Keterangan</th>
                              </tr>
                            </thead>
                            <tbody id="row_layanan">
                                  <tr id="row">
                                      <td>
                                        <select name="room_number" id="room_number_umum" class="form-control select2" onchange="ambilRoomNumberUmum(this.value, this.id)">
                                          <option value=""></option>
                                          <?php foreach ($roomList as $isi) if ($isi->room_status == 1) {
                                            $status = 'Check-IN';
                                            echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.'</option>');
                                          } {?>
                                          <?php }?>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="room_number_umum" id="room_number_umum_edit" readonly> -->
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="rate_name" id="rate_name_umum" placeholder="Tipe Kamar" style="width:125px">
                                      </td>
                                      <td>
                                        <input type="hidden" class="form-control" name="price" id="price_umum" placeholder="Harga">
                                        <input type="text" class="form-control" id="price_fake_umum" placeholder="Harga" style="width:125px">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="floor" id="floor_umum" style="width:40px">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="person" id="person_umum" style="width:40px">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan_umum" placeholder="Keterangan">
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
                            <input type="hidden" class="form-control" name="reg_id" id="reg_id_umum_mutasi" style="width:95px" readonly>
                            <!-- <input type="hidden" name="flag_" id="flag_"> -->
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
        <!-- MODAL REGISTRASI UMUM MUTASI END-->


        <!-- MODAL REGISTRASI DIKLAT MUTASI START-->
        <div class="modal fade" id="modal_registrasi_diklat_mutasi">
            <div class="modal-dialog modal-lg" style="width:850px">
              <div class="modal-content">
                <form class="form-horizontal form-label-left" action="javascript:;" id="form_registrasi_diklat_mutasi" method="post">
                <div class="modal-body">
                  <div class="modal-body form">
                    <div class="row">
                      <div class="col-lg-8">
                        <table class="table table-hover table-responsive">
                          <thead>
                            <tr>
                              <th style="width:250px">Nama 1</th>
                              <th style="width:250px">Nama 2</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" class="form-control" id="nama_diklat_mutasi" readonly>
                              </td>
                              <td>
                                <input type="text" class="form-control" id="nama2_diklat_mutasi" readonly>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-hover table-responsive">
                          <thead>
                            <tr>
                              <th style="width:70px">Kamar</th>
                              <th style="width:250px">Tipe Kamar</th>
                              <th style="width:70px">Lantai</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <input type="text" class="form-control" name="room_number_diklat_mutasi" id="room_number_diklat_mutasi" readonly>
                              </td>
                              <td>
                                <input type="text" class="form-control" id="rate_name_diklat_mutasi" readonly>
                              </td>
                              <td>
                                <input type="text" class="form-control" id="floor_diklat_mutasi" readonly>
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
                                <th style="width:70px">Kamar</th>
                                <th style="width:125px">Tipe Kamar</th>
                                <th style="width:40px">Lantai</th>
                                <th style="width:40px">Harga</th>
                                <th>Keterangan</th>
                              </tr>
                            </thead>
                            <tbody id="row_layanan">
                                  <tr id="row">
                                      <td>
                                        <select name="room_number" id="room_number_diklat" class="form-control select2" onchange="ambilRoomNumberDiklat(this.value, this.id)">
                                          <option value=""></option>
                                          <?php foreach ($roomList as $isi) if ($isi->room_status == 1) {
                                            $status = 'Check-IN';
                                            echo ('<option value="'.$isi->room_number.'">'.$isi->room_number.'</option>');
                                          } {?>
                                          <?php }?>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="room_number_umum" id="room_number_umum_edit" readonly> -->
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="rate_name" id="rate_name_diklat" placeholder="Tipe Kamar" style="width:125px">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="floor" id="floor_diklat" style="width:125px">
                                      </td>
                                      <td>
                                        <input type="hidden" class="form-control" name="price" id="price_diklat" placeholder="Harga">
                                        <input type="text" class="form-control" id="price_fake_diklat" placeholder="Harga" style="width:125px">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="keterangan" id="keterangan_diklat" placeholder="Keterangan">
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
                            <input type="hidden" class="form-control" name="reg_id" id="reg_id_diklat_mutasi" style="width:95px" readonly>
                            <!-- <input type="hidden" name="flag_" id="flag_"> -->
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
        <!-- MODAL REGISTRASI DIKLAT MUTASI END-->
</section>
<script>
require.config({
    baseUrl: baseURL+'tpl/sb-admin/',
    urlArgs: "bust=" + (new Date()).getTime(),
    paths: {
        "core"               		:   'js/main',
        "jspage"					: 	'js/page/tamu'
    }
});
require(["core"], function(core) {
    require([
             'jspage',
             'tpl.all'
     ], function(){});
});
</script>
<!-- <script src="<?=$theme_url?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=$theme_url?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
