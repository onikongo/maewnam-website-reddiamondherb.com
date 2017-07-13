<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	
?>
<script>
$(document).ready(function(e) {
    // $( 'textarea.editor' ).ckeditor();
	/*$("#sel_type").change(function(e) {
        if($(this).val()=='Photo')
		{
			$("#pho").slideDown(300);
			$("#embed").slideUp(300);
		}
		else
		{
			$("#pho").slideUp(300);
			$("#embed").slideDown(300);
		}
    });*/
});
</script>

<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">ข่าวสาร & กิจกรรม</a> / เพิ่ม</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">ข่าวสาร & กิจกรรม</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetail">
				<!--
				<div class="form-group">
                    <label for="txtPhoto" class="col-sm-2 control-label">ภาพสไลด์</label>
                    <div class="col-sm-4">
                        <img id="txtPhoto" src="/upload/thumb/lp.jpg" class="img-responsive" style="border:1px solid #999;">
                    </div>
					 <div class="col-sm-4">
                        <input type="text" class="form-control"  id="txticon" name="txtIcon"><br>
                        <div id="upload" class="btn btn-danger">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;&nbsp;เลือกรูปภาพ
                        </div>
                    </div>
                </div>
				-->
				<div class="form-group">
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<div class="col-sm-10">
						<input id="txtphoto" name="txtphoto" type="text" class="form-control" readonly>
					</div>   
					<div class="col-sm-2">
						<div class="btn btn-default" data-toggle="modal" id="browAdd" >Browse</div>
					</div> 
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<div class="ShowImg"></div>
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
								echo '<option value="'.$line['id'].'">'.$line['name'].'</option>';
							}
						?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">หัวข้อ (EN)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Title" name="tx_Title" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">หัวข้อ (TH)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Titleth" name="tx_Titleth" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด (EN)</label>
                    <div class="col-sm-10">
                        <textarea  class="form-control editor" id="tx_Detail" name="tx_Detail" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียด (TH)</label>
                    <div class="col-sm-10">
                        <textarea type="email" class="form-control editor" id="tx_Detailth" name="tx_Detailth" ></textarea>
                    </div>
                </div>
                
            </form>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.news.saveNews()">บันทึก</button>
                    <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">ยกเลิก</button>
                </div>
            </div>
       </div>
  </div>
</div>
<form id="form_change_Photo" class="hidden">
	<input name="txtID" value="" type="hidden">
	<input id="fPhoto" name="file" type="file">
</form>

<script>
$(function(){
	$("#fPhoto").change(function(){
		var data = new FormData($("#form_change_Photo")[0]);
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
					$('#txtphoto').val(response.photo);
					var s='';
					s+= '<div class="col-sm-12 test" style="margin-top:10px;">';
				/* 	s+= '<div class="col-sm-10" style="margin-bottom:10px;">';
					s+='<input type="text" class="form-control" id="txt_pic" name="txt_pic[]" value="'+response.photo+'" readonly>';
					s+= '</div>'; */
					s+='<div class="col-sm-12">';
					s+= '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>';
					s+='</div>';
					s+= '<img src="../../../libs/'+response.photo+'" width="300px" />';
					s+= '</div>';
					$('.ShowImg').html(s);
					//window.location.reload();
				}else{
					fn.engine.alert("Alert",response.msg);
				}	
			}
		});
	});
	/*$("#btnChangePhoto").click(function(){
		$("#dialogChangePhoto").modal("hide");
		$("#fPhoto").click();
	});*/
	$("#browAdd").click(function(e) {
        $("#fPhoto").click();
    });
});
</script>
