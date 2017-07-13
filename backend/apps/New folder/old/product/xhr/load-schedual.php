<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$idinv = $_REQUEST['id'];
	?>
    <table id="TAB" class="table table-striped table-hover table-condensed table-bordered">
    	<thead>
        	<tr>
            	<th>#</th>
                <th>Class Name</th>
                <th>Teacher Name</th>
                <th>Detail</th>
                <!--<th></th>
                <th></th>
                <th></th>
                <th></th>-->
            </tr>
        </thead>
        <tbody>
			<?php 
			$sql = $dbc->Query("SELECT * FROM schedule ORDER BY id DESC");
			while($row = $dbc->Fetch($sql))
			{
				$id = $row['id'];
				?>
				<tr>
                    <td><input type="radio" name="chk_schedule" value="<?php echo $id;?>" <?php echo($id==$idinv)?'checked':'';?> id="chk_schedule"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['teacher']; ?></td>
                    <td>
						<div class="col-md-12">
                                <?php 
								$dstart = json_decode($row['date_start'],true);
								foreach($dstart as $data)
								{
									?>
                                    <div class="col-md-6">Date Start : <?php echo $data['startDate'];?></div><div class="col-md-6">Date End : <?php echo $data['endDate'];?></div>
                                    <div class="col-md-6">Time Start : <?php echo $data['start_Time'];?></div><div class="col-md-6">Time Start : <?php echo $data['end_Time'];?></div>
                                    <div class="col-md-12">Unit : <?php echo $data['Unit'];?></p></div>
                                    <?php
								}
								?>
                    	</div>
                    </td>
                    
                </tr>
            <?php 
			}
			?>

        	
        </tbody>
    </table>
    

<script>
$("#TAB").DataTable({
	"ordering": true,
        "info":     false,
		"searching" : false,
		"paging":   true
});
</script>








<?php
	$dbc->Close();
?>