<section class="content">
<div class="row">

	<div class="col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border" style="text-align:center">
					<h3 class="box-title">BIODATA PESERTA DIKLAT</h3>
				</div>
				<br/>
				<div class="form-group">
					<div class="col-sm-2">
						<input onkeyup="searchData(this.value);" type="text" name="search" class="form-control" placeholder="Nama Peserta">
					</div>
					<div class="col-sm-3">

					</div>
					<div class="col-sm-3">
						<button onclick="add_peserta()" type="button" class="btn btn-sm btn-primary">
										Add New
								</button>
					</div>
					<div class="col-sm-2">

					</div>
					<div class="col-sm-3">
							<button onclick="add_peserta()" type="button" class="btn btn-sm btn-primary">Print</button>
							<button onclick="add_peserta()" type="button" class="btn btn-sm btn-primary">XLS</button>
							<button onclick="add_peserta()" type="button" class="btn btn-sm btn-primary">PDF</button>
					</div>
				</div>
				<br/>
				<div class="box-body" style="width:99%">
					<table id="jqGrid"></table>
					<div id="jqGridPagerData"></div>
					<!-- <?php foreach ($pesertas as $isi) {?>

					<?php }?> -->
				</div>
			</div>
		</div>

<div class="modal fade" id="modal_form">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
          <form class="form-horizontal" action="peserta/process" id="form_peserta" method="post">
            <div class="modal-header" style="text-align:center">
    					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    					<h4 class="modal-title"><b>BIODATA PESERTA DIKLAT</b></h4>
    				</div>

				<div class="modal-body">
          <div class="modal-body form">
                          <ul class="nav nav-tabs">
                              <li class="active">
                                  <a  href="#Identitas" data-toggle="tab">Identitas Peserta</a>
                              </li>
                              <li>
                                  <a href="#Informasi" data-toggle="tab">Informasi Pekerjaan</a>
                              </li>
                              <li>
                                  <a href="#Riwayat" data-toggle="tab">Riwayat</a>
                              </li>
                              <li>
                                  <a href="#Foto" data-toggle="tab">Foto</a>
                              </li>
                          </ul>

                          <div class="tab-content ">
														<br/>
                              <!-- Identitas Peserta Start-->
                              <div class="tab-pane active" id="Identitas">
                                  <input type="text" name="pesertaID" hidden="hidden">
                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>Nama Peserta <span class="required">*</span></label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" onchange="menyatukan();" name="nama_peserta" id="nama_peserta_input" class="form-control input-sm"
                                          data-validate="required" data-message-required="This is custom message for required field.">
                                      </div>

                                      <div class="col-sm-1">
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Gelar Depan</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <input type="text" onchange="menyatukan();" name="title1" id="title1_gelar_depan" required="required" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-6">
                                          <input type="text" name="full_name" id="full_name_peserta" hidden="hidden">
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Gelar Belakang</label>
                                      </div>
                                      <div class="col-md-2">
                                          <input type="text" onchange="menyatukan();" name="title2" id="title2_gelar_belakang" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>NIP / NIK</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <input type="text" style="width:125%" name="nip_register" id="nip_registrasi_input" class="form-control input-sm">
                                      </div>

                                      <div class="col-sm-6">
                                          <div hidden></div>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>Tempat Lahir</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" name="tempat_lahir" id="tempat_lahir_input" class="form-control input-sm">
                                      </div>

                                      <div class="col-sm-1">
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Tanggal Lahir</label>
                                      </div>
																			<div class="col-sm-3" style="width:180px">
			                                  <div class="input-group date">
			                                  <input type="text" name="tanggal_lahir" class="form-control input-sm" id="datepicker">
			                                  <div class="input-group-addon">
			                                    <i class="fa fa-calendar"></i>
			                                  </div>
			                                  </div>
			                                </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>Gender</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <select class="form-control input-sm" name="kelamin" id="kelamin">
                                              <option value="">--</option>
                                              <option value="1">Laki-laki</option>
                                              <option value="2">Perempuan</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-6">
                                          <div hidden></div>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>Agama</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <select class="form-control input-sm" name="agama" id="agama">
                                              <option value="0">--</option>
                                              <option value="1">Islam</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-2">
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Warga Negara</label>
                                      </div>
                                      <div class="col-sm-2" style="width:180px">
                                          <select class="form-control input-sm select2" name="id_negara" id="warga_negara_input" style="width: 100%; height: 20px;">
                                              <option value="">--</option>
																							<?php foreach ($negaras as $isi) {?>
																								<option value="<?=$isi->kode?>"><?=$isi->nama_negara?></option>
																							<?php }?>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-sm-2">
                                          <label>Alamat Rumah</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <textArea class="form-control input-sm" name="alamat_rumah" id="alamat_rumah_input" style="height: 88px;"></textArea>
                                      </div>

                                      <div class="col-sm-6">
                                          <div hidden></div>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                          <div class="col-sm-2">
                                              <label>Provinsi</label>
                                          </div>
                                          <div class="col-sm-4">
																						<select class="form-control input-sm select2" name="kode_provinsi" onchange="ambilDataProvinsi(this.value, this.id)" id="kode_provinsi" style="width: 90%;">
						                                  <option value="">--</option>
						                                    <?php foreach ($provinsis as $isi) {?>
						                                      <option value="<?=$isi->kode?>"><?=$isi->nama_provinsi?></option>
						                                    <?php }?>
						                                </select>
																						<input type="text" name="nama_provinsi" id="nama_provinsi" hidden="hidden">
                                          </div>

                                          <div class="col-sm-2">
                                              <label>Kota/ Kabupaten</label>
                                          </div>
                                          <div class="col-sm-4">
																						<select class="form-control input-sm select2" name="kode_kabupaten" onchange="ambilDataKabupaten(this.value, this.id)" id="kode_kabupaten" style="width: 90%;">
						                                  <option value="">--</option>
						                                </select>
																						<input type="text" name="nama_kabupaten" id="nama_kabupaten" hidden="hidden">
                                          </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label> No. Telp / HP</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" name="telpon" id="telpon_input" class="form-control input-sm">
                                      </div>

                                      <div class="col-sm-1">
                                          <div hidden></div>
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Email</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="email" name="email" id="email_input" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-2">
                                          <label>Jenis Identitas</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <select class="form-control input-sm" name="jenis_identitas" id="jenis_identitas_input">
                                              <option value="">--</option>
                                          </select>
                                      </div>

                                      <div class="col-sm-2">
                                          <div hidden></div>
                                      </div>

                                      <div class="col-sm-2">
                                          <label>Nomor Identitas</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" name="nomor_identitas" id="nomor_identitas_input"  class="form-control input-sm">
                                      </div>
                                  </div>
                              </div>
                              <!-- Identitas Peserta END-->


                              <!-- Informasi Pekerjaan Start-->
                              <div class="tab-pane" id="Informasi">
                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Asal Peserta</label>
                                      </div>
                                      <div class="col-sm-2">
                                          <select class="form-control input-sm" name="asal_peserta" id="asal_peserta_input">
                                              <option value="0">--</option>
																							<option value="1">ESDM</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Pilih Intansi / Perusahaan</label>
                                      </div>
                                      <div class="col-sm-4">
                                          <input type="text" name="nama_perusahaan" onchange="ambilDataPerusahaan(this.value, this.id)" class="form-control input-sm">
																					<input type="text" name="perusahaanID" hidden="hidden">
                                      </div>
                                          <button type="button" class="btn btn-sm btn-primary" onclick="openKode(this.id)">New</button>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Nama Intansi / Perusahaan</label>
                                      </div>
                                      <div class="col-sm-4">
                                          <input type="text" name="nama_perusahaan" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-sm-3">
                                          <label>Alamat Kantor</label>
                                      </div>

                                      <div class="col-sm-4">
                                          <textArea class="form-control input-sm" name="alamat_kantor" id="alamat_kantor_id"
                                          style="height:88px"></textArea>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Provinsi</label>
                                      </div>
                                      <div class="col-sm-4">
                                          <?php $attributes = 'id="provinsiInfoPekerjaan" class="form-control input-sm"';
                                          echo form_dropdown('kode_provinsi', $provinsi, set_value('kode_provinsi'), $attributes); ?>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Kab / Kota</label>
                                      </div>
                                      <div class="col-sm-3">
                                        <?php $attributes = 'id="kabInfoPekerjaan" class="form-control input-sm"';
                                        echo form_dropdown('kode_kabupaten', $kab, set_value('kode_kabupaten'), $attributes); ?>
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Telp / Fax Kantor</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" id="telp_kantor" name="telp_kantor" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Jabatan</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <input type="text" id="jabatan" name="jabatan" class="form-control input-sm">
                                      </div>
                                  </div>

                                  <div class="form-group" style="height:23px">
                                      <div class="col-sm-3">
                                          <label>Golongan / Pangkat</label>
                                      </div>
                                      <div class="col-sm-3">
                                          <select class="form-control input-sm" style="width:180px">
                                              <option value="">--</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <!-- Informasi Pekerjaan END-->


                              <!-- Informasi Riwayat Start-->
                              <div class="tab-pane" id="Riwayat">
                                  <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="email">Riwayat Pendidikan</label>
                                          <textArea type="text" class="form-control" name="riwayat_pendidikan" id="riwayat_pendidikan_input"></textArea>
                                      </div>

                                      <div class="col-sm-1">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="email">Pendidikan Luar Negri</label>
                                          <textArea type="text" class="form-control" name="pendidikan_ln" id="pendidikan_ln_input"></textArea>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="email">Pendidikan Khusus</label>
                                          <textArea type="text" class="form-control" name="pendidikan_khusus" id="pendidikan_khusus_input"></textArea>
                                      </div>

                                      <div class="col-sm-1">
                                      </div>

                                      <div class="col-sm-4">
                                          <label for="email">Riwayat Jabatan</label>
                                          <textArea type="text" class="form-control" name="riwayat_jabatan" id="email"></textArea>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-sm-4">
                                          <label for="email">Diklat Yang Pernah Diikuti</label>
                                          <textArea type="text" class="form-control" name="riwayat_diklat" id="riwayat_diklat"></textArea>
                                      </div>
                                  </div>
                              </div>
                              <!-- Informasi Riwayat END-->


                              <div class="tab-pane" id="Foto">
                                  <h3>Jang Foto</h3>
																	<div class="form-group">
										                <label>Minimal</label>
										                <select class="form-control select2">
										                  <option selected="selected">Alabama</option>
										                  <option>Alaska</option>
										                  <option>California</option>
										                  <option>Delaware</option>
										                  <option>Tennessee</option>
										                  <option>Texas</option>
										                  <option>Washington</option>
										                </select>
										              </div>

																	<div class="form-group">
										                <label>Date:</label>

										                <div class="input-group date">
										                  <div class="input-group-addon">
										                    <i class="fa fa-calendar"></i>
										                  </div>
										                  <input type="text" class="form-control pull-right" id="datepicker">
										                </div>
										                <!-- /.input group -->
										              </div>
                              </div>
                          </div>

                      <div class="ln_solid"></div>
          </div><!-- /.modal-content -->
				</div>
        </form>
        <div class="modal-footer">
          <div style="text-align: center">
              <button type="button" onclick="save()" class="btn btn-sm btn-primary">Save</button>
              <button type="button" class="btn btn-sm btn-danger" onclick="resetform()">Reset</button>
          </div>
        </div>
			</div>
		</div>
	</div>


<div class="modal fade" id="modal_kode" role="dialog">
	<div class="modal-lg">
		<div class="modal-content">
		<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Form Pencarian Peserta</h4>
				</div>

			<form action="javascript:;"  method="post" id="form_cari">
				<div class="modal-body form">
					<div >
						<div class="panel panel-widget">
							<div class="my-div">
									<div class="form-group">
										<input type="hidden" id="id_kode_modal" name="id_kode_modal">
										<div>
										<table id="jqGridVlookup"></table>
										<div id="jqGridPagerDataLookup"></div>
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

</div>
</section>

<script type="text/javascript">
  require.config({
      baseUrl: baseURL+'tpl/sb-admin/',
      //urlArgs: "bust=" + (new Date()).getTime(),
      paths: {
          "core"               		:   'js/main',
					// "jquery": 'jquery-2.2.3',
          "jspage"					: 	'js/page/peserta'
      }
    });
    require(["core"], function(core) {
        require([
                 'jspage',
                 'tpl.all'
         ], function(){});
    });
</script>
