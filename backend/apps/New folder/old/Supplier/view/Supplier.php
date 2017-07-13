<?php
	//include_once "../../../../config/define.php";
//	include_once "../../../../libs/class/db.php";
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"Supplier";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	$google_api_key = "AIzaSyCskEKVYZ2KvGyu9WoCwq7RAgVhm1dctj0";
	
	$dbc = new dbc;
	$dbc->Connect();
?><br>
<br>
<br>
<br>
<!-- Nav tabs -->
  <ul class="nav nav-tabs " role="tablist">
    <li role="presentation" <?php if($tab=="Supplier")echo' class="active"'; ?>><a href="#Supplier" aria-controls="home" role="tab" data-toggle="tab">Supplier</a></li>
    <li role="presentation"<?php if($tab=="Branch")echo' class="active"'; ?>><a href="#Branch" aria-controls="profile" role="tab" data-toggle="tab">Branch</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content ">
    <div role="tabpanel" class="tab-pane <?php if($tab=="Supplier")echo' active'; ?>" id="Supplier">
   		<div class="page-header">
          <h1>Supplier<small> Management</small><div class="pull-right"><a id="addbut_sup" class="btn btn-primary">Add</a> 
          <a class="btn btn-danger" onClick="fn.app.Supplier.remove_sup()">Remove</a></div></h1>
        </div>
        <script>
		
		$(document).ready(function(e) {
			fn.app.Supplier.initial("#cbbCountry","#cbbProvince","#cbbDistrict","#cbbSubdistrict");
			fn.app.Supplier.load_country("#cbbCountry");
		
			$("#addbut_sup").click(function(e) {
				$(".breadcrumb").slideDown(200);
			});
			$("#cancelbtn_sup").click(function(e) {
				$(".breadcrumb").slideUp(200);
			});
		});
		
		</script>
        <ol class="breadcrumb" style="display:none;">
        	<form id="add_supplier" class="form-horizontal">
                <!--<div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_Name" name="sup_Name" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="sup_surName" name="sup_surName" placeholder="Surname">
                    </div>
                </div>-->
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Supplier Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txttax" name="sup_Name" placeholder="Supplier Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtName" class="col-sm-2 control-label">Tax ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txttax" name="txttax" placeholder="Tax ID">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        &nbsp;<a class="btn btn-primary  pull-right" onClick="fn.app.Supplier.add_supp()">Save</a>&nbsp;<a id="cancelbtn_sup" class="btn btn-default  pull-right">Cancel</a>
                    </div>
                </div>
            </form>
        </ol>
        
    	<div class="col-md-12">
        	<table class="table table-bordered table-hover table-striped">
            	<thead>
                	<tr>
                    	<th>#</th>
                        <th>Name</th>
                        <th>Taxid</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php $sql_branch = $dbc->Query("select * from suppliers order by id asc");
				while($row = $dbc->Fetch($sql_branch))
				{	$id = $row['id'];
					
                   echo '<tr>';
                    	echo '<td><input type="checkbox" id="chk_branch" name="chk_branch" value="'.$id.'"></td>';
						echo '<td>'.$row['name'].'</td>';
						echo '<td>'.$row['taxid'].'</td>';
						echo '<td>'.$row['created'].'</td>';
						echo '<td><a class="btn btn-success btn-xs" onclick="fn.app.Supplier.edit_supp('.$id.')">change</a></td>';
                    echo '</tr>';
				}?>
                	
                </tbody>
            </table>
        </div>
    </div>
    
    <div role="tabpanel" class="tab-pane <?php if($tab=="Branch")echo' active'; ?>" id="Branch">
    	<div class="page-header">
          <h1>Branch<small> Management</small><div class="pull-right"><a id="addbut" class="btn btn-primary">Add</a> 
          <a class="btn btn-danger" onClick="fn.app.Supplier.remove_branch()">Remove</a></div></h1>
        </div>
        <script>
		$(document).ready(function(e) {
			$("#addbut").click(function(e) {
				$(".breadcrumb").slideDown(200);
				initMap();
			});
			$("#cancelbtn").click(function(e) {
				$(".breadcrumb").slideUp(200);
			});
		});
		
		</script>
        <ol class="breadcrumb" style="display:none;">
        	<form id="add_branch" class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="name" name="name" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Supplier</label>
                    <div class="col-sm-10">
                    	<select class="form-control" id="supplier" name="supplier" >
                        	<?php $sql_supp = $dbc->Query("select * from suppliers order by id asc");
							while($sup = $dbc->Fetch($sql_supp))
							{
								echo '<option value="'.$sup['id'].'">'.$sup['name'].'</option>';
							}?>
                        </select>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" id="txtPhone" name="txtPhone" placeholder="Phone">
                    </div>
                    <label class="col-sm-1 control-label">Mobile</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">E-Mail</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="E-Mail">
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea name="txtAddress" rows="2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">District</label>
                    <div class="col-sm-4">
                        <select id="cbbDistrict" name="cbbDistrict" class="form-control">
                        
                        </select>
                        
                    </div>
                    <label class="col-sm-2 control-label">Subdistrict</label>
                    <div class="col-sm-4">
                        <select id="cbbSubdistrict" name="cbbSubdistrict" class="form-control">
                        
                        </select>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Province</label>
                    <div class="col-sm-4">
                        <select id="cbbProvince" name="cbbProvince" class="form-control">
                        
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">Postal</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtPostal" name="txtPostal" placeholder="Zip Code">
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <select id="cbbCountry" name="cbbCountry" class="form-control">
                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Latitude</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtLatitude" name="txtLatitude" placeholder="Latitude">
                    </div>
                    <label class="col-sm-2 control-label">Longtitude</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtLongtitude" name="txtLongtitude" placeholder="Longtitude">
                    </div>
                </div> 
				<div id="maps" style="height:400px;" class="form-group">
				</div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        &nbsp;<a class="btn btn-primary  pull-right" onClick="fn.app.Supplier.add_branch()">Save</a>&nbsp;<a id="cancelbtn" class="btn btn-default  pull-right">Cancel</a>
                    </div>
                </div>
				
            </form>
        </ol>
        
    	<div class="col-md-120">
        	<table class="table table-bordered table-hover table-striped">
            	<thead>
                	<tr>
                    	<th>#</th>
                        <th>Name</th>
                        <th>Supplier</th>
                        <th>Location</th>
                        <th>Latitude</th>
                        <th>Longtitude</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php $sql_branch = $dbc->Query("select * from branches order by id asc");
				while($row = $dbc->Fetch($sql_branch))
				{	$id = $row['id'];
					
                   echo '<tr>';
                    	echo '<td><input type="checkbox" id="chk_branch" name="chk_branch" value="'.$id.'"></td>';
						echo '<td>'.$row['code'].'</td>';
						$supplier = $dbc->GetRecord("suppliers","*","id='".$row['supplier']."'");
						echo '<td>'.$supplier['name'].'</td>';
						
						$con = $dbc->GetRecord("contacts","*","id='".$row['location']."'");
						$address = $dbc->GetRecord("address","*","contact='".$con['id']."'");
						$district = $dbc->GetRecord("districts","*","id='".$address['district']."'");
						$subdistrict = $dbc->GetRecord("subdistricts","*","id='".$address['subdistrict']."'");
						$city = $dbc->GetRecord("cities","*","id='".$address['city']."'");
						$country = $dbc->GetRecord("countries","*","id='".$address['country']."'");
						
						echo '<td>'.$address['address'].''.$district['name'].''.$subdistrict['name'].''.$city['name'].''.$country['name'].'</td>';
						echo '<td>'.$row['latitude'].'</td>';
						echo '<td>'.$row['longtitude'].'</td>';
						echo '<td>'.$row['created'].'</td>';
						echo '<td><a class="btn btn-success btn-xs" onclick="fn.app.Supplier.edit_branch('.$id.')">change</a></td>';
                    echo '</tr>';
				}?>
                	
                </tbody>
            </table>
        </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_api_key;?>&libraries=drawing,places" async defer></script>

  <script>
  
	var geocoder;
	var map;
	var marker;
	var map_init = false;

  
  function initMap() {
	  if(map_init){
					var address = $(this).children(":selected").text();
					geocoder.geocode( {'address' : address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							map.setZoom(5);
						}
					});
				}

		var office = new google.maps.LatLng(13.684488, 100.609695);
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat:13.684488,  lng:100.609695},
			zoom: 15,
			disableDoubleClickZoom: true
		});
		
		geocoder = new google.maps.Geocoder();
		
		google.maps.event.addListener(map, 'dblclick', function(event) {
			startLocation = event.latLng;
			
			if(marker){
				marker.setPosition(startLocation);
			}else{
				marker = new google.maps.Marker({
					position: startLocation,
					map: map,
					title: 'Your Address'
				});
			}
			$("#txtLatitude").val(startLocation.lat());
			$("#txtLongitude").val(startLocation.lng());

		});
		
		
		
	}
  </script>
<?php $dbc->Close();?>