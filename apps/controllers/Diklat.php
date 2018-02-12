<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';

/**
 * @author RegiJG
 */
class Diklat extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('DiklatModel','',TRUE);
		$this->widget = new Widget ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */

		function list_data_vlookup_diklat() {
			$rows = $this->input->get('rows');
			$pageOri = $this->input->get('page');
			$sortCol = $this->input->get ( 'sidx' );
			$orderType = $this->input->get ( 'sord' );
			$callback = $this->input->get ( 'callback' );
			$filters =$this->input->get ( 'filters' );
			$key =$this->input->get ( 'key' );
			$id_kode =$this->input->get ( 'id_kode' );

			if ($key != NULL) {
					$search_col ['lower("kode_diklat")'] = strtolower($key);
					$search_col ['lower("diklatID")'] = strtolower($key);
					$param['search'] = $search_col;
			}

										// Filters
			if ($filters != NULL) {
					$getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
					$search_col = array ();
					foreach ( $getFilter->rules as $row ) {
					$search_col [$row->field] = $row->data;
			}
					$param['search'] = $search_col;
			}

			$page = $pageOri == 1 ? 0 : $pageOri - 1;
			$showData = $rows;
			$getOffset = $page > 0 ? ($showData * $page)  : 0;

							//$param['id'] = "";
			$param['order'] = "asc";
			$param['order_column'] = "diklatID";
			$param['limit'] = $showData.",".$getOffset;
			$param ['order'] = $orderType;
			$param ['order_column'] = $sortCol;
			$queryData =  $this->DiklatModel->showDataVlookDiklat($param)->result();
			$queryOriData =  $this->DiklatModel->showDataVlookDiklat()->result();

			foreach ($queryData as $row) {
							// $col['diklatID'] = $row->diklatID;
							$col['kode_diklat'] = $row->kode_diklat;
							$col['judul_diklat'] = $row->judul_diklat;
							$col['sumber_dana'] = $row->sumber_dana;
							$col['id_kode'] = $id_kode;
							$getcol[] =$col;
			}

			$total  = count($queryOriData) != 0 ?  ceil(count($queryOriData) / (int)$showData)  : 0;
			$data['record'] = "1";
			$data['page'] = (int)$pageOri;
			$data['total'] =  $total;
			$data['rows'] = $getcol;

			exit($callback."(".json_encode($data).")");
		}

    function ambilDataDiklat() {
        $kode = $this->input->get('kode');
        $idfield = $this->input->get('idfield');
        $rate = $this->DiklatModel->getDataDiklat($kode)->result();
        $temp = $this->DiklatModel->getDataDiklat($kode)->row();

        $response ['diklatID'] = $temp->diklatID;
        $response ['kode_diklat'] = $temp->kode_diklat;
        $response ['full_name'] = $temp->full_name;
        $response ['sumber_dana'] = $temp->sumber_dana;
        $response ['rencana_selesai'] = $temp->rencana_selesai;
        $response ['n'] = 'ss';
        $response ['m'] = 'Suksess';
        exit ( json_encode ( $response ) );
    }

		function populate_diklat() {
	    // $id = $this->input->post('registrasiID');
	    // echo(json_encode($this->DiklatModel->get_kota($id)));

			$id = $this->input->post('registrasiID');
			echo(json_encode($this->DiklatModel->get_peserta_diklat($id)));
	  }

  //   function table_cr_peserta() {
  // 		$tplpeserta = '
  // 		<div class="col-lg-6" id="row_cr_diklat">
  // 			<div style="background-color:#959aa0; width:120px">
  // 				<b>INFORMASI TAMU 1</b>
  // 			</div>
  // 			<hr/>
  // 			<div class="form-group" style="height: 21px;">
  // 				<div class="col-lg-4"> <label>NIP/ NIK</label> </div>
  // 				<div class="col-lg-7">
  // 					<div class="input-group">
  // 						<input type="text" class="form-control" name="no_induk" id="no_induk_diklat" style="height:30px">
  // 							<span class="input-group-addon" aria-hidden="true"><a onclick="openKodePeserta(this.id)"><i class="glyphicon glyphicon-search"></i></a></span>
  // 					</div>
  // 				</div>
  // 			</div>
  // 			<div class="form-group" style="height: 25px;">
  // 				<div class="col-lg-4"> <label>Nama Lengkap</label> </div>
  // 				<div class="col-lg-7"> <input type="text" class="form-control" name="nama" id="nama_diklat"></div>
  // 			</div>
  // 			<div class="form-group" style="height: 45px;">
  // 				<div class="col-lg-4"> <label>Alamat</label> </div>
  // 				<div class="col-lg-7"> <textArea type="text" class="form-control" name="alamat" id="alamat_diklat"></textArea></div>
  // 			</div>
  // 			<div class="form-group" style="height: 25px;">
  // 				<div class="col-lg-4"> <label>Telpon/ HP</label> </div>
  // 				<div class="col-lg-7"> <input type="text" class="form-control" name="telpon" id="telpon_diklat"> </div>
  // 			</div>
  // 			<div class="form-group" style="height: 25px;">
  // 				<div class="col-lg-4"> <label>Nama Perusahaan</label> </div>
  // 				<div class="col-lg-7">
  // 					<div class="input-group">
  // 						<input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan_diklat" style="height:30px">
  // 							<span class="input-group-addon" aria-hidden="true"><a onclick="openKodePerusahaan(this.id)"><i class="glyphicon glyphicon-search"></i></a></span>
  // 					</div>
  // 				</div>
  // 			</div>
  // 		</div>';
  //
  //
  // 		$response ['row_cr_diklat'] = $tplpeserta;
  // 		$response ['n'] = 'ss';
  // 		$response ['m'] = 'Suksess';
  // 		exit ( json_encode ( $response ) );
	// }

}
