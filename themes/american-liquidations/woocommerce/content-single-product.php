<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

// ACF Fields
$availability     = get_field('shop_availability');
$estimated_value  = get_field('estimated_value');
$location         = get_field('location');
$zip_code         = get_field('zip_code');

// Product Tags as Quality
$tags    = wp_get_post_terms($product->get_id(), 'product_tag');
$quality = !empty($tags) ? implode(', ', wp_list_pluck($tags, 'name')) : '';
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="container py-14">
		<div class="flex gap-12">
			<div class="shop-detail-img w-full md:w-1/2">
				<?php
				/**
				 * WooCommerce Hook: Product images
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

			<div class="shop-detail-content w-full md:w-1/2">

				<h1 class="text-[30px] font-bold mb-14"><?php the_title(); ?></h1>

				<div class="shop-detail-items space-y-5 mb-16">
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Price: </div>
						<div class="item-lable-output text-primary font-medium"><?php echo $product->get_price_html(); ?></div>
					</div>

					<?php if ( $availability ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Availability: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $availability ); ?></div>
					</div>
					<?php endif; ?>

					<?php if ( $quality ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Quality: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $quality ); ?></div>
					</div>
					<?php endif; ?>
					
					<?php if ( $estimated_value ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Estimated Value: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $estimated_value ); ?></div>
					</div>
					<?php endif; ?>

					<?php if ( $location ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Location: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $location ); ?></div>
					</div>
					<?php endif; ?>

					<?php if ( $zip_code ) : ?>
					<div class="shop-detail-item flex">
						<div class="item-lable font-medium text-black">Zip Code: </div>
						<div class="item-lable-output text-black/40 font-medium"><?php echo esc_html( $zip_code ); ?></div>
					</div>
					<?php endif; ?>

				</div>

				<form class="cart" method="post" enctype='multipart/form-data'>
					<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

					<button type="submit" class="single_add_to_cart_button button alt">
						<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
					</button>

					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				</form>

				<p class="text-black/40">Shipping will be calculated at the checkout.</p>

				<div class="flex items-center font-medium text-black/40"><span class="mr-5">Share:</span> <?php echo do_shortcode('[psfw_basic_share]'); ?></div>
			</div>
		</div>
	</div>
	<div class="single-product-desc bg-gray py-14">
		<div class="container">
			<div class="flex gap-12">
				<div class="w-full md:w-1/2">
					<h4 class="text-[24px] text-black/60 mb-4">Truckload Description</h4>
					<?php
					$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
					if ( $short_description ) {
						echo '<div class="woocommerce-product-details__short-description text-medium text-black/40">';
						echo wp_kses_post( $short_description );
						echo '</div>';
					}
					?>
				</div>
				<div class="w-full md:w-1/2">
					<h4 class="text-[24px] text-black/60 mb-4">More Details</h4>
					<div class="text-medium text-black/40">
						<?php
							the_content();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$product_id = get_the_ID();
	$product_cats = wp_get_post_terms( $product_id, 'product_cat', [ 'fields' => 'ids' ] );

	$args = [
		'post_type'      => 'product',
		'posts_per_page' => 4,
		'post__not_in'   => [ $product_id ], // Exclude current product
		'tax_query'      => [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $product_cats,
			],
		],
		'meta_query' => WC()->query->get_meta_query(), // Include product visibility, stock status, etc.
	];

	$related_query = new WP_Query( $args );

	if ( $related_query->have_posts() ) :
	?>
		<div class="related-prouduct-items mt-24 mb-16">
			<div class="container">
				<h2 class="text-black/60 mb-4">Related Items</h2>
				<div class="product-has-slider grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-12">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<?php global $product;
						$product = wc_get_product(get_the_ID());
						set_query_var('product', $product);
						get_template_part('template-parts/blocks/product-card'); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	<?php
	endif;
	wp_reset_postdata();
	?>

	<div class="single-product-map mb-4">
		<div class="container">
			<div class="single-product-map-inner">
				<?php echo get_field('embedded_map'); ?>
			</div>
		</div>
	</div>


</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
