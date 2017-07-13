<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
	/*$("#sel_type").change(function(e) {
        if($(this).val()=='Photo')
		{
			$("#pho").slideDown(300);
			$("#embed").slideUp(300);
		}
		else
		{
			$("#pho").slideUp(300);
			$("#embed").slideDown(300);
		}
    });*/
});
</script>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">สาขา</a> / เพิ่ม</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">สาขา</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetail">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ภูมิภาค</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sec" name="sec">
                        <?php 
						$sqlb = $dbc->Query("select * from sector");
						while($rowb = $dbc->Fetch($sqlb))
						{
							echo '<option value="'.$rowb['id'].'">'.explode("|",$rowb['name'])[0].'</option>';
						}
						?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (EN)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Title" name="tx_Title" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (TH)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Titleth" name="tx_Titleth" >
                    </div>
                </div>
                
            </form>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.branch.savebranch()">Save</button>
                    <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                </div>
            </div>
       </div>
  </div>
</div>


