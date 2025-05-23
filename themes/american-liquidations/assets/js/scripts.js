var $ = jQuery.noConflict();

jQuery(document).ready(function($){

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

})

jQuery(window).scroll(function(){
	 
})

jQuery(window).on("load",function(){
	 
});
