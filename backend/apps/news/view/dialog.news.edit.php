<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("news","*","id='".$id."'");
	$title = explode("|",$edit['headline']);
	$det = base64_decode($edit['detail']);
	$detail = explode("|",$det);
?>
<script>
$(document).ready(function(e) {
    // $( 'textarea.editor' ).ckeditor();
});
</script>

<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">ข่าวสาร & กิจกรรม</a> / แก้ไข</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">ข่าวสาร & กิจกรรม</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetailEdit">
            	<input type="hidden" name="txtID" value="<?php echo $id;?>">
				<!--
				<div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">ภาพสไลด์</label>
                    <div class="col-sm-4">
                        <img id="txtPhoto" src="<?php //echo $edit['photo']; ?>" class="img-responsive" style="border:1px solid #999;">
                    </div>
					 <div class="col-sm-4">
                        <input type="text" class="form-control"  id="txticon" name="txtIcon" value="<?php //echo $edit['photo']; ?>"><br>
                        <div id="browEdit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;&nbsp;เลือกรูปภาพ
                        </div>
                    </div>
                </div>
				-->
				<div class="form-group">
					<label for="txtphotoEdit" class="col-sm-2 control-label">ภาพสไลด์</label>	
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<div class="col-sm-10">
							<input id="txtphotoEdit" name="txtphotoEdit" type="text" class="form-control"	value="<?php echo $edit['photo'];; ?>" readonly>
						</div>   
						<div class="col-sm-2">
							<div class="btn btn-default" data-toggle="modal" id="browEdit" >Browse</div>
						</div> 
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<div class="ShowImgEdit">
							<div class="col-sm-12 test" style="margin-top:10px;">
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtphotoEdit" name="txtphotoEdit" value="<?php echo $edit['photo'];; ?>" readonly>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
								<img src="../../../libs/<?php echo $edit['photo']; ?> " width="300px" />
							</div>
						</div>
						<div class="seperator"></div>
						<div class="seperator"></div>
					</div>
				</div>
				<div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Category</label>
                    <div class="col-sm-10">
                       <select class="form-control" id="txtcate" name="txtcate">
						<?php
							//$select = "SELECT * FROM category WHERE id ='".$product['category']."'";
							$sql="SELECT * FROM news_categories";
							$rst = $dbc->Query($sql);
							while($line = $dbc->Fetch($rst)){
								echo '<option value="'.$line['id'].'"'.($line['id']==$edit['category']?" selected":"").'>'.$line['name'].'</option>';
							}
						?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">หัวข้อ (EN)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Title" name="tx_Title" value="<?php echo $title[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">หัวข้อ (TH)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Titleth" name="tx_Titleth" value="<?php echo $title[1];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด (EN)</label>
                    <div class="col-sm-10">
                        <textarea  class="form-control editor" id="tx_Detail" name="tx_Detail" ><?php echo $detail[0];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด (TH)</label>
                    <div class="col-sm-10">
                        <textarea type="email" class="form-control editor" id="tx_Detailth" name="tx_Detailth" ><?php echo $detail[1];?></textarea>
                    </div>
                </div>
            </form>
		
            
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.news.updateNews()">บันทึก</button>
                        <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">ยกเลิก</button>
                    </div>
                </div>
                <div id="output"></div>         
             
       </div>
  </div>
</div>

<form id="form_change_PhotoEdit" class="hidden">
	<input name="txtID" value="" type="hidden">
	<input id="fPhotoEdit" name="file" type="file">
</form>
<script >
$(function(){
	$("#fPhotoEdit").change(function(){
		var data = new FormData($("#form_change_PhotoEdit")[0]);
		jQuery.ajax({
			url: 'apps/news/xhr/action-upload-photo.php',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			success: function(response){
				console.log(response);
				if(response.success==true){
					$('#txtphotoEdit').val(response.photo);
					//window.location.reload();
					var s='';
					s+= '<div class="col-sm-12 test" style="margin-top:10px;">';
					s+= '<div class="col-sm-10">';
					s+='<input type="text" class="form-control" id="txtphotoEdit" name="txtphotoEdit" value="'+response.photo+'" readonly>';
					s+= '</div>';
					s+='<div class="col-sm-2">';
					s+= '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>';
					s+='</div>';
					s+= '<img src="../../../libs/'+response.photo+'" width="300px" />';
					s+= '</div>';
					$('.ShowImgEdit').html(s);
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});

	
	$("#browEdit").click(function(e) {
        $("#fPhotoEdit").click();
    });
});
</script>

