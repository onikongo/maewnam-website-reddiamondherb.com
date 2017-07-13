<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM subcategory  WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
	
?>
<br>
<script>
/*fn.app.supplier.initial(
	"#edit_customer #cbbCountry",
	"#edit_customer #cbbProvince",
	"#edit_customer #cbbDistrict",
	"#edit_customer #cbbSubdistrict");
	
});
*/$(document).ready(function(e) {
		$("#back").click(function(e) {
		window.location = '?app=subcategory';
	});
});</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Categories </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Categories</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.subcategory.update_subcategory()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Edit Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 

<form id="edit_subcategory" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
<!--<div class="form-group">-->
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-10">
                    <select name="parent" id="parent" class="form-control">
                    	<?php $sql = $dbc->Query("SELECT * FROM categories ORDER BY id DESC");
						while($row = $dbc->Fetch($sql))
						{
							?><option value="<?php echo $row['id'];?>" <?php echo($line['category']==$row['id'])?'selected':'';?>><?php echo $row['name'];?></option><?php
						}
						?>
                    </select>
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_name" name="tx_name" placeholder="Name" value="<?php echo $line['name'];?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"><?php echo $line['detail'];?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-4">
                    <img id="icon" src="<?php echo $line['icon'];?>" class="img-responsive">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txticon" name="txticon" placeholder="Name" value="<?php echo $line['icon'];?>">
                </div>
                <div class="col-sm-2">
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.subcategory.dialog_thumb.open_elfinder();">Browse</div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Sort Order</label>
                <div class="col-sm-10">
                	<select id="tx_sort" name="tx_sort" class="form-control">
					<?php $sort = $dbc->Query("SELECT * FROM subcategory");
                        $old = array();
                        while($dat = $dbc->Fetch($sort))
                        {
                            array_push($old,$dat['sort_order']);
                        }
                        $i=1;
                        while($i<100)
                        {
                            if(in_array($i,$old))
                            {
								if($i==$line['sort_order'])
								{
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
								}
                            }
                            else
                            {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            $i++;
                        }
                        
                    ?>
                    </select>
                	<!--<input type="number" class="form-control" id="tx_sort" name="tx_sort" placeholder="Sort Order" value="<?php echo $line['sort_order'];?>">-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                	<select name="selstatus"  id='selstatus' class="form-control">
                        <option value='1' <?php echo($line['status']==1)?'selected':'';?>>Enable</option>    
                        <option value='0' <?php echo($line['status']==0)?'selected':'';?>>Disable</option>    
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
