<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 * @author regiJG
 */
class Registrasi extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->model('RegistrasiModel','',TRUE);
		$this->widget = new Widget ();
		$this->uuid = new Uuid ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */
	public function index() {
		// Load widget
		$param['roomList'] = $this->RegistrasiModel->roomList()->result();
		$widget = array (
				'sidebar' => $this->widget->sidebar (),
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside()
				// 'data_tamu' => $this->widget->data_tamu($param)
		);
		$data['widget'] = ( object ) $widget;
		$this->load->tpl ( 'v_registrasi', $data );
	}

	public function list_data_history_registrasi() {

		$rows = $this->input->get ( 'rows' );
		$pageOri = $this->input->get ( 'page' );
		$sortCol = $this->input->get ( 'sidx' );
		$orderType = $this->input->get ( 'sord' );
		$callback = $this->input->get ( 'callback' );
		$filters = $this->input->get ( 'filters' );
		$filter = $this->input->get ( 'filter' );
	  $key = $this->input->get ( 'key' );
	  $in_date_start = $this->input->get ( 'in_date_start' );
	  $in_date_end = $this->input->get ( 'in_date_end' );

	  // $periode = date("Y-m",strtotime($date));

		if ($key != NULL) {
			$search_col ['lower(tt.nama)'] = strtolower ( $key );
			$search_col ['lower(tt.reg_no)'] = strtolower ( $key );
			// $search_col ['lower(tt.in_date)'] = strtolower ( $key );
			$param ['search'] = $search_col;
		}

		// Filters
	  if ($filters != NULL) {
	      $getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
	      $search_col = array ();
	      foreach ( $getFilter->rules as $row ) {
	          $search_col [$row->field] = $row->data;
	      }
	      $param ['search'] = $search_col;
	  }

		$page = $pageOri == 1 ? 0 : $pageOri - 1;
		$showData = $rows;
		$getOffset = $page > 0 ? ($showData * $page) : 0;

		// $param['id'] = "";
		$param ['order'] = "desc";
		$param ['order_column'] = "reg_id";
		$param ['filter'] = $filter;
		$param ['in_date_start'] = $in_date_start;
		$param ['in_date_end'] = $in_date_end;
	  $param ['order_column'] = "nama";
		$param ['limit'] = $showData . "," . $getOffset;
		//$param ['order'] = $orderType;
		$param ['order_column'] = $sortCol;
		$queryData = $this->RegistrasiModel->showDataMasterHistoryRegistrasi ( $param )->result ();
		$queryOriData = $this->RegistrasiModel->showDataMasterHistoryRegistrasi ()->result ();

		$total = count ( $queryOriData ) != 0 ? ceil ( count ( $queryOriData ) / ( int ) $showData ) : 0;
		$data ['record'] = "1";
		$data ['page'] = ( int ) $pageOri;
		$data ['total'] = $total;
		$data ['rows'] = $queryData;

		exit ( $callback . "(" . json_encode ( $data ) . ")" );
	}

	function detailDataRegistrasi(){
		$id=$this->input->get('id');
		$registrasi= $this->RegistrasiModel->getDataRegistrasi($id)->row();

		$response ['reg_id'] = $registrasi->reg_id;
		$response ['reg_no'] = $registrasi->reg_no;
		$response ['tipe_tamu'] = $registrasi->tipe_tamu;
		$response ['nama'] = $registrasi->nama;
		$response ['nama2'] = $registrasi->nama2;
		$response ['no_induk'] = $registrasi->no_induk;
		$response ['no_induk2'] = $registrasi->no_induk2;
		$response ['alamat'] = $registrasi->alamat;
		$response ['alamat2'] = $registrasi->alamat2;
		$response ['telpon'] = $registrasi->telpon;
		$response ['telpon2'] = $registrasi->telpon2;
		$response ['kode_diklat'] = $registrasi->kode_diklat;
		$response ['judul_diklat'] = $registrasi->judul_diklat;
		$response ['sumber_dana'] = $registrasi->sumber_dana;
		$response ['nama_perusahaan'] = $registrasi->nama_perusahaan;
		$response ['nama_perusahaan2'] = $registrasi->nama_perusahaan2;
		$response ['person'] = $registrasi->person;
		$response ['room_number'] = $registrasi->room_number;
		$response ['rate_name'] = $registrasi->rate_name;
		$response ['price'] = $registrasi->price;
		$response ['rate_id'] = $registrasi->rate_id;
		$response ['floor'] = $registrasi->floor;

		// $response ['tabel'] = $this->tabelDetailBarang($id);
		$response ['n'] = 'ss';
		$response ['m'] = 'Suksess';

		exit ( json_encode ( $response ) );

	}

	function ambilRoomNumber() {
		$kode = $this->input->get('kode');
		$idfield = $this->input->get('idfield');
		$rate = $this->RegistrasiModel->getRoomNumber($kode)->result();
		$temp = $this->RegistrasiModel->getRoomNumber($kode)->row();

		$response ['room_number'] = $temp->room_number;
		$response ['rate_name'] = $temp->rate_name;
		$response ['tarif_umum'] = $temp->tarif_umum;
		$response ['tarif_dinas'] = $temp->tarif_dinas;
		$response ['floor'] = $temp->floor;
		$response ['n'] = 'ss';
 		$response ['m'] = 'Suksess';
 		exit ( json_encode ( $response ) );
	}

	public function prosess_edit_diklat() {
		$id = $this->input->post ( 'reg_id' );
		if ($id) {
			exit ( $this->edit_registrasi_diklat ( $id ) );
		} else {
			echo "No Edit";
		}
	}

	public function edit_registrasi_diklat($id) {
		 $post = $this->input->post ();


		 $data ['reg_id'] = $id;

		 $data ['nama'] = $post ['nama'];
		 $data ['nama2'] = $post ['nama2'];
		 $data ['alamat'] = $post ['alamat'];
		 $data ['alamat2'] = $post ['alamat2'];
		 $data ['telpon'] = $post ['telpon'];
		 $data ['telpon2'] = $post ['telpon2'];

		 $data ['kode_diklat'] = $post['kode_diklat'];
		 $data ['judul_diklat'] = $post ['judul_diklat'];
		 $data ['sumber_dana'] = $post ['sumber_dana'];

		 $data ['no_induk'] = $post ['no_identitas_diklat'];
		 $data ['no_induk2'] = $post ['no_identitas2_diklat'];
		 // $data ['no_identitas'] = $post ['no_identitas'];
		 // $data ['no_identitas2'] = $post ['no_identitas2'];
		 $data ['nama_perusahaan'] = $post ['nama_perusahaan'];
		 $data ['nama_perusahaan2'] = $post ['nama_perusahaan2'];

		 $data ['user_name'] = $this->session->userdata('auth_data');


		 // if ($post['resv_status'] == 2) {
			//  if ($post ['room_number'] != ""){
			// 		 $dataroom ['room_number'] =$post ['room_number'];
			// 		 $dataroom ['room_status'] = 5;
			// 		 $this->ReservasiModel->edit_room ($dataroom ['room_number'],$dataroom);
			//  }
		 // }

		 $response ['n'] = 'ss';
		 $response ['m'] = 'Data berhasil disimpan';
		 $this->RegistrasiModel->edit_tamu($id, $data);
		 exit( json_encode ( $response ));
 }

	 public function prosess_edit_umum() {
		 $id = $this->input->post ( 'reg_id' );
		 if ($id) {
			 exit ( $this->edit_registrasi_umum ( $id ) );
		 } else {
			 echo "No edit";
		 }
	 }

	 public function edit_registrasi_umum($id) {
			$post = $this->input->post ();


			$data ['reg_id'] = $id;

			$data ['person'] = $post ['person'];
			$data ['keterangan'] = $post ['keterangan'];

			$data ['user_name'] = $this->session->userdata('auth_data');

			$response ['n'] = 'ss';
			$response ['m'] = 'Data berhasil disimpan';
			$this->RegistrasiModel->edit_tamu($id, $data);
			exit( json_encode ( $response ));
	}

	public function prosess_mutasi_umum() {
		$id = $this->input->post ( 'reg_id' );
		if ($id) {
			exit ( $this->mutasi_registrasi_umum ( $id ) );
		} else {
			echo "No edit";
		}
	}

	public function mutasi_registrasi_umum($id) {
		 $post = $this->input->post ();

		 $data ['reg_id'] = $id;
		 $data ['room_number'] = $post ['room_number'];
		 $data ['rate_name'] = $post ['rate_name'];
		 $data ['price'] = $post ['price'];
		 $data ['keterangan'] = $post ['keterangan'];
		 $data ['person'] = $post ['person'];
		 $data ['floor'] = $post ['floor'];
		 $data ['keterangan'] = $post ['keterangan'];
		 $data ['user_name'] = $this->session->userdata('auth_data');

		 $this->RegistrasiModel->edit_tamu($id, $data);

		 if ($post ['room_number'] != ""){
 				$dataroom ['room_number'] =$post ['room_number'];
 				$dataroom ['room_status'] = 2;
 				$this->RegistrasiModel->edit_room ($dataroom ['room_number'],$dataroom);
 		}

		if ($post ['room_number_umum_lama'] != ""){
			 $dataroomlama ['room_number'] =$post ['room_number_umum_lama'];
			 $dataroomlama ['room_status'] = 3;
			 $this->RegistrasiModel->edit_room ($dataroomlama ['room_number'],$dataroomlama);
	 }

		 $response ['n'] = 'ss';
		 $response ['m'] = 'Data berhasil disimpan';
		 exit( json_encode ( $response ));
 }

 public function prosess_mutasi_diklat() {
	 $id = $this->input->post ( 'reg_id' );
	 if ($id) {
		 exit ( $this->mutasi_registrasi_diklat ( $id ) );
	 } else {
		 echo "No edit";
	 }
 }

 public function mutasi_registrasi_diklat($id) {
		$post = $this->input->post ();

		$data ['reg_id'] = $id;
		$data ['room_number'] = $post ['room_number'];
		$data ['rate_name'] = $post ['rate_name'];
		$data ['floor'] = $post ['floor'];
		$data ['keterangan'] = $post ['keterangan'];
		$data ['price'] = $post ['price'];
		$data ['keterangan'] = $post ['keterangan'];
		$data ['user_name'] = $this->session->userdata('auth_data');

		$this->RegistrasiModel->edit_tamu($id, $data);

		if ($post ['room_number'] != ""){
			 $dataroom ['room_number'] =$post ['room_number'];
			 $dataroom ['room_status'] = 2;
			 $this->RegistrasiModel->edit_room ($dataroom ['room_number'],$dataroom);
	 }

	 if ($post ['room_number_diklat_mutasi'] != ""){
			$dataroomlama ['room_number'] =$post ['room_number_diklat_mutasi'];
			$dataroomlama ['room_status'] = 3;
			$this->RegistrasiModel->edit_room ($dataroomlama ['room_number'],$dataroomlama);
	}

		$response ['n'] = 'ss';
		$response ['m'] = 'Data berhasil disimpan';
		exit( json_encode ( $response ));
	}

}
