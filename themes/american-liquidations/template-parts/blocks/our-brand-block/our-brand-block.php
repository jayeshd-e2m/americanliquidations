<?php /* 
Name: Our Brand Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="my-16 lg:my-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="section-heading max-w-[660px]">
			<h2 class="mb-4"><?php echo get_field('our_brand_title'); ?></h2>
			<?php echo get_field('our_brand_content'); ?>
		</div>
		<div class="our-brand-blocks mt-12">
			<div class="brand-slider flex gap-5">
				<?php
				if( have_rows('our_brand_blocks') ):
					while( have_rows('our_brand_blocks') ) : the_row(); ?>
						<div class="brand-item">
							<div class="brand-item-img h-[148px] bg-gray flex items-center justify-center rounded-2xl p-3 mb-6">
								<?php 
								$image = get_sub_field('brand_image');
								if( !empty( $image ) ): ?>
									<img style="max-width: 90%; max-height: 90%;" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								<?php endif; ?>
							</div>
							<h6><?php echo get_sub_field('brand_title'); ?></h6>
							<p class="mt-5 leading-[1.2em]"><?php echo get_sub_field('brand_content'); ?></p>
						</div>
					<?php endwhile;
				endif; ?>				
			</div>
		</div>
	</div>
</section>