var adminstrator = {
	add_user:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/adminstrator/view/form_add_user.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	save_user:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/adminstrator/xhr/action-add-user.php",
			data: $("#add_userd").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	}
};

$.extend(fn.app,{adminstrator:adminstrator});
