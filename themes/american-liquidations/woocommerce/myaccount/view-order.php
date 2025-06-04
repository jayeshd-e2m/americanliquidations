<?php
/**
 * View Order
 * (Modified for custom summary)
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();

$order_id      = $order->get_id();
$order_status  = wc_get_order_status_name( $order->get_status() );
$order_date    = $order->get_date_created() ? $order->get_date_created()->date( 'F j, Y' ) : '';
$order_total   = $order->get_formatted_order_total();
$shipping      = $order->get_shipping_method();
$tracking      = ''; // Default

// Try to get tracking number if you use Shipment Tracking plugin
if ( $tracking_items = $order->get_meta( '_wc_shipment_tracking_items', true ) ) {
	if ( is_array( $tracking_items ) && ! empty( $tracking_items ) ) {
		$tracking = esc_html( $tracking_items[0]['tracking_number'] );
	}
}

// Receipt Button (link to order received page)
$receipt_url = $order->get_checkout_order_received_url();
$is_completed = $order->has_status( 'completed' );

?>
<div class="bg-white p-7 md:p-12 rounded-[15px]">
	<div class="flex items-center justify-between flex-wrap md:flex-nowrap gap-6">
		<div class="flex items-center gap-2">
			<span class="text-[10px] font-semibold">Order Status: </span> 
			<span class="status-<?php echo esc_attr( $order->get_status() ); ?>">
				<span class="!w-auto"><?php echo esc_html( $order_status ); ?></span>
			</span>
		</div>
		<div>
			<?php if ( $is_completed ) : ?>
				<?php
				echo '<div class="flex items-center gap-2">';
				// Receipt button (change to your PDF/receipt url if needed)
				$order_id = $order->get_id();
				$access_key = 'bae469a797';

				if ( $access_key ) {
					$pdf_url = add_query_arg( array(
						'action'       => 'generate_wpo_wcpdf',
						'document_type'=> 'invoice',
						'order_ids'    => $order_id,
						'access_key'   => $access_key,
					), admin_url( 'admin-ajax.php' ) );
					
					echo '<a href="' . esc_url( $pdf_url ) . '" class="btn btn-red btn-small !capitalize !tracking-[0px] !font-semibold receipt-download whitespace-nowrap" target="_blank"><img src="'.site_url().'/wp-content/uploads/2025/06/receipt-icon.svg" /><span>Receipt</span></a>';
				}
				// View Details
				echo '</div>';
				?>
			<?php endif; ?>
		</div>
	</div>
	<div class="mt-12">
		<h5 class="text-[20px] text-black/60 mb-4 font-inter">Order Info</h5>
		<div class="text-sm">
			<?php do_action( 'woocommerce_view_order', $order_id ); ?>
		</div>
	</div>
	<div class="grid grid-cols-2 gap-3">
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Order ID</h5>
			<p class="text-sm font-normal">#<?php echo esc_html( $order_id ); ?></p>
		</div>
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Cost</h5>
			<p class="text-sm font-normal"><?php echo wp_kses_post( $order_total ); ?></p>
		</div>
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Tracking Number</h5>
			<p class="text-sm font-normal"><?php echo $tracking ? esc_html( $tracking ) : 'N/A'; ?></p>
		</div>
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Date</h5>
			<p class="text-sm font-normal"><?php echo esc_html( $order_date ); ?></p>
		</div>
	</div>
	<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Shipping</h5>
			<p class="text-sm font-normal"><?php echo esc_html( $shipping ); ?> - 
				<?php $shipping_total = $order->get_shipping_total();
				echo wc_price( $shipping_total ); ?>
    		</p>
		</div>
		<div class="mb-10">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Have question your order? </h5>
			<p class="text-sm leading-[1.8em] font-normal">Contact us here: <br><strong><a href="mailto:email@domain.com"><u>email@domain.com</u></a>
			<br>203-587-4132</strong></p>
		</div>
		<div class="mb-0">
			<h5 class="text-[20px] text-black/60 mb-4 font-inter">Payment method</h5>
			<p class="text-sm font-normal"><?php echo esc_html( $order->get_payment_method_title() ); ?></p>
		</div>
	</div>
</div>