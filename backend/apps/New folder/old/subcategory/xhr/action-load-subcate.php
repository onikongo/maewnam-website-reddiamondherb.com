<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$opt = $_REQUEST['opt'];
	if($opt=='all')
	{
		$sql = "SELECT * FROM subcategory ORDER BY id ASC";//
	}
	else
	{
		$sql = "SELECT * FROM subcategory WHERE category = '".$opt."' ORDER BY id ASC";//
	}
	
	
	$rst = $dbc->Query($sql);
	?>
	<table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tag Name</th>
                            <th>Parent (Category)</th>
                            <!--<th>Sort Order</th>-->
                            <th>Icon</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
	<?php
	
	while($line = $dbc->Fetch($rst)){
		$id = $line['id'];
		echo '<tr>';
			echo '<td><input name="chk_subcategory" type="checkbox" value="'.$id.'"></td>';
			//echo '<td>'.$id.'</td>';
			
			echo '<td>'.$line['name'].'</td>';
			$cat = $dbc->GetRecord("categories","*","id='".$line['category']."'");
			echo '<td>'.$cat['name'].'</td>';
			//echo '<td>'.$line['sort_order'].'</td>';
			echo '<td><img src="'.$line['icon'].'"  width="60"/></td>';
			echo '<td>';
				echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.subcategory.dialog_edit_subcategory('.$id.')">Change</button>';
			echo '</td>';
		echo '</tr>';
	}
                    
	
	//$dbc->Close();
?>
</tbody>
                </table>