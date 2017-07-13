<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

		$data = array(
			'headline' => $_REQUEST['tx_Headlind'],
			'detail' => $_REQUEST['txtDetail'],
			'#updated' => 'NOW()',
			'expired' => $_REQUEST['tx_exp'],
			'setting' => json_encode($_REQUEST['txticon'],true),
			'#priority' => $_REQUEST['priority'],
			'startDate' => $_REQUEST['tx_sdate'],
			'startTime' => $_REQUEST['tx_stime'],
			'endtime' => $_REQUEST['tx_etime']
		);
		if($dbc->Update("news",$data,"id=".$_REQUEST['txtID'])){
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