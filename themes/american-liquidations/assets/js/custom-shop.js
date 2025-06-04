jQuery(document).ready(function($) {
    let priceScrollTimeout = null;
    let isFetching = false;

    function fetchFilteredProducts(paged = 1 ,fetch) {
        // if (isFetching) return; // prevent multiple calls
        // isFetching = true;\
        console.log(fetch);
        if (!fetch) return;
        
        const form = $('#custom-shop-filters');
        const data = form.serializeArray();
        data.push({ name: 'action', value: 'filter_shop_products' });
        data.push({ name: 'paged', value: paged });

        // Append stock status from outside the form
        const stockStatus = $('select[name="stock_status"]:visible').val() || $('select[name="stock_status"]').val();
        data.push({ name: 'stock_status', value: stockStatus });

        $('#custom-shop-results').addClass('opacity-0');
        $('#custom-shop-loader').removeClass('hidden');
        $('#custom-shop-pagination').hide();

        $.post(customShopAjax.ajaxurl, data, function(response) {
            if (response.success) {
                $('#custom-shop-results').html(response.data.products_html).removeClass('opacity-0');
                $('#custom-shop-pagination').html(response.data.pagination_html).fadeIn();
                $('.search-match-box').text(response.data.count);

                if (priceScrollTimeout) {
                    clearTimeout(priceScrollTimeout);
                }
                
                priceScrollTimeout = setTimeout(() => {
                    $('html,body').animate({
                        scrollTop: $('.shop-items-cover').offset().top
                    });
                }, 50);

            } else {
                $('#custom-shop-results').html('<p>Error loading products.</p>').fadeIn();
                $('#custom-shop-pagination').html('');
            }
            $('#custom-shop-loader').addClass('hidden');
        });
        
    }

    // Submit filters
    $('#custom-shop-filters').on('submit', function(e) {
        e.preventDefault();
        fetchFilteredProducts(1,true);
    });

    // Delegate pagination button clicks (because pagination is dynamic)
    $(document).on('click', '.pagination-button:not(.noclick)', function(e) {
        // jQuery('html,body').animate({
        //     scrollTop: jQuery('.shop-items-cover').offset().top
        // })
        e.preventDefault();
        const page = $(this).data('page');
        fetchFilteredProducts(page,true);
    });

    // Optionally trigger initial load on page ready (if needed)
    // fetchFilteredProducts(1);

    $("#price-range").ionRangeSlider({
        type: "double",
        min: 0,
        max: 10000,
        from: 100,
        to: 10000,
        prefix: "$",
        skin: "round",
        onStart: function (data) {
            $('#min-price-label').text(data.from.toLocaleString());
            $('#max-price-label').text(data.to.toLocaleString());
            $('#min-price').val(data.from);
            $('#max-price').val(data.to);
            fetchFilteredProducts(1,false);
        },
        onChange: function (data) {
            $('#min-price-label').text(data.from.toLocaleString());
            $('#max-price-label').text(data.to.toLocaleString());
            $('#min-price').val(data.from);
            $('#max-price').val(data.to);
            fetchFilteredProducts(1,false);
        },
        onFinish: function () {
            console.log('sdfsdf');
            $('#custom-shop-filters').submit();
            fetchFilteredProducts(1,true);
            // $('#custom-shop-filters').trigger('change');
        }
    });

    $('#custom-shop-filters input[type="radio"]').on('change', function () {
        
        fetchFilteredProducts(1,true);
    });
    
    $('select[name="price_low_high"]').on('change', function () {
        const val = $(this).val();
        $('[name="sort_by"]').val([val]); // update hidden form input
        $('#custom-shop-filters').trigger('submit');
    });

    $('select[name="stock_status"]').on('change', function () {
        $('#custom-shop-filters').submit(); // triggers AJAX
    });

    // Filter arrow
    jQuery('.dropdown-arrow').on('click',function(){
        if(jQuery(this).hasClass('active')){
            jQuery(this).removeClass('active');
            jQuery(this).parents('.filter-dropdown').find('.filter-dropdown-content').slideDown();
            jQuery(this).parents('.filter-dropdown').find('.price-range-wrapper').slideDown();
        }else{
            jQuery(this).addClass('active');
            jQuery(this).parents('.filter-dropdown').find('.filter-dropdown-content').slideUp();
            jQuery(this).parents('.filter-dropdown').find('.price-range-wrapper').slideUp();
        }
    })

});
