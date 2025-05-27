<?php /* 
Name: Contact Top Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-12 md:py-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="flex gap-7">
			<div class="contact-form-left w-full md:w-1/2">
				<?php 
				$image = get_field('contact_form_image');
				if( !empty( $image ) ): ?>
					<img class="w-full" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif; ?>
			</div>
			<div class="contact-form-right w-full md:w-1/2">
				<!-- contact_form_id -->
			</div>
		</div>
	</div>
</section>