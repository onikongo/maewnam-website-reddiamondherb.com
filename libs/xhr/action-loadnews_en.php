<?php
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$lang = 0;
	
	$id = $_REQUEST['id'];
	
	$data = $dbc->GetRecord("news","*","id='".$id."'");
	$title = explode("|",$data['headline']);
	$detail = base64_decode($data['detail']);
	$det = explode("|",$detail);
	
?><center><h1 class="fon22 fon_dark"><?php echo $title[$lang];?></h1></center>
                <div class="col-md-12 txt_horizental fon_color fon20 txt_just">
                	<?php echo $det[$lang];?>
                    
                </div><!--<a href="http://www.reddiamondherb.com">www.reddiamondherb.com</a>-->