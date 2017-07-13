<?php
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$data = $dbc->GetRecord("orders","*","id='".$_REQUEST['id']."'");
	?>
<div id="boxrate" class="col-md-12 text-center" >
<form id="ratestar">
	<select class="form-control" id="status" name="status">
    	<option value="0" <?php echo($data['status']==0)?'selected':'';?>>Waiting</option>
        <option value="1" <?php echo($data['status']==1)?'selected':'';?>>Ready</option>
        <option value="2" <?php echo($data['status']==2)?'selected':'';?>>Purchased</option>
        <option value="3" <?php echo($data['status']==3)?'selected':'';?>>Cancel</option>
    </select>
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
 </form>   
</div>

