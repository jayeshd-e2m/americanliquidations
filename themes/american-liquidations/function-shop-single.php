<?php 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

add_filter( 'woocommerce_product_tabs', function( $tabs ) {
	unset( $tabs['reviews'] );
	return $tabs;
}, 98 );

// Remove comments template from product pages
add_filter( 'comments_template', function( $template ) {
	if ( is_singular('product') ) {
		return '';
	}
	return $template;
});


// Change "Add to cart" text to "Buy Now" for truckloads

add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_truckloads_add_to_cart_text' );

function custom_truckloads_add_to_cart_text( $text ) {
	if ( is_product() ) {
		global $post;
		if ( has_term( 'truckloads', 'product_cat', $post->ID ) ) {
			return 'Buy Now';
		}
	}
	return $text;
}









// Custom AJAX handler for adding to cart
add_action('wp_ajax_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');
add_action('wp_ajax_nopriv_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');

function custom_ajax_add_to_cart() {
    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        wp_send_json_error(array('message' => 'Missing required parameters'));
        return;
    }
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    if ($product_id <= 0 || $quantity <= 0) {
        wp_send_json_error(array('message' => 'Invalid product or quantity'));
        return;
    }
    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error(array('message' => 'Product not found'));
        return;
    }

    if (!$product->is_in_stock()) {
        wp_send_json_error([
            'message'    => 'Out of stock',
            'error_type' => 'out_of_stock'
        ]);
        return;
    }

    if (!is_user_logged_in() && has_term('truckloads', 'product_cat', $product_id)) {
        wp_send_json_error(array(
            'message'     => 'Login required to purchase truckloads',
            'error_type'  => 'not_logged_in'
        ));
        return;
    }
    
    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);
    if ($cart_item_key) {
        WC()->cart->calculate_totals();
        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();
        $fragments = array(
            'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>',
            '.cart-contents' => WC()->cart->get_cart_contents_count(),
            '.cart-total' => WC()->cart->get_cart_total()
        );
        wp_send_json_success(array(
            'message' => 'Product added to cart successfully',
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', $fragments),
            'cart_hash' => WC()->cart->get_cart_hash()
        ));
    } else {
        wp_send_json_error(array('message' => 'Failed to add product to cart'));
    }
}

// AJAX handler for cart compatibility check
add_action('wp_ajax_check_cart_compatibility', 'check_cart_compatibility');
add_action('wp_ajax_nopriv_check_cart_compatibility', 'check_cart_compatibility');

function check_cart_compatibility() {
    if (!isset($_POST['product_id']) || !isset($_POST['is_truckload'])) {
        wp_send_json_error(array('message' => 'Missing required parameters'));
        return;
    }
    $product_id = intval($_POST['product_id']);
    $is_truckload = intval($_POST['is_truckload']);

    $product = wc_get_product($product_id);

    
    if (!$product->is_in_stock()) {
        wp_send_json_error(array(
            'message'    => 'Out of stock',
            'error_type' => 'out_of_stock'
        ));
        return;
    }
    
    $cart = WC()->cart->get_cart();
    if (empty($cart)) {
        wp_send_json_success();
        return;
    }
    
    $cart_has_truckload = false;
    $cart_has_other = false;
    foreach ($cart as $cart_item_key => $cart_item) {
        $cart_product_id = $cart_item['product_id'];
        if (has_term('truckloads', 'product_cat', $cart_product_id)) {
            $cart_has_truckload = true;
        } else {
            $cart_has_other = true;
        }
    }

    if ($is_truckload && $cart_has_other) {
        wp_send_json_error(array('error_type' => 'other_in_cart'));
        return;
    } elseif (!$is_truckload && $cart_has_truckload) {
        wp_send_json_error(array('error_type' => 'truckload_in_cart'));
        return;
    }
    

    
    wp_send_json_success();
}

// Also apply this restriction to server-side add-to-cart:
add_filter('woocommerce_add_to_cart_validation', 'validate_cart_compatibility', 10, 3);
function validate_cart_compatibility($passed, $product_id, $quantity) {
    $is_truckload = has_term('truckloads', 'product_cat', $product_id);
    $cart = WC()->cart->get_cart();
    if (empty($cart)) {
        return $passed;
    }
    $cart_has_truckload = false;
    $cart_has_other = false;
    foreach ($cart as $cart_item_key => $cart_item) {
        $cart_product_id = $cart_item['product_id'];
        if (has_term('truckloads', 'product_cat', $cart_product_id)) {
            $cart_has_truckload = true;
        } else {
            $cart_has_other = true;
        }
    }
    if ($is_truckload && $cart_has_other) {
        wc_add_notice(
            __('We don\'t allow the purchase of a truckload and other products at the same time. Please pay for your existing items or remove them from your cart.', 'text-domain'),
            'error'
        );
        return false;
    } elseif (!$is_truckload && $cart_has_truckload) {
        wc_add_notice(
            __('We don\'t allow the purchase of other products when you have a truckload in your cart. If you would like to purchase other products, please pay for your existing item or remove it from your cart.', 'text-domain'),
            'error'
        );
        return false;
    }
    return $passed;
}