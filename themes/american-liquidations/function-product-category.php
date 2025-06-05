<?php 
function custom_shopitem_shortcode( $atts ) {
    // Get the shortcode attributes
    $atts = shortcode_atts( array(
        'cat'   => '',     // category slug
        'limit' => 12,     // number of products
        'columns' => 4,    // number of columns
        'orderby' => 'date',
        'order' => 'DESC',
    ), $atts, 'shopitem' );

    // Start output buffering
    ob_start();

    // Build the query args
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => intval( $atts['limit'] ),
        'orderby' => sanitize_text_field( $atts['orderby'] ),
        'order' => sanitize_text_field( $atts['order'] ),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( $atts['cat'] ),
            ),
        ),
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<div class="grid mobile-grid-1 grid-cols-2 lg:grid-cols-4 gap-x-5 gap-y-5 md:gap-y-12">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $product = wc_get_product( get_the_ID() );
			if ( $product ) {
				set_query_var( 'product', $product );
				get_template_part( 'template-parts/blocks/cat-product-card' );
			}
        }
        echo '</div>';
    } else {
        echo '<p>No products found in this category.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'shopitem', 'custom_shopitem_shortcode' );
