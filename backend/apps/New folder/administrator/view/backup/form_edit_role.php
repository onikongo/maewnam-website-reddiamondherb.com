<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM roles WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
?>
<br>
<form id="form_editrole" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
	<div class="form-role">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Group Name" value="<?php echo $line['name'];?>">
		</div>
	</div>
</form>
<?php
	
	$dbc->Close();

?>