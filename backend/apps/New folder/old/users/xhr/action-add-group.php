<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("groups","name='".$_REQUEST['name']."'"))
	{
		echo json_encode(false);
	}
	else
	{
		
		$data = array(
			'#id' =>  'DEFAULT',
			'name' =>  $_REQUEST['name'],
			'#status' =>  '1',
			'#created' =>  'NOW()'
		);
		if($dbc->Insert("groups",$data))
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