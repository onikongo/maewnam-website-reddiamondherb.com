var fn={
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
					window.location.reload();
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
						window.location.reload();
					}else{
						alert("Your login failed!");	
					}
				}
			});
			return false;
		}
	}
};
