<div class="fpage">
<div class="inpage">

<ol class="breadcrumb">
  <li><font size="+2">Customer Group List </font></li>
  <li><a href="#">Home</a></li>
  <li><a href="#">Customer Group List</a></li>
  
  <a id="back" href="javascript:window.location = '?app=group'" class="pull-right btn btn-danger">
  <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Close
  </a>
  <a id="save" onClick="fn.app.customer.dialog_save_group()" class="pull-right btn btn-primary">
  <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save
  </a>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Add Customer Group</h3>
    </div>
    <div class="panel-body padd">
    <!--panel--> 
        <form id="add_group" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="txtName" class="col-sm-2 control-label">Customer Group Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Customer Group Name">
                </div>
            </div>
            <div class="form-group">
                <label for="txtDetail" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea  class="form-control" id="txtDetail" name="txtDetail" placeholder="Description"></textarea>
                </div>
            </div>
        </form>
    <!--panel--> 
    </div>
    </div>
</div>

</div>