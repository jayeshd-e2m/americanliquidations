<?php
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
        $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
        ?>
        <div class="flex gap-3 md:gap-7 mb-6">
            <div class="w-14 h-14 flex-shrink-0 rounded-md overflow-hidden">
                <a href="<?php echo $product_permalink; ?>"><?php echo $_product->get_image('shop_thumbnail', array('class' => 'w-[60px] object-cover rounded-md !h-[60px]')); ?></a>
            </div>
            <div class="flex-1">
                <div class="text-lg font-semibold text-black block mb-2 leading-[1.3em] font-barlow"><a href="<?php echo $product_permalink; ?>"><?php echo $_product->get_name(); ?></a></div>
                <div class="text-lg text-black items-center font-medium gap-2 font-barlow">
                    <?php
                    $regular_price = $_product->get_regular_price();
                    $sale_price    = $_product->get_sale_price();
                    $qty           = $cart_item['quantity'];

                    // Total prices for quantity
                    $regular_total = $regular_price ? $regular_price * $qty : 0;
                    $sale_total    = $sale_price ? $sale_price * $qty : 0;

                    // Are we on sale?
                    if ( $sale_price && (float) $sale_price < (float) $regular_price ) {
                        echo '<span class="line-through text-[#C8C8C8] text-sm pr-2">' . wc_price($regular_total) . '</span>';
                        echo '<span class="text-lg">' . wc_price($sale_total) . '</span>';
                    } else {
                        // Not on sale
                        echo '<span class="font-semibold text-gray-900">' . wc_price($regular_total) . '</span>';
                    }
                    ?>
                    <?php if(get_field('location', $_product->get_id())){ ?>
                        <span class="text-[12px] font-semibold flex items-center gap-1 text-[#C8C8C8] font-barlow is-location"><img width="8" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/location.svg" alt=""><?php echo get_field('location', $_product->get_id()); ?></span>
                    <?php } ?>
                </div>
            </div>
            <a class="p-4" href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" 
               class="ml-5 text-red-400 hover:text-red-600 transition" 
               aria-label="<?php esc_attr_e( 'Remove this item', 'woocommerce' ); ?>">
               <img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/cart-delete.svg" alt="">
            </a>
        </div>
        <?php
    }
endforeach;
?>