<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$name = $_REQUEST['txtTitle']."|".$_REQUEST['txtTitleth'];
	$detail = $_REQUEST['txtDes']."|".$_REQUEST['txtDesth'];
	$data = array(
		'title' => $name,
		'detail' => base64_encode($detail),
		'#updated' => 'NOW()',
		'status' => '1'
	); 
	
	if($dbc->Update("product_information",$data,"id=1"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>