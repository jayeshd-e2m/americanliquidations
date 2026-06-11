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
if ($term && $term->slug === 'truckloads') {

	// Build the list of filter terms (subcats used by products in this term)
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
		$assigned = wp_get_object_terms( $product_ids, 'product_cat' );
		foreach ( $assigned as $t ) {
			if ( $t->term_id !== $term->term_id ) {
				$filter_terms[ $t->term_id ] = $t; // keyed = auto-dedupe
			}
		}
	}
	if ( empty( $filter_terms ) ) {
		$filter_terms = get_terms( array(
			'taxonomy'   => 'product_cat',
			'parent'     => 0,
			'hide_empty' => true,
		) );
	}

	// Price range scoped to this term's products
	$tl_min_price = null;
	$tl_max_price = null;
	if ( ! empty( $product_ids ) ) {
		$prices = array();
		foreach ( $product_ids as $pid ) {
			$p = function_exists( 'wc_get_product' ) ? wc_get_product( $pid ) : null;
			if ( $p ) {
				$pr = $p->get_price();
				if ( $pr !== '' && $pr !== null ) {
					$prices[] = (float) $pr;
				}
			}
		}
		if ( ! empty( $prices ) ) {
			$tl_min_price = (int) floor( min( $prices ) );
			$tl_max_price = (int) ceil( max( $prices ) );
		}
	}
	if ( $tl_min_price === null ) $tl_min_price = 0;
	if ( $tl_max_price === null ) $tl_max_price = 1000;

	set_query_var( 'truckload_min_price', $tl_min_price );
	set_query_var( 'truckload_max_price', $tl_max_price );

	// Distinct ACF locations across this term's products
	$tl_locations = array();
	if ( ! empty( $product_ids ) ) {
		foreach ( $product_ids as $pid ) {
			$loc = trim( (string) get_field( 'location', $pid ) );
			if ( $loc !== '' ) {
				$tl_locations[ $loc ] = true; // key = auto-dedupe
			}
		}
	}
	$tl_locations = array_keys( $tl_locations );
	sort( $tl_locations );

	set_query_var( 'truckload_locations', $tl_locations );

	// Map of category slug => locations that have in-stock products (for cross-filtering the sidebar)
	$cat_locations = array();
	$base_slug     = $term->slug; // 'truckloads'

	if ( ! empty( $product_ids ) ) {
		foreach ( $product_ids as $pid ) {
			$product = function_exists( 'wc_get_product' ) ? wc_get_product( $pid ) : null;
			if ( $product && ! $product->is_in_stock() ) {
				continue; // keep this consistent with the in-stock button logic
			}

			$loc = trim( (string) get_field( 'location', $pid ) );
			if ( $loc === '' ) {
				continue;
			}

			$cat_locations[ $base_slug ][ $loc ] = true; // "All Truckload"

			$pterms = wp_get_object_terms( $pid, 'product_cat' );
			if ( ! is_wp_error( $pterms ) ) {
				foreach ( $pterms as $t ) {
					if ( $t->term_id !== $term->term_id ) {
						$cat_locations[ $t->slug ][ $loc ] = true;
					}
				}
			}
		}
	}
	foreach ( $cat_locations as $slug => $locs ) {
		$list = array_keys( $locs );
		sort( $list );
		$cat_locations[ $slug ] = $list;
	}

	// "Matches" count for the sidebar search box
	$count = is_array( $product_ids ) ? count( $product_ids ) : 0;

	// Pass data into the sidebar partial
	set_query_var( 'truckload_term', $term );
	set_query_var( 'truckload_filter_terms', $filter_terms );
	?>

	<div class="shop-taxonomy-cover py-12 md:py-24 bg-gray">
		<div class="container">
			<h2 class="text-center mb-12 text-[24px] md:text-[32px]">
				Shop Our Current <?php echo esc_html( $term->name ); ?> Inventory
			</h2>

			<div class="flex gap-8 2xl:gap-12 flex-wrap md:flex-nowrap">

				<!-- Sidebar -->
				<div class="shop-sidebar w-full md:w-[275px] xl:w-[355px] bg-white p-8 2xl:p-12 rounded-[15px]">
					<span class="shop-sidebar-overlay" style="background: #fff"></span>
					<div class="filter-wrapper">
						<div class="filter-search mb-10">
							<h4 class="mb-3 text-black/60 text-[24px]">Search Products</h4>
							<p class="font-medium opacity-[40%]">
								Store / Search : <span class="search-match-box"><?php echo esc_html( $count ); ?></span> Matches
							</p>
						</div>
						<?php get_template_part( 'template-parts/shop/function-truckload-sidebar' ); ?>
					</div>
				</div>

				<!-- Items -->
				<div class="shop-items-cover w-full md:w-[calc(100%_-_275px)] xl:w-[calc(100%_-_355px)] pr-0">
					<div id="custom-shop-loader" class="hidden text-center py-8 sticky top-[50%]">
						<svg class="mx-auto animate-spin h-8 w-8 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
							<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
						</svg>
					</div>

					<div id="shopitem-results">
						<?php echo do_shortcode('[shopitem cat="' . esc_attr( $term->slug ) . '"]'); ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<script>
	jQuery(function ($) {
		var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
		var nonce   = '<?php echo wp_create_nonce('shopitem_filter_nonce'); ?>';
		var base    = '<?php echo esc_attr( $term->slug ); ?>';
		var $results  = $('#shopitem-results');
		var $minInput = $('#min-price');
		var $maxInput = $('#max-price');

		var catLocations = <?php echo wp_json_encode( $cat_locations ); ?>;

		function syncLocations() {
			var allowed = catLocations[currentCat()] || catLocations[base] || [];
			$('#truckload-shop-filters input[name="truckload_location"]').each(function () {
				var $input = $(this), val = $input.val(), $row = $input.closest('div');
				if (val === '') { $row.show(); return; }          // always keep "All Locations"
				if (allowed.indexOf(val) === -1) {
					if ($input.is(':checked')) {                   // selected one just became invalid
						$('#truckload-shop-filters input[name="truckload_location"][value=""]').prop('checked', true);
					}
					$row.hide();
				} else {
					$row.show();
				}
			});
		}

		function currentCat() {
			return $('#truckload-shop-filters input[name="truckload_cat"]:checked').val() || base;
		}

		function currentLocation() {
			return $('#truckload-shop-filters input[name="truckload_location"]:checked').val() || '';
		}

		function runFilter() {
			$results.css('opacity', '0.4');
			var data = new FormData();
			data.append('action', 'filter_shopitems');
			data.append('nonce', nonce);
			data.append('cat', currentCat());
			data.append('base', base);
			data.append('min_price', $minInput.val());
			data.append('max_price', $maxInput.val());
			data.append('location', currentLocation());

			fetch(ajaxurl, { method: 'POST', body: data, credentials: 'same-origin' })
				.then(function (r) { return r.text(); })
				.then(function (html) {
					$results.html(html);
					$results.css('opacity', '1');

					var $marker = $results.find('.shopitem-found-count');
					var c;
					if ( $marker.length ) {
						c = $marker.attr('data-count');
					}
					if ( c === undefined || c === null || c === '' ) {
						// fallback: count rendered cards (current page only)
						c = $results.find('.mobile-grid-1').children().length;
					}
					$('.search-match-box').text(c);
				})
				.catch(function () { $results.css('opacity', '1'); });
		}

		// Category change
		$('#truckload-shop-filters input[name="truckload_cat"]').on('change', function () {
			if (this.checked) {
				syncLocations();   // hide invalid locations + reset selection if needed
				runFilter();       // now queries with a valid location
			}
		});

		syncLocations(); // run once on load so the initial state is correct

		$('#truckload-shop-filters input[name="truckload_location"]').on('change', function () {
			if (this.checked) runFilter();
		});

		// Price slider (ionRangeSlider)
		var $wrap = $('.price-range-wrapper');
		var minP = parseInt($wrap.data('minprice'), 10) || 0;
		var maxP = parseInt($wrap.data('maxprice'), 10) || 1000;

		if ($.fn.ionRangeSlider) {
			$('#price-range').ionRangeSlider({
				type: 'double',
				min: minP,
				max: maxP,
				from: minP,
				to: maxP,
				prefix: '$',
				skin: 'round',
				onChange: function (d) {
					$('#min-price-label').text(Math.round(d.from).toLocaleString());
					$('#max-price-label').text(Math.round(d.to).toLocaleString());
					$minInput.val(d.from);
					$maxInput.val(d.to);
				},
				onFinish: function (d) {
					$minInput.val(d.from);
					$maxInput.val(d.to);
					runFilter();
				}
			});
		}
	});
	</script>

<?php } else {
	echo '<div class="is-other-product">';
	$current_cat = get_queried_object();
	if ( $current_cat && ! is_wp_error( $current_cat ) ) {
		echo do_shortcode('[custom_shop cat="' . esc_attr( $current_cat->slug ) . '"]');
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