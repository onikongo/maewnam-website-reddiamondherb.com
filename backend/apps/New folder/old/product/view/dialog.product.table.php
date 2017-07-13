<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"Product";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?>
<div align="right">
	<button type="button" class="btn btn-primary" onclick="fn.navigate('add')">Add</button>
	<button type="button" class="btn btn-danger"  onclick="fn.app.product.remove_product()">Remove</button>
</div>
<br>
<ul class="nav nav-tabs " role="tablist">
    <li role="presentation" <?php if($tab=="Product")echo' class="active"'; ?>>
    <a href="#Product" aria-controls="home" role="tab" data-toggle="tab">Product</a>
    </li>
    <li role="presentation"<?php if($tab=="Hightlight")echo' class="active"'; ?>>
    <a href="#Hightlight" aria-controls="profile" role="tab" data-toggle="tab">Hightlight</a>
    </li>
  </ul><br>
<div class="tab-content " >
    <div role="tabpanel" class="tab-pane <?php if($tab=="Product")echo' active'; ?>" id="Product">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Products List</h3>
            </div>
            <div class="panel-body">
            <!--panel-->   
                <div class="well well-lg">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="email" class="form-control" id="tx_Name" name="tx_Name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control" id="cate">
                                    <option value="all">All category</option>
                                <?php $cate = $dbc->Query("SELECT * FROM categories");
                                    while($row = $dbc->Fetch($cate))
                                    {
                                        ?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subcategory</label>
                                <select class="form-control" id="subcate">
                                    <option value="all">All subcategory</option>
                                <?php $cate = $dbc->Query("SELECT * FROM subcategory");
                                    while($row = $dbc->Fetch($cate))
                                    {
                                        ?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date Added</label>
                                <input type="date" class="form-control" id="tx_date" name="tx_date" placeholder="Date Added">
                            </div>
                            <a id="profilter" class="btn btn-primary pull-right">Filter</a>
                        </div>
                    </div>
                    <br><br><br><br><br>
<script>
$(document).ready(function(e) {
    	$.ajax({
			url:"apps/product/xhr/action-filter-product.php",
			type:"POST",
			dataType:"html",
			data:{
				tx_name:$("#tx_Name").val(),
				cate:$("#cate").val(),
				subcate:$("#subcate").val(),
				tx_date:$("#tx_date").val()
				},
			success: function(res){
				$("#prooo").html(res);
			}
		});
	$("#profilter").click(function(e) {
        $.ajax({
			url:"apps/product/xhr/action-filter-product.php",
			type:"POST",
			dataType:"html",
			data:{
				tx_name:$("#tx_Name").val(),
				cate:$("#cate").val(),
				subcate:$("#subcate").val(),
				tx_date:$("#tx_date").val()
				},
			success: function(res){
				$("#prooo").html(res);
			}
		});
    });

});
</script>
                </div>
                
                <div id="prooo"></div>
                 
                        
        
            <!--panel--> 
            <div id="addcustomer"></div>      
            </div>
            
        </div>
    </div>
    <div role="tabpanel" class="tab-pane <?php if($tab=="Hightlight")echo' active'; ?>" id="Hightlight">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Products List</h3>
            </div>
            <div class="panel-body">
            <!--panel-->   
                <div class="well well-lg">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="email" class="form-control" id="tx_NameH" name="tx_NameH" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control" id="cateH">
                                    <option value="all">All category</option>
                                <?php $cate = $dbc->Query("SELECT * FROM categories");
                                    while($row = $dbc->Fetch($cate))
                                    {
                                        ?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subcategory</label>
                                <select class="form-control" id="subcateH">
                                    <option value="all">All subcategory</option>
                                <?php $cate = $dbc->Query("SELECT * FROM subcategory");
                                    while($row = $dbc->Fetch($cate))
                                    {
                                        ?><option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option><?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <a id="hightfilter" class="btn btn-primary pull-right">Filter</a>
                        </div>
                       <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><!--Date Added--></label>
                                <!--<input type="date" class="form-control" id="tx_dateH" name="tx_dateH" placeholder="Date Added">-v->
                            </div>
                            <a id="hightfilter" class="btn btn-primary pull-right">Filter</a>
                        </div>-->
                    </div>
                    <br><br><br><br><br>
        <script>
$(document).ready(function(e) {
    	$.ajax({
			url:"apps/product/xhr/action-filter-product-hightlight.php",
			type:"POST",
			dataType:"html",
			data:{
				tx_NameH:$("#tx_NameH").val(),
				cateH:$("#cateH").val(),
				subcateH:$("#subcateH").val(),
				tx_date:$("#tx_dateH").val()
				},
			success: function(res){
				$("#hightlightt").html(res);
			}
		});
	$("#hightfilter").click(function(e) {
        $.ajax({
			url:"apps/product/xhr/action-filter-product-hightlight.php",
			type:"POST",
			dataType:"html",
			data:{
				tx_NameH:$("#tx_NameH").val(),
				cateH:$("#cateH").val(),
				subcateH:$("#subcateH").val(),
				tx_dateH:$("#tx_dateH").val()
				},
			success: function(res){
				$("#hightlightt").html(res);
			}
		});
    });

});
</script>

                </div>
                
                <div id="hightlightt"></div>
                 
                        
        
        
            <!--panel--> 
            <div id="addcustomer"></div>      
            </div>
            
        </div>
    </div>
</div>
<!--<script>
 $(document).ready(function() {
	$('#tblCategory').dataTable({
		"paging": "pull-right",
		"searching" : false
	});
	
});
</script>
--><script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<style>
.dataTables_paginate {
   float:right;
}
</style>
