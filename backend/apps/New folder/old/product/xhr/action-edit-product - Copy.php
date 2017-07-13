<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	$json= array();
		//supplier
		if($_REQUEST['newsupp']=='newsupp')
		{
			if($dbc->HasRecord("suppliers","name = '".$_REQUEST['sup_Name']."'"))
			{
				$getsup = $dbc->GetRecord("suppliers","*","name = '".$_REQUEST['sup_Name']."'");
				$supplier = $getsup['id'];
			}
			else
			{
				$data_con = array(
					'#id' => 'DEFAULT',
					//'title' => '',
					'name' => $_REQUEST['sup_Name'],
					'surname' => $_REQUEST['sup_Name'],
					'email' => $_REQUEST['txtEmail'],
					'phone' => $_REQUEST['txtPhone'],
					'mobile' => $_REQUEST['txtMobile'],
					'#created' => 'NOW()',
					'#status' => '1'
				);
				$incon = $dbc->Insert("contacts",$data_con);
				$idcon = $dbc->GetID();
				
				
				$data_address = array(
					'#id' => 'DEFAULT',
					'address' => $_REQUEST['txtAddress'],
					'#country' => $_REQUEST['cbbCountry'],
					'#city' => $_REQUEST['cbbProvince'],
					'#district' => $_REQUEST['cbbDistrict'],
					'#subdistrict' => $_REQUEST['cbbSubdistrict'],
					'postal' => $_REQUEST['txtPostal'],
					'#created' => 'NOW()',
					'#contact' => $idcon,
					'#priority' => 1,
					'location' => $idcon
				);
				$inaddress = $dbc->Insert("address",$data_address);
				
				
				$data_sup = array(
					'#id' => 'DEFAULT',
					'name' => $_REQUEST['sup_Name'].'   '.$_REQUEST['sup_Name'],
					'#created' => 'NOW()',
					'#contact' => $idcon,
					'taxid' => $_REQUEST['txttax'],
				);
				$insup = $dbc->Insert("suppliers",$data_sup);
				$supplier = $dbc->GetID();
			}
		}
		else
		{
			$supplier = $_REQUEST['txtsuppid'] ;
		}
		
		
		//location
		$address = array(
			'address' => $_REQUEST['propname']."|".$_REQUEST['street'],
			//'#country' => $_REQUEST['cbb2Country'],
			'#city' => $_REQUEST['cbb2Province'],
			'#district' => $_REQUEST['cbb2District'],
			'#subdistrict' => $_REQUEST['cbb2Subdistrict'],
			'postal' => $_REQUEST['postcode'],
			'#updated' => 'NOW()',
			//'#product' => $proID,
			'location' => $_REQUEST['map']
		);
		$insert_add = $dbc->Update("address",$address,"id = '".$_REQUEST['addressID']."'");
		$idadd = $dbc->GetID();
		
		
		/*$tag = array();
		foreach($_REQUEST['bran'] as $brand)
		{
			if(in_array($tag,$brand))
			{
			}
			else
			{
				array_push($tag,$brand);
			}
			
		}*/
		
		
		//product
		$desc = $_REQUEST['tx_desc']."|".$_REQUEST['tx_title_th'];
		$titles = $_REQUEST['tx_title']."|".$_REQUEST['tx_title_th'];
		
		$price = array(
			"price"  => $_REQUEST['tx_price'],
			"discount" => $_REQUEST['tx_discount_bath'],
			"discount_percentage" => ($_REQUEST['tx_discount']/100),
			"commission" => $_REQUEST['tx_comm'],
			"commission_percentage" => ($_REQUEST['tx_percent']/100),
			"salling_price" => $_REQUEST['tx_salling']
		);
		
		$data = array(
			//'#id' => "DEFAULT",
			'name' => $titles,
			'detail' => $desc,
			'#created' => 'NOW()',
			'#price' => $_REQUEST['tx_price'],
			'#discount' => $_REQUEST['tx_discount'],
			'point' => $_REQUEST['tx_total'],
			'#status' => 0,
			'setting' => json_encode($price,true),
			'#category' => $_REQUEST['selcategory'],
			'subcategory' => $_REQUEST['subcategory'],
			//'#address' => $idadd,
			'#supplier' => $supplier,
			'exp' => $_REQUEST['tx_exp'],
			//'comm' => $_REQUEST['tx_comm'],
			//'percent' => $_REQUEST['tx_percent']
		);
		
		/*$data = array(
			'name' => $titles,
			'detail' => $desc,
			'#updated' => 'NOW()',
			'#price' => $_REQUEST['tx_price'],
			'#discount' => $_REQUEST['tx_discount'],
			'point' => $_REQUEST['tx_total'],
			//'setting' => $_REQUEST['listtype'],
			'#category' => $_REQUEST['selcategory'],
			'subcategory' => json_encode($tag,true),
			//'#subcategory' => $_REQUEST['proptype'],
			'#supplier' => $supplier,
			'exp' => $_REQUEST['tx_exp'],
			'comm' => $_REQUEST['tx_comm'],
			'percent' => $_REQUEST['tx_percent']
		);*/
		$insert_pro = $dbc->Update("products",$data,"id='".$_REQUEST['txtID']."'");
		$proID = $dbc->GetID();
		
		
		
			//schedule
			$week = array();
			if(isset($_REQUEST['sun'])){array_push($week,$_REQUEST['sun']);}
			if(isset($_REQUEST['mon'])){array_push($week,$_REQUEST['mon']);}
			if(isset($_REQUEST['tue'])){array_push($week,$_REQUEST['tue']);}
			if(isset($_REQUEST['wed'])){array_push($week,$_REQUEST['wed']);}
			if(isset($_REQUEST['thu'])){array_push($week,$_REQUEST['thu']);}
			if(isset($_REQUEST['fri'])){array_push($week,$_REQUEST['fri']);}
			if(isset($_REQUEST['sat'])){array_push($week,$_REQUEST['sat']);}
			
			$schedule = $_REQUEST['chk_schedule'];
			$totalTime = array(
				"start" => $_REQUEST['start_time_hour'],
				"end" => $_REQUEST['end_time_hour']
			);
			
			if($_REQUEST['period']=='')
			{
				if($_REQUEST['choose_branch']==''|| !isset($_REQUEST['choose_branch']))
				{
					$branch_data = array(
						"#id" =>  "DEFAULT",
						"code" =>  $_REQUEST['txt_branch_name'],
						"#supplier" => $_REQUEST['idsuppiler'],
						"location" =>  $_REQUEST['txt_branch_location'],
						"#created" =>  "NOW()",
						"#status" =>  "0",
					);
					echo 'new bra';
					if($dbc->HasRecord("branches","code='".$_REQUEST['txt_branch_name']."'"))
					{
						$datbr = $dbc->GetRecord("branches","*","code='".$_REQUEST['txt_branch_name']."'");
						$branchid = $datbr['id'];
					}
					else
					{
						$insert_branch = $dbc->Insert("branches",$branch_data);
						$branchid = $dbc->GetID();
					}
				}
				else
				{
					$branchid = $_REQUEST['choose_branch'];
				}
				
				$period_data = array(
					"#id" => "DEFAULT",
					"#product" => $_REQUEST['txtID'],
					"#branch" => $branchid,
					"start" => $_REQUEST['txt_startDate'],
					"end" => $_REQUEST['txt_endDate'],
					"classday" => json_encode($week,true),
					"classtime" => json_encode($totalTime,true),
					"exception" => $_REQUEST['txt_exception'],
					"available" => $_REQUEST['txt_seat']
					//"reserved" => $_REQUEST['chk_schedule']
				);
				$insert_period = $dbc->Insert("periods",$period_data);
				$periID = $dbc->GetID();
			}
			else
			{
				if($_REQUEST['choose_branch']=='' || !isset($_REQUEST['choose_branch']))
				{
					$branch_data = array(
						"#id" =>  "DEFAULT",
						"code" =>  $_REQUEST['txt_branch_name'],
						"#supplier" => $_REQUEST['idsuppiler'],
						"location" =>  $_REQUEST['txt_branch_location'],
						"#created" =>  "NOW()",
						"#status" =>  "0",
					);
					if($dbc->HasRecord("branches","code='".$_REQUEST['txt_branch_name']."'"))
					{
						$datbr = $dbc->GetRecord("branches","*","code='".$_REQUEST['txt_branch_name']."'");
						$branchid = $datbr['id'];
					}
					else
					{
						$insert_branch = $dbc->Insert("branches",$branch_data);
						$branchid = $dbc->GetID();
					}
				}
				else
				{
					$branchid = $_REQUEST['choose_branch'];
				}
				
				$period_data = array(
					//"#id" => "DEFAULT",
					//"#product" => $proID,
					"#branch" => $branchid,
					"start" => $_REQUEST['txt_startDate'],
					"end" => $_REQUEST['txt_endDate'],
					"classday" => json_encode($week,true),
					"classtime" => json_encode($totalTime,true),
					"exception" => $_REQUEST['txt_exception'],
					"available" => $_REQUEST['txt_seat']
					//"reserved" => $_REQUEST['chk_schedule']
				);
				$insert_period = $dbc->Update("periods",$period_data,"id=".$_REQUEST['period']);
				$periID = $_REQUEST['period'];
			}
			
			
		
		//inventoey		 
		$data_inven = array(
			'#schedule' => $periID//$schedule
		);
		$ins_inv = $dbc->Update("inventories",$data_inven,"id ='".$_REQUEST['inv']."'");
		
		
		//media
		
		if($_REQUEST['cho']=='upload')
		{
			$media = array(
				'document' => $_REQUEST['txtDoc'],
				'video' => base64_encode($_REQUEST['txtvdo']."|".$_REQUEST['txtem']),
				'#updated' => 'NOW()',
				'video_photo' => $_REQUEST['txtvdoPhotos']
			);
		
		}
		else
		{
			if($_REQUEST['txtem']=='')
			{
				$media = array(
					'document' => $_REQUEST['txtDoc'],
					//'video' => base64_encode($_REQUEST['txtvdo']."|".$_REQUEST['txtem']),
					'#updated' => 'NOW()'
				);
			}
			else
			{
				$media = array(
					'document' => $_REQUEST['txtDoc'],
					'video' => base64_encode($_REQUEST['txtvdo']."|".$_REQUEST['txtem']),
					'#updated' => 'NOW()'
				);
			}
			
		}
		
		
		if($dbc->Update("medias",$media,"id='".$_REQUEST['mediaID']."'")){
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
			),"id='".$_REQUEST['mediaID']."'");
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