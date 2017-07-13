function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var fn={
	dialog : {
		caution : function(errorMessage){
			var dlg = $("#modelDialog");
			var html = '';
			html += 'พบข้อผิดพลาดในการบันทึก โปรดตรวจสอบข้อมูลดังต่อไปนี้';
			html += '<div class="alert alert-danger" role="alert">';
			html += '<h4>คำแนะนำ</h4>';
			html += '<ul>'+errorMessage+'</ul>';
			html += '</div>';
			dlg.find(".modal-title").html("การบันทึกไม่สมบูรณ์");
			dlg.find(".modal-body").html(html);
									
			$("#btnCloseDialog").click(function(){
				dlg.modal("hide");
			});
			dlg.modal("show");
					
		},success : function(successMessage,func){
			var dlg = $("#modelDialog");
			
			var html = '';
			html += successMessage;
			dlg.find(".modal-title").html("เรียบร้อย");
			dlg.find(".modal-body").html(html);
									
			$("#btnCloseDialog").click(function(){
				if(typeof func != "undefined"){
					func();
				}
			});
			dlg.modal("show");
		}
	},
	validation : {
		numberonly : function(textbox){
			$(textbox).keydown(function (e) {
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				(e.keyCode == 65 && e.ctrlKey === true) ||
				(e.keyCode == 67 && e.ctrlKey === true) ||
				(e.keyCode == 88 && e.ctrlKey === true) ||
				(e.keyCode >= 35 && e.keyCode <= 39)) {
					return;
				}
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
		}
	},
	navigate : function(view,extend){
		var app = getParameterByName("app");
		var previous = getParameterByName("view");
		var link = "?app=" + app + "&view=" + view + "&previous=" + previous;
		if(typeof extend != "undefined"){
			for(i in extend){
				link += "&" + i + "=" + extend[i];
			}
		}
		window.location = link;
		
	},
	navigateEdit : function(view,extend){
		var app = getParameterByName("app");
		var previous = getParameterByName("view");
		var link = "?app=" + app + "&view=" + view + "&previous=" + previous;
		
		window.location = link+= "&id=" + extend;
		
	},
	app : {},
	iface : {},
	engine : {
		click_button_set : function(btn,item,value){
			var value = "item[]";
			
		},
		logout : function(){
			$.ajax({
				url: "libs/xhr/logout.php",
				type: "POST",
				dataType: "html",
				success: function(html){
					window.location = '/backend';
				}
			});
		},
		login : function(){
			$.ajax({
				url: "libs/xhr/login.php",
				type: "POST",
				data: {
					username : $("#txtUsernameLoginFirstPage").val(),
					password : $("#txtPasswordLoginFirstPage").val()
				},
				dataType: "json",
				success: function(json){
					if(json){
						//window.location.reload();
						window.location = '/backend/?app=review';
					}else{
						alert("Your login failed!");	
					}
				}
			});
			return false;
		}
	}
};
