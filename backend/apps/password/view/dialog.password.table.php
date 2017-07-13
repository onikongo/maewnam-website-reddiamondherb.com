<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
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
	$(".clear").click(function(e) {
        $("#tx_old").val('');
		$("#tx_new").val('');
		$("#tx_conf").val('');
    });
});
</script>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=review">เปลี่ยนรหัสผ่าน</a></font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><b>เปลี่ยนรหัสผ่าน</b> </h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetail">
                <input type="hidden" id="parth" name="parth">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">รหัสผ่านปัจจุบัน</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="tx_old" name="tx_old" ><br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">รหัสผ่านใหม่</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="tx_new" name="tx_new" ><br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">ยืนยันรหัสผ่านใหม่</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="tx_conf" name="tx_conf" ><br>
                    </div>
                </div>
                
            
            <?php /*?><div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-8">
                    <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.gallery.saveImage()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                    <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                    <button type="button" id="unlik"  class="btn btn-danger"   onclick="fn.app.gallery.unlinkMe()" style="display:none;">Delete</button>
                </div>
            </div><?php */?>
         </form>  
       </div>
  </div>
   <div class="panel-footer">
   	<button type="button" class="btn btn-default btn-sm clear">ล้างข้อมูล</button>
    <button type="button" class="btn btn-default btn-sm pull-right" style="background:#33414e;color:#fff;" onClick="fn.app.password.newpass()">บันทึก</button>
   </div> 
</div>



