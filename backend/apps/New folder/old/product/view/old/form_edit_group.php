<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM customer_group WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
?>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Customer Group List </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Customer Group List</a></li>
  
  <a id="back" href="javascript:window.location = '?app=group'" class="pull-right btn btn-default"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>
  <a id="save" onClick="fn.app.customer.update_group()" class="pull-right btn btn-default"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Customer Group</h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 

<form id="edit_group" class="form-horizontal" role="form">
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
			<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"><?php echo json_decode($line['setting'],true);?></textarea>
		</div>
	</div>
</form>
    <!--panel--> 
    </div>
    </div>
</div>

</div><?php
	
	$dbc->Close();
