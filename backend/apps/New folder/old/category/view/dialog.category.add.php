<ol class="breadcrumb">
	<li><font size="+2">Categories </font></li>
	<li><a href="#">Home</a></li>
	<li><a href="#">Categories</a></li>
	<a id="back" class="pull-right btn btn-danger" onclick="fn.navigate('view')">
		<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close
	</a>
	
	<a id="save" onClick="fn.app.category.add()" class="pull-right btn btn-primary">
		<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
	</a>
</ol>

<form id="add_category" class="form-horizontal" role="form">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Category </h3>
		</div>
		<div class="panel-body">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Category</a></li>
				<!--<li role="presentation"><a href="#advertise" aria-controls="advertise" role="tab" data-toggle="tab">Advertise</a></li>-->
			</ul>
			
			<div class="tab-content" style="padding-top:10px;">
				<div role="tabpanel" class="tab-pane active" id="home">
					<div class="form-group">	
						<label class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
						<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>
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
                    
                    <div id="thailang" style="display:none;">
                    	<div class="form-group">	
                            <label class="col-sm-2 control-label">ชื่อ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtName_th" name="txtName_th" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">รายละเอียด</label>
                            <div class="col-sm-10">
                            <textarea  class="form-control" id="txtDetail_th" name="txtDetail_th" placeholder="Detail"></textarea>
                            </div>
                        </div>
                    </div>
                    
					<div class="form-group">
						<label for="txtDetail" class="col-sm-2 control-label">Hover Color</label>
						<div class="col-sm-4">
							<input type="color"  class="form-control" id="txtColor" name="txtColor" placeholder="Detail">
						</div>
						<label for="txtDetail" class="col-sm-2 control-label">Status</label>
						<div class="col-sm-4">
							<select name="cbbStatus"  id='cbbStatus' class="form-control">
								<option value='1'>Enable</option>    
								<option value='0'>Disable</option>    
							</select>   
						</div>
					</div>
					<div class="form-group">
						<label for="txtPhoto" class="col-sm-2 control-label">Icon</label>
						<div class="col-sm-4">
							<img id="txtIcon" src="/upload/thumb/icon.jpg" class="img-responsive" style="border:1px solid #999;">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control"  id="txticon" name="txtIcon">
						</div>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.dialog_thumb.open_elfinder()">Browse</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="txtPhoto" class="col-sm-2 control-label">Main Photo</label>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.images.open_elfinder('txtPhotoMain')">Browse</div>
						</div>
                        
                        <div class="row col-md-12" id="container_thumbnail_photo">
                    <?php
                        if(isset($st['images']))
                        {
                            foreach($st['images'] as $img){
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
                    
                    
                    <div class="form-group">
						<label for="txtPhoto" class="col-sm-2 control-label">Header Photo</label>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.images.open_elfinder_header('txtPhotoMain')">Browse</div>
						</div>
                        
                        <div class="row col-md-12" id="container_thumbnail_photo2">
                    <?php
                        if(isset($st['images']))
                        {
                            foreach($st['images'] as $img){
                                echo '<div class="col-md-2">';
                                echo '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
                                ?>
                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00; top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span><?php
                                echo '<img src="'.$img.'" data-src="'.$img.'" alt="...">';
                                echo '<input type="hidden" name="txtPhoto2[]" value="'.$img.'">';
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
                    
					<!--<div class="form-group">
						<label for="txtPhotoSub" class="col-sm-2 control-label">Sub Photo</label>
						<div class="col-sm-4">
							<img id="txtPhotoSub" src="/upload/thumb/lp.jpg" class="img-responsive" style="border:1px solid #999;">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="txtPhotoSub" placeholder="Name">
						</div>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.images.open_elfinder('txtPhotoSub')">Browse</div>
						</div>
					</div>-->
					<div id="subvdo" class="form-group">
                        <div  class="form-group">
                                <label for="txtDetail" class="col-sm-2 control-label">Playlist Name</label>
                                <div  class="col-sm-8">
                                    Example : https://youtu.be/<font color="#FF0000">E6oF10izmFQ</font>
                                    <input type="text" class="form-control" id="txtYoutube" name="txtYoutube[]" placeholder="Playlist Name"><br>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="txtDetail" class="col-sm-2 control-label"></label>
                        <div  class="col-sm-8">
                        	<button type="button" class="btn btn-primary" onClick="fn.app.category.append_subyoutube()">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </div>
					</div>
                </div>
                
                
                
				<!--<div role="tabpanel" class="tab-pane" id="advertise">--><!--tap 2-->
					<!--<table class="table table-bordered" align="center" style="width:auto;">
						<tbody>
							<tr>
								<td colspan="3">
									<input type="hidden" name="img_avertise_0" value="">
									<img id="img_avertise_0" onclick="fn.app.category.images.open_elfinder('img_avertise_0')" data-src="holder.js/600x300" class="img-responsive center-block">
								</td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="img_avertise_1" value="">
									<img id="img_avertise_1" onclick="fn.app.category.images.open_elfinder('img_avertise_1')" data-src="holder.js/200x200" class="img-responsive">
								</td>
								<td>
									<input type="hidden" name="img_avertise_2" value="">
									<img id="img_avertise_2" onclick="fn.app.category.images.open_elfinder('img_avertise_2')" data-src="holder.js/200x200" class="img-responsive">
								</td>
								<td>
									<input type="hidden" name="img_avertise_3" value="">
									<img id="img_avertise_3" onclick="fn.app.category.images.open_elfinder('img_avertise_3')" data-src="holder.js/200x200" class="img-responsive">
								</td>
							</tr>
						</tbody>
					</table>-->
                    
                    
                    <!--<div class="form-group">
						<label for="txtPhoto" class="col-sm-2 control-label">Advertisement</label>
						<div class="col-sm-4">
							<img id="txtadvertisement" src="/upload/thumb/icon.jpg" class="img-responsive" style="border:1px solid #999;">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control"  id="txtads" name="txtads">
						</div>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.dialog_ads.open_elfinder()">Browse</div>
						</div>
					</div>-->
                    
                    
                    
                    
                    <!--<div class="form-group">
						<label for="txtPhoto" class="col-sm-2 control-label">Header Photo</label>
						<div class="col-sm-2">
							<div class="btn btn-default" onClick="fn.app.category.images.open_elfinder_slide('txtPhotoSlide')">Browse</div>
						</div>
                        
                        <div class="row col-md-12" id="container_thumbnail_slide">-->
                   
<?php /*?>                        if(isset($st['images']))
                        {
                            foreach($st['images'] as $img){
                                echo '<div class="col-md-2">';
                                echo '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
                                ?>
                                <span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00; top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span><?php
                                echo '<img src="'.$img.'" data-src="'.$img.'" alt="...">';
                                echo '<input type="hidden" name="txtPhoto_slide[]" value="'.$img.'">';
                                echo '</a>';
                                echo '</div>';
                                
                            }
                        }
                        else
                        {
<?php */?>                            

                            <!--<span class="glyphicon glyphicon-picture" aria-hidden="true" style="font-size:50px;"></span>-->
                            <?php
                       // }
                    ?>
                    	<!--</div>
					</div>
                    
				</div>
			</div>-->
		</div>
    </div>
</form>
<script>
// Append Thail Detail
	tick=0;
	$("#arro").addClass('glyphicon-circle-arrow-down');
	$("#openmore").click(function(e) {
		if(tick==0){
			$("#thailang").slideDown(200);
			$("#arro").addClass('glyphicon-circle-arrow-up');
			$("#arro").removeClass('glyphicon-circle-arrow-down');
			tick=1;
		}else{
			$("#thailang").slideUp(200);
			$("#arro").addClass('glyphicon-circle-arrow-down');
			$("#arro").removeClass('glyphicon-circle-arrow-up');
			tick=0;
		}           
	});	
</script>



