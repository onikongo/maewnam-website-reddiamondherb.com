<?
class meClass{
	private $dbc = null;
	
	function __construct($dbc=null){
		$this->dbc = $dbc;
	}
	
	private $header_meta = array(
		array("Table",'view','glyphicon glyphicon-file'),
		array("Add",'add','glyphicon glyphicon-file'),
		array("Edit",'edit','glyphicon glyphicon-file')
	);
	
	function PageHeader($active){
		echo '<div class="page-header">';
		echo '<h1>Category<small> ';
			foreach($this->header_meta as $header){
				if($header[1]==$active){
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
				echo '<a href="#" onclick="fn.navigate(\''.$header[1].'\')">';
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
				echo '<a href="#" onclick="fn.navigate(\''.$header[1].'\')">';
				echo '<span class="'.$header[2].'" aria-hidden="true"></span>';
				echo ' '.$header[0].'';
				echo '</a>';
				echo '</li>';
			}
		echo '<ul>';
		echo '</div>';
	}
	
	function NextQuotationNumber($previous=null){
		$dbc = $this->dbc;
		if($dbc->HasRecord("setting","name='sales_quotation_number'")){
			$setting = $dbc->GetRecord("setting","data","name='sales_quotation_number'");
			$item = json_decode($setting['data'],true);
			$next = $item['no']+1;
			$sub = 0;
			
			if($previous!=null){
				$next = $previous;
				foreach($item['data'] as $data){
					if($data['quo']==$next){
						foreach($data['rev'] as $item){
							if($item>$sub)$sub=$item;
						}
					}
				}
			}
			$sub++;
			return array(
				"quo" => $next,
				"rev" => $sub
			);
		}else{
			$item = array(
				"no" => 0,
				"data" => array()
			);
			
			$dbc->Insert("setting",array(
				"name" => "sales_quotation_number",
				"data" => json_encode($item),
				"#updated" => "NOW()"
			));
			
			return array(
				"quo" => 1,
				"rev" => 1
			);
		}
	}
	
	function SaveQuotationNumber($set){
		$dbc = $this->dbc;
		$setting = $dbc->GetRecord("setting","data","name='sales_quotation_number'");
		$item = json_decode($setting['data'],true);
		$item['no'] = $set["quo"];
		
		$found = false;
		for($i=0;$i<count($item['data']);$i++){
			if($item['data'][$i]['quo']==$set["quo"]){
				array_push($item['data'][$i]['rev'],$set['rev']);
				$found = true;
			}
		}
		
		
		if(!$found){
			array_push($item['data'],array(
				"quo" => $set['quo'],
				"rev" => array($set['rev'])
			));
		}
		
		
		
		if(!in_array($item['rev'], $item['data'])){
			array_push($item['data'],$item['rev']);
		}
		
		$dbc->Update("setting",array(
			"data" => json_encode($item),
			"#updated" => "NOW()"
		),"name = 'sales_quotation_number'");
		
	}
	
	
	
}
?>
