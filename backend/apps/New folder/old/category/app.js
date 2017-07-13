var category = {
	images : {
		open_elfinder : function(name){
			window.open("apps/category/view/dialog_elfinder.php?name="+name, "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
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
		},
		open_elfinder_header : function(name){
			window.open("apps/category/view/dialog_elfinder_header.php?name="+name, "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image_header : function(name,val){
			var s='';
				s += '<div class="col-md-2">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s+= '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00;top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span>';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto2[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_photo2").append(s);
			$("#cover").css({display:"none"});
			
			
			//$("input[name="+name+"]").val(val);
			//$("#"+name).attr('src',val);
		},
		open_elfinder_slide : function(name){
			window.open("apps/category/view/dialog_elfinder_slide.php?name="+name, "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image_slide : function(name,val){
			var s='';
				s += '<div class="col-md-2">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s+= '<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color:#F00;top:50%;left:-5px;margin-top:-15px;margin-left:50%;position:absolute; font-size:24px; "></span>';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto_slide[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_slide").append(s);
			$("#cover").css({display:"none"});
			
			
			//$("input[name="+name+"]").val(val);
			//$("#"+name).attr('src',val);
		}
	},
	add : function(){
		$.post('apps/category/xhr/action-add-category.php',$('#add_category').serialize(),function(json){
			if(json.success){
				fn.navigate('view');
			}else{
				alert(json.msg)
				
			}
		},'json');
	},
	save : function(){
		$.post('apps/category/xhr/action-edit-category.php',$('#edit_category').serialize(),function(json){
			if(json.success){
				fn.navigate('view');
			}else{
				alert(json.msg)
				
			}
		},'json');
	},
	dialog_thumb : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_icon.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txticon").val(val);
			$("#txtIcon").attr('src',val);
		}
	},
	dialog_ads : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_ads.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtads").val(val);
			$("#txtadvertisement").attr('src',val);
		}
	},
	dialog_main : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_main.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
				
			$("#txtmain").val(val);
			$("#mpic").attr('src',val);
		}
	},
	dialog_sub : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_sub.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtsub").val(val);
			$("#psub").attr('src',val);
		}
	},
	dialog_mainads : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_dialog_mainads.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			$("#txtmainads").val(val);
			$("#mads").attr('src',val);
		}
	},
	dialog_photo : {
		open_elfinder : function(){
			window.open("apps/category/view/dialog_elfinder_photo.html", "_blank", "top=100, left=100,toolbar=no, resizable=no, width=800, height=600");
		},
		add_image : function(val){
			var s='';
			s += '<div class="col-md-12">';
				s += '<a href="#" class="thumbnail" onclick="$(this).parent().remove()">';
					s += '<img src="'+val+'" data-src="'+val+'" alt="...">';
				s += '</a>';
			s += '<input type="hidden" name="txtPhoto[]" value="'+val+'">';
			s += '</div>';
			
			$("#container_thumbnail_photo").append(s);
			$("#cover").css({display:"none"});
		}
	},
	dialog_add_category:function(){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/category/view/form_add_category.php",
			//data: $("#login_fm").serialize(),
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	dialog_save_category:function(){
		if(document.getElementById("tx_name").value== '')
		{
			alert("Please fill your name");
			document.getElementById("tx_name").focus();
			return false;
		}
		else if(document.getElementById("txticon").value== '')
		{
			alert("Please choose icon");
			document.getElementById("txticon").focus();
			return false;
		}
		else
		{
			
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/category/xhr/action-add-category.php",
					data: $("#add_category").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
			
		}
		
	},remove_category: function(){
		var item_selected = [];
		$("input[name=chk_category]:checked").each(function(){
			var chk = $(this);
			item_selected.push(chk.val());
		});
		if(confirm("Are you sure to remove the following:\n"+item_selected)){
			$.get('apps/category/xhr/action-remove-category.php',{items:item_selected},function(response){
				window.location = "?app=category";
			});
		}
		
	},dialog_edit_category: function(id){
		$.ajax({
			type: "POST",
			dataType:"html",
			url: "apps/category/view/form_edit_category.php",
			data: {id:id},
			success : function(json)
			{
				$("#addcustomer").html(json);
			}
		});
	},
	update_category:function(){
		if(document.getElementById("tx_name").value== '')
		{
			alert("Please fill your name");
			document.getElementById("tx_name").focus();
			return false;
		}
		else if(document.getElementById("txticon").value== '')
		{
			alert("Please choose icon");
			document.getElementById("txticon").focus();
			return false;
		}
		else
		{
				$.ajax({
					type: "POST",
					dataType:"html",
					url: "apps/category/xhr/action-edit-category.php",
					data: $("#edit_category").serialize(),
					success : function(json)
					{
						window.location.reload();
					}
				});
		}
	},
	append_subyoutube:function(){
			var s='';
				s+= '<div class="form-group">';
						s+= '<label for="txtDetail" class="col-sm-2 control-label">Playlist Name</label>';
						s+= '<div  class="col-sm-8">';
							//s+= 'Example : https://youtu.be/<font color="#FF0000">E6oF10izmFQ</font>';
							s+= '<input type="text" class="form-control" id="txtYoutube" name="txtYoutube[]" placeholder="Playlist Name"><br>';
						s+= '</div>';
						s+= '<div class="col-sm-2">';
							s+= '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove();"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>';
						s+= '</div>';
				s+= '</div>';
				
			$("#subvdo").append(s);
		
		
	}
	
};

$.extend(fn.app,{category:category});
