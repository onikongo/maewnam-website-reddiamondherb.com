var sector = {
	savesector:function(){
		if($("#tx_Title").val()=='')
		{
			alert("ชื่อ");
			$("#tx_Title").focus();
			return false;
		}
		else if($("#tx_Titleth").val()=='')
		{
			alert("ชื่อ");
			$("#tx_Titleth").focus();
			return false;
		}else{
			$.ajax({
				url:"apps/sector/xhr/action-save-sector.php",
				type:"POST",
				dataType:"json",
				data:$("#myFromdetail").serialize(),
				success: function(result){
					if(result==true)
					{
						fn.navigate('view');
					}
				}
			},"json");
		}
	},
	updatesector:function(){
		$.ajax({
			url:"apps/sector/xhr/action-update-sector.php",
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
	activ:function(id,me){
		$.ajax({
			url:"apps/sector/xhr/action-changeStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		});
	},
	dialog_delete:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/sector/xhr/action-delete-sector.php",
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
};

$.extend(fn.app,{sector:sector});
