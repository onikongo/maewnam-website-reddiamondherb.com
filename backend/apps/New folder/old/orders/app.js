var ord = {
	dialog_thumb : {
		open_elfinder : function(){
			window.open("apps/subcategory/view/dialog_elfinder_icon.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txticon").val(val);
			$("#icon").attr('src',val);
		}
	},
	dialog_add_subcategory:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/subcategory/view/form_add_subcategory.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	detail : function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/orders/view/form_detail.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	dialog_save_subcategory:function(){
		if(document.getElementById("tx_name").value== '')
		{
			alert("Please fill your name");
			document.getElementById("tx_name").focus();
			return false;
		}
		else if(document.getElementById("txticon").value== '')
		{
			alert("Please choose icon");
			document.getElementById("txticon").focus();
			return false;
		}
		else
		{
			
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/orders/xhr/action-add-subcategory.php",
					data: $("#add_subcategory").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
			
		}
		
	},remove_od: function(){
		var item_selected = [];
		$("input[name=chk_orders]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/orders/xhr/action-remove-orders.php',{items:item_selected},function(response){
				window.location = "?app=orders";
			});
		}
		
	},dialog_edit_subcategory: function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/subcategory/view/form_edit_subcategory.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_subcategory:function(){
		if(document.getElementById("tx_name").value== '')
		{
			alert("Please fill your name");
			document.getElementById("tx_name").focus();
			return false;
		}
		else if(document.getElementById("txticon").value== '')
		{
			alert("Please choose icon");
			document.getElementById("txticon").focus();
			return false;
		}
		else
		{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/subcategory/xhr/action-edit-subcategory.php",
					data: $("#edit_subcategory").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
		}
	},
	dialog_edit:function(id){
			$.ajax({
				url: "apps/orders/view/form_edit_status.php",//url: "apps/product/view/dialog.product.rate.php",
				type: "POST",
				dataType: "html",
				data:{id:id},
				success: function(html){
				$("body").append("<div id=\"dialog_lookup\"></div>");
					$("#dialog_lookup").html(html);
					$("#dialog_lookup").dialog({
						autoOpen : true,
						title : "Order Status",
						width : 400,
						modal : true,
						buttons : [
							{text : "Save", class: 'btn btn-primary pull-right', click: function() {
								$.ajax({
									type: "POST",
									dataType:"html",
									url: "apps/orders/xhr/action-edit-order.php",
									data: $("#ratestar").serialize(),
									success : function(json)
									{
										window.location.reload();
									}
								});
							}},
							{text : "Cancel", class : "btn btn-default pull-right", click: function() { $("#dialog_lookup").dialog("destroy").remove(); }},
						],close: function(){
							$("#dialog_lookup").dialog("destroy").remove();
						}
					});
				}
			});
	}
	
};

$.extend(fn.app,{ord:ord});
