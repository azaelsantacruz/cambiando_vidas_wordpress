jQuery(document).ready(function($) {
    "use strict";

	$(window).load(function(){
		 $('.preloader').fadeOut();
	});

    /* SCROLLL SMOOTH */
    $("html").niceScroll({
        cursorcolor: '#4b4b4b',
        cursorwidth: 8,
        cursorborder: 0,
        cursorborderradius: 0,
        zindex: 999999,
        autohidemode: false,
        scrollspeed: 80,
        mousescrollstep: 50,
        horizrailenabled: false
    });

    /* slide down navigation */
    var navigation = $('.main-header').clone();
    $('.main-header').addClass('old');
    if ($('#wpadminbar').css('position') == 'fixed') {
        var topOffset = $('#wpadminbar').outerHeight(true);
    } else {
        var topOffset = 0;
    }
    navigation.css({
        display: 'none',
        position: 'fixed',
        left: '0px',
        top: topOffset + 'px',
        width: '100%',
        zIndex: 1040,
        backgroundColor: '#ffffff',
        padding: '20px 0px 10px 0px'
    });
    navigation.addClass('fixed-nav');
    $('body').append(navigation);

    $(window).scroll(function() {
        if ($(document).scrollTop() >= $('.main-header.old').outerHeight()) {
            navigation.slideDown();
        } else {
            navigation.fadeOut();
        }
    });

    $(window).resize(function() {
        if ($('#wpadminbar').css('position') == 'fixed') {
            var topOffset = $('#wpadminbar').outerHeight(true);
        } else {
            var topOffset = 0;
        }

        $('#abs').css({
            top: topOffset + 'px'
        });

        if ($(window).width > 768) {
            navigation.find('.nav.navbar-nav > li').css('padding', '0px 3px');
        } else {
            navigation.find('.nav.navbar-nav > li').css('padding', '0px');
        }
    });

    /* NAV */
    function handle_navigation() {
        if ($(window).width() > 769) {
            /* SHOW THE NAVIGATION */
            $('.pt-nav ul').show();
            /* HIDE THE KIDS */
            $('.pt-nav ul li').children('ul').hide();
            /* REMOVE THE VENET ON CLICK FROM THE SCREEN SIZES SMALLER THAN 767 */
            $('.pt-nav ul li').unbind('click');
            $('.pt-nav-trigger button').unbind('click');

            $('.pt-nav li > a').hover(
                function() {
                    $(this).parent().children('ul').stop().css('height', 'auto').slideDown(300);
                }
            );
            $('.pt-nav li').hover(
                null,
                function(e) {
                    $(this).children('ul').stop().slideUp(100);
                }
            );

        } else {
            $('.pt-nav ul li').unbind('click');
            $('.pt-nav-trigger button').unbind('click');
            /* REMOVE HOVER ACTIONS WHIC IS USED ON SCREENS LARGER THAN 767 */
            $('.pt-nav li > a').unbind('mouseenter mouseleave');
            $('.pt-nav li').unbind('mouseenter mouseleave');
            /* HIDE THE KIDS */
            $('.pt-nav ul li').children('ul').hide();
            /* trigger on click */
            $('.pt-nav ul li').click(function() {
                $(this).children('ul').slideToggle(200);
            });
            /* HIDE THE NAVIGATION */
            $('.pt-nav ul').hide();
            /* OPEN NAVIGATION ON TRIGGER BUTTON */
            $('.pt-nav-trigger button').click(function(e) {
                e.preventDefault();
                $(this).parents('.nav-root').find('.pt-nav ul').slideToggle(200);
            });
        }
    }

    handle_navigation();
    $(window).resize(function() {
        handle_navigation();
    });

    /* COUNT DOWN */
    $('.countdown').each(function(){
        var $this = $(this);
        $this.downCount({
            date: $this.data('target_time'),
            offset: $this.data('offset')
        });
    });

    /* RISED BARS */
    $('.rised').slider();
    $('.rised-range-funds').slider({forceRtl: false});
    $(".rised-range-funds").on('slide', function(slideEvt) {
        var val = slideEvt.value;
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.").replace( ',', ' - ' );
        $("#begin-value").text( val );

    });
	$(".rised-range-funds").on('slideStop', function(slideEvt) {
        var val = slideEvt.value;
		var vals = val.toString().split(',');
		$('input[name="min_funds_val"]').val( vals[0] );
		$('input[name="max_funds_val"]').val( vals[1] );	
	});
	
	$('.rised-range-age').slider({forceRtl: false});
    $(".rised-range-age").on('slide', function(slideEvt) {
		var val = slideEvt.value.toString().replace( ',', ' - ' );
        $("#begin-value-age").text( val + ' days' );

    });
	$(".rised-range-age").on('slideStop', function(slideEvt) {
        var val = slideEvt.value;
		var vals = val.toString().split(',');
		$('input[name="min_days_val"]').val( vals[0] );
		$('input[name="max_days_val"]').val( vals[1] );	
	});

    $('.price-filter').slider({forceRtl: false});
    $(".price-filter").on('slide', function(slideEvt) {
        var val = slideEvt.value;
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.").replace( ',', ' - ' );
        $(".price-filter-val").text( val );

    });
    $(".price-filter").on('slideStop', function(slideEvt) {
        var val = slideEvt.value;
        var vals = val.toString().split(',');
        $('input[name="min_price"]').val( vals[0] );
        $('input[name="max_price"]').val( vals[1] ); 
    });


    /* MAIN SLIDER */
    $('#myCarousel').on('slide.bs.carousel', function(e) {
		var opacity = $('#myCarousel').data('opacity');
		if( opacity == "" ){
			opacity = 0.5;
		}
        $(e.relatedTarget).find('img').css('opacity', '0');
        $(e.relatedTarget).find('img').animate({
            opacity: opacity
        }, 500);
        $(e.relatedTarget).find('.slide-content').hide();
    });
    $('#myCarousel').on('slid.bs.carousel', function(e) {
        $('#myCarousel .item.active').find('.slide-content').fadeIn(500);
    });

    /* SHARE */
    $(document).on('click', function(e) {
        if ($(e.target).closest('.overlay-wrapper').length == 0) {
            if (!$(e.target).closest('a.share-trigger').length) {
                $('.overlay-wrapper').delay(400).fadeOut();
                $('.content-hidden').fadeOut();
            }
        }
    });
    $('a[data-toggle="dropdown"]').click(function(e) {
        if (!$(e.target).closest('a.share-trigger').length) {
            $('.overlay-wrapper').delay(400).fadeOut();
            $('.content-hidden').fadeOut();
        }
    });

    $('a.share-trigger').click(function() {
        var $this = $(this);
        if( $this.data('target') == 'overlay' ){
            var parent = $this.closest('.urgent-box');
            if (parent.length == 0) {
                parent = $this.closest('.latest-box');
            }

            $('.overlay-wrapper').attr('data-wrapper', 'close');
            $('.content-hidden').attr('data-content', 'close');

            parent.find('.overlay-wrapper').attr('data-wrapper', 'open').fadeToggle(400);
            parent.find('.content-hidden').attr('data-content', 'open').delay(400).fadeIn();


            $('div[data-wrapper="close"]').fadeOut(400);
            $('div[data-content="close"]').delay(400).fadeOut();
        }
        else{
            $('#shareModal .modal-body').html( '<div class="overlay-wrapper">'+$this.parents( '.box' ).find( '.overlay-wrapper' ).html()+'</div>' );
            var title = $('#shareModal .modal-body .content-hidden p:first');
            $('#shareModal .modal-title').text( title.text() );
            title.remove();
            $('#shareModal .modal-body .content-hidden').removeClass('content-hidden');
            $('#shareModal').modal('show');
        }
    });

    /* TOOLTIPS */
    $(document).ready(function() {
        $("[data-rel]").tooltip({
            placement: 'left'
        });
    });

    /* DROPDWON */
    // Add slideup & fadein animation to dropdown
    $('.dropdown').on('show.bs.dropdown', function(e) {
        var $dropdown = $(this).find('.dropdown-menu');
        var orig_margin_top = parseInt($dropdown.css('margin-top'));
        $dropdown.css({
            'margin-top': (orig_margin_top + 10) + 'px',
            opacity: 0
        }).animate({
            'margin-top': orig_margin_top + 'px',
            opacity: 1
        }, 300, function() {
            $(this).css({
                'margin-top': ''
            });
        });
    });
    // Add slidedown & fadeout animation to dropdown
    $('.dropdown').on('hide.bs.dropdown', function(e) {
        var $dropdown = $(this).find('.dropdown-menu');
        var orig_margin_top = parseInt($dropdown.css('margin-top'));
        $dropdown.css({
            'margin-top': orig_margin_top + 'px',
            opacity: 1,
            display: 'block'
        }).animate({
            'margin-top': (orig_margin_top + 10) + 'px',
            opacity: 0
        }, 300, function() {
            $(this).css({
                'margin-top': '',
                display: ''
            });
        });
    });

    /* MAPS CAROUSEL */
    $('#eventsCarousel').on('slid.bs.carousel', function(e) {
        $('#eventsCarousel .item.active iframe').attr('src', $('#eventsCarousel .item.active iframe').attr('src'));
    });
    /* disable scroll on map iframes on smaller screens */
    if ($(window).width() < 767) {
        $('iframe.map').css({
            'pointer-events': 'none'
        });
    }

    /* input shop increment */
    $('.increment a.minus').on('click', function() {
        var $this = $(this);
        var $parent = $this.parents('.increment');
        var $input = $parent.find('input');
		var value = parseInt($input.val(), 10) - 1;
		if( value > 0 ){
			$input.val( value );	
		}
    });
    $('.increment a.plus').on('click', function() {
        var $this = $(this);
        var $parent = $this.parents('.increment');
        var $input = $parent.find('input');
        var value = parseInt( $input.val(), 10 ) + 1;
        if( value > parseInt( $input.attr('max') ) ){
            value = $input.attr('max');
        }		
		$input.val( value );	
    });

    /* CALENDAR */
	$("#my-calendar").each(function(){
		var $this = $(this);
		$this.zabuto_calendar({
			language_text: {
				month_labels: $this.data( 'month_labels' ).split(','),
				dow_labels: $this.data( 'dow_labels' ).split(',')
			},
			cell_border: true,
			today: true,
			show_days: true,
			weekstartson: 0,
			nav_icon: {
				prev: '<i class="fa fa-angle-left"></i>',
				next: '<i class="fa fa-angle-right"></i>'
			},
			language: "en",
			ajax: {
				url: ajaxurl,
				modal: true
			}
		});		
	});

    $(document).on( 'click', '.has-event', function(){
        var $this = $(this);
        var event_start_time = $this.attr('class').split('date_')[1];
        $.ajax({
            url: ajaxurl,
            method: "GET",
            data: {
                action: 'get_day_events',
                event_start: event_start_time
            },
            success: function ( response ){
                $('.modal.in .modal-body').html( response );
            },
        })
    })    

    /* LIGHTBOX */
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox({
            always_show_close: true,
            gallery: 'data-gallery="multiimages'
        });
    });


    $('#submit').addClass('button-normal white pull-right');

    /* UPDATE PREDEFIUNED VALUES */
    $('.donate_predefined').change(function(){
        var $this = $(this);
        $this.parents( 'form' ).find( 'input[name="amount"]' ).val( $this.val() );
    });


    if( window.location.href.indexOf( 'gr_uniqid' ) !== -1 ){
        var params = getQueryParams();
        params['action'] = 'get_donation';
        if( params['cancel'] ){
            params['action'] = 'cancel_donation';
        }
        $.ajax({
            url: ajaxurl,
            method: "GET",
            data:params,
            dataType: "JSON",
            success: function( response ){
                if( response.error ){
                    $('.donation_result').html( '<div class="alert alert-danger" role="alert">'+response.error+'</div>' );
                }
                else{
                    if( response.success == 'completed' ){
                        $('.donation_result').html( '<div class="alert alert-success" role="alert">'+response.message+'</div>' );
                    }
                }
            },
            complete: function(){
                enable_donation();
            }
        });
    }
    else{
        enable_donation();
    }

    function getQueryParams() {
        var qs = window.location.href.split("+").join(" ");
        var params = {}, tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;		
		if( qs.split('?')[1] ){
			while (tokens = re.exec(qs.split('?')[1])) {
				params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
			}
		}
        return params;
    }

    function enable_donation(){
        $('.waiting-overlay').fadeOut();
        $('.donate').click(function(){
            $('.waiting-overlay').fadeIn();
            var $data = $(this).parents('form').serialize();
            $.ajax({
                url: ajaxurl,
                method: "POST",
                dataType: "JSON",
                data: {
                    action: 'donate',
                    data: $data
                },
                success: function( response ){
                    if( response.error ){
                        $('.donation_result').html( '<div class="alert alert-danger" role="alert">'+response.error+'</div>' );
                        $('.waiting-overlay').fadeOut();
                    }
                    else{
                        if( response.success == 'redirect' ){
                            $('.donation_result').html( '<div class="alert alert-info" role="alert">Redirecting...</div>' );
                            window.location = response.url;
                        }
                    }
                }
            })
        });        
    }
	
	$('.search_submit').click(function(e){
		e.preventDefault();
		$(this).parents('form').submit();
	});
	
	$('.single_product_variation ul li a').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var $parent = $this.parents('.single_product_variation');
		$parent.find( 'select' ).val( $this.data('value') );
		$parent.find( '.select_start' ).text( $this.html() );
	});
	
	
	/* handle bootstrap dropdowns */
	$('form .dropdown-menu li a').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var $parent = $this.parents( 'ul' );
		var $text_holder = $this.parents('.widget-dropdown').find('a[data-toggle="dropdown"]');
		var val = $this.data('value');
		$('input[name="'+$parent.data('name')+'"]').val( val );
		$text_holder.text( $this.text() );
	});
	
	$('.dropdown_value').each(function(){
		var $this = $(this);
		var val = $this.val();
		var $text_holder = $this.parents('.widget-dropdown').find('a[data-toggle="dropdown"]');
		if( val !== '' ){
			$text_holder.text( $('a[data-value="'+val+'"]').text() );
		}
	});
	
	/* donation listing */
	$('.donate_logs').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var page = $this.data('page');
		page++;
		$this.data('page', page);
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'get_logs',
				cause_id: $this.data('cause_id'),
				page: page
			},
			method: "POST",
			success: function( response ){
				if( response ){
					$('.logs-holder').append( response );
				}
				else{
					$this.fadeOut();
				}
			}
		})
	});

    $(document).on( 'click', '.subscribe', function(e){
        e.preventDefault();
        var $this = $(this);
        var parent = $this.parents('.widget');
        var result_div = parent.find('.subscribe_result');
        result_div.html( '' );
        
        $.ajax({
            url: ajaxurl,
            method: "POST",
            data: {
                email: parent.find('.email').val(),
                fname: parent.find('.fname').val(),
                lname: parent.find('.lname').val(),
                action: 'subscribe'
            },
            dataType: "JSON",
            success: function( response ){
                if( !response.error ){
                    result_div.html( '<div class="alert alert-success" role="alert">'+response.success+'</div>' );
                }
                else{
                    result_div.html( '<div class="alert alert-danger" role="alert">'+response.error+'</div>' );
                }
            },
            error: function(){
                
            },
            complete: function(){
                
            }
        });
    });
	
	$('.event-counter').each(function(){
		var $this = $(this);
        $this.downCount({
            date: $this.data('target_time'),
            offset: $this.data('offset'),
        });
	});	

    /* SEND CONTACT */
    $('.send_contact').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var $form = $this.parents('form');
        var result_div = $form.find( '.result_div' );
        $.ajax({
            url: ajaxurl,
            method: "POST",
            data: {
                action: 'send_contact',
                name: $form.find('input[name="name"]').val(),
                email: $form.find('input[name="email"]').val(),
                message: $form.find('textarea[name="message"]').val(),
            },
            dataType: "JSON",
            success: function(response) {
                if( response.error ){
                    result_div.html( '<div class="alert alert-danger" role="alert">'+response.error+'</div>' );
                }
                else{
                    result_div.html( '<div class="alert alert-success" role="alert">'+response.success+'</div>' );
                }
            }
        });
    });

    /* PUT BG IMAGE FROM SECTION WITH CLASS BOX_SECTION TO ITS CONTAINER */
    $('.box-section').each(function(){
        var $this = $(this);
        var bg = $this.css('background-image');
        $this.css('background-image', '');
        var $container = $this.find('.container-fluid:first');
        if( bg !== '' ){
            $container.css( 'background-image', bg );
        }
    });
	
	/* masonry */
	var $container = $('.masonry');
	$container.imagesLoaded(function() {
		$container.masonry({
			itemSelector: '.post-box',
			columnWidth: '.post-box',
			transitionDuration: 400
		});
	});

});
