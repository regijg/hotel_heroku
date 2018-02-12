<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 *
 * @author
 */
class User extends arisoft_id_core {
  private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('upload');
    $this->load->model('UserModel','',TRUE);
		$this->widget = new Widget ();
		$this->uuid = new Uuid ();
	}

	/**
	 * Index view
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
 		$data['userlevelList'] = $this->UserModel->userlevelList()->result();
    $this->load->tpl ( 'v_user', $data );
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
			$search_col ['lower(username)'] = strtolower ( $key );
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
		$param ['order_column'] = "resv_no";
		$param ['limit'] = $showData . "," . $getOffset;
		//$param ['order'] = $orderType;
		$param ['order_column'] = $sortCol;
		$queryData = $this->UserModel->showDataUser ( $param )->result ();
		$queryOriData = $this->UserModel->showDataUser ()->result ();

		$total = count ( $queryOriData ) != 0 ? ceil ( count ( $queryOriData ) / ( int ) $showData ) : 0;
		$data ['record'] = "1";
		$data ['page'] = ( int ) $pageOri;
		$data ['total'] = $total;
		$data ['rows'] = $queryData;

		exit ( $callback . "(" . json_encode ( $data ) . ")" );
	}

  public function do_upload(){
      $config['upload_path']          = './tpl/sb-admin/user-image/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 10000;
      $config['max_width']            = 5000;
      $config['max_height']           = 5000;

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('photo_file')){
          $error = array('error' => $this->upload->display_errors());

          // $this->load->tpl('v_user', $error);
      }else{
          $data = array('upload_data' => $this->upload->data());
          $this->UserModel->update_foto($photo_file);
          // $this->load->tpl('v_user', $data);
      }
  }

  public function prosess_adding() {
		$id = $this->input->post ( 'user_id' );
		if ($id) {
			exit ( $this->edit_user ( $id ) );
		} else {
			exit ( $this->simpan_user () );
		}
	}

  public function simpan_user(){
    $post = $this->input->post();

    $config['upload_path']          = './tpl/sb-admin/user-image/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 10000;
    $config['max_width']            = 5000;
    $config['max_height']           = 5000;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ( ! $this->upload->do_upload('photo_file')){
            // $photo_file = '';
            $photo_file = $this->upload->data();
            $photo_file = 'admin2.jpg';
            $data ['photo_file'] = $photo_file;
        }else{
            $photo_file = $this->upload->data();
            $data ['photo_file'] = $photo_file['raw_name'].$photo_file['file_ext'];
        }

    // $this->do_upload();
    $data ['username'] = $post ['username'];
    $data ['first_name'] = $post ['first_name'];
    $data ['last_name'] = $post ['last_name'];
    $data ['alamat'] = $post ['alamat'];
    $data ['telpon'] = $post ['telpon'];
    $data ['email'] = $post ['email'];
    $data ['password'] = md5($post ['password']);
    $data ['group_id'] = $post ['group_id'];
    // $data ['photo_file'] = $photo_file['raw_name'].$photo_file['file_ext'];
    $data ['last_update'] = date("Y-m-d H:i:s");

    $this->UserModel->add_user($data);

    $response ['n'] = 'ss';
		$response ['m'] = 'Checkin success';

		exit ( json_encode ( $response ) );
  }

  public function edit_user($id){
    $post = $this->input->post();
    $config['upload_path']          = './tpl/sb-admin/user-image/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 10000;
    $config['max_width']            = 2500;
    $config['max_height']           = 2500;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ( ! $this->upload->do_upload('photo_file')){
            $photo_file = $this->upload->data();
            $photo_file = 'admin2.jpg';
            $data ['photo_file'] = $photo_file;
        }else{
            $photo_file = $this->upload->data();
            $data ['photo_file'] = $photo_file['raw_name'].$photo_file['file_ext'];
        }
    $data ['user_id'] = $id;
    $data ['username'] = $post ['username'];
    $data ['first_name'] = $post ['first_name'];
    $data ['last_name'] = $post ['last_name'];
    $data ['alamat'] = $post ['alamat'];
    $data ['telpon'] = $post ['telpon'];
    $data ['email'] = $post ['email'];
    $data ['password'] = md5($post ['password']);
    $data ['group_id'] = $post ['group_id'];
    $data ['last_update'] = date("Y-m-d H:i:s");

    $this->UserModel->edit_user($id, $data);

    $response ['n'] = 'ss';
		$response ['m'] = 'Sukses Mengupdate';

		exit ( json_encode ( $response ) );
  }

  function getDetailDataUser(){
		$id=$this->input->get('id');
		$user= $this->UserModel->getDataUser($id)->row();

		$response ['user_id'] = $user->user_id;
		$response ['username'] = $user->username;
		$response ['first_name'] = $user->first_name;
		$response ['last_name'] = $user->last_name;
		$response ['alamat'] = $user->alamat;
		$response ['telpon'] = $user->telpon;
		$response ['email'] = $user->email;
		$response ['group_id'] = $user->group_id;

		// $response ['in_date'] = $orderHead->order_head_reduksi;
		// $response ['out_date'] = $orderHead->order_head_reduksi;

		// $response ['tabel'] = $this->tabelDetailBarang($id);
		$response ['n'] = 'ss';
		$response ['m'] = 'Suksess';

		exit ( json_encode ( $response ) );

	}

  public function delete_user() {
    $id = $this->input->get ( 'id' );
    $this->UserModel->delete_user ( $id );
    $response ['n'] = 'ss';
    $response ['m'] = 'Data berhasil dihapus';
    exit ( json_encode ( $response ) );
  }

}
