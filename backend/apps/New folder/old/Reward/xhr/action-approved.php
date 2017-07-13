<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$id = $_REQUEST['id'];
	$dis = $_REQUEST['dis'];
	
	if(isset($dis))
	{
		$data = array(
			'#updated' => 'NOW()',
			'#status' => '0',
			'#approve' => 'NULL'
		);
		
		if($dbc->Update("rewards",$data,"id='".$id."'"))
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
		$data = array(
			'#updated' => 'NOW()',
			'#status' => '1',
			'#approve' => 'NOW()'
		);
		
		if($dbc->Update("rewards",$data,"id='".$id."'"))
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