var product = {
	save_desc:function(){
		$.ajax({
			url:"apps/product/xhr/action-save-description.php",
			type:"POST",
			dataType:"json",
			data:$("#gallerydesc").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	save_procate:function(){
		$.ajax({
			url:"apps/product/xhr/action-save-product_category.php",
			type:"POST",
			dataType:"json",
			data:$("#product_cate").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	update_procate:function(){
		$.ajax({
			url:"apps/product/xhr/action-edit-product_category.php",
			type:"POST",
			dataType:"json",
			data:$("#product_cate_edit").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	saveImage:function(){
		$.ajax({
			url:"apps/product/xhr/action-save-image.php",
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
	},
	unlinkMe:function(){
		$.ajax({
			url:"apps/product/xhr/action-unlinkPhoto.php",
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
	activ:function(id,me){
		$.ajax({
			url:"apps/product/xhr/action-changeStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		});
	},
	activPro:function(id,me){
		$.ajax({
			url:"apps/product/xhr/action-changeStatus_product.php",
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
				url:"apps/product/xhr/action-delete_product_cate.php",
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
	dialog_delete_product:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/product/xhr/action-delete_product.php",
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
	updategallery:function(){
		$.ajax({
			url:"apps/product/xhr/action-update-gallery.php",
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
	save_product:function(){
		$.ajax({
			url:"apps/product/xhr/action-add-product.php",
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
	},
	update_product:function(){
		$.ajax({
			url:"apps/product/xhr/action-edit-product.php",
			type:"POST",
			dataType:"json",
			data:$("#editproduct").serialize(),
			success: function(result){
				if(result==true)
				{
					fn.navigate('view');
				}
			}
		},"json");
	},
	unlinkMe:function(){
		$.ajax({
			url:"apps/product/xhr/action-unlinkPhoto.php",
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

};

$.extend(fn.app,{product:product});
