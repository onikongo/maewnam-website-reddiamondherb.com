<?php 
    include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	
?>
<script>
//fn.app.customer.initial("#cbbCountry","#cbbProvince","#cbbDistrict","#cbbSubdistrict");
//fn.app.customer.load_country("#cbbCountry");
$(document).ready(function(e) {
    $("#back").click(function(e) {
        window.location.reload();
    });
});
</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Customer </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Customer</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.customer.dialog_save_customer()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Customer </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="add_customer" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="tx_name" name="tx_name" placeholder="Name">
                </div>
                <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="tx_lname" name="tx_lname" placeholder="Last Name">
                </div>
            </div>
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Citizen ID</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="tx_id" name="tx_id" placeholder="Citizen ID" max="13">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-->
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                	<input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="tx_pass" name="tx_pass" placeholder="Password">
                    *At least 6 word to secure your account
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
            <!--<div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tx_bod" name="tx_bod" placeholder="Birthday">
                    <!--<textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>-s->
                </div>
            </div>-->
           <div class="form-group">
           <label for="txtDetail" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-3">
                <select name="date"  id='date' class="form-control">
                    <option value='0'>Day</option>    
                    <option value='1'>1</option>    
                    <option value='2'>2</option>    
                    <option value='3'>3</option>    
                    <option value='4'>4</option>    
                    <option value='5'>5</option>    
                    <option value='6'>6</option>    
                    <option value='7'>7</option>    
                    <option value='8'>8</option>    
                    <option value='9'>9</option>    
                    <option value='10'>10</option>    
                    <option value='11'>11</option>    
                    <option value='12'>12</option>    
                    <option value='13'>13</option>    
                    <option value='14'>14</option>    
                    <option value='15'>15</option>    
                    <option value='16'>16</option>    
                    <option value='17'>17</option>    
                    <option value='18'>18</option>    
                    <option value='19'>19</option>    
                    <option value='20'>20</option>    
                    <option value='21'>21</option>    
                    <option value='22'>22</option>    
                    <option value='23'>23</option>    
                    <option value='24'>24</option>    
                    <option value='25'>25</option>    
                    <option value='26'>26</option>    
                    <option value='27'>27</option>    
                    <option value='28'>28</option>    
                    <option value='29'>29</option>    
                    <option value='30'>30</option>   
                    <option value='31'>31</option>  
                </select>
                </div>
                <div class="col-sm-3">
                    <select name="month"  id='month' class="form-control">    
                        <option value='Month'>Month</option>    <option value='01'>January</option>    <option value='02'>Febuary</option>    <option value='03'>March</option>    <option value='04'>April</option>    <option value='05'>May</option>    <option value='06'>June</option>    <option value='07'>July</option>    <option value='08'>August</option>    <option value='09'>September</option>    <option value='10'>October</option>    <option value='11'>November</option>    <option value='12'>December</option>  
                    </select>
                    </div>
                <div class="col-sm-4">
                <select  id='year' name="year" class="form-control">
                <?php $options = 1; 
                for($i=-10;$i<$options;$i++){
                if($i==1){echo '<option  value="' . (intval(date("Y"))  + $i) . '">' . (intval(date("Y"))  + $i) . '</option>';}
                else{ echo '<option selected= \'selected\' value="' . (intval(date("Y")) + $i) . '">' . (intval(date("Y"))  + $i) . '</option>';}
                } ?></select> 
                </div>
			</div>

           
           
           
           
           
           
           
           
            <!--<div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Gender</label>
                <div class="col-sm-10">
                    <select name="gender" id="gender" class="form-control" >
                        <option value="0">Choose gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control" >
                        <option value="Member">Member</option>
                        <option value="Agent">Agent</option>
                    </select>
                </div>
            </div>-->
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tel no.</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_tel" name="tx_tel" placeholder="Tel no.">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_mobile" name="tx_mobile" placeholder="Mobile">
                </div>
            </div>
            
            
            <!--<div class="form-group">
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
            </div>-->
             <?php /*?><div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                    <select id="cgroup" name="cgroup" class="form-control" >
                        <?php
						$sql = "SELECT * FROM customer_group";
						$rst = $dbc->Query($sql);
                                while($line = $dbc->Fetch($rst))
                                {
                                    ?><option value="<?php echo $line['id'];?>" ><?php echo $line['name'];?></option><?php
                                }
                    ?></select><?php
                    $dbc->Close();		
                    ?>
                    </div>
            </div><?php */?>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>