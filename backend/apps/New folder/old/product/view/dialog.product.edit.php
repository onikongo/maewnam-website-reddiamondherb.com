<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("products","*","id='".$id."'");
	$name = explode("|",$edit['name']);
	$des = explode("|",$edit['detail']);
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>

<form id="form_add_product" class="form-horizontal">
<input type="hidden" id="proID" name="proID" value="<?php echo $id;?>">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#tab_info" aria-controls="tab_info" role="tab" data-toggle="tab">General Info</a></li>
		<li id="peri" role="presentation"><a href="#tab_schedule" aria-controls="tab_schedule" role="tab" data-toggle="tab">Branch & Schedule</a></li>
		<li role="presentation"><a href="#tab_media" aria-controls="tab_media" role="tab" data-toggle="tab">Media</a></li>
	</ul>

	<div class="tab-content" style="margin-top:10px;">
		<div role="tabpanel" class="tab-pane active" id="tab_info">
			<div class="form-group">
				<label class="col-sm-4 control-label">Product Category*</label>
				<div class="col-sm-8">
					<select class="form-control" id="cbbCategory" name="cbbCategory">
					<?php
						$cate = $dbc->Query("SELECT * FROM categories ORDER BY id DESC");
						while($rc = $dbc->Fetch($cate)){
							?><option value="<?php echo $rc['id'];?>" <?php echo($edit['category']==$rc['id'])?'selected':'';?>><?php echo $rc['name'];?></option><?php
						}
					?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Subcategory*</label>
				<div class="col-sm-8">
					<select class="form-control" id="cbbSubcategory" name="cbbSubcategory">
					
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Product Title*</label>
				<div class="col-sm-8">
					<input type="text"  class="form-control" id="txtTitle" name="txtTitle" placeholder="Deal Title" value="<?php echo $name[0];?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Product Description*</label>
				<div class="col-sm-8">
					<textarea  class="form-control editor" id="txtDetail" name="txtDetail" placeholder="Deal Description"><?php echo $des[0];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
					<center>
						<a id="openmore" class="btn btn-default"><span id="arro" class="glyphicon " aria-hidden="true" style=" font-size:18px;"></span> Thai Title and Description</a>
					</center>
				</div>
			</div>
			<div id="thai" style="display:none;">
				<div class="form-group">
					<label for="txtDetail" class="col-sm-4 control-label">Product Title TH*</label>
					<div class="col-sm-8">
						<input type="text"  class="form-control" id="txtTitleTH" name="txtTitleTH" placeholder="ชื่อไทย" value="<?php echo $name[1];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="txtDetail" class="col-sm-4 control-label">Product Description TH*</label>
					<div class="col-sm-8">
						<textarea  class="form-control editor" id="txtDetailTH" name="txtDetailTH" placeholder="รายละเอียด"><?php echo $des[1];?></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="txtName" class="col-sm-4 control-label">Expire Date*</label>
				<div class="checkbox col-sm-2"><label><input type="checkbox" id="chkNoexpire" name="chkNoexpire"> No Expire</label></div>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="txtExpire" name="txtExpire" value="<?php echo $edit['expire'];?>">
				</div>
			</div>

			<div class="page-header">
				<font size="+2">Price Information <small></small></font>
			</div>
			<?php $setting = json_decode($edit['setting'],true);?>
			<div class="form-group">
				<label for="txtDetail" class="col-sm-3 control-label">Price*</label>
				<div class="col-sm-5 input-group">
					<input type="number" class="form-control" id="txtPrice" name="txtPrice" placeholder="0.00" value="<?php echo $setting['price'];?>">
					<div class="input-group-addon">บาท</div>
				</div>
			</div>
			<div class="form-group">
				<label for="txtDetail" class="col-sm-3 control-label">Discount (%)</label>
				<div class="col-sm-5 input-group">
					<input type="number" class="form-control" id="txtDiscountPercentage" name="txtDiscountPercentage" placeholder="Discount" value="<?php echo $setting['discount_percentage']*100;?>">
					<div class="input-group-addon">%</div>
					<input type="number" class="form-control" id="txtDiscount" name="txtDiscount" placeholder="Discount" value="<?php echo $setting['discount'];?>">
					<div class="input-group-addon">บาท</div>
				</div>
			</div>
			<div class="form-group">
				<label for="txtDetail" class="col-sm-3 control-label">Total Price</label>
				<div class="input-group col-sm-5">
					<input type="number" class="form-control" id="txtTotal" name="txtTotal" placeholder="0.00" readonly 
                    value="<?php echo $total = $setting['price']-$setting['discount'];?>">
					<div class="input-group-addon">บาท</div>
				</div>
				
			</div>
			<div class="form-group">
				<label for="txtDetail" class="col-sm-3 control-label">Commission *</label>
				<div class="col-sm-5 input-group">
					<input type="number" class="form-control" id="txtCommissionPercentage" name="txtCommissionPercentage" value="<?php echo $setting['commission_percentage']*100;?>" placeholder="Discount">
					<div class="input-group-addon">%</div>
					<input type="number" class="form-control" id="txtCommission" name="txtCommission" placeholder="Discount" value="<?php echo $setting['commission'];?>">
					<div class="input-group-addon">บาท</div>
				</div>
			</div> 
			<div class="form-group">
				<label for="txtDetail" class="col-sm-3 control-label">Selling Price</label>
				<div class="col-sm-5 input-group">
					<input type="number" class="form-control" id="txtSellingPrice" name="txtSellingPrice" placeholder="0.00" readonly 
                    value="<?php echo $setting['commission']+$total;?>">
					<div class="input-group-addon">บาท</div>
				</div>
			</div>
			<div class="form-group">
				<label for="txtDetail" class="col-sm-4 control-label">Point</label>
				<div class="col-sm-2 input-group">
					<input type="number" class="form-control" id="txtPoint" name="txtPoint" value="<?php echo $edit['point'];?>">
					<div class="input-group-addon">คะแนน</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="tab_schedule">
			<div class="form-group">
                <label class="col-sm-4 control-label">Supplier Name</label>
                <div class="col-sm-4">
                    <input type="hidden" class="form-control" id="txtsuppid" name="txtsuppid" placeholder="Supplier Name" value="<?php echo $edit['supplier'];?>">					<?php 
					$supp = $dbc->GetRecord("suppliers","*","id='".$edit['supplier']."'");
					?>
                    <input type="text" class="form-control" id="txtsuppName" name="txtsuppName" placeholder="Supplier Name" value="<?php echo $supp['name'];?>">
                </div>
                <div class="col-sm-2">
                    <a id="btnLoading" class="btn btn-primary" onClick="fn.app.product.lookup_suppiler('<?php echo $edit['supplier'];?>')">
	                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                    <!--<a id="more" class="btn btn-default" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    <a id="minus" class="btn btn-default" style="display:none;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>-->
                </div>
            </div>
			<fieldset>
				<legend>Schedule :</legend>
				<div id="tabBranch">
				
				</div>
			</fieldset>
		
		</div>
		<div role="tabpanel" class="tab-pane" id="tab_media">
			<div class="page-header">
				<font size="+2">Media Information<small></small></font>
				<font size="+1" class="pull-right">* INDICATES REQUIRED FIELD <small></small></font>
			</div>
            
            <div class="col-md-12">
            	<div class="col-md-4">
                	<center>
                        <a id="photo"><span class="glyphicon glyphicon-picture" aria-hidden="true" style="font-size:50px;"></span><br>
                        <p>Picture/Photo</p></a>
                    </center>
                </div>
                <div class="col-md-4">
                	<center>
                        <a id="vdo"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true" style="font-size:50px;"></span><br>
                        <p>Video</p></a>
                    </center>
                </div>
                <div class="col-md-4">
                	<center>
                        <a id="doc"><span class="glyphicon glyphicon-file" aria-hidden="true" style="font-size:50px;"></span><br>
                        <p>Document</p></a>
                    </center>
                </div>
            </div>
			
			<div class="page-header">
				<br><br><br><br>
            </div>
			<script>
		    $(document).ready(function(e) {
            	$("#photo").click(function(e) {
                    $("#subphoto").show();
					$("#subvdo").hide();
					$("#subdoc").hide();
                });
				$("#vdo").click(function(e) {
                    $("#subvdo").show();
					$("#subphoto").hide();
					$("#subdoc").hide();
                });
				$("#doc").click(function(e) {
                    $("#subdoc").show();
					$("#subphoto").hide();
					$("#subvdo").hide();
                });
				
       		});
			</script>
		   
			<ol id="subphoto" class="breadcrumb">
				<div class="page-header">
                  <font size="+2">My Picture/Photo<small></small></font>
                  <div id="txtPhotoButton" class="btn btn-default pull-right" onClick="fn.app.product.dialog_photo.open_elfinder();">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                  </div>
				</div>
				<div class="row " id="container_thumbnail_photo">
				<?php	$st = json_decode($edit['media'],true);
                        if(isset($st['photo']))
                        {
                            foreach($st['photo'] as $img){
                                echo '<div class="col-md-4">';
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
			
            <ol id="subvdo" class="breadcrumb" style="display:none;">
            	
                <div class="page-header">
                  <font size="+2">Embed Video<small></small></font>
                </div>            
              	<script>
				$(function(){
					$("#upvdo").click(function(e) {
                        $("#myupload").slideDown(200);
						$("#youtube").slideUp(200);
                    });
					$("#embed").click(function(e) {
                        $("#youtube").slideDown(200);
						$("#myupload").slideUp(200);
                    });
				});
				</script>
                	<div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Choose</label>
                        <div class="col-sm-10">
                            <input type="radio" id="upvdo"  name="cho" value="upload" checked > Upload Video &nbsp;&nbsp;&nbsp;
                            <input type="radio" id="embed" name="cho" value="embed"> Embed Video
                        </div>
                        
                    </div>
                    
                <div id="myupload">
                	<div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Video</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtvdo" name="txtvdo" placeholder="Name">
                        </div>
                        <div class="col-sm-2">
                            <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.product.dialog_vdo.open_elfinder();">Browse</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtvdoPhotos" name="txtvdoPhotos" placeholder="Name">
                        </div>
                        <div class="col-sm-2">
                            <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.product.dialog_thumb.open_elfinder();">Browse</div>
                        </div>
                    </div>
                </div>
                <div id="youtube" style="display:none;">
                	<div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Embed Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtem" name="txtem" placeholder="Name">
                        </div>
                    </div>
                </div>
               
           </ol>
           
           <ol id="subdoc" class="breadcrumb" style="display:none;">
            	
                <div class="page-header">
                  <font size="+2">Attachment Document<small></small></font>
                </div>            
              	
                <div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Document</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="txtDoc" name="txtDoc" placeholder="Name">
                    </div>
                    <div class="col-sm-2">
                        <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.product.dialog_doc.open_elfinder();">Browse</div>
                    </div>
                </div>
                
               
           </ol>
            
            	
        </div>
		
		
		
		</div>
	</div>
	<div>
		<button type="button" class="btn btn-danger" onclick="fn.navigate('view')">Cancel</button>
		<button type="button" class="btn btn-primary pull-right" onclick="fn.app.product.edit()">Save</button>
	</div>
</form>
<script>
	// For Category Selected
	$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/xhr/action-load-subcategory.php",
			data: {id:$("#cbbCategory").val()},
			success : function(json){
				$("#cbbSubcategory").html(json);
			}
		});  
	$("#cbbCategory").change(function(e) {
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/product/xhr/action-load-subcategory.php",
			data: {id:$(this).val()},
			success : function(json){
				$("#cbbSubcategory").html(json);
			}
		});  
	});
				
	// Append Thail Detail
	tick=0;
	$("#arro").addClass('glyphicon-circle-arrow-down');
	$("#openmore").click(function(e) {
		if(tick==0){
			$("#thai").slideDown(200);
			$("#arro").addClass('glyphicon-circle-arrow-up');
			$("#arro").removeClass('glyphicon-circle-arrow-down');
			tick=1;
		}else{
			$("#thai").slideUp(200);
			$("#arro").addClass('glyphicon-circle-arrow-down');
			$("#arro").removeClass('glyphicon-circle-arrow-up');
			tick=0;
		}           
	});
				
	$("#peri").click(function(e) {
        $.ajax({
			type: "POST",
			data: {id:$(this).val()},
			dataType:"html",
			url: "apps/product/xhr/action-load-branchs.php",
			data: {id:$("#txtsuppid").val(),pro:$("#proID").val()},
			success : function(html){
				$("#tabBranch").html(html);
				fn.app.product.schedule.data = [];
			}
		});  
    });
	
	$("#txtsuppid").change(function() {
		$.ajax({
			type: "POST",
			data: {id:$(this).val()},
			dataType:"html",
			url: "apps/product/xhr/action-load-branchs.php",
			data: {id:$(this).val()},
			success : function(html){
				$("#tabBranch").html(html);
				fn.app.product.schedule.data = [];
			}
		});  
	});
	
	// After Price Update
	$("#txtPrice, #txtDiscount, #txtDiscountPercentage, #txtCommission, #txtCommissionPercentage").keyup(function(){
		var me = $(this);
		var price = $("#txtPrice").val();
		var discount = $("#txtDiscount").val();
		var discountP = $("#txtDiscountPercentage").val();
		var commission = $("#txtCommission").val();
		var commissionP = $("#txtCommissionPercentage").val();

		if(price != "" && (discount != "" ||  discountP != "")){
			console.log(me.attr("id"));
			
			if(me.attr("id")=="txtDiscount"){
				var discountP = (discount / price * 100);
				$("#txtDiscountPercentage").val(discountP.toFixed(2));
			}
			
			if(me.attr("id")=="txtDiscountPercentage"){
				var discount = (discountP * price / 100);
				$("#txtDiscount").val(discount.toFixed(2));
			}
			$("#txtTotal").val(price - discount);
		}
		
		if($("#txtTotal").val() != "" && (commission != "" ||  commissionP != "")){
			console.log(me.attr("id"));
			
			if(me.attr("id")=="txtCommission"){
				var commissionP = (commission / $("#txtTotal").val() * 100);
				$("#txtCommissionPercentage").val(commissionP.toFixed(2));
			}
			
			if(me.attr("id")=="txtCommissionPercentage"){
				var commission = (commissionP * $("#txtTotal").val() / 100);
				$("#txtCommission").val(commission.toFixed(2));
			}
			$("#txtSellingPrice").val(parseFloat($("#txtTotal").val()) + commission);
			$("#txtPoint").val(Math.round($("#txtSellingPrice").val()*.05));

		}

	});
	
	
	
	
</script>