<?php
function sessTest() {
	$ci =& get_instance();
	$ci->session->userdata();
	
}