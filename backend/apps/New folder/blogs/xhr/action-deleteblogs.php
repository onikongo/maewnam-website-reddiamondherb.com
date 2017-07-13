<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	//$get = $dbc->GetRecord("blogs","*","id='".$id."'");
	//$file  = '../../../../'.$get['photo'];
//	unlink($file);
	$dbc->Delete("blogs","id='".$id."'");
	
	echo json_encode(true);
	$dbc->Close();
?>