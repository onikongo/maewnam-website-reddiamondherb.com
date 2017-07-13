<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("users","name = '".$_REQUEST['txtName']."' AND id != ".$_REQUEST['txtID'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Group Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_REQUEST['txtName'],
			'#status' => $_REQUEST['cbbStatus'],
			'#gid' => $_REQUEST['cbbGroup'],
			'#updated' => 'NOW()'
		);
		
		if($_REQUEST['txtPassword'] != "")$data['#password'] = "PASSWORD('".$_REQUEST['txtPassword']."')";
		
		if($dbc->Update("users",$data,"id=".$_REQUEST['txtID'])){
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
	}
	
	$dbc->Close();
?>