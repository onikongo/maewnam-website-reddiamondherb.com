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
  <li><font size="+2">User </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">User</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.adminstrator.save_user()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add User </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="add_userd" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user" name="user" placeholder="Username">
                </div>
                
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
                
            </div>
            
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Group</label>
                <div class="col-sm-10">
                	<select class="form-control" id="groupid" name="groupid">
                    <?php $sql = $dbc->Query("SELECT * FROM groups");
					while($row = $dbc->Fetch($sql))
					{
						echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
					}?>
                    </select>
                </div>
            </div>
            
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>