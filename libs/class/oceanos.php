<?php

/*
 * 2016-02-16 : Created New System : Todsaporn S.
 * 
 */

 
class oceanos{
	private $dbc = null;
	private $user_id = null;
	private $group_id = null;
	
	function __construct($dbc) {
		$this->dbc = $dbc;
	}
	
	function allow($app,$action){
		global $_SESSION;
		if(isset($_SESSION['auth'])){
			if($_SESSION['auth']['group_id']==0){
				return true;
			}else{
				return $this->dbc->HasRecord("permissions","name='$app' AND action = '$action' AND gid=".$_SESSION['auth']['group_id']);
			}
		}else{
			return false;
		}
	}
	
	
	
	
}