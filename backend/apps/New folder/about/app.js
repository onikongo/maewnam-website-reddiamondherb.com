var about = {
	save_desc:function(){
		$.ajax({
			url:"apps/about/xhr/action-save-description.php",
			type:"POST",
			dataType:"json",
			data:$("#aboutdesc").serialize(),
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
			url:"apps/about/xhr/action-save-image.php",
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
			url:"apps/about/xhr/action-unlinkPhoto.php",
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
			url:"apps/about/xhr/action-unlinkPhoto.php",
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
	activ:function(id,me){
		$.ajax({
			url:"apps/about/xhr/action-changeStatus.php",
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
				url:"apps/about/xhr/action-deleteabout.php",
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
	updateabout:function(){
		$.ajax({
			url:"apps/about/xhr/action-update-about.php",
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
			url:"apps/about/xhr/action-add-event.php",
			type:"POST",
			dataType:"json",
			data:$("#events").serialize(),
			success: function(result){
				if(result.success==true)
				{
					//fn.navigate('view');
					window.location = '?app=about';
				}
			}
		},"json");
	},
	editEvent:function(){
		$.ajax({
			url:"apps/about/xhr/action-update-event.php",
			type:"POST",
			dataType:"json",
			data:$("#eventedit").serialize(),
			success: function(result){
				if(result.success==true)
				{
					window.location = '?app=about';
				}
			}
		},"json");
	},
	dialog_deleteEvent:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/about/xhr/action-deleteEvent.php",
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
	},/*activEvent:function(id,me){
		$.ajax({
			url:"apps/gallery/xhr/action-changeEventStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		},"json");
	},
	
	
	
	
	
	
	
	unlinkMe_2:function(){
		$.ajax({
			url:"apps/gallery/xhr/action-unlinkPhoto.php",
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
	},*/
	
	
	
	/*images : {
		open_elfinder : function(name){
			window.open("apps/gallery/view/dialog_elfinder_product.php", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			var s='';
				s += '<div class="col-md-2">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s+= '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00;top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span>';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_photo").append(s);
			//$("#cover").css({display:"none"});
			
			
			//$("input[name="+name+"]").val(val);
			//$("#"+name).attr('src',val);
		},
		open_elfinder_photo_slide : function(name){
			window.open("apps/gallery/view/dialog_elfinder_photo_slide.php", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image_slide : function(val){
			var s='';
				s += '<div class="col-md-2">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s+= '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00;top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span>';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto_slide[]" value="'+val+'">';
			//s += '<input type="text" name="txtProduct[]" value="'+val+'">';
			s += '</div>';
			
			$("#photo_slide").append(s);
		}
	},
	dialog_save_photo:function(){
		$.ajax({
			type: "POST",
			dataType:"json",
			url: "apps/gallery/xhr/action-changeHeaderPhoto.php",
			data: $("#gallery").serialize(),
			success : function(json)
			{
				alert('Save');
			}
		})
	},	
	dialog_ads : {
		open_elfinder : function(){
			window.open("apps/gallery/view/dialog_elfinder_ads.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtads").val(val);
			$("#txtadvertisement").attr('src',val);
		}
	},*/
};

$.extend(fn.app,{about:about});
