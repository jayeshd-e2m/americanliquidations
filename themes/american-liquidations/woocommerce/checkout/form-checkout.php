<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="page-description-header py-12 bg-gray">
    <div class="container">
        <h1 class="text-[36px] md:text-[44px] lg:text-[48px]">Checkout</h1>
    </div>
</div>
<div class="pt-14 md:pt-24 pb-0 md:pb-24">
	<div class="container">
		<?php 
		do_action( 'woocommerce_before_checkout_form', $checkout );

		// If checkout registration is disabled and not logged in, display message
		if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
			echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
			return;
		}
		?>
		<form name="checkout" method="post" class="checkout woocommerce-checkout custom-checkout-main" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
			<div class="custom-checkout-columns flex gap-4 lg:gap-10 xl:gap-20 flex-wrap md:flex-nowrap">
				<!-- Left: Order Review -->
				<div class="checkout-left w-full md:w-[45%] xl:w-[545px]">
					<div class="checkout-left-items">
						<h3 class="checkout-title mb-10 text-primary/60 text-[24px] md:text-[32px]"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>
						<div class="custom-order-items">
							<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							</div>
							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
					</div>
				</div>
				<!-- Right: Billing Details -->
				<div class="checkout-right w-full md:w-[55%] xl:w-[calc(100%_-_545px)] border border-black/5 p-6 lg:p-12 rounded-[15px]">
					<div class="checkout-card">
						<h4 class="mb-7 lg:mb-10 text-[24px] lg:text-[32px]">Billing Details</h4>
						<?php if ( $checkout->get_checkout_fields() ) : ?>
							<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
							<div class="woocommerce-billing-fields">
								<?php
									$checkout_fields = $checkout->get_checkout_fields( 'billing' );
									// Output email field first
									if ( isset( $checkout_fields['billing_email'] ) ) {
										woocommerce_form_field( 'billing_email', $checkout_fields['billing_email'], $checkout->get_value( 'billing_email' ) );
									}
								?>
								<div class="font-bold text-[14px] mb-1.5 mt-7">Billing Address</div>
								<?php
									// Define address fields order
									$address_fields = [
										'billing_first_name',
										'billing_last_name',
										'billing_address_1',
										'billing_address_2',
										'billing_country',
										'billing_city',
										'billing_state',
										'billing_postcode',
										'billing_phone',
									];
									foreach ( $address_fields as $key ) {
										if ( isset( $checkout_fields[$key] ) ) {
											woocommerce_form_field( $key, $checkout_fields[$key], $checkout->get_value( $key ) );
										}
									}
								?>
								<div class="mt-8">
									<?php woocommerce_checkout_payment(); ?>
								</div>
								<div class="checkout-subtotal-items mt-6">
									<div class="flex justify-between mb-6">
										<span class="text-xs font-medium">Subtotal</span>
										<span class="text-xs font-medium"><?php wc_cart_totals_subtotal_html(); ?></span>
									</div>
									
									<div class="flex justify-between mb-6 asd">
									<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
										<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
											<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
											<td data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
										</tr>
									<?php endforeach; ?>

									
									<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

											<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

											<?php wc_cart_totals_shipping_html(); ?>

											<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
											
											<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
												
												<tr class="shipping">
													<th><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
													<td data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
												</tr>
												
												<?php endif; ?>
												
												<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
													<tr class="fee">
														<th><?php echo esc_html( $fee->name ); ?></th>
														<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
													</tr>
											<?php endforeach; ?>
									</div>

									<?php if ( WC()->cart->get_shipping_total() > 0 ) : ?>
									<div class="flex justify-between mb-4">
										<span class="text-xs font-medium">Shipping</span>
										<span class="text-xs font-medium checkout-shipping flex gap-2 price-font-medium"><?php wc_cart_totals_shipping_html(); ?></span>
									</div>
									<?php endif; ?>
									<div class="flex justify-between mb-12">
										<span class="font-medium">Total Due</span>
										<span class="price-font-medium"><?php wc_cart_totals_order_total_html(); ?></span>
									</div>
								</div>
							</div>
							<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
						<?php endif; ?>
						<div class="checkout-order-summary">
							<?php // Here you can add custom markup for the summary if you'd like ?>
						</div>
						<button type="submit" class="button alt confirm-payment-btn btn" name="woocommerce_checkout_place_order" id="place_order" value="<?php esc_attr_e( 'Confirm Payment', 'woocommerce' ); ?>" data-value="<?php esc_attr_e( 'Confirm Payment', 'woocommerce' ); ?>">
							<?php esc_html_e( 'Confirm Payment', 'woocommerce' ); ?>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>