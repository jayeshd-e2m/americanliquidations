<?php
// Ensure $product and $post are set before including this file
if (!is_a($product, 'WC_Product')) {
    return;
}
global $product;
?>

<div class="product-card rounded-[15px] bg-white relative overflow-hidden">

    <div class="product-card-img pt-[72%] bg-[#6988730D] rounded-[8px] md:rounded-[15px] relative overflow-hidden">
		<?php if (!$product->is_in_stock()) {
			echo '<span class="is-tag z-10 absolute top-2 left-2 out-of-stock bg-primary font-bold tracking-[0.06em] py-0.5 px-2 md:px-3 rounded-full md:text-[12px] text-[12px] !text-white uppercase inline-block align-top font-barlow">Out of Stock</span>';
		}
		echo '<a href="'.esc_url(get_permalink($product->get_id())).'">';
        echo get_the_post_thumbnail($product->get_id(), 'medium'); 
		echo '</a>';
		?>
    </div>

    <div class="product-card-content pt-10 px-5 pb-7">
        <h5 class="mb-4 is-title"><a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"><?php echo esc_html( get_the_title( $product->get_id() ) ); ?></a></h5>
		<div class="flex justify-between gap-2 flex-wrap">
			<p class="text-[18px] text-black font-medium font-barlow flex items-center gap-2 is-price"><?php echo $product->get_price_html(); ?></p>
			<?php if(get_field('location', $product->get_id())){ ?>
				<span class="text-[12px] font-semibold flex items-center gap-1 text-[#C8C8C8] font-barlow is-location"><img width="8" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/location.svg" alt=""><?php echo get_field('location', $product->get_id()); ?></span>
			<?php } ?>
		</div>
		<div class="font-medium mt-5 is-description text-sm !leading-[1.2em]">
			<?php
				$description = wp_strip_all_tags($product->get_short_description());
				$words = explode(' ', $description);
				$trimmed = implode(' ', array_slice($words, 0, 9));
				echo esc_html($trimmed);
			?>
		</div>
		<div class="flex items-center gap-5 mt-6 is-buttons flex-wrap ">
			<?php $is_truckload = has_term( 'truckloads', 'product_cat', $product->get_id() ); ?>
			<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
               class="add_to_cart_button custom-add-to-cart  relative"
               data-quantity="1"
               data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
			   data-is_truckload="<?php echo $is_truckload ? '1' : '0';?>"
               data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
               rel="nofollow">
               <span class="button-text">Add to cart</span>
			   <span class="spinner hidden" aria-hidden="true"></span>
            </a>
			<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="text-[12px] uppercase tracking-[0.14em] font-bold text-black font-barlow">
			View details
			</a>
		</div>
		
    </div>

</div>