<?php
defined( 'ABSPATH' ) || exit;
global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

// ACF Fields
$availability     = get_field('shop_availability');
$estimated_value  = get_field('estimated_value');
$location         = get_field('location');
$zip_code         = get_field('zip_code');

// Product Tags as Quality
$tags    = wp_get_post_terms($product->get_id(), 'product_tag');
$quality = !empty($tags) ? implode(', ', wp_list_pluck($tags, 'name')) : '';

// Check if current product is truckload
$is_truckload = has_term( 'truckloads', 'product_cat', $product->get_id() );
?>
<!-- Popup: Trying to add a truckload, but non-truckload already in cart -->
<div id="cart-conflict-popup" class="cart-popup-overlay fixed bg-black/60 top-0 left-0 w-full h-full z-[9999] flex items-center justify-center" style="display: none;">
	<div class="cart-popup-content p-12 bg-white max-w-[835px] mx-auto rounded-[20px]">
		<div class="cart-popup-header flex justify-between mb-10">
			<h4>Sorry, we cannot add that to your cart.</h4>
			<button class="cart-popup-close"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt=""></button>
		</div>
		<div class="cart-popup-body font-medium text-black/40">
			<p>We don't allow the purchase of a truckload and other products at the same time. If you would like to purchase this truckload, please pay for your existing items or remove them from your cart.</p>
		</div>
	</div>
</div>

<!-- Popup: Trying to add a non-truckload, but truckload already in cart -->
<div id="cart-truckload-conflict-popup" class="cart-popup-overlay fixed bg-black/60 top-0 left-0 w-full h-full z-[9999] flex items-center justify-center" style="display: none;">
	<div class="cart-popup-content p-12 bg-white max-w-[835px] mx-auto rounded-[20px]">
		<div class="cart-popup-header flex justify-between mb-10">
			<h4>Sorry, we cannot add that to your cart.</h4>
			<button class="cart-popup-close"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt=""></button>
		</div>
		<div class="cart-popup-body font-medium text-black/40">
			<p>We don't allow the purchase of other products when you have a truckload in your cart. If you would like to purchase other products, please pay for your existing item or remove it from your cart.</p>
		</div>
	</div>
</div>

<!-- Popup: in truckload if user not logged in -->
<div id="cart-truckload-login-popup" class="cart-popup-overlay fixed bg-black/60 top-0 left-0 w-full h-full z-[9999] flex items-center justify-center" style="display: none;">
	<div class="cart-popup-content p-12 bg-white max-w-[835px] mx-auto rounded-[20px]">
		<div class="cart-popup-header flex justify-between mb-10">
			<h4>Sorry, you cannot purchase this.</h4>
			<button class="cart-popup-close"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt=""></button>
		</div>
		<div class="cart-popup-body font-medium text-black/40">
			<p>You must have a registered account to purchase a truckload. Please click the link below to register.</p>
		</div>
		<div class="flex justify-between mt-12">
			<a href="/login" class="btn btn-red">Sign Up</a>
			<p class="text-sm">Already have an account? <a href="" class="font-bold">Sign in</a></p>
		</div>
	</div>
</div>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="container py-14">
		<div class="flex gap-12 flex-wrap md:flex-nowrap">
			<div class="shop-detail-img w-full md:w-1/2 relative">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
			<div class="shop-detail-content w-full md:w-1/2">
				<h1 class="text-[30px] font-bold mb-7 lg:mb-14"><?php the_title(); ?></h1>
				<div class="shop-detail-items space-y-5 mb-16">
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Price: </div>
						<div class="item-lable-output text-primary font-medium"><?php echo $product->get_price_html(); ?></div>
					</div>
					<?php 
					if ( $is_truckload && $product->get_meta('_msrp_price') ) {
						$msrp = $product->get_meta('_msrp_price');
						?> 
						<div class="shop-detail-item flex">
							<div class="item-lable font-medium text-black">MSRP: </div>
							<div class="item-lable-output text-black/40 font-medium"><?php echo wc_price($msrp); ?></div>
						</div>
					<?php } ?>

					<?php if ( $availability ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Availability: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $availability ); ?></div>
					</div>
					<?php endif; ?>

					<?php if ( $quality ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Quality: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $quality ); ?></div>
					</div>
					<?php endif; ?>
					
					<?php if ( $estimated_value ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Estimated Value: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $estimated_value ); ?></div>
					</div>
					<?php endif; ?>

					<?php if ( $location ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Location: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $location ); ?></div>
					</div>
					<?php endif; ?>
					
					<?php if (!$is_truckload && $product->get_meta('_msrp_price') ) { ?>
						<?php if ( $zip_code ) : ?>
						<div class="shop-detail-item flex">
							<div class="item-lable font-medium text-black">Zip Code: </div>
							<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $zip_code ); ?></div>
						</div>
						<?php endif; ?>
					<?php }else{ ?>
						<div class="shop-detail-item flex">
							<div class="item-lable font-medium text-black">Shipping: </div>
							<div class="item-lable-output text-black/40 font-medium">Calculated at checkout</div>
						</div>
					<?php } ?>
				</div>

				<form class="cart" method="post" enctype='multipart/form-data'>
					<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
					<?php
				$is_truckload = has_term( 'truckloads', 'product_cat', $product->get_id() );
				?>
				<button
					type="button"
					class="custom-add-to-cart btn-black btn btn-arrow relative"
					data-product_id="<?php echo esc_attr($product->get_id()); ?>"
					data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
					data-quantity="1"
					data-is_truckload="<?php echo $is_truckload ? '1' : '0'; ?>"
				>
					<span class="button-text">
						<?php echo $is_truckload ? 'Buy Now' : 'Add to Cart'; ?>
					</span>
					<span class="spinner hidden" aria-hidden="true"></span>
				</button>

					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				</form>

				<p class="text-black/40">Shipping will be calculated at the checkout.</p>
				<div class="flex items-center font-medium text-black/40"><span class="mr-5">Share:</span> <?php echo do_shortcode('[psfw_basic_share]'); ?></div>
			</div>
		</div>
	</div>
	<?php 
	$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt ); 
	if ( $short_description || trim(get_the_content())) {
	?>
		<div class="single-product-desc bg-gray py-14">
			<div class="container">
				<div class="flex gap-6 md:gap-12 flex-wrap md:flex-nowrap">
					<?php 
					if ( $short_description ) {?>
					<div class="w-full md:w-1/2">
						<h4 class="text-[20px] md:text-[24px] text-black/60 mb-4">Truckload Description</h4>
						<?php
						
							echo '<div class="woocommerce-product-details__short-description text-medium text-black/40">';
							echo wp_kses_post( $short_description );
							echo '</div>';
							?>
					</div>
					<?php } ?>
					<?php if (trim(get_the_content())): ?>
						<div class="w-full md:w-1/2">
							<h4 class="text-[20px] md:text-[24px] text-black/60 mb-4">More Details</h4>
							<div class="text-medium text-black/40">
								<?php the_content(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php
	$product_id = get_the_ID();
	$product_cats = wp_get_post_terms( $product_id, 'product_cat', [ 'fields' => 'ids' ] );
	$args = [
		'post_type'      => 'product',
		'posts_per_page' => 4,
		'post__not_in'   => [ $product_id ],
		'tax_query'      => [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $product_cats,
			],
		],
		'meta_query' => WC()->query->get_meta_query(),
	];

	$related_query = new WP_Query( $args );
	if ( $related_query->have_posts() ) :
	?>
		<div class="related-prouduct-items mt-12 md:mt-24 mb-12 md:mb-16">
			<div class="container">
				<h2 class="text-black md:text-black/60 mb-4 text-center md:text-left">Related Items</h2>
				<?php if($is_truckload){ $class= 'is-truck-load-product'; }else{
					$class= '';
				} ?>
				<div class="product-has-slider grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-8 md:mt-12 <?php echo $class; ?>">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<?php global $product;
						$product = wc_get_product(get_the_ID());
						set_query_var('product', $product);
						if($is_truckload){
							get_template_part('template-parts/blocks/cat-product-card'); 
						}else{
							get_template_part('template-parts/blocks/product-card'); 
						}?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	<?php
	endif;
	wp_reset_postdata();
	?>
	<div class="single-product-map mb-4">
		<div class="container">
			<div class="single-product-map-inner">
				<?php echo get_field('embedded_map'); ?>
			</div>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function($) {
	$('.custom-add-to-cart').on('click', function(e) {
		e.preventDefault();

		var $button = $(this);
		var productId = $button.data('product_id');
		var quantity = $button.data('quantity');
		var isTruckload = $button.data('is_truckload');
		// $button.prop('disabled', true).text('Adding...');

		var ajaxUrl = '';
		if (typeof wc_add_to_cart_params !== 'undefined' && wc_add_to_cart_params.ajax_url) {
			ajaxUrl = wc_add_to_cart_params.ajax_url;
		} else if (typeof ajaxurl !== 'undefined') {
			ajaxUrl = ajaxurl;
		} else {
			ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
		}

		// Check cart compatibility
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'check_cart_compatibility',
				product_id: productId,
				is_truckload: isTruckload
			},
			success: function(response) {
				const errorType = response.data?.error_type;
				if (response.success) {
					addToCart(productId, quantity, $button, ajaxUrl);
				} else {
					console.log('Error:', errorType);
					switch (errorType) {
						case 'not_logged_in':
							showTruckloadLoginPopup();
							break;
						case 'other_in_cart':
							showCartConflictPopup();
							break;
						case 'truckload_in_cart':
							showTruckloadConflictPopup();
							break;
						default:
							alert('An unexpected error occurred.');
					}
					// resetButton($button, isTruckload);
					$('.custom-add-to-cart').removeClass('loading');
				}
			},
			error: function(xhr, status, error) {
				console.log('Compatibility check error:', xhr.responseText);
				addToCart(productId, quantity, $button, ajaxUrl);
			}
		});
	});

	function addToCart(productId, quantity, $button, ajaxUrl) {
		$.ajax({
			url: ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'custom_ajax_add_to_cart',
				product_id: productId,
				quantity: quantity
			},
			success: function(response) {
				if (response.success) {
					if (response.data.fragments) {
						$.each(response.data.fragments, function(key, value) {
							$(key).replaceWith(value);
						});
					}
					$(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash, $button]);
				} else {
					if (response.data && response.data.message) {
						showTruckloadLoginPopup();
					} else {
						alert('Error adding product to cart');
					}
				}
				resetButton($button, $button.data('is_truckload'));
			},
			error: function(xhr, status, error) {
				alert('Error: ' + error);
				resetButton($button, $button.data('is_truckload'));
			}
		});
	}

	function resetButton($button, isTruckload) {
		$button.prop('disabled', false);
		if (isTruckload == 1) {
			$button.text('Buy Now');
		} else {
			$button.text('Add to Cart');
		}
	}

	function showCartConflictPopup() {
		$('#cart-conflict-popup').fadeIn(300);
	}

	function showTruckloadConflictPopup() {
		$('#cart-truckload-conflict-popup').fadeIn(300);
	}

	function showTruckloadLoginPopup() {
		$('#cart-truckload-login-popup').fadeIn(300);
	}

	$('.cart-popup-close').on('click', function() {
		$('.cart-popup-overlay').fadeOut(300);
	});

	$('.cart-popup-overlay').on('click', function(e) {
		if (e.target === this) {
			$(this).fadeOut(300);
		}
	});
});

</script>
<?php do_action( 'woocommerce_after_single_product' ); ?>