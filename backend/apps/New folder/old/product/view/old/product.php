<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Products</font></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.product.add()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.product.remove_product()">Remove</button>
        </div>
    </div>
</div>
<br><br><br>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Products List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
        <div class="well well-lg">
        	<div class="col-md-12">
            	<div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deal Type</label>
                        <input type="email" class="form-control" id="tx_type" name="tx_type" placeholder="Real Estate Type">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">User</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Price Minimum</label>
                        <input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="Price Minimum">
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Price Maximum</label>
                        <input type="text" class="form-control" id="tx_date" name="tx_date" placeholder="Price Maximum">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            	<div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Province</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">Banned</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">District</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">Banned</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Customer</label>
                        <select class="form-control" id="selGroup" name="selGroup">
                        	<option value="">Banned</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                        <label for="exampleInputEmail1">Date Added</label>
                        <input type="date" class="form-control" id="tx_date" name="tx_date" placeholder="Date Added">
                    </div>
                	<a class="btn btn-primary pull-right">Filter</a>
                </div>
            </div>
            <br><br><br><br><br><br><br><br>

        </div>
        
        
         
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Categories</th>
                            <th>Sub category</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM products ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_real" type="checkbox" value="'.$id.'" style="zoom:1.5;"></td>';
								$proname = explode("|",$line['name']);
                                echo '<td>'.$proname[0].'</td>';
								$cate = $dbc->GetRecord("categories","*","id='".$line['category']."'");
                                echo '<td>'.$cate['name'].'</td>';
								
								$sub = $dbc->GetRecord("subcategory","*","id='".$line['subcategory']."'");
								echo '<td>';
									echo $sub['name'],' ';
								echo '</td>';
								echo '<td>';
								$inv = $dbc->Query("SELECT * FROM periods WHERE product = '".$id."' ");
								while($row = $dbc->Fetch($inv))
								{
									echo $row['available'];
								}
								echo $total;$total='';	
								echo '</td>';
								echo '<td>'.$line['status'].'</td>';
								echo '<td>'.$line['created'].'</td>';
                                echo '<td>';
								for($i=1;$i<=$line['rates'];$i++)
								{
									if($line['rates']=='0')
									{
									}
									else
									{
										?><span  class="glyphicon glyphicon-star star" aria-hidden="true" style="color:#FFE500;"></span><?php
									}
								}
								
								
								echo '</td>';
                                echo '<td>';
                                    echo ' <button type="button" class="btn btn-primary btn-xs" onclick="fn.app.product.dialog_edit_product('.$id.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
									echo ' <button type="button" title="Approve" class="btn btn-success btn-xs" onclick="fn.app.product.dialog_approve('.$id.')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
									echo ' <button type="button" title="Rate" class="btn btn-warning btn-xs" onclick="fn.app.product.dialog_rate('.$id.')"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>';
									echo ' <button type="button" title="Rate" class="btn btn-warning btn-xs" onclick="fn.app.product.dialog_rate('.$id.')"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>';
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

