<?php
	
	$tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:"basic";
	$aTime = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");
	$aWeek = array("Sunday","Monday","Tuesday","Wendsday","Thursday","Friday","Saturday");
	//include_once "../../../../config/define.php";
	//include_once "../../../../libs/class/db.php";
	$dbc = new dbc;
	$dbc->Connect();
	$id = $_REQUEST['id'];
?>
<script>
$(document).ready(function(e) {
    $( 'textarea.editor' ).ckeditor();
});
</script>

<div class="col-md-12 breadcrumb"><font size="2"><a href="?app=homepage">Slide photo</a> / edit</font></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    	<div class="col-md-12" style="padding:10px;">
        	<form class="form form-horizontal" id="events">
            <input type="hidden" name="txtID" value="<?php echo $id;?>">
            <input type="hidden" id="parth" name="parth" >
            <input type="hidden" id="parth_2" name="parth_2" >
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title (EN)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtTitleEv" name="txtTitleEv" placeholder="Deal Title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title (TH)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtTitleEvth" name="txtTitleEvth" placeholder="Deal Title">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Description (EN)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtSubEv" name="txtSubEv" placeholder="Deal Title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Description (TH)</label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" id="txtSubEvth" name="txtSubEvth" placeholder="Deal Title">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description (EN)</label>
                    <div class="col-sm-8">
                        <textarea type="text"  class="form-control editor" id="txtDesEv" name="txtDesEv" placeholder="Deal Title"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description (TH)</label>
                    <div class="col-sm-8">
                        <textarea type="text"  class="form-control editor" id="txtDesEvth" name="txtDesEvth" placeholder="Deal Title"></textarea>
                    </div>
                </div> 
                
            </form>
            
            
            	<!--/////////////////300x310/////////////////-->
                <form class="form form-horizontal" id="myFrom" method="post" action="apps/blogs/xhr/action-up-photo.php"  role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        
                        <div id="upload" class="btn btn-danger">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;&nbsp;Browse Image
                        </div>
                        <input id="file_upload" style="display:none" name="upfile" type="file" >
                        <br>
                        <img class="loads" src="../../../../upload/icon/load.gif" style="display:none;">
                        <div id="thumbnails" style="margin-top:10px; ">
                        
                        </div>
                        <div id="thumbnail" style="margin-top:10px; display:none;">
                        
                        </div>
                        
                        
                        <button class="btn btn-primary pull-right" id="multi-post" style="display:none;">up</button>
                    </div>
                    <button type="button" id="unlik"  class="btn btn-danger"   onclick="fn.app.blogs.unlinkMe()" style="display:none;">Delete</button>
                </div>    
               </form>
               <!--/////////////////300x310/////////////////-->
               
               <!--/////////////////613x311/////////////////-->
                <form class="form form-horizontal" id="myFrom_2" method="post" action="apps/blogs/xhr/action-up-photo_2.php"  role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        
                        <div id="upload_2" class="btn btn-danger">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;&nbsp;Browse Image
                        </div>
                        <input id="file_upload_2" style="display:none" name="upfile_2" type="file" >
                        <br>
                        <img class="loads_2" src="../../../../upload/icon/load.gif" style="display:none;">
                        <div id="thumbnails_2" style="margin-top:10px; ">
                        
                        </div>
                        <div id="thumbnail_2" style="margin-top:10px; display:none;">
                        
                        </div>
                        
                        
                        <button class="btn btn-primary pull-right" id="multi-post_2" style="display:none;">up</button>
                    </div>
                    <button type="button" id="unlik_2"  class="btn btn-danger"   onclick="fn.app.blogs.unlinkMe_2()" style="display:none;">Delete</button>
                </div>    
               </form>
               <!--/////////////////613x311/////////////////-->
               
               
                <!--<div id="multi-msg"></div> -->
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary pull-right" id="multi-posts" onClick="fn.app.blogs.addEvent()">Save</button><!--type="submit"onclick="fn.app.product.add()"-->
                        <button type="button"  class="btn btn-default pull-right"   onclick="fn.navigate('view')">Cancel</button>
                        
                    </div>
                </div>
                <div id="output"></div>         
             
       </div>
  </div>
</div>




<script>
$(document).ready(function(e) {
	 $("#upload").on("click",function(e){
        $("#file_upload").show().click().hide();
        e.preventDefault();
    });
	$("#file_upload").on("change",function(e){

        var files = this.files
        showThumbnail(files)  
		$("#multi-post").click();  
		$(".loads").show();    
		
    });
	function showThumbnail(files){

        $("#thumbnail").html("");
        for(var i=0;i<files.length;i++){
            var file = files[i]
            var imageType = /image.*/
            if(!file.type.match(imageType)){
                //     console.log("Not an Image");
                continue;
            }

            var image = document.createElement("img");
            var thumbnail = document.getElementById("thumbnail");
            image.file = file;
            thumbnail.appendChild(image)

            var reader = new FileReader()
            reader.onload = (function(aImg){
                return function(e){
                    aImg.src = e.target.result;
                };
            }(image))

            var ret = reader.readAsDataURL(file);
            var canvas = document.createElement("canvas");
            ctx = canvas.getContext("2d");
            image.onload= function(){
                ctx.drawImage(image,50,50)
            }
        } // end for loop

    } // end showThumbnail
	
   
    function getDoc(frame) {
     var doc = null;
     
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }

     if (doc) { // successful getting content
         return doc;
     }

     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }

	$("#myFrom").submit(function(e)
	{
			$("#multi-msg").html("<img src='loading.gif'/>");
	
		var formObj = $(this);
		var formURL = formObj.attr("action");
	
	if(window.FormData !== undefined)  // for HTML5 browsers
	//	if(false)
		{
	
			var formData = new FormData(this);
			$.ajax({
				url: formURL,
				type: 'POST',
				data:  formData,
				mimeType:"multipart/form-data",
				contentType: false,
				cache: false,
				processData:false,
				success: function(data, textStatus, jqXHR)
				{
						//$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
						$("#parth").val(data);
						$(".loads").hide(0);
						$("#thumbnail").fadeIn(100);$("#thumbnails").hide();
						$("#unlik").show();
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					$("#multi-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
				} 	        
		   });
			e.preventDefault();
			//e.unbind();
					
			
	   }
	   else  //for olden browsers
		{
			//generate a random id
			var  iframeId = 'unique' + (new Date().getTime());
	
			//create an empty iframe
			var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
	
			//hide it
			iframe.hide();
	
			//set form target to iframe
			formObj.attr('target',iframeId);
	
			//Add iframe to body
			iframe.appendTo('body');
			iframe.load(function(e)
			{
				var doc = getDoc(iframe[0]);
				var docRoot = doc.body ? doc.body : doc.documentElement;
				var data = docRoot.innerHTML;
				//$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
				
			});
		
		}
	
	});
	
	$("#multi-post").click(function()
	{
			$("#myFrom").submit(function(e){ 
				console.log(e);
            });
	});
	
	
	
	
	
	//-----------_2
	
	$("#upload_2").on("click",function(e){
        $("#file_upload_2").show().click().hide();
        e.preventDefault();
    });
	$("#file_upload_2").on("change",function(e){
        var files = this.files
        showThumbnail_2(files)  
		$("#multi-post_2").click();  
		$(".loads_2").show();    
		
    });
	function showThumbnail_2(files){

        $("#thumbnail_2").html("");
        for(var i=0;i<files.length;i++){
            var file = files[i]
            var imageType = /image.*/
            if(!file.type.match(imageType)){
                //     console.log("Not an Image");
                continue;
            }

            var image = document.createElement("img");
            var thumbnail = document.getElementById("thumbnail_2");
            image.file = file;
            thumbnail.appendChild(image)

            var reader = new FileReader()
            reader.onload = (function(aImg){
                return function(e){
                    aImg.src = e.target.result;
                };
            }(image))

            var ret = reader.readAsDataURL(file);
            var canvas = document.createElement("canvas");
            ctx = canvas.getContext("2d");
            image.onload= function(){
                ctx.drawImage(image,50,50)
            }
        } // end for loop

    } // end showThumbnail
	
   
    function getDoc(frame) {
     var doc = null;
     
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }

     if (doc) { // successful getting content
         return doc;
     }

     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }

	$("#myFrom_2").submit(function(e)
	{
			$("#multi-msg_2").html("<img src='loading.gif'/>");
	
		var formObj = $(this);
		var formURL = formObj.attr("action");
	
	if(window.FormData !== undefined)  // for HTML5 browsers
	//	if(false)
		{
	
			var formData = new FormData(this);
			$.ajax({
				url: formURL,
				type: 'POST',
				data:  formData,
				mimeType:"multipart/form-data",
				contentType: false,
				cache: false,
				processData:false,
				success: function(data, textStatus, jqXHR)
				{
						//$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
						$("#parth_2").val(data);
						$(".loads_2").hide(0);
						$("#thumbnail_2").fadeIn(100);$("#thumbnails_2").hide();
						$("#unlik_2").show();
				},
				error: function(jqXHR, textStatus, errorThrown) 
				{
					$("#multi-msg_2").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
				} 	        
		   });
			e.preventDefault();
			//e.unbind();
					
			
	   }
	   else  //for olden browsers
		{
			//generate a random id
			var  iframeId = 'unique' + (new Date().getTime());
	
			//create an empty iframe
			var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
	
			//hide it
			iframe.hide();
	
			//set form target to iframe
			formObj.attr('target',iframeId);
	
			//Add iframe to body
			iframe.appendTo('body');
			iframe.load(function(e)
			{
				var doc = getDoc(iframe[0]);
				var docRoot = doc.body ? doc.body : doc.documentElement;
				var data = docRoot.innerHTML;
				//$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
				
			});
		
		}
	
	});
	
	$("#multi-post_2").click(function()
	{
			$("#myFrom_2").submit(function(e){ 
				console.log(e);
            });
	});
	
	/*if(document.getElementById("txtTitle").value=='')
		{
			alert("กรุณากรอกข้อมูลด้วย");
			document.getElementById("txtTitle").focus();
			return false;
		}
		else if(document.getElementById("txtTitleth").value=='')
		{
			alert("กรุณากรอกข้อมูลด้วย");
			document.getElementById("txtTitleth").focus();
			return false;
		}
		else
		{fn.navigate('view');
			}	*/

});
</script>
