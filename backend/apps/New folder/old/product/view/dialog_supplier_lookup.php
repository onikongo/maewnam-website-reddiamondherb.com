<?php
	session_start();
	
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
	$sql = $dbc->Query("SELECT * FROM suppliers");
	
	
?>
	
	<table id="tblsupplierLookup" class="table table-hover table-condensed table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
            <?php while($row = $dbc->Fetch($sql))
				{
					?>
				<tr alt='<?php echo $row['id'];?>'>
                	<td align="center">
                    	<input id="chk_supp" name="chk_supp" type="radio" value="<?php echo $row['id'].'|'.$row['name'];?>">
                    </td>
                    <td><?php echo $row['name'];?></td>
                </tr>
         <?php }?>
			</tbody>
	</table>
	