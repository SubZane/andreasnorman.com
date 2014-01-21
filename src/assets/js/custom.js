$(document).ready(function($) {
  var iw = $('body').innerWidth();

    $('.post-content figure a').fluidbox();
  if (iw >= 768) {
  };
  
  $('body').flowtype({
   minimum   : 320,
   maximum   : 790,
   minFont   : 18,
   maxFont   : 50,
   fontRatio : 40,
   lineRatio : 1.7
  });

  $(".postcontent").fitVids();

	$('.image-wraper img').on('click', function(e) {
		e.preventDefault();
	});	
/*
  $('#twitter').sharrre({
    share: {
      twitter: true
    },
    template: '<i class="fa fa-twitter-square"></i>',
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
      twitter: true
    },
    template: '<i class="fa fa-facebook-square"></i>',
    enableHover: false,
    enableTracking: true,
    buttons: { facebook: {
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
    template: '<i class="fa fa-googleplus-square"></i>',
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

  $('#linkedin').sharrre({
    share: {
      twitter: true
    },
    template: '<i class="fa fa-linkedin-square"></i>',
    enableHover: false,
    enableTracking: true,
    buttons: { linkedin: {
      url: shortenurl(document.location.href)
    }},
    click: function(api, options){
      api.simulateClick();
      api.openPopup('linkedin');
    }
  });
*/
});

function shortenurl(url) {
	var xmlHttp = null;
  return url;
	var fullurl = "http://www.andreasnorman.com/bitly.shorten.php?url=" + url;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", fullurl, false );
      xmlHttp.send( null );
      return xmlHttp.responseText;
}
