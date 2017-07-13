<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("product_category","*","id='".$id."'");
	$name = explode("|",$edit['name']);
?>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=product">Product</a> / edit product category</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Product category</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-12" style="padding:10px;">
            <form class="form form-horizontal" id="product_cate_edit">
            <input type="hidden" name="txtID" value="<?php echo $id;?>">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name (EN)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtName" name="txtName" value="<?php echo $name[0];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name (TH)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtNameTH" name="txtNameTH"  value="<?php echo $name[1];?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-primary pull-right" id="multi-posts" type="button" onClick="fn.app.product.update_procate()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                            <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                        </div>
                    </div>
                </form>      
             
       </div>
  </div>
</div>


