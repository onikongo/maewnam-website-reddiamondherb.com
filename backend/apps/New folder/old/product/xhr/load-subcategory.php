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
		?>
	<label for="txtName" class="col-sm-2 control-label">Product Subcategory*</label>
    <div class="col-sm-10">
        <select class="form-control" id="subcategory" name="subcategory">
        <?php
            $subcate = $dbc->Query("SELECT * FROM subcategory WHERE category = '".$sup."' ORDER BY id DESC");
            while($sc = $dbc->Fetch($subcate))
            {
                ?><option value="<?php echo $sc['id'];?>" <?php echo($sc['id']==$val)?'selected':'';?>><?php echo $sc['name'];?></option><?php
            }
        ?>
        </select>
    </div>
	<?php
	}
	else
	{
		?>
	<label for="txtName" class="col-sm-2 control-label">Product Subcategory*</label>
    <div class="col-sm-10">
        <select class="form-control" id="subcategory" name="subcategory">
        <?php
            $subcate = $dbc->Query("SELECT * FROM subcategory WHERE category = '".$sup."' ORDER BY id DESC");
            while($sc = $dbc->Fetch($subcate))
            {
                ?><option value="<?php echo $sc['id'];?>" ><?php echo $sc['name'];?></option><?php
            }
        ?>
        </select>
    </div>
	<?php
	}
	
	
	
	
	
	$dbc->Close();
?>