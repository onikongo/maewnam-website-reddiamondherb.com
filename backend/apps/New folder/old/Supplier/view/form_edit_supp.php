<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$supp = $dbc->GetRecord("suppliers","*","id='".$_REQUEST['id']."'");
	
?>
<form id="edit_supp" class="form-horizontal">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
    <div class="form-group">
        <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txttax" name="sup_Name" placeholder="Tax ID" value="<?php echo $supp['name'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="txtName" class="col-sm-2 control-label">Tax ID</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txttax" name="txttax" placeholder="Tax ID" value="<?php echo $supp['taxid'];?>">
        </div>
    </div>
    
</form>