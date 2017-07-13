<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("news","*","id='".$id."'");
	$name = explode("|",$edit['headline']);
	$sub = explode("|",$edit['detail']);
?>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=homepage">Slide photo</a> / edit</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-12" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetailEdit">
            	<input type="hidden" name="txtID" value="<?php echo $id;?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title (EN)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtTitle" name="txtTitle" value="<?php echo $name[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title (TH)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtTitleth" name="txtTitleth" value="<?php echo $name[1];?>">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Description (EN)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtSub" name="txtSub" value="<?php echo $sub[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Description (TH)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtSubth" name="txtSubth" value="<?php echo $sub[1];?>">
                    </div>
                </div> 
                <input type="hidden" id="parth" name="parth" value="<?php echo $edit['photo'];?>">
                </form>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.news.updateNews()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                        <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                        
                    </div>
                </div>
                <div id="output"></div>         
             
       </div>
  </div>
</div>




