
<?php //$dbc = $this->dbc;
	include_once "config/define.php";
	include_once "libs/class/db.php";
	include_once "libs/class/cms.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$dbc = new dbc;
	$dbc->Connect();
	
	$limit = isset($_REQUEST['limit'])?$_REQUEST['limit']:8;
	// $pag = isset($_REQUEST['pag'])?$_REQUEST['pag']:1;
	
?>

<div class="row">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 txt_horizental">
    
    <h1 class="fon_dark text-center fon_main" style="margin-bottom:20px;">ข่าวสารและกิจกรรม</h1>
    	<hr>
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
			<div class="ShowEvent"></div>
		</div>
		
    </div>
</div>

<script>

var pag = '';

$(document).ready(function(e) {
    // $("#1").click();
	/* $.ajax({
		url:"libs/xhr/action-loadevent.php",
		dataType:"html",
		data:{id:<?php echo isset($_REQUEST['cate'])?$_REQUEST['cate']:'0';?>,pag:<?php echo isset($_REQUEST['pag'])?$_REQUEST['pag']:'0';?>},
		type:"POST", 
		success: function(respo){
			$(".ShowEvent").html(respo);
		}
	}); */
	$.ajax({
		url:"libs/xhr/action-loadevent.php",
		dataType:"html",
		data:{page:<?php echo ($_REQUEST['page']=='event')?'1':' ';?>,limit:<?php echo isset($_REQUEST['limit'])?$_REQUEST['limit']:8;?>},
		type:"POST", 
		success: function(respo){
			$(".ShowEvent").html(respo);
		}
	});	
});
function loadnews(id,me)
{
	$.ajax({
		url:"libs/xhr/action-loadnews.php",
		type:"POST",
		dataType:"html",
		data:{id:id},
		success: function(resulted){
			$("#detail").html(resulted);
		}
	});
}
</script>