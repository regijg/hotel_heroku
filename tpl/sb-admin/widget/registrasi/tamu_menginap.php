<section class="content-header">
  <h1>

  </h1>
  <ol class="breadcrumb">
		<li><a href="<?= base_url('/registrasi/tamu_menginap') ?>"><i class="fa fa-circle-o"></i> TAMU MENGINAP</a></li>
    <li><a href="<?= base_url('/registrasi/checkin') ?>"><i class="fa fa-circle-o"></i> Check-IN</a></li>
    <li><a href="<?= base_url('/registrasi/checkout') ?>"><i class="fa fa-circle-o"></i> Check-OUT</a></li>
  </ol>
</section><br>
<section class="content">
<div class="row">
	<div class="col-lg-12">
    <div class="box box-primary">
      <div class="box-header with-border" style="text-align:center">
        <h3 class="box-title">DAFTAR TAMU MENGINAP</h3>
      </div>
      <br/>
      <div class="form-group">
        <div class="col-sm-2">
          <input onkeyup="searchDataTamuMenginap(this.value);" type="text" name="searchDataTamuMenginap" class="form-control" placeholder="Nama or Alamat">
        </div>
      </div>
      <br/>
      <div class="box-body" style="width:99%">
        <table id="jqGrid"></table>
        <div id="jqGridPagerDataTamuMenginap"></div>
      </div>
    </div>
		</div>

</div>
</section>
