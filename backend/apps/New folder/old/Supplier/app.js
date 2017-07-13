var Supplier = {
	add_branch:function(){
		$.ajax({
			type: "POST",
			dataType:"json",
			url: "apps/Supplier/xhr/action-add-branch.php",
			data: $("#add_branch").serialize(),
			success : function(json)
			{
				window.location = "?app=Supplier&tab=Branch";
			}
		});
	},
	edit_branch:function(id){
		$.ajax({
			url: "apps/Supplier/view/form_edit_branch.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append("<div id=\"dialog_edit_category\"></div>");
				$("#dialog_edit_category").html(html);
				$("#dialog_edit_category").dialog({
					autoOpen : true,
					title : "Edit Category",
					width : 840,
					height : 680,
					modal : true,
					buttons : [
						{text : "Cancel", click: function() { $("#dialog_edit_category").dialog("destroy").remove(); }},
						{text : "Edit", click: function() {
							$.post('apps/Supplier/xhr/action-edit-branch.php',$('#edit_branch').serialize(),function(response){
								window.location = "?app=Supplier&tab=Branch";
							});
						}}
								
					],close: function(){
						$("#dialog_edit_category").dialog("destroy").remove();
					}
				});
				
			}
		});
	},
	remove_branch: function(){
		var item_selected = [];
		$("input[name=chk_branch]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/Supplier/xhr/action-remove-branch.php',{items:item_selected},function(response){
				window.location = "?app=Supplier&tab=Branch";
			});
		}
		
	},
	// supplier
	
	add_supp:function(){
		$.ajax({
			type: "POST",
			dataType:"json",
			url: "apps/Supplier/xhr/action-add-supp.php",
			data: $("#add_supplier").serialize(),
			success : function(json)
			{
				window.location = "?app=Supplier&tab=Supplier";
			}
		});
	},
	edit_supp:function(id){
		$.ajax({
			url: "apps/Supplier/view/form_edit_supp.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append("<div id=\"dialog_edit_category\"></div>");
				$("#dialog_edit_category").html(html);
				$("#dialog_edit_category").dialog({
					autoOpen : true,
					title : "Edit Supplier",
					width : 840,
					height : 580,
					modal : true,
					buttons : [
						{text : "Cancel", click: function() { $("#dialog_edit_category").dialog("destroy").remove(); }},
						{text : "Edit", click: function() {
							$.post('apps/Supplier/xhr/action-edit-supp.php',$('#edit_supp').serialize(),function(response){
								window.location = "?app=Supplier&tab=Supplier";
							});
						}}
								
					],close: function(){
						$("#dialog_edit_category").dialog("destroy").remove();
					}
				});
				
			}
		});
	},
	remove_sup: function(){
		var item_selected = [];
		$("input[name=chk_branch]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/Supplier/xhr/action-remove-supp.php',{items:item_selected},function(response){
				window.location = "?app=Supplier&tab=Supplier";
			});
		}
		
	},
	
	initial : function(country,province,district,subsitrict){
			$(country).change(function(){
				fn.app.Supplier.load_city(province,$(country).val());
			});
			
			$(province).change(function(){
				fn.app.Supplier.load_district(district,$(this).val());
			});
			
			$(district).change(function(){
				fn.app.Supplier.load_subdistrict(subsitrict,$(this).val());
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
	},
};

$.extend(fn.app,{Supplier:Supplier});
