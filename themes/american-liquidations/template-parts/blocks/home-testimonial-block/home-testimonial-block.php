<?php /* 
Name: Our Brand Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="py-16 lg:py-24 bg-gray <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex gap-12 md:gap-6 xl:gap-8 flex-col md:flex-row"> 
			<div class="w-full md:w-1/2 bg-white border-r-8 border-primary p-10 inline-flex items-center rounded-l-[15px]">
				<blockquote>
					<?php echo get_field('blockquote'); ?>
				</blockquote>
			</div>
			<div class="w-full md:w-1/2">
				<h2 class="mb-4"><?php echo get_field('testimonial_title'); ?></h2>
				<?php echo get_field('testimonial_content'); ?>
				<div class="flex items-center gap-2 xl:gap-10 mt-6 flex-col md:flex-row">
					<?php 
					$link = get_field('testimonial_button_1');
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="btn btn-arrow btn-red w-full md:w-auto" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
					<?php 
					$link = get_field('testimonial_button_2');
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<a class="mt-6 md:mt-0 btn-link text-black hover:text-primary text-sm font-bold tracking-[0.10em] uppercase" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
				<div class="testimonial-blocks mt-12 xl:mt-24">
					<div class="testimonial-items grid mobile-grid-1 grid-cols-2 xl:grid-cols-4 gap-4">
					<?php
					if( have_rows('testimonial_blocks') ):
						while( have_rows('testimonial_blocks') ) : the_row(); ?>
							<div class="testimonial-item bg-white p-4 rounded-[10px] w-full">
								<div class="testimonial-img">
									<?php 
									$image = get_sub_field('icon');
									if( !empty( $image ) ): ?>
										<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									<?php endif; ?>
								</div>
								<div class="testimonial-content">
									<p class="text-[12px] mt-2 mb-[6px] font-bold"><?php echo get_sub_field('title'); ?></p>
									<p class="text-[12px]"><?php echo get_sub_field('content'); ?></p>
								</div>
							</div>
						<?php endwhile;
					endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>