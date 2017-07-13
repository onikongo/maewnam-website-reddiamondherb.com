<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
?>
<style>
</style>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>

<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=product">Product & Service</a> / Product</font></div>
<div class="col-md-12" style="padding:10px;">
    <div><!-- Nav tabs -->
    
            	<div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">product</h3>
                    <!--<div align="right">-->
                    	
                        <button type="button"  class="btn btn-danger pull-right but" onClick="fn.navigateEdit('add_product','<?php echo $_REQUEST['id'];?>')">Add Product category</button>
                        <button type="button" class="btn btn-xs btn-default pull-right but btns" onClick="javascript:window.history.go(-1);"><i class="demo-icon icon-cancel">&#xe807;</i></button>
                    <!--</div>-->
                  </div>
                  <div class="panel-body nopad">
                    <div class="table-responsive nopad">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Sort</th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Name (EN)</th>
                                    <th class="text-center">Name (TH)</th>
                                    <th class="text-center">Description (EN)</th>
                                    <th class="text-center">Description (TH)</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Date Create</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                    
                    <?php 
                    $sql = $dbc->Query("SELECT * FROM products WHERE category = '".$_REQUEST['id']."'");
                    $i=0;
                    while($row = $dbc->Fetch($sql))
                    {	$name  = explode("|",$row['name']);
						$detail  = explode("|",$row['detail']);
                        ?>
                        <tr>
                            <td class="text-center" valign="middle"><img src="/upload/icon/arrow.png"></td>
                            <td class="text-center"><?php echo $i;?></td>
                            <td class="text-center">
                                <?php echo $name[0];?>
                            </td>
                            <td class="text-center">
                                <?php echo $name[1];?>
                            </td>
                            <td class="text-center">
                                <?php echo $detail[0];?>
                            </td>
                            <td class="text-center">
                                <?php echo $detail[1];?>
                            </td>
                            <td class="text-center"><img src="<?php echo $row['setting'];?>" width="100"></td>
                            <td class="text-center"><?php echo $row['created'];?></td>
                            
                            <td class="text-center">
                                <button type="button" class="buticonEdit" onClick="fn.navigateEdit('edit_product','<?php echo $row['id'];?>')"><i class="demo-icon icon-pencil">&#xe802;</i> </button>
                                <button type="button" class="buticonRem" onClick="fn.app.product.dialog_delete_product('<?php echo $row['id'];?>',this)"><i class="demo-icon icon-cancel">&#xe803;</i></button>
                            </td>
                            <td class="text-center">
                            <?php if($row['status']==1)
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.product.activPro('<?php echo $row['id'];?>',this)">
                                    <label for="cmn-toggle-<?php echo $i;?>"></label>
                                </div><?php
                            }
                            else
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.product.activPro('<?php echo $row['id'];?>',this)">
                                    <label for="cmn-toggle-<?php echo $i;?>"></label>
                                </div><?php
                            }?>
                                
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
    


	

</div>













<div class="closes">
	<div class="col-md-6 col-md-offset-3">
    	<div class="col-md-10">
        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            Are you sure you want to delete?
        </div>
        <div class="col-md-2" style="margin-top:100px;">
        	<button type="button" id="yes" class="btn btn-primary" >YES</button>
            <button type="button" id="no" class="btn btn-default">NO</button>
        </div>
        
    </div>
</div>
<div class="bgclose"></div>
<style>




.bgclose
{
	position:fixed;
	left:0;
	top:0;
	right:0;
	bottom:0;
	background:rgba(0,0,0,0.5);
	z-index:1000;
	display:none;
}
.closes
{
	position:fixed;
	height:200px;
	width:100%;
	left:0;
	right:0;
	top:50%;
	margin-top:-100px;
	background:rgba(255,44,44,0.8);
	z-index:1100;
	color:#fff;
	padding:20px;
	font-size:36px;
	display:none;
}
.buticonEdit
{
	background:none;
	border:2px solid #AAAAAA;
	border-radius:100%;
	color:#AAAAAA;
	width:40px;
	height:40px;
	outline:none;
}

.buticonRem
{
	background:none;
	border:2px solid #CA0005;
	border-radius:100%;
	color:#CA0005;
	width:40px;
	height:40px;
	outline:none;
}
.demo-icon
    {
      font-family: "fontello";
      font-style: normal;
      font-weight: lighter;
	  font-size:18px;
	  padding-top:15px;
	  padding-bottom:15px;
	  padding-left:5px;
	  padding-right:5px;
	  
 
    }
	
.nopad
{
	padding:0px;
}
.table
{
	background: #F8FAFC;
    font-weight: bold;
    color: #333;
    border-bottom: 1px solid #E5E5E5;
}
.table
{
	border:0px !important;
}
.table > tbody
{
	background:#fff
}
.table > tbody > tr > td
{
	padding:0px !important;
}
.table > tbody > tr > td
{
	font-weight:lighter;
}
.table > tbody > tr > td
{
	vertical-align: middle !important;
}

</style>
