<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
		
		$data_con = array(
			'name' => $_REQUEST['sup_Name'],
			//'surname' => $_REQUEST['sup_Name'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#updated' => 'NOW()',
			'#status' => '1'
		);
		$incon = $dbc->Update("contacts",$data_con,"id='".$_REQUEST['conID']."'");
				
		$address = array(
			'address' => $_REQUEST['txtAddress'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbProvince'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#updated' => 'NOW()',
		);
		$insert_add = $dbc->Update("address",$address,"id='".$_REQUEST['addID']."'");
		
		$data = array(
			'code' => $_REQUEST['name'],
			'#supplier' => $_REQUEST['supplier'],
			'#updated' => 'NOW()',
			'latitude' => $_REQUEST['txtLatitude'],
			'longtitude' => $_REQUEST['txtLongtitude']
		);
		$dbc->Update("branches",$data,"id='".$_REQUEST['txtID']."'");
		echo json_encode(true,true);
	
	$dbc->Close();
?>