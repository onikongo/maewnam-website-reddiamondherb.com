<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Customer Group List</font></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.customer.dialog_add_group()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.customer.remove_group()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Customer Group List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
        
        
        
         
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Customer Group Name</th>
                            <th>Description / Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM customer_group ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_group" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
                                echo '<td>'.$line['name'].'</td>';
                                echo '<td>'.json_decode($line['setting'],true).'</td>';
                                echo '<td>';
                                    echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.customer.edit_group('.$id.')">Change</button>';
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

