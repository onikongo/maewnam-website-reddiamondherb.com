<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$sup = $_REQUEST['id'];
	$pro = $_REQUEST['pro'];
	
	$sqlbr = $dbc->Query("SELECT * FROM branches WHERE supplier='".$_REQUEST['id']."'");
	$aBranch = array();
	$i=1;
	while($row = $dbc->Fetch($sqlbr))
	{
		//echo '----*'.$row['code'];
		$new = array($row['id'],$row['code']);
		array_push($aBranch,$new);
		$i++;
	}
			
			
			echo '<ul class="nav nav-tabs" role="tablist">';
			$i=0;
			foreach($aBranch as $branch){
				$active = $i==0?"active":"";
				echo '<li role="presentation" class="'.$active.'">';
					echo '<a href="#tab_branch_'.$branch[0].'" role="tab" data-toggle="tab">'.$branch[1].'</a>';
				echo '</li>';
				$i++;
				
			}
				
			echo '</ul>';
			echo '<div class="tab-content">';
			$i=0;
			
			foreach($aBranch as $branch){
				$active = $i==0?" active":"";
				echo '<div role="tabpanel" class="tab-pane'.$active.'" id="tab_branch_'.$branch[0].'">';
				echo '<br>';
				echo '<a href="#" class="btn btn-primary" onclick="fn.app.product.schedule.add(\'#tab_branch_'.$branch[0].'\','.$branch[0].')">Add Schedule</a>';
				echo '<br>';echo '<br>';
				echo '<ul class="list-group items_schedule">';
                	$getPeriod = $dbc->Query("SELECT * FROM periods WHERE branch = '".$branch[0]."' AND  product ='".$pro."'");
					$aMonth=array('','January','February','March','April','May','June','July','August','September','October','November','December');
					while($rowPeriod = $dbc->Fetch($getPeriod))
					{
						?>
                        <li class="list-group-item">
                            <p>Date : 
							<?php echo $aMonth[substr($rowPeriod['start'],5,2)].','.substr($rowPeriod['start'],8,2).'&nbsp;&nbsp;'.substr($rowPeriod['start'],0,4);?> - 
                            <?php echo $aMonth[substr($rowPeriod['end'],5,2)].','.substr($rowPeriod['end'],8,2).'&nbsp;&nbsp;'.substr($rowPeriod['end'],0,4);?></p>
                           <!-- <dl class="dl-horizontal">-->
							<?php  $scd = json_decode($rowPeriod['schedule'],true);
							$aWeek=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
							foreach($scd as $schedule)
							{
								?>
                                <dl class="dl-horizontal">
                                	<dt><?php 
									if(in_array($schedule[0],$aWeek))
									{
										echo $schedule[0];//$aWeek[$schedule[0]];
									}
									else
									{
										echo $aWeek[$schedule[0]];
									}?></dt>
                                    <dd><?php echo $schedule[1].' - '.$schedule[2];?></dd>
                                </dl><?php
								/*echo '&nbsp;&nbsp;&nbsp;&nbsp;<p><b>'.(in_array($schedule[0],$aWeek))?$aWeek[$schedule[0]]:''.'</b>';
								echo ' : '.$schedule[1].' - '.$schedule[2].'</p>';*/
								$i++;
							}
							?>
                            
                            <!--</dl>-->
                                <!--<dt>Sunday</dt><dd>09:00:00-18:00:00,09:00:00-18:00:00</dd>-->
                            
                            <span onClick="removeme('<?php echo $rowPeriod['id'];?>')" class="badge btn">Remove</span><p>Exception : -</p> 
                        </li><?php
					}
					
				echo '</ul>';
				
				echo '</div>';
				$i++;
				
			}
			echo '';
			echo '';
			echo '</div>';
			
			
	//print_r($aBranch);
			
?>	
<?php $dbc->Close();?>

<script>
function removeme(key)
{
	var conf = confirm("Are you sure to Delete");
		if(conf==true)
		{
			$.ajax({
				url:"apps/product/xhr/action-remove-period.php",
				type:"POST",
				dataType:"json",
				data:{id:key},
				success: function(result){
					if(result==true)
					{
						$("#peri").click();
					}
					else
					{
					}
				}
			});
		}
		else
		{
			return false;
		}
}
</script>