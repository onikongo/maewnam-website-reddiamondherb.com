<?php 
	session_destroy(); 
?>
<style>
.mome
{
	top:0;
}
</style>
<script>
$(document).ready(function(e) {
    var win = $(window).height();
	//$(".sidemobile").css({"height":win});
	var menu = 0;
	$(".mnm").click(function(e) {
		if(menu==0)
		{
			 $(".sidemobile").animate({
				left:0
			},300);
			 $(".mnm").animate({
				left:240
			},300);
			$(".te,.pho").fadeOut(200);
			$(".mome").css({"position":"fixed","top":"0","height":"53px"});
			//$(".log").css({"margin-top":"53px"});
			$(".baxk").fadeIn(200);
			menu = 1;
		}
		else
		{
			 $(".sidemobile").animate({
				left:-240
			},300);
			 $(".mnm").animate({
				left:10
			},300);
			$(".te,.pho").fadeIn(200);
			$(".baxk").fadeOut(200);
			$(".mome").css({"position":"fixed"});
			$(".log").css({"margin-top":""});
			menu = 0;
		}
       
    });
	$(".baxk").click(function(e) {
        $(".sidemobile").animate({
				left:-240
			},300);
			 $(".mnm").animate({
				left:10
			},300);
			$(".te,.pho").fadeIn(200);
			$(".baxk").fadeOut(200);
			$(".mome").css({"position":"fixed"});
			$(".log").css({"margin-top":""});
			menu = 0;
    });
});
</script>
<div class="baxk"></div>
<div class="col-md-12 bgw nopad" style="z-index: 1100; " >

<!--mobile menu-->
    <div class="col-xs-12 mome nopad" style="position:fixed;">
        <div class="col-xs-12" style="color:#fff; z-index:1000;">
            <button class="mnm"><img src="../libs/img/icon/bar-menu.png"  width="30" style="float:left; margin-left:-15px; background:#293f21;">
                <a class="te" style="margin-left:10px;font-size: 18pt;"><?php echo(isset($_REQUEST['text']))?$_REQUEST['text']:'เมนู';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </button>
            <a href="tel:0892006799"><img src="../libs/img/icon/call.png" class="left-block pho" width="25" style="float:right;margin-right:-15px;"></a>
        </div>
        <div class="col-xs-10 nopad bggreen sidemobile">
            <ul class="mobile_menuside">
                <!--?pid=1--><li><a href="/home&text=เมนู"><img src="../../libs/img/icon/home-button.png" width="20">  หน้าแรก</a></li>
                <!--?pid=2--><li><a href="/products&text=ผลิตภัณฑ์"><img src="../../libs/img/icon/package.png" width="20">  ผลิตภัณฑ์</a></li>
                <!--?pid=3--><li><a href="/aboutus&text=เกี่ยวกับเรา"><img src="../../libs/img/icon/man-with-tie.png" width="20">  เกี่ยวกับเรา</a></li>
                <!--?pid=4--><li><a href="/distributor&text=ตัวแทนจำหน่าย"><img src="../../libs/img/icon/shop.png" width="20">  ร้านตัวแทนจำหน่าย</a></li>
                <!--?pid=5--><li><a href="/order&text=วิธีสั่งซื้อ"><img src="../../libs/img/icon/shopping-cart.png" width="20">  วิธีสั่งซื้อ</a></li>
                <!--?pid=6--><li><a href="/event&text=ข่าวสาร & กิจกรรม"><img src="../../libs/img/icon/newspaper.png" width="20">  ข่าวสาร & กิจกรรม</a></li>
                <!--?pid=7--><li><a href="/contact&text=ติดต่อเรา"><img src="../../libs/img/icon/call.png" width="20">  ติดต่อเรา</a></li>
				<li><a href="/home_en"  style="cursor:pointer" class="benM">EN</a>|<a style="cursor:pointer" class="bthM">TH</a></li>
            </ul>
        </div>
    </div>

<!--mobile menu-->


<div class="col-md-12" style="margin-top:53px;"></div>
<div class="col-md-12 bgw" >
	<img src="../libs/img/logo.png" class="img-responsive center-block log" width="370px" height="auto">
</div>
<div class="col-md-3 bgw nopad">
    <center>
        <img src="../libs/img/phone.png" width="200">
   
		<p class="text-center">
      <a href="https://www.facebook.com/ReddiamondHerb" target="_blank"><img src="../libs/img/icon/face.png" width="40px" height="auto"></a>
      <a href="http://line.me/ti/p/%40plautawan" target="_blank"><img src="../libs/img/icon/line.png" width="40px" height="auto"></a>
      <a href="https://www.youtube.com/watch?v=nbVrLgVuvXY&amp;list=PLio-5NIVsNXfPLOpr_7yfsdqTcGYkLVd7" target="_blank"><img src="../libs/img/icon/you.png" width="40px" height="auto"></a>
      <img src="../libs/img/icon/ig.jpg" width="40px" height="auto">
		</p> 
     </center>
</div>
<div class="col-md-9 bgw nopad">
    <nav class="navbar menunav defaults" style="margin:0 auto;" >
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navss">
              <button type="button" class="navbar-toggle collapsed bt" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar col"></span>
                <span class="icon-bar col"></span>
                <span class="icon-bar col"></span>
              </button>
              <a class="navbar-brand" href="#" style="font-size:18px; font-weight:bold; color:#293F21">เมนู</a>
            </div>
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="navs" class="covnavs bgw">
                <div class="collapse navbar-collapse mainmenu_bar" id="bs-example-navbar-collapse-1">
                    <center>
                          <ul class="nav navbar-nav men" style="margin-top:10px !important;">
                                <li><a href="/home" >หน้าแรก</a><div class="<?php echo($_REQUEST['pid']==50)?'underline_text':'';?> testt"></div></li>
                                
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&nbsp;สินค้า&nbsp;
                                  <div class="<?php echo($_REQUEST['pid']==51)?'underline_text':'';?> testt" style="    margin-top: 15px;"></div>
                                  <!--<span class="caret"></span>--></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="/products">สินค้าตามอาการ</a></li>
                                    <li><a href="#">สินค้าตามประเภท</a></li><!--?pid=68-->
                                  </ul>
                                </li>
                                <!--?pid=3--><li><a href="/aboutus" >เกี่ยวกับเรา</a><div  class="<?php echo($_REQUEST['pid']==55)?'underline_text':'';?> testt"></div></li>
                                <!--?pid=4--><li><a href="/distributor" >&nbsp;ร้านตัวแทนจำหน่าย&nbsp;</a><div class="<?php echo($_REQUEST['pid']==60)?'underline_text':'';?> testt"></div></li>
                                <!--?pid=5--><li><a href="/order" >สั่งซื้อสินค้า</a><div class="<?php echo($_REQUEST['pid']==54)?'underline_text':'';?> testt"></div></li>
                               <!--?pid=6--> <li><a href="/event" >ข่าวสาร & กิจกรรม</a><div class="<?php echo($_REQUEST['pid']==52)?'underline_text':'';?> testt"></div></li>  
                                <!--?pid=7--><li><a href="/contact" >ติดต่อเรา</a><div class="<?php echo($_REQUEST['pid']==53)?'underline_text':'';?> testt"></div></li>   
								<li><a href="/home_en" style="cursor:pointer" class="ben">EN
								<li><a>|</a></li>
								<li><a href="/home"  style="cursor:pointer;color:#e60000" class="bth">TH</a></li>
                          </ul>
                    </center>
                </div><!-- /.navbar-collapse -->
            </div>
      </div><!-- /.container-fluid -->
    </nav>
</div>
</div>

<div class="col-md-12 line">
	<div class="col-md-12 subline"></div>
</div>
<script>
$(document).ready(function(e) {
	$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});
	
	$(".men li a").mouseover(function(e) {
        $(".underline_text").show();
    });
});
</script>

<script>
$(document).ready(function(e) {	
	/* $(".bth").click(function(e) {
        $.ajax({
			url:'libs/xhr/action-lang.php',
			type:"POST",
			dataType:"html",
			data:{lang:'th'},
			success: function(result){
				window.location.reload();
			}
		});
    });
	
	$(".ben").click(function(e) {
        $.ajax({
			url:'libs/xhr/action-lang.php',
			type:"POST",
			dataType:"html",
			data:{lang:'en'},
			success: function(result){
				window.location.reload();
			}
		});
    }); */
	
	/* $(".bthM").click(function(e) {
        $.ajax({
			url:'libs/xhr/action-lang.php',
			type:"POST",
			dataType:"html",
			data:{lang:'th'},
			success: function(result){
				window.location.reload();
			}
		});
    });
	
	$(".benM").click(function(e) {
        $.ajax({
			url:'libs/xhr/action-lang.php',
			type:"POST",
			dataType:"html",
			data:{lang:'en'},
			success: function(result){
				window.location.reload();
			}
		});
    }); */
});	
</script>
