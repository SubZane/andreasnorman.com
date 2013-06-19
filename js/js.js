$(document).ready(function() {
  $(".postcontent").fitVids();
  $("img.lazy").show().lazyload({effect: "fadeIn"});

$('#twitter').sharrre({
  share: {
    twitter: true
  },
  enableHover: false,
  enableTracking: true,
  buttons: { twitter: {
    via: 'andreasnorman',
    url: shortenurl(document.location.href)
  }},
  click: function(api, options){
    api.simulateClick();
    api.openPopup('twitter');
  }
});
$('#facebook').sharrre({
  share: {
    facebook: true
  },
  enableHover: false,
  enableTracking: true,
  buttons: { facebook: {
    action: 'like',
    url: shortenurl(document.location.href)
  }},
  click: function(api, options){
    api.simulateClick();
    api.openPopup('facebook');
  }
});
$('#googleplus').sharrre({
  share: {
    googlePlus: true
  },
  urlCurl: 'http://www.andreasnorman.com/sharrre.php',
  enableHover: false,
  enableTracking: true,
  buttons: { googlePlus: {
    url: shortenurl(document.location.href)
  }},
  click: function(api, options){
    api.simulateClick();
    api.openPopup('googlePlus');
  }
});

function shortenurl(url) {
	var xmlHttp = null;
	var fullurl = "http://www.andreasnorman.com/bitly.shorten.php?url=" + url;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", fullurl, false );
      xmlHttp.send( null );
      return xmlHttp.responseText;
}
});