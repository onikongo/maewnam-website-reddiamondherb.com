<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	//echo 'hello world';
	
	$save_dir = "../../../../upload/news";
		//if(!file_exists($save_dir))
//		{
//			mkdir($save_dir);
//		}
		$times = time(' H:i:s');
		$picName = date('Y-m-d ').$times.".jpg";
		$save_path = "$save_dir/$picName" ;
		if(move_uploaded_file($_FILES["upfile_2"]["tmp_name"],$save_dir.'/'.$picName))
		{
			$save_dir = "/upload/news";
			$location = $save_dir.'/'.$picName;
			echo $location;
			
		}
		
?>