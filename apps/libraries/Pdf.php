<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
require_once 'assets/inc/tcpdf/tcpdf.php';

/**
 * 
 * @author omapslab
 *
 */
class Pdf extends TCPDF {
	
	function __construct() {
		parent::__construct ();
	}
	
}