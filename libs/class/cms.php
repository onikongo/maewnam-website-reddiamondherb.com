<?php

/*
 * 2014-04-07 Create New CMS Function
 * 
 */
 
class cms{
	private $dbc = null;
	private $ifaces = array();
	
	function __construct($dbc) {
		$this->dbc = $dbc;
		$file = file_get_contents("libs/iface/index.json");
		$json = json_decode($file,true);
		foreach($json['items'] as $li){
			array_push($this->ifaces,array($li['iface'],$li['file']));
		}
				
	}
	
	function ReadURL($system){
		global $_SESSION,$_REQUEST;
		$this->Connect();
		$action = "";
		$value = "";
			
		if(isset($_REQUEST['page'])){
				$p = explode("/",$_REQUEST['page']);
				if(in_array($p[0],array(
					"en","th","cn","jp","fr"
				))){
					$_SESSION['global_lang'] = array_shift($p);
				}
				
				if(in_array($p[0],array(
					"article"
				))){;
					$action = array_shift($p);
					$value = $p[0];
				}else{
					$action = "goto";
					$value = $this->ReadNavigator(implode("/",$p));		
					
					if($value === 0){
						$value = $system['notfound_page'];
					}
				}
					
			}else{
				if(isset($_REQUEST['pid'])){
					$action = "goto";
					if($this->HasRecord("pages","id=".$_REQUEST['pid'])){
						$value = $_REQUEST['pid'];
					}else{
						$value = $system['notfound_page'];
					}
					
				}else{
					$action = "goto";
					$value = $system['default_page'];
				}
				
			}
			
			if($action == "goto"){
				$_SESSION['global_current_page'] = $value;
			}
			
		return $value;
			
		$this->Close();
	}
	
	function iface_custom_naviheader($id){
		global $_SESSION,$_REQUEST;
		include "libs/custom/iface_header.php";
	}
	
	function load_custom($pid,$l,$p,$l_setting,$layout_editable_class,$edit_mode){
		$s_layout = json_decode(base64_decode($l['data']),true);
		$container = isset($s_layout['class'])?$s_layout['class']:"container";
		
		if(isset($s_layout['background'])){
			$carousel_bg_id = $s_layout['background']['id'];
			echo '<div id="'.$carousel_bg_id.'" class="carousel slide" data-ride="carousel">';
				echo '<ol class="carousel-indicators">';
				$imglist = $this->dbc->GetRecord("imagelists","data","id=".$s_layout['background']['value']);
				//$imglist = $this->dbc->GetRecord("imagelists","data","id=1");
				$lists = json_decode(base64_decode($imglist['data']),true);
				$active = " class='active'";
				$i = 0;
				foreach($lists as $li){
					$active = $i==0?" class='active'":"";
					echo '<li data-target="#carousel-aquawams-dg" data-slide-to="'.$i.'"'.$active.'></li>';
					$i ++;
				}
				echo '</ol>';
				
				echo '';
				echo '<div class="carousel-inner">';
				$active = " active";
				foreach($lists as $li){
					echo '<div class="item'.$active.' boxbox">';
						echo '<img src="'.$li['path'].'" alt="'.$li['detail'].'">';
						
						
						if($pid == 1) {
						echo '<div class="carousel-caption">';
							echo '<h3>'.$li['caption'].'</h3>';
							echo '<p>'.$li['detail'].'</p>';
						echo '</div>';
						}
						
					echo '</div>';
					$active = "";
				}
				echo '</div>';
				echo '<a class="left carousel-control" href="#carousel-aquawams-dg" data-slide="prev">';
					echo '<span class="glyphicon glyphicon-chevron-left"></span>';
				echo '</a>';
				echo '<a class="right carousel-control" href="#carousel-aquawams-dg" data-slide="next">';
					echo '<span class="glyphicon glyphicon-chevron-right"></span>';
				echo '</a>';

			echo '</div>';
		
		}
		echo '<div class="'.$container.'">';
			if(isset($s_layout['structure']))
			foreach($s_layout['structure'] as $row){
				
				$class = isset($row['class'])?$row['class']:"";
				if(isset($row['structure'])){
					$row = $row['structure'];
				}
				$style = $edit_mode?' stlye="position:absolute"':'';
				echo '<div class="row '.$class.'">';
					foreach($row as $column){
						echo '<div id="'.$column['name'].'" class="layout'.$layout_editable_class.' '.$column['class'].'"'.$style.'>';
						$sql = "SELECT * FROM contents WHERE (type='page' AND page=$pid AND container='$column[name]') OR (type='layout' AND container='$column[name]') ORDER BY priority,id";
						$rst = $this->dbc->Query($sql);
						while($content = $this->dbc->Fetch($rst)){
							$this->load_content($l,$p,$column['name'],$content);
						}
						echo '</div>';
					}
				echo '</div>';
				
				
			}
		echo '</div>';
	}
	
	function load_page($pid){
		global $_SESSION;
		$p=$this->dbc->GetRecord("pages","*","id=".$pid);
		$l=$this->dbc->GetRecord("layouts","*","id=".$p['layout']);
		$l_setting = json_decode(base64_decode($l['setting']),true);
		$edit_mode = $_SESSION["edit_mode"];
		$layout_editable_class=$_SESSION["edit_mode"]?" layout-editable":"";
		
		$children = explode(",",$l['children']);
		if(in_array("header", $children)){
			$this->iface_custom_naviheader(1);
		}
		
		if(isset($l_setting['type']) && $l_setting['type']=='custom'){
			$this->load_custom($pid,$l,$p,$l_setting,$layout_editable_class,$edit_mode);
			
		}else{
			$containers = explode(",",$l['children']);
			echo '<div class="container">';
			foreach($containers as $container){
				echo '<div id="'.$container.'" class="layout'.$layout_editable_class.'">';
				
				$sql = "SELECT * FROM contents WHERE (type='page' AND page=$pid AND container='$container') OR (type='layout' AND container='$container') ORDER BY priority,id";
				$rst = $this->dbc->Query($sql);
				while($content = $this->dbc->Fetch($rst)){
					
					$this->load_content($l,$p,$container,$content);
				}
	
				echo '</div>';
			}
			echo '</div>';
		}
		
		
	}

	
	
	function iface_editor($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		if($setting['editor']=="custom")$editable ="false";
		$div_id = "content_".$content['id'];
		switch($content['module']){
			case "editor.div" :
				echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
					echo '<div class="div_content" contenteditable="'.$editable.'" alt="'.$setting['editor'].'">';
					
					echo base64_decode($content['data']);
					echo '</div>';
				echo '</div>';
				break;
				
			case "editor.panel" :

				echo '<div id="'.$div_id.'"  class="content panel '.$setting['panel_style'].'" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
					echo '<div class="panel-heading">';
						echo '<h3 class="panel-title">'.base64_decode($setting['header']).'</h3>';
					echo '</div>';
					echo '<div class="panel-body" contenteditable="'.$editable.'" alt="'.$setting['editor'].'">';
						echo base64_decode($content['data']);
					echo '</div>';
				echo '</div>';
	
				break;
				
			case "editor.panelnoheader" :
				echo '<div id="'.$div_id.'" class="content panel '.$setting['panel_style'].'" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
					echo '<div class="panel-body" contenteditable="'.$editable.'" alt="'.$setting['editor'].'">';
						echo base64_decode($content['data']);
					echo '</div>';
				echo '</div>';
				break;
		}
	}
	
	protected function cms_navigator_aquawams_caption($item,$pid){
		switch($item['action']){
			case "Page":
				if($item['value'])
				return '<a href="?pid='.$item['value'].'" class="'.($item['value']==$pid?'active':'').'">'.$item['name'].'</a>';
				break;
			case "Link":
				return '<a href="'.$item['value'].'">'.$item['link'].'</a>';
				break;
			case "Action":
				echo '<a href="#">'.$item['name'].'</a>';
				return;
			default:
				return '<a href="#">'.$item['name'].'</a>';
				break;
		}
	}
	
	
	
	
	function iface_navigator($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$setting['class'] = isset($setting['class'])?$setting['class']:"";
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		
		$nav = $this->dbc->GetRecord("linklists","data","id=".$setting['list']);
		$items = json_decode(base64_decode($nav['data']),true);
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
		switch($setting['type']){
			case "aquawams":
				echo '<div class="navigation '.$setting['class'].'">';
				echo '<ul>';
				foreach($items['items'] as $item){
					echo '<li>';
						echo $this->cms_navigator_aquawams_caption($item,$p['id']);
							if(isset($item['items'])){
								echo '<div><ul>';
								foreach($item['items'] as $ite){
									echo '<li>';
									echo $this->cms_navigator_aquawams_caption($ite,$p['id']);
									echo '</li>';
								}
								echo '</ul></div>';
							}
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
				break;
			
			case "bootstrap":
				echo '<div class="navigation '.$setting['class'].'">';
				echo '<ul>';
				foreach($items['items'] as $item){
					echo '<li>';
						echo $this->cms_navigator_aquawams_caption($item,$p['id']);
							if(isset($item['items'])){
								echo '<div><ul>';
								foreach($item['items'] as $ite){
									echo '<li>';
									echo $this->cms_navigator_aquawams_caption($ite,$p['id']);
									echo '</li>';
								}
								echo '</ul></div>';
							}
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
				break;
			}
		echo '</div>';
	}


	function cms_load_menu(){
		
	}

	function iface_naviheader($id){
		$nav = $this->dbc->GetRecord("linklists","data","id=".$id);
		$items = json_decode(base64_decode($nav['data']),true);
		echo '<nav class="navbar navbar-default navbar-inverse navbar-main">';
			echo '<div class="container-fluid">';
				echo '<div class="navbar-header">';
					echo '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">';
						echo '<span class="sr-only">Toggle navigation</span>';
						echo '<span class="icon-bar"></span>';
						echo '<span class="icon-bar"></span>';
						echo '<span class="icon-bar"></span>';
					echo '</button>';
					echo ' <a class="navbar-brand" href="#">FILM MANIAC</a>';
				echo '</div>';
				echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
					echo '<ul class="nav navbar-nav">';
					
					foreach($items['items'] as $item){
						if(isset($item['items'])){
							echo '<li class="dropdown">';
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'+$item['name']+' <span class="caret"></span></a>';
								echo '<ul class="dropdown-menu" role="menu">';
									foreach($item['items'] as $ite){
										echo '<li>';
										echo $this->cms_navigator_aquawams_caption($ite,$p['id']);
										echo '</li>';
									}
								echo '</ul>';
							echo '</li>';
						}else{
							echo '<li>';
							echo $this->cms_navigator_aquawams_caption($item,$p['id']);
							echo '</li>';
						}
					}
					echo '</ul>';
				echo '</div>';
			echo '</div>';
		echo '</nav>';
	}
	
	function iface_news_headline($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
				
				if($_SESSION['edit_mode']){
					echo '<h1>News</h1>';
					echo '<h1>Headline</h1>';
				}else{
					switch($setting['type']){
						case "headbox":
							$sql = "SELECT * FROM news WHERE ".$this->dbc->multiple_parent_where("category", $setting['categories'])." ORDER BY created DESC ";
							$rst=$this->dbc->Query($sql);
							while($line = $this->dbc->Fetch($rst)){
								$st = json_decode(base64_decode($line['setting']),true);
								$link = "?pid=".$setting['children']."&nid=".$line['id'];
								echo '<div class="media">';
									if($st['image']!=""){
										echo '<a class="pull-left" href="'.$link.'">';
											echo '<img class="media-object" src="'.$st['image'].'" height="'.$setting['height'].'" width="'.$setting['width'].'" alt="">';
										echo '</a>';
									}
									echo '<div class="media-body">';
										echo '<h4 class="media-heading">'.base64_decode($line['headline']).'</h4>';
										echo base64_decode($line['detail']);
									echo '</div>';
								echo '</div>';
							}
							break;
						case "newslist":
							echo '<ul class="list-group">';
							$sql = "SELECT * FROM news WHERE ".$this->dbc->multiple_parent_where("category", $setting['categories'])." ORDER BY created DESC ";
							$rst=$this->dbc->Query($sql);
							while($line = $this->dbc->Fetch($rst)){
								$st = json_decode(base64_decode($line['setting']),true);
								$link = "?pid=".$setting['children']."&nid=".$line['id'];
								echo '<li class="list-group-item">';
									echo '<a href="'.$link.'">';
										echo base64_decode($line['headline']);
									echo '</a>';
								echo '</li>';
							}
							echo '</ul>';
							break;
						case "column":
							break;
						}
					}
				echo '</div>';
	}
	
	function iface_news_newscolumn($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
				if($_SESSION['edit_mode']){
					echo '<h1>News Column</h1>';
				}else if(isset($_REQUEST['nid'])){
					$news = $this->dbc->GetRecord("news","*","id=".$_REQUEST['nid']);
					$st = json_decode(base64_decode($news['setting']),true);
					switch($setting['type']){
						case "clean":
							echo '<div class="media">';
								if($st['image']!=""){
									echo '<a class="pull-left">';
										echo '<img class="media-object" src="'.$st['image'].'" height="'.$setting['height'].'" width="'.$setting['width'].'" alt="">';
									echo '</a>';
								}
								echo '<div class="media-body">';
									echo '<h4 class="media-heading">'.base64_decode($news['headline']).'</h4>';
									echo base64_decode($news['detail']);
								echo '</div>';
							echo '</div>';
							echo '<p>';
								echo base64_decode($news['data']);
							echo '</p>';
							break;
						case "panel":
							echo '<div class="panel '.$setting['panel_style'].'">';
								echo '<div class="panel-heading">';
									echo '<h3 class="panel-title">'.base64_decode($news['headline']).'</h3>';
								echo '</div>';
								echo '<div class="panel-body">';
								
									echo '<div class="media">';
										if($st['image']!=""){
											echo '<a class="pull-left">';
												echo '<img class="media-object" src="'.$st['image'].'" height="'.$setting['height'].'" width="'.$setting['width'].'" alt="">';
											echo '</a>';
										}
										echo '<div class="media-body">';
											echo base64_decode($news['detail']);
										echo '</div>';
									echo '</div>';
								
								echo '</div>';
							echo '</div>';
							echo '<div class="panel '.$setting['panel_style'].'">';
								echo '<div class="panel-body">';
									echo base64_decode($news['data']);
								echo '</div>';
							echo '</div>';
							break;
						}
					}else{
						echo '<h1>News Column</h1>';
						echo '<h2>No Selected News/h2>';
					}
				echo '</div>';
	}
	
	function iface_ecommerce_showroom($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
		if($_SESSION['edit_mode']){
			echo '<h1>Product Show Room</h1>';
		}else{
			echo '<div class="showroom">';
			switch($setting['cattegorystyle']){
				case "default":
					echo '<div class="showroom-category">';
						echo '<div class="btn-group" data-toggle="buttons">';
						foreach($setting['categories'] as $category){
							if($this->dbc->HasRecord("categories","id=".$category));{
								$cat = $this->dbc->GetRecord("categories","*","id=".$category);
								$cat_st = json_decode(base64_decode($cat['setting']),true);
								echo '<label class="btn btn-default">';
								echo '<input type="radio" name="category" checked>';
									if($cat_st['image'] != ""){
										echo '<img height="24" width="24" src="'.$cat_st['image'].'"></img>';
									}
									echo $cat['name'];
								echo '</label>';
							}
						}
						echo '</div>';
						echo '<div class="btn-group" data-toggle="buttons" style="float:right;">';
							echo '<label class="btn btn-default active"><input type="radio" name="views" id="views1" checked><span class="glyphicon glyphicon-th"></span> Thumbail</label>';
							echo '<label class="btn btn-default"><input type="radio" name="views" id="views2"><span class="glyphicon glyphicon-th-list"></span> List</label>';
						echo '</div>';
					echo '</div>';
					break;
				case "captiononly":
					echo '<div class="list-group">';
					foreach($setting['categories'] as $category){
						echo '<a href="#" class="list-group-item">';
							echo $category;
						echo '</a>';
					}
					echo '</div>';
					break;
			}
			echo "<br>";
			switch($setting['type']){
				case "default":
					echo '<div class="showroom-product">';
						echo '<div class="row">';
						$sql = "SELECT * FROM products";
						$rst = $this->dbc->Query($sql);
						while($prod = $this->dbc->Fetch($rst)){
							$prod_st = json_decode(base64_decode($prod['setting']),true);
							echo '<div class="col-sm-6 col-md-3">';
								echo '<div class="thumbnail">';
									if(count($prod_st['images'])>0){
										echo '<div id="carousel-product-'.$prod['id'].'" class="carousel slide" data-ride="carousel">';
										
											echo '<div class="carousel-inner">';
											$active = " active";
											foreach($prod_st['images'] as $li){
												echo '<div class="item'.$active.'">';
													echo '<img src="'.$li.'">';
												echo '</div>';
												$active = "";
											}
											echo '</div>';
								
											echo '<a class="left carousel-control" href="#carousel-product-'.$prod['id'].'" data-slide="prev">';
												echo '<span class="glyphicon glyphicon-chevron-left"></span>';
											echo '</a>';
											
											echo '<a class="right carousel-control" href="#carousel-product-'.$prod['id'].'" data-slide="next">';
												echo '<span class="glyphicon glyphicon-chevron-right"></span>';
											echo '</a>';
											
										echo '</div>';
									}
									echo '<h3>'.$prod['name'].'</h3>';
									echo '<p>'.$prod['price'].' THB</p>';
								echo '</div>';
							echo '</div>';
						}
						echo '</div>';
					echo '</div>';
					break;
				
			}
			echo '</div>';
		}
		echo '</div>';
	}

	function iface_ecommerce_product($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
				if($_SESSION['edit_mode']){
					echo '<h1>News Column</h1>';
				}else if(isset($_REQUEST['nid'])){
					$news = $this->dbc->GetRecord("product","*","id=".$_REQUEST['nid']);
					$st = json_decode(base64_decode($news['setting']),true);
					switch($setting['type']){
						case "clean":
							echo '<div class="media">';
								if($st['image']!=""){
									echo '<a class="pull-left">';
										echo '<img class="media-object" src="'.$st['image'].'" height="'.$setting['height'].'" width="'.$setting['width'].'" alt="">';
									echo '</a>';
								}
								echo '<div class="media-body">';
									echo '<h4 class="media-heading">'.base64_decode($news['headline']).'</h4>';
									echo base64_decode($news['detail']);
								echo '</div>';
							echo '</div>';
							echo '<p>';
								echo base64_decode($news['data']);
							echo '</p>';
							break;
						case "panel":
							echo '<div class="panel '.$setting['panel_style'].'">';
								echo '<div class="panel-heading">';
									echo '<h3 class="panel-title">'.base64_decode($news['headline']).'</h3>';
								echo '</div>';
								echo '<div class="panel-body">';
								
									echo '<div class="media">';
										if($st['image']!=""){
											echo '<a class="pull-left">';
												echo '<img class="media-object" src="'.$st['image'].'" height="'.$setting['height'].'" width="'.$setting['width'].'" alt="">';
											echo '</a>';
										}
										echo '<div class="media-body">';
											echo base64_decode($news['detail']);
										echo '</div>';
									echo '</div>';
								
								echo '</div>';
							echo '</div>';
							echo '<div class="panel '.$setting['panel_style'].'">';
								echo '<div class="panel-body">';
									echo base64_decode($news['data']);
								echo '</div>';
							echo '</div>';
							break;
						}
					}else{
						echo '<h1>News Column</h1>';
						echo '<h2>No Selected News/h2>';
		}
	}


	function cms_ecommerce_load_images($pid){
		$product = $this->dbc->GetRecord("products","*","id=".$pid);
		$st = json_decode(base64_decode($product['setting']),true);
		if(count($st['images'])>0){
			return $st['images'][0];
		}else{
			return "";
		}
	}
	
	function cms_ecommerce_mosaicroom_product($pid){
		$h = 150;
		$w = 150;
		$product = $this->dbc->GetRecord("products","*","id=".$pid);
		$st = json_decode(base64_decode($product['setting']),true);
		if(count($st['images'])>0){
			return '<img height="'.$h.'" height="'.$w.'" src="'.$st['images'][0].'">';
			//return '<div class="col-md-2"><img height="'.$h.'" height="'.$w.'" src="'.$st['images'][0].'"></div>';
		}else{
			return "";
		}
	}


	function iface_ecommerce_mosaicroom($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'">';
		if($_SESSION['edit_mode']){
			echo '<h1>Product Mosanic Room</h1>';
		}else{
			$style= "";
			echo '<div class="mosanicroom">';
				echo '<table>';
				echo '<tbody>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product1'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product2'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product3'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product4'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product5'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product6'])."</td>";
					echo '</tr>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product7'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product8'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product9'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product10'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product11'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product12'])."</td>";
					echo '</tr>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product12'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product13'])."</td>";
						echo '<td rowspan="2" colspan="2" style="background: #312E7E;" valign="middle" align="center"><a href="?pid=2"><img style="width:80%;" src="upload/materials/logo01.png"></a></td>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product14'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product15'])."</td>";
					echo '</tr>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product16'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product17'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product18'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product19'])."</td>";
					echo '</tr>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product21'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product22'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product23'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product24'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product25'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product26'])."</td>";
					echo '</tr>';
					echo '<tr>';
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product27'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product28'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product29'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product30'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product31'])."</td>";
						echo '<td>'.$this->cms_ecommerce_mosaicroom_product($setting['product32'])."</td>";
					echo '</tr>';
				echo '</tbody>';
				echo '</table>';
			
			echo '</div>';
		}
		echo '</div>';
	}


	function iface_custom($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		$div_id = "content_".$content['id'];
		
		echo '<div id="'.$div_id.'" class="content" data-id="'.$content['id'].'" data-module="'.$content['module'].'" data-item="'.$setting['item'].'">';
		include "libs/custom/".$setting['item'];
		echo '</div>';
	}

	function load_content($l,$p,$container,$content){
		global $_SESSION,$_REQUEST;
		$setting = json_decode(base64_decode($content['setting']),true);
		$editable = $_SESSION["edit_mode"]?"true":"false";
		
		switch($content['module']){
			case "editor.div" :
				$this->iface_editor($l,$p,$container,$content);
				break;
			case "editor.panel" :
				$this->iface_editor($l,$p,$container,$content);
				break;
			case "editor.panelnoheader" :
				$this->iface_editor($l,$p,$container,$content);
				break;
			case "headline":
				$this->iface_news_headline($l,$p,$container,$content);
				break;
			case "newscolumn":
				$this->iface_news_newscolumn($l,$p,$container,$content);
				break;
			case "productshowroom":
				$this->iface_ecommerce_showroom($l,$p,$container,$content);
				break;
			case "productdetail":
				$this->iface_ecommerce_showroom($l,$p,$container,$content);
				break;
			case "productmosaicroom":
				$this->iface_ecommerce_mosaicroom($l,$p,$container,$content);
				break;
			case "custom":
				$this->iface_custom($l,$p,$container,$content);
				break;
		}

		foreach($this->ifaces as $iface){
			if($iface[0]==$content['module']){
				include "libs/iface/".$iface[1];
			}
		}

		
	}

}
?>