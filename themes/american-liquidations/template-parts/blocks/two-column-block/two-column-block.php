<?php /* 
Name: Two Column Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-12 md:py-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex flex-wrap md:flex-nowrap gap-6 lg:gap-12 items-center">
			<div class="w-full md:w-1/2 mb-4 md:mb-0">
				<?php 
				$image = get_field('two_col_image');
				if( !empty( $image ) ): ?>
					<img class="rounded-[15px]" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</div>
			<div class="w-full md:w-1/2 space-y-5">
				<span class="h-[7px] w-[40px] bg-primary block"></span>
				<h2 class="text-[32px]"><?php echo get_field('two_col_title'); ?></h2>
				<?php echo get_field('two_col_content'); ?>
				<?php 
				$link = get_field('two_col_button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="btn btn-red btn-arrow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>