<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		$data = array(
			'name' => $_REQUEST['tx_name'],
			'detail' => $_REQUEST['txtDetail'],
			'#updated' => 'NOW()',
			'icon' => $_REQUEST['txticon'],
			'#status' => $_REQUEST['selstatus'],
			'#sort_order' => $_REQUEST['tx_sort'],
			'#category' => $_REQUEST['parent'],
		);
		if($dbc->Update("subcategory",$data,"id=".$_REQUEST['txtID'])){
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