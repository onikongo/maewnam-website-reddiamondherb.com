<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
		
	$data = array(
		// 'photo' => $_REQUEST['txtIcon'],
		'photo' => $_REQUEST['txtphotoEdit'],
		'#updated' => 'NOW()',
		'#status' => 0
	); 
	
	if($dbc->Update("slide_photo",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>