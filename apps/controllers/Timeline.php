<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';

/**
 * @author eResources/AID/AP
 */
class Timeline extends arisoft_id_core {
	
	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->widget = new Widget ();
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
				'topmenu' => $this->widget->topmenu($injectData) 
		);
		
		// Push Data
		$data['widget'] = ( object ) $widget;
		$this->load->tpl ( 'timeline', $data );
	}

}

