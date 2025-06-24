<?php
// Shortcode to render the initial shop page with sidebar and product grid + pagination container
function custom_shop_shortcode($atts) {
    // $result = custom_ajax_shop_products(); // Default product load

    $atts = shortcode_atts([
        'cat' => ''
    ], $atts);

    $preselected_cat = sanitize_text_field($atts['cat']);

    // Pass $preselected_cat to AJAX product function
    $result = custom_ajax_shop_products(['category' => $preselected_cat,'search' => isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '',]);

    $count = $result['count'];
    ob_start();
    ?>
    <div class="shop-wrapper py-12 lg:py-24">
        <div class="container text-center mb-7 lg:mb-24 featured-product-heading">
            <h2>Featured Products</h2>
        </div>
        <div class="container flex gap-3 justify-center mb-8 md:hidden flex-wrap md:flex-nowrap">
            <div class="flex justify-end">
                <div class="border border-[#D0D5DD] rounded-[8px] flex items-center py-[10px] px-[10px] md:px-[20px]">
                    <span class="text-[14px] font-semibold flex items-center">
                        <img class="mr-1 md:mr-2" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/filter-by.svg" alt="">
                        <span class="w-[80px] text-black/30">Filter by: </span>
                    </span>
                    <select name="stock_status" id="stock-status-mobile" class="w-full border-none outline-none text-sm text-black font-semibold">
                        <option value="">Stock</option>
                        <option value="instock">In</option>
                        <option value="outofstock">Out</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <div class="border border-[#D0D5DD] rounded-[8px] flex items-center py-[10px] px-[10px] md:px-[20px]">
                    <span class="text-[14px] font-semibold flex items-center">
                        <img class="mr-1 md:mr-2" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/sort-by-price.svg" alt="">
                        <span class="w-[75px] text-black/30">Sort by:</span>
                    </span>
                    <select  name="price_low_high" id="sort-price-dropdown-mobile" class="w-full border-none outline-none text-sm text-black font-semibold">
                        <option value="">Price</option>
                        <option value="price_asc">Low</option>
                        <option value="price_desc">High</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container flex gap-8 2xl:gap-12 flex-wrap md:flex-nowrap">
            <div class="shop-sidebar w-full md:w-[275px] xl:w-[355px] bg-gray p-8 2xl:p-12 rounded-[15px] pl-0">
                <div class="filter-wrapper">
                    <div class="filter-search mb-10">
                        <h4 class="mb-3 text-black/60 text-[24px]">Search Products</h4>
                        <p class="font-medium opacity-[40%]">
                            Store / Search : <span class="search-match-box"><?php echo esc_html($count); ?></span> Matches
                        </p>
                    </div>
                    <?php 
                    set_query_var('preselected_cat', $preselected_cat);
                    get_template_part('template-parts/shop/filters'); 
                    ?>
                </div>
            </div>
            <div class="shop-items-cover w-full md:w-[calc(100%_-_275px)] xl:w-[calc(100%_-_355px)] pr-0">
				<div class="shop-items-header hidden md:flex items-end justify-end gap-5  mb-10">
					<div class="flex justify-end">
						<div class="border border-[#D0D5DD] rounded-[8px] flex items-center py-[10px] px-[20px] gap-2">
							<span class="text-[14px] font-semibold flex items-center">
								<img class="mr-2" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/filter-by.svg" alt="">
                                <span class="w-[80px] text-black/30">Filter by: </span>
							</span>
							<select name="stock_status" id="stock-status-desktop" class="w-full border-none outline-none text-black font-semibold">
								<option value="">Stock</option>
								<option value="instock">In</option>
								<option value="outofstock">Out</option>
							</select>
						</div>
					</div>
					<div class="flex justify-end">
						<div class="border border-[#D0D5DD] rounded-[8px] flex items-center py-[10px] px-[20px] gap-2">
							<span class="text-[14px] font-semibold flex items-center">
								<img class="mr-2" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/sort-by-price.svg" alt="">
                                <span class="w-[75px] text-black/30">Sort by:</span>
							</span>
							<select name="price_low_high" id="sort-price-dropdown-desktop" class="w-full border-none outline-none text-black font-semibold">
								<option value="">Price</option>
								<option value="price_asc">Low</option>
								<option value="price_desc">High</option>
							</select>
						</div>
					</div>
				</div>
                <div id="custom-shop-loader" class="hidden text-center py-8 sticky top-[50%]">
                    <svg class="mx-auto animate-spin h-8 w-8 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </div>
                <div class="mobile-grid-1 grid grid-cols-2 xl:grid-cols-3 gap-x-5 gap-y-12" id="custom-shop-results">
                    <?php echo $result['products_html']; ?>
                </div>
                <div id="custom-shop-pagination" class="mt-10 flex justify-center gap-2">
                    <?php echo $result['pagination_html']; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($) {
        const initialCategory = $('#initial_category').val();
        if (initialCategory) {
            $(`input[name="categories"][value="${initialCategory}"]`).prop('checked', true);
        }
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_shop', 'custom_shop_shortcode');


// Function to get filtered products and pagination HTML separately
function custom_ajax_shop_products($filters = []) {
    $paged = !empty($filters['paged']) ? intval($filters['paged']) : 1;

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => 15,
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    $tax_query = [];
    $meta_query = [];

    // Preselected category from shortcode
    if (!empty($filters['category'])) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($filters['category']),
        ];
    }

    // Category from filters (overrides preselected if present)
    if (!empty($filters['categories'])) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => is_array($filters['categories']) ? array_map('sanitize_text_field', $filters['categories']) : [sanitize_text_field($filters['categories'])],
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Price filtering
    if (!empty($filters['min_price'])) {
        $meta_query[] = [
            'key'     => '_price',
            'value'   => floatval($filters['min_price']),
            'compare' => '>=',
            'type'    => 'NUMERIC',
        ];
    }

    if (!empty($filters['max_price'])) {
        $meta_query[] = [
            'key'     => '_price',
            'value'   => floatval($filters['max_price']),
            'compare' => '<=',
            'type'    => 'NUMERIC',
        ];
    }

    // Stock status
    if (!empty($filters['stock_status'])) {
        $meta_query[] = [
            'key'     => '_stock_status',
            'value'   => sanitize_text_field($filters['stock_status']),
            'compare' => '=',
        ];
    }

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    // Sorting
    if (!empty($filters['sort_by'])) {
        switch ($filters['sort_by']) {
            case 'price_asc':
                $args['orderby']  = 'meta_value_num';
                $args['meta_key'] = '_price';
                $args['order']    = 'ASC';
                break;
            case 'price_desc':
                $args['orderby']  = 'meta_value_num';
                $args['meta_key'] = '_price';
                $args['order']    = 'DESC';
                break;
            case 'name_asc':
                $args['orderby'] = 'title';
                $args['order']   = 'ASC';
                break;
            case 'name_desc':
                $args['orderby'] = 'title';
                $args['order']   = 'DESC';
                break;
            case 'newest':
                $args['orderby'] = 'date';
                $args['order']   = 'DESC';
                break;
        }
    }

    if (!empty($filters['search'])) {
        $args['s'] = $filters['search'];
    }

    // Query products
    $query = new WP_Query($args);

    // Products HTML
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $product = wc_get_product(get_the_ID());
            set_query_var('product', $product);
            get_template_part('template-parts/blocks/product-card');
        }
    } else {
        echo '<p>No products found.</p>';
    }
    $products_html = ob_get_clean();

    // Pagination HTML
    ob_start();
    if ($query->max_num_pages > 1) {
        $visible = 2; // how many pages visible at ends
        $adjacents = 2; // adjacents to current page

        echo '<div class="custom-pagination mt-10 flex justify-center gap-2">';
        for ($i = 1; $i <= $query->max_num_pages; $i++) {
            // Show first pages, last, and range around current page
            if (
                $i <= $visible || // start
                $i > $query->max_num_pages - $visible || // end
                abs($i - $paged) <= $adjacents // around current page
            ) {
                echo '<button class="pagination-button px-4 py-2 border rounded hover:bg-black hover:text-white ' . ($i == $paged ? 'bg-black text-white noclick' : 'bg-white') . '" data-page="' . $i . '">' . $i . '</button>';
                $dots = true;
            } elseif ($dots) {
                // only output ... once
                echo '<span class="pagination-ellipsis px-2 py-2">...</span>';
                $dots = false;
            }
        }
        echo '</div>';
    }
    $pagination_html = ob_get_clean();

    wp_reset_postdata();

    return [
        'products_html'   => $products_html,
        'pagination_html' => $pagination_html,
        'count'           => $query->found_posts,
    ];
}


// AJAX handler
function handle_ajax_shop_filter() {
    $filters = [
        'categories' => isset($_POST['categories']) ? sanitize_text_field($_POST['categories']) : '',
        'min_price'  => sanitize_text_field($_POST['min_price']),
        'max_price'  => sanitize_text_field($_POST['max_price']),
        'sort_by'    => sanitize_text_field($_POST['sort_by']),
        'paged'      => isset($_POST['paged']) ? intval($_POST['paged']) : 1,
		'stock_status' => isset($_POST['stock_status']) ? sanitize_text_field($_POST['stock_status']) : '',
        'search' => isset($_POST['initial_search']) ? sanitize_text_field($_POST['initial_search']) : '',
    ];

    $output = custom_ajax_shop_products($filters);

    wp_send_json_success([
        'products_html'   => $output['products_html'],
        'pagination_html' => $output['pagination_html'],
        'count'           => $output['count'],
    ]);
}
add_action('wp_ajax_filter_shop_products', 'handle_ajax_shop_filter');
add_action('wp_ajax_nopriv_filter_shop_products', 'handle_ajax_shop_filter');


// Enqueue JS and localize AJAX URL
function custom_shop_enqueue_scripts() {
    wp_enqueue_script('custom-shop-ajax', get_template_directory_uri() . '/assets/js/custom-shop.js', ['jquery'], null, true);
    wp_localize_script('custom-shop-ajax', 'customShopAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'custom_shop_enqueue_scripts');


// Remove default WooCommerce hooks (optional)
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

?>
