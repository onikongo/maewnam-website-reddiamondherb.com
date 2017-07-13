<?php
	include_once "apps/category/include/me.class.php";
	$me = new meClass;
?><br><br><br><?php	
	$view = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$me->PageHeader($view);

	switch($view){
		case "view":
			include_once "apps/category/view/category.table.php";
			break;
		case "add":
			include_once "apps/category/view/dialog.category.add.php";
			break;
		case "edit":
			include_once "apps/category/view/dialog.category.edit.php";
			break;
	}

?>






