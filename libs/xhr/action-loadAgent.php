<?php
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$lang = 1;
	$id = $_REQUEST['id'];
	$br = $dbc->Query("SELECT b.*,s.* FROM branch AS b INNER JOIN sector AS s ON b.sector=s.id WHERE b.sector = '".$id."'");
	$row = $dbc->Fetch($br);
	
	?>
    <div class="col-lg-12 " id="head-<?php echo $a;?>">
        <div id="headname" class="fon25 text-center top27 bottom27">
            <?php echo explode("|",$row['name'])[$lang];?>
        </div>
        <div class="col-lg-12 nopad">
            <center>
                <img src="libs/upload/logo distributor.jpg" width="70%">
            </center>
        </div>
    <?php
	$br2 = $dbc->Query("SELECT * FROM branch WHERE sector = '".$id."'");
	$a=0;
	while($branchs = $dbc->Fetch($br2))
	{
		$a++;
		
		?>
        <div class="col-lg-12 fon_dark fon20">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 top15 nopad">
					<a id="store-<?php echo $a;?>" class="f30 fon_dark"><?php echo explode("|",$branchs['name'])[$lang];?></a>
                    <?php
		$sql_store = $dbc->Query("select * from store where branch = '".$branchs['id']."'");
		while($store = $dbc->Fetch($sql_store))
		{
			@$det = base64_decode($store['detail']);
			@$details = explode("|",$det)[$lang];?>
				
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
							<p class="mleft top15" ><?php echo explode("|",$store['name'])[$lang];?></p>		
							<p class="mleft"><?php echo $details;?></p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 nopad padleft">   
							<a href="tel:<?php echo $store['phone'];?>"><button class="btncall"></button></a> 
                            <a href="http://maps.google.com/maps?z=18&q=<?php echo $store['latitude'];?>,<?php echo $store['longtitude'];?>" target="_blank"><button class="btn_map" data-toggle="modal" data-target=".boxmap" ></button></a>
						</div>
					</div>    
		
		<?php
        }
		?></div>
			</div>
            <?php
	}
	?>
    </div>
    
    
    
