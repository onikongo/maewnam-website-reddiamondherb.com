<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$sql = "SELECT * FROM customers  WHERE id=".$_REQUEST['id'];
	$rst = $dbc->Query($sql);
	$line = $dbc->Fetch($rst);
	if(!$dbc->HasRecord("contacts","id='".$line['contact']."'"))
	{
		$contact=='0';
	}
	else
	{
		$contact = $dbc->GetRecord("contacts","*","id=".$line['contact']);
		$address = $dbc->GetRecord("address","*","contact=".$line['contact']." AND priority = 1");
	}
	
?>
<br>
<script>
/*fn.app.supplier.initial(
	"#edit_customer #cbbCountry",
	"#edit_customer #cbbProvince",
	"#edit_customer #cbbDistrict",
	"#edit_customer #cbbSubdistrict");
	$(document).ready(function(e) {
		$("#backs").click(function(e) {
		window.location = '?app=customer';
	});
});
*/</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Customer </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Customer</a></li>
  
  <a id="backs"  href="javascript:window.location = '?app=customer'" class="pull-right btn btn-danger">
  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close
  </a>
  <a id="save" onClick="fn.app.customer.update_customer()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Edit Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 

<form id="edit_customer" class="form-horizontal" role="form">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
<!--<div class="form-group">-->
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="tx_name" name="tx_name" placeholder="Name" value="<?php echo $contact['name'];?>">
                </div>
                <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="tx_lname" name="tx_lname" placeholder="Last Name" value="<?php echo $contact['surname'];?>">
                </div>
            </div>
            
               
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Citizen ID</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_id" name="tx_id" placeholder="Citizen ID" value="<?php echo $contact['citizen_id'];?>">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                	<input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="E-mail" value="<?php echo $line['username'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="tx_pass" name="tx_pass" placeholder="Password" >
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>value="<?php echo "PASSWORD('".$line['password']."')";?>"-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Re-Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="tx_repass" name="tx_repass" placeholder="Re-Password" >
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
           <?php /*?> <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tx_bod" name="tx_bod" placeholder="Birthday" value="<?php echo $contact['dob'];?>">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div><?php */?>
            <?php 
			$d = substr($contact['dob'],8,2);
			$m = substr($contact['dob'],5,2);
			$y = substr($contact['dob'],0,4);
			
			?>
           <div class="form-group">
           <label for="txtDetail" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-3">
                <select name="date"  id='date' class="form-control">
                    <option value='0' >Day</option>    
                    <option value='1' <?php echo($d==1)?'selected':'';?>>1</option>    
                    <option value='2' <?php echo($d==2)?'selected':'';?>>2</option>    
                    <option value='3' <?php echo($d==3)?'selected':'';?>>3</option>    
                    <option value='4' <?php echo($d==4)?'selected':'';?>>4</option>    
                    <option value='5' <?php echo($d==5)?'selected':'';?>>5</option>    
                    <option value='6' <?php echo($d==6)?'selected':'';?>>6</option>    
                    <option value='7' <?php echo($d==7)?'selected':'';?>>7</option>    
                    <option value='8' <?php echo($d==8)?'selected':'';?>>8</option>    
                    <option value='9' <?php echo($d==9)?'selected':'';?>>9</option>    
                    <option value='10' <?php echo($d==10)?'selected':'';?>>10</option>    
                    <option value='11' <?php echo($d==11)?'selected':'';?>>11</option>    
                    <option value='12' <?php echo($d==12)?'selected':'';?>>12</option>    
                    <option value='13' <?php echo($d==13)?'selected':'';?>>13</option>    
                    <option value='14' <?php echo($d==14)?'selected':'';?>>14</option>    
                    <option value='15' <?php echo($d==15)?'selected':'';?>>15</option>    
                    <option value='16' <?php echo($d==16)?'selected':'';?>>16</option>    
                    <option value='17' <?php echo($d==17)?'selected':'';?>>17</option>    
                    <option value='18' <?php echo($d==18)?'selected':'';?>>18</option>    
                    <option value='19' <?php echo($d==19)?'selected':'';?>>19</option>    
                    <option value='20' <?php echo($d==20)?'selected':'';?>>20</option>    
                    <option value='21' <?php echo($d==21)?'selected':'';?>>21</option>    
                    <option value='22' <?php echo($d==22)?'selected':'';?>>22</option>    
                    <option value='23' <?php echo($d==23)?'selected':'';?>>23</option>    
                    <option value='24' <?php echo($d==24)?'selected':'';?>>24</option>    
                    <option value='25' <?php echo($d==25)?'selected':'';?>>25</option>    
                    <option value='26' <?php echo($d==26)?'selected':'';?>>26</option>    
                    <option value='27' <?php echo($d==27)?'selected':'';?>>27</option>    
                    <option value='28' <?php echo($d==28)?'selected':'';?>>28</option>    
                    <option value='29' <?php echo($d==29)?'selected':'';?>>29</option>    
                    <option value='30' <?php echo($d==30)?'selected':'';?>>30</option>   
                    <option value='31' <?php echo($d==31)?'selected':'';?>>31</option>  
                </select>
                </div>
                <div class="col-sm-3">
                    <select name="month"  id='month' class="form-control">    
                        <option value='Month'>Month</option>    <option value='01' <?php echo($m==01)?'selected':'';?>>January</option>    <option value='02' <?php echo($m==02)?'selected':'';?>>Febuary</option>    <option value='03' <?php echo($m==03)?'selected':'';?>>March</option>    <option value='04' <?php echo($m==04)?'selected':'';?>>April</option>    <option value='05' <?php echo($m==05)?'selected':'';?>>May</option>    <option value='06' <?php echo($m==06)?'selected':'';?>>June</option>    <option value='07' <?php echo($m==07)?'selected':'';?>>July</option>    <option value='08' <?php echo($m==08)?'selected':'';?>>August</option>    <option value='09' <?php echo($m==09)?'selected':'';?>>September</option>    <option value='10' <?php echo($m==10)?'selected':'';?>>October</option>    <option value='11' <?php echo($m==11)?'selected':'';?>>November</option>    <option value='12' <?php echo($m==12)?'selected':'';?>>December</option>  
                    </select>
                    </div>
                <div class="col-sm-4">
                <select  id='year' name="year" class="form-control">
                <?php $options = 1; 
                for($i=-50;$i<$options;$i++){
					?><option  value="<?php echo(intval(date("Y"))  + $i);?>" <?php echo($y==(intval(date('Y')))+ $i)?"selected":"";?> ><?php echo(intval(date("Y"))  + $i);?></option><?php
                } ?></select> 
                </div>
			</div>
            
            <?php /*?><div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control" >
                        <option value="Male" <?php echo ($contact['title']=='Male')?'selected':'';?>>Male</option>
                        <option value="Female" <?php echo ($contact['title']=='Female')?'selected':'';?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control" >
                        <option value="Member" <?php echo ($line['type']=='Member')?'selected':'';?>>Member</option>
                        <option value="Agent" <?php echo ($line['type']=='Agent')?'selected':'';?>>Agent</option>
                    </select>
                </div>
            </div><?php */?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tel no.</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_tel" name="tx_tel" placeholder="Tel no." value="<?php echo $contact['phone'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_mobile" name="tx_mobile" placeholder="Mobile" value="<?php echo $contact['mobile'];?>">
                </div>
            </div>
            
            
            <?php /*?><div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" id="txtaddress" name="txtaddress" placeholder="Detail"><?php echo $address['address'];?></textarea>
                </div>
            </div>


	<div class="form-group">
		<label class="col-sm-2 control-label">District</label>
		<div class="col-sm-4">
			<select id="cbbDistrict" name="cbbDistrict" class="form-control">
			<?php
				$sql= "SELECT * FROM districts WHERE city =  ".$address['city'];
				$rst = $dbc->Query($sql);
				while($line = $dbc->Fetch($rst)){
					$selected = $line['id']==$address['district']?" selected":"";
					echo "<option value='$line[id]'$selected>$line[name]</option>";
				}
			?>
			</select>
			
		</div>
		<label class="col-sm-2 control-label">Subdistrict</label>
		<div class="col-sm-4">
			<select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
			<?php
				$sql= "SELECT * FROM subdistricts WHERE district =  ".$address['district'];
				$rst = $dbc->Query($sql);
				while($line = $dbc->Fetch($rst)){
					$selected = $line['id']==$address['subdistrict']?" selected":"";
					echo "<option value='$line[id]'$selected>$line[name]</option>";
				}
			?>
			</select>
			
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Province</label>
		<div class="col-sm-4">
			<select id="cbbProvince" name="cbbProvince" class="form-control">
			<?php
				$sql= "SELECT * FROM cities WHERE country =  ".$address['country'];
				$rst = $dbc->Query($sql);
				while($line = $dbc->Fetch($rst)){
					$selected = $line['id']==$address['city']?" selected":"";
					echo "<option value='$line[id]'$selected>$line[name]</option>";
				}
			?>
			</select>
		</div>
		<label class="col-sm-2 control-label">Postal</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code" value="<?php echo $address['postal']?>">
		</div>
	</div>
	
    <div class="form-group">
		<label class="col-sm-2 control-label">Country</label>
		<div class="col-sm-10">
			<select id="cbbCountry" name="cbbCountry" class="form-control">
			<?php
				$sql= "SELECT * FROM countries";
				$rst = $dbc->Query($sql);
				while($line = $dbc->Fetch($rst)){
					$selected = $line['id']==$address['country']?" selected":"";
					echo "<option value='$line[id]'$selected>$line[name]</option>";
				}
			?>
			</select>
		</div>
	</div><?php */?>
    
   <?php 
	$sql = "SELECT * FROM customer_group";
				$rst = $dbc->Query($sql);
	?>
     <div class="form-group">
		<label for="txtDetail" class="col-sm-2 control-label">Group</label>
		<div class="col-sm-10">
            <select id="cgroup" name="cgroup" class="form-control" >
                <?php
                        while($line1 = $dbc->Fetch($rst))
                        {
                            ?><option value="<?php echo $line1['id'];?>" <?php echo ($line['gid']==$line1['id'])?'selected':'';?>><?php echo $line1['name'];?></option><?php
                        }
            ?></select>
            
            </div>
	</div>

</form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>
<?php
	
	$dbc->Close();
