<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';

/**
 *
 * @author
 */
class Login extends arisoft_id_core {
	private $widget;
	public function __construct() {
		parent::__construct ();

		$this->load->helper ( 'url' );
		$this->load->helper ( 'form' );
		$this->load->model ( 'UserModel', '', TRUE );
		$this->widget = new Widget ();
	}

	/**
	 * Index view
	 */
	public function index() {
		$getData = (object) $this->input->get();

		$data ['n'] = $getData->n;
		$data ['m'] = base64_decode($getData->m);

// 		var_dump($data);
// 		exit;
		exit ( $this->load->widget ( 'login_neon', $data ) );

	}

	/**
	 * Login Prosess
	 */

	// public function auth() {
	// 	$user = $this->input->post('username');
	// 	$pass = md5($this->input->post('password'));
	// 	$data=$this->UserModel->login_user($user,$pass);
	// 	if ($data) {
	// 		  $role = "superadmin";
	// 			$this->session->set_userdata ( 'auth_data', $user );
	// 			$this->session->set_userdata ( 'role_data', $role );
	// 			redirect ( 'home' );
	// 	} else {
	// 			redirect ( 'login?n=error&m=' . base64_encode ( "Login gagal..!" ) );
	// 	}
	// }

	// public function auth() {
	// 	$user=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
  //   $pass=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
	// 	$data = $this->UserModel->login_user($user,$pass);
	// 	if ($data->num_rows() > 0) {
	// 		$dataUser = $data->row_array();
	// 		// $role = "superadmin";
	// 		$this->session->set_userdata ( 'auth_data', $user );
	// 		if ($dataUser['group_id'] == 3) {
	// 			$this->session->set_userdata('akses','3');
	// 			$this->session->set_userdata ( 'role_data', 'Room Boy' );
	// 			redirect ( 'home' );
	// 		}elseif ($dataUser['group_id'] == 9999) {
	// 			$this->session->set_userdata('akses','9999');
	// 			$this->session->set_userdata ( 'role_data', 'Administrator' );
	// 			redirect ( 'home' );
	// 		}elseif ($dataUser['group_id'] == 1) {
	// 			$this->session->set_userdata('akses','1');
	// 			$this->session->set_userdata ( 'role_data', 'Manager' );
	// 			redirect ( 'home' );
	// 		}elseif ($dataUser['group_id'] == 2) {
	// 			$this->session->set_userdata('akses','2');
	// 			$this->session->set_userdata ( 'role_data', 'Resepsionist' );
	// 			redirect ( 'home' );
	// 		}else {
	// 			$this->session->set_userdata('akses', null);
	// 			$this->session->set_userdata ( 'role_data', '' );
	// 			redirect ( 'home' );
	// 		}
	// 	} else {
	// 			redirect ( 'login?n=error&m=' . base64_encode ( "Login gagal..!" ) );
	// 	}
	// }

	public function auth() {
		$user=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
    $pass=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		$data = $this->UserModel->login_user($user,$pass);
		if ($data->num_rows() > 0) {
			$dataUser = $data->row_array();
			// $role = "superadmin";
			$this->session->set_userdata ( 'auth_data', $user );
			$haskakses = $dataUser['group_id'];
			$user_image = $dataUser['photo_file'];
			$name1 = $dataUser['first_name'];
			$name2 = $dataUser['last_name'];
			if ($haskakses) {
				$this->session->set_userdata('akses',$haskakses);
				if ($haskakses == 1) {
						$this->session->set_userdata ( 'role_data', 'MANAGER' );
						$this->session->set_userdata ( 'photo_file', $user_image );
						$this->session->set_userdata ( 'first_name', $name1 );
						$this->session->set_userdata ( 'last_name', $name2 );
				}elseif ($haskakses == 2) {
						$this->session->set_userdata ( 'role_data', 'RESEPSIONIST' );
						$this->session->set_userdata ( 'photo_file', $user_image );
						$this->session->set_userdata ( 'first_name', $name1 );
						$this->session->set_userdata ( 'last_name', $name2 );
				}elseif ($haskakses == 3) {
						$this->session->set_userdata ( 'role_data', 'ROOMBOY' );
						$this->session->set_userdata ( 'photo_file', $user_image );
						$this->session->set_userdata ( 'first_name', $name1 );
						$this->session->set_userdata ( 'last_name', $name2 );
				}elseif ($haskakses == 9999) {
					  $this->session->set_userdata ( 'role_data', 'ADMINISTRATOR' );
						$this->session->set_userdata ( 'photo_file', $user_image );
						$this->session->set_userdata ( 'first_name', $name1 );
						$this->session->set_userdata ( 'last_name', $name2 );
				}else {
					$this->session->set_userdata ( 'role_data', '' );
				}
				redirect ( 'home' );
			}else {
				$this->session->set_userdata('akses', null);
				$this->session->set_userdata ( 'role_data', '' );
				redirect ( 'home' );
			}
		} else {
				redirect ( 'login?n=error&m=' . base64_encode ( "Login gagal..!" ) );
		}
	}

	function register(){
		if ($this->input->post('daftar')) {
				$this->login->register();
				redirect('login');
		}else{
				$this->load->tpl ( 'register_user');
		}
	}

	/**
	 * Logot Prosess
	 */
	function logout() {
		$this->session->unset_userdata('auth_data');
		redirect ( 'login?n=error&m='.base64_encode('Anda telah logout'));
	}
}
