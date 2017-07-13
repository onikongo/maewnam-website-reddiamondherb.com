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
	$desc = $dbc->GetRecord("about_vision","*","id=1");
	$title = explode("|",$desc['title']);
	$detail = explode("|",base64_decode($desc['detail']));
	
	$mission = $dbc->GetRecord("about_mission","*","id=1");
	$title_mis = explode("|",$mission['title']);
	$detail_mis = explode("|",base64_decode($mission['detail']));
?>
<style>
</style>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>

<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=news">Organization</a></font></div>
<div class="col-md-12" style="padding:10px;">
    <div><!-- Nav tabs -->
    
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">About Vision</a></li>
            <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">About Mission</a></li>
            <li role="presentation" class="active"><a href="#organi" aria-controls="organi" role="tab" data-toggle="tab">Organization</a></li>
        </ul><!-- Nav tabs -->
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane " id="home">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Vision Description</h3>
                  </div>
                  <div class="panel-body">
            		<form class="form form-horizontal" id="aboutdesc">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title (EN)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtTitle" name="txtTitle" value="<?php echo $title[0];?>" placeholder="Deal Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title (TH)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtTitleth" name="txtTitleth" value="<?php echo $title[1];?>" placeholder="Deal Title">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description (EN)</label>
                        <div class="col-sm-8">
                            <textarea type="text"  class="form-control editor" id="txtDes" name="txtDes" placeholder="Deal Title"><?php echo $detail[0];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description (TH)</label>
                        <div class="col-sm-8">
                            <textarea type="text"  class="form-control editor" id="txtDesth" name="txtDesth" placeholder="Deal Title"><?php echo $detail[1];?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-primary pull-right" id="multi-posts" type="button" onClick="fn.app.organization.save_vision()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                            <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                        </div>
                    </div>
                </form>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="profile">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Mission Description</h3>
                  </div>
                  <div class="panel-body">
            		<form class="form form-horizontal" id="about_mission">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title (EN)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtTitle" name="txtTitle" value="<?php echo $title_mis[0];?>" placeholder="Deal Title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title (TH)</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" id="txtTitleth" name="txtTitleth" value="<?php echo $title_mis[1];?>" placeholder="Deal Title">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description (EN)</label>
                        <div class="col-sm-8">
                            <textarea type="text"  class="form-control editor" id="txtDes" name="txtDes" placeholder="Deal Title"><?php echo $detail_mis[0];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description (TH)</label>
                        <div class="col-sm-8">
                            <textarea type="text"  class="form-control editor" id="txtDesth" name="txtDesth" placeholder="Deal Title"><?php echo $detail_mis[1];?></textarea>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button class="btn btn-primary pull-right" id="multi-posts" type="button" onClick="fn.app.organization.save_mission()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                            <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                        </div>
                    </div>
                </form>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane active" id="organi">
            	<div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Organization</h3>
                    <!--<div align="right">-->
                        <button type="button"  class="btn btn-danger pull-right but" onclick="fn.navigate('addEvent')">Add Information</button>
                    <!--</div>-->
                  </div>
                  <div class="panel-body nopad">
                    <div class="table-responsive nopad">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Sort</th>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Title (EN)</th>
                                    <th class="text-center">Title (TH)</th>
                                    <th class="text-center">Sub Title (EN)</th>
                                    <th class="text-center">Sub Title (TH)</th>
                                    <th class="text-center">Main Image</th>
                                    <th class="text-center">Sub Image</th>
                                    <th class="text-center">Date Create</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                    
                    <?php 
                    $sql = $dbc->Query("SELECT * FROM sub_organization ");
                    $i=0;
                    while($row = $dbc->Fetch($sql))
                    {	
                        $name = explode("|",$row['title']);
                        $sub = explode("|",base64_decode($row['detail']));
                        ?>
                        <tr>
                            <td class="text-center" valign="middle"><img src="/upload/icon/arrow.png"></td>
                            <td class="text-center"><?php echo $i;?></td>
                            <td class="text-center"><?php echo $name[0];?></td>
                            <td class="text-center"><?php echo $name[1];?></td>
                            <td class="text-center"><?php echo $sub[0];?></td>
                            <td class="text-center"><?php echo $sub[1];?></td>
                            <td class="text-center">
                                <img src="<?php echo $row['photo'];?>" width="200">
                            </td>
                            <td class="text-center">
                                <img src="<?php echo $row['image'];?>" width="200">
                            </td>
                            <td class="text-center"><?php echo $row['created'];?></td>
                            <td class="text-center">
                                <button type="button" class="buticonEdit" onClick="fn.navigateEdit('editEvent','<?php echo $row['id'];?>')"><i class="demo-icon icon-pencil">&#xe802;</i> </button>
                                <button type="button" class="buticonRem" onClick="fn.app.organization.dialog_deleteEvent('<?php echo $row['id'];?>',this)"><i class="demo-icon icon-cancel">&#xe803;</i></button>
                            </td>
                            <td class="text-center">
                            <?php if($row['status']==1)
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.organization.activ('<?php echo $row['id'];?>',this)">
                                    <label for="cmn-toggle-<?php echo $i;?>"></label>
                                </div><?php
                            }
                            else
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.organization.activ('<?php echo $row['id'];?>',this)">
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
        </div><!-- Tab panes -->
    
    </div><!-- Nav tabs -->


	

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
