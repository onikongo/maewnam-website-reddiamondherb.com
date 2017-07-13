<?php
	include_once "apps/password/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$my->PageHeader($section);

	echo '<div class="col-md-12" style="padding:0px;">';
	switch($section){
		case "view":
			include_once "apps/password/view/dialog.password.table.php";
			break;
	}
	echo '</div>';
?>