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

<?php if(!is_front_page() && ! is_product() && ! ( is_tax('product_cat', 'truckloads') || is_product_category('truckloads'))){ ?>
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
<div class="cta-block relative py-[90px]" id="subscribe-form" style="background-image: url(<?php echo $cta_bg['url']; ?>); background-size: cover;background-position: center;">
	<div class="container">
		<div class="cta-inner relative max-w-[820px] mx-auto text-center">
			<h2 class="text-white mb-5"><?php echo get_field('cta_title','option'); ?></h2>
			<div class="max-w-[720px] mx-auto text-white/60"><?php echo get_field('cta_content','option'); ?></div>
			<div class="subscribe-cover text-white mt-5">
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
					<img class="!max-w-[160px] lg:!max-w-[222px] xl:!max-w-[252px]" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
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

<!-- Popup: Only one quantity allowed in cart -->
<div id="cart-single-quantity-popup" class="cart-popup-overlay fixed bg-black/60 top-0 left-0 w-full h-full z-[9999] flex items-center justify-center" style="display: none;">
    <div class="cart-popup-content p-12 bg-white max-w-[835px] mx-auto rounded-[20px]">
        <div class="cart-popup-header flex justify-between gap-10">
            <h4>Sorry, Only one product is left.</h4>
            <button class="cart-popup-close"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt=""></button>
        </div>
        <div class="cart-popup-body font-medium text-black/40 mt-6">
            <p>It's already in your cart and you cannot add more of this product.</p>
        </div>
    </div>
</div>

<!-- Form popup -->
<div id="gf-popup-overlay" class="gf-popup-overlay">
	<div class="gf-popup-box">
		<button type="button" id="gf-popup-close" class="gf-popup-close" aria-label="Close">&times;</button>
		<div class="gf-popup-content subscribe-cover text-center">
			<h2 class="text-white mb-5">Subscribe to our <span>NEWSLETTER</span></h2>
			<div class="max-w-[720px] mx-auto text-white/60 mb-5">
				<p>Want to stay up to date on the liquidations market? Subscribe to our newsletter for free content!</p>
			</div>
			<?php echo do_shortcode('[gravityform id="3" title="false" ajax="true"]'); ?>
		</div>
	</div>
</div>

<style>
	.gf-popup-overlay {
		display: none;
		position: fixed;
		inset: 0;
		background: rgb(255 255 255 / 80%);
		z-index: 99999;
		justify-content: center;
		align-items: center;
	}
	.gf-popup-overlay.is-visible {
		display: flex;
	}
	.gf-popup-box {
		position: relative;
		background: #000;
		width: 90%;
		max-width: 600px;
		max-height: 90vh;
		overflow-y: auto;
		padding: 40px 30px 30px;
		border-radius: 8px;
		box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
	}
	.gf-popup-close {
		position: absolute;
		top: 10px;
		right: 14px;
		background: none;
		border: none;
		font-size: 28px;
		line-height: 1;
		cursor: pointer;
		color: #fff;
	}
	.gf-popup-close:hover {
		color: #e00;
	}
	.gf-popup-content.subscribe-cover .gform-footer .gform_button:hover {
		background-color: transparent;
		border-color: #fff;
	}
</style>

<script>
	(function () {
		// --- Cookie helpers ---
		function setCookie(name, value, hours) {
			var d = new Date();
			d.setTime(d.getTime() + (hours * 60 * 60 * 1000));
			document.cookie = name + "=" + value + ";expires=" + d.toUTCString() + ";path=/";
		}
		function getCookie(name) {
			var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
			return match ? match[2] : null;
		}

		var overlay = document.getElementById('gf-popup-overlay');
		var closeBtn = document.getElementById('gf-popup-close');

		// Only show if the cookie isn't set
		if (getCookie('gf_popup_closed') === null) {
			setTimeout(function () {
				overlay.classList.add('is-visible');
			}, 15000); // 15 seconds
		}

		// Close button -> hide + set 24h cookie
		closeBtn.addEventListener('click', function () {
			overlay.classList.remove('is-visible');
			setCookie('gf_popup_closed', '1', 24); // expires in 24 hours
		});

		// Optional: clicking the dark backdrop also closes it
		overlay.addEventListener('click', function (e) {
			if (e.target === overlay) {
				overlay.classList.remove('is-visible');
			}
		});
	})();
</script>

<!-- Location popup -->
 <?php
// Define your two locations here
$locations = array(
    array(
        'name'    => 'Waterbury, CT',
        'address' => '204 Austin Rd, Waterbury, CT, USA, 06705',
    ),
    array(
        'name'    => 'Milford',
        'address' => 'Milford',
    ),
);
?>
<div id="direction-popup" class="direction-popup">
    <div class="direction-popup-box">
        <button type="button" class="direction-popup-close" id="direction-popup-close" aria-label="Close">&times;</button>
        <h3 class="direction-popup-title">Choose a Location</h3>
        <div class="direction-popup-list">
            <?php foreach ( $locations as $loc ) : ?>
                <a class="direction-popup-item"
                   href="https://www.google.com/maps/dir/?api=1&destination=<?php echo rawurlencode( $loc['address'] ); ?>"
                   target="_blank" rel="noopener noreferrer">
                    <span class="direction-popup-name"><?php echo esc_html( $loc['name'] ); ?></span>
                    <span class="direction-popup-go">Get Directions →</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    .direction-popup {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.6);
        z-index: 99999;
        justify-content: center;
        align-items: center;
    }
    .direction-popup.is-visible { display: flex; }
    .direction-popup-box {
        position: relative;
        background: #fff;
        width: 90%;
        max-width: 420px;
        padding: 32px 24px 24px;
        border-radius: 10px;
        box-shadow: 0 12px 40px rgba(0,0,0,.3);
    }
    .direction-popup-close {
        position: absolute; top: 8px; right: 12px;
        background: none; border: none;
        font-size: 26px; line-height: 1; cursor: pointer; color: #333;
    }
    .direction-popup-close:hover { color: #080404; }
    .direction-popup-title { margin: 0 0 18px; text-align: center; font-size: 20px; }
    .direction-popup-list { display: flex; flex-direction: column; gap: 12px; }
    .direction-popup-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 14px 18px; border: 1px solid #ddd; border-radius: 8px;
        text-decoration: none; color: #080404; transition: all .2s ease;
    }
    .direction-popup-item:hover { background: #080404; color: #fff; border-color: #080404; }
    .direction-popup-name { font-weight: 600; }
    .direction-popup-go { font-size: 14px; opacity: .85; }
</style>

<script>
(function () {
    var btn   = document.getElementById('get-direction-btn');
    var popup = document.getElementById('direction-popup');
    var close = document.getElementById('direction-popup-close');
    if (!btn || !popup) return;

    btn.addEventListener('click', function () {
        popup.classList.add('is-visible');
    });
    close.addEventListener('click', function () {
        popup.classList.remove('is-visible');
    });
    popup.addEventListener('click', function (e) {
        if (e.target === popup) popup.classList.remove('is-visible');
    });
})();
</script>

<script>
jQuery(document).ready(function($) {
	$(document).on('click','.custom-add-to-cart', function(e) {
		console.log('clicked');
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
					addToCart(productId, quantity, $button, ajaxUrl, function() {
						setTimeout(() => {
							document.getElementById('cart-button')?.click();
						}, 1000);
					});
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
						case 'single_quantity': // <-- Add this block
							showSingleQuantityPopup();
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

	function addToCart(productId, quantity, $button, ajaxUrl, callback) {
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
					if (typeof callback === 'function') callback();
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

	function showSingleQuantityPopup() {
		$('#cart-single-quantity-popup').fadeIn(300);
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
