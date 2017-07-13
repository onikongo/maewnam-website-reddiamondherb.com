<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		
		//product
		
		$data = array(
			'#rates' => $_REQUEST['sta'],
			'#user' => $_SESSION['auth']['user_id']
		);
		$insert_pro = $dbc->Update("products",$data,"id='".$_REQUEST['txtID']."'");
		
	$dbc->Close();
?>