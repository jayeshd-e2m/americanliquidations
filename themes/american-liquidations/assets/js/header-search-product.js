jQuery(document).ready(function ($) {

    $('.header-search-input').on('keyup', function(e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $('.product-search').trigger('click');
        }
    });

    // Search result

    $(document).on('click', function(e) {
        let target = $(e.target);

        // If the click is NOT inside the search bar area
        if (!target.closest('.header-form-cover').length) {
            $('.header-result-cover').addClass('hidden');
        }
    });

    // Optional: When typing inside input, show the result again
    $(document).on('focus', '.header-search-input', function() {
        if ($('.header-result-list').children().length > 0) {
            $('.header-result-cover').removeClass('hidden');
        }
    });
    
    $(document).on('keyup', '.header-search-input', function() {
		let query = $('.header-search-input').val();
		if (!query) return;

		$.ajax({
			url: '/wp-admin/admin-ajax.php',
			type: 'POST',
			data: {
				action: 'custom_product_search',
				keyword: query
			},
			success: function(response) {
                console.log('success');
                let resultBox = $('.header-result-cover');
                let resultList = $('.header-result-list');
                resultList.html(response.data);
                resultBox.removeClass('hidden');
			} 
		});
	});
});
