<?php 
    include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$idor = $_REQUEST['id'];
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
  <li><font size="+2">Orders </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Orders</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <!--<a id="save" onClick="fn.app.subcategory.dialog_save_subcategory()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>-->
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Orders Detail </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <table id="tbldetail" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql1 = "SELECT * FROM order_detail  WHERE order_id = '".$idor."'";//
                        $rst1 = $dbc->Query($sql1);
                        
                        while($line2 = $dbc->Fetch($rst1)){
                            $id = $line2['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_orders" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
								
								$pro = $dbc->GetRecord("products","*","id='".$line2['pro_id']."'");
								//$con = $dbc->GetRecord("contacts","*","id='".$cus['contact']."'");
								$na = explode("|",$pro['name']);
								echo '<td>'.$na[0].'</td>';
                                echo '<td>'.$line2['amount'].'</td>';
								$amt += $line2['amount'];
								$pri = $dbc->GetRecord("orders","*","id = '".$line2['order_id']."'");
								echo '<td>'.number_format($line2['price']).'</td>';
								$pric += $line2['price'];
								$suppiler = $dbc->GetRecord("suppliers","*","id='".$line2['suppiler']."'");
								echo '<td>'.$suppiler['name'].'</td>';
                                //echo '<td>';
//                                    echo ' <button type="button" class="btn btn-success btn-xs" onclick="fn.app.ord.dialog_edit_subcategory('.$id.')">Change</button>';
//									echo ' <button type="button" class="btn btn-warning btn-xs" onclick="fn.app.ord.detail('.$id.')">Detail</button>';
//                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                    <tfoot>
                    	<tr>
                        	<td colspan="2">Total</td>
                            <td><?php echo $amt;?></td>
                            <td colspan="2"><?php echo number_format($pric);?></td>
                        </tr>
                    </tfoot>
                </table>
        
        
    <!--panel--> 
    </div>
    
    

    
    
    </div>
</div>

</div>