<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM customers WHERE id=".$_REQUEST['txtID'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
	$json = json_decode(base64_decode($line['setting']),true);
	$con = $dbc->GetRecord("contacts","*","id='".$line['contact']."'");
	$address = $dbc->GetRecord("address","*","contact='".$line['contact']."'");
	
	$data_contact = array(
			'title' => $_REQUEST['gender'],
			'name' => $_REQUEST['tx_name'],
			'surname' => $_REQUEST['tx_lname'],
			'dob' => $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['date'],
			'gender' => $_REQUEST['type'],
			'email' => $_REQUEST['tx_email'],
			'phone' => $_REQUEST['tx_tel'],
			'mobile' => $_REQUEST['tx_mobile'],
			'#created' => 'NOW()',
			'citizen_id' => $_REQUEST['tx_id'],
		);
		$contact = $dbc->Update("contacts",$data_contact,"id='".$con['id']."'");
		
		/*$data_address = array(
			'address' => $_REQUEST['txtaddress'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbProvince'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#updated' => 'NOW()',
			'#contact' => $conID
		);
		$address = $dbc->Update("address",$data_address,"id='".$address['id']."'");*/
		
		
		$json= array();
		$data = array(
			//'type' => $_REQUEST['type'],
			'#contact	' => $conID,
			'#created	' => 'NOW()',
			'username	' => $_REQUEST['tx_email'],
			'#password' => "PASSWORD('".$_REQUEST['tx_pass']."')",
			'#status	' => '0',
			//'#group_id	' => $_REQUEST['cgroup']
			/*'setting' => base64_encode(json_encode($json))*/
		);
		if($dbc->Update("customers",$data,"id=".$_REQUEST['txtID'])){
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