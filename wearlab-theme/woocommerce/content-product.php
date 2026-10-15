<?php
global $product;
if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
	$product = wc_get_product( get_the_ID() );
}
if ( empty( $product ) ) {
	return;
}
?>
<div <?php wc_product_class( 'wl-product-card', $product ); ?>>
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="wl-product-card__link">
		<div class="wl-product-card__image-wrapper">
			<?php
			// Primary product image
			echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'wl-product-card__img' ) );

			// Secondary hover image (if gallery exists)
			$gallery_image_ids = $product->get_gallery_image_ids();
			if ( ! empty( $gallery_image_ids ) ) {
				$hover_image_id = reset( $gallery_image_ids );
				echo wp_get_attachment_image( $hover_image_id, 'woocommerce_thumbnail', false, array( 'class' => 'wl-product-card__img wl-product-card__img--hover' ) );
			}

			// Sale badge
			if ( $product->is_on_sale() ) :
				?>
				<span class="wl-product-card__sale-badge">SALE</span>
			<?php endif; ?>
		</div>

		<div class="wl-product-card__info">
			<h2 class="wl-product-card__title"><?php echo esc_html( $product->get_name() ); ?></h2>
			<div class="wl-product-card__price">
				<?php echo $product->get_price_html(); ?>
			</div>
			<div class="wl-product-card__sizes">
				<?php
				$size_terms = array();
				if ( taxonomy_exists( 'pa_size' ) ) {
					$terms = wc_get_product_terms( $product->get_id(), 'pa_size', array( 'fields' => 'names' ) );
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						$size_terms = $terms;
					}
				}

				if ( empty( $size_terms ) ) {
					$size_attr = $product->get_attribute( 'pa_size' );
					if ( ! empty( $size_attr ) ) {
						$size_terms = array_filter( array_map( 'trim', explode( ',', $size_attr ) ) );
					}
				}

				$size_terms = array_values( array_filter( $size_terms, function( $st ) {
					return ! in_array( strtoupper( trim( $st ) ), array( '2XL', 'XXL' ) );
				} ) );

				if ( ! empty( $size_terms ) ) :
					foreach ( $size_terms as $size_term ) :
						?>
						<span class="wl-size-pill"><?php echo esc_html( $size_term ); ?></span>
						<?php
					endforeach;
				else :
					?>
					<span class="wl-size-pill">S</span>
					<span class="wl-size-pill">M</span>
					<span class="wl-size-pill">L</span>
					<span class="wl-size-pill">XL</span>
				<?php endif; ?>
			</div>
		</div>
	</a>
</div>
