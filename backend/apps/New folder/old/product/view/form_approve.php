<?php
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$dbc = new dbc;
	$dbc->Connect();
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$id = $_REQUEST['id'];
	$pro = $dbc->GetRecord("products","*","id='".$id."'");
	$media = $dbc->GetRecord("medias","*","product='".$pro['id']."'");
?>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Add Real Estate </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Real Estate</a></li>
  
  <a id="back" href="javascript:window.location = '?app=realestate'" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span></a>
  <a id="save" onClick="fn.app.realestate.dialog_save_real()" class="pull-right btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Real Estate</h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
    	
          <font size="+2">Preview<small></small></font>
        
    	<!--<div class="well well-lg">-->
        	<div class="col-md-12" style="background:#f5f5f5; padding:10px;">
            	<div class="col-md-4" style="padding:0px;">
                <?php
				$st = json_decode($media['photo'],true);
				foreach($st['photo'] as $photo)
				{
					?><img src="<?php echo $photo;?>" class="img-responsive"><?php
					break;
				}
				echo "<center><p>id : ".$id."</p</center>";
				?>
                </div>
                <div class="col-md-8" >
                	<font size="4" color="#0066FF">
					<?php echo $pro['list_type'];?> - <?php $ex = explode("|",$pro['name']);echo $ex[0];?> in 
                    <?php 
					$address = $dbc->GetRecord("address","*","product='".$id."'");
					$city = $dbc->GetRecord("cities","*","id='".$address['city']."'");
					$district = $dbc->GetRecord("districts","*","id='".$address['district']."'");
					$subdistrict = $dbc->GetRecord("subdistricts","*","id='".$address['subdistrict']."'");
					echo $city['name'].''.$district['name'].''.$subdistrict['name'];?>
                    </font>
                    <div class="col-md-6">
                    	<?php echo $ex[0];?><br>
						<?php echo $city['name'].''.$district['name'].''.$subdistrict['name'];?>
                        <?php echo "Listed on ".substr($pro['created'],0,10);?>
                    </div>
                    <div class="col-md-6" style="border-left:1px solid #CCC;">
                    	<?php echo $pro['price'];?><br>
                        <?php echo $pro['sizes'];?>
                    </div>
                </div>
            </div>
            
       <!-- </div>-->
        <br><br><br><br><br><br><br><br><br><br>
        
         <div class="page-header">
          <font size="+2">Approve Listing Details and Activities<small></small></font>
        </div>
        <div class="col-md-12">
        	<table width="100%" border="1" class="table table-bordered table-striped">
              <thead><tr>
                <th>Title</th>
                <th>Detail</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>Current Status</td>
                <td><?php echo ($pro['approved']=='')?'Non-Approve':$pro['approved'];?></td>
              </tr>
              <tr>
                <td>Listing Type</td>
                <td><?php echo $pro['list_type'];?></td>
              </tr>
              <tr>
                <td>Property Type</td>
                <td><?php echo $pro['property_type'];?></td>
              </tr>
              <tr>
                <td>Property Name</td>
                <td><?php echo $ex[0];?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $city['name'].''.$district['name'].''.$subdistrict['name'];?></td>
              </tr>
              <tr>
                <td>Built Up/Of Bedrooms</td>
                <td><?php $extr = explode("|",$pro['extra_information']); echo $extr[0];?></td>
              </tr>
              <tr>
                <td>Date Listed</td>
                <td><?php echo $pro['created'];?></td>
              </tr>
              <tr>
                <td>Price</td>
                <td><?php echo $pro['price'];?></td>
              </tr>
              </tbody>
            </table>

        </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>