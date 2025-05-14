jQuery(document).ready(function($) {
  
    function loadPortfolioItem(postId, postNumber, category) {
      $.ajax({
        url: portfolio_ajax_obj.ajax_url,
        type: 'POST',
        data: {
          action: 'load_portfolio_item',
          post_id: postId,
          post_number: postNumber,
          category: category,
          nonce: portfolio_ajax_obj.nonce
        },
        success: function(response) {
          if (response.success) {
            setTimeout(function(){
              $('.portfolio-modal-body').html(response.data.html);
              initFlipDigits();
              initGallerySlider();
              $('.custom-scrollbar').mCustomScrollbar('scrollTo', 'top');
            }, 100);

          } else {
            console.log('Failed to load content. 1')
          }

        }
      });
    }
  
    // Open modal when clicking Read More button
    $(document).on('click', '.portfolio-modal-click', function() {
      $('#portfolio-modal').removeClass('hidden').addClass('flex');
      let postId = $(this).data('id');
      let postNumber = $(this).data('number') || 1;
      let category = $(this).data('category');
      postNumber = String(postNumber).padStart(2, '0');
      loadPortfolioItem(postId, postNumber, category);
      lockBodyScroll();
    });
  
    // Close modal
    $(document).on('click', '#portfolio-modal-close', function() {
      $('#portfolio-modal').addClass('hidden').removeClass('flex');
      unlockBodyScroll();
      $('.portfolio-modal-body').html("");
    });
  
    // Navigation within the modal (prev/next)
    $(document).on('click', '.nav-portfolio', function() {
      let postId = $(this).data('id');
      let category = $(this).data('category');
      let postNumber = $(this).data('number');
      loadPortfolioItem(postId, postNumber, category);
    });
  
    // Close modal on ESC key
    $(document).on('keydown', function(e) {
      if (e.key === "Escape") {
        $('#portfolio-modal').addClass('hidden').removeClass('flex');
        unlockBodyScroll();
        $('.portfolio-modal-body').html("");
      }
    });
  
    let scrollTop = 0;
  
    function lockBodyScroll() {
      scrollTop = window.scrollY || document.documentElement.scrollTop;
      const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;
  
      document.body.style.top = `-${scrollTop}px`;
      document.body.style.position = 'fixed';
      document.body.style.width = '100%';
      document.body.style.paddingRight = `${scrollBarWidth}px`;
      $('body').addClass('is-portfolio-popup');
    }
  
    function unlockBodyScroll() {
      document.body.style.position = '';
      document.body.style.top = '';
      document.body.style.width = '';
      document.body.style.paddingRight = '';
      window.scrollTo(0, scrollTop);
      $('body').removeClass('is-portfolio-popup');
    }

    //     // Function to initialize flip digits
    // function initFlipDigits() {
    //     if($('.flip-digit-wrapper').length){
    //     const counters = document.querySelectorAll('.impact-digit-cover');
    //     const duration = 2000; // 2 seconds
        
    //     const animateCounter = (el) => {
    //         const digitEl = el.querySelector('.flip-digit-wrapper');
    //         const target = parseInt(el.dataset.digit, 10);
    //         let current = 0;
    //         const frameRate = 30;
    //         const totalFrames = Math.round(duration / (1000 / frameRate));
    //         const increment = target / totalFrames;
            
    //         const counterInterval = setInterval(() => {
    //         current += increment;
    //         if (current >= target) {
    //             digitEl.textContent = target.toLocaleString('en-IN');
    //             clearInterval(counterInterval);
    //         } else {
    //             digitEl.textContent = Math.floor(current).toLocaleString('en-IN');
    //         }
    //         }, 1000 / frameRate);
    //     };
        
    //     // For modal content, trigger animation immediately without needing intersection
    //     counters.forEach(counter => {
    //         animateCounter(counter);
    //     });
    //     }
    // }
    // Function to initialize flip digits
    function initFlipDigits() {
      if ($('.flip-digit-wrapper').length) {
          const counters = document.querySelectorAll('.impact-digit-cover');
          const duration = 2000; // 2 seconds

          const animateCounter = (el) => {
              const digitEl = el.querySelector('.flip-digit-wrapper');
              const target = parseFloat(el.dataset.digit); // Use float to support decimals
              let current = 0;
              const frameRate = 30;
              const totalFrames = Math.round(duration / (1000 / frameRate));
              const increment = target / totalFrames;

              const counterInterval = setInterval(() => {
                  current += increment;
                  if (current >= target) {
                      digitEl.textContent = formatNumber(target);
                      clearInterval(counterInterval);
                  } else {
                      digitEl.textContent = formatNumber(current);
                  }
              }, 1000 / frameRate);
          };

          const formatNumber = (num) => {
              const hasDecimal = num % 1 !== 0;
              return hasDecimal
                  ? parseFloat(num).toFixed(1) // Show 1 decimal place
                  : parseInt(num).toLocaleString('en-IN');
          };

          // For modal content, trigger animation immediately without needing intersection
          counters.forEach(counter => {
              animateCounter(counter);
          });
      }
    }


    
  
  });

$(window).resize(function(){
  setTimeout(function(){
    initGallerySlider();
  })
})
  

// Initialize slick slider for gallery
function initGallerySlider() {
  if ($('.portfolio-gallery-slider .gallery-slide').length > 1) {
      $('.portfolio-gallery-slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: true,
          infinite: true,
          autoplay: false,
          speed: 500,
          fade: true,
      });
  }
}