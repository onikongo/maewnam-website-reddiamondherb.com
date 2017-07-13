<?php session_start();
	switch($_REQUEST['lang'])
	{
		case'en':
			$_SESSION['lang_new']="en";
		break;
		case'th':
			$_SESSION['lang_new']="th";
		break;
	}
?>
