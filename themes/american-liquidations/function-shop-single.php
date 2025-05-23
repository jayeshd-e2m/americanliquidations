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