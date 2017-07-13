<?php
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$lang = 1;
	
	$limit = isset($_REQUEST['limit'])?$_REQUEST['limit']:'8';
	$page = isset($_REQUEST['page'])?$_REQUEST['page']:'1';
	$started = isset($_REQUEST['start'])?$_REQUEST['start']:'0';
	
	/* echo '<pre>';
	echo $page;
	echo $limit;
	echo '</pre>'; */

	
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
<?php
			// $new = $dbc->Query("SELECT * FROM news WHERE status > '0'  ORDER BY `updated` DESC");
			$sql = $dbc->Query("SELECT * FROM news  WHERE   status > 0 LIMIT ".$started.",$limit");
			$i=1;
	while($title = $dbc->Fetch($sql))
	{	
?>
<style>
.tranboxhover{
	margin-top:20px;
}
.tranboxhover:hover {
    -webkit-filter: grayscale(75%);
    filter: grayscale(75%);
	cursor: pointer;
}
</style>
		<a href="/event_detail&eid=<?php echo $title['id']; ?>">
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 tranboxhover">
				<img src=" libs/<?php echo $title['photo']; ?> " id="imgs" width="100%" />
				<p><?php 
					echo explode("|",$title['headline'])[1];
				?></P>
		</div>
		</a>
		
<?php
	if(($i%4)==0){
		echo '</div>';
		echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">';
	}
	$i++;
	}
?>
<!--
<div class="row">
-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
	<nav class="pagination-container text-center">
		<ul class="pagination">
		<?php 
		function string_len($text,$amount)
		{
			if(strlen($text)>$amount)
			{
				return substr($text,0,$amount).'...';
			}
			else
			{
				return $text;
			}
		}
		
		$show_number =$limit;
		
		// $page = isset($_REQUEST['page'])?$_REQUEST['page']:'1';
		
		$dbc->pagination_prev_M('/event',$started,$show_number,$page);

		$dbc->pagination_M('news',"status > 0 ",'/event',$show_number,$page);

		$total = $dbc->GetCount("news","status > 0 ");
		
		$dbc->pagination_next_M('/event',$started,$show_number,$total,$page);
	
		?>
		</ul>
	</nav>
</div>
<script>
	$(document).ready(function(e) {
		/* var pagination = $(".pagination").find('alt').val();	
		alert(pagination); */
	});	
	function page(p,s,l){
		// $(".sub").find(".c").attr('alt');
		// alert(p);
		
		$.ajax({
			url:"libs/xhr/action-loadevent.php",
			dataType:"html",
			data:{page:p,start:s,limit:l},
			type:"POST", 
			success: function(respo){
				$(".ShowEvent").html(respo);
			}
		});
	}

	</script>