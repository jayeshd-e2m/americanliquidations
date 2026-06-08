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
        echo '<div class="mobile-grid-1 grid grid-cols-2 xl:grid-cols-3 gap-x-5 gap-y-12">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $product = wc_get_product( get_the_ID() );
			if ( $product ) {
				set_query_var( 'product', $product );
				get_template_part( 'template-parts/blocks/cat-product-card' );
			}
        }
        echo '</div>';

        echo render_custom_pagination_buttons( $query );

    } else {
        echo '<p class="text-center">No products found in this category.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'shopitem', 'custom_shopitem_shortcode' );


function custom_pagination_base_url() {
    global $wp;

    // Current path without domain, e.g. "product-category/truckloads/page/2"
    $path = $wp->request;

    // Remove trailing /page/{number} from the path
    $path = preg_replace( '#/page/\d+/?$#', '', $path );

    // Build clean base URL, e.g. https://site.com/product-category/truckloads/
    return trailingslashit( home_url( $path ) );
}


function render_custom_pagination_buttons( $query ) {
    if ( ! $query || $query->max_num_pages <= 1 ) return '';

    $current = max( 1, (int) get_query_var('paged'), (int) get_query_var('page') );
    $base    = custom_pagination_base_url();
    $total   = (int) $query->max_num_pages;

    // Decide which pages to show (similar to your example)
    $pages = array(1);

    for ( $i = max( 2, $current - 2 ); $i <= min( $total - 1, $current + 2 ); $i++ ) {
        $pages[] = $i;
    }

    if ( $total > 1 ) $pages[] = $total;

    $pages = array_values( array_unique( $pages ) );
    sort( $pages );

    ob_start(); ?>
    <div class="mt-10 flex justify-center gap-2">
        <div class="mt-10 flex justify-center gap-2">
            <?php
            $prev = null;
            foreach ( $pages as $p ) {

                if ( $prev && $p > $prev + 1 ) {
                    echo '<span class="pagination-ellipsis px-2 py-2">...</span>';
                }

                $url = ( $p === 1 ) ? $base : trailingslashit( $base . 'page/' . $p );

                $common = 'px-4 py-2 border rounded hover:bg-black hover:text-white';

                if ( $p === $current ) {
                    printf(
                        '<span class="%s bg-black text-white noclick" aria-current="page">%d</span>',
                        esc_attr( $common ),
                        (int) $p
                    );
                } else {
                    printf(
                        '<a class="%s bg-white" href="%s" data-page="%d">%d</a>',
                        esc_attr( $common ),
                        esc_url( $url ),
                        (int) $p,
                        (int) $p
                    );
                }

                $prev = $p;
            }
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


