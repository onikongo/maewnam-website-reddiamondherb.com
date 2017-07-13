<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM users WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);	
?>
<br>
<form id="form_edituser" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtName" name="txtName" placeholder="User Name" value="<?php echo $line['name'];?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtPassword" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Type to Change Password">
		</div>
	</div>
	<div class="form-group">
		<label for="cbbStatus" class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-5">
	    	<select id="cbbStatus" name="cbbStatus" class="form-control">
				<option value="0"<?php if($line['status']==0)echo " selected";?>>Inactive</option>
				<option value="1"<?php if($line['status']==1)echo " selected";?>>Active</option>
				<option value="2"<?php if($line['status']==2)echo " selected";?>>Lock</option>
				<option value="3"<?php if($line['status']==3)echo " selected";?>>Cannot Delete</option>
			</select>
	    </div>
	</div>
	<div class="form-group">
		<label for="cbbGroup" class="col-sm-2 control-label">Group</label>
	    <div class="col-sm-5">
	    	<select id="cbbGroup" name="cbbGroup" class="form-control">
<?php
	$gid = $line['gid'];
	$sql="SELECT id,name FROM groups";
	$rst = $dbc->Query($sql);
	while($line = $dbc->Fetch($rst)){
		echo '<option value="'.$line['id'].'"'.($line['gid']==$gid?" selected":"").'>'.$line['name'].'</option>';
	}						
?>
			</select>
	    </div>
	</div>
</form>