<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("products","name='".$_REQUEST['tx_title']."'"))
	{
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Title is already exist.'
		));
	}
	else
	{
		$json= array();
		
		
		$desc = $_REQUEST['tx_desc']."|".$_REQUEST['tx_title_th'];
		$titles = $_REQUEST['tx_title']."|".$_REQUEST['tx_title_th'];
		$extra = $_REQUEST['Bedrooms']."|".$_REQUEST['Media']."|".$_REQUEST['Bathrooms']."|".$_REQUEST['Floors']."|".$_REQUEST['Level']."|".$_REQUEST['Furnishing']."|".$_REQUEST['Facing'];
		
		$spacial = $_REQUEST['spa'];
		$fixfit = $_REQUEST['fixfit'];
		$door = $_REQUEST['door'];
		$fac = $_REQUEST['fac'];
		
		$special_data = array();
		foreach($_REQUEST['spa'] as $spe)
		{
			//echo $spe;
			array_push($special_data,$spe);
		}
				
		$fix = array();
		foreach($_REQUEST['fixfit'] as $fixf)
		{
			//echo $fixf;
			array_push($fix,$fixf);
		}
		
		$doors = array();
		foreach($_REQUEST['door'] as $doorot)
		{
			//echo $doorot;
			array_push($doors,$doorot);
		}
		
		$fac = array();
		foreach($_REQUEST['fac'] as $faci)
		{
			//echo $faci;
			array_push($fac,$faci);
		}
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $titles,
			'list_type' => $_REQUEST['listtype'],
			'property_type' => $_REQUEST['proptype'],
			'listing_title' => $titles,
			'listing_descript' => $desc,
			'price' => $_REQUEST['tx_price'],
			'tenure' => $_REQUEST['tx_tenure'],
			'sizes' => $_REQUEST['tx_size'],
			'building_dimension' => $_REQUEST['tx_dimension_w']."|".$_REQUEST['tx_dimension_h'],
			'extra_information' => $extra,
			'special_feature' => json_encode($special_data,true),
			'fixture_fitting' => json_encode($fix,true),
			'outdoor_space' => json_encode($doors,true),
			'facilities' => json_encode($fac,true),
			'#created' => 'NOW()',
			'exchange' => $_REQUEST['exchange'],
			'sqm' => $_REQUEST['tx_sqm'],
			'sqw' => $_REQUEST['tx_sqw'],
			'rai' => $_REQUEST['tx_rai']
		);
		$insert_pro = $dbc->Insert("products",$data);
		$proID = $dbc->GetID();
		
		
		$address = array(
			'#id' => "DEFAULT",
			'address' => $_REQUEST['propname']."|".$_REQUEST['street'],
			'#country' => $_REQUEST['cbbCountry'],
			'#city' => $_REQUEST['cbbProvince'],
			'#district' => $_REQUEST['cbbDistrict'],
			'#subdistrict' => $_REQUEST['cbbSubdistrict'],
			'postal' => $_REQUEST['postcode'],
			'#created' => 'NOW()',
			'#product' => $proID,
			'#priority' => '1',
			'location_map' => $_REQUEST['map']
		);
		$insert_add = $dbc->Insert("address",$address);
		
		if($_REQUEST['cho']=='upload')
		{
			$media = array(
				'#id' => "DEFAULT",
				'document' => $_REQUEST['txtDoc'],
				'video' => base64_encode($_REQUEST['txtvdo']."|".$_REQUEST['txtem']),
				'#created' => 'NOW()',
				'#status' => '1',
				'#product' => $proID,
				'video_photo' => $_REQUEST['txtvdoPhotos']
			);
		
		}
		else
		{
			$media = array(
				'#id' => "DEFAULT",
				'document' => $_REQUEST['txtDoc'],
				'video' => base64_encode($_REQUEST['txtvdo']."|".$_REQUEST['txtem']),
				'#created' => 'NOW()',
				'#status' => '1',
				'#product' => $proID
			);
		}
		
		
		if($dbc->Insert("medias",$media)){
			$id = $dbc->GetID();
			$dir = "../../../../upload/media/'".date('Y-m-d H:i:s')."'";
			//print_r($_REQUEST['txtPhoto']);
			$photos = array();
			foreach($_REQUEST['txtPhoto'] as $path){
				if(strpos($path,$dir)>-1){
					$src = "../../../../".$path;
					$dest = str_replace("upload/temp/","",$path);
					$dest =  $id."_".str_replace("/","_",date('Y-m-d H:i:s'))."/".str_replace("upload/temp/","",$path);
					rename($src, $dest);
					array_push($photos,str_replace("../../../../","",$dest));
				}else{
					array_push($photos,$path);
				}
			}
			
			$json = array(
				"photo" => $photos
			);
			
			$dbc->Update("medias", array(
				'photo' => json_encode($json,true)
			),"id='".$id."'");
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