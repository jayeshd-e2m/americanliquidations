<?php
/**
 * American Liquidations functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package American_Liquidations
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function american_liquidations_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on American Liquidations, use a find and replace
		* to change 'american-liquidations' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'american-liquidations', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'american-liquidations' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'american_liquidations_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'american_liquidations_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function american_liquidations_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'american_liquidations_content_width', 640 );
}
add_action( 'after_setup_theme', 'american_liquidations_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function american_liquidations_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'american-liquidations' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'american-liquidations' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'american_liquidations_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function american_liquidations_scripts() {
	wp_enqueue_style( 'american-liquidations-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'american-liquidations-style', 'rtl', 'replace' );

	wp_enqueue_script( 'american-liquidations-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'american_liquidations_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function cg_insight_scripts() {
	wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1' );

	wp_enqueue_style( 'rangeSlider-css', 'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css', array(), '1.8.1' );
	
	
	wp_enqueue_style( 'output-css', get_template_directory_uri() . '/assets/dist/output.css', array() );
    
    wp_enqueue_script( 'cleave-js', 'https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js', array('jquery'), '1.8.1', true );
	
	wp_enqueue_script( 'cleave-phone-js', 'https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/addons/cleave-phone.us.js', array('jquery'), '1.8.1', true );
	
	wp_enqueue_script( 'rangeSlider-js', 'https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js', array('jquery'), '1.8.1', true );
	
	wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );

	wp_enqueue_script( 'header-search-js', get_template_directory_uri() . '/assets/js/header-search-product.js', array('jquery'), null, true );

	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.1', true );

}
add_action( 'wp_enqueue_scripts', 'cg_insight_scripts' ); 


// Custom Gutenberg Block
require_once get_template_directory() . '/acf-blocks.php';

// Shop page function
require_once get_template_directory() . '/template-parts/shop/function-shop.php';

// Shop single page function
require_once get_template_directory() . '/function-shop-single.php';

// Myaccount function
require_once get_template_directory() . '/function-myaccount.php';

// Taxonomy Proudct
require_once get_template_directory() . '/function-product-category.php';

// Floating cart
require_once get_template_directory() . '/function-floating-cart.php';

// Register
require_once get_template_directory() . '/function-register.php';

// checkout
require_once get_template_directory() . '/function-checkout.php';


function mytheme_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mytheme_woocommerce_support' );



// Taxonomy of truckload

// Add MSRP field only if product is in the "truckloads" category
add_action('woocommerce_product_options_pricing', 'add_msrp_field_for_truckloads_category');
function add_msrp_field_for_truckloads_category() {
    global $post;

    // Check if product belongs to 'truckloads' category
    $terms = get_the_terms($post->ID, 'product_cat');
    $show_msrp = false;

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if ($term->slug === 'truckloads') {
                $show_msrp = true;
                break;
            }
        }
    }

    if ($show_msrp) {
        echo '<div class="options_group">';

        woocommerce_wp_text_input([
            'id'                => '_msrp_price',
            'label'             => __('MSRP Price', 'woocommerce'),
            'desc_tip'          => true,
            'description'       => __('Enter the MSRP (Manufacturer\'s Suggested Retail Price).'),
            'type'              => 'number',
            'custom_attributes' => [
                'step' => 'any',
                'min'  => '0'
            ]
        ]);

        echo '</div>';
    }
}

// Save the MSRP price
add_action('woocommerce_process_product_meta', 'save_msrp_field_for_truckloads');
function save_msrp_field_for_truckloads($post_id) {
    if (isset($_POST['_msrp_price'])) {
        update_post_meta($post_id, '_msrp_price', wc_clean($_POST['_msrp_price']));
    }
}



// Display the user_phone field after Nickname
add_action('show_user_profile', 'add_user_phone_profile_field');
add_action('edit_user_profile', 'add_user_phone_profile_field');
function add_user_phone_profile_field($user) {
    ?>
    <h3>Contact Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_phone"><?php esc_html_e('Phone Number', 'textdomain'); ?></label></th>
            <td>
                <input type="text" name="user_phone" id="user_phone" value="<?php echo esc_attr(get_user_meta($user->ID, 'user_phone', true)); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter the user\'s phone number.'); ?></span>
            </td>
        </tr>
    </table>
    <?php
}

// Save the user_phone field
add_action('personal_options_update', 'save_user_phone_profile_field');
add_action('edit_user_profile_update', 'save_user_phone_profile_field');
function save_user_phone_profile_field($user_id) {
    if (!current_user_can('edit_user', $user_id))
        return false;
    if (isset($_POST['user_phone'])) {
        update_user_meta($user_id, 'user_phone', sanitize_text_field($_POST['user_phone']));
    }
}



// Header Search

add_action('wp_ajax_custom_product_search', 'custom_product_search');
add_action('wp_ajax_nopriv_custom_product_search', 'custom_product_search');

function custom_product_search() {
	$keyword = sanitize_text_field($_POST['keyword']);

	$args = array(
		'post_type' => 'product',
		's' => $keyword,
		'posts_per_page' => 20,
		'post_status' => 'publish',
	);

	$query = new WP_Query($args);
	$html = '';
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$product = wc_get_product(get_the_ID());
			$image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: wc_placeholder_img_src();
			$product_link = get_permalink(get_the_ID());

			$search_term = sanitize_text_field($_POST['keyword']);
			$title = get_the_title();

			if (!empty($search_term) && strlen($search_term) >= 3) {
				$highlighted_title = preg_replace(
					'/' . preg_quote($search_term, '/') . '/i',
					'<strong class="font-bold">$0</strong>',
					$title
				);
			} else {
				$highlighted_title = esc_html($title);
			}

			$html .= '<li class="flex items-center gap-4 border-b hover:bg-gray-100">';
			$html .= '<a href="' . esc_url($product_link) . '" class="flex items-center gap-4 w-full p-2 block">';
			$html .= '<div class="w-12 h-12 flex-shrink-0">';
			$html .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '" class="object-cover w-full h-full rounded">';
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<h6 class="text-sm font-medium">' . $highlighted_title . '</h6>';
			$html .= '<span class="text-xs text-gray-500">' . $product->get_price_html() . '</span>';
			$html .= '</div>';
			$html .= '</a>';
			$html .= '</li>';
		}
		wp_reset_postdata();
	}else {
		$html = '<li class="p-4 text-center text-gray-500">No products found.</li>';
	}

	wp_send_json_success($html);
}







add_action('init', function(){
    if(!session_id()) session_start();
});


function send_2fa_code_to_email($user_id) {
    // Generate a 6-digit code
    $otp_code = wp_rand(100000, 999999); // or whatever you use
    $otp_timestamp = time(); // current Unix timestamp

    update_user_meta($user_id, 'my_2fa_otp_code', $otp_code);
    update_user_meta($user_id, 'my_2fa_otp_time', $otp_timestamp);

    // Get user email
    $user_info = get_userdata($user_id);
    $user_email = $user_info->user_email;

    // Prepare and send mail
    $subject = 'Your 2FA Verification Code';
    $message = "Your 2FA code is: $otp_code
This code is valid for 5 minutes.";
    $sent = wp_mail($user_email, $subject, $message);

    // Optionally: log, return $sent for diagnostics
    return $sent;
}


add_filter('wp_authenticate_user', function($user, $password) {
    if (!$user || is_wp_error($user)) return $user;
    $has2FA = get_user_meta($user->ID, 'user_2fa_enabled', true) === 'yes';
    if ($has2FA) {
        $_SESSION['pending_2fa_user'] = $user->ID;
        send_2fa_code_to_email($user->ID); // Make sure this function uses user_2fa_code
        return new WP_Error('2fa_required', 'Two-Factor Authentication is required. Check your email for the code.');
    }
    return $user;
}, 10, 2);


add_action('woocommerce_login_form_start', 'custom_2fa_show_code_form');
function custom_2fa_show_code_form() {
    if (!empty($_SESSION['2fa_user'])) {
        ?>
        <div class="woocommerce-Notice woocommerce-Notice--info">
            <?php _e('Enter the 2FA code sent to your email:'); ?>
        </div>
        <form method="post" class="woocommerce-form woocommerce-form-2fa">
            <p>
                <label for="2fa_code"><?php _e('2FA Code'); ?></label>
                <input type="text" name="2fa_code" id="2fa_code" required autocomplete="one-time-code">
            </p>
            <button type="submit" name="submit_2fa" class="button"><?php _e('Verify Code'); ?></button>
        </form>
        <?php
        // Prevent showing the main login form again
        echo "<script>document.querySelector('.woocommerce-form-login').style.display='none';</script>";
    }
}


add_action('init', function(){
    if(isset($_POST['submit_2fa_code']) && isset($_SESSION['pending_2fa_user'])) {
        $user_id = intval($_SESSION['pending_2fa_user']);
        $code = sanitize_text_field($_POST['code']);
        $real_code = get_user_meta($user_id, 'user_2fa_code', true);
        $expires = get_user_meta($user_id, 'user_2fa_expires', true);

        if($code == $real_code && time() < $expires) {
            // Success! Log user in.
            wp_set_auth_cookie($user_id);
            wp_set_current_user($user_id);
            delete_user_meta($user_id, 'user_2fa_code');
            delete_user_meta($user_id, 'user_2fa_expires');
            unset($_SESSION['pending_2fa_user']);
            wp_redirect(wc_get_page_permalink('myaccount'));
            exit;
        } else {
            wc_add_notice(__('Invalid or expired 2FA code.'), 'error');
        }
    }
});