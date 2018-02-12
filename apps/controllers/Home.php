<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';

/**
 * @author Regijg
 */
class Home extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('DashboardModel','', TRUE);
		$this->load->model('ReservasiModel','', TRUE);
		$this->widget = new Widget ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */
	public function index() {
		// Load widget
		$widget = array (
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside()
		);

		// Push Data
		$data[] = "";
		$data['widget'] = ( object ) $widget;
		$data['countDataRegistrasi'] = $this->DashboardModel->countDataRegistrasi();
		$data['countDataCheckin'] = $this->DashboardModel->countDataCheckin();
		$data['countDataCheckout'] = $this->DashboardModel->countDataCheckout();
		$data['countDataReservasi'] = $this->DashboardModel->countDataReservasi();
		$data['countDataReservasiCheckinHariIni'] = $this->DashboardModel->countDataReservasiCheckinHariIni();
		$data['countDataReservasiCheckoutHariIni'] = $this->DashboardModel->countDataReservasiCheckoutHariIni();
		$data['jumlahKamarKotor'] = $this->DashboardModel->jumlahKamarKotor();
		$data['jumlahKamarRusak'] = $this->DashboardModel->jumlahKamarRusak();
		$data['rencanaCheckinHariIni'] = $this->DashboardModel->rencanaCheckinHariIni()->result();
		$data['rencanaCheckoutHariIni'] = $this->DashboardModel->rencanaCheckoutHariIni()->result();
		$data['jumlahKamarTipeSuperiorRoom'] = $this->DashboardModel->jumlahKamarTipeSuperiorRoom();
		$data['jumlahKamarTipeDeluxeRoom'] = $this->DashboardModel->jumlahKamarTipeDeluxeRoom();
		$data['jumlahKamarTipeJuniorSuite'] = $this->DashboardModel->jumlahKamarTipeJuniorSuite();
		$data['jumlahKamarTipeExecutiveSuite'] = $this->DashboardModel->jumlahKamarTipeExecutiveSuite();
		$data['jumlahKamarTipeDeluxeRoomRoyal'] = $this->DashboardModel->jumlahKamarTipeDeluxeRoomRoyal();
		$data['jumlahKamarTipeJuniorSuiteRoyal'] = $this->DashboardModel->jumlahKamarTipeJuniorSuiteRoyal();
		$data['jumlahKamarTipeExecutiveSuiteRoyal'] = $this->DashboardModel->jumlahKamarTipeExecutiveSuiteRoyal();
		$data['jumlahKamarTipeDiplomaticSuite'] = $this->DashboardModel->jumlahKamarTipeDiplomaticSuite();
		$data['jumlahKamarTipePresidentialSuite'] = $this->DashboardModel->jumlahKamarTipePresidentialSuite();
		$data['roomListStatus'] = $this->db->query('select * from tbl_room where room_status = 3 ')->result();
		$this->load->tpl ( 'dasboard', $data );
	}

}
