<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$name = $_REQUEST['txtTitleEv']."|".$_REQUEST['txtTitleEvth'];
	$detail = $_REQUEST['txtDesEv']."|".$_REQUEST['txtDesEvth'];
	$sub = $_REQUEST['txtSubEv']."|".$_REQUEST['txtSubEvth'];
	$data = array(
		'title' => $name,
		'subtitle' => $sub,
		'detail' => base64_encode($detail),
		'photo' => $_REQUEST['parth'],
		'image' => $_REQUEST['parth_2'],
		'#updated' => 'NOW()',
	); 
	
	if($dbc->Update("sub_about",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(array(
			'success' => true,
			'id' => $_REQUEST['txtID']
		),true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>