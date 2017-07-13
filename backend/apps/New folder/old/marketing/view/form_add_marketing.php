<?php 
    include_once "../../../../config/define.php";
	include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	
?>
<script>
//fn.app.marketing.initial("#cbbCountry","#cbbProvince","#cbbDistrict","#cbbSubdistrict");
//fn.app.marketing.load_country("#cbbCountry");
$(document).ready(function(e) {
    $("#back").click(function(e) {
        window.location.reload();
    });
	 //$( 'textarea.editor' ).ckeditor();
});
</script>
<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Event </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Event</a></li>
  
  <a id="back" class="pull-right btn btn-danger"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close</a>
  &nbsp;
  <a id="save" onClick="fn.app.marketing.dialog_save_marketing()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Event </h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="add_marketing" class="form-horizontal" role="form">
        	<div class="form-group">
                <label for="txtPhoto" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-4">
                    <img id="icon" src="/upload/thumb/icon.jpg" class="img-responsive" style="border:1px solid #999;">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txticon" name="txticon" placeholder="Name">
                </div>
                <div class="col-sm-2">
                    <div id="txtPhotoButton" class="btn btn-default" onClick="fn.app.marketing.dialog_thumb.open_elfinder();">Browse</div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Headlind</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="tx_Headlind" name="tx_Headlind" placeholder="tx_Headlind">
                </div>
            </div>
            
            
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Detail</label>
                <div class="col-sm-10">
                    <textarea  class="form-control editor" id="txtDetail" name="txtDetail" placeholder="Detail"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Start date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tx_sdate" name="tx_sdate" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Start time</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="tx_stime" name="tx_stime" >
                </div>
                <label for="inputEmail3" class="col-sm-2 control-label">End time</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="tx_etime" name="tx_etime" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Expiration Date</label>
                <div class="col-sm-10">
                	<input type="date" class="form-control" id="tx_exp" name="tx_exp" placeholder="Expiration Date">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Priority</label>
                <div class="col-sm-10">
                	<select id="priority" name="priority" class="form-control">
                    	<option value="1">Main</option>
                        <option value="2">Normal</option>
                    </select>
                </div>
            </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>