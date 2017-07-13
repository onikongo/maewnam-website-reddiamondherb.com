<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
?>
<br>
<form id="form_adduser" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtName" name="txtName" placeholder="User Name">
		</div>
	</div>
	<div class="form-group">
		<label for="txtPassword" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<label for="cbbStatus" class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-5">
	    	<select id="cbbStatus" name="cbbStatus" class="form-control">
				<option value="0">Inactive</option>
				<option value="1" selected>Active</option>
				<option value="2">Lock</option>
				<option value="3">Cannot Delete</option>
			</select>
	    </div>
	</div>
	<div class="form-group">
		<label for="cbbGroup" class="col-sm-2 control-label">Group</label>
	    <div class="col-sm-5">
	    	<select id="cbbGroup" name="cbbGroup" class="form-control">
<?php
	$sql="SELECT id,name FROM groups";
	$rst = $dbc->Query($sql);
	while($line = $dbc->Fetch($rst)){
		echo '<option value="'.$line['id'].'">'.$line['name'].'</option>';
	}						
?>
			</select>
	    </div>
	</div>
</form>