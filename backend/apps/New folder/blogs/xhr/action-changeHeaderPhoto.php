<?Php
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$file = $_REQUEST['txtPhoto'];

	$pix = array();
	foreach($file as $img)
	{
		array_push($pix,$img);
	}
	$data = array(
		'path' => json_encode($pix)
	);
	
	$dbc->Update("photos",$data,"id = '1' ");
	
	
	
	$dataAds = array(
		'path' => json_encode($_REQUEST['txtads'])
	);
	
	$dbc->Update("photos",$dataAds,"id = '2'");
	
		
	
	
	$fileslide = $_REQUEST['txtPhoto_slide'];
	$slide = array();
	foreach($fileslide as $imslide)
	{
		array_push($slide,$imslide);
	}
	$dataslide = array(
		'path' => json_encode($slide)
	);
	$dbc->Update("photos",$dataslide,"id = '3' ");
	
	
	
	
	echo json_encode(true);
	
	
	$dbc->Close();
?>







