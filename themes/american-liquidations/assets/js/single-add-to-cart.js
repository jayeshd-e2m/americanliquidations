// jQuery(function ($) {
// 	function checkMixedCartNotice() {
// 		const errorMessages = $('.woocommerce-error li');

// 		errorMessages.each(function () {
// 			const msg = $(this).text().trim();
// 			if (msg === 'mixed_cart_blocked') {
// 				$('.woocommerce-error').remove(); // Remove default Woo message
// 				showTruckloadRestrictionPopup();
// 			}
// 		});
// 	}

// 	function showTruckloadRestrictionPopup() {
// 		if ($('#truckload-popup').length) return; // Avoid duplicates

// 		const popupHtml = `
// 			<div id="truckload-popup" style="position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.6); display:flex; justify-content:center; align-items:center; z-index:9999;">
// 				<div style="background:#fff; padding:30px; max-width:500px; text-align:center; border-radius:8px; position:relative;">
// 					<h2 style="color:#c00; font-size:24px; margin-bottom:15px;">Sorry, we cannot add that to your cart.</h2>
// 					<p style="font-size:16px; color:#333;">We don't allow the purchase of a truckload and other products at the same time. If you would like to purchase this truckload, please pay for your existing items or remove them from your cart.</p>
// 					<button id="close-truckload-popup" style="margin-top:20px; padding:10px 20px; background:#000; color:#fff; border:none; border-radius:4px; cursor:pointer;">Close</button>
// 				</div>
// 			</div>
// 		`;

// 		$('body').append(popupHtml);

// 		$('#close-truckload-popup').on('click', function () {
// 			$('#truckload-popup').remove();
// 		});
// 	}

// 	// Trigger check after WooCommerce updates fragments (after AJAX add to cart)
// 	$(document.body).on('wc_fragments_refreshed', function () {
// 		checkMixedCartNotice();
// 	});
// });
