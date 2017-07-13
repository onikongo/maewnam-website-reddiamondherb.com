<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("subcategory","name = '".$_REQUEST['tx_name']."' ")){//and lname = '".$_REQUEST['txtlName']."' and email = '".$_REQUEST['txtemail']."' 
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Tag Name is already exist.'
		));
	}else{
		
				
		$json= array();
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['tx_name'],
			'detail' => $_REQUEST['txtDetail'],
			'#created' => 'NOW()',
			'icon' => $_REQUEST['txticon'],
			'#status' => $_REQUEST['selstatus'],
			'#sort_order' => $_REQUEST['tx_sort'],
			'#category' => $_REQUEST['parent'],
			/*'setting' => base64_encode(json_encode($json))*/
		);
		//print_r($data);
		if($dbc->Insert("subcategory",$data)){
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