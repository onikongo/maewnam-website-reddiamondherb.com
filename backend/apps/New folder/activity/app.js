var activity = {
	activ:function(id,me){
		$.ajax({
			url:"apps/activity/xhr/action-changeStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		});
	},
	activEvent:function(id,me){
		$.ajax({
			url:"apps/activity/xhr/action-changeEventStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		},"json");
	},
	save_datas:function(){
		$.ajax({
			url:"apps/activity/xhr/action-save-detail.php",
			type:"POST",
			dataType:"json",
			data:$("#activitytitle").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	updateactivity:function(){
		$.ajax({
			url:"apps/activity/xhr/action-update-activity.php",
			type:"POST",
			dataType:"json",
			data:$("#myFromdetailEdit").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	addEvent:function(){
		$.ajax({
			url:"apps/activity/xhr/action-add-event.php",
			type:"POST",
			dataType:"json",
			data:$("#events").serialize(),
			success: function(result){
				if(result.success==true)
				{
					//fn.navigate('view');
					fn.navigateEdit('Event',result.id);
				}
			}
		},"json");
	},
	editEvent:function(){
		$.ajax({
			url:"apps/activity/xhr/action-update-event.php",
			type:"POST",
			dataType:"json",
			data:$("#eventedit").serialize(),
			success: function(result){
				if(result.success==true)
				{
					fn.navigateEdit('Event',result.id);
				}
			}
		},"json");
	},
	dialog_deleteEvent:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/activity/xhr/action-deleteEvent.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					window.location.reload();
				}
			});
		});
		$("#no").click(function(e) {
			$(".bgclose").fadeOut(200);
			$(".closes").fadeOut(200);
		});
	},
	dialog_delete:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/activity/xhr/action-deleteactivity.php",
				type:"POST",
				dataType:"json",
				data:{id:id},
				success: function(result){
					window.location.reload();
				}
			});
		});
		$("#no").click(function(e) {
			$(".bgclose").fadeOut(200);
			$(".closes").fadeOut(200);
		});
	},
	unlinkMe:function(){
		$.ajax({
			url:"apps/activity/xhr/action-unlinkPhoto.php",
			type:"POST",
			dataType:"json",
			data:{id:$("#parth").val()},
			success: function(result){
				if(result==true)
				{
					$("#thumbnail").hide();
					$("#unlik").hide();
					$("#parth").val('');
				}
				else
				{
				}
			}
		});
	},
	unlinkMe_2:function(){
		$.ajax({
			url:"apps/activity/xhr/action-unlinkPhoto.php",
			type:"POST",
			dataType:"json",
			data:{id:$("#parth_2").val()},
			success: function(result){
				if(result==true)
				{
					$("#thumbnail_2").hide();
					$("#unlik_2").hide();
					$("#parth_2").val('');
				}
				else
				{
				}
			}
		});
	},
	
};

$.extend(fn.app,{activity:activity});
