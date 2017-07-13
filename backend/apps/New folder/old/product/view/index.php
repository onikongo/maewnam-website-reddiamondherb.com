<?php
	include_once "apps/product/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$my->PageHeader($section);

	echo '<div class="col-md-12">';
	switch($section){
		case "view":
			include_once "apps/product/view/dialog.product.table.php";
			break;
		case "add":
			include_once "apps/product/view/dialog.product.add.php";
			break;
		case "edit":
			include_once "apps/product/view/dialog.product.edit.php";
			break;
	}
	echo '</div>';
?>