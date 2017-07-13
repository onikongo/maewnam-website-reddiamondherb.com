var slidePhoto = {
	activ:function(id,me){
		$.ajax({
			url:"apps/slide_photo/xhr/action-changeStatus.php",
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(result){
			}
		});
	},
	saveslide:function(){
		$.ajax({
			url:"apps/slide_photo/xhr/action-save-slide.php",
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
	updateslide:function(){
		$.ajax({
			url:"apps/slide_photo/xhr/action-update-slide.php",
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
	dialog_delete:function(id,me){
		$(".bgclose").fadeIn(200);
		$(".closes").fadeIn(200);
		$("#yes").click(function(e) {
			$.ajax({
				url:"apps/slide_photo/xhr/action-deleteslide.php",
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
			url:"apps/slide_photo/xhr/action-unlinkPhoto.php",
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
	
	
	
	
	images : {
		open_elfinder : function(name){
			window.open("apps/slide_photo/view/dialog_elfinder_product.php", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
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
			window.open("apps/slide_photo/view/dialog_elfinder_photo_slide.php", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
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
			url: "apps/slide_photo/xhr/action-changeHeaderPhoto.php",
			data: $("#slidePhoto").serialize(),
			success : function(json)
			{
				alert('Save');
			}
		})
	},	
	dialog_ads : {
		open_elfinder : function(){
			window.open("apps/slide_photo/view/dialog_elfinder_ads.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtads").val(val);
			$("#txtadvertisement").attr('src',val);
		}
	},
};

$.extend(fn.app,{slidePhoto:slidePhoto});
