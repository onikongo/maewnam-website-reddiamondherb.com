<div align="right">
	<button type="button" class="btn btn-primary" onclick="fn.app.customer.group.add()">Add</button>
	<button type="button" class="btn btn-danger" onclick="fn.app.customer.group.remove()">Remove</button>
</div>
<br>
<table id="tblGroup" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="text-center"><button id="btnCheckAll" type="button" class="btn btn-default  btn-xs">Check All</button></th>
			<th>ID</th>
			<th class="text-center">Group Name</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<script>
	$("#tblGroup").data( "selected", [] );
	$("#tblGroup").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/customer/store/store-group.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : true , "sWidth": "30px"},
			{"bSortable": true},
			{ "bSortable": false }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblGroup").data( "selected")) !== -1 ) {
                $(row).addClass('active');
                checked = " checked";
            }
			$('td', row).eq(0).html('<input name="chk_group" type="checkbox" value="'+data[0]+'"'+checked+'>').addClass("text-ceter").addClass("text-center");
			var s = '';
			s += '<button type="button" class="btn btn-default btn-xs" onclick="fn.app.customer.group.edit('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span> Change</button>';
			$('td', row).eq(3).html(s);
			
			
		}
	});
	
	$('#tblGroup tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblGroup").data( "selected"));
        if ( index === -1 ) {
            $("#tblGroup").data( "selected").push( id );
            $(me).find('input[name=chk_group]').prop('checked', true);
        } else {
            $("#tblGroup").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_group]').prop('checked', false);
        }
 
        $(me).toggleClass('active');
    } );
    
    $('#btnCheckAll').click(function(){
    	var AllChecked = true;
    	$("input[name=chk_group]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_group]').prop('checked', false).parent().parent().removeClass('active');
			$("input[name=chk_group]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblGroup").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblGroup").data( "selected").splice( index, 1 );
		        }
			});
		}else{
			$('input[name=chk_group]').prop('checked', true).parent().parent().addClass('active');
			$("input[name=chk_group]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblGroup").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblGroup").data( "selected").push( id );
		        }
			});
		}
		
    });
</script>