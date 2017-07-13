<?php
	include_once "apps/product/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$my->PageHeader($section);

	echo '<div class="col-md-12" style="padding:0px;">';
	switch($section){
		case "view":
			include_once "apps/product/view/dialog.product.table.php";
			break;
		case "add_cate":
			include_once "apps/product/view/dialog.product.add_cate.php";
			break;
		case "edit_cate":
			include_once "apps/product/view/dialog.product.edit_cate.php";
			break;
		case "add_product":
			include_once "apps/product/view/dialog.product.add_product.php";
			break;	
		case "product_table":
			include_once "apps/product/view/dialog.product.product_table.php";
			break;	
		case "edit_product":
			include_once "apps/product/view/dialog.product.edit_product.php";
			break;	
			
	}
	echo '</div>';
?>