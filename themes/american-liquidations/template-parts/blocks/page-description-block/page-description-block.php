<?php /* 
Name: Page Title & Description Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
if(get_field('pag_bg_color')){
	$color = get_field('pag_bg_color');
}else{
	$color = '#f5f5f5';	
}
?>

<section style="background-color: <?php echo $color; ?>" class="ray py-8 lg:py-12 <?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<h1 class="text-[36px] md:text-[42px] lg:text-[48px] text-primary mb-5"><?php echo get_field('page_title'); ?></h1>
		<div class="max-w-[710px]">
			<?php echo get_field('page_description'); ?>
		</div>
	</div>
</section>