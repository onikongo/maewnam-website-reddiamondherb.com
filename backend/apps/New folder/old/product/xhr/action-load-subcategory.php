<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sup = $_REQUEST['id'];
	$val = $_REQUEST['val'];
	
	if(isset($val))
	{
	
            $subcate = $dbc->Query("SELECT * FROM subcategory WHERE category = '".$sup."' ORDER BY id DESC");
            while($sc = $dbc->Fetch($subcate))
            {
                ?><option value="<?php echo $sc['id'];?>" <?php echo($sc['id']==$val)?'selected':'';?>><?php echo $sc['name'];?></option><?php
            }

	}
	else
	{

            $subcate = $dbc->Query("SELECT * FROM subcategory WHERE category = '".$sup."' ORDER BY id DESC");
            while($sc = $dbc->Fetch($subcate))
            {
                ?><option value="<?php echo $sc['id'];?>" ><?php echo $sc['name'];?></option><?php
            }

	}
	
	
	
	
	
	$dbc->Close();
?>