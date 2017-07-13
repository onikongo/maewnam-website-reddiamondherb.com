<div align="right">
	<button type="button" class="btn btn-danger" onclick="fn.app.customer.subscription.remove()">Remove</button>
</div>
<br>
<table id="tblSubscription" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="text-center"><button id="btnCheckAll" type="button" class="btn btn-default  btn-xs">Check All</button></th>
			<th class="text-center">ID</th>
			<th class="text-center">Type</th>
			<th class="text-center">Value</th>
			<th class="text-center">Join</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<script>
	$("#tblSubscription").data( "selected", [] );
	$("#tblSubscription").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "apps/customer/store/store-subscription.php",
		"aoColumns": [
			{ "bSortable": false},
			{"bSort" : true },
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true}
		],
		"order": [[ 1, "desc" ]],
		"createdRow": function ( row, data, index ) {
			var checked = "";
			if ( $.inArray(data.DT_RowId, $("#tblSubscription").data( "selected")) !== -1 ) {
                $(row).addClass('active');
                checked = " checked";
            }
			$('td', row).eq(0).html('<input name="chk_subscription" type="checkbox" value="'+data[0]+'"'+checked+'>').addClass("text-ceter").addClass("text-center");
			
			
			
		}
	});
	
	$('#tblSubscription tbody').on('click', 'td:not(:last-child)', function () {
		var me = $(this).parent();
        var id = me[0].id;
        var index = $.inArray(id, $("#tblSubscription").data( "selected"));
        if ( index === -1 ) {
            $("#tblSubscription").data( "selected").push( id );
            $(me).find('input[name=chk_subscription]').prop('checked', true);
        } else {
            $("#tblSubscription").data( "selected").splice( index, 1 );
            $(me).find('input[name=chk_subscription]').prop('checked', false);
        }
 
        $(me).toggleClass('active');
    } );
    
    $('#btnCheckAll').click(function(){
    	var AllChecked = true;
    	$("input[name=chk_subscription]").each(function(){
    		if(!$(this).is(':checked')){
    			AllChecked = false;
    		}
		});
		
		if(AllChecked){
			$('input[name=chk_subscription]').prop('checked', false).parent().parent().removeClass('active');
			$("input[name=chk_subscription]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblSubscription").data( "selected"));
		        if ( index != -1 ) {
		           $("#tblSubscription").data( "selected").splice( index, 1 );
		        }
			});
		}else{
			$('input[name=chk_subscription]').prop('checked', true).parent().parent().addClass('active');
			$("input[name=chk_subscription]").each(function(){
				var id = $(this).parent().parent()[0].id;
		    	var index = $.inArray(id, $("#tblSubscription").data( "selected"));
		        if ( index === -1 ) {
		            $("#tblSubscription").data( "selected").push( id );
		        }
			});
		}
		
    });
</script>