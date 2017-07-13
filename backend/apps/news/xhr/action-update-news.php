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
		'headline' => $title,
		'detail' => base64_encode($detail),
		'#updated' => 'NOW()',
		// 'photo' => $_REQUEST['txtIcon'],
		'photo' => $_REQUEST['txtphotoEdit'],
		'category' => $_REQUEST['txtcate'],
		
	); 
	
	if($dbc->Update("news",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>