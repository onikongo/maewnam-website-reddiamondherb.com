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
		'name' => $title,
		/* 'detail' => base64_encode($detail),
		'phone' => $_REQUEST['tx_phone'],
		'latitude' => $_REQUEST['tx_latiude'],
		'longtitude' => $_REQUEST['tx_long'], */
		'#updated' => 'NOW()',
		//'#sector' => 0,
		/* '#branch' => $_REQUEST['bran'] */
		
	); 
	
	if($dbc->Update("news_categories",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>