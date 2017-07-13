<?php
	include_once "apps/branch/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$my->PageHeader($section);

	echo '<div class="col-md-12" style="padding:0px;">';
	switch($section){
		case "view":
			include_once "apps/branch/view/dialog.branch.table.php";
			break;
		case "add":
			include_once "apps/branch/view/dialog.branch.add.php";
			break;
		case "edit":
			include_once "apps/branch/view/dialog.branch.edit.php";
			break;
	}
	echo '</div>';
?>