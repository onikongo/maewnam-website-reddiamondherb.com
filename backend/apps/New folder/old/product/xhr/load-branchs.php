<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$sup = $_REQUEST['id'];
?>	<div class="col-md-11" style="padding:0px;">
    <select class="form-control col-md-10" id="choose_branch" name="choose_branch">
		<?php
		$getsup = $dbc->GetRecord("branches","id","supplier = '".$sup."' ");
        $br = $dbc->Query("select * from branches where supplier = '".$sup."' ");
        while($row = $dbc->Fetch($br))
        {
            ?><option value="<?php echo $row['id'];?>" <?php echo($row['id']==$getsup['id'])?'selected':'';?>><?php echo $row['code'];?></option><?php
        }
        ?>
    </select>
    </div>
    <div class="col-md-1" style="padding:0px;">
    	<a id="plusbt" class="btn btn-default pull-right"><span class="glyphicon glyphicon-plus " aria-hidden="true"></span></a>
        <a id="minusbt" class="btn btn-default pull-right" style="display:none;"><span class="glyphicon glyphicon-minus " aria-hidden="true"></span></a>
    </div>
    <br>
    <div id="mores_br" class="col-md-12" style="display:none; margin-top:10px;">
        <div class="form-group">
            <label for="txtPhoto" class="col-sm-2 control-label">Branch Name</label>
            <div class="col-sm-8" style="padding:0px;">
            	<input type="hidden" name="idsuppiler" value="<?php echo $sup;?>">
                <input type="text" class="form-control" id="txt_branch_name" name="txt_branch_name" placeholder="Branch Name">
            </div>
        </div>
        <div class="form-group">
            <label for="txtPhoto" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-8" style="padding:0px;">
                <input type="text" class="form-control" id="txt_branch_location" name="txt_branch_location" placeholder="Location">
            </div>
        </div>
    </div>
		
        
     <script>
	$(document).ready(function(e) {
		$("#plusbt").click(function(e) {
			$("#mores_br").fadeIn(300);
			$("#plusbt").hide();
			$("#minusbt").fadeIn(300);
			$("#choose_branch").attr('disabled',true);
		 });
	 
		 $("#minusbt").click(function(e) {
			$("#mores_br").fadeOut(300);
			$("#minusbt").hide();
			$("#plusbt").fadeIn(300);
			$("#choose_branch").attr('disabled',false);
		 });
	});
	 </script>  
        
        
        
        
        
<?php $dbc->Close();?>