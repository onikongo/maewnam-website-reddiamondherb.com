<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	foreach($_REQUEST['items'] as $item){
		$dbc->Delete("orders","id=".$item);
		$od = $dbc->GetRecord("order_detail","*","order_id = '".$item."'");
		$dbc->Delete("order_detail","id=".$od['id']);
		
	}
	
	$dbc->Close();
?>