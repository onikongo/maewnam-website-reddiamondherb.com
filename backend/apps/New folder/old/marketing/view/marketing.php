<?php
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"category";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
?><br><br><br><br><br><br>
<div class="col-md-12">
	<div class="col-md-8"><font size="+2">Marketing management</font></div>
    <div class="col-md-4">
    	<div align="right">
            <button type="button" class="btn btn-primary" onclick="fn.app.marketing.dialog_add_marketing()">Add</button>
            <button type="button" class="btn btn-danger" onclick="fn.app.marketing.remove_marketing()">Remove</button>
        </div>

    </div>
</div>
<br><br><br>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Event List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
        
        
        
         
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Headline</th>
                            <th>Detail</th>
                            <th>Photo</th>
                            <th>Start Date</th>
                            <th>Start time</th>
                            <th>End time</th>
                            <th>Expiration Date</th>
                            <th>Priority</th>
                            <th>Action</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM news ORDER BY id ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
							$img = json_decode($line['setting'],true);
                            echo '<tr>';
                                echo '<td><input name="chk_marketing" type="checkbox" value="'.$id.'"></td>';
                                echo '<td>'.$line['headline'].'</td>';
                                echo '<td>'.$line['detail'].'</td>';
                                echo '<td><img src='.$line['setting'].' width="120"></td>';
								echo '<td>'.$line['startDate'].'</td>';
								echo '<td>'.$line['startTime'].'</td>';
								echo '<td>'.$line['endtime'].'</td>';
								echo '<td>'.$line['expired'].'</td>';
                                echo '<td>'.$line['priority'].'</td>';
                                echo '<td>';
                                    echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.app.marketing.dialog_edit_marketing('.$id.')">Change</button>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>


    <!--panel--> 
    <div id="addmarketing"></div>      
    </div>
    
</div>
























<!--<script type="text/javascript" src="../../../../datatable/js/jquery.dataTables - none.js"></script>
<script src="../../../../datatable/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
	$('#tblCategory').DataTable();
});
</script>-->














