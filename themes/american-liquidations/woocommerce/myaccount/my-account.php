<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

global $wp;
if ( isset( $wp->query_vars['login'] ) ) {
    if ( is_user_logged_in() ) {
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
    wc_get_template( 'myaccount/form-login.php' );
    return;
}

// Check for register endpoint
if ( isset( $wp->query_vars['register'] ) ) {
    if ( is_user_logged_in() ) {
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;
    }
    wc_get_template( 'myaccount/form-register.php' );
    return;
}

// If user is not logged in and not on login/register pages, redirect to login
if ( ! is_user_logged_in() ) {
    wp_redirect( site_url( '/my-account/login/' ) );
    exit;
}

// Map WooCommerce My Account endpoints to custom labels
$account_sections = array(
    ''                 => 'Account',
    'dashboard'        => 'Account',
    'orders'           => 'Orders',
    'downloads'        => 'Downloads',
    'edit-address'     => 'Addresses',
    'business-profile' => 'Business Profile',
    'address-book'     => 'Address Book',
    'edit-account'     => 'Personal Settings',
    'customer-logout'  => 'Logout',
    // add more endpoints as needed
);

global $wp;

$current_endpoint = '';
if ( ! empty( $wp->query_vars ) ) {
    foreach ( $wp->query_vars as $key => $value ) {
        if ( array_key_exists( $key, $account_sections ) ) {
            $current_endpoint = $key;
            break;
        }
    }
}


// Fallback to dashboard if none found
$section_title = $account_sections[ $current_endpoint ] ?? 'My Account';
$endpoint = isset( $_GET['view-order'] ) || ( isset( $wp->query_vars['view-order'] ) );
$order_id = absint( get_query_var('view-order') );

// Is it the view order page?
if ( is_wc_endpoint_url( 'view-order' ) && $order_id ) {
    // Do NOT display the default description header
    // Output your custom banner:
?>
<div class="page-description-header py-12">
	<div class="container">
		<p class="mb-5 md:mb-0">
            <a href="<?php echo site_url();?>/my-account">My Account</a>
            <?php echo ' > <a href="'.site_url().'/my-account/orders/">Orders</a> > <strong> Order#'.esc_html( $order_id ).'</strong>'; ?>
        </p>
		<div class="flex justify-between items-center flex-wrap md:flex-nowrap gap-6 md:gap-10">
			<h1 class="text-[36px] md:text-[48px]">Order#<?php echo esc_html( $order_id ); ?></h1>
		</div>
	</div>
</div>

<?php }else{ ?>
    <div class="page-description-header py-12">
        <div class="container">
            <p class="mb-5 md:mb-0">
                <a href="<?php echo site_url();?>/my-account">My Account</a>
                <?php if($section_title != 'Account') { echo ' > <strong>' . esc_html($section_title).'</strong>'; } ?>
            </p>
            <div class="flex justify-between items-center flex-wrap md:flex-nowrap gap-6 md:gap-10">
                <h1 class="text-[36px] md:text-[48px]"><?php echo esc_html($section_title); ?></h1>
                <?php
                    $current_user = wp_get_current_user();
                    $username     = $current_user->user_login;
                    $email        = $current_user->user_email;
                ?>
                <div class="pd-header-user text-sm flex items-center gap-6 justify-between md:justify-normal w-full md:w-auto flex-wrap md:flex-nowrap">
                    <span class="capitalize"><?php echo esc_html( $username ); ?></span>
                    <span><a href="mailto:<?php echo esc_html( $email ); ?>" class="text-primary hover:text-primary/60 underline"><?php echo esc_html( $email ); ?></a></span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="woocommerce-custom-account bg-gray py-14">
	<div class="container">
		<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
		?>
		

	</div>
</div>
