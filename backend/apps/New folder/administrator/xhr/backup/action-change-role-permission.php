<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$json = json_decode(file_get_contents("../../../../config/system.json"),true);
	
	$dbc->Update("roles",array("allow"=>""),"1");
	foreach($json['roles'] as $role){
		if(isset($_REQUEST[$roles])){
			$s = "";
			foreach($_REQUEST[$roles] as $item){
				if($s == ""){
					
				}else{
					
				}
			}
		}
		
		
		
		echo '<th>'.$role['name'].'</td>';
	
	}
				
			?>
	}
	
	
		$data = array(
			'name' => $_REQUEST['txtName'],
			'#updated' => 'NOW()'
		);
		
		if($dbc->Update("roles",$data,"id=".$_REQUEST['txtID'])){
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