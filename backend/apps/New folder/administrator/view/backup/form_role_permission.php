<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$json = json_decode(file_get_contents("../../../../config/system.json"),true);
?>
<br>
<form id="form_permission" class="form-horizontal" role="form">
	
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Menu</th>
			<?php
				foreach($json['roles'] as $role){
					echo '<th>'.$role['name'].'</td>';
				}
				
			?>
		</tr>
	</thead>
	<tbody>
	<?php
		$dbc = new dbc;
		$dbc->Connect();
		
		$sql = "SELECT * FROM roles";
		$rst = $dbc->Query($sql);
	
		while($line = $dbc->Fetch($rst)){
			echo '<tr>';
			echo '<td>'.$line['name'].'</td>';
			foreach($json['roles'] as $role){
				echo '<td><input name="'.$role['name'].'[]" type="checkbox" value="'.$line['id'].'"></td>';
			}
			echo '</tr>';
		}
		
		
				
	?>
	</tbody>			
</table>
	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Group Name">
		</div>
	</div>
	<div class="form-group">
		<label for="txtName" class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-5">
	    	<select id="cbbStatus" name="cbbStatus" class="form-control">
				<option value="0">Inactive</option>
				<option value="1" selected>Active</option>
				<option value="2">Lock</option>
				<option value="3">Cannot Delete</option>
			</select>
	    </div>
	</div>
</form>