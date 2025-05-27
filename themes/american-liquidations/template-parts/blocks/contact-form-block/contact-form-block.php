<?php /* 
Name: Contact Top Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="py-12 md:py-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex gap-7">
			<div class="contact-form-left w-full md:w-1/2 relative">
				<?php 
				$image = get_field('contact_form_image');
				if( !empty( $image ) ): ?>
					<img class="w-full absolute top-0 left-0 h-full object-cover" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</div>
			<div class="contact-form-right w-full md:w-1/2">
				<?php echo do_shortcode('[gravityform id="'.get_field('contact_form_id').'" title="false" description="false" ajax="true" tabindex="49"]') ?>
			</div>
		</div>
	</div>
</section>