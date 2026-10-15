<?php
/**
 * Cart Page Template for WEARLAB
 * Location: woocommerce/cart/cart.php
 * KhushPosh design with product rows, responsive quantity controls, and order summary card
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="wl-cart-page">
	<div class="wl-container">
		
		<div class="wl-cart-page-header">
			<h1 class="wl-cart-page-header__title"><?php esc_html_e( 'Your cart', 'wearlab' ); ?></h1>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="wl-cart-page-header__continue"><?php esc_html_e( 'Continue shopping', 'wearlab' ); ?></a>
		</div>

		<?php if ( ! WC()->cart->is_empty() ) : ?>
			<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<div class="wl-cart-page-layout">
					
					<!-- Left: Cart Items List -->
					<div class="wl-cart-page-items">
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<div class="wl-cart-page-row woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
									
									<div class="wl-cart-page-img">
										<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
										if ( ! $product_permalink ) {
											echo $thumbnail; // PHPCS: XSS ok.
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
										}
										?>
									</div>

									<div class="wl-cart-page-details">
										<h3>
											<?php
											if ( ! $product_permalink ) {
												echo wp_kses_post( $_product->get_name() );
											} else {
												echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
											}
											?>
										</h3>

										<div class="wl-cart-page-price">
											<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
										</div>

										<div class="wl-cart-page-meta">
											<?php
											echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
											?>
										</div>

										<div class="wl-cart-page-actions">
											<div class="wl-cart-page-qty">
												<?php
												if ( $_product->is_sold_individually() ) {
													$min_quantity = 1;
													$max_quantity = 1;
												} else {
													$min_quantity = 0;
													$max_quantity = $_product->get_max_purchase_quantity();
												}

												$product_quantity = woocommerce_quantity_input(
													array(
														'input_name'   => "cart[{$cart_item_key}][qty]",
														'input_value'  => $cart_item['quantity'],
														'max_value'    => $max_quantity,
														'min_value'    => $min_quantity,
														'product_name' => $_product->get_name(),
													),
													$_product,
													false
												);

												echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
												?>
											</div>

											<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="wl-cart-page-remove remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													/* translators: %s is the product name */
													esc_attr( sprintf( __( 'Remove %s from cart', 'wearlab' ), wp_strip_all_tags( $_product->get_name() ) ) ),
													esc_attr( $product_id ),
													esc_attr( $cart_item_key ),
													esc_attr( $_product->get_sku() )
												),
												$cart_item_key
											);
											?>
										</div>
									</div>

									<div class="wl-cart-page-line-total">
										<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
									</div>

								</div>
								<?php
							}
						}
						?>

						<?php do_action( 'woocommerce_cart_contents' ); ?>

						<div style="margin-top: 20px; display: flex; justify-content: flex-end;">
							<button type="submit" class="button wl-btn wl-btn--outline" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'wearlab' ); ?>"><?php esc_html_e( 'Update cart', 'wearlab' ); ?></button>
							<?php do_action( 'woocommerce_cart_actions' ); ?>
							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</div>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</div>

					<!-- Right: Order Summary -->
					<div class="wl-cart-page-summary">
						<h2 class="wl-cart-page-summary__title"><?php esc_html_e( 'Order summary', 'wearlab' ); ?></h2>
						
						<div class="wl-cart-page-summary__row">
							<span><?php esc_html_e( 'Subtotal', 'wearlab' ); ?></span>
							<strong><?php wc_cart_totals_subtotal_html(); ?></strong>
						</div>

						<div class="wl-cart-page-summary__row">
							<span><?php esc_html_e( 'Shipping', 'wearlab' ); ?></span>
							<span style="color: #008060; font-weight: 600;"><?php esc_html_e( 'FREE (Nationwide)', 'wearlab' ); ?></span>
						</div>

						<div class="wl-cart-page-summary__row wl-cart-page-summary__row--total">
							<span><?php esc_html_e( 'Estimated total', 'wearlab' ); ?></span>
							<strong><?php wc_cart_totals_order_total_html(); ?></strong>
						</div>

						<p class="wl-cart-page-summary__note">
							<?php esc_html_e( 'Taxes, Discounts and shipping calculated at checkout.', 'wearlab' ); ?>
						</p>

						<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="wl-cart-page-summary__checkout-btn">
							<?php esc_html_e( 'Proceed to Checkout', 'wearlab' ); ?>
						</a>
					</div>

				</div>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>
			</form>
		<?php else : ?>
			<!-- Empty Cart State -->
			<div class="wl-cart-empty-page">
				<svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
					<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
					<line x1="3" y1="6" x2="21" y2="6"></line>
					<path d="M16 10a4 4 0 0 1-8 0"></path>
				</svg>
				<h2><?php esc_html_e( 'Your cart is empty', 'wearlab' ); ?></h2>
				<p><?php esc_html_e( 'Looks like you have not added anything to your cart yet.', 'wearlab' ); ?></p>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="wl-btn wl-btn--primary" style="display: inline-block; padding: 14px 32px; text-decoration: none;">
					<?php esc_html_e( 'Start Shopping', 'wearlab' ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
