<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Tags </font></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.subcategory.dialog_add_subcategory()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.subcategory.remove_subcategory()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Tag List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
    	<div class="well well-sm" >
        	<div class="col-md-3">
            	<select class="form-control" id="optional">
                	<option value="all">All category</option>
                <?php $cate = $dbc->Query("SELECT * FROM categories");
					while($row = $dbc->Fetch($cate))
					{
						?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
					}
					?>
                	
                </select>
            </div>
            <br><br>
        </div>
        
        
         <div id="detal"></div>
                
                    
                    


    <!--panel--> 
    <div id="addcustomer"></div>      
    </div>
    
</div>

<script>
//$("#tblCategory").DataTable();
$(document).ready(function(e) {

	$.ajax({
			url:"apps/subcategory/xhr/action-load-subcate.php",
			type:"POST",
			dataType:"html",
			data:{opt:$("#optional").val()},
			success: function(res){
				$("#detal").html(res);
			}
		});
	$("#optional").change(function(e) {
        $.ajax({
			url:"apps/subcategory/xhr/action-load-subcate.php",
			type:"POST",
			dataType:"html",
			data:{opt:$("#optional").val()},
			success: function(res){
				$("#detal").html(res);
			}
		});
    });
});
</script>






















<!--<script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>-->














