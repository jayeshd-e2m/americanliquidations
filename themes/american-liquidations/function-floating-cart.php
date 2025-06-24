<?php 


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('custom-cart', get_template_directory_uri() . '/assets/js/cart.js', ['jquery'], null, true);
    wp_localize_script('custom-cart', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);
});

// Fetch Cart Items
add_action('wp_ajax_fetch_cart_items', 'fetch_cart_items');
add_action('wp_ajax_nopriv_fetch_cart_items', 'fetch_cart_items');

function fetch_cart_items() {
    WC()->cart->calculate_totals(); // ✅ Ensure totals are recalculated
    $cart_items = WC()->cart->get_cart();
    ob_start();
    echo "<div class='cart-item-cover'>";
    if (!empty($cart_items)) {
        $total_discount = 0;
        foreach ($cart_items as $key => $item) {
            // Get product object (variation if set)
            $product = wc_get_product($item['variation_id'] ? $item['variation_id'] : $item['product_id']);
            $qty = $item['quantity'];
        
            // Discounted price actually used in cart (dynamic pricing plugins update this)
            $line_price = $item['line_total'] / $qty;
        
            // Reference/original price (regular price; fallback to get_price if missing)
            $original_price = $product->get_regular_price();
            if (!$original_price) {
                $original_price = $product->get_price();
            }
        
            // Show current price and original price (if discounted)
            $price_html = wc_price($line_price);
            if ($original_price > $line_price) {
                $price_html .= ' <del class="text-[#C8C8C8] text-sm">' . wc_price($original_price) . '</del>';
            }
        
            // Thumbnail and product URL
            $thumb = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail')[0];
            $url = get_permalink($item['product_id']);
        
            // Render HTML
            echo "<div class='cart-item flex gap-6 mb-12 relative' data-cart-key='$key'>";
            $thumb_url = !empty($thumb) ? $thumb : site_url() . '/wp-content/uploads/2025/06/placeholder-img.png';
            echo "<div class='flex h-full'>
                <img class='rounded-[5px] h-[60px] w-[60px] object-cover' src='$thumb_url' />
            </div>";
            echo "<div class='flex-1 pr-3'>
                <a href='$url' class='text-lg font-semibold text-[#444] hover:text-primary block mb-2 leading-[1.3em] font-barlow'>{$product->get_name()}</a>";
        
                echo "<p class='text-lg text-primary items-center gap-2 font-barlow' >";
                echo "<span class='text-[#C8C8C8]'>{$qty} ×</span> {$price_html}";
                echo "</p>";
                if(get_field('location', $product->get_id())){
                    echo "<span class='text-[12px] font-semibold mt-1.5 flex items-center gap-1 text-[#C8C8C8] font-barlow is-location'><img width='8' src='".site_url()."/wp-content/uploads/2025/05/location.svg' alt=''>".get_field('location', $product->get_id())."</span>";
                }
                echo "
            </div>";
            echo "<button class='w-[16px] remove-item text-primary' data-cart-key='$key'>
                <img class='remove-icon hover:opacity-60' src='".site_url()."/wp-content/uploads/2025/05/cart-delete.svg' />
                <span class='hidden woo-loading w-4 h-4 border-2 border-t-transparent animate-spin rounded-full block relative left-[-1px]'></span>
            </button>";
            echo "</div>";
        }
        echo "</div>";
        // Subtotal
        $cart_subtotal = WC()->cart->get_subtotal();
        $amount_needed2 = 150 - $cart_subtotal;
        if ( $cart_subtotal < 150 ) {
            echo "<h6 class='text-primary font-semibold mt-4 text-center'>Add $".$amount_needed2." amount for discount</h6>";
        }
        echo "<div class='cart-subtotal flex justify-center items-center py-3 pt-6'>
            <span class='text-2xl font-semibold text-[#444]'>Subtotal: <span class='text-primary cart-sub-total-text'>" . WC()->cart->get_cart_subtotal() . "</span></span>
        </div>";
        ?>

        <?php 
        $cart_subtotal = WC()->cart->get_subtotal();
        //if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <?php //endif; ?>
       <?php
    } else {
        echo "<p class='text-center text-gray-500'>Your cart is empty.</p>";
    }

    $html = ob_get_clean();
    $cart_count = WC()->cart->get_cart_contents_count();

    wp_send_json_success([
        'cart_html' => $html,
        'cart_count' => $cart_count
    ]);
    wp_die();
}

// Remove item from cart
add_action('wp_ajax_remove_cart_item', 'custom_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'custom_remove_cart_item');

function custom_remove_cart_item() {
    if (isset($_POST['cart_key'])) {
        WC()->cart->remove_cart_item(sanitize_text_field($_POST['cart_key']));
        WC()->cart->calculate_totals();
    }
    wp_die();
}

?>