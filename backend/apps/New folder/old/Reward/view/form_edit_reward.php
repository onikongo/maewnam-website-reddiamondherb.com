67tyt5<?php 
    include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$row = $dbc->GetRecord("rewards","*","id='".$id."'");
	
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
  <li><font size="+2">Reward </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Reward</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.Reward.update_reward()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Edit Reward </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="edit_reward" class="form-horizontal" role="form">
        <input type="hidden" name="txtID" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tx_title" name="tx_title" value="<?php echo $row['title'];?>" placeholder="Title">
                </div>
                
            </div>
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Detail</label>
                <div class="col-sm-10">
                     <textarea class="form-control" id="detail" name="detail" placeholder="Detail"><?php echo $row['detail'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Point</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_point" name="tx_point" value="<?php echo $row['point'];?>" placeholder="Point" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Expiration Date</label>
                <div class="col-sm-10">
                	<input type="date" class="form-control" id="tx_exp" name="tx_exp" value="<?php echo $row['expiration'];?>" placeholder="Expiration Date">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Amount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_amount" name="tx_amount" value="<?php echo $row['amount'];?>" placeholder="Amount">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-10">
						<div class="btn btn-default" onClick="fn.app.Reward.images.open_elfinder($('#tx_title').val())">Browse</div>
                        
                        <div class="row col-md-12" id="container_thumbnail_photo">
                    <?php
						$st = json_decode($row['photo'],true);
                        if(isset($st))
                        {
                            foreach($st as $img){
                                echo '<div class="col-md-2">';
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
					</div>
                </div>
            </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>