<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$theme_uri = get_template_directory_uri();
$dummy_gallery = array(
	$theme_uri . '/assets/images/product-placeholder-1.jpg',
	$theme_uri . '/assets/images/product-placeholder-2.jpg',
	$theme_uri . '/assets/images/product-placeholder-3.jpg',
	$theme_uri . '/assets/images/product-placeholder-4.jpg',
);
$dummy_sizes   = array( 'S', 'M', 'L', 'XL' );
$dummy_related = array(
	array( 'name' => 'White Ringer Tee', 'price' => 'Rs.1,999.00 PKR', 'img' => $theme_uri . '/assets/images/product-placeholder-3.jpg', 'url' => home_url( '/shop/' ) ),
	array( 'name' => 'Baby Tee Women', 'price' => 'Rs.1,799.00 PKR', 'img' => $theme_uri . '/assets/images/cat-women.jpg', 'url' => home_url( '/shop/' ) ),
	array( 'name' => 'Muted Olive Baby Tee', 'price' => 'Rs.1,999.00 PKR', 'img' => $theme_uri . '/assets/images/product-placeholder-2.jpg', 'url' => home_url( '/shop/' ) ),
	array( 'name' => 'Boxy Tee Men', 'price' => 'Rs.1,799.00 PKR', 'img' => $theme_uri . '/assets/images/product-placeholder-4.jpg', 'url' => home_url( '/shop/' ) ),
);
?>

<div class="wl-pdp">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$product = class_exists( 'WooCommerce' ) ? wc_get_product( get_the_ID() ) : null;
		$is_wc   = ( $product instanceof WC_Product );

		$title = get_the_title();
		$price_html = $is_wc ? $product->get_price_html() : 'Rs.1,999.00 PKR';
		$excerpt = $is_wc ? $product->get_short_description() : '';
		if ( empty( wp_strip_all_tags( (string) $excerpt ) ) ) {
			$excerpt = 'Models are 6\'3" and are wearing a size L.';
		}

		$description = get_the_content();
		if ( empty( wp_strip_all_tags( (string) $description ) ) ) {
			$description = '<p>This classic men\'s baby tee features a timeless cropped silhouette, a snug fit that hugs the body, and minimal detailing for a clean, effortless look. The cotton-lycra blend provides structure with just the right amount of stretch for all-day wear.</p>';
		}

		$details_html = '<ul>
			<li>Material: 95% Cotton, 5% Lycra</li>
			<li>Fit: Body-hugging cropped cut</li>
			<li>Neckline: Crew neck</li>
			<li>WEARLAB Woven Label</li>
		</ul>';
		$care_html = '<p>Take care as specified on care label.</p>';

		$gallery = array();
		if ( $is_wc ) {
			if ( $product->get_image_id() ) {
				$gallery[] = array(
					'thumb' => wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_single' ),
					'full'  => wp_get_attachment_image_url( $product->get_image_id(), 'full' ),
					'alt'   => $title,
				);
			}
			foreach ( $product->get_gallery_image_ids() as $gid ) {
				$gallery[] = array(
					'thumb' => wp_get_attachment_image_url( $gid, 'woocommerce_single' ),
					'full'  => wp_get_attachment_image_url( $gid, 'full' ),
					'alt'   => $title,
				);
			}
		}
		if ( empty( $gallery ) || isset( $_GET['demo_gallery'] ) ) {
			if ( isset( $_GET['demo_gallery'] ) ) {
				$gallery = array();
			}
			foreach ( $dummy_gallery as $src ) {
				$gallery[] = array( 'thumb' => $src, 'full' => $src, 'alt' => $title );
			}
		}

		$sizes = array();
		$size_attr_name = '';
		if ( $is_wc && $product->is_type( 'variable' ) ) {
			foreach ( $product->get_variation_attributes() as $attr_name => $options ) {
				$field_name = ( 0 === strpos( $attr_name, 'attribute_' ) ) ? $attr_name : 'attribute_' . sanitize_title( $attr_name );
				$key = strtolower( $attr_name );
				if ( false !== strpos( $key, 'size' ) ) {
					$sizes = array_values( array_filter( $options, function( $s ) {
						$label = strtoupper( trim( is_string( $s ) ? $s : ( $s->name ?? '' ) ) );
						return ! in_array( $label, array( '2XL', 'XXL' ) );
					} ) );
					$size_attr_name = $field_name;
				}
			}
		}
		if ( empty( $sizes ) ) {
			$sizes = $dummy_sizes;
		}
		$sizes = array_values( array_filter( $sizes, function( $s ) {
			$label = strtoupper( trim( is_string( $s ) ? $s : ( $s->name ?? '' ) ) );
			return ! in_array( $label, array( '2XL', 'XXL' ) );
		} ) );

		$form_action = $is_wc ? apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) : '';
		$product_id  = $is_wc ? $product->get_id() : 0;
		$is_variable = $is_wc && $product->is_type( 'variable' );
		$available_variations = ( $is_variable ) ? $product->get_available_variations() : array();
		$initial_var_id = ( ! empty( $available_variations ) && ! empty( $available_variations[0]['variation_id'] ) ) ? $available_variations[0]['variation_id'] : 0;
		$gallery_count = count( $gallery );
		?>

		<div class="wl-pdp__layout">
			<div class="wl-pdp__gallery-wrapper">
				<div class="wl-pdp__gallery" data-pdp-gallery>
					<?php foreach ( $gallery as $idx => $img ) : ?>
						<figure class="wl-pdp__shot" data-slide-index="<?php echo esc_attr( $idx ); ?>">
							<img src="<?php echo esc_url( $img['thumb'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" <?php echo ( 0 === $idx ) ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
						</figure>
					<?php endforeach; ?>
				</div>

				<?php if ( $gallery_count > 1 ) : ?>
					<div class="wl-pdp__gallery-nav" aria-label="Product image slides">
						<button type="button" class="wl-pdp__gallery-btn wl-pdp__gallery-btn--prev" data-gallery-prev aria-label="Previous slide">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="6.5 1.5 3 5 6.5 8.5"></polyline>
							</svg>
						</button>
						<div class="wl-pdp__gallery-counter">
							<span class="wl-pdp__gallery-current" data-gallery-current>1</span>
							<span class="wl-pdp__gallery-sep"> / </span>
							<span class="wl-pdp__gallery-total" data-gallery-total="<?php echo esc_attr( $gallery_count ); ?>"><?php echo esc_html( $gallery_count ); ?></span>
						</div>
						<button type="button" class="wl-pdp__gallery-btn wl-pdp__gallery-btn--next" data-gallery-next aria-label="Next slide">
							<svg width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
								<polyline points="3.5 1.5 7 5 3.5 8.5"></polyline>
							</svg>
						</button>
					</div>

					<div class="wl-pdp__gallery-thumbs" aria-label="Product thumbnails">
						<?php foreach ( $gallery as $idx => $img ) : ?>
							<button type="button" class="wl-pdp__gallery-thumb<?php echo ( 0 === $idx ) ? ' is-active' : ''; ?>" data-thumb-index="<?php echo esc_attr( $idx ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d', 'wearlab' ), $idx + 1 ) ); ?>">
								<img src="<?php echo esc_url( $img['thumb'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" loading="lazy">
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="wl-pdp__info">
				<div class="wl-pdp__sticky">
					<h1 class="wl-pdp__title"><?php echo esc_html( $title ); ?></h1>
					<div class="wl-pdp__price"><?php echo wp_kses_post( $price_html ); ?></div>
					<div class="wl-pdp__excerpt"><?php echo wp_kses_post( wpautop( $excerpt ) ); ?></div>

					<form class="wl-pdp__form cart<?php echo $is_variable ? ' variations_form' : ''; ?>" method="post" enctype="multipart/form-data" action="<?php echo esc_url( $form_action ); ?>">
						<?php if ( $is_wc ) : ?>
							<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">
							<input type="hidden" name="product_id" value="<?php echo esc_attr( $product_id ); ?>">
							<?php if ( $is_variable ) : ?>
								<input type="hidden" name="variation_id" class="variation_id" value="<?php echo esc_attr( $initial_var_id ); ?>">
							<?php endif; ?>
						<?php endif; ?>

						<div class="wl-pdp-field">
							<p class="wl-pdp-field__label">Size</p>
							<div class="wl-pdp-swatches" data-attr="<?php echo esc_attr( $size_attr_name ); ?>">
								<?php foreach ( $sizes as $i => $size ) :
									$val = is_string( $size ) ? $size : wc_attribute_label( $size );
									?>
									<button type="button" class="wl-pdp-swatch<?php echo 0 === $i ? ' is-selected' : ''; ?>" data-value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $val ); ?></button>
								<?php endforeach; ?>
							</div>
							<?php if ( $size_attr_name ) : ?>
								<input type="hidden" class="wl-pdp-attr-input" name="<?php echo esc_attr( $size_attr_name ); ?>" value="<?php echo esc_attr( $sizes[0] ?? '' ); ?>">
							<?php endif; ?>
						</div>

						<p class="wl-pdp__size-guide">
							<button type="button" class="wl-pdp__size-guide-btn" data-open-size-guide>View Size Guide</button>
						</p>

						<div class="wl-pdp-field">
							<p class="wl-pdp-field__label">Quantity</p>
							<div class="wl-pdp-qty">
								<button type="button" class="wl-pdp-qty__btn wl-qty-minus" data-qty="-1" aria-label="Decrease quantity">
									<svg width="12" height="2" viewBox="0 0 12 2" fill="none"><line x1="0" y1="1" x2="12" y2="1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
								</button>
								<input type="number" class="wl-pdp-qty__input" name="quantity" value="1" min="1" max="99" step="1" inputmode="numeric">
								<button type="button" class="wl-pdp-qty__btn wl-qty-plus" data-qty="1" aria-label="Increase quantity">
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none"><line x1="6" y1="0" x2="6" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="0" y1="6" x2="12" y2="6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
								</button>
							</div>
						</div>

						<div class="wl-pdp-actions">
							<button type="submit" class="wl-pdp__atc wl-add-to-cart" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">Add to cart</button>
							<button type="button" class="wl-pdp__buy-now wl-buy-now" data-product-id="<?php echo esc_attr( $product_id ); ?>">Buy It Now</button>
						</div>

						<?php if ( $is_variable ) : ?>
							<script type="application/json" class="wl-pdp-variations"><?php echo wp_json_encode( $available_variations ); ?></script>
						<?php endif; ?>
					</form>

					<div class="wl-pdp-ship">
						<div class="wl-pdp-ship__title">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 7h11v10H3V7zm11 3h4l3 3v4h-7v-7z" stroke="currentColor" stroke-width="1.6"/><circle cx="7.5" cy="18.5" r="1.7" fill="currentColor"/><circle cx="17.5" cy="18.5" r="1.7" fill="currentColor"/></svg>
							Free Shipping (All Over Pakistan)
						</div>
						<p class="wl-pdp-ship__text"><span class="wl-pdp-ship__dot"></span> If you order today, it will be delivered within 3–5 business days.</p>
					</div>

					<p class="wl-pdp-note"><strong>Payment:</strong> Cash on Delivery (COD) only — pay when your order arrives at your doorstep.</p>

					<div class="wl-pdp-acc">
						<div class="wl-pdp-acc__item is-open">
							<button type="button" class="wl-pdp-acc__btn">
								<span class="wl-pdp-acc__icon" aria-hidden="true">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="6" y="3" width="12" height="18" rx="1.5"/><path d="M9 8h6M9 12h6M9 16h4"/></svg>
								</span>
								<span>Description</span>
								<span class="wl-pdp-acc__chevron"></span>
							</button>
							<div class="wl-pdp-acc__panel">
								<?php echo wp_kses_post( apply_filters( 'the_content', $description ) ); ?>
							</div>
						</div>

						<div class="wl-pdp-acc__item">
							<button type="button" class="wl-pdp-acc__btn">
								<span class="wl-pdp-acc__icon" aria-hidden="true">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 12l-8-8H5v16h16v-8z"/><circle cx="9" cy="9" r="1.2" fill="currentColor" stroke="none"/></svg>
								</span>
								<span>Details</span>
								<span class="wl-pdp-acc__chevron"></span>
							</button>
							<div class="wl-pdp-acc__panel">
								<?php echo wp_kses_post( $details_html ); ?>
							</div>
						</div>

						<div class="wl-pdp-acc__item">
							<button type="button" class="wl-pdp-acc__btn">
								<span class="wl-pdp-acc__icon" aria-hidden="true">
									<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 7h16M6 7l1.2 13h9.6L18 7"/><path d="M9 7V5.5A3 3 0 0 1 12 2.5 3 3 0 0 1 15 5.5V7"/></svg>
								</span>
								<span>Take Care of Me</span>
								<span class="wl-pdp-acc__chevron"></span>
							</button>
							<div class="wl-pdp-acc__panel">
								<?php echo wp_kses_post( $care_html ); ?>
							</div>
						</div>
					</div>

					<button type="button" class="wl-pdp-share" data-share>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="18" cy="5" r="2.4"/><circle cx="6" cy="12" r="2.4"/><circle cx="18" cy="19" r="2.4"/><path d="M8.2 13.2l7.5 4.2M15.7 6.6l-7.5 4.2"/></svg>
						Share
					</button>
				</div>
			</div>
		</div>

		<section class="wl-pdp-related">
			<h2 class="wl-pdp-related__title">You may also like</h2>
			<div class="wl-pdp-related__grid">
				<?php
				$related_shown = false;
				if ( $is_wc ) {
					$related_ids = wc_get_related_products( $product->get_id(), 4 );
					if ( $related_ids ) {
						$related_shown = true;
						foreach ( $related_ids as $rid ) {
							$rp = wc_get_product( $rid );
							if ( ! $rp ) {
								continue;
							}
							$rimg = $rp->get_image_id() ? wp_get_attachment_image_url( $rp->get_image_id(), 'woocommerce_thumbnail' ) : $dummy_gallery[0];
							?>
							<a href="<?php echo esc_url( $rp->get_permalink() ); ?>" class="wl-pdp-related__card">
								<div class="wl-pdp-related__img">
									<img src="<?php echo esc_url( $rimg ); ?>" alt="<?php echo esc_attr( $rp->get_name() ); ?>">
								</div>
								<h3 class="wl-pdp-related__name"><?php echo esc_html( $rp->get_name() ); ?></h3>
								<p class="wl-pdp-related__price"><?php echo wp_kses_post( $rp->get_price_html() ); ?></p>
							</a>
							<?php
						}
					}
				}
				if ( ! $related_shown ) :
					foreach ( $dummy_related as $item ) :
					?>
					<a href="<?php echo esc_url( $item['url'] ); ?>" class="wl-pdp-related__card">
						<div class="wl-pdp-related__img">
							<img src="<?php echo esc_url( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
						</div>
						<h3 class="wl-pdp-related__name"><?php echo esc_html( $item['name'] ); ?></h3>
						<p class="wl-pdp-related__price"><?php echo esc_html( $item['price'] ); ?></p>
					</a>
					<?php
					endforeach;
				endif;
				?>
			</div>
		</section>
	<?php endwhile; ?>
</div>

<div class="wl-size-guide" hidden>
	<div class="wl-size-guide__backdrop" data-close-size-guide></div>
	<div class="wl-size-guide__panel" role="dialog" aria-labelledby="wl-size-guide-title">
		<div class="wl-size-guide__head">
			<h2 id="wl-size-guide-title">Size Guide</h2>
			<button type="button" class="wl-size-guide__close" data-close-size-guide aria-label="Close">×</button>
		</div>
		<p class="wl-size-guide__hint">Measure the chest from just below the underarms, and measure the length from the side corner of the collar down to the hem.</p>
		<table class="wl-size-guide__table">
			<thead>
				<tr><th>Size</th><th>Chest (in)</th><th>Length (in)</th></tr>
			</thead>
			<tbody>
				<tr><td>S</td><td>38</td><td>24</td></tr>
				<tr><td>M</td><td>40</td><td>25</td></tr>
				<tr><td>L</td><td>42</td><td>26</td></tr>
				<tr><td>XL</td><td>44</td><td>27</td></tr>
			</tbody>
		</table>
	</div>
</div>

<?php get_footer(); ?>
