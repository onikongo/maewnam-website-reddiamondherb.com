<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$name = $_REQUEST['txtTitle']."|".$_REQUEST['txtTitleth'];
	$desc = $_REQUEST['txtDesc']."|".$_REQUEST['txtDescTH'];
	$data = array(
		'name' => $name,
		'detail'=> $desc,
		'#updated' => 'NOW()',
		'setting' => $_REQUEST['parth']
	); 
	
	if($dbc->Update("products",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>