<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 * @author regiJG
 */
class Tamu extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
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

		// Push Data
		$data['widget'] = ( object ) $widget;
    $table = 'tbl_tamu';
		$data['kodeunik'] = $this->TamuModel->getkodeunik($table);
    //$data['negaras'] = $this->TamuModel->get_negara();
		// $data['provinsis'] = $this->TamuModel->get_provinsi();
		// $data['kotas'] = $this->TamuModel->get_kota();
		$data['provinsi'] = $this->TamuModel->get_provinsi();
		$data['kab'] = $this->TamuModel->get_kabupaten();
		$this->load->tpl ( 'v_tamu', $data );
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
			$search_col ['lower("tt"."tamu_nama")'] = strtolower ( $key );
			// $search_col ['lower("tt"."tamu_kode")'] = strtolower ( $key );
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
		$param ['order_column'] = "tamu_kode";
		$param ['limit'] = $showData . "," . $getOffset;
		//$param ['order'] = $orderType;
		$param ['order_column'] = $sortCol;
		$queryData = $this->TamuModel->showDataMasterTamu ( $param )->result ();
		$queryOriData = $this->TamuModel->showDataMasterTamu ()->result ();

		$total = count ( $queryOriData ) != 0 ? ceil ( count ( $queryOriData ) / ( int ) $showData ) : 0;
		$data ['record'] = "1";
		$data ['page'] = ( int ) $pageOri;
		$data ['total'] = $total;
		$data ['rows'] = $queryData;

		exit ( $callback . "(" . json_encode ( $data ) . ")" );
	}

	function populate_kab() {
    $id = $this->input->post('kode');
    echo(json_encode($this->TamuModel->get_kabupaten($id)));
  }

	// function populate_kota() {
  //        $id = $this->input->post('kode');
  //        echo(json_encode($this->TamuModel->get_kota($id)));
  // }

	public function create_tamu(){
		$user = $this->session->userdata('auth_data');
		$post = $this->input->post();
		$data ['tamu_kode'] = $post ['tamu_kode'];
		$data ['tamu_identitas_tipe'] = $post ['tamu_identitas_tipe'];
		$data ['tamu_identitas_number'] = $post ['tamu_identitas_number'];
		$data ['tamu_nama'] = $post ['tamu_nama'];
		$data ['tamu_alamat'] = $post ['tamu_alamat'];
		$data ['tamu_telpon'] = $post ['tamu_telpon'];
		$data ['tamu_kelamin'] = $post ['tamu_kelamin'];
		$data ['tamu_email'] = $post ['tamu_email'];
		$data ['tamu_job'] = $post ['tamu_job'];
		$data ['tamu_negara_kode'] = $post ['negara_id'];
		$data ['tamu_provinsi_id'] = $post ['provinsi_id'];
		$data ['tamu_kota_id'] = $post ['kota_id'];

		$data ['insert_by'] = $user['username'];
		$data ['insert_date'] = date("Y-m-d H:i:s");

		$data ['tamu_id'] = $this->uuid->v4();

		if ($data ['tamu_kode'] == NULL) {
			$response ['n'] = 'err';
			$response ['m'] = 'Error euy isian..??';
		} else {
			$id = $this->TamuModel->simpan_tamu ( $data );
			$response ['n'] = 'ss';
			$response ['m'] = 'Data berhasil disimpan';
		}
		return json_encode($response);
	}

	public function tamu_detail_rest() {
			$id = $this->input->get ( 'id' );
			$p ['id'] = $id;
			$tamuData = $this->TamuModel->showDataMasterTamu ( $p )->row ();
			exit ( json_encode ( $tamuData ) );
	}

	public function edit_tamu($id){
		$user = $this->session->userdata('auth_data');
		$post = $this->input->post();
		$data ['tamu_kode'] = $post ['tamu_kode'];
		$data ['tamu_identitas_tipe'] = $post ['tamu_identitas_tipe'];
		$data ['tamu_identitas_number'] = $post ['tamu_identitas_number'];
		$data ['tamu_nama'] = $post ['tamu_nama'];
		$data ['tamu_alamat'] = $post ['tamu_alamat'];
		$data ['tamu_telpon'] = $post ['tamu_telpon'];
		$data ['tamu_kelamin'] = $post ['tamu_kelamin'];
		$data ['tamu_email'] = $post ['tamu_email'];
		$data ['tamu_job'] = $post ['tamu_job'];
		$data ['tamu_negara_kode'] = $post ['negara_id'];
		$data ['tamu_provinsi_id'] = $post ['provinsi_id'];
		$data ['tamu_kota_id'] = $post ['kota_id'];

		$data ['update_by'] = $user['username'];
		$data ['update_date'] = date("Y-m-d H:i:s");

		$data ['tamu_id'] = $id;
		$id = $this->TamuModel->edit_tamu ($data ['tamu_id'], $data );
		$response ['n'] = 'ss';
		$response ['m'] = 'Data berhasil diedit';
		return json_encode($response);
	}

	public function process(){
		$id = $this->input->post ( 'tamu_id' );
		if ($id) {
			exit ( $this->edit_tamu ( $id ) );
		} else {
			exit ( $this->create_tamu () );
		}
	}

	public function delete_tamu() {
			$id = $this->input->get ( 'id' );
			$this->TamuModel->delete_tamu ( $id );
			$response ['n'] = 'ss';
			$response ['m'] = 'Data berhasil dihapus';
			//}
			exit ( json_encode ( $response ) );
	}

}
