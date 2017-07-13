<?php 

	include_once "config/define.php";
	include_once "libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	
	//include"libs/iface/iface_menu.php";
?>
<?php //include_once("analyticstracking.php") ?>




<script>
$(document).ready(function(e) {
    var he = $(".leftside").height();
	$(".textt").css({"height":he-10});
	$(".int").css({"padding-top":(he/2)-30+"px"});

});
function visitto(posi)
{
        $('html,body').animate({ 
			scrollTop: $("#"+posi+"").offset().top-50
		}, 1000);
}


function thisme(id,me,text)
{
	var sta = $(me).children().val();
	//alert(id+'-'+sta);
	var sp_id = id.split("-");
	//alert(sp_id[1]);
	if(sta==0)
	{
		$(".panel_me").css({"background":"#737172"});
		$(me).css({"background":"#293f21"});
		$('img.ico').css({"transform": "rotate(0deg)","transition":"all 0.3s"});
		$(me).find('img.ico').css({"transform": "rotate(90deg)","transition":"all 0.3s"});
		
		$(".textt").fadeOut();
		sta=1;
		$(".sta").val(0);
		$(me).children().val(1);
		$(".boxy").fadeIn(200);
		$.ajax({
			url:"libs/xhr/action-loadAgent.php",
			type:"POST",
			dataType:"html",
			data:{id:text},
			success: function(resulted){
				$("#det_agent").html(resulted).fadeIn();
			}
		});
	}
	else
	{
		$(".panel_me").css({"background":"#737172"});
		$(".textt").fadeIn();
		$("#det_agent").fadeOut();
		$('img.ico').css({"transform": "rotate(0deg)","transition":"all 0.3s"});
		sta=0;
		$(me).children().val(0);
	}
	
	
}


function arrow(me,val)
{
	var num = $(me).children().children('a').children('.amt').val();
	if(num==0)
	{
		$(me).children().children('a').children('img.ico').css({"transform": "rotate(90deg)","transition":"all 0.3s"});
		num=1;$(me).children().children('a').children('.amt').val(1);
	}
	else
	{
		$(me).children().children('a').children('img.ico').css({"transform": "rotate(0deg)","transition":"all 0.3s"});
		num=0;$(me).children().children('a').children('.amt').val(0);
	}
	
}

function arrow_main(me,val)
{
	var num = $(me).children().children('a').children('.amt').val();
	if(num==0)
	{
		//$(me).children().children('a').children('img.iconn').css({"transform": "rotate(180deg)","transition":"all 0.3s"});
		num=1;$(me).children().children('a').children('.amt').val(1);
	}
	else
	{
		//$(me).children().children('a').children('img.iconn').css({"transform": "rotate(0deg)","transition":"all 0.3s"});
		num=0;$(me).children().children('a').children('.amt').val(0);
	}
	
}
</script>
<div class="" id="amain">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2  nopad">
    	<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 leftside nopad " style="padding:20px;">
        	<div class="panel-group padding_agent" id="accordion" role="tablist" aria-multiselectable="true">
            
            <?php 
			//$dbc = $this->dbc;
			$lang = 1;
			$sector= $dbc->Query("select * from sector where status > 0");
				$li=0;
				while($sec = $dbc->Fetch($sector))
				{
					$li++;
					?>
				<div class="panel ">
                	<div class="panel-heading panel_me p-<?php echo $li;?>" role="tab" id="headingOne-<?php echo $li;?>" data-toggle="collapse" data-parent="#accordion" href="#c-<?php echo $li;?>" aria-expanded="true" aria-controls="collapseOne" onClick="thisme('p-<?php echo $li;?>',this,'<?php echo $sec['id'];?>')">
                    	<input type="hidden" class="sta" value="0">
                    	<h4 class="panel-title ">
                        	<a class="f30 " role="button" >
          						<img id="i1" class="ico" src="../libs/img/icon/arrow.png" width="15"> <?php echo explode("|",$sec['name'])[$lang];?>
        					</a>
                        </h4>
                    </div>
                    <div id="c-<?php echo $li;?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        	<ul class="subsub">
                            <?php
							$br = $dbc->Query("select * from branch where status>0 and sector = '".$sec['id']."'");
							$b = 0;
							while($branch = $dbc->Fetch($br))
							{$b++;
								?><li onClick="visitto('store-<?php echo $b;?>')"><?php echo explode("|",$branch['name'])[$lang];?></li><?php
							}
							?>
                            
                            </ul>
                        </div>
                    </div>
                </div><?php
				}
			?>
                            
            	
                
                
                
            </div>
        </div>
        
        
        
        
        
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 txt_horizental nopad ">
        <!--box-->
        	<div class="textt t1 top27">
                <p class=" fon_main int">ร้ายตัวแทนจำหน่าย</p>
                <p class=" fon22" style="margin-top:15px;">กรุณาเลือกภาคที่ต้องการทราบข้อมูล</p>
            </div>
        <!--box-->    
        <!--detail-->
        
        	<div id="det_agent"></div>
        <!--detail-->   
            
           

            
        </div>
    </div>
</div>

<?php /*?><!-- Large modal -->

<div class="modal fade bs-example-modal-lg boxmap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="col-md-12 nopad" >
            <div id="onmap" style="width:100%;height:400px;"></div>
        </div>
    </div>
  </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
function loadmaps(la,long)
{
	alert(la+'-----'+long);
	$.ajax({
		url:"libs/xhr/load_maps.php",
		type:"POST",
		dataType:"html",
		data:{la:la,long:long},
		success: function(result){
			$("#onmap").html(result);
		}
	});
}
</script>
<?php */?>





























<!-------------------------------------------------------------------------mobile------------------------------------------------------------------------>
<div class="t3" id="submain">
    <div class="col-xs-12 nopad" >
    
    	
        
        
        
        
        
<?php 
$sector_mo = $dbc->Query("select * from sector where status > 0");
$mo=0;
while($sec = $dbc->Fetch($sector_mo))
{
	$mo++;
	//echo explode("|",$sec['name'])[$lang];
        
        
        
        
        ?>
        <!--panel-->
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel ">
                <div class="panel-heading mobilpanel" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#tabmo-<?php echo $mo;?>" aria-expanded="true" aria-controls="collapseOne"  onClick="arrow_main(this)">
                    <h4 class="panel-title">
                        <a class="txt_horizental fon22" role="button">
                        	<input type="hidden" class="amt" value="0">
                           <?php echo explode("|",$sec['name'])[$lang];?> <img src="../libs/img/icon/ard.png" class="pull-right iconn" width="30">
                        </a>
                    </h4>
                </div>
                <!--store-->
                <div id="tabmo-<?php echo $mo;?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
                    <!--list group-->
                    <div class="list-group">
                    <?php 
					$branch_mo = $dbc->Query("select * from branch where status > 0 and sector = '".$sec['id']."'");
					$tabbr = 0;
					while($bra = $dbc->Fetch($branch_mo))
					{$tabbr++;
						//echo explode("|",$bra['name'])[$lang];
					
                    	?>
                    	<!--panel-->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel ">
                                <div class="panel-heading submobil" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#tabbr-<?php echo $tabbr;?>-<?php echo $mo;?>" aria-expanded="true" aria-controls="collapseOne" onClick="arrow(this)">
                                    <h4 class="panel-title">
                                        <a role="button">
											<input type="hidden" class="amt" value="0"><img id="i7" class="ico" src="../libs/img/icon/ar2.png" width="15"> <?php echo explode("|",$bra['name'])[$lang];?></a>
                                    </h4>
                                </div>
                                <!--store-->
                                <div id="tabbr-<?php echo $tabbr;?>-<?php echo $mo;?>" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
                                <?php 
								$store = $dbc->Query("select * from store where status > 0 and branch = '".$bra['id']."'");
								while($store_mo = $dbc->Fetch($store))
								{
									$namestore = explode("|",$store_mo['name'])[$lang];
									$dets = base64_decode($store_mo['detail']);
									$detail_mo = explode("|",$dets)[$lang];
								
                                	?>
                                    <!--branch-->
                                    <div class="list-group" >
                                        <div class="col-xs-12 col-sm-12 borderline">
                                             <div class="col-xs-8 col-sm-12 col-md-12 col-lg-8 ">
                                                <p class="mleft top15 fon20 fon_bold" ><?php echo $namestore;?></p>		
                                                <p class="mleft fon20 fon_light"><?php echo $detail_mo;?></p>
                                            </div>
                                            <div class="col-xs-4 col-sm-12 col-md-12 col-lg-4 nopad padleft top15">   
                                                <a href="tel:<?php echo $store_mo['phone'];?>">
                                                	<img  src="../libs/img/icon/call_dc.png" width="40">
                                                </a>
                                                <a href="http://maps.google.com/maps?q=<?php echo $store_mo['latitude'];?>,<?php echo $store_mo['longtitude'];?>" target="_blank">
                                                	<img src="../libs/img/icon/maps.png" width="40" style="margin-left:10px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--branch-->
                                   <?php
								   }
									?>	 
                                    
                                    
                                </div>
                                <!--store-->
                            </div>
                        </div>
                        <!--panel-->
                        <?php }?>
                    </div>
                    <!--list group-->
                </div>
                <!--store-->
                
            </div>
        </div>
        <!--panel-->
<?php
 }
?>    
       
                
        
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:80px;"></div>
<!--<img id="backtop" src="../libs/img/icon/totop.png" width="100">-->
<script>
$(document).ready(function(){

	// hide #back-top first
	$("#backtop").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#backtop').fadeIn();
			} else {
				$('#backtop').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#backtop').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>







<?php 	//include"libs/custom/iface_footer.php";?>