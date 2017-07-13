var marketing = {
	dialog_thumb : {
		open_elfinder : function(){
			window.open("apps/marketing/view/dialog_elfinder_icon.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txticon").val(val);
			$("#icon").attr('src',val);
		}
	},
	dialog_add_marketing:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/marketing/view/form_add_marketing.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addmarketing").html(json);
			}
		});
	},
	dialog_save_marketing:function(){
		if(document.getElementById("txticon").value=='')
		{
			alert("Please fill Photo");
			document.getElementById("txticon").focus();
			return false;
		}
		else if(document.getElementById("tx_Headlind").value=='')
		{
			alert("Please fill Headline");
			document.getElementById("tx_Headlind").focus();
			return false;
		}
		else if(document.getElementById("txtDetail").value=='')
		{
			alert("Please fill Detail");
			document.getElementById("txtDetail").focus();
			return false;
		}
		else if(document.getElementById("tx_exp").value=='')
		{
			alert("Please fill Expiration date");
			document.getElementById("tx_exp").focus();
			return false;
		}
		else
		{
			$.ajax({
				type: "POST",
				dataType:"html",
				url: "apps/marketing/xhr/action-add-marketing.php",
				data: $("#add_marketing").serialize(),
				success : function(json)
				{
					window.location.reload();
				}
			});
		}
		
	},remove_marketing: function(){
		var item_selected = [];
		$("input[name=chk_marketing]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/marketing/xhr/action-remove-marketing.php',{items:item_selected},function(response){
				window.location = "?app=marketing";
			});
		}
		
	},dialog_edit_marketing: function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/marketing/view/form_edit_marketing.php",
			data: {id:id},
			success : function(json)
			{
				$("#addmarketing").html(json);
			}
		});
	},
	update_marketing:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/marketing/xhr/action-edit-marketing.php",
			data: $("#edit_marketing").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	}
};

$.extend(fn.app,{marketing:marketing});
