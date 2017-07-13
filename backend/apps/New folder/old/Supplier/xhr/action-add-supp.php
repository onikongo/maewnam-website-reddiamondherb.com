<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("branches","code='".$_REQUEST['name']."'"))
	{
		echo json_encode(false,true);
	}
	else
	{
		$data = array(
			'#id' => 'DEFAULT',
			'name' => $_REQUEST['sup_Name'],
			'#created' => 'NOW()',
			//'contact' => $idcon,
			'taxid' => $_REQUEST['txttax']
		);
		  $dbc->Insert("suppliers",$data);
		echo json_encode(true,true);
	}
	
	$dbc->Close();
?>