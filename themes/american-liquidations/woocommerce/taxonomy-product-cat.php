<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */
get_header();
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$term = get_queried_object();

if ($term && $term->slug === 'truckloads') {
	$bg = '';
}else{
	$bg = 'bg-gray';
}
?>
<div class="page-description-header py-12 <?php echo $bg; ?>">
    <div class="container">
        <div class="max-w-[710px]">
			<?php if(get_field('category_title','product_cat_' . $term->term_id)){ ?>
            	<h1 class="text-[36px] md:text-[44px] lg:text-[48px]"><?php echo get_field('category_title','product_cat_' . $term->term_id); ?></h1>
			<?php }else{ ?>
				<h1 class="text-[36px] md:text-[44px] lg:text-[48px]"><?php echo esc_html( $term->name ); ?></h1>
			<?php } ?>
            <?php if ( term_description() ) : ?>
				<div class="mt-6">
                	<?php echo term_description(); ?>
				</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php 
$term = get_queried_object();
if ($term && $term->slug === 'truckloads') { ?>
	<div class="shop-taxonomy-cover py-12 md:py-24 bg-gray">
		<div class="container">
			<?php
			$term = get_queried_object();
			if ( $term && ! is_wp_error( $term ) ) :
			?>
				<h2 class="text-center mb-12 text-[24px] md:text-[32px]">
					Shop Our Current <?php echo esc_html( $term->name ); ?> Inventory
				</h2>

				<?php
				// Subcategories of the current term; fall back to top-level product cats
				$product_ids = get_posts( array(
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'fields'         => 'ids',
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => $term->term_id,
						),
					),
				) );
				$filter_terms = array();
				if ( ! empty( $product_ids ) ) {
					// All product_cat terms assigned to those products
					$assigned = wp_get_object_terms( $product_ids, 'product_cat' );
					if ( ! is_wp_error( $assigned ) ) {
						foreach ( $assigned as $t ) {
							// Skip the current term itself (that's the "All" button)
							if ( $t->term_id !== $term->term_id ) {
								$filter_terms[ $t->term_id ] = $t; // keyed = auto-dedupe
							}
						}
					}
				}
				if ( empty( $filter_terms ) || is_wp_error( $filter_terms ) ) {
					$filter_terms = get_terms( array(
						'taxonomy'   => 'product_cat',
						'parent'     => 0,
						'hide_empty' => true,
					) );
				}
				?>

				<?php if ( ! empty( $filter_terms ) && ! is_wp_error( $filter_terms ) ) : ?>
					<div class="shopitem-filter flex flex-wrap justify-center gap-3 mb-10">
						<button type="button" class="shopitem-filter-btn is-active"
								data-cat="<?php echo esc_attr( $term->slug ); ?>">
							All <?php echo esc_html( $term->name ); ?>
						</button>
						<?php foreach ( $filter_terms as $ft ) : ?>
							<button type="button" class="shopitem-filter-btn"
									data-cat="<?php echo esc_attr( $ft->slug ); ?>">
								<?php echo esc_html( $ft->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div id="shopitem-results">
					<?php echo do_shortcode('[shopitem cat="' . esc_attr( $term->slug ) . '"]'); ?>
				</div>

				<script>
				(function () {
					var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
					var nonce   = '<?php echo wp_create_nonce('shopitem_filter_nonce'); ?>';
					var buttons = document.querySelectorAll('.shopitem-filter-btn');
					var results = document.getElementById('shopitem-results');
					

					buttons.forEach(function (btn) {
						btn.addEventListener('click', function () {
							var cat = this.getAttribute('data-cat');
							buttons.forEach(function (b) { b.classList.remove('is-active'); });
							this.classList.add('is-active');
							results.style.opacity = '0.4';

							var data = new FormData();
							data.append('action', 'filter_shopitems');
							data.append('nonce', nonce);
							data.append('cat', cat);
							data.append('base', '<?php echo esc_attr( $term->slug ); ?>'); // current = truckload

							fetch(ajaxurl, { method: 'POST', body: data, credentials: 'same-origin' })
								.then(function (r) { return r.text(); })
								.then(function (html) {
									results.innerHTML = html;
									results.style.opacity = '1';
								})
								.catch(function () { results.style.opacity = '1'; });
						});
					});
				})();
				</script>
			<?php endif; ?>
		</div>
	</div>
<?php }else{
	echo '<div class="is-other-product">';
	$current_cat = get_queried_object();
    if ($current_cat && !is_wp_error($current_cat)) {
        echo do_shortcode('[custom_shop cat="' . esc_attr($current_cat->slug) . '"]');
    }
	echo '</div>';
}
?>
<?php if(get_field('cta_title','product_cat_' . $term->term_id) || get_field('cta_content','product_cat_' . $term->term_id)){ ?>
	<section class="py-12 md:py-24">
		<div class="container">
			<div class="flex flex-wrap md:flex-nowrap gap-6 lg:gap-12 lg:items-center">
				<div class="w-full md:w-1/2 mb-4 md:mb-0">
					<?php 
					$image = get_field('cta_image','product_cat_' . $term->term_id);
					if( !empty( $image ) ): ?>
						<img class="rounded-[15px]" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					<?php endif; ?>
				</div>
				<div class="w-full md:w-1/2 space-y-5">
					<span class="h-[7px] w-[40px] bg-primary block"></span>
					<h2 class="text-[24px] md:text-[32px]"><?php echo get_field('cta_title','product_cat_' . $term->term_id); ?></h2>
					<?php echo get_field('cta_content','product_cat_' . $term->term_id); ?>
					<?php 
					$link = get_field('cta_button','product_cat_' . $term->term_id);
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
<?php } ?>
<?php if(get_field('map_iframe','product_cat_' . $term->term_id)){ ?>
<section class="single-product-map-inner mb-4">
    <div class="container">
        <div class="rounded-[15px] overflow-hidden">
            <?php echo get_field('map_iframe','product_cat_' . $term->term_id); ?>
        </div>
    </div>
</section>
<?php } ?>
<?php get_footer(); ?>