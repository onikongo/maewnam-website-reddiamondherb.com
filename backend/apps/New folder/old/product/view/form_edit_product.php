<?php
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$dbc = new dbc;
	$dbc->Connect();
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	
	$id = $_REQUEST['id'];
	$pro = $dbc->GetRecord("products","*","id='".$id."'");
	$namep = explode("|",$pro['name']);
	$detail = explode("|",$pro['detail']);
	$media = $dbc->GetRecord("medias","*","product='".$id."'");
	$address = $dbc->GetRecord("address","*","id='".$pro['id']."'");
	
?>
<script>
fn.app.product.initial(
	"#edit_basic #cbbCountry",
	"#edit_basic #cbbProvince",
	"#edit_basic #cbbDistrict",
	"#edit_basic #cbbSubdistrict");
fn.app.product.initial(
	"#edit_basic #cbb2Country",
	"#edit_basic #cbb2Province",
	"#edit_basic #cbb2District",
	"#edit_basic #cbb2Subdistrict");
	
	
	
	
	$( 'textarea.editor' ).ckeditor();
	$(document).ready(function(e) {
        /*$("#added").click(function(e) {
            $("#more").slideDown(300);
			$("#added").hide(0);
			$("#closed").fadeIn(200);
        });
		$("#closed").click(function(e) {
            $("#more").slideUp(300);
			$("#closed").hide(0);
			$("#added").fadeIn(200);
			$("#tx_sqm").val('');
			$("#tx_sqw").val('');
			$("#tx_rai").val('');
        });*/
		
    });
</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Add Products </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Products</a></li>
  
  <a id="back" href="javascript:window.location = '?app=product'" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span> Close</a>
  
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Product</h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
    	<ul class="nav nav-tabs nav-justified ltab">
          <li<?php if($tab=="basic")echo' class="active"'; ?> id="tbasic" ><a href="#basic" data-toggle="tab">Basic Product Information</a></li>
          <?php /*?><li<?php if($tab=="supplier")echo' class="active"'; ?> id="tsub" ><a href="#supplier" data-toggle="tab">Suppiler</a></li><?php */?>
          <!--<li<?php if($tab=="location")echo' class="active"'; ?> id="tlocation" ><a href="#location" data-toggle="tab">Location Information</a></li>-->
          <li<?php if($tab=="schedule")echo' class="active"'; ?> id="tschedule" ><a href="#schedule" data-toggle="tab">Schedual</a></li>
          <li<?php if($tab=="media")echo' class="active"'; ?> id="tmedia" ><a href="#media" data-toggle="tab">Media</a></li>
        </ul>
     <form id="edit_basic" class="form-horizontal" role="form">   
     <input type="hidden" name="txtID" value="<?php echo $id;?>">
     <input type="hidden" name="mediaID" value="<?php echo $media['id'];?>">
     <input type="hidden" name="addressID" value="<?php echo $address['id'];?>"> 
    <div class="tab-content" style="padding-top: 10px;">
        <div class="tab-pane<?php if($tab=="basic")echo' active'; ?>" id="basic">
        
        <div class="page-header">
          <font size="+2">Enter Basic Product Information <small></small></font>
          <font size="+1" class="pull-right">* INDICATES REQUIRED FIELD <small></small></font>
        </div>
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Product Category*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="selcategory" name="selcategory">
                        <?php
							$cate = $dbc->Query("SELECT * FROM categories ORDER BY id DESC");
							while($rc = $dbc->Fetch($cate))
							{
								?><option value="<?php echo $rc['id'];?>" <?php echo($pro['category']==$rc['id'])?'selected':'';?>><?php echo $rc['name'];?></option><?php
							}
						?>
                        </select>
                    </div>
                </div>
                <script>
				$(document).ready(function(e) {
					$.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/product/xhr/load-subcategory.php",
								data: {id:<?php echo $pro['category'];?>,val:<?php echo $pro['subcategory'];?>},
								success : function(json)
								{
									$("#subc").html(json);
								}
						});
					$("#selcategory").change(function(e) {
						$.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/product/xhr/load-subcategory.php",
								data: {id:$(this).val()},
								success : function(json)
								{
									$("#subc").html(json);
								}
						});
					   
					});
				});
				</script>
                <div class="form-group">
                	<div id="subc"></div>
                </div>
                
                <!--<div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Property Tag*</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="proptype" name="proptype">
                        <?php
							$subcate = $dbc->Query("SELECT * FROM subcategory ORDER BY id DESC");
							while($sc = $dbc->Fetch($subcate))
							{
								?><option value="<?php echo $sc['id'];?>" <?php echo($pro['subcategory']==$sc['id'])?'selected':'';?>><?php echo $sc['name'];?></option><?php
							}
						?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                    	<a class="btn btn-primary" onclick="fn.app.product.append_brand()">Add</a>
                    </div>
                </div>-->
                
               <!-- <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <ul id="ulTag" class="list-group">
                        <?php $tag = json_decode($pro['subcategory'],true);
							if(isset($tag))
							{
								foreach($tag as $sub)
								{
									$sub;
									$row = $dbc->GetRecord("subcategory","*","id = '".$sub."'");
									?><li class="list-group-item">
									<input type="hidden" name="bran[]" value="<?php echo  $row['id'];?>">
									<?php echo  $row['name'];?> 
                                    <span class="badge" style="cursor:pointer" onclick="fn.app.product.pop(this)">Remove</span></li><?php
								}
							}
						?>
                        </ul>
                    </div>
                </div>-->
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Product Title*</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="tx_title" name="tx_title" placeholder="Listing Title" value="<?php echo $namep[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Product Description*</label>
                    <div class="col-sm-10">
                        <textarea  class="form-control editor" id="tx_desc" name="tx_desc" placeholder="Listing Description"><?php echo $detail[0];?></textarea>
                    </div>
                </div>
               
               <div class="form-group">
                   <label for="txtDetail" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <center>
                        <a id="openmore" class="btn btn-default"><span id="arro" class="glyphicon " aria-hidden="true" style=" font-size:18px;"></span> Thai Title and Description</a>
                        </center>
                   </div>
               </div>
               
                <div id="thai" style="display:none;">
                    <div class="form-group">
                        <label for="txtDetail" class="col-sm-2 control-label">Product Title TH*</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="tx_title_th" name="tx_title_th" placeholder="Listing Title" value="<?php echo $namep[1];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtDetail" class="col-sm-2 control-label">Product Description TH*</label>
                        <div class="col-sm-10">
                            <textarea  class="form-control editor" id="tx_title_th" name="tx_title_th" placeholder="Listing Description"><?php echo $detail[1];?></textarea>
                        </div>
                    </div>
                </div>
                
                
                <script>
					tick=0;
					$("#arro").addClass('glyphicon-circle-arrow-down');
					$("#openmore").click(function(e) {
						if(tick==0)
						{
							$("#thai").slideDown(200);
							$("#arro").addClass('glyphicon-circle-arrow-up');
							$("#arro").removeClass('glyphicon-circle-arrow-down');
							tick=1;
						}
						else
						{
							$("#thai").slideUp(200);
							$("#arro").addClass('glyphicon-circle-arrow-down');
							$("#arro").removeClass('glyphicon-circle-arrow-up');
							tick=0;
						}
                        
                    });
				</script>
                <!--<div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Quantity*</label>
                    <div class="col-sm-5">
                        <input type="number"  class="form-control" id="tx_quantity" name="tx_quantity" placeholder="Quantity">
                    </div>
                    <label for="txtDetail" class="col-sm-1 control-label">Unit</label>
                    <div class="col-sm-4">
                        <input type="date"  class="form-control" id="tx_toData" name="tx_toData"  >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Expiration Date*</label>
                    <div class="col-sm-5">
                        <input type="date"  class="form-control" id="tx_startDate" name="tx_startDate"  >
                    </div>
                    <label for="txtDetail" class="col-sm-1 control-label">To</label>
                    <div class="col-sm-4">
                        <input type="date"  class="form-control" id="tx_toData" name="tx_toData"  >
                    </div>
                </div>-->
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Expire Date*</label>
                    <div class="col-sm-10">
                        <input type="date"   class="form-control" id="tx_exp" name="tx_exp" value="<?php echo $pro['exp'];?>">
                    </div>
                </div>
              <?php
			$suppli = $dbc->GetRecord("suppliers","*","id='".$pro['supplier']."'");
			?>  
             <div class="page-header">
              <font size="+2">Supplier Information <small></small></font>
            </div>
            
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="txtsuppid" name="txtsuppid" placeholder="Supplier Name" value="<?php echo $pro['supplier'];?>">
                    <input type="text" class="form-control" id="txtsuppName" name="txtsuppName" placeholder="Supplier Name" value="<?php echo $suppli['name'];?>">
                </div>
                <div class="col-sm-2">
                    <a id="btnLoading" class="btn btn-primary" onClick="fn.app.product.lookup_suppiler('<?php echo $pro['supplier'];?>')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                    <a id="more" class="btn btn-default" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    <a id="minus" class="btn btn-default" style="display:none;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                </div>
            </div>
               
            <div id="addnew" style="display:none;">
            	<input type="checkbox" value="newsupp" id="newsupp" name="newsupp">
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_Name" name="sup_Name" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_surName" name="sup_surName" placeholder="Surname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Tax ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txttax" name="txttax" placeholder="Tax ID">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone">
                    </div>
                    <label class="col-sm-1 control-label">Mobile</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">E-Mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="txtAddress" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <!--<div class="form-group">
                    <label class="col-sm-2 control-label">Contact person </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtFirst" name="txtFirst" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtSurname" name="txtSurname" placeholder="Surname">
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-sm-2 control-label">District</label>
                    <div class="col-sm-4">
                        <select id="cbbDistrict" name="cbbDistrict" class="form-control">
                        <?php
						$sql= "SELECT * FROM districts WHERE city =  ".$address['city'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['district']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                        
                    </div>
                    <label class="col-sm-2 control-label">Subdistrict</label>
                    <div class="col-sm-4">
                        <select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
                        <?php
						$sql= "SELECT * FROM subdistricts WHERE district =  ".$address['district'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['subdistrict']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Province</label>
                    <div class="col-sm-4">
                        <select id="cbbProvince" name="cbbProvince" class="form-control">
                        <?php
						$sql= "SELECT * FROM cities WHERE country =  ".$address['country'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['city']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">Postal</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <select id="cbbCountry" name="cbbCountry" class="form-control">
                        <?php
						$sql= "SELECT * FROM countries WHERE id =  ".$address['country'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['city']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                    </div>
                </div>
            </div>
            
             
            <div class="page-header">
              <font size="+2">Price Information <small></small></font>
            </div>    
            	<?php $setting = json_decode($pro['setting'],true);
				
				
				
				?>
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Price*</label>
                    <div class="col-sm-5">
                       <input type="number"   class="form-control" id="tx_price" name="tx_price" placeholder="0.00" value="<?php echo $setting['price'];?>">
                    </div>
                   
                    <div class="col-sm-5">
                        <select class="form-control" id="exchange" name="exchange">
                        	<option value="Bath">Bath</option>
                            <option value="Price on Ask">Price on Ask</option>
                            <option value="Guide Price">Guide Price</option>
                            <option value="Negotiable">Negotiable</option>
                            <option value="Preemption">Preemption</option>
                            <option value="Starting Price">Starting Price</option>
                            <option value="Auction">Auction</option>
                            <option value="Including Furniture">Including Furniture</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Discount (%)</label>
                    <div class="col-sm-5 ">
                        <input type="number"  class="form-control" id="tx_discount" name="tx_discount" placeholder="Discount" value="<?php echo $setting['discount_percentage']*100;?>">
                        
                    </div>
                    <div class="col-sm-4 input-group">
                        <input type="number"  class="form-control" id="tx_discount_bath" name="tx_discount_bath" placeholder="Discount" value="<?php echo $setting['discount'];?>" readonly>
                        <div class="input-group-addon">Bath</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Total Price</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" id="tx_total" name="tx_total" placeholder="Total Price" value="<?php echo $setting['price']*$setting['discount_percentage'];?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Commission*</label>
                    <div class="col-sm-5">
                        <input type="number"   class="form-control" id="tx_comm" name="tx_comm" placeholder="0.00" max="javascript:$('#tx_total').val()" value="<?php echo $setting['commission'];?>">
                    </div>
                    <div class="col-sm-4 input-group">
                        <input type="number"   class="form-control" id="tx_percent" name="tx_percent" readonly placeholder="%" value="<?php echo $setting['commission_percentage']*100;?>">
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Salling Price</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" id="tx_salling" name="tx_salling" placeholder="Total Price" value="<?php echo $setting['salling_price'];?>" readonly>
                    </div>
                </div>
               <script>
			   $(document).ready(function(e) {
				   
				    $("#tx_comm").blur(function(e) {
						
						var tt = $('#tx_total').val();
						var commi = $('#tx_comm').val();
                        if(commi > tt)
						{
							$(this).val($('#tx_total').val());
						}
						
						percent = ($("#tx_comm").val() / $("#tx_total").val()) * 100 ;
						$("#tx_percent").val(percent);
						salling = parseInt(tt)+parseInt(commi);
						$("#tx_salling").val(salling);
                    });
				   	
					
				   	$("#tx_comm").change(function(e) {
                    	$("#tx_comm").attr('max',$('#tx_total').val());
               		});
					
					
                	$("#tx_discount").keyup(function(e) {
						price = $("#tx_price").val();
						discount = $(this).val();
						total = (price*discount)/100;
						net =price-total;
						$("#tx_total").val(net);
						
						$("#tx_discount_bath").val(parseInt(price)-parseInt(net));
					});
					
					$("#tx_price").keyup(function(e) {
						discount = $("#tx_discount").val();
						price = $(this).val();
						total = (price*discount)/100;
						net =price-total;
						$("#tx_total").val(net);
					});
            	});
			   </script> 
               
            	
             
             	<div class="form-group">
                    <label for="txtDetail" class="col-sm-2 control-label">Point</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" id="tx_point" name="tx_point" placeholder="Point" value="<?php echo $pro['point'];?>" >
                    </div>
                </div>
               <!--<a id="next1" href="#supplier" data-toggle="tab" class="btn btn-primary pull-right">Next</a>-->
               <a id="next2" href="#location" data-toggle="tab" class="btn btn-primary pull-right">Next</a>
               <script>
			   		$("#next1").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tsub").addClass('active');
                    });
			   </script>
        </div>
        
        
         <!--<div class="tab-pane<?php if($tab=="supplier")echo' active'; ?>" id="supplier">
        
            <div class="page-header">
              <font size="+2">Supplier Information <small></small></font>
            </div>
            
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                <div class="col-sm-8">
                    <input type="hidden" class="form-control" id="txtsuppid" name="txtsuppid" placeholder="Supplier Name" value="<?php echo $pro['supplier'];?>">
                    <input type="text" class="form-control" id="txtsuppName" name="txtsuppName" placeholder="Supplier Name" value="<?php echo $suppli['name'];?>">
                </div>
                <div class="col-sm-2">
                    <a id="btnLoading" class="btn btn-primary" onClick="fn.app.product.lookup_suppiler('<?php echo $pro['supplier'];?>')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                    <a id="more" class="btn btn-default" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    <a id="minus" class="btn btn-default" style="display:none;"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
                </div>
            </div>
            
                
                
            <div id="addnew" style="display:none;">
            	<input type="checkbox" value="newsupp" id="newsupp" name="newsupp">
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_Name" name="sup_Name" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_surName" name="sup_surName" placeholder="Surname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Tax ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txttax" name="txttax" placeholder="Tax ID">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone">
                    </div>
                    <label class="col-sm-1 control-label">Mobile</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">E-Mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="txtAddress" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <!--<div class="form-group">
                    <label class="col-sm-2 control-label">Contact person </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtFirst" name="txtFirst" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtSurname" name="txtSurname" placeholder="Surname">
                    </div>
                </div>-5->
                <div class="form-group">
                    <label class="col-sm-2 control-label">District</label>
                    <div class="col-sm-4">
                        <select id="cbbDistrict" name="cbbDistrict" class="form-control">
                        <?php
						$sql= "SELECT * FROM districts WHERE city =  ".$address['city'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['district']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                        
                    </div>
                    <label class="col-sm-2 control-label">Subdistrict</label>
                    <div class="col-sm-4">
                        <select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
                        <?php
						$sql= "SELECT * FROM subdistricts WHERE district =  ".$address['district'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['subdistrict']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Province</label>
                    <div class="col-sm-4">
                        <select id="cbbProvince" name="cbbProvince" class="form-control">
                        <?php
						$sql= "SELECT * FROM cities WHERE country =  ".$address['country'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['city']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">Postal</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <select id="cbbCountry" name="cbbCountry" class="form-control">
                        <?php
						$sql= "SELECT * FROM countries WHERE id =  ".$address['country'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['city']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                        </select>
                    </div>
                </div>
            </div>
  				<a id="prev1" href="#basic" data-toggle="tab" class="btn btn-primary ">Prev</a>
                <a id="next2" href="#location" data-toggle="tab" class="btn btn-primary pull-right">Next</a>-->
               <script>
			   		$("#more").click(function(e) {
						$("#newsupp").prop('checked',true);
						$("#btnLoading").addClass('disabled');
						$("#txtsuppName").prop('disabled', true);
						$("#more").fadeOut(00);
						$("#minus").fadeIn(200);
                        $("#addnew").slideDown(200);
                    });
					
					$("#minus").click(function(e) {
						$("#newsupp").prop('checked',false);
						$("#btnLoading").removeClass('disabled');
						$("#txtsuppName").prop('disabled', false);
						$("#more").fadeIn(200);
						$("#minus").fadeOut(00);
                        $("#addnew").slideUp(200);
                    });
					
					
					
			   		$("#prev1").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tbasic").addClass('active');
                    });
					$("#next2").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tlocation").addClass('active');
                    });
			   </script>
        <!--</div>-->
        
        
        <div class="tab-pane<?php if($tab=="location")echo' active'; ?>" id="location">
        
<?php /*?>            <div class="page-header">
              <font size="+2">Location Information <small></small></font>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Province</label>
                <div class="col-sm-10">
                    <select id="cbb2Province" name="cbb2Province" class="form-control">
                    <?php
						$sql= "SELECT * FROM cities WHERE country =  ".$address['country'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['city']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">District</label>
                <div class="col-sm-10">
                    <select id="cbb2District" name="cbb2District" class="form-control">
                    <?php
						$sql= "SELECT * FROM districts WHERE city =  ".$address['city'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['district']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Area</label>
                <div class="col-sm-10">
                    <select id="cbb2Subdistrict" name="cbb2Subdistrict" class="form-control">
                    <?php
						$sql= "SELECT * FROM subdistricts WHERE district =  ".$address['district'];
						$rst = $dbc->Query($sql);
						while($line = $dbc->Fetch($rst)){
							$selected = $line['id']==$address['subdistrict']?" selected":"";
							echo "<option value='$line[id]'$selected>$line[name]</option>";
						}
					?>
                    </select>
                </div>
            </div>
            <?php
			$prop = explode("|",$address['address']);
			?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Property Name</label>
                <div class="col-sm-10">
                    <input type="text" id="propname" name="propname" class="form-control" placeholder="Property Name" value="<?php echo $prop[0];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Street Number</label>
                <div class="col-sm-10">
                    <input type="text" id="street" name="street" class="form-control" placeholder="Street Number" value="<?php echo $prop[1];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Postcode</label>
                <div class="col-sm-10">
                    <input type="text" id="postcode" name="postcode" class="form-control" placeholder="Postcode" value="<?php echo $address['postal'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Location google map*</label>
                <div class="col-sm-10">
                    <input type="text" id="map" name="map" class="form-control" placeholder="13.687042, 100.609465" value="<?php echo $address['location'];?>">
                </div>
            </div>
            
            <div class="form-group" style="display:none;">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    <select id="cbb2Country" name="cbb2Country" class="form-control">
                    
                    </select>
                </div>
            </div>
<?php */?>  
  				<!--<a id="prev2" href="#supplier" data-toggle="tab" class="btn btn-primary ">Prev</a>-->
                <a id="prev1" href="#basic" data-toggle="tab" class="btn btn-primary ">Prev</a>
                <a id="next3" href="#schedule" data-toggle="tab" class="btn btn-primary pull-right">Next</a>
               <script>
			   		$("#prev2").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tsub").addClass('active');
                    });
					$("#next3").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tschedule").addClass('active');
                    });
			   </script>
        </div>
        
        
        
        <div class="tab-pane<?php if($tab=="schedule")echo' active'; ?>" id="schedule">
        
        	<div class="page-header">
              <font size="+2">schedule Information <small></small>
              <a id="loadme" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-refresh " aria-hidden="true"></span></a>
              <a id="addschedule" onClick="fn.app.product.add_schedule()" class="btn btn-default pull-right"><span class="glyphicon glyphicon-plus " aria-hidden="true"></span></a>
              </font>
            </div>
            <?php $period = $dbc->GetRecord("periods","*","product=".$id);$week = json_decode($period['classday'],true);
			
			?>
            <input type="hidden" name="period" value="<?php echo $period['id'];?>">
            <div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Branch</label>
                    <div class="col-sm-10" style="padding:0px;">
                    	<div id="schedule_data" class="col-sm-12" ></div>
                    </div>s
                </div>
                <div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Start Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="txt_startDate" name="txt_startDate" value="<?php echo $period['start'];?>">
                    </div>
                     <label for="txtPhoto" class="col-sm-2 control-label">End Date</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="txt_endDate" name="txt_endDate" value="<?php echo $period['end'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Seat Amount</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txt_seat" name="txt_seat" value="<?php echo $period['available'];?>">
                    </div>
                </div>
                <div id="addweek" class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Week</label>
                    <div class="col-sm-10">
                    	<div class="col-md-2">
                        <select class="form-control" name="weekday[]" id="weekday">
                        	<option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        </div>
                        <div class="col-md-1">
                        	<input type="checkbox" name="allday[]" id="allday" value="allday"> Allday
                        </div>
                        <label for="txtPhoto" class="col-sm-1 control-label">Start Time</label>
                        <div class="col-md-1">
                        	<select class="form-control " id="start_time_hour" name="start_time_hour[]">
                            <?php 
                            for($st=0;$st<=23;$st++)
                            {?>
                                <option value="<?php echo ($st<10)?'0'.$st:$st;?>"><?php echo ($st<10)?'0'.$st:$st;?></option><?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                        	<select class="form-control " id="start_time_minute" name="start_time_minute[]">
                            <?php 
                            for($st=0;$st<=59;$st++)
                            {
                                ?><option value="<?php echo ($st<10)?'0'.$st:$st;?>"><?php echo ($st<10)?'0'.$st:$st;?></option><?php
                            }
                            ?>
                            </select>
                        </div>
                       <label for="txtPhoto" class="col-sm-1 control-label">End Time</label>
                        <div class="col-md-1">
                        	<select class="form-control " id="end_time_hour" name="end_time_hour[]">
                            <?php 
                            for($st=0;$st<=23;$st++)
                            {
                                ?><option value="<?php echo ($st<10)?'0'.$st:$st;?>"><?php echo ($st<10)?'0'.$st:$st;?></option><?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                        	<select class="form-control " id="end_time_minute" name="end_time_minute[]">
                            <?php 
                            for($st=0;$st<=59;$st++)
                            {
                                ?><option value="<?php echo ($st<10)?'0'.$st:$st;?>"><?php echo ($st<10)?'0'.$st:$st;?></option><?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                        	<button type="button" class="btn btn-primary" onClick="fn.app.product.append_week()">
                            	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div id="addException" class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">Exception</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="txt_exception" name="txt_exception[]" placeholder="Exception">
                    </div>
                    <div class="col-sm-2">
                    	<button type="button" class="btn btn-primary" onClick="fn.app.product.append_Exception()">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                    
                </div>
                
            
            
            <div id="schedule_data" class="col-sm-12"></div>
            
            	<!--schedule--->
           		<a id="prev3" href="#location" data-toggle="tab" class="btn btn-primary ">Prev</a>
                <a id="next4" href="#media" data-toggle="tab" class="btn btn-primary pull-right">Next</a>
                <?php
				$inven = $dbc->GetRecord("inventories","*","product = '".$pro['id']."'");
				?>
                <input type="hidden" id="inv" name="inv" value="<?php echo $inven['id'];?>">
               <script>
			   		 $.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/product/xhr/load-branchs.php",
								data: {id:$("#txtsuppid").val()},
								success : function(json)
								{
									$("#schedule_data").html(json);
								}
						});
			   		$("#tschedule").click(function(e) {
                        $.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/product/xhr/load-branchs.php",
								data: {id:$("#txtsuppid").val()},
								success : function(json)
								{
									$("#schedule_data").html(json);
								}
						});
                    });
					$("#next3").click(function(e) {
                        $.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/product/xhr/load-branchs.php",
								data: {id:$("#txtsuppid").val()},
								success : function(json)
								{
									$("#schedule_data").html(json);
								}
						});
                    });
					
			   		$("#prev3").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tlocation").addClass('active');
                    });
					$("#next4").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tmedia").addClass('active');
                    });
			   </script>
               
        </div>
        <div class="tab-pane<?php if($tab=="media")echo' active'; ?>" id="media">
        
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
              
               <div class="row" id="container_thumbnail_photo">
                    <?php
					$st = json_decode($media['photo'],true);
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
			
            <ol id="subvdo" class="breadcrumb" style="display:none;">
            	
                <div class="page-header">
                  <font size="+2">Embed Video<small></small></font>
                </div>            
              	<script>
				$(function(){
					if($("#upvdo").prop('checked'))
					{
						$("#myupload").slideDown(200);
						$("#youtube").slideUp(200);
					}
					else
					{
						 $("#youtube").slideDown(200);
						$("#myupload").slideUp(200);
					}
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
                
                <?php $vdo = base64_decode($media['video']);
					$exvdo = explode("|",$vdo);?>
                    
                	<div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Choose</label>
                        <div class="col-sm-10">
                            <input type="radio" id="upvdo"  name="cho" value="upload"  <?php echo ($exvdo[0])?'checked':'';?>> Upload Video &nbsp;&nbsp;&nbsp;
                            <input type="radio" id="embed" name="cho" value="embed" <?php echo ($exvdo[1])?'checked':'';?>> Embed Video
                        </div>
                        
                    </div>
                    
                <div id="myupload">
                	<div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Video</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtvdo" name="txtvdo" placeholder="Name" value="<?php echo $exvdo[0];?>">
                        </div>
                        <div class="col-sm-2">
                            <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.product.dialog_vdo.open_elfinder();">Browse</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txtPhoto" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtvdoPhotos" name="txtvdoPhotos" placeholder="Name" value="<?php echo $media['video_photo'];?>">
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
                            <input type="text" class="form-control" id="txtem" name="txtem" placeholder="Name" ><br>
                        	<?php echo $exvdo[1];?>
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
                        <input type="text" class="form-control" id="txtDoc" name="txtDoc" placeholder="Name" value="<?php echo $media['document'];?>">
                    </div>
                    <div class="col-sm-2">
                        <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.product.dialog_doc.open_elfinder();">Browse</div>
                    </div>
                </div>
                
               
           </ol>
            
            	<a id="prev4" href="#schedule" data-toggle="tab" class="btn btn-primary ">Prev</a>
                
                <a id="save" onClick="fn.app.product.dialog_update_product()" class="pull-right btn btn-primary pull-right"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save</a>
               <script>
			   		$("#prev4").click(function(e) {
						$(".ltab").children('.active').removeClass('active');
                        $("#tschedule").addClass('active');
                    });
			   </script>
        </div>
        
        		
    </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>