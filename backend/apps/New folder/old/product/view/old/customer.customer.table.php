<div align="right">
	<button type="button" class="btn btn-primary" onclick="fn.app.customer.customer.add()">Add</button>
	<button type="button" class="btn btn-danger" onclick="fn.app.customer.customer.remove()">Remove</button>
</div>
<br>
<table id="tblCustomer" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="text-center"><button id="btnCheckAll" type="button" class="btn btn-default  btn-xs">Check All</button></th>
			<th>Customer No.</th>
			<th class="text-center">Type</th>
			<th class="text-center">Name</th>
			<th class="text-center">Phone</th>
			<th class="text-center">E-Mail</th>
			<th class="text-center">Created</th>
			<th class="text-center">Updated</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<script>
	$("#tblCustomer").data( "selected", [] );
	$("#tblCustomer").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/customer/store/store-customer.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : true },
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": false,"visible": false},
			{"bSortable": false,"visible": false},
			{ "bSortable": false }
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblCustomer").data( "selected")) !== -1 ) {
                $(row).addClass('active');
                checked = " checked";
            }
			$('td', row).eq(0).html('<input name="chk_customer" type="checkbox" value="'+data[0]+'"'+checked+'>').addClass("text-ceter").addClass("text-center");
			var s = '';
			s += '<button type="button" class="btn btn-default btn-xs" onclick="fn.app.customer.customer.edit('+data[0]+')"><span class="glyphicon glyphicon-pencil"></span></button> ';
			s += '<button type="button" class="btn btn-default btn-xs" onclick="fn.app.customer.address.lookup(\'customer\','+data[0]+')"><span class="glyphicon glyphicon-envelope"></span></button>';
			$('td', row).eq(6).html(s);
			
			
		}
	});
	
	$('#tblCustomer tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblCustomer").data( "selected"));
        if ( index === -1 ) {
            $("#tblCustomer").data( "selected").push( id );
            $(me).find('input[name=chk_customer]').prop('checked', true);
        } else {
            $("#tblCustomer").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_customer]').prop('checked', false);
        }
 
        $(me).toggleClass('active');
    } );
    
    $('#btnCheckAll').click(function(){
    	var AllChecked = true;
    	$("input[name=chk_customer]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_customer]').prop('checked', false).parent().parent().removeClass('active');
			$("input[name=chk_customer]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblCustomer").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblCustomer").data( "selected").splice( index, 1 );
		        }
			});
		}else{
			$('input[name=chk_customer]').prop('checked', true).parent().parent().addClass('active');
			$("input[name=chk_customer]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblCustomer").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblCustomer").data( "selected").push( id );
		        }
			});
		}
		
    });
</script>