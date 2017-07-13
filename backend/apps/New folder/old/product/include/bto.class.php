<?
class btoClass{
	private $header_meta = array(
		array("New Order","fn.app.bto.navigate('page_neworder')",'page_neworder','glyphicon glyphicon-copy'),
		array("Deposit","fn.app.bto.navigate('page_deposit')",'page_deposit','glyphicon glyphicon-piggy-bank'),
		array("Build","fn.app.bto.navigate('page_build')",'page_build','glyphicon glyphicon-hourglass'),
		array("Ready","fn.app.bto.navigate('page_ready')",'page_ready','glyphicon glyphicon-transfer'),
		array("Complete","fn.app.bto.navigate('page_complete')",'page_complete','glyphicon glyphicon-ok-circle'),
		array("Incomplate","fn.app.bto.navigate('page_incomplete')",'page_incomplete','glyphicon glyphicon-remove-circle')
	);
	
	function PageHeader($active){
		echo '<div class="page-header">';
		echo '<h1>Made to Order<small> ';
			foreach($this->header_meta as $header){
				if($header[2]==$active){
					echo $header[0];
				}
			}
		echo '</small></h1>';
		echo '</div>';
	}
	
	function PillBoxHeader($active){
		$headers = $this->header_meta;
		echo '<div style="margin-bottom:10px">';
		echo '<ul class="nav nav-pills">';
			foreach($headers as $header){
				echo '<li role="presentation"'.($active==$header[0]?' class="active"':'').'>';
				echo '<a href="#" onclick="'.$header[1].'">';
				echo '<span class="'.$header[3].'" aria-hidden="true"></span>';
				echo ' '.$header[0].'';
				echo '</a>';
				echo '</li>';
			}
		echo '<ul>';
		echo '</div>';
	}
	
	function CreateComponent($i,$component,$data=NULL){
		$oncalculate = "fn.app.bto.order.calcualte_price()";
		$type = $component['component'];
		$caption = $component['caption'];
		$component_name = "item[$i]";
		switch($type){
			case "textbox":
				echo '<div class="form-group">';
					echo '<label class="col-sm-3 control-label">'.$caption.'</label>';
					echo '<div class="col-sm-9">';
						if($component['type']=="textarea"){
							echo '<textarea name="'.$component_name.'" class="form-control" rows="4"'.(is_null($data)?'':' value="'.$data.'"').'></textarea>';
						}else{
							echo '<input name="'.$component_name.'" type="text" class="form-control"'.(is_null($data)?'':' value="'.$data.'"').'>';
						}
						
					echo '</div>';
				echo '</div>';
				break;
			case "header":
				echo '<h4>'.$caption.'</h4>';
				echo '<hr>';
				break;
			case "combobox":
				echo '<div class="form-group">';
					echo '<label class="col-sm-3 control-label">'.$caption.'</label>';
					echo '<div class="col-sm-9">';
						echo '<select alt="'.$i.'" name="'.$component_name.'" class="form-control" onchange="'.$oncalculate.'">';
							foreach($component['items'] as $key => $option){
								if(is_null($data)){
									$selected = $key==0?" selected":"";
								}else{
									$selected = $key==$data?" selected":"";
								}
								echo '<option value="'.$key.'"'.$selected.'>'.$option['option'].'('.$option['price'].')</option>';
							}
						echo '</select>';
					echo '</div>';
				echo '</div>';
				break;
			case "checkbox":
				echo '<div class="form-group">';
					echo '<label class="col-sm-3 control-label">'.$caption.'</label>';
					echo '<div class="col-sm-9">';
						foreach($component['items'] as $key => $option){
							$selected = "";
							if(!is_null($data)){
								if(in_array($key,$data)){
									$selected = " checked";
								}
							}
							echo ' <input alt="'.$i.'" name="'.$component_name.'[]" type="checkbox" value="'.$key.'" onclick="'.$oncalculate.'"'.$selected.'> '.$option['option'];
						}
					echo '</div>';
				echo '</div>';
				break;
			case "radio":
				echo '<div class="form-group">';
					echo '<label class="col-sm-3 control-label">'.$caption.'</label>';
					echo '<div class="col-sm-9">';
						foreach($component['items'] as $key => $option){
							if(is_null($data)){
									$selected = $key==0?" checked":"";
							}else{
									$selected = $key==$data?" checked":"";
							}
							echo ' <input alt="'.$i.'" name="'.$component_name.'" type="radio" value="'.$key.'" onclick="'.$oncalculate.'"'.$selected.'> '.$option['option'];
						}
					echo '</div>';
				echo '</div>';
				break;
			
		}
	}
				
	function CreateComponentDetail($i,$component,$data=NULL){
		$oncalculate = "fn.app.bto.order.calcualte_price()";
		$type = $component['component'];
		$caption = $component['caption'];
		$component_name = "item[$i]";
		switch($type){
			case "textbox":
				
				echo '<dt>'.$caption.'</dt>';
				echo '<dd>'.($data!=""?$data:"-").'</dd>';
				
				break;
			case "header":
				echo '<h3>'.$caption.'</h3>';
				break;
			case "combobox":
				echo '<dt>'.$caption.'</dt>';
				echo '<dd>';
				if(is_null($data)){
					echo $component['items'][0]['option'].'('.$component['items'][0]['price'].')';
				}else{
					echo $component['items'][$data]['option'].'('.$component['items'][$data]['price'].')';
				}
				echo '</dd>';
				
				break;
			case "checkbox":
				echo '<dt>'.$caption.'</dt>';
				echo '<dd>';
						foreach($component['items'] as $key => $option){
							$selected = "";
							if(!is_null($data)){
								if(in_array($key,$data)){
									$selected = " checked";
								}
							}
							echo ' <input alt="'.$i.'" name="'.$component_name.'[]" type="checkbox" value="'.$key.'" onclick="'.$oncalculate.'"'.$selected.'> '.$option['option'];
						}
				echo '</dd>';
				break;
			case "radio":
				echo '<dt>'.$caption.'</dt>';
				echo '<dd>';
				if(is_null($data)){
					echo $component['items'][0]['option'].'('.$component['items'][0]['price'].')';
				}else{
					echo $component['items'][$data]['option'].'('.$component['items'][$data]['price'].')';
				}
				echo '</dd>';
				break;
			
			}	
			
		}
	}
?>
