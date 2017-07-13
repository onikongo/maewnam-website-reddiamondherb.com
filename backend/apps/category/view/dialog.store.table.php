<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
?>
	<style>
@media screen and (max-width:767px)
{
	.you
	{
		text-align:left;
	}
}
@import "http://fonts.googleapis.com/css?family=Montserrat:300,400,700";
.rwd-table {
  margin: 1em 0;
  min-width: 300px;
}
.rwd-table tr {
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}
.rwd-table th {
  display: none;
}
.rwd-table td {
  display: block;
}
.rwd-table td:first-child {
  padding-top: .5em;
}
.rwd-table td:last-child {
  padding-bottom: .5em;
}
.rwd-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
  width: 6.5em;
  display: inline-block;
}
@media (min-width: 480px) {
  .rwd-table td:before {
    display: none;
  }
}
.rwd-table th, .rwd-table td {
  text-align: center;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    display: table-cell;
    padding: .25em .5em;
  }
  .rwd-table th:first-child, .rwd-table td:first-child {
    padding-left: 0;
  }
  .rwd-table th:last-child, .rwd-table td:last-child {
    padding-right: 0;
  }
}


.rwd-table {
  background: #34495E;
  color: #fff;
  border-radius: .4em;
  overflow: hidden;
}
.rwd-table tr {
  border-color: #46637f;
}
.rwd-table th, .rwd-table td {
  margin: .5em 1em;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    padding: 1em !important;
  }
}
.rwd-table th, .rwd-table td:before {
  color: #000;
}

</style>

<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>
<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=<?php echo $_REQUEST['app'];?>">Category</a></font></div>
<div class="col-md-12" style="padding:10px;">
    <div><!-- Nav tabs -->
    
            	<div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Category</h3>
                    <!--<div align="right">-->
                        <button type="button"  class="btn btn-danger btn-sm pull-right but" onclick="fn.navigate('add')">เพิ่ม Category</button>
                    <!--</div>-->
                  </div>
                  <div class="panel-body nopad">
                    <div class=" nopad"><!--table-responsive-->
                        <table class="table table-bordered rwd-table">
                            <thead>
                                <tr>
                                    <!--<th class="text-center">Sort</th>-->
                                    <th class="text-center">ลำดับ.</th>
                                    <th class="text-center">ชื่อ</th>
                                    <th class="text-center no-sort">ตัวเลือก</th>
                                    <th class="text-center no-sort">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                    
                    <?php 
                    $sql = $dbc->Query("SELECT * FROM news_categories");
                    $i=1;
                    while($row = $dbc->Fetch($sql))
                    {	
                        ?>
                        <tr>
                            <!--<td class="text-center" valign="middle"><img src="../../../../upload/arrow.png"></td>-->
                            <td data-th="No." align="center"><?php echo $i;?></td>
                            <td data-th="Name" class="text-right"><?php echo $row['name'];?></td>
                          
                        
                            <td data-th="Action" class="text-center">
                                <button type="button" class="buticonEdit" onClick="fn.navigateEdit('edit','<?php echo $row['id'];?>')"><i class="fa fa-pencil-square" style="font-size:14px;"></i> </button>
                                <button type="button" class="buticonRem" onClick="fn.app.category.dialog_delete('<?php echo $row['id'];?>',this)"><i class="fa fa-times" style="font-size:14px;"></i></button>
                            </td>
                            <td data-th="Status." class="text-center">
                            <?php if($row['status']==1)
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" checked type="checkbox" onClick="fn.app.category.activ('<?php echo $row['id'];?>',this)">
                                    <label for="cmn-toggle-<?php echo $i;?>"></label>
                                </div><?php
                            }
                            else
                            {
                                ?><div class="switch">
                                    <input id="cmn-toggle-<?php echo $i;?>" class="cmn-toggle cmn-toggle-round" type="checkbox" onClick="fn.app.category.activ('<?php echo $row['id'];?>',this)">
                                    <label for="cmn-toggle-<?php echo $i;?>"></label>
                                </div><?php
                            }?>
                                
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>


	

</div>

<div class="closes">
	<div class="col-md-6 col-md-offset-3">
    	<div class="col-md-10">
        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            Are you sure you want to delete?
        </div>
        <div class="col-md-2" style="margin-top:100px;">
        	<button type="button" id="yes" class="btn btn-primary" >YES</button>
            <button type="button" id="no" class="btn btn-default">NO</button>
        </div>
        
    </div>
</div>
<div class="bgclose"></div>
<style>




.bgclose
{
	position:fixed;
	left:0;
	top:0;
	right:0;
	bottom:0;
	background:rgba(0,0,0,0.5);
	z-index:1000;
	display:none;
}
.closes
{
	position:fixed;
	height:200px;
	width:100%;
	left:0;
	right:0;
	top:50%;
	margin-top:-100px;
	background:rgba(255,44,44,0.8);
	z-index:1100;
	color:#fff;
	padding:20px;
	font-size:36px;
	display:none;
}
.buticonEdit
{
	background:none;
	border:2px solid #AAAAAA;
	border-radius:100%;
	color:#AAAAAA;
	width:35px;
	height:35px;
	outline:none;
}

.buticonRem
{
	background:none;
	border:2px solid #CA0005;
	border-radius:100%;
	color:#CA0005;
	width:35px;
	height:35px;
	outline:none;
}
.demo-icon
    {
      font-family: "fontello";
      font-style: normal;
      font-weight: lighter;
	  font-size:14px;
	  padding-top:10px;
	  padding-bottom:10px;
	  padding-left:2px;
	  padding-right:2px;
	  
 
    }
	
.nopad
{
	padding:0px;
}
.table
{
	background: #F8FAFC;
    font-weight: bold;
    color: #333;
    border-bottom: 1px solid #E5E5E5;
}
.table
{
	border:0px !important;
}
.table > tbody
{
	background:#fff
}
.table > tbody > tr > td
{
	padding:0px !important;
}
.table > tbody > tr > td
{
	font-weight:lighter;
}
.table > tbody > tr > td
{
	vertical-align: middle !important;
}

</style>
