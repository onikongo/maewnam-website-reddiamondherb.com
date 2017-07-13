
<script>
fn.app.customer.initial("#cbbCountry","#cbbProvince","#cbbDistrict","#cbbSubdistrict");
fn.app.customer.load_country("#cbbCountry");
</script>
<div class="fpage">
<div class="inpage">
<ol class="breadcrumb">
      <li><h2>Customer </h2></li>
      <li><a href="#">Home</a></li>
      <li><a href="#">Customer</a></li>
    </ol>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
      
    
        <form id="add_customer" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtfName" name="txtfName" placeholder="Firstname" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtlName" name="txtlName" placeholder="Lasttname" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Citizen ID</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_id" name="tx_id" placeholder="Citizen ID">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_email" name="tx_email" placeholder="E-mail">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="tx_pass" name="tx_pass" placeholder="Password">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Re-Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="tx_repass" name="tx_repass" placeholder="Re-Password">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tx_bod" name="tx_bod" placeholder="Birthday">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control" style="width:200px !important;">
                        <option value="0">Choose gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control" style="width:200px !important;">
                        <option value="Member">Member</option>
                        <option value="Agent">Agent</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Tel no.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tx_tel" name="tx_tel" placeholder="Tel no." onkeydown="check('phone')">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tx_mobile" name="tx_mobile" placeholder="Mobile" onkeydown="check('phone')">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" id="txtaddress" name="txtaddress" placeholder="Detail"></textarea>
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">District</label>
                <div class="col-sm-4">
                    <select id="cbbDistrict" name="cbbDistrict" class="form-control">
                    
                    </select>
                    
                </div>
                <label class="col-sm-2 control-label">Subdistrict</label>
                <div class="col-sm-4">
                    <select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
                    
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Province</label>
                <div class="col-sm-4">
                    <select id="cbbProvince" name="cbbProvince" class="form-control">
                    
                    </select>
                </div>
                <label class="col-sm-2 control-label">Postal</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    <select id="cbbCountry" name="cbbCountry" class="form-control">
                    
                    </select>
                </div>
            </div>
            
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
            
            
            
           <?php 
           include_once "../../../../config/define.php";
            include_once "../../../../libs/class/db.php";
            $dbc = new dbc;
            $dbc->Connect();
            $sql = "SELECT * FROM customer_group";
                        $rst = $dbc->Query($sql);
            ?>
             <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                    <select id="group" name="group" class="form-control" style="width:200px !important;">
                        <option value="0">Choose group</option><?php
                                while($line = $dbc->Fetch($rst))
                                {
                                    ?><option value="<?php echo $line['cg_id'];?>" ><?php echo $line['cg_name'];?></option><?php
                                }
                    ?></select><?php
                    $dbc->Close();		
                    ?>
                    </div>
            </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>