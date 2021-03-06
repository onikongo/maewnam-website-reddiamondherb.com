<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$title = $_REQUEST['tx_title'];
	if($dbc->HasRecord("rewards","title='".$title."'"))
	{
		echo json_encode(false);
	}
	else
	{
		$photo = array();
		foreach($_REQUEST['txtPhoto'] as $img)
		{
			array_push($photo,$img);
		}
		
		$data = array(
			'#id' => 'DEFAULT',
			'title' => $_REQUEST['tx_title'],
			'detail' => $_REQUEST['detail'],
			'photo' => json_encode($photo),
			'point' => $_REQUEST['tx_point'],
			'expiration' => $_REQUEST['tx_exp'],
			'amount' => $_REQUEST['tx_amount'],
			'#created' => 'NOW()',
			'#status' => '0'
		);
		
		if($dbc->Insert("rewards",$data))
		{
			echo json_encode(true);
		}
		else
		{
			echo json_encode(false);
		}
		
	}
	
	$dbc->Close();
?>