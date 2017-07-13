<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM customers inner join customer_group on customers.cg_id = customer_group.cg_id WHERE c_id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
?>
<br>
<form id="edit_customer" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
<?php /*?>	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Gender</label>
		<div class="col-sm-10">
        	<select name="gender" id="gender" class="form-control" style="width:200px !important; float:left;">
            	<option value="0">Choose gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select> 
            <input type="text" value="<?php echo $line['gender'];?>" class="form-control" disabled="disabled" style="margin-left:10px;" />
		</div>
	</div>
<?php */?>    <div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtfName" name="txtfName" placeholder="Firstname" value="<?php echo $line['fname'];?>" style="float:left;">
            <input type="text" class="form-control" id="txtlName" name="txtlName" placeholder="Lastname" value="<?php echo $line['lname'];?>">
		</div>
	</div>
	<div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Tel no.</label>
		<div class="col-sm-10">
        	<input type="text" class="form-control" id="txttel" name="txttel" placeholder="Tel no." onkeydown="check('phone')" value="<?php echo $line['tel'];?>">
			<!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
		</div>
	</div>
    <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">E-mail</label>
		<div class="col-sm-10">
        	<input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="E-mail" value="<?php echo $line['email'];?>">
			<!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
		</div>
	</div>
    <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Address</label>
		<div class="col-sm-10">
			<textarea  class="form-control" id="txtaddress" name="txtaddress" placeholder="Detail"><?php echo $line['address'];?></textarea>
		</div>
	</div>
     <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Point</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtPoint" name="txtPoint" placeholder="E-mail" value="<?php echo $line['point'];?>">
		</div>
	</div>
     <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Status</label>
		<div class="col-sm-10">
        	<select id="status" name="status" class="form-control" style="width:200px !important; float:left;">
            	<option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
			<input type="text" class="form-control" id="txt" name="txtemail" disabled="disabled" placeholder="E-mail" value="<?php echo $line['status'];?>" style="margin-left:10px;">
		</div>
	</div>
   <?php 
	$sql = "SELECT * FROM customer_group";
				$rst = $dbc->Query($sql);
	?>
     <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Group</label>
		<div class="col-sm-10">
            <select id="group" name="group" class="form-control" style="width:200px !important; float:left;">
                <option value="0">Choose group</option><?php
                        while($line1 = $dbc->Fetch($rst))
                        {
                            ?><option value="<?php echo $line1['cg_id'];?>" ><?php echo $line1['cg_name'];?></option><?php
                        }
            ?></select>
            <input type="text" value="<?php echo $line['cg_name'];?>" disabled="disabled" class="form-control" style="margin-left:10px;" />
            </div>
	</div>

</form>

<?php
	
	$dbc->Close();
