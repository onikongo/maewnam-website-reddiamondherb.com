<?php
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?>

<div align="right">
			<button type="button" class="btn btn-primary" onclick="fn.app.administrator.dialog_add_user()">Add</button>
			<button type="button" class="btn btn-primary" onclick="fn.app.administrator.remove_user()">Remove</button>
		</div>
		<br>
		
		<table id="tblUser" class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Name</th>
					<th>Status</th>
					<th>Group</th>
					<th>Created</th>
					<th>Updated</th>
					<th></th>
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
		echo '<td><button type="button" class="btn btn-default btn-xs" onclick="fn.app.administrator.dialog_edit_user('.$id.')">Change</button></td>';
		echo '</tr>';
	}

?>
			</tbody>
		</table>
