var password = {
	newpass:function(){
		if(document.getElementById("tx_old").value=='')
		{
			alert("กรุณากรอกรหัสผ่านเดิม");
			document.getElementById("tx_old").focus();
			return false;
		}
		else if(document.getElementById("tx_new").value=='')
		{
			alert("กรุณากรอกรหัสผ่านใหม่");
			document.getElementById("tx_new").focus();
			return false;
		}
		else if(document.getElementById("tx_conf").value=='')
		{
			alert("กรุณากรอกรหัสผ่านใหม่อีกครั้ง");
			document.getElementById("tx_conf").focus();
			return false;
		}
		else if(document.getElementById("tx_new").value!= document.getElementById("tx_conf").value)
		{
			alert("รหัสผ่านไม่ตรงกัน");
			document.getElementById("tx_conf").focus();
			return false;
		}
		else
		{
			$.ajax({
				url:"apps/password/xhr/action-new-password.php",
				type:"POST",
				dataType:"json",
				data:$("#myFromdetail").serialize(),
				success: function(result){
					if(result==true)
					{
						alert("สำเร็จ");
						window.location.reload();
					}
					else
					{
						alert("รหัสผ่านไม่ตรงกัน");
						document.getElementById("tx_old").focus();
						return false;
					}
				}
			},"json");
		}
	}
};

$.extend(fn.app,{password:password});
