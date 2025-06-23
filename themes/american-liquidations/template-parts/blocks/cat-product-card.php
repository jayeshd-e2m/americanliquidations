<?php
// Ensure $product and $post are set before including this file
if (!is_a($product, 'WC_Product')) {
    return;
}
global $product;
?>

<div class="product-card rounded-[15px] bg-white relative overflow-hidden">

    <div class="product-card-img pt-[72%] bg-[#6988730D] rounded-[15px] relative overflow-hidden">
		<?php if (!$product->is_in_stock()) {
			echo '<span class="is-tag z-10 absolute top-2 left-2 out-of-stock bg-primary font-bold tracking-[0.06em] py-0.5 px-2 md:px-3 rounded-full md:text-[12px] text-[12px] !text-white uppercase inline-block align-top font-barlow">Out of Stock</span>';
		}
		echo '<a href="'.esc_url(get_permalink($product->get_id())).'">';
			if (has_post_thumbnail($product->get_id())) {
				echo get_the_post_thumbnail($product->get_id(), 'medium');
			} else {
				// Update the path below to where your fallback image is stored
				echo '<img src="' . esc_url(site_url()) . '/wp-content/uploads/2025/06/noimg-AL.jpg" alt="No Image" class="w-full h-full object-cover" />';
			}
		echo '</a>';

		
		?>
    </div>

    <div class="product-card-content pt-10 px-5 pb-7">
        <h5 class="mb-4 is-title"><a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"><?php echo esc_html( get_the_title( $product->get_id() ) ); ?></a></h5>
		<div class="flex justify-between gap-2 flex-wrap">
			<p class="text-[18px] text-black font-medium font-barlow is-price">
				<?php echo $product->get_price_html(); ?>
				<?php if($product->get_meta('_msrp_price')){ 
					$msrp = $product->get_meta('_msrp_price');
					?> 
					<span class="block text-[12px] text-[#C8C8C8] w-full">MSRP: <?php echo wc_price($msrp);?></span>
				<?php }
				?>
			</p>
			<?php if(get_field('location', $product->get_id())){ ?>
				<span class="text-[12px] font-semibold flex items-center gap-1 text-[#C8C8C8] font-barlow is-location"><img width="8" src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/location.svg" alt=""><?php echo get_field('location', $product->get_id()); ?></span>
			<?php } ?>
		</div>
		<div class="font-medium mt-5 is-description text-sm lg:text-md">
			<?php
				$description = wp_strip_all_tags($product->get_short_description());
				$words = explode(' ', $description);
				$trimmed = implode(' ', array_slice($words, 0, 9));
				echo esc_html($trimmed);
			?>
		</div>
		<div class="flex items-center gap-5 mt-6 is-buttons flex-wrap">
			<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="btn" style="width: 100%;">
			BUY NOW
			</a>
		</div>
		
    </div>

</div>