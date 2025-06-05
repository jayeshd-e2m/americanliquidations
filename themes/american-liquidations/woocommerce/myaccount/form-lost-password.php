<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="page-description-header py-12">
	<div class="container">
		<h1 class="text-[36px] md:text-[48px]">Forgot Password</h1>
        <div class="mt-6">
			<p>Track your orders, checkout faster, and sync your favorites. Just enter your email and we’ll send you a special link that will sign you in instantly.</p>
        </div>
    </div>
</div>
<div class="bg-gray py-14 lost-password-cover">
	<div class="container">
		<div class="max-w-[830px] mx-auto p-8 md:p-12 bg-white rounded-[15px]">
			<?php do_action( 'woocommerce_before_lost_password_form' ); ?>
			<form method="post" class="woocommerce-ResetPassword lost_reset_password">

				<p class="text-base mb-6"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

				<p class="woocommerce-form-row woocommerce-form-row--first form-row">
					<label for="user_login" class="text-black/60 text-sm font-semibold"><?php esc_html_e( 'Username or Email Address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text !border-[#080404]/5 w-full !rounded-lg" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
				</p>

				<div class="clear"></div>

				<?php do_action( 'woocommerce_lostpassword_form' ); ?>

				<div class="flex justify-between items-center pt-8 md:pt-12 flex-wrap lg:flex-nowrap">
					<p class="woocommerce-form-row form-row w-full md:w-auto">
						<input type="hidden" name="wc_reset_password" value="true" />
						<button type="submit" class="btn btn-red btn-arrow width-full md:w-auto<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Send confirmation Code', 'woocommerce' ); ?>"><?php esc_html_e( 'Send confirmation Code', 'woocommerce' ); ?></button>
					</p>

					<div class="text-sm mt-3 md:mt-0"><a href="<?php echo site_url(); ?>/my-account/">Go back and <strong>Sign in</strong></a></div>
				</div>

				<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

			</form>
		</div>
	</div>
</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
