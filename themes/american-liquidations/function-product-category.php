<?php 
function custom_shopitem_shortcode( $atts ) {
    // Get the shortcode attributes
    $atts = shortcode_atts( array(
        'cat'      => '',
        'orderby'  => 'date',
        'order'    => 'DESC',
        'per_page' => 12,
        'paged'    => '', 
    ), $atts, 'shopitem' );

    // Start output buffering
    ob_start();

    $paged = 1;

    if ( $atts['paged'] !== '' ) {
        $paged = max( 1, (int) $atts['paged'] );
    } else {
        $q_paged = get_query_var( 'paged' );
        $p_paged = get_query_var( 'page' ); // needed on some setups (static front page)
        $paged   = max( 1, (int) $q_paged, (int) $p_paged );
    }

    // Build the query args
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => (int) $atts['per_page'],
        'paged'          => $paged,
        'orderby' => sanitize_text_field( $atts['orderby'] ),
        'order' => sanitize_text_field( $atts['order'] ),
    );

    if ( ! empty( $atts['cat'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( $atts['cat'] ),
            ),
        );
    }

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

        $base = trailingslashit( home_url( add_query_arg( array(), $GLOBALS['wp']->request ) ) );

        echo paginate_links( array(
            'base'      => $base . 'page/%#%/',
            'format'    => '',
            'current'   => max( 1, get_query_var('paged'), get_query_var('page') ),
            'total'     => $query->max_num_pages,
            'type'      => 'list',
        ) );

    } else {
        echo '<p class="text-center">No products found in this category.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'shopitem', 'custom_shopitem_shortcode' );
