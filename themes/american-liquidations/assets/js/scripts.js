var $ = jQuery.noConflict();

jQuery(document).ready(function($){

	var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	if (isIOS) {
		$('body').addClass('ios-device');
	}

	serviceSlider();

	// Mobile Menu JS

	$( '.hamburger' ).click( function( event ) {
		$(this).toggleClass('is-close');
		$( '.site-header nav' ).toggleClass( 'is-open' );
		$('.site-header').toggleClass('is-menu-open');
	} );
	$('#page').css('margin-top',jQuery('.site-header').outerHeight());


	// Service popup equalheight
	etEqualHeightInH4Row();

	// Cookies 

	const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('accept-cookies');
    const declineBtn = document.getElementById('decline-cookies');

    if (!localStorage.getItem('cookiesAccepted')) {
      banner.classList.add('active');
    }

    acceptBtn.addEventListener('click', function () {
      localStorage.setItem('cookiesAccepted', 'true');
      banner.classList.remove('active');
    });

    declineBtn.addEventListener('click', function () {
      banner.classList.remove('active');
    });




})

jQuery(window).scroll(function(){
	if(jQuery(this).scrollTop() > 200){
		jQuery('.site-header').addClass('is-header-sticky');
	}else{
		jQuery('.site-header').removeClass('is-header-sticky');
	}
})

jQuery(window).on("load",function(){
	
	setTimeout(function(){
		const hash = window.location.hash;
		
		if (hash) {
			const slug = hash.substring(1); // remove the '#' character
			const button = $('.read-service-btn[data-slug="'+slug+'"]');
			console.log(slug);
			if (button.length) {
				button.trigger('click');
			}

			if($('.portfolio-modal-click').length){
				$('.portfolio-modal-click[data-slug="'+slug+'"]').trigger('click');
			}
		}
	},1500)
	customScrollbar();
});

jQuery(window).on("resize",function(){
	setTimeout(function(){
		customScrollbar();
	},200)
});

function customScrollbar(){
	if(jQuery(".team-modal-item").length){
		$(".team-modal-item").mCustomScrollbar({
			theme: "light", // or "mCS-light"
			advanced: {
				disableOnMobile: false
			}
		});
	}
	if(jQuery(".service-modal-item").length){
		$(".service-modal-item").mCustomScrollbar({
			theme: "light", // or "mCS-light"
			advanced: {
				disableOnMobile: false
			}
		});
	}
	if(jQuery(".portfolio-custom-scrollbar").length){
		// jQuery(".portfolio-custom-scrollbar").mCustomScrollbar();
		$(".portfolio-custom-scrollbar").mCustomScrollbar({
		theme: "light", // or "mCS-light"
		advanced: {
			disableOnMobile: false
		}
		});
	}
}



jQuery(document).ready(function ($) {
	// Hero Section
		function clamp(value, min, max) {
			return Math.min(Math.max(value, min), max);
		}

		function setupHeroBlockAnimation($section) {
			const $span1 = $section.find('.hero-block-span-1');
			const $span2 = $section.find('.hero-block-span-2');
			const $span3 = $section.find('.hero-block-span-3');

			function handleScroll() {
				const rect = $section[0].getBoundingClientRect();
				const windowHeight = $(window).height();
				const isMobile = $(window).width() <= 767;

				const sectionStart = isMobile ? 100 : windowHeight / 3;
				const sectionEnd = isMobile
				? -($section.outerHeight() - windowHeight / 3)
				: -($section.outerHeight() - windowHeight / 2);

				const progress = clamp((rect.top - sectionStart) / (sectionEnd - sectionStart), 0, 1);

				const scale1 = 1 + progress * (2.1 - 1);
				const scale2 = 1 + progress * (1.4 - 1);
				const scale3 = 1 + progress * (1.15 - 1);

				$span1.css('transform', `scale(${scale1})`);
				$span2.css('transform', `scale(${scale2})`);
				$span3.css('transform', `scale(${scale3})`);
			}

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
				if (entry.isIntersecting) {
					$(window).on('scroll resize', handleScroll);
					handleScroll();
				} else {
					$(window).off('scroll resize', handleScroll);
				}
				});
			}, {
				threshold: 0.1
			});

			observer.observe($section[0]);
		}
	  
	  // Setup all sections
	  $('.hero-block-img').each(function () {
		setupHeroBlockAnimation($(this));
	  });


	//   Difference animation

	function clampd(value, min, max) {
		return Math.min(Math.max(value, min), max);
	}

	function setupHeroBlockAnimationd($section) {
		const $span1 = $section.find('.diff-block-span-1');
		const $span2 = $section.find('.diff-block-span-2');
		const $span3 = $section.find('.diff-block-span-3');

		function handleScrolld() {
			const rect = $section[0].getBoundingClientRect();
			const windowHeight = $(window).height();
			const isMobile = $(window).width() <= 767;

			const sectionStart = isMobile ? windowHeight / 2 : windowHeight - 100;
			const sectionEnd = isMobile
			? -($section.outerHeight() - windowHeight / 3)
			: -($section.outerHeight() - windowHeight / 2);

			const progress = clampd((rect.top - sectionStart) / (sectionEnd - sectionStart), 0, 1);

			const scale1 = 1 + progress * (2.7 - 1);
			const scale2 = 1 + progress * (2.2 - 1);
			const scale3 = 1 + progress * (1.45 - 1);

			$span1.css('transform', `scale(${scale1})`);
			$span2.css('transform', `scale(${scale2})`);
			$span3.css('transform', `scale(${scale3})`);
		}

		const observerd = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
			if (entry.isIntersecting) {
				$(window).on('scroll resize', handleScrolld);
				handleScrolld();
			} else {
				$(window).off('scroll resize', handleScrolld);
			}
			});
		}, {
			threshold: 0.1
		});

		observerd.observe($section[0]);
	}
  
	// Setup all sections
	$('.diff-block-img').each(function () {
		setupHeroBlockAnimationd($(this));
	});
	  


	// Flip digit setup
	if($('.flip-digit-wrapper').length){
	
		const counters = document.querySelectorAll('.impact-digit-cover');
		const duration = 1000; // 1 seconds

		const animateCounter = (el) => {
			const digitEl = el.querySelector('.impact-digit');
			const target = parseInt(el.dataset.digit, 10);
			let current = 0;
			const frameRate = 30;
			const totalFrames = Math.round(duration / (1000 / frameRate));
			const increment = target / totalFrames;

			const counterInterval = setInterval(() => {
			current += increment;
			if (current >= target) {
				digitEl.textContent = target.toLocaleString('en-IN');
				clearInterval(counterInterval);
			} else {
				digitEl.textContent = Math.floor(current).toLocaleString('en-IN');
			}
			}, 1000 / frameRate);
		};

		const observer = new IntersectionObserver((entries, obs) => {
			entries.forEach(entry => {
			if (entry.isIntersecting) {
				animateCounter(entry.target);
				obs.unobserve(entry.target);
			}
			});
		}, { threshold: 0.5 });

		counters.forEach(counter => observer.observe(counter));

	}

	// Portfolio section animation
	if($('.portfolio-section').length){
	const $portfolioSection = $('.portfolio-section')[0];

	const observer2 = new IntersectionObserver(entries => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				const $left = $('.portfolio-left');
				const $right = $('.portfolio-right');

				$left.removeClass('opacity-0').addClass('animate-slide-top-full');
				$right.removeClass('opacity-0').addClass('animate-slide-bottom-full');

				observer2.unobserve(entry.target); // Animate once
			}
		});
	}, {
		root: null,
		rootMargin: "0px 0px -35% 0px",
		threshold: 0
	});

	observer2.observe($portfolioSection);
	}


	// Animation effect
	if ($('.animate-slide-up').length) {
		const isMobile = window.innerWidth <= 768; // You can adjust this breakpoint as needed
	  
		const aniObserver = new IntersectionObserver((entries) => {
		  entries.forEach(entry => {
			if (entry.isIntersecting) {
			  entry.target.classList.add('active');
			}
		  });
		}, {
		  threshold: 0.3,
		  rootMargin: isMobile ? "0px 0px 30px 0px" : "0px 0px -20% 0px"
		});
	  
		document.querySelectorAll('.animate-slide-up').forEach(el => {
		  aniObserver.observe(el);
		});
	  }
});


jQuery(window).on('load resize', function () {
    //setEqualHeight(jQuery('.service-items-cover')); // Target class
	setTimeout(function(){
		etEqualHeightInH4Row();
	},200)
});


function etEqualHeightInH4Row() {
	const rows = document.querySelectorAll(".service-popup-cnt .wp-block-columns");
  
	rows.forEach(row => {
	  const columns = row.querySelectorAll("h4:not(.wp-block-heading)");
	  let maxHeight = 0;
  
	  // Reset heights to auto before recalculating
	  columns.forEach(col => {
		col.style.height = 'auto';
	  });
  
	  // Get the tallest column height
	  columns.forEach(col => {
		const height = col.offsetHeight;
		if (height > maxHeight) maxHeight = height;
	  });
  
	  // Apply the tallest height to all columns
	  columns.forEach(col => {
		col.style.height = maxHeight + "px";
	  });
	});
  }


jQuery(window).on('resize', function() {
	setTimeout(function(){
		serviceSlider();
	},1000)
});


function serviceSlider() {
	if(jQuery('.service-item-slider')){
		var $slider = jQuery('.service-item-slider');

		if (jQuery(window).width() < 767) {
			if (!$slider.hasClass('slick-initialized')) {
				$slider.slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3,
					dots: false,
					arrows: false,
					responsive: [
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}
					]
				});
			}
		} else {
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}
		}

		var $slider2 = jQuery('.portfolio-category-row');

		if(jQuery(window).width() < 1023){
			if (!$slider2.hasClass('slick-initialized')) {
				$slider2.slick({
					infinite: true,
					slidesToShow: 3,
					slidesToScroll: 3, 
					dots: false,
					arrows: false,
					responsive: [
						{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
						},
						{
							breakpoint: 575,
							settings: {
							slidesToShow: 1,
							slidesToScroll: 1
							}
						},
					]
				});
			}
		}else{
			if ($slider2.hasClass('slick-initialized')) {
				$slider2.slick('unslick');
			}
		}
	}
}