<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$tx_name = $_REQUEST['tx_NameH'];
	$cate = $_REQUEST['cateH'];
	$subcate = $_REQUEST['subcateH'];
	$tx_date = $_REQUEST['tx_dateH'];
	
	if($tx_name!='')
	{
		//$subname = 'SUBSTRING_INDEX(products.name,"|",0)'; 
		$name = "WHERE p.name LIKE '%".$tx_name."%'";//."
		
		//$name = "WHERE $subname = ".$tx_name;//." 
	}
	else
	{
		$name = "";
	}
	
	if($cate!='all')
	{
		if($tx_name!='')
		{
			$category = "AND p.category = ".$cate;
		}
		else
		{
			$category = "WHERE p.category = ".$cate;
		}
	}
	else
	{
		$category = "";
	}
	
	if($subcate!='all')
	{
		if($cate!='all')
		{
			$subcategory = "AND p.subcategory = ".$subcate;
		}
		elseif($tx_name!='')
		{
			$subcategory = "AND p.subcategory = ".$subcate;
		}
		else
		{
			$subcategory = "WHERE p.subcategory = ".$subcate;
		}
	}
	else
	{
		$subcategory = "";
	}
	
	/*if($tx_date=='')
	{
		$date = "";
	}
	else
	{
		$date = "AND SUBSTRING_INDEX(created,' ',0) = '".$tx_date."'";
	}*/
?>
<table id="tblhightlight" class="table table-striped table-hover table-condensed table-bordered">
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
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php //SELECT h.*,p.* FROM product_hightlight AS h  INNER JOIN products AS p ON h.product=p.id WHERE p.name LIKE '%to%'
	 	//echo $sqll = "SELECT h.*,p.* FROM product_hightlight AS h  INNER JOIN products AS p ON h.product=p.id $name $category $subcategory  <br> ";
        $sql = "SELECT h.*,p.* FROM product_hightlight AS h  INNER JOIN products AS p ON h.product=p.id $name $category $subcategory ";//INNER JOIN products ON product_hightlight.product = products.id
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
               /* $rate = $dbc->Query("SELECT * FROM comments WHERE product='".$id."'");
                $nu = $dbc->GetNum($rate);
                while($rowRate = $dbc->Fetch($rate))
                {
                    $score += $rowRate['rate'];
                }
                //echo $score;
                if($score!=0)
                {
                    echo $toScore = $score/$nu;
                }
                
                $score='';*/
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
				
				$user = $dbc->GetRecord("users","*","id='".$line['user']."'");
                echo '<td>'.$user['name'].'</td>';
                echo '<td>';
                   ?><button type="button" class="btn btn-primary btn-xs" onclick="fn.navigateEdit('edit','<?php echo $id;?>')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><?php 
                    echo ' <button type="button" title="Approve" class="btn btn-success btn-xs" onclick="fn.app.product.dialog_approve('.$id.')"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>';
                    echo ' <button type="button" title="Rate" class="btn btn-warning btn-xs" onclick="fn.app.product.dialog_rate('.$id.')"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>';
                    if($dbc->HasRecord("product_hightlight","product = '".$id."'"))
                    {
                        echo ' <button type="button" title="Hightlight" class="btn btn-danger btn-xs hl" onclick="fn.app.product.dialog_hightlight('.$id.',this)"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></button>';
                    }
                    else
                    {
                        echo ' <button type="button" title="Hightlight" class="btn btn-default btn-xs hl" onclick="fn.app.product.dialog_hightlight('.$id.',this)"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span></button>';
                    }
                    
                echo '</td>';
            echo '</tr>';
        }
    
    ?>
    </tbody>
</table>	





    <script>
 $(document).ready(function() {
	$('#tblhightlight').dataTable({
		"paging": "pull-right",
		"searching" : false
	});
	
});
</script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<style>
.dataTables_paginate {
   float:right;
}
</style>
