<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="../../../../libs/elFinder/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="../../../../libs/elFinder/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="../../../../libs/elFinder/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="../../../../libs/elFinder/js/i18n/elfinder.en.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			
			/*
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : 'php/connector.php'  // connector URL (REQUIRED)
					// lang: 'ru',             // language (OPTIONAL)
				}).elfinder('instance');
			});
			*/
		</script>
		<script type="text/javascript" charset="utf-8">
		    // Helper function to get parameters from the query string.
		    function getUrlParam(paramName) {
		    	var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
		    	var match = window.location.search.match(reParam) ;
		    	
		    	return (match && match.length > 1) ? match[1] : '' ;
		    }
		    
		    $().ready(function() {
		        var funcNum = getUrlParam('CKEditorFuncNum');
		
		        var elf = $('#elfinder').elfinder({
		            url : '../model/elfinder_category.php',
		            getFileCallback : function(file) {
		                window.opener.fn.app.category.images.add_image_header('<?php echo $_REQUEST['name'];?>',file);
		                window.close();
		            },
		            resizable: false
		        }).elfinder('instance');
		    });
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>