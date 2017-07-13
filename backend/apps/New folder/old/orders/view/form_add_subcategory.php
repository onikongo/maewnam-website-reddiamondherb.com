<?php 
    include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	
?>
<script>
//fn.app.customer.initial("#cbbCountry","#cbbProvince","#cbbDistrict","#cbbSubdistrict");
//fn.app.customer.load_country("#cbbCountry");
$(document).ready(function(e) {
    $("#back").click(function(e) {
        window.location.reload();
    });
});
</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Tags </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Tag</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.subcategory.dialog_save_subcategory()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Tag </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="add_subcategory" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-10">
                    <select name="parent" id="parent" class="form-control">
                    	<?php $sql = $dbc->Query("SELECT * FROM categories ORDER BY id DESC");
						while($row = $dbc->Fetch($sql))
						{
							?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
						}
						?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_name" name="tx_name" placeholder="Name">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Icon</label>
                <div class="col-sm-4">
                    <img id="icon" src="/upload/logo.jpg" class="img-responsive">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txticon" name="txticon" placeholder="Name">
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
						}
						else
						{
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						$i++;
					}
					
				?>
                </select>
                	<!--<input type="number" class="form-control" id="tx_sort" name="tx_sort" placeholder="Sort Order">-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                	<select name="selstatus"  id='selstatus' class="form-control">
                        <option value='1'>Enable</option>    
                        <option value='0'>Disable</option>    
                    </select>   
                </div>
            </div>
            
            
        </form>
    <!--panel--> 
    </div>
    
    

    
    
    </div>
</div>

</div>