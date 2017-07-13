<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("news","headline = '".$_REQUEST['tx_Headlind']."' ")){//and lname = '".$_REQUEST['txtlName']."' and email = '".$_REQUEST['txtemail']."' 
		echo json_encode(array(
			'success'=>false,
			'msg'=>'headline is already exist.'
		));
	}else{
		
		
		$data = array(
			'#id' => "DEFAULT",
			'headline' => $_REQUEST['tx_Headlind'],
			'detail' => $_REQUEST['txtDetail'],
			'#created' => 'NOW()',
			'expired' => $_REQUEST['tx_exp'],
			'setting' => json_encode($_REQUEST['txticon'],true),
			'#priority' => $_REQUEST['priority'],
			'startDate' => $_REQUEST['tx_sdate'],
			'startTime' => $_REQUEST['tx_stime'],
			'endtime' => $_REQUEST['tx_etime']
		);
		if($dbc->Insert("news",$data)){
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