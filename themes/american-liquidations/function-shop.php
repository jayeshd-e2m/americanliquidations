<?php
// Shop page
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_empty_string' );


add_filter( 'woocommerce_product_tabs', 'remove_additional_info_tab', 98 );

function remove_additional_info_tab( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}



add_action( 'woocommerce_after_single_product', 'check_related_products', 20 );
function check_related_products() {
    $related = wc_get_related_products( get_the_ID(), 4 );
    error_log( print_r( $related, true ) );
}


add_filter( 'woocommerce_product_tabs', 'custom_gallery_tab_if_exists' );
function custom_gallery_tab_if_exists( $tabs ) {
    global $product;

    $attachment_ids = $product->get_gallery_image_ids();

    if ( ! empty( $attachment_ids ) ) {
        $tabs['product_gallery_tab'] = array(
            'title'    => __( 'Gallery', 'woocommerce' ),
            'priority' => 50,
            'callback' => 'custom_gallery_tab_content'
        );
    }

    return $tabs;
}

function custom_gallery_tab_content() {
    // global $product;

    // $attachment_ids = $product->get_gallery_image_ids();

    // if ( ! empty( $attachment_ids ) ) {
    //     echo '<div class="custom-gallery-tab-images flex flex-wrap">';
    //     foreach ( $attachment_ids as $attachment_id ) {
    //         $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
	// 		echo '<div class="custom-gallery-img-cover">';
	// 			echo '<div class="custom-gallery-img-ratio">';
    //         		echo '<img src="' . esc_url( $image_url ) . '" alt="" class="gallery-image" style="max-width:100%;margin-bottom:10px;">';
	// 			echo '</div>';
	// 		echo '</div>';
    //     }
    //     echo '</div>';
    // } else {
    //     echo '<p>' . __( 'No gallery images available.', 'woocommerce' ) . '</p>';
    // }

    if( have_rows('product_gallery') ){
        echo '<div class="custom-gallery-tab-images flex flex-wrap">';
        while( have_rows('product_gallery') ) : the_row();
            $image = get_sub_field('image');
            echo '<div class="custom-gallery-img-cover">';
				echo '<div class="custom-gallery-img-ratio">';
            		echo '<img src="' . esc_url( $image['url'] ) . '" alt="" class="gallery-image" style="max-width:100%;margin-bottom:10px;">';
				echo '</div>';
			echo '</div>';
        endwhile;
        echo '</div>';
    }else{
        echo '<p>No image found!</p>';
    }
}

// FAQ tab in product single page
add_filter( 'woocommerce_product_tabs', 'add_faq_product_tab' );
function add_faq_product_tab( $tabs ) {
    global $product;

    // if ( have_rows( 'product_faqs', $product->get_id() ) ) {
        $tabs['product_faqs'] = array(
            'title'    => __( 'FAQs', 'your-textdomain' ),
            'priority' => 50,
            'callback' => 'render_product_faqs_tab'
        );
    // }

    return $tabs;
}

function render_product_faqs_tab() {
    global $product;

	if ( have_rows( 'product_faqs', $product->get_id() ) ) {
        echo '<div class="faq-block-container p-[25px] lg:p-[50px] bg-green-5 rounded-[15px]">';
        echo '<div class="faq-list">';

        $index = 1;

        while ( have_rows( 'product_faqs', $product->get_id() ) ) {
            the_row();
            $question = get_sub_field( 'question' );
            $answer   = get_sub_field( 'answer' );

            $tab_id = 'tab' . $index;

            echo '<div class="faq-item mb-6 lg:mb-[48px]">';
            echo '<h6 class="faq-question relative font-semibold mb-[20px] faq_active pr-7 cursor-pointer" rel="' . esc_attr( $tab_id ) . '">' . esc_html( $question ) . '</h6>';
            echo '<div id="' . esc_attr( $tab_id ) . '" class="faq-answer">';
            echo wp_kses_post( wpautop( $answer ) );
            echo '</div>';
            echo '</div>';

            $index++;
        }

        echo '</div>';
		?>
		
		<?php
        echo '</div>';
    }else{
        echo '<div class="faq-block-container p-[25px] lg:p-[50px] bg-green-5 rounded-[15px]">';
        echo '<div class="faq-list">';

        $index = 1;

        if( have_rows('pro_faqs','option') ):
            while( have_rows('pro_faqs','option') ) : the_row();
                $question = get_sub_field( 'question','option' );
                $answer   = get_sub_field( 'answer','option' );

                $tab_id = 'tab' . $index;

                echo '<div class="faq-item mb-6 lg:mb-[48px]">';
                echo '<h6 class="faq-question relative font-semibold mb-[20px] faq_active pr-7 cursor-pointer" rel="' . esc_attr( $tab_id ) . '">' . esc_html( $question ) . '</h6>';
                echo '<div id="' . esc_attr( $tab_id ) . '" class="faq-answer">';
                echo wp_kses_post( wpautop( $answer ) );
                echo '</div>';
                echo '</div>';

                $index++;
            endwhile; 
        endif;
        echo '</div>';
		?>
		
		<?php
        echo '</div>';
    } ?>
    <style>
        .faq-question:after{content:'';background-image:url('/wp-content/uploads/2025/04/arrow-down.svg');background-repeat:no-repeat;background-position:center;display:inline-block;position:absolute;right:0px;width: 13px;height: 13px;top: 4px;transform: rotate(-90deg);background-size: 12px;}
        .faq_active.faq-question:after{content:'';transform:rotate(180deg);}
        .faq-answer p{font-weight: 500;font-size: 14px;line-height: 25px;}
        .faq-list .faq-item:last-child{margin-bottom:0px !important;} 
        .faq-list .faq-item:last-child .faq-question{margin-bottom:0px !important;} 
        .faq-list .faq-item:last-child .faq_active.faq-question{margin-bottom:20px !important;} 
        .faq-answer ol,
        .faq-answer ul{
            font-size: 14px;
        }
        @media only screen and (max-width: 1023px) {
            .faq-answer ul li,
            .faq-answer ol li{
                font-size: 14px !important; 
            }
        }
        @media only screen and (max-width: 767px) {
        .accordion_title{flex-direction: column;}
        .accordion_title a{margin-top: 25px;    max-width: 155px;}
        }
    </style>
    <script>
        jQuery(".faq-answer").hide();
        jQuery(".faq-answer:first").show();
        jQuery(".faq-question").on("click", function() {      
            jQuery(".faq-answer").hide();
            var d_activeTab = jQuery(this).attr("rel"); 
            jQuery("#"+d_activeTab).fadeIn();
            
            jQuery(".faq-question").removeClass("faq_active");
            jQuery(this).addClass("faq_active");
        });
    </script>
    <?php
}


// Breadcrumb Woo
add_filter('woocommerce_breadcrumb_defaults', 'custom_woo_breadcrumb_separator');
function custom_woo_breadcrumb_separator($defaults) { 
    $defaults['delimiter'] = ' <span class="bread-and">&gt;</span> '; // custom span separator
    return $defaults;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_product_add_to_cart_text' );
function custom_single_product_add_to_cart_text( $text ) {
    return __( 'Add to Cart', 'woocommerce' );
}


?>