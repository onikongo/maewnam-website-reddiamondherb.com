<?php

function create_rating_star($number){
	
	for($i=1;$i<=5;$i++){
		if($number == 0){
			echo ' <span class="glyphicon glyphicon-star star"></span>';
		}else{ 
			echo ' <span class="glyphicon glyphicon-star star active"></span>';
			$number --;
		}
	}
}

?>
<form id="ratestar">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
	<dl class="dl-horizontal">
		<dt>Price Evaluation</dt>
		<dd>
		<?php
			create_rating_star(1);
		?>
		</dd>
		
		<dt>Class Evaluation</dt>
		<dd>
		<?php
			create_rating_star(4);
		?>
		</dd>
		
		<dt>Student</dt>
		<dd>
		<?php
			create_rating_star(0);
		?>
		</dd>
		
		<dt>Teacher Grading</dt>
		<dd>
		<?php
			create_rating_star(5);
		?>
		</dd>
		
		<dt>Other Evaluation</dt>
		<dd>
		<?php
			create_rating_star(3);
		?>
		</dd>
	</dl>
</form>   
<style>
	#ratestar span.active{
		color : #FFE500;
	}
	
	#ratestar span{
		cursor : pointer;
	}
</style>
<script>
	
	
</script>
<style>
.acstar
{
	color:#FFE500;
}
</style>