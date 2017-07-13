<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("users","PASSWORD = PASSWORD('".$_REQUEST['tx_old']."')"))
	{
		
		$data = array(
			'#password' => "PASSWORD('".$_REQUEST['tx_new']."')",
			'#updated' => 'NOW()'
		); 
	
		if($dbc->Update("users",$data,"id='1'"))
		{
			echo json_encode(true);
		}
		else
		{
			echo json_encode(false);
		}
	}
	else
	{
		echo json_encode(false);
	}
	
		
?>