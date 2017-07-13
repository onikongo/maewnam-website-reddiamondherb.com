<?php
	session_start();
	include_once "../config/define.php";
	include_once "../libs/class/db.php";
	include_once "../libs/class/cms.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$app = isset($_REQUEST['app'])?$_REQUEST['app']:"";
	
	
	$dbc = new dbc;
	$dbc->Connect();
	$system = json_decode(file_get_contents("../config/system.json"),true);
?>
<!DOCTYPE html>
<html lang="<?php echo $system['define']['language']?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>AQUAWAMS Web Management System</title>
		
		
		<link href="../theme/default/css/elfinder.css" rel="stylesheet" />
		<link rel="stylesheet" href="../theme/default/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../theme/default/css/jquery-ui-1.10.4.custom.min.css" />
		<link href="../theme/default/csss/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="site.css" rel="stylesheet" type="text/css">
		<link href="../theme/default/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="cdn.datatables.net/plug-ins/1.10.11/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet" type="text/css">
        
		<!--<link href="apps/inventory/css/add_product.css" rel="stylesheet" type="text/css">-->
		<link href="../theme/default/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
        
        
		<script type="text/javascript" src="../libs/js/jquery-2.0.0.min.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.mouse.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.selectable.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.button.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.draggable.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.droppable.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.position.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.resizable.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.dialog.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.ui.sortable.js"></script>
		
		<script type="text/javascript" src="../libs/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="../libs/js/jquery-mn-core.js"></script>
		<script type="text/javascript" src="../libs/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../libs/js/elfinder.min.js"></script>
		<script type="text/javascript" src="../libs/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="../libs/ckeditor/adapters/jquery.js"></script>
		<script type="text/javascript" src="http://imsky.github.io/holder/holder.js"></script>
       
		<script type="text/javascript" src="libs/admin.js"></script>
        
        <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
	
    	<style>
        table.dataTable thead th.sorting:after {
			content: "\f0dc";
			color: #ddd;
			font-size: 0.8em;
			padding-top: 0.12em;
		}
		table.dataTable thead th.sorting_asc:after {
			content: "\f0de";
		}
		table.dataTable thead th.sorting_desc:after {
			content: "\f0dd";
		}
		table.dataTable thead th {
			position: relative;
			background-image: none !important;
		}
		 
		table.dataTable thead th.sorting:after,
		table.dataTable thead th.sorting_asc:after,
		table.dataTable thead th.sorting_desc:after {
			position: absolute;
			top: 12px;
			right: 8px;
			display: block;
			font-family: FontAwesome;
		}
		</style>
        <!--<script src="libs/chkNO.js"></script>-->
        <script>
		$(document).ready(function(e) {
			$(".table").DataTable({
				"paging":   false,
				"bProcessing": true,
				"columnDefs": [{
				  "targets": 'no-sort',
				  "orderable": false,
			}],
			"language": {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Thai.json"
				}
			});
			
			
			var x=0;
            $("#setting").click(function(e) {
				
				if(x==0)
				{
					 $(".btnpopOver").css({"transform":"scale(1) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#setting").css({"background":"#083f1b"});
					 x=1;
					 $(".btnpopOverOut").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#logouts").css({"background":"none"});
					 y=0;
				}
				else
				{
					 $(".btnpopOver").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#setting").css({"background":"none"});
					 x=0;
				}
               
            });
			
			var y=0;
            $("#logouts").click(function(e) {
				
				if(y==0)
				{
					 $(".btnpopOverOut").css({"transform":"scale(1) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#logouts").css({"background":"#083f1b"});
					 y=1;
					 $(".btnpopOver").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#setting").css({"background":"none"});
					 x=0;
				}
				else
				{
					 $(".btnpopOverOut").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#logouts").css({"background":"none"});
					 y=0;
				}
               
            });
			
			$("#body,.page-right").click(function(e) {
				
					 $(".btnpopOver").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#setting").css({"background":"none"});
					 x=0;
				
					 $(".btnpopOverOut").css({"transform":"scale(0) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg)"});
					 $("#logouts").css({"background":"none"});
					 y=0;
               
            });
			$(".btnpopOverOut").click(function(e) {
               $("#bgout").fadeIn(200);
				$("#boxout").fadeIn(200);
            });
			$(".no").click(function(e) {
               $("#bgout").fadeOut(200);
				$("#boxout").fadeOut(200);
            });
        });
		</script>

  
	</head>
	<body>
<?php
	/*
	 * Admin Tool for AQUAWAMS
	 */
	 
	if(isset($_SESSION['auth'])){
		$tool_tip_title = $_SESSION['auth']['user'];
	}else{
	 	$tool_tip_title = "Plase login";
		include "login.php" ;
	}
?>
		<nav id="navmain" class="navbar " role="navigation" ><!--navbar-inverse navbar-static-top-->
			<div class="container-fluid logobar" >
				<div class="navbar-header" >
                <button type="button" class="navbar-toggle collapsed butline" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>   
				<a  href="#"><?php /*?><-id="iconmenu" class="navbar-brand"--><?php */?>
                	<img class="imgs" src="../libs/upload/admin/logo_minerva.png">
                	<?php /*?><!--<span class="glyphicon glyphicon-list" aria-hidden="true"></span>--><?php */?>
                </a>
                
				</div>
            
                 <!--Progress-->
                <div class="progress-wrap progress" data-progress-percent="100">
                      <div class="progress-bar progress"></div>
                </div>	
                <!--Progress-->
            
            
            
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background:#1b5c32;">	
                
                
                <script>
				// on page load...
					moveProgressBar();
					// on browser resize...
					$(window).resize(function() {
						moveProgressBar();
						setTimeout(function(){
							$('.progress-wrap').css({"display":"none"});
						},300);
					});
				
					// SIGNATURE PROGRESS
					function moveProgressBar() {
					  console.log("moveProgressBar");
						var getPercent = ($('.progress-wrap').data('progress-percent') / 100);
						var getProgressWrapWidth = $('.progress-wrap').width();
						var progressTotal = getPercent * getProgressWrapWidth;
						var animationLength = 800;
						
						// on page load, animate percentage bar to data percentage length
						// .stop() used to prevent animation queueing
						setTimeout(function(){
							$('.progress-bar').stop().animate({
								left: progressTotal
							}, animationLength);
						},300);
						
						
						
					}//
					
					setTimeout(function(){$('.progress-wrap').fadeOut(300);  }, 1300);
				</script>	
<?php
	if(isset($_SESSION['auth'])){
?>
				
                <div class="sidemenu sec">
                    <ul>
                        <li class="xn-profile">
                            <div class="profile">
                                <div class="profile-image">
                                    <img src="../libs/upload/admin/logopolar.png" alt="POLARDEV">
                                </div>
                                <div class="profile-data">
                                    <div class="profile-data-name" style="color:#fff;"><b>Reddiamond</b></div>
                                    <div class="profile-data-title">Website Developer Design</div>
                                </div>
                            </div>                                                                        
                        </li>
                        <!--<li>
                            <a href="?app=slide">
                                <center><label >Slide Photo</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=news">
                                <center><label >News & Activities</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=sector">
                                <center><label >Sector</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=branch">
                                <center><label >Branch</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=store">
                                <center><label >Agent store</label> </center>
                            </a>
                        </li-->
                        <li>
                            <a href="?app=slide">
                                <center><label >ภาพสไลด์</label> </center>
                            </a>
                        </li>
						<li>
                            <a href="?app=category">
                                <center><label >Category</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=news">
                                <center><label >ข่าวสาร & กิจกรรม</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=sector">
                                <center><label >ภูมิภาค</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=branch">
                                <center><label >สาขา</label> </center>
                            </a>
                        </li>
                        <li>
                            <a href="?app=store">
                                <center><label >ร้านตัวแทนจำหน่าย</label> </center>
                            </a>
                        </li>
                    </ul>
                    
                </div>
                <button type="button" id="logouts"  class="btnaction pull-right" >
                    <img src="../libs/upload/power buttons.png" width="15" >
                </button>
                <button type="button" class="btnpopOverOut" >
                <div class="insides" >
                	<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                	 ออกจากระบบ
                </div>
                <div id="triangle-up2"></div></button>
                
                <button type="button" id="setting" class="btnaction pull-right" >
                    <img src="../libs/upload/tool418.png" width="15"> 
                </button>
                <a href="?app=password"><button type="button" class="btnpopOver">
                <div class="inside">
                	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAA7ElEQVQ4T6WS0W3CQBBE51UQUgFJB3SQuAKSCkgniE6cCnAqiOmADkg6oINFYx3IPtvYEiv5a3ef53YGDVRErCRtJX2kdiVpBxzzcUYAf5KWWa8GiklARLxIOg2BJb0Cht+qpyAi3iX9jgAKoJ4CPKbA9IgYusE/YHinxo7o6++z2U/AbkwDkgpDvtJ0ObTsXkdBRCwkbZL/fkaZAAZZvhV8A+erjBsghcfXN+ReedluNKFqA0xfTyxf2z9Ak9I2wOSnmYAz8JwDYuZyMwY0P28reBjgiL7NVHEAHPmejT6MP1uWww6SbG3VzsQFK9lVEXYZ1j8AAAAASUVORK5CYII="/> เปลี่ยนรหัสผ่าน
                </div>
                
               
                <div id="triangle-up"></div>
                </button>
                </a>
                
                    
            </ul>
        </div>
                
               
				
<?php
	}else{
		
?>
<!--<meta http-equiv="refresh" content="0;URL=/admin/login.php">-->


			<div class="login-box  fadeInDown" style="z-index:1600; position: absolute;">
                    <h2 class="text-center" style="color:#fff">REDDIAMOND</h2>
                        <div class="login-body">
                        <form action="login_system.php" class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" id="txtUsernameLoginFirstPage" name="userlog" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" id="txtPasswordLoginFirstPage" name="passlog" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-info btn-block" onclick="fn.engine.login()">เข้าสู่ระบบ</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="pull-left">
                           
                        </div>
                    </div>
                </div>
            
	<div  style="background:#083f1b; z-index:1500; position:fixed; left:0; top:0; bottom:0; right:0; top:0px;"></div>



<?php
	}
?>
				
	
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>


<div id="bgout"></div>
<div id="boxout">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p>
            <h1><span class="glyphicon glyphicon-log-out" aria-hidden="true" style="font-size:36px;"></span>
            ออก <b>จากระบบ</b> ?</h1></p>
            คุณต้องการออกจากระบบหรือไม่?
            กด ยกเลิก่ หากคุณต้องการทำงานต่อ. กด ตกลง เพื่อทำการออกจากระบบ. 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
            <button class="btn btn-default btn-lg pull-right no">ยกเลิก</button>
            <button class="btn btn-success btn-lg pull-right yes" style="margin-right:10px;" onclick="fn.engine.logout()">ตกลง</button>
        </div>
    </div>
</div>
                
                    
<div class="page-container" style="padding:0px;"> 
	<div class="page-left">
    	<div class="sidemenu first">
            <ul>
                <li class="xn-profile">
                    <div class="profile">
                        <div class="profile-image">
                            <img src="../libs/upload/admin/logopolar.png" alt="POLARDEV">
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name" style="color:#fff;"><b>Reddiamond</b></div>
                            <div class="profile-data-title">Website Developer Design</div>
                        </div>
                    </div>                                                                        
                </li>
                
                <li>
                    <a href="?app=slide">
                        <center><label >ภาพสไลด์</label> </center>
                    </a>
                </li>
				<li>
					<a href="?app=category">
						<center><label >Category</label> </center>
					</a>
				</li>
                <li>
                    <a href="?app=news">
                        <center><label >ข่าวสาร & กิจกรรม</label> </center>
                    </a>
                </li>
                <li>
                    <a href="?app=sector">
                        <center><label >ภูมิภาค</label> </center>
                    </a>
                </li>
                <li>
                    <a href="?app=branch">
                        <center><label >สาขา</label> </center>
                    </a>
                </li>
                <li>
                    <a href="?app=store">
                        <center><label >ร้านตัวแทนจำหน่าย</label> </center>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-right">
    	
    <?php
	switch($app){
		case "homepage" :
			echo '<script type="text/javascript" src="apps/slide_photo/app.js"></script>';
			require_once "apps/slide_photo/view/index.php";
			break;
		case "password" :
			echo '<script type="text/javascript" src="apps/password/app.js"></script>';
			require_once "apps/password/view/index.php";
			break;	
		case "slide" :
			echo '<script type="text/javascript" src="apps/slide/app.js"></script>';
			require_once "apps/slide/view/index.php";
			break;	
		case "news" :
			echo '<script type="text/javascript" src="apps/news/app.js"></script>';
			require_once "apps/news/view/index.php";
			break;		
		case "sector" :
			echo '<script type="text/javascript" src="apps/sector/app.js"></script>';
			require_once "apps/sector/view/index.php";
			break;
		case "branch" :
			echo '<script type="text/javascript" src="apps/branch/app.js"></script>';
			require_once "apps/branch/view/index.php";
			break;
		case "store" :
			echo '<script type="text/javascript" src="apps/store/app.js"></script>';
			require_once "apps/store/view/index.php";
			break;
		case "category" :
			echo '<script type="text/javascript" src="apps/category/app.js"></script>';
			require_once "apps/category/view/index.php";
			break;				
	}
?>

   
    
    
    
    	<div id="covb" style="background:#000; opacity:.8; z-index:100; position:fixed; left:0; top:0; bottom:0; right:0; margin-top:50px; display:none;"></div>
    
		<div id="body" class="container" style="width:80%;padding-top:20px;">
	
	</div>
    </div>
     
</div>    
	</body>
</html>
<script>
$(document).ready(function(e) {
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	
	var win = $(window).height();
	var pages = $(".page-right").height();
	if(pages < win)
	{
		$(".page-right").css({"height":""+win+"px"});
	}
	else
	{
		$(".page-right").css({"height":"100%"});
	}
	
	
	//alert(pages);
	//setTimeout(function(){
//		$('.progress-bar').css({'display':'none'});
//	},100);
});
</script>

