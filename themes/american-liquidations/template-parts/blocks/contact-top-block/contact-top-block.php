<?php /* 
Name: Contact Top Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-12 md:py-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex gap-[20px] xl:gap-12 flex-wrap lg:flex-nowrap">
			<div class="contact-content w-full md:w-[calc(50%_-_10px)] xl:w-1/3 space-y-5 self-center">
				<span class="h-[7px] w-[40px] bg-primary block"></span>
				<h2 class="text-[32px]"><?php echo get_field('cnt_title'); ?></h2>
				<?php echo get_field('cnt_content'); ?>
				<div class="contact-info-cover space-y-7 mt-1 pb-7">
					<p class="contact-top-address text-xs"><?php echo get_field('cnt_address'); ?></p>
					<p class="contact-top-email text-xs"><a href="mailto:<?php echo get_field('cnt_email_address'); ?>"><?php echo get_field('cnt_email_address'); ?></a></p>
					<p class="contact-top-hour flex items-center justify-between text-xs"><span><?php echo get_field('opening_time_label'); ?></span><span><?php echo get_field('opening_time'); ?></span></p>
					<p class="contact-top-phone text-xs"><a href="tel:<?php echo get_field('cnt_phone_number'); ?>"><?php echo get_field('cnt_phone_number'); ?></a></p>
				</div>
				<?php 
				$link = get_field('cnt_button');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="btn btn-red btn-arrow" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
			<div class="contact-content-img w-full md:w-[calc(50%_-_10px)] xl:w-1/3 rounded-[15px] overflow-hidden">
				<?php 
				$image = get_field('cnt_image');
				if( !empty( $image ) ): ?>
					<img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</div>
			<div class="contact-content-map w-full md:w-full xl:w-1/3 rounded-[15px] overflow-hidden">
				<?php echo get_field('cnt_embedded_iframe'); ?>
			</div>
		</div>
	</div>
</section>