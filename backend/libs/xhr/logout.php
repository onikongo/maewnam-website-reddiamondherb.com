<?php
	session_start();
	
	unset($_SESSION['admin_mode']);
	unset($_SESSION['edit_mode']);
	
	unset($_SESSION['auth']);
	

?><meta http-equiv="refresh" content="0;URL=/admin/login.php">