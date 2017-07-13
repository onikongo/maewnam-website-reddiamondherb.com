<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Orders </font></div>
    <div class="col-md-4">
    	<div align="right">
            <!--<button type="button" class="btn btn-primary" onclick="fn.app.subcategory.dialog_add_subcategory()">Add</button>-->
            <button type="button" class="btn btn-danger" onclick="fn.app.ord.remove_od()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Orders List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
    	
       

        
         
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Date Added</th>
                            <th>Date Modify</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM orders ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_orders" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
								
                                echo '<td>'.$line['code'].'</td>';
								$cus = $dbc->GetRecord("customers","*","id='".$line['customer']."'");
								$con = $dbc->GetRecord("contacts","*","id='".$cus['contact']."'");
								echo '<td>'.$con['name'].'&nbsp;&nbsp;&nbsp;'.$con['surname'].'</td>';
                                echo '<td>'.$line['status'].'</td>';
								echo '<td>'.number_format($line['total']).'</td>';
								echo '<td>'.substr($line['created'],0,10).'</td>';
								echo '<td>'.$line['updated'].'</td>';
                                echo '<td>';
                                    echo ' <button type="button" class="btn btn-success btn-xs" onclick="fn.app.ord.dialog_edit('.$id.')">Change</button>';
									echo ' <button type="button" class="btn btn-warning btn-xs" onclick="fn.app.ord.detail('.$id.')">Detail</button>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>


    <!--panel--> 
    <div id="addcustomer"></div>      
    </div>
    
</div>

<script>
//$("#tblCategory").DataTable();
</script>




















<!--<script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>-->














