/*
Template Name: Material Pro admin
Author: Wrappixel
Email: niravjoshi87@gmail.com
File: js
*/

 

$(function() {
    "use strict";

    $('.__success').click(function(){
    	
    	var message = ($(this).attr('data-toast'))?$(this).attr('data-toast'):'Request Successfull !';
    	success(message);
    });
    $('.__error').click(function(){
    	var message = ($(this).attr('data-toast'))?$(this).attr('data-toast'):'Something went wrong !';
    	error(message);
    });
    $('.__info').click(function(){
    	var message = ($(this).attr('data-toast'))?$(this).attr('data-toast'):'Empty information !';
    	info(message);
    });
    $('.__warning').click(function(){
    	var message = ($(this).attr('data-toast'))?$(this).attr('data-toast'):'Process interupted !';
    	warning(message);
    });

});
          

function success(message = '',heading='Success') {
	
		$.toast({
            heading:heading,
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3000, 
            stack: 2
        });
}

function error(message = '',heading='Oops!') {
	
		$.toast({
            heading:heading,
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3000, 
            stack: 2
        });
}

function info(message = '',heading='Information') {
	
		$.toast({
            heading:heading,
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3000, 
            stack: 2
        });
}


function warning(message = '', heading='Warning !') {
	
		$.toast({	
            heading:heading,
            text: message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'warning',
            hideAfter: 3000, 
            stack: 2
        });
}
