<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<div class="account-tabs-header mb-7">
	<?php echo get_field('myacc_content'); ?>
</div>
<div class="account-tabs-cover grid grid-cols-1 md:grid-cols-2 gap-5">
	<?php 
	if( have_rows('myacc_tabs') ):
	while( have_rows('myacc_tabs') ) : the_row(); 
	$url = get_sub_field('url');
	?>
		<?php if($url){ ?>
			<a href="<?php echo $url['url']; ?>" class="account-tab-item p-7 md:p-12 bg-white rounded-[10px]">
		<?php }else{ ?>
			<div class="account-tab-item bg-white rounded-[10px] p-7 md:p-12">
		<?php } ?>
			<div class="account-tab-img mb-7">
				<?php 
				$image = get_sub_field('icon');
				if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</div>
			<div class="acccount-tab-heading mb-6">
				<h5 class="font-inter font-medium text-[25px] text-black/60"><?php echo get_sub_field('title'); ?></h5>
			</div>
			<p class="text-sm text-black/60"><?php echo get_sub_field('content'); ?></p>
		<?php if($url){ ?>
			</a>
		<?php }else{ ?>
			</div>
		<?php } ?>
	<?php endwhile;
	endif; ?>
</div>
<p>
	<?php
	// printf(
	// 	/* translators: 1: user display name 2: logout url */
	// 	wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
	// 	'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
	// 	esc_url( wc_logout_url() )
	// );
	?>
</p>

<p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	// $dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	// if ( wc_shipping_enabled() ) {
	// 	/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
	// 	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	// }
	// printf(
	// 	wp_kses( $dashboard_desc, $allowed_html ),
	// 	esc_url( wc_get_endpoint_url( 'orders' ) ),
	// 	esc_url( wc_get_endpoint_url( 'edit-address' ) ),
	// 	esc_url( wc_get_endpoint_url( 'edit-account' ) )
	// );
	?>
</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
