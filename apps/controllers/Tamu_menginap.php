<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 * @author regiJG
 */
class Tamu_menginap extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->model('RegistrasiModel','',TRUE);
    $this->load->model('TamuModel','',TRUE);
		$this->widget = new Widget ();
		$this->uuid = new Uuid ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */
	public function index() {
		// Load widget
		$injectData = array(
				"user" => "TEST"
		);
		$widget = array (
				'sidebar' => $this->widget->sidebar (),
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside(),
				'topmenu' => $this->widget->topmenu($injectData)
		);
		$data['widget'] = ( object ) $widget;
    $data['listDataTamuMenginap'] = $this->RegistrasiModel->listDataTamuMenginap();
    $data['roomList'] = $this->RegistrasiModel->roomList()->result();
		$this->load->tpl ( 'v_tamu_menginap', $data );
	}

  public function checkin() {
		// Load widget
		$injectData = array(
				"user" => "TEST"
		);
		$widget = array (
				'sidebar' => $this->widget->sidebar (),
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside(),
				'topmenu' => $this->widget->topmenu($injectData)
		);
		$data['widget'] = ( object ) $widget;
    $data['listDataTamuCheckin'] = $this->RegistrasiModel->listDataTamuCheckin();
		$this->load->tpl ( 'v_checkin_registrasi', $data );
	}

	function ambilRoomNumber() {
		$kode = $this->input->get('kode');
		$idfield = $this->input->get('idfield');
		$rate = $this->RegistrasiModel->getRoomNumber($kode)->result();
		$temp = $this->RegistrasiModel->getRoomNumber($kode)->row();

		$response ['room_number'] = $temp->room_number;
		$response ['rate_name'] = $temp->rate_name;
		$response ['tarif_umum'] = $temp->tarif_umum;
		$response ['n'] = 'ss';
 		$response ['m'] = 'Suksess';
 		exit ( json_encode ( $response ) );
	}

	function ambilDataPeserta() {
			$kode = $this->input->get('kode');
			$idfield = $this->input->get('idfield');
			$rate = $this->TamuModel->getDataPeserta($kode)->result();
			$temp = $this->TamuModel->getDataPeserta($kode)->row();

			$response ['pesertaID'] = $temp->pesertaID;
			$response ['nip_register'] = $temp->nip_register;
			// $response ['title1'] = $temp->title1;
			// $response ['title2'] = $temp->title2;
			$response ['nama_peserta'] = $temp->title1.''.$temp->nama_peserta.''.$temp->title2;
			$response ['alamat_rumah'] = $temp->alamat_rumah;
			$response ['telpon'] = $temp->telpon;
			$response ['nama_perusahaan'] = $temp->nama_perusahaan;
			$response ['no_registrasi'] = $temp->no_registrasi;
			// $response ['perusahaanID'] = $temp->perusahaanID;
			$response ['n'] = 'ss';
			$response ['m'] = 'Suksess';
			exit ( json_encode ( $response ) );
	}

	public function prosess_edit_diklat() {
		$id = $this->input->post ( 'reg_id' );
		if ($id) {
			exit ( $this->edit_registrasi_diklat ( $id ) );
		} else {
			echo "belegug siah";
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
		 $this->TamuModel->edit_tamu($id, $data);
		 exit( json_encode ( $response ));
 }

}
