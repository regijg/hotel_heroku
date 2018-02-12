<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 * @author regiJG
 */
class Housekeeping extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->model('HouseKeepingModel','',TRUE);
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
		// $table = 'tr_billing';
		// $data['user'] = $this->session->userdata('auth_data');
		$data['roomList'] = $this->HouseKeepingModel->roomList()->result();
		$this->load->tpl ( 'v_housekeeping', $data );
	}

	public function status_room() {
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
		// $table = 'tr_billing';
		// $data['user'] = $this->session->userdata('auth_data');
		$data['roomListStatus'] = $this->db->query('select * from tbl_room where room_status = 3 ')->result();
		// var_dump($data['roomListStatus']);
		// exit();
		$this->load->tpl ( 'v_housekeeping_status', $data );
	}


  public function list_data() {

		$rows = $this->input->get ( 'rows' );
		$pageOri = $this->input->get ( 'page' );
		$sortCol = $this->input->get ( 'sidx' );
		$orderType = $this->input->get ( 'sord' );
		$callback = $this->input->get ( 'callback' );
		$filters = $this->input->get ( 'filters' );
		$key = $this->input->get ( 'key' );

		if ($key != NULL) {
			$search_col ['lower(tr.check_date)'] = strtolower ( $key );
			$search_col ['lower(tr.room_number)'] = strtolower ( $key );
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
		$param ['order'] = "asc";
		$param ['order_column'] = "check_date";
		$param ['limit'] = $showData . "," . $getOffset;
		//$param ['order'] = $orderType;
		$param ['order_column'] = $sortCol;
		$queryData = $this->HouseKeepingModel->showDataRoomCheck ( $param )->result ();
		$queryOriData = $this->HouseKeepingModel->showDataRoomCheck ()->result ();

		$total = count ( $queryOriData ) != 0 ? ceil ( count ( $queryOriData ) / ( int ) $showData ) : 0;
		$data ['record'] = "1";
		$data ['page'] = ( int ) $pageOri;
		$data ['total'] = $total;
		$data ['rows'] = $queryData;

		exit ( $callback . "(" . json_encode ( $data ) . ")" );
	}

	// public function prosess_booking() {
	// 	$id = $this->input->post ( 'resv_id_switch' );
	// 	if ($id) {
	// 		exit ( $this->edit_booking ( $id ) );
	// 	} else {
	// 		exit ( $this->create_booking () );
	// 	}
	// }

	public function create_roomcheck() {

		$post = $this->input->post ();

		$data ['room_number'] = $post ['room_number'];
		$data ['check_date'] = date("Y-m-d",strtotime($post ['check_date']));
		if (isset($post ['fasilitas1'])) {
				$data ['fasilitas1'] = 1;
		}else {
				$data ['fasilitas1'] = 0;
		}
		if (isset($post ['fasilitas2'])){
				$data ['fasilitas2'] = 1;
		}else {
			  $data ['fasilitas2'] = 0;
		}
		if (isset($post ['fasilitas3'])) {
				$data ['fasilitas3'] = 1;
		}else {
				$data ['fasilitas3'] = 0;
		}
		if (isset($post ['fasilitas4'])) {
				$data ['fasilitas4'] = 1;
		}else {
				$data ['fasilitas4'] = 0;
		}
		if (isset($post ['fasilitas5'])) {
				$data ['fasilitas5'] = 1;
		}else {
				$data ['fasilitas5'] = 0;
		}
		if (isset($post ['fasilitas6'])) {
				$data ['fasilitas6'] = 1;
		}else {
				$data ['fasilitas6'] = 0;
		}
		if (isset($post ['fasilitas7'])) {
				$data ['fasilitas7'] = 1;
		}else {
				$data ['fasilitas7'] = 0;
		}
		// $data ['fasilitas2'] = $post ['fasilitas2'];
		// $data ['fasilitas3'] = $post ['fasilitas3'];
		// $data ['fasilitas4'] = $post ['fasilitas4'];
		// $data ['fasilitas5'] = $post ['fasilitas5'];
		// $data ['fasilitas6'] = $post ['fasilitas6'];
		// $data ['fasilitas7'] = $post ['fasilitas7'];
		if (isset($post['kamar_mandi'])) {
    	$data ['kamar_mandi'] = 1;
		}else {
			$data ['kamar_mandi'] = 0;
		}
		if (isset($post['dinding'])) {
			$data ['dinding'] = 1;
		}else {
			$data ['dinding'] = 0;
		}
		if (isset($post['atap_plafon'])) {
			$data ['atap_plafon'] = 1;
		}else {
			$data ['atap_plafon'] = 0;
		}
		if (isset($post['pintu'])) {
			$data ['pintu'] = 1;
		}else {
			$data ['pintu'] = 0;
		}
		// $data ['kamar_mandi'] = $post ['kamar_mandi'];
		// $data ['dinding'] = $post ['dinding'];
		// $data ['atap_plafon'] = $post ['atap_plafon'];
		// $data ['pintu'] = $post ['pintu'];
		$data ['keterangan'] = $post ['keterangan'];
		$data ['user_name'] = $this->session->userdata('auth_data');
		$data ['last_update'] = date("Y-m-d H:i:s");
		$response ['n'] = 'ss';
		$response ['m'] = 'Thank You';
		$this->HouseKeepingModel->simpan_roomcheck ( $data);



		if ($post['room_status'] == 1) {
			if ($post ['room_number'] != ""){
						$dataroom ['room_status'] = 1;
						$dataroom ['room_number'] = $data ['room_number'];
						$dataroom ['fasilitas1'] = $data['fasilitas1'];
						$dataroom ['fasilitas2'] = $data['fasilitas2'];
						$dataroom ['fasilitas3'] = $data['fasilitas3'];
						$dataroom ['fasilitas4'] = $data['fasilitas4'];
						$dataroom ['fasilitas5'] = $data['fasilitas5'];
						$dataroom ['fasilitas6'] = $data['fasilitas6'];
						$dataroom ['fasilitas7'] = $data['fasilitas7'];

				    $dataroom ['kamar_mandi'] = $data ['kamar_mandi'];
						$dataroom ['dinding'] = $data ['dinding'];
						$dataroom ['atap_plafon'] = $data ['atap_plafon'];
						$dataroom ['pintu'] = $data ['pintu'];

						$dataroom ['kondisi_kerusakan'] = $data ['keterangan'];
						$dataroom ['last_update'] = date("Y-m-d H:i:s");
						$this->HouseKeepingModel->edit_room ($dataroom ['room_number'],$dataroom);
			}
		}
		if ($post['room_status'] == 4) {
			if ($post ['room_number'] != ""){
						$dataroom ['room_status'] = 4;
						$dataroom ['room_number'] = $data ['room_number'];
						$dataroom ['fasilitas1'] = $data['fasilitas1'];
						$dataroom ['fasilitas2'] = $data['fasilitas2'];
						$dataroom ['fasilitas3'] = $data['fasilitas3'];
						$dataroom ['fasilitas4'] = $data['fasilitas4'];
						$dataroom ['fasilitas5'] = $data['fasilitas5'];
						$dataroom ['fasilitas6'] = $data['fasilitas6'];
						$dataroom ['fasilitas7'] = $data['fasilitas7'];

				    $dataroom ['kamar_mandi'] = $data ['kamar_mandi'];
						$dataroom ['dinding'] = $data ['dinding'];
						$dataroom ['atap_plafon'] = $data ['atap_plafon'];
						$dataroom ['pintu'] = $data ['pintu'];

						$dataroom ['kondisi_kerusakan'] = $data ['keterangan'];
						$dataroom ['last_update'] = date("Y-m-d H:i:s");
						$this->HouseKeepingModel->edit_room ($dataroom ['room_number'],$dataroom);
			}
		}

		exit( json_encode ( $response ));
	 }

	function ambilRoomNumber() {
		$kode = $this->input->get('kode');
		$idfield = $this->input->get('idfield');
		$rate = $this->HouseKeepingModel->getRoomNumber($kode)->result();
		$temp = $this->HouseKeepingModel->getRoomNumber($kode)->row();

		$response ['fasilitas1'] = $temp->fasilitas1;
		$response ['fasilitas2'] = $temp->fasilitas2;
		$response ['fasilitas3'] = $temp->fasilitas3;
		$response ['fasilitas4'] = $temp->fasilitas4;
		$response ['fasilitas5'] = $temp->fasilitas5;
		$response ['fasilitas6'] = $temp->fasilitas6;
		$response ['fasilitas7'] = $temp->fasilitas7;
		$response ['kamar_mandi'] = $temp->kamar_mandi;
		$response ['dinding'] = $temp->dinding;
		$response ['atap_plafon'] = $temp->atap_plafon;
		$response ['pintu'] = $temp->pintu;
		$response ['lain_lain'] = $temp->lain_lain;
		$response ['kondisi_kerusakan'] = $temp->kondisi_kerusakan;

		$response ['n'] = 'ss';
 		$response ['m'] = 'Suksess';
 		exit ( json_encode ( $response ) );
	}

}
