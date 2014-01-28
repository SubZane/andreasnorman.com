$(document).ready(function($) {
  var iw = $('body').innerWidth();

    $('.post-content figure a').fluidbox();
  if (iw >= 768) {

  };
  
  $(".postcontent").fitVids();

/*
	$('.image-wraper img').on('click', function(e) {
		e.preventDefault();
	});
  $('#sidemenu').on('click', function(e) {
    $(this).hide(1, function() {
      var effect = $(this).data('effect');
      e.preventDefault();
      e.stopPropagation();
      $('#st-container').removeClass();
      $('#st-container').addClass('st-container');
      $('#st-container').addClass(effect);
      setTimeout( function() {
        $('#st-container').addClass('st-menu-open');
      }, 25 );
      var elems = $('.st-menu');
      elems.bind( 'clickoutside', function(event){
        $('#st-container').removeClass('st-menu-open');
        setTimeout( function() {
          $('#sidemenu').show();
          console.log('show menu');
        }, 550 );
        $('#st-container').unbind('clickoutside');
      });
      
    });
  });

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
