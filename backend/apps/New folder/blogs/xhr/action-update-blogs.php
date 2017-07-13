<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$name = $_REQUEST['txtTitle']."|".$_REQUEST['txtTitleth'];
	$sub = $_REQUEST['txtSub']."|".$_REQUEST['txtSubth'];
	$data = array(
		'headline' => $name,
		'detail' => $sub,
		'#updated' => 'NOW()',
		
	); 
	
	if($dbc->Update("blogs",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>