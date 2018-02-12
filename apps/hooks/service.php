<?php
class Service {

	private $init;

	public function __construct() {
		$this->init =& get_instance();
	}

	public function auth() {
		$init =& get_instance();
		$auth =  $init->session->userdata('auth_data');
		$method     = $init->uri->rsegments[2];
		$class  = $init->uri->rsegments[1];
		$classLoggedException = array(
				'login'
		);
		if(!in_array($class, $classLoggedException)) {
			if (!$auth) {
				redirect('login?n=logout&m='.base64_encode('Anda telah keluar'));
			}
		}
	}

}
