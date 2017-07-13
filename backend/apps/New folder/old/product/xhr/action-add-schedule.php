<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$name = $_REQUEST['name'];
	$total_data = array();
	foreach($_REQUEST['detail'] as $eachs)
	{
		//echo $eachs['startD'].'-'.$eachs['EndD'].'-'.$eachs['startT'].'-'.$eachs['EndT'].'-'.$eachs['Unit'].'<br>';
		$txDetails = array(
			'startDate' => $eachs['startD'],
			'endDate' => $eachs['EndD'],
			'start_Time' => $eachs['startT'],
			'end_Time' => $eachs['EndT'],
			'Unit' => $eachs['Unit']
		);
		array_push($total_data,$txDetails);
	}
	
	
	if($dbc->HasRecord("schedule","name = '".$name."'"))
	{
		echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
	}
	else
	{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['name'],
			'teacher' => $_REQUEST['teacher'],
			'date_start' => json_encode($total_data,true),
			/*'date_end' => json_encode($date_End,true),
			'time_start' => json_encode($time_Start,true),
			'time_end' => json_encode($time_End,true),
			'amount' => json_encode($amount,true),*/
			'#created' => 'NOW()',
			'#status' => '1'
		);
		
		if($dbc->Insert("schedule",$data)){
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