<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$title = $_REQUEST['tx_Title'].'|'.$_REQUEST['tx_Titleth'];

	
	$data = array(
		'name' => $title,
		'sector' => $_REQUEST['sec'],
		'#updated' => 'NOW()',
	); 
	
	if($dbc->Update("branch",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>