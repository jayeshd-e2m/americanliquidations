<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

?>
<?php
$my_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
$title = get_field( 'forgot_title', $my_account_page_id );
$description = get_field( 'forgot_description', $my_account_page_id );
?>
<div class="page-description-header py-12">
    <div class="container">
        <h1 class="text-[36px] md:text-[48px]"><?php echo $title ? $title : 'Forgot Password'; ?></h1>
        <?php if($description){ ?>
            <div class="mt-6">
                <p><?php echo $description; ?></p>
            </div>
        <?php } ?>
    </div>
</div>
<div class="bg-gray py-14">
	<div class="container">
		<div class="max-w-[830px] mx-auto p-8 md:p-12 bg-white rounded-[15px]">
            <?php 
                wc_print_notice( esc_html__( 'Password reset email has been sent.', 'woocommerce' ) );
            ?>
            <?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>

            <p><?php echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ) ); ?></p>

            <?php do_action( 'woocommerce_after_lost_password_confirmation_message' ); ?>
        </div>
    </div>
</div>
