
$(function(){
 if($.browser.msie && $.browser.version<7)
  $('#top').before(
   '<div id="ie6detect">'+
   'It has been detected that you are using Internet Explorer 6 or lower.<br />Unfortunately this is an unsupported '+
   'browser and you won\'t be able to view this website properly.<br />We recommend upgrading to a newer version of '+
   'Internet Explorer or FireFox.'+
   '</div>'
  );
});
