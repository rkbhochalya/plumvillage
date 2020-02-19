(function($){

	// center the logo if within single.php there is no menu, temp hack. Should be done without js
	if($('.center-logo').length){
		$('body').addClass('center-logo');
	}

	// mega menu toggle
  $('.menu-toggle').click(function(e){
  	$(this).toggleClass('is-active');
    $('body').toggleClass('menu-open').addClass('menu-transitioning');
    $('.mega-menu-container').removeClass('hidden');
    $('.menu-open #menu-mega-menu > li:first-child > a').focus();
    e.preventDefault();
    e.stopPropagation();
  })
  $('.site').on('click', function(e){
  	if($('body').hasClass('menu-open')){
  		$('.menu-toggle').trigger('click');
	    e.preventDefault();
	    e.stopPropagation();
  	}
  })

  // hide menu when not needed, prevents glitches/showing it when loading and scrolling
	$('.site').on("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend", function(){
		if(!$('body').is('.menu-open')){
			$('.mega-menu-container').addClass('hidden');
			$('body').removeClass('menu-transitioning');
		} 
	})

	$(window).resize(function(){
		if($('.mega-menu-top:visible').length){
			$('.page-homepage .site-title').css({
				'padding-bottom' : ($('.home-landing-top .wp-block-column:first-child').height() + 50)
			})
		}		
	})

	$(window).trigger('resize');

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

  $('form select.select2').each(function(){
  	var el = $(this);
		el.select2({
			width: '100%',
			minimumResultsForSearch: 20
		});
  })

  ////////////////
  // pardot spam protection

  // hide honeypot field for screen readers
  $('.form-move-aside').attr({'aria-hidden' : true})

  // only post form if javascript is active
  $('#pardot-subscribe').attr({'action' : $('#pardot-subscribe').data('pvFormAction')})

  $('#pardot-subscribe .btn').prop("disabled", false);

  $('.js-off').removeClass('js-off');

  $('.validate-section-1').on('click', function(e){
    $('#pardot-subscribe').parsley().whenValidate({
      group: 'section-1'
    }).done(function() {
      $('.section-1').addClass('hide');
      $('.section-2').removeClass('hide');
    });
    e.preventDefault();
  })


 	// check if you are human
	Parsley.addValidator('human', {
	  validateString: function(value) {
	    return value.toLowerCase().trim() == pvAjax.human;
	  },
	  messages: {en: pvAjax.maybetry + " '"+pvAjax.human+"'?"}
	});


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
    ],
    autoFocus: false,
    btnTpl: {
	    download:
	      '<a download data-fancybox-download class="fancybox-button fancybox-button--download" title="{{DOWNLOAD}}" href="javascript:;">' +
	      '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.62 17.09V19H5.38v-1.91zm-2.97-6.96L17 11.45l-5 4.87-5-4.87 1.36-1.32 2.68 2.64V5h1.92v7.77z"/></svg>' +
	      "</a>",

	    zoom:
	      '<button data-fancybox-zoom class="fancybox-button fancybox-button--zoom" title="{{ZOOM}}">' +
	      '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"/></svg>' +
	      "</button>",

	    close:
	      '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">' +
	      '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"/></svg>' +
	      "</button>",

	    // Arrows
	    arrowLeft:
	      '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' +
	      '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"/></svg></div>' +
	      "</button>",

	    arrowRight:
	      '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' +
	      '<div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"/></svg></div>' +
	      "</button>",
	        	
    	smallBtn: '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}">' +
      '<span class="icon-close"></span>' +
      "</button>"
    }
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
		      if($selectedFilters[i] == '*'){
		      	$filters.find('.selected').removeClass('selected');
		      	$filters.find('.reset-filter').addClass('selected');
		      } else {
			      $filters.find('[data-filter=".' + $selectedFilters[i] + '"]').parents('.filter-list').find('.selected').removeClass('selected');
			      $filters.find('[data-filter=".' + $selectedFilters[i] + '"]').addClass('selected');
		      }
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
		dots: true
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
  	if($(this).height() > 40 && !$(this).is('.show-all')){
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

  $('.toggle-search').on('click', function(e){
  	$('body').toggleClass('search-open');
 		$('.search-overlay').addClass('animating');
  	if($('body').is('.search-open')){
	  	$('.search-overlay .search-field').select();	  			
  	}
  	e.preventDefault();
  })

	$('.search-overlay').on("transitionend.fm webkitTransitionEnd.fm oTransitionEnd.fm MSTransitionEnd.fm", function(e) {
		$('.search-overlay').removeClass('animating');
	})  		

  // Ajax Search

	var $searchAjax;
	var $s;

  $('.search-overlay .search-form .search-field').on('input', function(e){
		var $form = $(this).closest('.search-form');
    var $input = $(this);

    if($s != $input.val()){
    	$s = $input.val();
	    var $content = $('.search-overlay .search-results');

	    if($searchAjax){
	    	$searchAjax.abort();	
	    }
	   
	   	if($s.length > 2){
				$searchAjax = $.ajax({
				  type : 'post',
				  url : pvAjax.ajaxurl,
				  data : {
				      action : 'get_search_results',
				      s : $s
				  },
				  beforeSend: function() {
				      $content.addClass('loading');
				  },
				  success : function( response ) {
				      $content.removeClass('loading');
				      $content.html( response );
				      $('.search-overlay').addClass('has-results')

				      // send search to google analytics
							if (typeof ga === 'function') {
								gtag('event', 'search', { 'search_term': $s });
								gtag('config', pvAjax.gacode, {
								  'page_title' : 'Search',
								  'page_path': '/?s='+$s
								});
						  }				      
				  }
				});
	    } else {
	    	$content.empty();
	    	$content.removeClass('loading')
	    }    	
    }
  })

  $('.search-overlay .search-form').on('submit', function(e){
  	$(this).find('.search-field').trigger('input').blur();
  	e.preventDefault();
  })

  $('.search-overlay').scroll(function(e){
  	if($('.search-form-container').position().top < 0){
  		$('.search-overlay').addClass('sticky-form')
      $('.search-overlay .search-results').css({
      	'padding-top' : $('.search-form-container').outerHeight()
      })  		
  	}

  	if($('.load-more-search:not(.loading)').length){
  		if($('.load-more-search').position().top < ($(window).height() + 200)){
  			$('.load-more-search').trigger('click');
  		}
  	}
  })

  $('body').on('click', '.load-more-search', function(e){
  	var $el = $(this);
    var $content = $('.search-overlay .search-results');

    if(!$el.is('.loading')){
			$.ajax({
			  type : 'post',
			  url : pvAjax.ajaxurl,
			  data : {
			      action : 'get_search_results',
			      s : $s,
			      offset: $el.data('offset')
			  },
			  beforeSend: function() {
			      $el.addClass('loading');
			  },
			  success : function( response ) {
			      $el.remove();
			      $content.append( response );
			  }
			});
		}

  	e.preventDefault();
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


///// Icon Animation
// https://nucleoapp.com/tool/icon-transition

! function() {
    "use strict";
    if (!window.requestAnimationFrame) {
        var a = null;
        window.requestAnimationFrame = function(t, i) {
            var e = (new Date).getTime();
            a || (a = e);
            var s = Math.max(0, 16 - (e - a)),
                n = window.setTimeout(function() {
                    t(e + s)
                }, s);
            return a = e + s, n
        }
    }

    function r(t, i, e, s) {
        return 1 > (t /= s / 2) ? e / 2 * t * t * t * t + i : -e / 2 * ((t -= 2) * t * t * t - 2) + i
    }

    function e(t) {
        return t ? [1, 0] : [0, 1]
    }

    function t(t) {
        this.element = t, this.svg = function t(i) {
            var e = i.parentNode;
            if ("svg" !== e.tagName) e = t(e);
            return e;
        }(this.element), this.getSize(), this.states = this.element.querySelectorAll(".js-transition-icon__state"), this.time = {
            start: null,
            total: 250
        }, this.status = {
            interacted: !1,
            animating: !1
        }, this.animation = {
            effect: this.element.getAttribute("data-effect"),
            event: this.element.getAttribute("data-event")
        }, this.init()
    }
    t.prototype.getSize = function() {
        var t = this.svg.getAttribute("viewBox");
        this.size = t ? {
            width: t.split(" ")[2],
            height: t.split(" ")[3]
        } : this.svg.getBoundingClientRect()
    }, t.prototype.init = function() {
        var t = this;
        if(this.svg.parentNode.tagName.toLowerCase() == 'a'){
	        this.svg.parentNode.addEventListener(t.animation.event, function() {
	            t.status.animating || (t.status.animating = !0, window.requestAnimationFrame(t.triggerAnimation.bind(t)))
	        })
        } else {
	        this.svg.addEventListener(t.animation.event, function() {
	            t.status.animating || (t.status.animating = !0, window.requestAnimationFrame(t.triggerAnimation.bind(t)))
	        })        	
        }
    }, t.prototype.triggerAnimation = function(t) {
        var i = this.getProgress(t);
        this.animateIcon(i), this.checkProgress(i)
    }, t.prototype.getProgress = function(t) {
        return this.time.start || (this.time.start = t), t - this.time.start
    }, t.prototype.checkProgress = function(t) {
        if (this.time.total > t) window.requestAnimationFrame(this.triggerAnimation.bind(this));
        else {
            this.status = {
                interacted: !this.status.interacted,
                animating: !1
            }, this.time.start = null;
            var i = e(this.status.interacted);
            this.states[i[0]].removeAttribute("aria-hidden"), this.states[i[1]].setAttribute("aria-hidden", "true")
        }
    }, t.prototype.animateIcon = function(t) {
        if (t > this.time.total) {
            t = this.time.total;
        }
        if (0 > t) {
            t = 0;
        };
        var i = e(this.status.interacted);
        this.states[i[0]].style.display = t > this.time.total / 2 ? "none" : "block", this.states[i[1]].style.display = t > this.time.total / 2 ? "block" : "none", "scale" == this.animation.effect ? this.scaleIcon(t, i[0], i[1]) : this.rotateIcon(t, i[0], i[1])
    }, t.prototype.scaleIcon = function(t, i, e) {
        var s = r(Math.min(t, this.time.total / 2), 1, -.2, this.time.total / 2).toFixed(2),
            n = r(Math.max(t - this.time.total / 2, 0), .2, -.2, this.time.total / 2).toFixed(2);
        this.states[i].setAttribute("transform", "translate(" + this.size.width * (1 - s) / 2 + " " + this.size.height * (1 - s) / 2 + ") scale(" + s + ")"), this.states[e].setAttribute("transform", "translate(" + this.size.width * n / 2 + " " + this.size.height * n / 2 + ") scale(" + (1 - n) + ")")
    }, t.prototype.rotateIcon = function(t, i, e) {
        var s = r(t, 0, 180, this.time.total).toFixed(2);
        this.states[i].setAttribute("transform", "rotate(-" + s + " " + this.size.width / 2 + " " + this.size.height / 2 + ")"), this.states[e].setAttribute("transform", "rotate(" + (180 - s) + " " + this.size.width / 2 + " " + this.size.height / 2 + ")")
    };
    var i = document.querySelectorAll(".js-transition-icon");
    if (i)
        for (var s = 0; i.length > s; s++) new t(i[s])
}();