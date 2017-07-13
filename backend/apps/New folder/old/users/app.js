var user = {
	add_user:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/view/form_add_user.php",
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
			url: "apps/users/xhr/action-add-user.php",
			data: $("#add_userd").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	},
	edit_user:function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/view/form_edit_user.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_user:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/xhr/action-edit-user.php",
			data: $("#edit_userd").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	},
	remove_user:function(){
		var item_selected = [];
		$("input[name=chk_user]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/users/xhr/action-remove-user.php',{items:item_selected},function(response){
				window.location = "?app=AdminstratorUser";
			});
		}
	},
	
	
	
	
	
	add_group:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/view/form_add_group.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	save_group:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/xhr/action-add-group.php",
			data: $("#add_group").serialize(),
			success : function(json)
			{
				window.location = "?app=AdminstratorUser&tab=Group";
			}
		});
	},
	edit_group:function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/users/view/form_edit_group.php",
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
			url: "apps/users/xhr/action-edit-group.php",
			data: $("#edit_group").serialize(),
			success : function(json)
			{
				window.location = "?app=AdminstratorUser&tab=Group";
			}
		});
	},
	remove_group:function(){
		var item_selected = [];
		$("input[name=chk_group]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/users/xhr/action-remove-group.php',{items:item_selected},function(response){
				window.location = "?app=AdminstratorUser&tab=Group";
			});
		}
	}
};

$.extend(fn.app,{user:user});
