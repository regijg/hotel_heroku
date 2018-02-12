<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author eResources/AID/AP
 */
class Widget extends arisoft_id_core {

	public function __construct() {
		parent::__construct ();
	}

	/**
	 * Gobo Widget Header
	 * -------------------------------------------------------------------------------------
	 */
	public  function wgA() {
		$data = array();
		return $this->load->widget('wg_a', $data);
	}


	/**
	 * Widget Sidebar
	 * -------------------------------------------------------------------------------------
	 */
	public  function sidebar($param = NULL) {
		$data = array();
		return $this->load->widget('sidebar', $data);
	}

	public  function header($param = NULL) {
		$data = array();
		return $this->load->widget('header', $data);
	}

	public  function aside($param = NULL) {
		$data = array();
		return $this->load->widget('aside', $data);
	}

	/**
	 * Widget REGISTRASI TAMU
	 * -------------------------------------------------------------------------------------
	 */
	public function list_room($param = NULL) {
   $data = $param == NULL?array():$param;
   return $this->load->widget('list_room', $data);
  }

	public function data_tamu($param = NULL) {
 	 $data = $param == NULL?array():$param;
 	 return $this->load->widget('registrasi/data_tamu', $data);
 	}

	public function tamu_menginap($param = NULL) {
 		$data = array();
 		return $this->load->widget('registrasi/tamu_menginap', $data);
 	}

	public function checkin_registrasi($param = NULL) {
	 $data = array();
	 return $this->load->widget('registrasi/checkin_registrasi', $data);
	}

	public function checkout_registrasi($param = NULL) {
	 $data = array();
	 return $this->load->widget('registrasi/checkout_registrasi', $data);
	}

	/**
	 * Widget Sidebar
	 * -------------------------------------------------------------------------------------
	 */
	public  function topmenu($param = NULL) {
		$param = (object) $param;
		$data[] = "";
		$typeAdmin = $this->session->userdata('role_data');
		$data['menuRule'] =$this->menuRule($typeAdmin);
		return $this->load->widget('topmenu', $data);
	}

	public function sidemenu($param = NULL){
		$data = array();
		return $this->load->widget('sidemenu/list_penjualan_obat_harian', $data);
	}

	public function sidemenuStokObat($param = NULL){
		$data = array();
		return $this->load->widget('sidemenu/list_laporan_stok_obat', $data);
	}

	private function menuRule($typeAdmin) {
	    switch ($typeAdmin) {
	        case  ROLE_SUPERADMIN :
	            $menuPermission['dashboard'] = "";
	            $menuPermission[''] = "hide";
	            $menuPermission[''] = "hide";
	            $menuPermission[''] = "hide";
	            return  (object) $menuPermission;
	            break;
	        case  "admin" :
	            $menuPermission['dashboard'] = "hide";
	            $menuPermission[''] = "hide";
	            $menuPermission[''] = "hide";
	            $menuPermission[''] = "hide";
	            return  (object) $menuPermission;
	            break;
	    }
	}

	/**
	 * Gobo Widget popub
	 * -------------------------------------------------------------------------------------
	 */
public  function wgB() {
		$data = array();
		return $this->load->widget('wg_b', $data);
	}

}
