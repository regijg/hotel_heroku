<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 *
 * @author
 */
class Edit_profile extends arisoft_id_core {
  private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('upload');
    $this->load->model('EditProfileModel','',TRUE);
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
    $data['username'] = $this->session->userdata('auth_data');
    $data['userlevelList'] = $this->EditProfileModel->userlevelList()->result();
    // GET SESSION START //
    // $data['userList'] = $this->EditProfileModel->user_list($data['username'])->row_array();
		// $data['user_id'] = $data['userList']['user_id'];
    // $data['first_name'] = $data['userList']['first_name'];
    // $data['last_name'] = $data['userList']['last_name'];
    // $data['email'] = $data['userList']['email'];
    // $data['alamat'] = $data['userList']['alamat'];
    // $data['telpon'] = $data['userList']['telpon'];
    // $data['username'] = $data['userList']['username'];
    // $data['photo_file'] = $data['userList']['photo_file'];
    // GET SESSION END //

    $data['userList'] = $this->EditProfileModel->user_list($data['username'])->result();
    $this->load->tpl ( 'edit_profile_user', $data );
  }

  public function prosess_adding() {
		$id = $this->input->post ( 'user_id' );
		if ($id) {
			exit ( $this->edit_user ( $id ) );
		} else {
			echo 'gagal';
		}
	}

  public function edit_user($id){
    $post = $this->input->post();

    if ($post['password'] != '') {
        $data ['username'] = $post ['username'];
        $data ['first_name'] = $post ['first_name'];
        $data ['last_name'] = $post ['last_name'];
        $data ['alamat'] = $post ['alamat'];
        $data ['telpon'] = $post ['telpon'];
        $data ['email'] = $post ['email'];
        $data ['password'] = md5($post ['password']);
        // $data ['group_id'] = $post ['group_id'];
    }else {
        $data ['username'] = $post ['username'];
        $data ['first_name'] = $post ['first_name'];
        $data ['last_name'] = $post ['last_name'];
        $data ['alamat'] = $post ['alamat'];
        $data ['telpon'] = $post ['telpon'];
        $data ['email'] = $post ['email'];
        // $data ['group_id'] = $post ['group_id'];
    }
    $data ['last_update'] = date("Y-m-d H:i:s");

    $this->EditProfileModel->edit_user($id, $data);

    $response ['n'] = 'ss';
		$response ['m'] = 'Sukses Mengupdate';

		exit ( json_encode ( $response ) );
  }

  public function prosess_upload() {
		$id = $this->input->post ( 'user_id' );
		if ($id) {
			exit ( $this->upload_photo_user ( $id ) );
		} else {
			echo 'gagal';
		}
	}

  public function upload_photo_user($id){
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

    $data['user_id'] = $id;
    $data ['last_update'] = date("Y-m-d H:i:s");
    $this->EditProfileModel->edit_user($id, $data);

    $response ['n'] = 'ss';
		$response ['m'] = 'Sukses Mengupdate';

		exit ( json_encode ( $response ) );
  }

}
