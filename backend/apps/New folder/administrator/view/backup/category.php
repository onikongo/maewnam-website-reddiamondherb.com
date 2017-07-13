<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?>

<ul class="nav nav-tabs" role="tablist">
	<li<?php if($tab=="category")echo' class="active"'; ?>><a href="#category" data-toggle="tab">Category</a></li>
	<li<?php if($tab=="brand")echo' class="active"'; ?>><a href="#brand" data-toggle="tab">Brand</a></li>
	<li<?php if($tab=="class")echo' class="active"'; ?>><a href="#class" data-toggle="tab">Class</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane<?php if($tab=="category")echo' active'; ?>" id="category">
		<div align="right">
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.dialog_add_category()">Add</button>
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.remove_category()">Remove</button>
		</div>
		<br>
		<table id="tblCategory" class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM categories";
				$rst = $dbc->Query($sql);
				
				while($line = $dbc->Fetch($rst)){
					$id = $line['id'];
					echo '<tr>';
						echo '<td><input name="chk_category" type="checkbox" value="'.$id.'"></td>';
						echo '<td>'.$id.'</td>';
						echo '<td>'.$line['name'].'</td>';
						echo '<td>';
							echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.inventory.dialog_edit_category('.$id.')">Change</button>';
						echo '</td>';
					echo '</tr>';
				}
			
			?>
			</tbody>
		</table>
		
	</div>
	<div class="tab-pane<?php if($tab=="brand")echo' active'; ?>" id="brand">
		
		<div align="right">
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.dialog_add_brand()">Add</button>
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.remove_brand()">Remove</button>
		</div>
		<br>
		<table id="tblBrand" class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Name</th>
					<th>Image</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM brands";
				$rst = $dbc->Query($sql);
				
				while($line = $dbc->Fetch($rst)){
					$id = $line['id'];
					echo '<tr>';
						echo '<td><input name="chk_brand" type="checkbox" value="'.$id.'"></td>';
						echo '<td>'.$id.'</td>';
						echo '<td>'.$line['name'].'</td>';
						echo '<td>'.$line['image'].'</td>';
						echo '<td>';
							echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.inventory.dialog_edit_brand('.$id.')">Change</button>';
						echo '</td>';
					echo '</tr>';
				}
			
			?>
			</tbody>
		</table>
		
	</div>
	<div class="tab-pane<?php if($tab=="class")echo' active'; ?>" id="class">
		<div align="right">
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.dialog_add_class()">Add</button>
			<button type="button" class="btn btn-primary" onclick="fn.app.inventory.remove_class()">Remove</button>
		</div>
		<br>
		<table id="tblBrand" class="table table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Name</th>
					<th>Image</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sql = "SELECT * FROM classes";
				$rst = $dbc->Query($sql);
				
				while($line = $dbc->Fetch($rst)){
					$id = $line['id'];
					echo '<tr>';
						echo '<td><input name="chk_brand" type="checkbox" value="'.$id.'"></td>';
						echo '<td>'.$id.'</td>';
						echo '<td>'.$line['name'].'</td>';
						echo '<td>';
							echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.inventory.dialog_edit_class('.$id.')">Change</button>';
						echo '</td>';
					echo '</tr>';
				}
			
			?>
			</tbody>
		</table>
	</div>
</div>


