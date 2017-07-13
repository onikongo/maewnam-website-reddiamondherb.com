<?php
	include_once "apps/blogs/include/me.class.php";
	$my = new meClass;
	$section = isset($_REQUEST['view'])?$_REQUEST['view']:"view";
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	$my->PageHeader($section);

	echo '<div class="col-md-12" style="padding:0px;">';
	switch($section){
		case "view":
			include_once "apps/blogs/view/dialog.blogs.table.php";
			break;
		case "add":
			include_once "apps/blogs/view/dialog.blogs.add.php";
			break;
		case "edit":
			include_once "apps/blogs/view/dialog.blogs.edit.php";
			break;
		case "Event":
			include_once "apps/blogs/view/dialog.event.table.php";
			break;
		case "addEvent":
			include_once "apps/blogs/view/dialog.event.add.php";
			break;
		case "editEvent":
			include_once "apps/blogs/view/dialog.event.edit.php";
			break;	
	}
	echo '</div>';
?>