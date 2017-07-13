<div id="boxrate" class="col-md-12 text-center" style="font-size:36px;">
<form id="ratestar">
	<input type="hidden" name="txtID" value="<?php echo $_REQUEST['id'];?>">
	<span id="s1" class="glyphicon glyphicon-star star" aria-hidden="true"></span><input type="radio" id="c1" name="sta" value="1" style="display:none;">
    <span id="s2" class="glyphicon glyphicon-star star" aria-hidden="true"></span><input type="radio" id="c2" name="sta" value="2" style="display:none;">
    <span id="s3" class="glyphicon glyphicon-star star" aria-hidden="true"></span><input type="radio" id="c3" name="sta" value="3" style="display:none;">
    <span id="s4" class="glyphicon glyphicon-star star" aria-hidden="true"></span><input type="radio" id="c4" name="sta" value="4" style="display:none;">
    <span id="s5" class="glyphicon glyphicon-star star" aria-hidden="true"></span><input type="radio" id="c5" name="sta" value="5" style="display:none;">
 </form>   
</div>

<script>
$(document).ready(function(e) {
	
	
    $("#s1").mouseover(function(e) {
         $("#s1").css({'color':"#FFE500"});
		 $("#s2").css({'color':"#000000"});
		 $("#s3").css({'color':"#000000"});
		 $("#s4").css({'color':"#000000"});
		 $("#s5").css({'color':"#000000"});
		 $("#c1").prop('checked',true);
    });
	
	$("#s2").mouseover(function(e) {
         $("#s1").css({'color':"#FFE500"});
		 $("#s2").css({'color':"#FFE500"});
		 $("#s3").css({'color':"#000000"});
		 $("#s4").css({'color':"#000000"});
		 $("#s5").css({'color':"#000000"});
		 $("#c2").prop('checked',true);
    });
	
	$("#s3").mouseover(function(e) {
         $("#s1").css({'color':"#FFE500"});
		 $("#s2").css({'color':"#FFE500"});
		 $("#s3").css({'color':"#FFE500"});
		 $("#s4").css({'color':"#000000"});
		 $("#s5").css({'color':"#000000"});
		 $("#c3").prop('checked',true);
    });
	
	$("#s4").mouseover(function(e) {
         $("#s1").css({'color':"#FFE500"});
		 $("#s2").css({'color':"#FFE500"});
		 $("#s3").css({'color':"#FFE500"});
		 $("#s4").css({'color':"#FFE500"});
		 $("#s5").css({'color':"#000000"});
		 $("#c4").prop('checked',true);
    });
	
	$("#s5").mouseover(function(e) {
         $("#s1").css({'color':"#FFE500"});
		 $("#s2").css({'color':"#FFE500"});
		 $("#s3").css({'color':"#FFE500"});
		 $("#s4").css({'color':"#FFE500"});
		 $("#s5").css({'color':"#FFE500"});
		 $("#c5").prop('checked',true);
    });
});
</script>
<style>
.acstar
{
	color:#FFE500;
}
</style>