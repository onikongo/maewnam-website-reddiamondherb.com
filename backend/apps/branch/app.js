var branch = {
	savebranch:function(){
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
				url:"apps/branch/xhr/action-save-branch.php",
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
	updatebranch:function(){
		$.ajax({
			url:"apps/branch/xhr/action-update-branch.php",
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
			url:"apps/branch/xhr/action-changeStatus.php",
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
				url:"apps/branch/xhr/action-delete-branch.php",
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

$.extend(fn.app,{branch:branch});
