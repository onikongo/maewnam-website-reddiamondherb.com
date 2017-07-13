/*!
 * JQuery Maewnam Grid v1.0
 * http://www.maewnam.com
 * 
 * Copyright 2011, Todsaporn Satiraphan
 * 
 * Requirement : Jquery-1.7.2.js
 * Released under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 */
(function( window, undefined ) {

var methods = {
	init : function( option ) {
		var element = $( this );
		var options = {
			type : "table",
			pages : [10,20,30,50,100],
			page_selected : 30,
			page_index : 1,
			url: "ajax/xhr.php"
		};
		$.extend(options,option);
		
		element.addClass('table');
		
		
		
		
	},append : function(data){
		
	},destroy : function( ) {
			
	},reposition : function( ) {
			
	},show : function( ) {
			
	},hide : function( ) {
			
	},update : function( content ) {
		
	}
};
	
$.fn.mntable = function( method ) {
	if ( methods[method] ) {
		return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
		return methods.init.apply( this, arguments );
	} else {
		$.error( 'Method ' +  method + ' does not exist on jQuery.control' );
	}
};

})( window );
