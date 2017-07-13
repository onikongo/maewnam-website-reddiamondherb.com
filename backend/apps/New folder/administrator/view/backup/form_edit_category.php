<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM categories WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
?>
<br>
<form id="form_editcategory" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Name" value="<?php echo $line['name'];?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Detail</label>
		<div class="col-sm-10">
			<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"><?php echo $line['detail'];?></textarea>
		</div>
	</div>
</form>

<?php
	
	$dbc->Close();
