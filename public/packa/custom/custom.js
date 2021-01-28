var __listData = {};

function feedToken(){
	return $("meta[name='csrf-token']").attr('content');
}

//Get the url of the current page, from the meta tags from <head> section
function feedCurrentUrl(urlPath='') {
  var current_url = $('meta[name="current_url"]').attr('content'); //{{url('/')}}
  if(urlPath) {
    current_url = current_url+urlPath;
  }
  return current_url;
}


//Get the url of the current page, from the meta tags from <head> section
function feedBaseUrl(urlPath='') {
  var base_url = $('meta[name="base_url"]').attr('content'); //{{url('/')}}
  if(urlPath) {
    base_url = base_url+urlPath;
  }
  return base_url;
}

$(function(){


        $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': feedToken()
       }
    });
});

// Initialize tooltip
function callTooltip() {
  $('[data-toggle="tooltip"]').tooltip(); 
}

