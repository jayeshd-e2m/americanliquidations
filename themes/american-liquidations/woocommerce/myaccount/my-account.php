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

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
//do_action( 'woocommerce_account_navigation' ); ?>

<?php
// Map WooCommerce My Account endpoints to custom labels
$account_sections = array(
    ''                 => 'Account',
    'dashboard'        => 'Account',
    'orders'           => 'Orders',
    'downloads'        => 'Downloads',
    'edit-address'     => 'Addresses',
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
?>
<div class="page-description-header py-12">
	<div class="container">
		<p>My Account<?php if($section_title != 'Account') { echo ' > ' . esc_html($section_title); } ?></p>
		<div class="flex justify-between items-center">
			<h1 class="text-[36px] md:text-[48px]"><?php echo esc_html($section_title); ?></h1>
			<?php
				$current_user = wp_get_current_user();
				$username     = $current_user->user_login;
				$email        = $current_user->user_email;
			?>
			<div class="pd-header-user text-sm flex items-center gap-6">
				<span class="capitalize"><?php echo esc_html( $username ); ?></span>
				<span><a href="mailto:<?php echo esc_html( $email ); ?>" class="text-primary underline"><?php echo esc_html( $email ); ?></a></span>
			</div>
		</div>
	</div>
</div>
<div class="woocommerce-custom-account bg-gray py-24">
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
