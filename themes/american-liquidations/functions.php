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