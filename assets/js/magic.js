(function($){

	// center the logo if within single.php there is no menu, temp hack. Should be done without js
	if($('.center-logo').length){
		$('body').addClass('center-logo');
	}

	// mega menu toggle
  $('.menu-toggle').click(function(e){
    $('body').toggleClass('menu-open');
    $('.mega-menu-container').removeClass('hidden');
    $('#menu-mega-menu > li:first-child > a').focus()
    e.preventDefault();
    e.stopPropagation();
  })
  $('.site').on('click', function(e){
  	if($('body').hasClass('menu-open')){
  		$('.menu-toggle:first').trigger('click');
	    e.preventDefault();
	    e.stopPropagation();
  	}
  })

  // hide menu when not needed, prevents glitches/showing it when loading and scrolling
	$('.site').on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(){
		if(!$('body').is('.menu-open')){
			$('.mega-menu-container').addClass('hidden');
		}
	})


  $("form.validate").parsley({
		errorClass: 'is-invalid',
		successClass: 'is-valid',
		errorsContainer: function(el){
			return $(el.element).parent();
		},
		errorsWrapper: '<span class="invalid-feedback"></span>',
		errorTemplate: '<div></div>',
		trigger: 'change'
	})

  $('form select').each(function(){
  	var el = $(this);
		el.select2({
			width: '100%',
			minimumResultsForSearch: 20
		});
  })

  $('.select-inline select').each(function(){
  	var el = $(this);
		el.select2({
			width: '100%',
			theme: 'select2-container--inline',
			minimumResultsForSearch: 'Infinity'
		});
  })

	$('select').change(function() {
    $(this).parsley().validate();
 	}); 

 	$('.footnote').each(function(){
 		var el = $(this);
 		if(el.prev('br').length){
 			el.prev().remove();
 		}
 		var star = $('<span class="icon-star"></span>').on('click', function(){
 			$(this).toggleClass('active');
 			el.toggleClass('show');
 		})
 		el.before(star)
 	})

 	$('.side-link').each(function(){
 		var el = $(this);
 		var link = $('<span class="real-side"><span class="icon icon-'+ el.data('link-type')+'"></span><span class="text">'+el.data('link-description')+'</span></span>').attr({
 			'href': el.attr('href')
 		})
 		el.append(link);
 	})

 	// set fancybox default settings
	$.extend($.fancybox.defaults, {
		beforeLoad: function(e){
			if(this.opts.isPress){
				$('body').addClass('is-press')
			} else {
				$('body').removeClass('is-press')
			}
		},
		caption : function(instance,item) {
      return $(this).closest('figure').find('figcaption').html();
    },
    buttons: [
    	"slideShow",
    	"close"
    ]		
	});


	// open images in fancybox
	$('figure.wp-block-image > a[href*="uploads"], .wp-block-image figure > a[href*="uploads"]').fancybox({
		type: 'image'
	})

	if ($('.wp-block-gallery')) {

    $('.blocks-gallery-item').click(function() {

      var galleryImages = $(this).parent().find('a[href*="uploads"]');
      var gallery = [];

      galleryImages.each(function( index, galleryItem ) {

        var caption = $(this).parent().find('figcaption').length ? $(this).parent().find('figcaption').text() : $(this).find('img').attr('alt');

        gallery.push({
          src : galleryItem.href,
          opts : {
            caption: caption
          }
        })
      });

      $.fancybox.open( gallery, { loop: false }, $(this).index() );

      return false;
    });
  }

	$('.play').click(function(e){
		var el = $(this);

		var videoWidth = $(window[el.data('embed-link')]).attr('width');
		var videoHeight = $(window[el.data('embed-link')]).attr('height');
		var realratio = ratio(videoWidth, videoHeight); 
		$('.iframe-target-'+el.data('target')).find('.iframe-container').removeClass('embed-responsive-21by9 embed-responsive-16by9 embed-responsive-4by3 embed-responsive-1by1').addClass('embed-responsive-'+realratio[0]+'by'+realratio[1]);

		if(el.parents('.video-embed.alignright').length){
			var parents = el.parents('.video-embed')
			parents.addClass('open opening');
			parents.on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
			 function(e){
			 		if(parents.is('.opening')){
					  parents.removeClass('opening').find('.video-wrapper').addClass('playing')
						$('.iframe-target-'+el.data('target')+' .dropzone').html(window[el.data('embed-link')]);
				    $(this).off(e);
			 		}
			 });		
		} else if (el.next('.iframe-target').length){
			el.parents('.video-wrapper').addClass('open playing');
			$('.iframe-target-'+el.data('target')+' .dropzone').html(window[el.data('embed-link')]);
		} else {
			$('.iframe-target-'+el.data('target')).addClass('open').parents('.video-wrapper').addClass('playing');
			$('.iframe-target-'+el.data('target')+' .dropzone').html(window[el.data('embed-link')]);
		}
		if($grid){
			$grid.isotope('layout');	
		}		
		e.preventDefault();
	})


	$('.iframe-target .icon-close').on('click', function(){
		var el = $(this);
		if(el.parents('.video-wrapper').length){
			var parents = el.parents('.video-wrapper')
		} else {
			var parents = el.parents('.iframe-target');
		}
		parents.removeClass('playing open').parents('.open').removeClass('open');
		parents.find('.dropzone').empty();
		if($grid){
			$grid.isotope('layout');	
		}
	})

	$('.panel-collapsable > h5').on('click', function(){
		var parent = $(this).parent();
		parent.toggleClass('panel-open');
		if(parent.is('.panel-goes-wide')){
			parent.toggleClass('center-with-border');
		}
	})

	////////////////////////////////////////////////////////////////////////////////
	// Filter function for letters, updates, books, events

  var $grid = $('.post-overview');
	var $layoutmode = ((typeof $('.post-overview').data('isotopeLayoutmode') !== 'undefined') ?  $('.post-overview').data('isotopeLayoutmode') : 'fitRows');

  var $filters = $('.filter-list').on( 'click', 'a:not(.reset-filter)', function(e) {
  	var el = $(this);
  	if(el.is('.selected')){
  		el.siblings('.reset-filter').trigger('click');
  	} else {
	    $(this).siblings('.selected').removeClass('selected');

	    var filterAttr = $( this ).attr('data-filter');

			$('.filter-list .filter-products.selected:not(.reset-filter)').each(function(){
				filterAttr += $(this).attr('data-filter');
			})

	    // set filter in hash
	    location.hash = 'filter=' + encodeURIComponent( filterAttr );  		
  	}

    e.preventDefault();

  });

	$('.reset-filter').on('click', function(e){
  	var el = $(this);
  	var parent = el.parent();
		parent.find('.filter-products.selected').removeClass('selected');
		el.addClass('selected');

		filterAttr = '*';
		$('.filter-list .filter-products.selected:not(.reset-filter)').each(function(){
			filterAttr += $(this).attr('data-filter');
		})
    // set filter in hash
    location.hash = 'filter=' + encodeURIComponent( filterAttr );

		e.preventDefault();
	})

  var isIsotopeInit = false;

  function onHashchange() {
    var hashFilter = getHashFilter();
    if ( !hashFilter  ) {
      hashFilter = $('.filter-list .selected').data('filter');
    }

    // filter isotope
    $maxItems = $('.filter-list').data('filterMax') ? $('.filter-list').data('filterMax') : 99999;

    $grid.isotope({
	  	layoutMode: $layoutmode,
	  	itemSelector: 'article, .in-betweener',
      filter: function() {
      	if(hashFilter != '*'){
      		return $(this).is(hashFilter) && $(this).index(hashFilter) < $maxItems;	
      	} else {
      		return $(this);
      	}
    	}
    });

    if(!isIsotopeInit){
			$grid.imagesLoaded().progress(function(){
				$grid.isotope('layout');				
			})    	
    }
    isIsotopeInit = true;


    if(hashFilter){
	    $selectedFilters = hashFilter.split('.');

			for (var i = 0; i < $selectedFilters.length; i++) {
				if($selectedFilters[i] != ''){
		      $filters.find('[data-filter=".' + $selectedFilters[i] + '"]').parents('.filter-list').find('.selected').removeClass('selected');
		      $filters.find('[data-filter=".' + $selectedFilters[i] + '"]').addClass('selected');
				}
			}   
    }
  }

  $(window).on( 'hashchange', onHashchange );

  // trigger event handler to init Isotope
  onHashchange();


	$('.gallery-images').each(function(){

		// masonry
		$gallery = $(this).isotope({
	  	layoutMode: 'masonry',
	  	itemSelector: '.gallery-image',
	  	percentPosition: true,
	  	masonry: {
	  		columnWidth: '.grid-sizer'
	  	}
		});

		$(this).imagesLoaded().progress(function(){
			$gallery.isotope('layout');				
		})

	})

	// Slick Slider
	$('.slider').slick({
		dots: true,
  	infinite: false
	});


  // Load more
  $('.load-more').on('click', function(e){
  	$(this).closest('.load-more-container').addClass('show-load');
  	e.preventDefault();
  })


  // sticky submenu
  if($('.menu-block').length){
  	$menuTop = $('.menu-block').offset().top;
  	$(document).scroll(function(){
  		if($(document).scrollTop() > $menuTop){
  			$('.menu-block-container').height($('.menu-block').outerHeight())
  			$('.menu-block').addClass('fix-menu-top');
  		} else {
  			$('.menu-block').removeClass('fix-menu-top');
  		}
  	})
  }

  // toggle event locations
  $('.toggle-events-locations').on('change', function(){
  	$('.'+$(this).val()).removeClass('hide').siblings().addClass('hide');
  })


  // set cookie
  $('.cookies-ok').on('click', function(){
  	createCookie('cookieok', 'yes', 365);
  	$('#cookie-notice').removeClass('show-cookie');
  })

  if (!document.cookie.split(';').filter(function(item) {
    return item.trim().indexOf('cookieok=') == 0
	}).length) {
		$('#cookie-notice').addClass('show-cookie');
	}

  // if the filter list is too long, make it togglable
  $('.filter-list').each(function(){
  	if($(this).height() > 40){
  		$(this).addClass('too-high')
  	}
  })

  $('.toggle-filter-list').on('click', function(){
  	$('.filter-list').toggleClass('show-all')
  })

  // if white-header, make mega menu button black on scroll
  if($('.has-white-header').length){
  	$coverHeight = $('.entry-content .wp-block-cover:first-child').outerHeight()
  	$(window).scroll(function(){
	  	if($(window).scrollTop() > $coverHeight){
	  		$('body').removeClass('has-white-header');
	  	} else {
	  		$('body').addClass('has-white-header');
	  	}
  	})
  }

  $('.wpml-ls-item.menu-item-has-children > a').on('click', function(e){
  	$(this).parent().toggleClass('sub-menu-open')
  	e.preventDefault();
  })

  $('html').on('click', function(e){
  	if($('.wpml-ls-item.sub-menu-open').length && !$(e.target).parents('.wpml-ls-item').length){
  		$('.wpml-ls-item.sub-menu-open').removeClass('sub-menu-open')
  	}
  })

})(jQuery);

/* the binary Great Common Divisor calculator */
function gcd (u, v) {
    if (u === v) return u;
    if (u === 0) return v;
    if (v === 0) return u;

    if (~u & 1)
        if (v & 1)
            return gcd(u >> 1, v);
        else
            return gcd(u >> 1, v >> 1) << 1;

    if (~v & 1) return gcd(u, v >> 1);

    if (u > v) return gcd((u - v) >> 1, v);

    return gcd((v - u) >> 1, u);
}

/* returns an array with the ratio */
function ratio (w, h) {
	var d = gcd(w,h);
	return [w/d, h/d];
}

// get hash filter for Isotope
function getHashFilter() {
  var hash = location.hash;
  // get filter=filterName
  var matches = location.hash.match( /filter=([^&]+)/i );
  var hashFilter = matches && matches[1];
  return hashFilter && decodeURIComponent( hashFilter );
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain="+window.location.hostname;
}
