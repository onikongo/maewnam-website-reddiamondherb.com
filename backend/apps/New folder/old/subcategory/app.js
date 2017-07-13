var subcategory = {
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
					url: "apps/subcategory/xhr/action-add-subcategory.php",
					data: $("#add_subcategory").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
			
		}
		
	},remove_subcategory: function(){
		var item_selected = [];
		$("input[name=chk_subcategory]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/subcategory/xhr/action-remove-subcategory.php',{items:item_selected},function(response){
				window.location = "?app=subcategory";
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
	}
	
};

$.extend(fn.app,{subcategory:subcategory});
