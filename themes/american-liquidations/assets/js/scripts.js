var $ = jQuery.noConflict();

jQuery(document).ready(function($){


	var clickable = $( '.menu-state' ).attr( 'data-clickable' );
	$( '.mobile-header-nav li:has(ul)' ).addClass( 'has-sub' );
	$( '.mobile-header-nav .has-sub>a' ).after( '<em class="caret">' );
	$( '.mobile-header-nav .has-sub>.caret' ).addClass( 'trigger-caret' );
	

	/* menu open and close on single click */
	$( '.mobile-header-nav .has-sub>.trigger-caret' ).click( function() {
		var element = $( this ).parent( 'li' );
		if ( element.hasClass( 'is-open' ) ) {
			element.removeClass( 'is-open' );
			element.find( 'li' ).removeClass( 'is-open' );
			element.find( 'ul' ).slideUp( 200 );
		}
		else {
			element.addClass( 'is-open' );
			element.children( 'ul' ).slideDown( 200 ) ;
			element.siblings( 'li' ).children( 'ul' ).slideUp( 200 );
			element.siblings( 'li' ).removeClass( 'is-open' );
			element.siblings( 'li' ).find( 'li' ).removeClass( 'is-open' );
			element.siblings( 'li' ).find( 'ul' ).slideUp( 200 );
		}
	} );







	if($('.brand-slider').length){
		$('.brand-slider').slick({
			dots: false,
			infinite: false,
			speed: 300,
			slidesToShow: 6,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				}
			]
		});
	}

	// Mobile Menu
	jQuery('.mobile-humberger').on('click',function(){
		jQuery('.mobile-header-nav').addClass('active');
		jQuery('.mobile-header-overlay').addClass('active');
		jQuery('body').addClass('menu-active');
	})

	jQuery('.header-close-menu, .mobile-header-overlay').on('click',function(){
		jQuery('.mobile-header-nav').removeClass('active');
		jQuery('.mobile-header-overlay').removeClass('active');
		jQuery('body').removeClass('menu-active');
	})


	// product add to cart button

	$(document).on('click', '.custom-add-to-cart', function(e) {
        var $btn = $(this);
        $btn.addClass('loading');
    });

    // WooCommerce event after item added to cart via AJAX
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        $button.removeClass('loading');
    });

})

jQuery(window).scroll(function(){
	 
})

jQuery(window).on("load",function(){
	 
});
