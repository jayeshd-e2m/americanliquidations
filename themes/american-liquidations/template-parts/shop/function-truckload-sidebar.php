<?php
$term         = get_query_var( 'truckload_term' );
$filter_terms = get_query_var( 'truckload_filter_terms' );
$tl_min_price = get_query_var( 'truckload_min_price' );
$tl_max_price = get_query_var( 'truckload_max_price' );
$tl_locations = get_query_var( 'truckload_locations' );

if ( $term && ! is_wp_error( $term ) ) : ?>
	<div class="filter-wrapper">
		<form id="truckload-shop-filters">
			<!-- Categories -->
			<div class="mb-4">
				<label class="font-medium custom-radio-box">
					<input type="radio" name="truckload_cat" value="<?php echo esc_attr( $term->slug ); ?>" checked>
					<span class="input-radio-custom"></span>All <?php echo esc_html( $term->name ); ?>
				</label>
			</div>
			<?php if ( ! empty( $filter_terms ) && ! is_wp_error( $filter_terms ) ) : ?>
				<?php foreach ( $filter_terms as $ft ) : ?>
					<?php if ( ! al_term_has_instock_products( $ft ) ) { continue; } ?>
					<div class="mb-4">
						<label class="font-medium custom-radio-box">
							<input type="radio" name="truckload_cat" value="<?php echo esc_attr( $ft->slug ); ?>">
							<span class="input-radio-custom"></span><?php echo esc_html( $ft->name ); ?>
						</label>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- Price Filter (matches shop markup/IDs exactly) -->
			<div class="filter-dropdown my-10">
				<h5 class="filter-dropdown-heading relative"><span class="opacity-60 text-black font-bold text-[18px]">Price</span> <span class="dropdown-arrow"></span></h5>
				<div class="price-range-wrapper" data-minprice="<?php echo esc_attr( $tl_min_price ); ?>" data-maxprice="<?php echo esc_attr( $tl_max_price ); ?>">
					<input type="text" id="price-range" name="price_range" value="" />
					<div class="flex justify-between text-[12px] mt-2 font-medium">
						<span>$<span id="min-price-label"><?php echo number_format( $tl_min_price ); ?></span></span>
						<span>$<span id="max-price-label"><?php echo number_format( $tl_max_price ); ?></span></span>
					</div>
					<input type="hidden" name="min_price" id="min-price" value="<?php echo esc_attr( $tl_min_price ); ?>">
					<input type="hidden" name="max_price" id="max-price" value="<?php echo esc_attr( $tl_max_price ); ?>">
				</div>
			</div>

            <!-- Location Filter -->
            <?php if ( ! empty( $tl_locations ) ) : ?>
                <div class="filter-dropdown mb-10">
                    <h5 class="mb-4 filter-dropdown-heading relative text-[18px]"><span class="opacity-60 text-black font-bold">Location</span> <span class="dropdown-arrow"></span></h5>
                    <div class="filter-dropdown-content">
                        <div class="space-y-4">
                            <div>
                                <label class="custom-radio-box"><input type="radio" name="truckload_location" value="" checked><span class="input-radio-custom"></span>All Locations</label>
                            </div>
                            <?php foreach ( $tl_locations as $loc ) : ?>
                                <div>
                                    <label class="custom-radio-box"><input type="radio" name="truckload_location" value="<?php echo esc_attr( $loc ); ?>"><span class="input-radio-custom"></span><?php echo esc_html( $loc ); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
		</form>
	</div>
<?php endif; ?>

