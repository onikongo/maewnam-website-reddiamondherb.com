<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	$title = $_REQUEST['tx_Title'].'|'.$_REQUEST['tx_Titleth'];
	/* $detail = $_REQUEST['tx_Detail'].'|'.$_REQUEST['tx_Detailth']; */
	
	$data = array(
		'#id' => 'DEFAULT',
		'name' => $title,
		/* 'detail' => base64_encode($detail),
		'phone' => $_REQUEST['tx_phone'],
		'latitude' => $_REQUEST['tx_latiude'],
		'longtitude' => $_REQUEST['tx_long'], */
		'#created' => 'NOW()',
		'#updated' => 'NOW()',
		'#status' => 0,
		//'#sector' => 0,
		/* '#branch' => $_REQUEST['bran'] */
	); 


	
	if($dbc->Insert("news_categories",$data))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>