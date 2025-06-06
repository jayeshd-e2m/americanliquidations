<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package American_Liquidations
 */

?>

<?php if(!is_front_page() && ! is_product()){ ?>
	<section class="py-14 footer-boxes-cover">
		<div class="container">
			<div class="grid mobile-grid-1 grid-cols-2 md:grid-cols-4 gap-4">
				<?php 
				if( have_rows('swp_blocks','option') ):
					while( have_rows('swp_blocks','option') ) : the_row(); ?>
						<div class="boxes-item bg-primary/5 rounded-[10px] px-4 py-6 w-full">
							<?php 
							$image = get_sub_field('swp_icon','option');
							if( !empty( $image ) ): ?>
								<img class="mb-3" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							<?php endif; ?>
							<h6 class="opacity-60 text-[12px] mb-1 font-bold font-inter"><?php echo get_sub_field('swp_title','option'); ?></h6>
							<p class="font-medium text-black/60 text-[12px]">
								<?php echo get_sub_field('swp_content','option'); ?>
							</p>
						</div>
					<?php endwhile;
				endif;
				?>
			</div>
		</div>
	</section>
<?php } ?>

<?php $cta_bg =  get_field('cta_bg','option')?>
<div class="cta-block relative py-[90px]" style="background-image: url(<?php echo $cta_bg['url']; ?>); background-size: cover;background-position: center;">
	<div class="container">
		<div class="cta-inner relative max-w-[820px] mx-auto text-center">
			<h2 class="text-white mb-5"><?php echo get_field('cta_title','option'); ?></h2>
			<div class="max-w-[720px] mx-auto text-white/60"><?php echo get_field('cta_content','option'); ?></div>
			<div class="subscribe-cover text-white/60 mt-5">
				<?php echo do_shortcode('[gravityform id="3" title="false"]'); ?>
			</div>
		</div>
	</div>
</div>
<footer id="amliq-footer" class="bg-black pt-12 pb-5" role="contentinfo" data-jptgbcomment="1">
	<div class="container flex justify-between gap-6 lg:gap-12 flex-wrap md:flex-nowrap">
		<div class="lg:flex-1 space-y-7 w-full md:w-[30%] lg:w-[40%] xl:w-1/2">
			<!-- Site Title / Logo -->
			<a href="/" aria-label="American Liquidations">
				<?php 
				$image = get_field('footer_logo','option');
				if( !empty( $image ) ): ?>
					<img class="max-w-[160px] lg:max-w-[222px] xl:max-w-[252px]" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</a>

			<!-- Social Icons -->
			<div class="flex items-center space-x-2.5 text-[11px]">
				<?php
				if( have_rows('social_icons','option') ):
					while( have_rows('social_icons','option') ) : the_row(); ?>
					<a href="<?php echo get_sub_field('social_url','option'); ?>" class="text-primary hover:text-white">
						<?php
							echo get_sub_field('social_icon','option');
						?>
					</a>
					<?php endwhile;
				endif; ?>
			</div>

			<!-- Mission -->
				<p class="text-white/60 font-inter text-xs font-normal"><?php echo get_field('logo_content','option'); ?></p>

			<!-- Cta -->
			<div class="">
				<?php 
				$link = get_field('logo_button','option');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="btn btn-red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="w-full md:w-[70%] lg:w-[60%] xl:w-1/2 flex-1 flex justify-between gap-2 lg:gap-5 lg:mt-12 flex-col md:flex-row !mt-8 md:!mt-0">
			<div class="space-y-8 md:space-y-10">
				<!-- Shop Now Menu -->
				<div class="space-y-6">
					<span class="text-white text-xs font-bold tracking-[0.15em] font-barlow">SHOP NOW</span>
					<?php
					wp_nav_menu( array(
						'menu'           => 'Footer: Shop Now',
						'menu_class'     => 'space-y-3 lg:space-y-5 text-white/60 text-xs font-normal',
						'container'      => false,
					) );
					?>
				</div>
				<div class="space-y-6">
					<span class="text-white text-xs font-bold tracking-[0.15em] font-barlow">SOCIAL</span>

					<!-- Social Icons -->
					<div class="flex items-center space-x-2.5 text-[11px]">
						<?php
						if( have_rows('social_icons','option') ):
							while( have_rows('social_icons','option') ) : the_row(); ?>
							<a href="<?php echo get_sub_field('social_url','option'); ?>" class="text-white hover:text-primary">
								<?php
									echo get_sub_field('social_icon','option');
								?>
							</a>
							<?php endwhile;
						endif; ?>
					</div>
				</div>
			</div>
			<div class="space-y-6 mt-8 md:mt-0">
				<span class="text-white text-xs font-bold tracking-[0.15em] font-barlow">QUICK LINKS</span>
				<?php
				wp_nav_menu( array(
					'menu'           => 'Footer: QUICK LINKS',
					'menu_class'     => 'space-y-3 lg:space-y-5 text-white/60 text-xs font-normal',
					'container'      => false,
				) );
				?>
			</div>
			<div class="max-w-full md:max-w-[186px]">
				<div class="space-y-4 md:space-y-5 mt-8 md:mt-0">
					<span class="text-white text-xs font-bold tracking-[0.15em] font-barlow">CONTACT INFORMATION</span>
					<nav>
						<ul class="space-y-4 md:space-y-5">
							<li>
								<a class="text-white/60 text-xs font-normal hover:text-primary" href="#">American Liquidations</a>
							</li>
							<li>
								<a class=" text-xs text-white hover:text-primary" href="mailto:<?php echo get_field('email_address','option'); ?>"><?php echo get_field('email_address','option'); ?></a>
							</li>
							<li class="flex items-center gap-2 footer-phonenumber">
								<a class=" text-xs text-white hover:text-primary font-medium underline" href="tel:<?php echo get_field('phone_number','option'); ?>"><?php echo get_field('phone_number','option'); ?></a>
							</li>
							<li class="flex items-center gap-2 text-white text-xs font-medium footer-address">
								<?php echo get_field('address','option'); ?>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-12">
		<span class="block w-full border-t border-white/30"></span>
		<div class="flex md:justify-center lg:justify-between lg:items-center pt-8 pb-3 lg:pt-5 flex-col lg:flex-row">
			<span class="block text-sm text-white/30 mb-5 md:mb-0">
				© 2025&nbsp;American Liquidations
			</span>
			<?php
				wp_nav_menu( array(
					'menu'           => 'Footer: Bottom Menu',
					'menu_class'     => 'flex flex-col md:flex-row md:items-center gap-5 items-start text-white/30 text-sm font-normal mt-3 lg:mt-0',
					'container'      => false,
				) );
			?>
		</div>
	</div>
</footer>
</div><!-- #page -->

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
		<div class="flex justify-between mt-12 items-center">
			<a href="<?php echo site_url(); ?>/my-account/register/" class="btn btn-red">Sign Up</a>
			<p class="text-sm">Already have an account? <a href="<?php echo site_url(); ?>/my-account" class="font-bold">Sign in</a></p>
		</div>
	</div>
</div>

<div id="cart-out-of-stock-popup" class="cart-popup-overlay fixed bg-black/60 top-0 left-0 w-full h-full z-[9999] flex items-center justify-center" style="display: none;">
	<div class="cart-popup-content p-12 bg-white max-w-[835px] mx-auto rounded-[20px]">
		<div class="cart-popup-header flex justify-between gap-10">
			<h4>Sorry, This product is out of stock.</h4>
			<button class="cart-popup-close"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt=""></button>
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
				console.log(response.data);
				if (response.success) {
					addToCart(productId, quantity, $button, ajaxUrl);
					setTimeout(function(){
						document.getElementById('cart-button')?.click();
					},1000)
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
						case 'out_of_stock':
							showOutOfStockPopup();
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

	function showOutOfStockPopup() {
		$('#cart-out-of-stock-popup').fadeIn(300);
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

<?php wp_footer(); ?>

</body>
</html>
