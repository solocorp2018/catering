var pageBaseUrl;

function setPageUrl(url) {
  pageBaseUrl = feedBaseUrl(url);
}
$(document).on('click','.sort',function(){
  var sortColumn = $.trim($(this).attr('data-column'));
  var sortType = $.trim($("#sorttype").val());  
  sortType = (sortType == '' || sortType == 'asc')?'desc':'asc';  
  $("#sortfield").val(sortColumn);
  $("#sorttype").val(sortType);
  searchFun();
});

$(document).on('keyup','#keyword',function(e){
  if (e.key === 'Enter' || e.keyCode === 13) {
      searchFun();
  }
});


$(document).on('change','#pageLength',function(){
  searchFun();
});

function searchFun() {
  
  var url = pageBaseUrl;

  var queryParams = {};
  queryParams['pageLength'] = $("#pageLength").val();
  queryParams['keyword'] = $("#keyword").val();
  queryParams['sortfield'] = $("#sortfield").val();
  queryParams['sorttype'] = $("#sorttype").val();

  if(queryParams) {
      $.each(queryParams,function(key,value){
          url+='&'+key+'='+$.trim(value);
      });
  }
  
  $("#searchField").attr('href',url);
  $("#searchField")[0].click();
}
