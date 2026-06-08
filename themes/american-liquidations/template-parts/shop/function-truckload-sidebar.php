<?php
$term         = get_query_var( 'truckload_term' );
$filter_terms = get_query_var( 'truckload_filter_terms' );

if ( $term && ! is_wp_error( $term ) ) : ?>
	<div class="filter-wrapper">
		<form id="truckload-shop-filters">
			<!-- All (default) -->
			<div class="mb-4">
				<label class="font-medium custom-radio-box">
					<input type="radio" name="truckload_cat" value="<?php echo esc_attr( $term->slug ); ?>" checked>
					<span class="input-radio-custom"></span>All <?php echo esc_html( $term->name ); ?>
				</label>
			</div>

			<?php if ( ! empty( $filter_terms ) && ! is_wp_error( $filter_terms ) ) : ?>
				<?php foreach ( $filter_terms as $ft ) : ?>
					<div class="mb-4">
						<label class="font-medium custom-radio-box">
							<input type="radio" name="truckload_cat" value="<?php echo esc_attr( $ft->slug ); ?>">
							<span class="input-radio-custom"></span><?php echo esc_html( $ft->name ); ?>
						</label>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</form>
	</div>
<?php endif; ?>