<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$bra = $dbc->GetRecord("branches","*","id='".$_REQUEST['id']."'");
	$con = $dbc->GetRecord("contacts","*","id='".$bra['location']."'");
	$address = $dbc->GetRecord("address","*","contact='".$con['id']."'");
?>
<script>
$(document).ready(function(e) {
    fn.app.Supplier.initial(
					"#edit_branch #cbbCountry",
					"#edit_branch #cbbProvince",
					"#edit_branch #cbbDistrict",
					"#edit_branch #cbbSubdistrict");
});
</script>

<form id="edit_branch" class="form-horizontal">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
    <input type="hidden" name="conID" value="<?php echo $con['id'];?>">
    <input type="hidden" name="addID" value="<?php echo $address['id'];?>">

    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="name" name="name"  value="<?php echo $bra['code'];?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Supplier</label>
        <div class="col-sm-10">
            <select class="form-control" id="supplier" name="supplier" >
                <?php $sql_supp = $dbc->Query("select * from suppliers order by id asc");
                while($sup = $dbc->Fetch($sql_supp))
                {
                   ?><option value="<?php echo $sup['id'];?>" <?php echo($sup['id']==$bra['supplier'])?'selected':'';?>><?php echo $sup['name'];?></option>
                <?php }?>
            </select>
            
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-4"> 
            <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone" value="<?php echo $con['phone'];?>">
        </div>
        <label class="col-sm-1 control-label">Mobile</label>
        <div class="col-sm-5">
            <input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile" value="<?php echo $con['mobile'];?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">E-Mail</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail" value="<?php echo $con['email'];?>">
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
            <textarea name="txtAddress" rows="2" class="form-control"><?php echo $address['address'];?></textarea>
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
            <input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code" value="<?php echo $address['postal'];?>">
        </div>
    </div>
    <div class="form-group" >
        <label class="col-sm-2 control-label">Country</label>
        <div class="col-sm-10">
            <select id="cbbCountry" name="cbbCountry" class="form-control">
            <?php
            $sql= "SELECT * FROM countries WHERE id =  ".$address['country'];
            $rst = $dbc->Query($sql);
            while($line = $dbc->Fetch($rst)){
                $selected = $line['id']==$address['city']?" selected":"";
                echo "<option value='$line[id]'$selected>$line[name]</option>";
            }
        ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Latitude</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="txtLatitude" name="txtLatitude"  value="<?php echo $bra['latitude'];?>">
        </div>
        <label class="col-sm-2 control-label">Longtitude</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="txtLongtitude" name="txtLongtitude"  value="<?php echo $bra['longtitude'];?>">
        </div>
    </div>
</form>