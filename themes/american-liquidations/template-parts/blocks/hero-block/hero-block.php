<?php /* 
Name: Hero Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="my-24 <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex">
			<div class="w-[55%]">
				<h1 class="mb-4"><?php echo get_field('hero_title'); ?></h1>
				<?php echo get_field('hero_content'); ?>
				<div class="flex items-center gap-10 mt-12">
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
								<p class="text-sm font-medium mt-3 text-black/60"><?php echo get_sub_field('box_title'); ?></p>
							</div>
						<?php endwhile;
					endif; ?>
				</div>
			</div>
			<div class="w-[45%]">

			</div>
		</div>
	</div>
</section>