<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if($dbc->HasRecord("products","name='".$_REQUEST['txtTitle']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Title is already exist.'
		));
	}else{
		
		$desc = $_REQUEST['txtDetail']."|".$_REQUEST['txtDetailTH'];
		$titles = $_REQUEST['txtTitle']."|".$_REQUEST['txtTitleTH'];

		$price = array(
			"price"  => $_REQUEST['txtPrice'],
			"discount" => $_REQUEST['txtDiscount'],
			"discount_percentage" => ($_REQUEST['txtDiscountPercentage']/100),
			"commission" => $_REQUEST['txtCommission'],
			"commission_percentage" => ($_REQUEST['txtCommissionPercentage']/100),
			"salling_price" => $_REQUEST['txtSellingPrice']
		);
		
		$media = array(
			"photo" => $_REQUEST['txtPhoto'],
			"video" => "",
			"document" => ""
		);
		
		$data = array(
			//'#id' => "DEFAULT",
			'name' => $titles,
			'detail' => $desc,
			//'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#price' => $_REQUEST['txtPrice'],
			'#discount' => $_REQUEST['txtPrice']-$_REQUEST['txtSellingPrice'],
			'point' => $_REQUEST['txtPoint'],
			//'#status' => 0,
			'setting' => json_encode($price),
			'#category' => $_REQUEST['cbbCategory'],
			'#subcategory' => $_REQUEST['cbbSubcategory'],
			'#supplier' => $_REQUEST['txtsuppid'],
			//'#view' => 0,
			"media" => json_encode($media),
			'#user' => $_SESSION['auth']['user_id']
		);
		
		if(isset($_REQUEST['chkNoexpire'])){
			$data['#expire'] = "NULL";
		}else{
			$data['expire'] = $_REQUEST['txtExpire'];
		}
		
		$insert_pro = $dbc->Update("products",$data,"id='".$_REQUEST['proID']."'");
		//$proID = $dbc->GetID();
		
		
		
		
		if(!isset($_REQUEST['schedule']))
		{
		}
		else
		{
			foreach($_REQUEST['schedule'] as $schedule){
				$branch = $schedule['branch'];
				$start = $schedule['start'];
				$end = $schedule['end'];
				$seat = $schedule['seat'];
				
				$data = array(
					"#id" => "DEFAULT",
					"#product" => $_REQUEST['proID'],
					"#branch" => $branch,
					"start" => $start,
					"end" => $end,
					"schedule" => json_encode(isset($schedule['schedule'])?$schedule['schedule']:[]),
					"exception" => json_encode(isset($schedule['exception'])?$schedule['exception']:[]),
					"#available" => $seat,
					"occupied" => 0,
					"comment" => ""
				);
				$insert_period = $dbc->Insert("periods",$data);
			}
		
		}
		
		
		echo json_encode(array(
			'success'=>true
		));
	}
	$dbc->Close();
?>