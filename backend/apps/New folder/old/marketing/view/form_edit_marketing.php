<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM news  WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
/*	if(!$dbc->HasRecord("contacts","id='".$line['contact']."'"))
	{
		$contact=='0';
	}
	else
	{
		$contact = $dbc->GetRecord("contacts","*","id=".$line['contact']);
		$address = $dbc->GetRecord("address","*","contact=".$line['contact']." AND priority = 1");
	}
*/	
?>
<br>
<script>
$(document).ready(function(e) {
    //$( 'textarea.editor' ).ckeditor();
});/*fn.app.supplier.initial(
	"#edit_customer #cbbCountry",
	"#edit_customer #cbbProvince",
	"#edit_customer #cbbDistrict",
	"#edit_customer #cbbSubdistrict");
	$(document).ready(function(e) {
		$("#backs").click(function(e) {
		window.location = '?app=customer';
	});
});
*/</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Customer </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Customer</a></li>
  
  <a id="backs"  href="javascript:window.location = '?app=marketing'" class="pull-right btn btn-danger">
  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close
  </a>
  <a id="save" onClick="fn.app.marketing.update_marketing()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Edit Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 

<form id="edit_marketing" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
<!--<div class="form-group">-->
			<div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-4">
                    <img id="icon" src="<?php echo json_decode($line['setting'],true);?>" class="img-responsive" style="border:1px solid #999;">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txticon" name="txticon" value="<?php echo json_decode($line['setting'],true);?>">
                </div>
                <div class="col-sm-2">
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.marketing.dialog_thumb.open_elfinder();">Browse</div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Headlind</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_Headlind" name="tx_Headlind" value="<?php echo $line['headline'];?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Detail</label>
                <div class="col-sm-10">
                    <textarea  class="form-control editor" id="txtDetail" name="txtDetail" placeholder="Detail"><?php echo $line['detail'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Start date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tx_sdate" name="tx_sdate" value="<?php echo $line['startDate'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Start time</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="tx_stime" name="tx_stime" value="<?php echo $line['startTime'];?>">
                </div>
                <label for="inputEmail3" class="col-sm-2 control-label">End time</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="tx_etime" name="tx_etime" value="<?php echo $line['endtime'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Expiration Date</label>
                <div class="col-sm-10">
                	<input type="date" class="form-control" id="tx_exp" name="tx_exp" value="<?php echo $line['expired'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Priority</label>
                <div class="col-sm-10">
                	<select id="priority" name="priority" class="form-control">
                    	<option value="1" <?php echo ($line['priority']=='1')?'selected':'';?>>Main</option>
                        <option value="2" <?php echo ($line['priority']=='2')?'selected':'';?>>Normal</option>
                    </select>
                </div>
            </div>

</form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>
<?php
	
	$dbc->Close();
