<?php
$term         = get_query_var( 'truckload_term' );
$filter_terms = get_query_var( 'truckload_filter_terms' );

if ( $term && ! is_wp_error( $term ) ) : ?>
	<div class="shopitem-filter flex flex-col gap-3">
		<button type="button" class="shopitem-filter-btn is-active text-left"
				data-cat="<?php echo esc_attr( $term->slug ); ?>">
			All <?php echo esc_html( $term->name ); ?>
		</button>
		<?php if ( ! empty( $filter_terms ) && ! is_wp_error( $filter_terms ) ) : ?>
			<?php foreach ( $filter_terms as $ft ) : ?>
				<button type="button" class="shopitem-filter-btn text-left"
						data-cat="<?php echo esc_attr( $ft->slug ); ?>">
					<?php echo esc_html( $ft->name ); ?>
				</button>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>