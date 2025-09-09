<div class="filter-wrapper">

    <form id="custom-shop-filters">
        <!-- Categories (radio) -->
		<?php
		$preselected_cat = get_query_var('preselected_cat');
		$terms = get_terms([
			'taxonomy' => 'product_cat',
			'hide_empty' => true,
			'parent' => 0, // Only top-level categories (parents)
		]);
		$selected_category = isset($_GET['categories']) ? sanitize_text_field($_GET['categories']) : $preselected_cat;
		?>
		<input type="hidden" name="initial_category" id="initial_category" value="<?php echo esc_attr($selected_category); ?>">
		<?php
		foreach ($terms as $parent) {
			$checked = ($parent->slug === $selected_category) ? 'checked' : '';
			echo '<div>';
			echo '<label class="font-medium custom-radio-box">';
			echo '<input type="radio" name="categories" value="' . esc_attr($parent->slug) . '" ' . $checked . '>';
			echo '<span class="input-radio-custom"></span>' . esc_html($parent->name) . '</label>';

			// Now fetch direct children for this parent
			$children = get_terms([
				'taxonomy' => 'product_cat',
				'hide_empty' => true,
				'parent' => $parent->term_id,
			]);
			foreach ($children as $child) {
				$checked_child = ($child->slug === $selected_category) ? 'checked' : '';
				echo '<div style="margin-left: 20px; margin-top: 10px;">';
				echo '<label class="font-medium custom-radio-box">';
				echo '<input type="radio" name="categories" value="' . esc_attr($child->slug) . '" ' . $checked_child . '>';
				echo '<span class="input-radio-custom"></span>' . esc_html($child->name) . '</label>';
				echo '</div>';
			}

			echo '</div>'; // end parent container
		}
		?>

        <!-- Price Filter -->
        <div class="filter-dropdown mb-10">
			<h5 class="filter-dropdown-heading relative"><span class="opacity-60 text-black font-bold text-[18px]">Price</span> <span class="dropdown-arrow"></span></h5>
			
			<?php
			global $wpdb;

			// Get min price
			$min_price = $wpdb->get_var("
				SELECT MIN(CAST(pm.meta_value AS UNSIGNED))
				FROM {$wpdb->posts} p
				INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
				WHERE p.post_type = 'product'
				AND p.post_status = 'publish'
				AND pm.meta_key = '_price'
			");

			// Get max price
			$max_price = $wpdb->get_var("
				SELECT MAX(CAST(pm.meta_value AS UNSIGNED))
				FROM {$wpdb->posts} p
				INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
				WHERE p.post_type = 'product'
				AND p.post_status = 'publish'
				AND pm.meta_key = '_price'
			");

			// Provide fallback if empty (e.g. no products)
			if(!$min_price) $min_price = 0;
			if(!$max_price) $max_price = 1000; // fallback
			?>
			<div class="price-range-wrapper" data-minprice="<?php echo esc_attr($min_price); ?>" data-maxprice="<?php echo esc_attr($max_price); ?>">
				<input type="text" id="price-range" name="price_range" value="" />
				<div class="flex justify-between text-[12px] mt-2 font-medium">
					<span>$<span id="min-price-label"><?php echo number_format($min_price); ?></span></span>
					<span>$<span id="max-price-label"><?php echo number_format($max_price); ?></span></span>
				</div>
				<!-- Hidden inputs for form data -->
				<input type="hidden" name="min_price" id="min-price" value="<?php echo esc_attr($min_price); ?>">
				<input type="hidden" name="max_price" id="max-price" value="<?php echo esc_attr($max_price); ?>">
			</div>
		</div>

        <!-- Sort Options -->
        <div class="filter-dropdown mb-10">
			<h5 class="mb-4 filter-dropdown-heading relative text-[18px]"><span class="opacity-60 text-black font-bold">Sort by</span> <span class="dropdown-arrow"></span></h5>
			<div class="filter-dropdown-content">
				<div class="space-y-4">
					<?php
					$sort_options = [
						'relevance'  => 'Relevance',
						'newest'     => 'New Arrivals',
						'price_asc'  => 'Price: Low to High',
						'price_desc' => 'Price: High to Low',
						'name_asc'   => 'Name: A to Z',
						'name_desc'  => 'Name: Z to A',
					];
					foreach ($sort_options as $key => $label) {
						echo '<div>';
						echo '<label class="custom-radio-box"><input type="radio" name="sort_by" value="' . esc_attr($key) . '"><span class="input-radio-custom"></span>' . esc_html($label) . '</label>';
						echo '</div>';
					}
					?>
            	</div>
			</div>
        </div>
    </form>
</div>