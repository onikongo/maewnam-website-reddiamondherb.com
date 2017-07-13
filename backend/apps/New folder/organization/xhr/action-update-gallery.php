<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$data = array(
		'photo' => $_REQUEST['parth'],
		'#updated' => 'NOW()',
		
	); 
	
	if($dbc->Update("gallery_photo",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>