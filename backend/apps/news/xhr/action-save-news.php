<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	$title = $_REQUEST['tx_Title'].'|'.$_REQUEST['tx_Titleth'];
	$detail = $_REQUEST['tx_Detail'].'|'.$_REQUEST['tx_Detailth'];
	
	$data = array(
		'#id' => 'DEFAULT',
		'headline' => $title,
		'detail' => base64_encode($detail),
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		'#status' => 0,
		// 'photo' => $_REQUEST['txtIcon'],
		'photo' => $_REQUEST['txtphoto'],
		'category' =>$_REQUEST['txtcate']
	); 


	
	if($dbc->Insert("news",$data))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>