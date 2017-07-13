<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	
	$json = array();
	foreach($_REQUEST['items'] as $item){
		//array_push($json,$item);
		//echo $item['id'].'----'.$item['vals'].'<br>';
		$data = array(
			'#sort' => $item['vals']
		);
		$dbc->Update("slide_photo",$data,"id = '".$item['id']."'");
	}
?>