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
			<h2 class="text-center mb-12 text-[24px] md:text-[32px]">Shop Our Current <?php echo esc_html( $term->name ); ?> Inventory</h2>
			<?php 
			$term = get_queried_object();
			if ( $term && ! is_wp_error( $term ) ) {
				echo do_shortcode('[shopitem cat="' . esc_attr( $term->slug ) . '"]');
			}?>
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