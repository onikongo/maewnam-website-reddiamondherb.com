<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"reward";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">User management</font></div>
    <div class="col-md-4">
    	

    </div>
</div>
<br><br><br>



<div class="panel panel-default" style="padding:10px;">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> User List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
    	<!--<div class="well well-lg">
        	<div class="col-md-12">
            	<div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Customer Name</label>
                        <input type="email" class="form-control" id="tx_name" name="tx_name" placeholder="Customer Name">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Customer Group</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">User</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1"></label><br>
                        <a class="btn btn-primary pull-left">Filter</a>
                        
                    </div>
                </div>
            </div><br><br><br><br><br><br>-->
            

        </div>
<!-- Nav tabs -->
  <ul class="nav nav-tabs " role="tablist">
    <li role="presentation" <?php if($tab=="reward")echo' class="active"'; ?>><a href="#reward" aria-controls="home" role="tab" data-toggle="tab">New</a></li>
    <li role="presentation"<?php if($tab=="Group")echo' class="active"'; ?>><a href="#Group" aria-controls="profile" role="tab" data-toggle="tab">Group</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content " >
    <div role="tabpanel" class="tab-pane <?php if($tab=="reward")echo' active'; ?>" id="reward">
    <br>
    <div class="col-md-12" align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.user.add_user()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.user.remove_user()">Remove</button>
        </div><br><br>
        
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Group</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
                        $sql = "SELECT
                            users.id		AS id, 
                            users.name		AS user_name,
                            users.status	AS user_status,
                            groups.name		AS group_name,
                            users.created	AS user_created,
                            users.updated	AS user_updated
                        FROM users,groups WHERE users.gid=groups.id";
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                            echo '<td><input name="chk_user" type="checkbox" value="'.$id.'"></td>';
                            echo '<td>'.$id.'</td>';
                            echo '<td>'.$line['user_name'].'</td>';
                            echo '<td>'.$line['user_status'].'</td>';
                            echo '<td>'.$line['group_name'].'</td>';
                            echo '<td>'.$line['user_created'].'</td>';
                            echo '<td>'.$line['user_updated'].'</td>';
                            echo '<td><button type="button" class="btn btn-success btn-xs" onclick="fn.app.user.edit_user('.$id.')">Change</button></td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>

        </div>

        <div role="tabpanel" class="tab-pane <?php if($tab=="Group")echo' active'; ?>" id="Group">
        <br>
        <div class="col-md-12" align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.user.add_group()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.user.remove_group()">Remove</button>
        </div><br><br>
        	<table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th></th>
					<th>Group name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM groups";
				$rst = $dbc->Query($sql);
				
				while($line = $dbc->Fetch($rst)){
					$id = $line['id'];
					echo '<tr>';
						echo '<td><input name="chk_group" type="checkbox" value="'.$id.'"></td>';
						echo '<td>'.$line['name'].'</td>';
						echo '<td>';
							echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.user.edit_group('.$id.')">Change</button>';
						echo '</td>';
					echo '</tr>';
				}
			
			?>
			</tbody>
			</table>
        
        	
        </div>
        
    </div>
    <!--panel--> 
    <div id="addcustomer"></div>      
    </div>
    
</div>
