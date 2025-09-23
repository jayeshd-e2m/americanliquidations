<?php /* 
Name: Hero Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="my-16 lg:my-24 <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex items-center flex-wrap lg:flex-nowrap">
			<div class="w-full lg:w-1/2 xl:w-[55%]">
				<h1 class="mb-4 is-arrow"><?php echo get_field('hero_title'); ?></h1>
				<?php echo get_field('hero_content'); ?>
				<div class="flex items-center gap-5 md:gap-10 mt-8 md:mt-12 flex-wrap md:flex-nowrap">
					<?php 
					$link = get_field('hero_button_1');
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="btn btn-arrow btn-red" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					<?php 
					$link = get_field('hero_button_2');
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="btn-link text-primary text-sm font-bold tracking-[0.10em] hover:text-black" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
				<div class="hero-boxes flex gap-4 mt-12">
					<?php
					if( have_rows('hero_blocks') ):
						while( have_rows('hero_blocks') ) : the_row(); ?>
							<div class="boxes-item bg-primary/5 rounded-[10px] px-4 py-6 w-full">
								<?php 
								$image = get_sub_field('hero_icon');
								if( !empty( $image ) ): ?>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								<?php endif; ?>
								<p class="text-sm font-medium mt-3 text-black/60 remove-br-mobile"><?php echo get_sub_field('box_title'); ?></p>
							</div>
						<?php endwhile;
					endif; ?>
				</div>
			</div>
			<div class="w-full lg:w-1/2 xl:w-[45%] lg:pl-8 mt-10 lg:mt-0">
				<div class="grid grid-cols-2 gap-3 small-product-card">
					<?php
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => 4, // Change this number to how many recent products you want
						'orderby'        => 'date',
						'order'          => 'DESC'
					);

					$recent_products = new WP_Query( $args );

					if ( $recent_products->have_posts() ) :
						while ( $recent_products->have_posts() ) : $recent_products->the_post();
							$product = wc_get_product( get_the_ID() );
							if ( $product ) {
								set_query_var( 'product', $product );
								get_template_part( 'template-parts/blocks/product-card' );
							}
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>

		</div>
	</div>
</section>