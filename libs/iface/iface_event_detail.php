
<?php //$dbc = $this->dbc;
	include_once "config/define.php";
	include_once "libs/class/db.php";
	include_once "libs/class/cms.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	
	$eid = $_REQUEST['eid'];
	
	$lang = 1;
	
	$data = $dbc->GetRecord("news","*","id='".$eid."'");
	$title = explode("|",$data['headline']);
	$detail = base64_decode($data['detail']);
	$det = explode("|",$detail);
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
<div class="row">
	<div class="container">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-lg-12 txt_horizental">
    
    <h1 class="fon_dark text-center fon_main" style="margin-bottom:20px;">ข่าวสารและกิจกรรม</h1>
    	<hr>
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
			<div class="row">
				<div class="container">
					<img src=" libs/<?php echo $data['photo']; ?>" width="100%" />
					<br><br>
					<p> <?php echo $title[$lang]; ?> <p>
					<br>
					<p>
						<?php echo $det[$lang];?>
					</p>
				</div>
			</div>
		</div>
		
    </div>
    </div>
</div>

<div class="row">
<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopad">
		<?php
			$new = $dbc->Query("SELECT * FROM news WHERE status > '0' AND category =".$data['category']." ORDER BY `updated` DESC Limit 8");
			while($title = $dbc->Fetch($new))
			{	
		?>
		<a href="/event_detail&eid=<?php echo $title['id']; ?>">
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 tranboxhover">
				<img src=" libs/<?php echo $title['photo']; ?> " id="imgs" width="100%" />
				<p><?php 
					echo explode("|",$title['headline'])[1];
				?></P>
		</div>
		</a>
		<?php
			}
		?>
	</div>
</div>
</div>