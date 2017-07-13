<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
		
	$data = array(
		'#id' => 'DEFAULT',
		// 'photo' => $_REQUEST['txtIcon'],
		'photo' => $_REQUEST['txtphoto'],
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		'#status' => 0,
		'#sort' => 0
	); 
	
	if($dbc->Insert("slide_photo",$data))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>