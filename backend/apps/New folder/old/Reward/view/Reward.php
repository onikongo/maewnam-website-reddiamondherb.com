<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"reward";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Reward management</font></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.Reward.add_reward()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.Reward.remove_reward()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default" style="padding:10px;">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Reward List</h3>
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
    <li role="presentation"<?php if($tab=="appprove")echo' class="active"'; ?>><a href="#appprove" aria-controls="profile" role="tab" data-toggle="tab">Approve</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content " >
    <div role="tabpanel" class="tab-pane <?php if($tab=="reward")echo' active'; ?>" id="reward">
        
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Photo</th>
                            <th>Point</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM rewards WHERE approve IS  NULL AND status=0 ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_customer" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
                                echo '<td>'.$line['title'].'</td>';
                                echo '<td>'.$line['detail'].'</td>';
								echo '<td>';
								$img = json_decode($line['photo'],true);
								foreach($img as $photo)
								{
									echo '<img src="'.$photo.'" class="col-md-2" width="100">';
								}
                                echo '</td>';
                                echo '<td>'.$line['point'].'</td>';
                                echo '<td>'.$line['amount'].'</td>';
								echo '<td>'.$line['created'].'</td>';
								echo '<td>'.$line['status'].'</td>';
                                echo '<td>';
                                    echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.Reward.edit_reward('.$id.')">Change</button>';
									echo '<button type="button" class="btn btn-danger btn-xs" onclick="fn.app.Reward.approved('.$id.')">Approve</button>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>

        </div>

        <div role="tabpanel" class="tab-pane <?php if($tab=="appprove")echo' active'; ?>" id="appprove">
        	<table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Photo</th>
                            <th>Point</th>
                            <th>Amount</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM rewards WHERE approve IS NOT NULL AND status=1 ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_customer" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
                                echo '<td>'.$line['title'].'</td>';
                                echo '<td>'.$line['detail'].'</td>';
								echo '<td>';
								$img = json_decode($line['photo'],true);
								foreach($img as $photo)
								{
									echo '<img src="'.$photo.'" class="col-md-2" width="100">';
								}
                                echo '</td>';
                                echo '<td>'.$line['point'].'</td>';
                                echo '<td>'.$line['amount'].'</td>';
								echo '<td>'.$line['created'].'</td>';
								echo '<td>'.$line['status'].'</td>';
                                echo '<td>';
									echo '<button type="button" class="btn btn-danger btn-xs" onclick="fn.app.Reward.disapproved('.$id.')">Disapprove</button>';
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
























<!--<script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>-->














