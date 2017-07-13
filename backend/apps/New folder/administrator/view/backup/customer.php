<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?>
<div class="col-md-12">
	<div class="col-md-8"><h2>Customer management</h2></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.customer.dialog_add_customer()">Add</button>
            <button type="button" class="btn btn-primary" onclick="fn.app.customer.remove_customer()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Customer List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
    	<div class="well well-lg">
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
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="E-mail">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Date Added</label>
                        <input type="date" class="form-control" id="tx_date" name="tx_date" >
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">Banned</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"><a class="btn btn-primary pull-right">Filter</a></div>
            </div>
            <br><br><br><br><br><br><br><br>

        </div>
        
        
        
         
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Type</th>
                            <th>Register date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM customers  ORDER BY id ASC";//INNER JOIN customer_group ON customers.gid=customer_group.id
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['c_id'];
                            echo '<tr>';
                                echo '<td><input name="chk_customer" type="checkbox" value="'.$id.'"></td>';
                                echo '<td>'.$id.'</td>';
                                echo '<td>'.$line['gender'].' '.$line['fname'].'  '.$line['lname'].'</td>';
                                echo '<td>'.$line['tel'].'</td>';
                                echo '<td>'.$line['email'].'</td>';
                                echo '<td>'.$line['address'].'</td>';
                                echo '<td>'.$line['status'].'</td>';
                                echo '<td>'.$line['regisdate'].'</td>';
                                echo '<td>'.$line['point'].'</td>';
                                echo '<td>'.$line['cg_name'].'</td>';
                                echo '<td>';
                                    echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.inventory.dialog_edit_customer('.$id.')">Change</button>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>


    <!--panel--> 
    <div id="addcustomer">0000000000000000</div>      
    </div>
    
</div>
























<!--<script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>-->














