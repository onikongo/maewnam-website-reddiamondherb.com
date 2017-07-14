
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
.ImgInEventDetail{
	width:640px;
	height:640px;
}
.ImgInEventDetail_Reless{
	width:250px;
	height:250px;
}
@media screen and (min-width:768xp) and (max-width:1366px){
	.ImgInEventDetail_Reless{
		width:150px;
		height:150px;
	}
}
@media screen and (max-width:768px){
	.ImgInEventDetail{
		width:320px;
		height:320px;
	}
	.ImgInEventDetail_Reless{
		width:200px;
		height:200px;
	}
}
</style>
<div class="row" style="background:; padding-bottom:0px;">
	<!--
	<div class="container">
	-->
	<div class="col-xs-12 col-sm-12 col-md-12 nopad fon20 fon_color txt_horizental txt_just stan_line" style="text-indent:20px;  margin-left:-1px;">
    
    <h1 class="fon_dark text-center fon_main" style="margin-bottom:20px;"><?php echo $title[$lang]; ?></h1>
    	<hr>
		<!--
		<div class="col-xs-12 col-sm-12 col-md-12 nopad fon20 fon_color txt_horizental txt_just stan_line" style="text-indent:20px;  margin-left:-1px;">
		-->
		<div class="col-xs-12 col-xs-offset-0 col-md-8 col-md-offset-2 nopad" style="padding-bottom:15px;">
			<!--
			<div class="row">
			-->	
				<center>
				<div class="ImgInEventDetail">
					<img src=" libs/<?php echo $data['photo']; ?>" width="100%" class="center-block" />
				</div>
				</center>
				<br>
				<div class="col-xs-12 col-xs-offset-0 col-md-12 nopad">	
					<p  class="text-left top15 fon20 stan_line txt_just txt_horizental fon_color" style="text-indent:20px; text-align:justify;    font-weight: lighter; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; ">
						<?php echo $det[$lang];?>
					</p>
				
				</div>
			<!--	
			</div>
			-->
		</div>
		
    </div>
    <!--
	</div> 
	-->
</div>

<div class="row">
<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php
			$new = $dbc->Query("SELECT * FROM news WHERE status > '0' AND category =".$data['category']." ORDER BY `updated` DESC Limit 8");
			while($title = $dbc->Fetch($new))
			{	
		?>
		<a href="/event_detail&eid=<?php echo $title['id']; ?>">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 tranboxhover">
				<center>
				<div class="ImgInEventDetail_Reless">
					<img src=" libs/<?php echo $title['photo']; ?> " width="100%" class="center-block" />
				</div>
				</center>
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