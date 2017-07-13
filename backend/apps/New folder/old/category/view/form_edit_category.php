<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM categories  WHERE id=".$_REQUEST['id'];
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
		window.location = '?app=category';
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
  <a id="save" onClick="fn.app.category.update_category()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Edit Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
    
    <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Category</a></li>
        <li role="presentation"><a href="#advertise" aria-controls="advertise" role="tab" data-toggle="tab">Advertise</a></li>
      </ul>
      <form id="edit_category" class="form-horizontal" role="form">
      
<!-- Tab panes -->
  <div class="tab-content"><!--start tap-->
    <div role="tabpanel" class="tab-pane active" id="home">
    <br>

	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
<!--<div class="form-group">-->
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
                <label for="txtDetail" class="col-sm-2 control-label">Hover Color</label>
                <div class="col-sm-10">
                    <input type="color"  class="form-control" id="txtColor" name="txtColor" value="<?php echo $line['color_code'];?>">
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
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.category.dialog_thumb.open_elfinder();">Browse</div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Sort Order</label>
                <div class="col-sm-10">
                	<select id="tx_sort" name="tx_sort" class="form-control">
					<?php $sort = $dbc->Query("SELECT * FROM categories");
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
            <div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Main Photo</label>
                <div class="col-sm-4">
					<img id="mpic" src="<?php echo json_decode($line['imagemain'],true);?>" class="img-responsive"  style="border:1px solid #999;">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtmain" name="txtmain" placeholder="Name" value="<?php echo json_decode($line['imagemain'],true);?>">
                </div>
                <div class="col-sm-2">
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.category.dialog_main.open_elfinder();">Browse</div>
                </div>
            </div>
            <div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Sub Photo</label>
                <div class="col-sm-4">
                    <img id="psub" src="<?php echo json_decode($line['imagesub'],true);?>" class="img-responsive" style="border:1px solid #999;">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtsub" name="txtsub" placeholder="Name" value="<?php echo json_decode($line['imagesub'],true);?>">
                </div>
                <div class="col-sm-2">
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.category.dialog_sub.open_elfinder();">Browse</div>
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Youtube Embed</label>
                <div class="col-sm-10">
                	Example : https://youtu.be/<font color="#FF0000">E6oF10izmFQ</font>
                	<input type="text" class="form-control" id="tx_you" name="tx_you" placeholder="E6oF10izmFQ"><br>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo base64_decode($line['video']);?>" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            
            
      </div>
     
    <div role="tabpanel" class="tab-pane" id="advertise"><!--tap 2-->
    <br>
    	<div class="form-group">
            <label for="txtPhoto" class="col-sm-2 control-label">Main Ads</label>
            <div class="col-sm-4">
                <img id="mads" src="<?php echo $line['main_ads'];?>" class="img-responsive" style="border:1px solid #999;">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="txtmainads" name="txtmainads" placeholder="Main Ads" value="<?php echo $line['main_ads'];?>">
            </div>
            <div class="col-sm-2">
                <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.category.dialog_mainads.open_elfinder();">Browse</div>
            </div>
        </div>
    	
        <ol id="subphoto" class="breadcrumb">
            	
                <div class="page-header">
                  <font size="+2">My Picture/Photo<small></small></font>
                  <div id="txtPhotoButton" class="btn btn-default pull-right" onClick="fn.app.category.dialog_photo.open_elfinder();">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </div>
                </div>            
              
               <div class="row" id="container_thumbnail_photo">
                     <?php
					$st = json_decode($line['photo_ads'],true);
                        if(isset($st['photo']))
                        {
                            foreach($st['photo'] as $img){
                                echo '<div class="col-md-12">';
                                echo '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
                                ?>
                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00; top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span><?php
                                echo '<img src="'.$img.'" data-src="'.$img.'" alt="...">';
                                echo '<input type="hidden" name="txtPhoto[]" value="'.$img.'">';
                                echo '</a>';
                                echo '</div>';
                                
                            }
                        }
                        else
                        {
                            ?>
                            <!--<span class="glyphicon glyphicon-picture" aria-hidden="true" style="font-size:50px;"></span>-->
                            <?php
                        }
                    ?>
                    </div>
           </ol>
           
    </div><!--tap 2-->
    
  </div><!--end tap-->
</form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>
<?php
	
	$dbc->Close();
