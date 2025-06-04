<?php
// Shop page
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );

add_filter( 'woocommerce_show_page_title', function( $title ) {
    if ( is_shop() ) {
        return false;
    }
    return $title;
});

add_filter( 'woocommerce_product_tabs', 'remove_additional_info_tab', 98 );




add_action( 'woocommerce_after_single_product', 'check_related_products', 20 );
function check_related_products() {
    $related = wc_get_related_products( get_the_ID(), 4 );
    error_log( print_r( $related, true ) );
}




add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_product_add_to_cart_text' );
function custom_single_product_add_to_cart_text( $text ) {
    return __( 'Add to Cart', 'woocommerce' );
}


remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

add_filter( 'woocommerce_show_page_title', '__return_false' );


?>