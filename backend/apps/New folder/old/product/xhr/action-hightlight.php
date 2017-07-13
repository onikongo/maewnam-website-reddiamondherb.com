<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		
		//product
	if($dbc->HasRecord("product_hightlight","product = '".$_REQUEST['id']."'")	)
	{
		$insert_pro = $dbc->Delete("product_hightlight","product='".$_REQUEST['id']."'");
	}
	else
	{
		$data = array(
			'#id' => 'DEFAULT',
			'#product' => $_REQUEST['id'],
			'#created' => 'NOW()',
			'#status' => 1,
		);
		$insert_pro = $dbc->Insert("product_hightlight",$data);
	}
		
		
		
	$dbc->Close();
?>