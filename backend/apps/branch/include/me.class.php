<?php
class meClass{
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array("View", 'view',		'glyphicon glyphicon-home'),
		array("Add", 'add',		'glyphicon glyphicon-home'),
		array("Edit", 'edit',		'glyphicon glyphicon-home')
	);
	
	function PageHeader($active){
		/*echo '<div class="page-header">';
		echo '<h1>Product <small> ';
			foreach($this->header_meta as $header){
				if($header[1]==$active){
					echo $header[0];
				}
			}
		echo '</small></h1>';
		echo '</div>';*/
	}
	
	function PillBoxHeader($active){
		$headers = $this->header_meta;
		echo '<div style="margin-bottom:10px">';
		echo '<ul class="nav nav-pills">';
			foreach($headers as $header){
				echo '<li role="presentation"'.($active==$header[0]?' class="active"':'').'>';
				echo '<a href="#" onclick="fn.navigate(\'general\',{tab:\'geographic\',section:\''.$header[1].'\'})">';
				echo '<span class="'.$header[2].'" aria-hidden="true"></span>';
				echo ' '.$header[0].'';
				echo '</a>';
				echo '</li>';
			}
		echo '<ul>';
		echo '</div>';
	}
	
	function NavTabHeader($active){
		$headers = $this->header_meta;
		echo '<div style="margin-bottom:10px">';
		echo '<ul class="nav nav-tabs">';
			foreach($headers as $header){
				echo '<li role="presentation"'.($active==$header[1]?' class="active"':'').'>';
				echo '<a href="#" onclick="fn.navigate(\'general\',{tab:\'geographic\',section:\''.$header[1].'\'})">';
				echo '<span class="'.$header[2].'" aria-hidden="true"></span>';
				echo ' '.$header[0].'';
				echo '</a>';
				echo '</li>';
			}
		echo '<ul>';
		echo '</div>';
	}

	
	
	
}
?>
