var Reward = {
	add_reward:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/Reward/view/form_add_reward.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	save_reward:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/Reward/xhr/action-add-Reward.php",
			data: $("#add_reward").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	},
	edit_reward:function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/Reward/view/form_edit_reward.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_reward:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/Reward/xhr/action-edit-Reward.php",
			data: $("#edit_reward").serialize(),
			success : function(json)
			{
				window.location.reload();
			}
		});
	},
	approved:function(id){
		$.ajax({
			url: "apps/Reward/view/form_approved_reward.php",
			type: "POST",
			dataType: "html",
			data:{id:id},
			success: function(html){
			$("body").append("<div id=\"dialog_lookup\"></div>");
				$("#dialog_lookup").html(html);
				$("#dialog_lookup").dialog({
					autoOpen : true,
					title : "Approve",
					width : 400,
					height : 200,
					modal : true,
					buttons : [
						{text : "Approve", class: 'btn btn-primary pull-right', click: function() {
							$.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/Reward/xhr/action-approved.php",
								data: {id:id},
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
	},
	disapproved:function(id){
		$.ajax({
			url: "apps/Reward/view/form_approved_reward.php",
			type: "POST",
			dataType: "html",
			data:{id:id},
			success: function(html){
			$("body").append("<div id=\"dialog_lookup\"></div>");
				$("#dialog_lookup").html('Do You Want to Disapprove');
				$("#dialog_lookup").dialog({
					autoOpen : true,
					title : "Approve",
					width : 400,
					height : 200,
					modal : true,
					buttons : [
						{text : "Disapprove", class: 'btn btn-primary pull-right', click: function() {
							$.ajax({
								type: "POST",
								dataType:"html",
								url: "apps/Reward/xhr/action-approved.php",
								data: {id:id,dis:'not'},
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
	},
	remove_reward:function(){
		var item_selected = [];
		$("input[name=chk_customer]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/Reward/xhr/action-remove-reward.php',{items:item_selected},function(response){
				window.location = "?app=Reward";
			});
		}
	},
	images : {
		open_elfinder : function(name){
			window.open("apps/Reward/view/dialog_elfinder_photo.php?name="+name, "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(name,val){
			var s='';
				s += '<div class="col-md-2">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s+= '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00;top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span>';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_photo").append(s);
			$("#cover").css({display:"none"});
			//$("input[name="+name+"]").val(val);
			//$("#"+name).attr('src',val);
		}
	},
};

$.extend(fn.app,{Reward:Reward});
