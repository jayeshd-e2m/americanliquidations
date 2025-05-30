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


<?php $cta_bg =  get_field('cta_bg','option')?>
<div class="cta-block relative py-[50px] md:py-[90px]" style="background-image: url(<?php echo $cta_bg['url']; ?>); background-size: cover;">
	<div class="container">
		<div class="cta-inner relative max-w-[820px] mx-auto text-center">
			<h2 class="text-white mb-5"><?php echo get_field('cta_title','option'); ?></h2>
			<div class="text-white max-w-[720px] mx-auto"><?php echo get_field('cta_content','option'); ?></div>
			<div class="subscribe-cover text-white mt-5">
				Subscribe form goes here
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
				<p class="text-white/60 font-inter text-xs"><?php echo get_field('logo_content','option'); ?></p>

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
			<div class="space-y-8 md:space-y-12">
				<!-- Shop Now Menu -->
				<div class="space-y-7">
					<span class="text-white text-xs font-bold tracking-[0.15em]">SHOP NOW</span>
					<?php
					wp_nav_menu( array(
						'menu'           => 'Footer: Shop Now',
						'menu_class'     => 'space-y-3 lg:space-y-7 text-white/60 text-sm font-normal',
						'container'      => false,
					) );
					?>
				</div>
				<div class="space-y-7">
					<span class="text-white text-xs font-bold tracking-[0.15em]">SOCIAL ICONS</span>

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
			<div class="space-y-7 mt-8 md:mt-0">
				<span class="text-white text-xs font-bold tracking-[0.15em]">QUICK LINKS</span>
				<?php
				wp_nav_menu( array(
					'menu'           => 'Footer: QUICK LINKS',
					'menu_class'     => 'space-y-3 lg:space-y-7 text-white/60 text-sm font-normal',
					'container'      => false,
				) );
				?>
			</div>
			<div class="max-w-[186px]">
				<div class="space-y-4 md:space-y-7 mt-8 md:mt-0">
					<span class="text-white text-xs font-bold tracking-[0.15em]">CONTACT INFORMATION</span>
					<nav>
						<ul class="space-y-4 md:space-y-7">
							<li>
								<a class="text-white/60 text-sm font-normal hover:text-white" href="#">American Liquidations</a>
							</li>
							<li>
								<a class=" text-xs text-white hover:text-primary" href="mailto:<?php echo get_field('email_address','option'); ?>"><?php echo get_field('email_address','option'); ?></a>
							</li>
							<li class="flex items-center gap-2">
								<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.7553 11.6782L12.8503 11.4607C12.6263 11.4344 12.3993 11.4592 12.1862 11.5333C11.9732 11.6073 11.7797 11.7287 11.6203 11.8882L10.2403 13.2682C8.11134 12.1852 6.38084 10.4547 5.29779 8.32572L6.68529 6.93822C7.00779 6.61572 7.16529 6.16572 7.11279 5.70822L6.89529 3.81822C6.85293 3.45229 6.67739 3.11474 6.40214 2.86992C6.12689 2.6251 5.77117 2.49012 5.40279 2.49072H4.10529C3.25779 2.49072 2.55279 3.19572 2.60529 4.04322C3.00279 10.4482 8.12529 15.5632 14.5228 15.9607C15.3703 16.0132 16.0753 15.3082 16.0753 14.4607V13.1632C16.0828 12.4057 15.5128 11.7682 14.7553 11.6782Z" fill="#FB0404"></path>
								</svg>
								<a class=" text-xs text-white hover:text-primary font-medium underline" href="tel:<?php echo get_field('phone_number','option'); ?>"><?php echo get_field('phone_number','option'); ?></a>
							</li>
							<li class="flex items-center gap-2 text-white text-xs font-medium">
								<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.21233 15.5049C8.57277 15.8023 8.94867 16.0741 9.3335 16.3394C9.71915 16.0777 10.0932 15.7992 10.4547 15.5049C11.0572 15.0102 11.6242 14.4738 12.1516 13.8996C13.3673 12.5703 14.6865 10.6432 14.6865 8.47998C14.6865 7.77701 14.5481 7.08092 14.279 6.43147C14.01 5.78201 13.6157 5.19189 13.1187 4.69482C12.6216 4.19774 12.0315 3.80344 11.382 3.53443C10.7326 3.26541 10.0365 3.12695 9.3335 3.12695C8.63053 3.12695 7.93444 3.26541 7.28498 3.53443C6.63552 3.80344 6.04541 4.19774 5.54833 4.69482C5.05126 5.19189 4.65696 5.78201 4.38794 6.43147C4.11893 7.08092 3.98047 7.77701 3.98047 8.47998C3.98047 10.6432 5.29969 12.5697 6.51542 13.8996C7.04277 14.474 7.6098 15.01 8.21233 15.5049ZM9.3335 10.413C8.82082 10.413 8.32915 10.2094 7.96663 9.84684C7.60412 9.48433 7.40046 8.99265 7.40046 8.47998C7.40046 7.96731 7.60412 7.47563 7.96663 7.11312C8.32915 6.7506 8.82082 6.54694 9.3335 6.54694C9.84617 6.54694 10.3378 6.7506 10.7004 7.11312C11.0629 7.47563 11.2665 7.96731 11.2665 8.47998C11.2665 8.99265 11.0629 9.48433 10.7004 9.84684C10.3378 10.2094 9.84617 10.413 9.3335 10.413Z" fill="#FB0404"></path>
								</svg>
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
			<span class="block text-[12px] lg:text-sm text-white/30 mb-5 md:mb-0">
				© 2025&nbsp;American Liquidations
			</span>
			<?php
				wp_nav_menu( array(
					'menu'           => 'Footer: Bottom Menu',
					'menu_class'     => 'flex flex-col md:flex-row md:items-center gap-3 xl:gap-5 items-start text-white/30 text-[12px] lg:text-sm font-normal mt-3 lg:mt-0',
					'container'      => false,
				) );
			?>
		</div>
	</div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
