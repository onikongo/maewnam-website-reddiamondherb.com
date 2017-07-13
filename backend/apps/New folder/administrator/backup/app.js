var customer = {
	dialog_add_customer:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/customer/view/form_add_customer.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
		
		
		
	},remove_customer: function(){
		var item_selected = [];
		$("input[name=chk_customer]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/customer/xhr/action-remove-customer.php',{items:item_selected},function(response){
				window.location = "?app=customer";
			});
		}
		
	},dialog_edit_customer: function(id){
		$.ajax({
			url: "apps/customer/view/form_edit_customer.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append("<div id=\"dialog_edit_customer\"></div>");
				$("#dialog_edit_customer").html(html);
				$("#dialog_edit_customer").dialog({
					autoOpen : true,
					title : "Edit Customer",
					width : 840,
					height : 580,
					modal : true,
					buttons : [
						{text : "Cancel", click: function() { $("#dialog_edit_customer").dialog("destroy").remove(); }},
						{text : "Edit", click: function() {
/*							if(document.getElementById("group").value=="0")
								{
									alert("Please choose group");
									document.getElementById("group").focus();
									return false;
								}
								else
								{
*/									$.post('apps/customer/xhr/action-edit-customer.php',$('#edit_customer').serialize(),function(response){
										window.location = "?app=customer";
									});
								//}
						}}
								
					],close: function(){
						$("#dialog_edit_customer").dialog("destroy").remove();
					}
				});
				
			}
		});
		fn.app.supplier.initial(
							"#form_edit_suppplier #cbbCountry",
							"#form_edit_suppplier #cbbProvince",
							"#form_edit_suppplier #cbbDistrict",
							"#form_edit_suppplier #cbbSubdistrict");
	}
	/*,dialog_add_group:function(){
		$.ajax({
			url: "apps/customer/view/form_add_group.php",
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append("<div id=\"group\"></div>");
				$("#group").html(html);
				$("#group").dialog({
					autoOpen : true,
					title : "Add Group",
					width : 640,
					height : 580,
					modal : true,
					buttons : [
						{text : "Cancel", click: function() { $("#group").dialog("destroy").remove(); }},
						{text : "Add", click: function() {
							$.post('apps/customer/xhr/action-add-group.php',$('#add_group').serialize(),function(response){
								window.location = "?app=group";
								 //$("span").html(response);
								//alert(serialize());
							});
						}}
								
					],close: function(){
						$("#group").dialog("destroy").remove();
					}
				});
				
			}
		});
	},remove_group: function(){
		var item_selected = [];
		$("input[name=chk_group]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/customer/xhr/action-remove-group.php',{items:item_selected},function(response){
				window.location = "?app=group";
			});
		}
		
	},dialog_edit_group: function(id){
		$.ajax({
			url: "apps/customer/view/form_edit_group.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append("<div id=\"dialog_edit_group\"></div>");
				$("#dialog_edit_group").html(html);
				$("#dialog_edit_group").dialog({
					autoOpen : true,
					title : "Edit Group",
					width : 640,
					height : 580,
					modal : true,
					buttons : [
						{text : "Cancel", click: function() { $("#dialog_edit_group").dialog("destroy").remove(); }},
						{text : "Edit", click: function() {
							$.post('apps/customer/xhr/action-edit-group.php',$('#edit_group').serialize(),function(response){
								window.location = "?app=group";
							});
						}}
								
					],close: function(){
						$("#dialog_edit_group").dialog("destroy").remove();
					}
				});
				
			}
		});
	},*/
	,initial : function(country,province,district,subsitrict){
			$(country).change(function(){
				fn.app.customer.load_city(province,$(country).val());
			});
			
			$(province).change(function(){
				fn.app.customer.load_district(district,$(this).val());
			});
			
			$(district).change(function(){
				fn.app.customer.load_subdistrict(subsitrict,$(this).val());
			});
	},
	load_country : function(combobox){
		$.ajax({
			url: "apps/administrator/store/store-country.php",
			type: "POST",dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).val(213);
				$(combobox).change();
			}
		});
	},
	load_city : function(combobox,country){
		$.ajax({
			url: "apps/administrator/store/store-city.php",
			type: "POST",
			data: {filter : "country = " + country},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).change();
			}
		});
	},
	load_district : function(combobox,city){
		$.ajax({
			url: "apps/administrator/store/store-district.php",
			type: "POST",
			data: {filter : "city = " + city},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
				$(combobox).change();
			}
		});
	},
	load_subdistrict : function(combobox,district){
		$.ajax({
			url: "apps/administrator/store/store-subdistrict.php",
			type: "POST",
			data: {filter : "district = " + district},
			dataType: "json",
			success: function(json){
				$(combobox).html("");
				for(i in json.aaData){
					$(combobox).append('<option value="' + json.aaData[i][0] + '">' + json.aaData[i][1] + '</option>');
				}
			}
		});
	}
};

$.extend(fn.app,{customer:customer});
