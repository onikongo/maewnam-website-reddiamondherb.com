<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("categories","name = '".$_REQUEST['txtName']."' ")){//and lname = '".$_REQUEST['txtlName']."' and email = '".$_REQUEST['txtemail']."' 
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Categories Name is already exist.'
		));
	}else{
		
		$youtube = array();
		foreach($_REQUEST['txtYoutube'] as $utube)
		{
			//echo $utube;
			array_push($youtube,$utube);
		}
		$photo = array();
		foreach($_REQUEST['txtPhoto'] as $img)
		{
			array_push($photo,$img);
		}
		$photo_header = array();
		foreach($_REQUEST['txtPhoto2'] as $img_header)
		{
			array_push($photo_header,$img_header);
		}
		
		//$photo_slide = array();
//		foreach($_REQUEST['txtPhoto_slide'] as $img_slide)
//		{
//			array_push($photo_slide,$img_slide);
//		}
		
		$media = array(
			"img_main" => $photo,
			//"img_sub" => $_REQUEST['txtPhotoSub'],
			"img_avertise_0" => $_REQUEST['img_avertise_0'],
			"img_avertise_1" => $_REQUEST['img_avertise_1'],
			"img_avertise_2" => $_REQUEST['img_avertise_2'],
			"img_avertise_3" => $_REQUEST['img_avertise_3'],
			"youtube" =>  $youtube
		);
		
		$nam = $_REQUEST['txtName'].'|'.$_REQUEST['txtName_th'];
		$des = $_REQUEST['txtDetail'].'|'.$_REQUEST['txtDetail_th'];
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $nam,
			'detail' => $des,
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'icon' => $_REQUEST['txtIcon'],
			'#status' => $_REQUEST['cbbStatus'],
			'media' => json_encode($media),
			'#sort_order' => 10,
			'color_code' => $_REQUEST['txtColor'],
			'photo_header' => json_encode($photo_header)
			//'photo_slide' =>  json_encode($photo_slide),
//			'advertisement' => $_REQUEST['txtads']
		);
		
		
		if($dbc->Insert("categories",$data)){
			$id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true
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