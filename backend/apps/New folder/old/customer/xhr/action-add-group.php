<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		$json= array();
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'setting' => json_encode($_REQUEST['txtDetail'],true)
		);
		
		if($dbc->Insert("customer_group",$data)){
			echo json_encode(array(
				'success'=>true,
				'msg'=> $dbc->GetID()
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	
	$dbc->Close();
?>