<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("branches","code='".$_REQUEST['name']."'"))
	{
		echo json_encode(false,true);
	}
	else
	{
		$data_con = array(
			'#id' => 'DEFAULT',
			//'title' => '',
			'name' => $_REQUEST['name'],
			//'surname' => $_REQUEST['sup_Name'],
			'email' => $_REQUEST['txtEmail'],
			'phone' => $_REQUEST['txtPhone'],
			'mobile' => $_REQUEST['txtMobile'],
			'#created' => 'NOW()',
			'#status' => '1'
		);
		$incon = $dbc->Insert("contacts",$data_con);
		$idcon = $dbc->GetID();
		
		$address = array(
			'#id' => "DEFAULT",
			'address' => $_REQUEST['txtAddress'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbProvince'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#created' => 'NOW()',
			'#contact' => $idcon,
			'#priority' => '1'
		);
		$insert_add = $dbc->Insert("address",$address);
		$idadd = $dbc->GetID();
		
		$data = array(
			'#id' => 'DEFAULT',
			'code' => $_REQUEST['name'],
			'#supplier' => $_REQUEST['supplier'],
			'location' => $idcon,
			'#created' => 'NOW()',
			'#status' => '1',
			'latitude' => $_REQUEST['txtLatitude'],
			'longtitude' => $_REQUEST['txtLongtitude']
		);
		$dbc->Insert("branches",$data);
		echo json_encode(true,true);
	}
	
	$dbc->Close();
?>