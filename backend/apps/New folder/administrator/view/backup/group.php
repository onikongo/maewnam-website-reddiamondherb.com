<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?>

<?php /*?><ul class="nav nav-tabs" role="tablist">
	<li<?php if($tab=="category")echo' class="active"'; ?>><a href="#category" data-toggle="tab">Category</a></li>
	<li<?php if($tab=="brand")echo' class="active"'; ?>><a href="#brand" data-toggle="tab">Brand</a></li>
	<li<?php if($tab=="class")echo' class="active"'; ?>><a href="#class" data-toggle="tab">Class</a></li>
</ul>
<?php */?><div class="tab-content">
	<div class="tab-pane<?php if($tab=="category")echo' active'; ?>" id="category">
		<div align="right">
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.dialog_add_group()">Add</button>
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.remove_group()">Remove</button>
		</div>
		<br>
        <script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>

		<table id="tblCategory" class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Group name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM customer_group";
				$rst = $dbc->Query($sql);
				
				while($line = $dbc->Fetch($rst)){
					$id = $line['cg_id'];
					echo '<tr>';
						echo '<td><input name="chk_group" type="checkbox" value="'.$id.'"></td>';
						echo '<td>'.$id.'</td>';
						echo '<td>'.$line['cg_name'].'</td>';
						echo '<td>';
							echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.inventory.dialog_edit_group('.$id.')">Change</button>';
						echo '</td>';
					echo '</tr>';
				}
			
			?>
			</tbody>
		</table>
		
	</div>
</div>


