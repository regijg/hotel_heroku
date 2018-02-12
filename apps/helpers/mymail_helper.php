<?php
function sendMail() {
	$instance = & get_instance ();
	$instance->load->library ( 'email' );
	$config ['protocol'] = "smtp";
	$config ['smtp_host'] = "ssl://smtp.gmail.com";
	$config ['smtp_port'] = "465";
	$config ['smtp_user'] = "";
	$config ['smtp_pass'] = "";
	$config ['charset'] = "utf-8";
	$config ['mailtype'] = "html";
	$config ['newline'] = "\r\n";
	$instance->email->initialize ( $config );
	
	$message = '';
	
	$instance->email->set_newline ( "\r\n" );
	$instance->email->from ( '.. ');
	$instance->email->to ( '..' );
	$instance->email->subject ( 'TEST SENDING EMAIL' );
	$instance->email->message ( $message );
	if ($instance->email->send ()) {
		$response ['error_code'] = 0;
		$response ['error_msg'] = 'Email sent';
		return json_encode ( $response );
	} else {
		$response ['error_code'] = 1;
		$response ['error_msg'] = $instance->email->print_debugger ();
	}
}