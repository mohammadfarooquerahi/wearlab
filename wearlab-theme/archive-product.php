<?php
/**
 * WEARLAB – Shop / Collection Archive Page
 * KhushPosh-style: filter sidebar + toolbar + 4-column grid
 */
get_header();

$current_cat   = is_product_category() ? get_queried_object() : null;
$page_title    = $current_cat ? $current_cat->name : ( ( is_page( 'new-arrivals' ) || ( isset( $_GET['filter'] ) && $_GET['filter'] === 'new-arrivals' ) ) ? 'New Arrivals' : 'Shop All' );

// Get product categories for filter
$product_cats = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => true,
	'parent'     => 0,
	'exclude'    => array( get_option( 'default_product_cat' ) ),
) );
if ( is_wp_error( $product_cats ) ) $product_cats = array();

// Get size attribute terms
$size_terms = array();
if ( taxonomy_exists( 'pa_size' ) ) {
	$size_terms = get_terms( array( 'taxonomy' => 'pa_size', 'hide_empty' => true ) );
	if ( is_wp_error( $size_terms ) ) {
		$size_terms = array();
	} else {
		$size_terms = array_values( array_filter( $size_terms, function( $term ) {
			return ! in_array( strtoupper( trim( $term->name ?? $term->slug ?? '' ) ), array( '2XL', 'XXL' ) );
		} ) );
	}
}
$fallback_sizes = array( 'S', 'M', 'L', 'XL' );

// Current filter states from URL
$active_min_price = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : '';
$active_max_price = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : '';
$active_size      = isset( $_GET['filter_size'] ) ? sanitize_text_field( $_GET['filter_size'] ) : '';

// Helper: build current URL with added/removed params
function wl_shop_filter_url( $add = array(), $remove = array() ) {
	$params = $_GET;
	foreach ( $remove as $key ) {
		unset( $params[ $key ] );
	}
	foreach ( $add as $key => $val ) {
		$params[ $key ] = $val;
	}
	$base = is_product_category() ? get_term_link( get_queried_object() ) : get_permalink( wc_get_page_id( 'shop' ) );
	if ( is_wp_error( $base ) ) $base = home_url( '/shop/' );
	return add_query_arg( $params, $base );
}
?>

<div class="wl-shop-page">
	<div class="wl-container">
		<!-- Page Header -->
		<div class="wl-shop-header">
			<h1 class="wl-shop-header__title"><?php echo esc_html( $page_title ); ?></h1>
			<div class="wl-shop-header__breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
				<?php if ( $current_cat ) : ?>
					<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">Shop</a> /
					<span><?php echo esc_html( $current_cat->name ); ?></span>
				<?php else : ?>
					<span>Shop</span>
				<?php endif; ?>
			</div>
		</div>

		<!-- Toolbar -->
		<div class="wl-shop-toolbar">
			<div class="wl-shop-toolbar__left">
				<button type="button" class="wl-shop-filter-toggle" aria-label="Toggle Filters">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
						<line x1="4" y1="6" x2="20" y2="6"></line>
						<line x1="4" y1="12" x2="14" y2="12"></line>
						<line x1="4" y1="18" x2="10" y2="18"></line>
					</svg>
					Filter
				</button>
				<div class="wl-shop-toolbar__count">
					<?php woocommerce_result_count(); ?>
				</div>
			</div>
			<div class="wl-shop-toolbar__right">
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>

		<!-- Mobile Filter Backdrop -->
		<div class="wl-shop-filter-backdrop"></div>

		<!-- Layout: Sidebar + Products -->
		<div class="wl-shop-layout">

			<!-- Left Sidebar -->
			<aside class="wl-shop-sidebar" id="wlShopSidebar">
				<!-- Mobile Header (visible <1024px) -->
				<div class="wl-shop-sidebar__mobile-header">
					<span class="wl-shop-sidebar__mobile-title">Filters</span>
					<button class="wl-shop-sidebar__mobile-close" aria-label="Close Filters">&times;</button>
				</div>

				<!-- Category Filter -->
				<div class="wl-filter-widget is-open">
					<div class="wl-filter-widget__header">
						<h3 class="wl-filter-widget__title">Category</h3>
						<svg class="wl-filter-widget__chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="2 4 6 8 10 4"></polyline>
						</svg>
					</div>
					<div class="wl-filter-widget__body">
						<ul class="wl-filter-list">
							<li>
								<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"
								   class="<?php echo ( ! $current_cat ) ? 'is-active' : ''; ?>">
									All Products
								</a>
							</li>
							<?php foreach ( $product_cats as $cat ) : ?>
								<li>
									<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
									   class="<?php echo ( $current_cat && $current_cat->term_id === $cat->term_id ) ? 'is-active' : ''; ?>">
										<?php echo esc_html( $cat->name ); ?>
										<span class="wl-filter-count">(<?php echo esc_html( $cat->count ); ?>)</span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- Size Filter -->
				<div class="wl-filter-widget is-open">
					<div class="wl-filter-widget__header">
						<h3 class="wl-filter-widget__title">Size</h3>
						<svg class="wl-filter-widget__chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="2 4 6 8 10 4"></polyline>
						</svg>
					</div>
					<div class="wl-filter-widget__body">
						<ul class="wl-filter-sizes">
							<?php
							$sizes_to_show = ! empty( $size_terms ) ? $size_terms : array();
							if ( ! empty( $sizes_to_show ) ) :
								foreach ( $sizes_to_show as $term ) :
									$is_active = ( strtolower( $active_size ) === strtolower( $term->slug ) );
									$url = $is_active
										? wl_shop_filter_url( array(), array( 'filter_size' ) )
										: wl_shop_filter_url( array( 'filter_size' => $term->slug ) );
									?>
									<li>
										<a href="<?php echo esc_url( $url ); ?>"
										   class="wl-filter-size-pill <?php echo $is_active ? 'is-active' : ''; ?>">
											<?php echo esc_html( strtoupper( $term->name ) ); ?>
										</a>
									</li>
								<?php endforeach;
							else :
								foreach ( $fallback_sizes as $sz ) :
									$slug = strtolower( $sz );
									$is_active = ( strtolower( $active_size ) === $slug );
									$url = $is_active
										? wl_shop_filter_url( array(), array( 'filter_size' ) )
										: wl_shop_filter_url( array( 'filter_size' => $slug ) );
									?>
									<li>
										<a href="<?php echo esc_url( $url ); ?>"
										   class="wl-filter-size-pill <?php echo $is_active ? 'is-active' : ''; ?>">
											<?php echo esc_html( $sz ); ?>
										</a>
									</li>
								<?php endforeach;
							endif;
							?>
						</ul>
					</div>
				</div>

				<!-- Price Filter -->
				<div class="wl-filter-widget is-open">
					<div class="wl-filter-widget__header">
						<h3 class="wl-filter-widget__title">Price</h3>
						<svg class="wl-filter-widget__chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="2 4 6 8 10 4"></polyline>
						</svg>
					</div>
					<div class="wl-filter-widget__body">
						<?php
						$price_ranges = array(
							array( 'label' => 'Under Rs.2,000',       'min' => 0,    'max' => 2000 ),
							array( 'label' => 'Rs.2,000 – Rs.4,000',  'min' => 2000, 'max' => 4000 ),
							array( 'label' => 'Over Rs.4,000',         'min' => 4000, 'max' => ''   ),
						);
						?>
						<ul class="wl-filter-price-list">
							<?php foreach ( $price_ranges as $range ) :
								$is_active = ( $active_min_price !== '' && (float) $active_min_price === (float) $range['min'] );
								$add = array( 'min_price' => $range['min'] );
								if ( $range['max'] !== '' ) {
									$add['max_price'] = $range['max'];
								}
								$url = $is_active
									? wl_shop_filter_url( array(), array( 'min_price', 'max_price' ) )
									: wl_shop_filter_url( $add, array( 'min_price', 'max_price' ) );
								?>
								<li>
									<a href="<?php echo esc_url( $url ); ?>"
									   class="<?php echo $is_active ? 'is-active' : ''; ?>">
										<?php echo esc_html( $range['label'] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>

				<!-- Availability -->
				<div class="wl-filter-widget is-open">
					<div class="wl-filter-widget__header">
						<h3 class="wl-filter-widget__title">Availability</h3>
						<svg class="wl-filter-widget__chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<polyline points="2 4 6 8 10 4"></polyline>
						</svg>
					</div>
					<div class="wl-filter-widget__body">
						<ul class="wl-filter-list">
							<li>
								<label>
									<input type="checkbox" <?php checked( isset( $_GET['stock_status'] ) && $_GET['stock_status'] === 'instock' ); ?>
										   onchange="window.location.href = this.checked ? '<?php echo esc_js( wl_shop_filter_url( array( 'stock_status' => 'instock' ) ) ); ?>' : '<?php echo esc_js( wl_shop_filter_url( array(), array( 'stock_status' ) ) ); ?>';">
									In Stock
								</label>
							</li>
						</ul>
					</div>
				</div>
			</aside>

			<!-- Product Grid -->
			<div class="wl-shop-products">
				<?php
				$rendered = false;
				if ( woocommerce_product_loop() && have_posts() ) {
					woocommerce_product_loop_start();
					while ( have_posts() ) {
						the_post();
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
						$rendered = true;
					}
					woocommerce_product_loop_end();
					do_action( 'woocommerce_after_shop_loop' );
				}

				if ( ! $rendered ) {
					// Direct query fallback for robustness across all WooCommerce configs & live environments
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$shop_args = array(
						'post_type'      => 'product',
						'posts_per_page' => 16,
						'post_status'    => 'publish',
						'paged'          => $paged,
					);
					if ( is_product_category() ) {
						$cat = get_queried_object();
						if ( $cat && isset( $cat->slug ) ) {
							if ( $cat->slug === 'new-arrivals' ) {
								$shop_args['orderby'] = 'date';
								$shop_args['order']   = 'DESC';
								if ( ! empty( $cat->count ) && $cat->count > 0 ) {
									$shop_args['tax_query'] = array(
										array(
											'taxonomy' => 'product_cat',
											'field'    => 'slug',
											'terms'    => $cat->slug,
										),
									);
								}
							} else {
								$shop_args['tax_query'] = array(
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => $cat->slug,
									),
								);
							}
						}
					} elseif ( is_page( 'new-arrivals' ) || ( isset( $_GET['filter'] ) && $_GET['filter'] === 'new-arrivals' ) ) {
						$shop_args['orderby'] = 'date';
						$shop_args['order']   = 'DESC';
					}

					if ( ! empty( $_GET['orderby'] ) ) {
						switch ( sanitize_text_field( $_GET['orderby'] ) ) {
							case 'price':
							case 'price-asc':
								$shop_args['orderby']  = 'meta_value_num';
								$shop_args['meta_key'] = '_price';
								$shop_args['order']    = 'ASC';
								break;
							case 'price-desc':
								$shop_args['orderby']  = 'meta_value_num';
								$shop_args['meta_key'] = '_price';
								$shop_args['order']    = 'DESC';
								break;
							case 'date':
								$shop_args['orderby'] = 'date';
								$shop_args['order']   = 'DESC';
								break;
						}
					}
					// Apply size filter
					if ( ! empty( $_GET['filter_size'] ) ) {
						if ( ! isset( $shop_args['tax_query'] ) ) $shop_args['tax_query'] = array();
						$shop_args['tax_query'][] = array(
							'taxonomy' => 'pa_size',
							'field'    => 'slug',
							'terms'    => sanitize_text_field( $_GET['filter_size'] ),
						);
					}

					$fallback_loop = new WP_Query( $shop_args );
					if ( $fallback_loop->have_posts() ) {
						echo '<ul class="products columns-4">';
						while ( $fallback_loop->have_posts() ) {
							$fallback_loop->the_post();
							wc_get_template_part( 'content', 'product' );
						}
						echo '</ul>';
						wp_reset_postdata();
					} else {
						?>
						<div class="wl-shop-empty">
							<p>No products found matching your selection.</p>
							<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="wl-btn wl-btn--outline">View All Products</a>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
