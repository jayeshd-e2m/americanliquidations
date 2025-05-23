<?php /* 
Name: Our Brand Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="py-12<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex gap-6 lg:gap-12">
		<?php
		if( have_rows('two_blocks') ):
			while( have_rows('two_blocks') ) : the_row(); ?>
				<div class="w-1/2">
					<div class="img-ratio pt-[59%] relative rounded-2xl overflow-hidden">
						<?php 
						$image = get_sub_field('two_image');
						if( !empty( $image ) ): ?>
							<img class="absolute top-0 left-0 w-full h-full object-cover" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
					</div>
					<div class="two-block-content mt-8">
						<h5 class="text-[#FB0404] mb-4 opacity-60"><?php echo get_sub_field('two_title'); ?></h5>
						<?php echo get_sub_field('two_content'); ?>
					</div>
				</div>
			<?php endwhile;
		endif;?>
		</div>
	</div>
</section>