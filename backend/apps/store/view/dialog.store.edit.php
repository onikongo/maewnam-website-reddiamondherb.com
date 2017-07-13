<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$edit = $dbc->GetRecord("store","*","id='".$id."'");
	$title = explode("|",$edit['name']);
	$det = base64_decode($edit['detail']);
	$detail = explode("|",$det);
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">ร้านตัวแทนจำหน่าย</a> / แก้ไข</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">ร้านตัวแทนจำหน่าย</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-8 col-md-offset-2" style="padding:10px;">
        	<form class="form form-horizontal" id="myFromdetailEdit">
            	<input type="hidden" name="txtID" value="<?php echo $id;?>">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">สาขา</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="bran" name="bran">
                        <?php 
						$sqlb = $dbc->Query("select * from branch");
						while($rowb = $dbc->Fetch($sqlb))
						{
							$sele = ($rowb['id']==$edit['branch'])?'selected':'';
							echo '<option value="'.$rowb['id'].'" '.$sele.'>'.explode("|",$rowb['name'])[0].'</option>';
						}
						?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (EN)</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_Title" name="tx_Title" value="<?php echo $title[0];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ (TH)</label>
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
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">เบอร์โทร</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="tx_phone" name="tx_phone" value="<?php echo $edit['phone'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">ตำแแหน่ง</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="tx_latiude" name="tx_latiude" placeholder="latitude" value="<?php echo $edit['latitude'];?>">
                    </div>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" id="tx_long" name="tx_long" placeholder="longtitude" value="<?php echo $edit['longtitude'];?>">
                    </div>
                </div>
                
            </form>
		
            
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.store.updatestore()">บันทึก</button>
                        <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">ยกเลิก</button>
                    </div>
                </div>
                <div id="output"></div>         
             
       </div>
  </div>
</div>



