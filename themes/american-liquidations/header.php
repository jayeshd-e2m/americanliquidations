<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package American_Liquidations
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Floating cart -->
<div id="cart-dropdown" class="fixed top-0 right-[-500px] w-full max-w-[500px] bg-white shadow-lg z-[9999] h-full overflow-y-auto overflow-x-hidden flex flex-wrap content-between">
    <div>
        <div class="cart-header flex justify-between items-center p-6">
            <h6 class="text-[21px]">Cart</h6>
            <a href="javascript:;" id="header-cart-close" class="header-cart-close w-4 h-4"><img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/close-primary.svg" alt=""></a>
        </div>
		<?php if(get_field('floating_cart_content','option')){ ?>
			<div class="bg-black p-6 block text-white text-lg mb-10">
				<p><?php echo get_field('floating_cart_content','option'); ?></p>
			</div>
		<?php } ?>
        <div id="cart-items" class="p-6">
            <!-- Do not remove this div: Cart items will be inserted here via AJAX -->
        </div>
    </div>
    <div class="flex gap-2 flex-wrap p-6 w-full">
        <a href="<?php echo wc_get_cart_url(); ?>" class="block font-barlow font-bold uppercase rounded-[5px] border-2 border-black bg-transparent text-black py-4 px-10 text-center mt-2 width-full hover:bg-black hover:text-white tracking-[0.2em]">View Cart</a>
        <a href="<?php echo wc_get_checkout_url(); ?>" class="block is-arrow-white font-barlow font-bold uppercase rounded-[5px] border-2 border-primary bg-primary text-white py-4 px-10 text-center mt-2 width-full hover:bg-black hover:text-white hover:border-black tracking-[0.2em]">Checkout</a>
    </div>
</div>


<div id="page" class="site relative">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'american-liquidations' ); ?></a>
	<div class="bg-black/70 w-screen absolute left-0 top-0 h-full z-[1000] mobile-header-overlay" aria-hidden="true"></div>
	<nav aria-label="Primary navigation" class="mobile-header-nav bg-black shadow-md z-[1001] h-screen absolute left-0 top-0 w-[95%] max-w-[450px] overflow-y-auto">
		<div class="block lg:hidden">
			<div aria-label="Top promotional links" class="bg-primary space-y-6 p-6">
				<?php if(get_field('heading_1','option')){ ?>
					<div class="block text-white text-sm md:text-left font-bold"><?php echo get_field('heading_1','option'); ?></div>
				<?php } ?>
				<?php if(get_field('heading_2','option')){ ?>
					<div class="block text-white text-sm md:text-left font-bold"><?php echo get_field('heading_2','option'); ?></div>
				<?php } ?>
				<?php if(get_field('heading_3','option')){ ?>
					<div class="block text-white text-sm md:text-left font-bold"><?php echo get_field('heading_3','option'); ?></div>
				<?php } ?>

				<a href="#" class="btn w-full !text-[12px]">Get Directions</a>
			</div>
			<div class="bg-white p-4 space-y-3.5">
				<div class="flex justify-between items-center">
					<?php the_custom_logo(); ?>
					<button class="header-close-menu">
						<img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/menu-close.svg" alt="">
					</button>
				</div>

				<!-- Separator -->
				<span aria-hidden="true" class="block border-t border-black/10 w-full"></span>

				<!-- Search bar -->
				<div class="relative flex items-center border border-[#D0D5DD] rounded-lg">
					<!-- search icon -->
					<svg class="absolute top-1/2 left-3 -translate-y-1/2" width="12" height="12" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true">
						<path d="M10.8999 10.9167L8.98789 9.00468M10.3536 5.72685C10.3536 8.29143 8.27459 10.3704 5.71 10.3704C3.14541 10.3704 1.06641 8.29143 1.06641 5.72685C1.06641 3.16226 3.14541 1.08325 5.71 1.08325C8.27459 1.08325 10.3536 3.16226 10.3536 5.72685Z" stroke="#080404" stroke-opacity="0.3" stroke-width="1.09261" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
					<form class="w-full relative header-form-cover" role="search" method="get" action="<?php echo home_url('/shop/'); ?>">
						<label for="topbar-search" class="sr-only">Search site</label>
						<input id="topbar-search" type="search" name="search" placeholder="Search" autocomplete="off" class="header-search-input bg-transparent border-[#D0D5DD] py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-700 rounded-lg w-full text-sm min-w-[320px] xl:min-w-[420px] max-w-[100%]">
						<div class="header-result-cover absolute z-50 bg-white w-full top-[100%] mt-2 hidden shadow rounded-lg max-h-96 overflow-auto">
							<ul class="header-result-list"></ul>
						</div>
					</form>
				</div>

				<div class="flex justify-between items-center gap-3 mobile-phone-cart">
					<!-- Phone Number -->
					<a href="tel:2035874132" class="text-black hover:underline font-medium" itemprop="telephone" aria-label="Call us at 203-587-4132" data-jptgbfonts="{&quot;fontFamily&quot;:&quot;Inter, sans-serif&quot;,&quot;fontWeight&quot;:&quot;500&quot;,&quot;fontStyle&quot;:&quot;normal&quot;}">203-587-4132</a>
					<div class="flex items-center gap-2">
					<div class="">
						<?php
							$cart_count = WC()->cart->get_cart_contents_count();
						?>
						<a class="cart-btn btn relative" id="cart-button" href="javascript:;">CART
						<?php if($cart_count == 0){}else{ ?>
						<span id="cart-count" class="font-inter cart-count absolute top-[7px] left-[10px] bg-primary h-3 w-3 !flex items-center justify-center tracking-[0em] text-white text-[8px] rounded-full">
							<?= $cart_count; ?>
						</span>
						<?php } ?>
						</a>
					</div>
					<div class="">
						<?php if ( is_user_logged_in() ) : ?>
							<div class="has-sign-in">
								<a class="myaccount-btn btn btn-red" href="<?php echo site_url(); ?>/my-account/">My Account</a>
							</div>
						<?php else : ?>
							<div class="has-sign-in">
								<a class="sign-btn btn" href="<?php echo site_url(); ?>/my-account/" >SIGN IN</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="lg:bg-black">
			<?php
				wp_nav_menu( array(
					'menu'           => 'Header Menu',
					'menu_class'     => 'p-5 text-white text-base space-y-4',
					'container'      => false,
				) );
			?>
		</div>
	</nav>
	<header id="amliq-header" class="site-header relative z-30">
        <?php
        get_template_part( 'template-parts/partials/topbar' );

        ?>
        <?php
        get_template_part( 'template-parts/partials/header' );
        ?>
    </header><!-- #masthead -->
	
