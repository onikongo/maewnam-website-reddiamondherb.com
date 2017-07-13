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
	},
	dialog_save_customer:function(){
		if(document.getElementById("tx_pass").value!= document.getElementById("tx_repass").value)
		{
			alert("Password mismatch");
			document.getElementById("tx_repass").focus();
			return false;
		}
		else
		{
			if(document.getElementById("tx_pass").value<6)
			{
				alert("At least 6 word to secure your account");
				document.getElementById("tx_pass").focus();
				return false;
			}
			else
			{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/customer/xhr/action-add-customer.php",
					data: $("#add_customer").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
			}
		}
		
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
			type: "POST",
			dataType:"html",
			url: "apps/customer/view/form_edit_customer.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_customer:function(){
		if(document.getElementById("tx_pass").value!= document.getElementById("tx_repass").value)
		{
			alert("Password mismatch");
			document.getElementById("tx_repass").focus();
			return false;
		}
		else
		{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/customer/xhr/action-edit-customer.php",
					data: $("#edit_customer").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
		}
	}
	,dialog_add_group:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/customer/view/form_add_group.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	dialog_save_group:function(){
		if(document.getElementById("txtName").value=='' ||  document.getElementById("txtDetail").value=='')
		{
			alert("Please fill your data");
			document.getElementById("txtName").focus();
			return false;
		}
		else
		{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/customer/xhr/action-add-group.php",
					data: $("#add_group").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
		}
		
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
		
	}
	,edit_group: function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/customer/view/form_edit_group.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_group:function(){
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/customer/xhr/action-edit-group.php",
					data: $("#edit_group").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
	}
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
