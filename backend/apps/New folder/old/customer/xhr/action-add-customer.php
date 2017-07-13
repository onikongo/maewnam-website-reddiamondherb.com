<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("customers","username = '".$_REQUEST['tx_email']."' ")){//and lname = '".$_REQUEST['txtlName']."' and email = '".$_REQUEST['txtemail']."' 
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Username Name is already exist.'
		));
	}else{
		
		$data_contact = array(
			'#id' => "DEFAULT",
			'title' => $_REQUEST['gender'],
			'name' => $_REQUEST['tx_name'],
			'surname' => $_REQUEST['tx_lname'],
			'dob' => $_REQUEST['year'].'-'.$_REQUEST['month'].'-'.$_REQUEST['date'],
			//'gender' => $_REQUEST['type'],
			'email' => $_REQUEST['tx_email'],
			'phone' => $_REQUEST['tx_tel'],
			'mobile' => $_REQUEST['tx_mobile'],
			'#joined' => 'NOW()',
			'#created' => 'NOW()',
			'#status' => '0',
			'citizen_id' => $_REQUEST['tx_id'],
		);
		$contact = $dbc->Insert("contacts",$data_contact);
		$conID = $dbc->GetID();
		
		/*$data_address = array(
			'#id' => "DEFAULT",
			'address' => $_REQUEST['txtaddress'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbProvince'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['txtPostal'],
			'#created' => 'NOW()',
			'#priority' => '1',
			'#contact' => $conID
		);
		$address = $dbc->Insert("address",$data_address);
		$addressID = $dbc->GetID();*/
		
		
		$json= array();
		$data = array(
			'#id' => "DEFAULT",
			//'code' => $_REQUEST['type'],
			'#contact' => $conID,
			'#created' => 'NOW()',
			'username' => $_REQUEST['tx_email'],
			'#password' => "PASSWORD('".$_REQUEST['tx_pass']."')",
			'#status' => 0,
			//'#group_id	' => $_REQUEST['cgroup']
			/*'setting' => base64_encode(json_encode($json))*/
		);
		//print_r($data);
		if($dbc->Insert("customers",$data)){
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