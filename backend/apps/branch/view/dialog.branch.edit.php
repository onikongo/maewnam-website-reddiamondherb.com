<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("branch","*","id='".$id."'");
	$title = explode("|",$edit['name']);
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">สาขา</a> / แก้ไข</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">สาขา</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetailEdit">
            	<input type="hidden" name="txtID" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ภูมิภาค</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sec" name="sec">
                        <?php 
						$sqlb = $dbc->Query("select * from sector");
						while($rowb = $dbc->Fetch($sqlb))
						{
							?><option value="<?php echo $rowb['id'];?>" <?php echo($rowb['id']==$edit['sector'])?'selected':'';?>><?php echo explode("|",$rowb['name'])[0];?></option><?php
						}
						?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (EN)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Title" name="tx_Title" value="<?php echo $title[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (TH)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Titleth" name="tx_Titleth" value="<?php echo $title[1];?>">
                    </div>
                </div>
            </form>
		
            
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.branch.updatebranch()">Save</button>
                        <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                    </div>
                </div>
                <div id="output"></div>         
             
       </div>
  </div>
</div>



