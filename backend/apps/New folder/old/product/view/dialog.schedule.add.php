<form id="add_schedule" class="form-horizontal" role="form">
	<div class="form-group">
        <label class="col-sm-2 control-label">From</label>
        <div class="col-sm-4">
            <input type="date" class="form-control txstart" id="txtFrom" name="txtFrom" placeholder="Start" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>">
        </div>
		 <label class="col-sm-2 control-label">To</label>
        <div class="col-sm-4">
            <input type="date" class="form-control txend" id="txtTo" name="txtTo" placeholder="End" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Seat Available</label>
        <div class="col-sm-4">
            <input type="number" class="form-control txseat" id="txtSeat" name="txtSeat" min="0" placeholder="0">
        </div>
    </div>
	<fieldset id="time_frame">
		<legend>Time Frame </legend>
		<div id="panelSchedule">
			
			
		</div>
	</fieldset>
    <div id="options" class="col-sm-12"></div>
</form>