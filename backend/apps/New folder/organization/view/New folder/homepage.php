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
	$get = $dbc->GetRecord("photos","*","id='1'");
	$ads = $dbc->GetRecord("photos","*","id='2'");
	$slide = $dbc->GetRecord("photos","*","id='3'");
	
	$stads = json_decode($ads['path'],true);
	
?>
<style>
.breadcrumb {
    float: left;
    width: 100%;
    background: #e8e8e8;
    margin-bottom: 10px;
    padding: 6px 15px 7px;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    border-radius: 0px;
	color:#7A7A7A;
}
</style>
<div class="col-md-12 breadcrumb"><font size="2">Slide photo</font></div>
<div class="col-md-12" style="padding:10px;">
    <div class="col-md-12">
    	<div align="right">
            <button type="button" class="btn btn-danger" onclick="fn.navigate('add')">Add Image</button>
        </div>
    </div>
<br><br>
	<div class="col-md-12">
    	   <form id="homepage">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="btn btn-primary btn-xs pull-right" onClick="fn.app.homepage.images.open_elfinder_photo_slide()">Browse</a>
                    <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Photo slide</h3>
                </div>
                <div class="panel-body">
                        <div class="col-md-12">
                            <div class="row col-md-12" id="photo_slide">
                             <?php	$pho_slide = json_decode($slide['path'],true);
                                    if(isset($pho_slide))
                                    {
                                        foreach($pho_slide as $imgslide){
                                            echo '<div class="col-md-2">';
                                            echo '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
                                            ?>
                                            <span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00; top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span><?php
                                            echo '<img src="'.$imgslide.'" data-src="'.$imgslide.'" alt="...">';
                                            echo '<input type="hidden" name="txtPhoto_slide[]" value="'.$imgslide.'">';
                                            echo '</a>';
                                            echo '</div>';
                                            
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <!--<span class="glyphicon glyphicon-picture" aria-hidden="true" style="font-size:50px;"></span>-->
                                        <?php
                                    }
                                ?>
                             </div>
                       </div>
                </div>
            </div>
            </form>

    </div>



</div>


