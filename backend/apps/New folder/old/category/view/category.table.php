<div class="col-md-12" >
	<div class="col-md-8"><font size="+2">Categories </font></div>
    <div class="col-md-4">
    	<div align="right">
            <a type="button" class="btn btn-primary" onclick="fn.navigate('add')">Add</a>
            <a type="button" class="btn btn-danger" onclick="fn.app.category.remove_category()">Remove</a>
        </div>

    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Category List</h3>
    </div>
    <div class="panel-body">
    <!--panel-->   
                <table id="tblCategory" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Category Name</th>
                            <th>Sort Order</th>
                            <th>Icon</th>
                            <th>Hover Color</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT * FROM categories ORDER BY sort_order ASC";//
                        $rst = $dbc->Query($sql);
                        
                        while($line = $dbc->Fetch($rst)){
                            $id = $line['id'];
                            echo '<tr>';
                                echo '<td><input name="chk_category" type="checkbox" value="'.$id.'"></td>';
                                //echo '<td>'.$id.'</td>';
								
                                echo '<td>'.$line['name'].'</td>';
                                echo '<td>'.$line['sort_order'].'</td>';
								echo '<td><img src="'.$line['icon'].'" class="col-md-2"/></td>';
								echo '<td  style="background:'.$line['color_code'].' !important;"></td>';
                                echo '<td>';
                                    echo '<button type="button" class="btn btn-success btn-xs" onclick="fn.navigate(\'edit\',{catid:'.$id.'})">Change</button>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
                    </tbody>
                </table>


    <!--panel--> 
    <div id="addcustomer"></div>      
    </div>
    
</div>




















