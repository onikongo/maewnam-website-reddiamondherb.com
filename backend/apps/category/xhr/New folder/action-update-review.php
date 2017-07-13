<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$data = array(
		'photo' => $_REQUEST['parth'],
		'#updated' => 'NOW()',
		
	); 
	$name = $_REQUEST['tx_name'].'|'.$_REQUEST['tx_nameth'];
	$title = $_REQUEST['tx_Title'].'|'.$_REQUEST['tx_Titleth'];
	$Briefth = $_REQUEST['tx_Briefth'].'|'.$_REQUEST['tx_Briefth'];
	$detail = $_REQUEST['tx_Detail'].'|'.$_REQUEST['tx_Detailth'];
	
	$data = array(
		'name' => $name,
		'title' => $title,
		'brief' => $Briefth,
		'detail' => base64_encode($detail),
		'image' => isset($_REQUEST['parth'])?$_REQUEST['parth']:'',
		'embed' => isset($_REQUEST['tx_Embed'])?$_REQUEST['tx_Embed']:'',
		'#updated' => 'NOW()'
		//'type' => $_REQUEST['sel_type']
	); 

	if($dbc->Update("review",$data,"id='".$_REQUEST['txtID']."'"))
	{
		echo json_encode(true);
	}
	else
	{
		echo json_encode(false);
	}
		
?>