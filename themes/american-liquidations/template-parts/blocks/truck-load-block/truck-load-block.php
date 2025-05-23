<?php /* 
Name: Truck Load Block
*/ ?>

<?php
$block_class = get_field('advanced') ? get_field('block_class') : '';
$block_id = get_field('advanced') ? get_field('block_id') : '';
?>

<section class="bg-gray py-16 lg:py-24<?php echo esc_attr($block_class); ?>" <?php if ($block_id): ?>id="<?php echo esc_attr($block_id); ?>"<?php endif; ?>>
	<div class="container">
		<div class="section-heading max-w-[660px] mx-auto text-center">
			<h2 class="mb-4"><?php echo get_field('truckload_title'); ?></h2>
			<?php echo get_field('truckload_content'); ?>
		</div>
		<?php 
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 8,
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug', // or 'term_id' if you prefer to use ID
					'terms'    => 'truckloads', // slug of the category
				),
			),
		);

		$new_arrival_query = new WP_Query($args);

		if ($new_arrival_query->have_posts()) {
			echo '<div class="product-has-slider grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-12">';
			while ($new_arrival_query->have_posts()) {
				$new_arrival_query->the_post();
				global $product;
				$product = wc_get_product(get_the_ID());
				set_query_var('product', $product);
				get_template_part('template-parts/blocks/product-card');
			}
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<p>No Truck Load products available at the moment.</p>';
		}
		?>
		<div class="text-center mt-12">
			<?php 
			$link = get_field('truckload_button');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<a class="btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>