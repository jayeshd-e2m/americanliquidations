jQuery(document).ready(function($) {

    function fetchFilteredProducts(paged = 1) {
        const form = $('#custom-shop-filters');
        const data = form.serializeArray();
        data.push({ name: 'action', value: 'filter_shop_products' });
        data.push({ name: 'paged', value: paged });

        // Append stock status from outside the form
        const stockStatus = $('select[name="stock_status"]').val();
        data.push({ name: 'stock_status', value: stockStatus });

        $('#custom-shop-results').hide();
        $('#custom-shop-loader').removeClass('hidden');
        $('#custom-shop-pagination').hide();

        $.post(customShopAjax.ajaxurl, data, function(response) {
            if (response.success) {
                $('#custom-shop-results').html(response.data.products_html).fadeIn();
                $('#custom-shop-pagination').html(response.data.pagination_html).fadeIn();
                $('.search-match-box').text(response.data.count);
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
        fetchFilteredProducts(1);
    });

    // Delegate pagination button clicks (because pagination is dynamic)
    $(document).on('click', '.pagination-button', function() {
        jQuery('html,body').animate({
            scrollTop: jQuery('.shop-items-cover').offset().top
        })
        const page = $(this).data('page');
        fetchFilteredProducts(page);
    });

    // Optionally trigger initial load on page ready (if needed)
    // fetchFilteredProducts(1);

    $("#price-range").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: 100,
        to: 1000,
        prefix: "$",
        skin: "round",
        onStart: function (data) {
            $('#min-price-label').text(data.from);
            $('#max-price-label').text(data.to);
            $('#min-price').val(data.from);
            $('#max-price').val(data.to);
        },
        onChange: function (data) {
            $('#min-price-label').text(data.from);
            $('#max-price-label').text(data.to);
            $('#min-price').val(data.from);
            $('#max-price').val(data.to);
        },
        onFinish: function () {
            $('#custom-shop-filters').submit();
            // $('#custom-shop-filters').trigger('change');
        }
    });

    $('#custom-shop-filters').on('change', 'select', function () {
        fetchFilteredProducts(1);
    });
    
    $('#sort-price-dropdown').on('change', function () {
        const val = $(this).val();
        $('[name="sort_by"]').val([val]); // update hidden form input
        $('#custom-shop-filters').trigger('submit');
    });

    $('select[name="stock_status"]').on('change', function () {
        fetchFilteredProducts(1);
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
