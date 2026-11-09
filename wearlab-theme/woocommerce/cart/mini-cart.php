<?php
/**
 * Mini-cart drawer template for WEARLAB
 * Matches KhushPosh side cart drawer exactly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cart_items = array();
$subtotal_raw = 'Rs. 0.00';
$total_count = 0;

if ( class_exists( 'WooCommerce' ) && WC()->cart ) {
	$cart_items = WC()->cart->get_cart();
	$subtotal_raw = WC()->cart->get_cart_subtotal();
	$total_count = WC()->cart->get_cart_contents_count();
}

$has_items = ! empty( $cart_items );
$checkout_url = class_exists( 'WooCommerce' ) ? wc_get_checkout_url() : home_url( '/checkout/' );
?>

<div class="wl-cart-drawer__body">
	<?php if ( $has_items ) : 
		$free_ship_target   = 3;
		$remaining_for_free = max( 0, $free_ship_target - $total_count );
		$progress_pct       = min( 100, round( ( $total_count / $free_ship_target ) * 100 ) );
	?>
		<div class="wl-cart-shipping-bar" style="background: #f7f9fa; border-radius: 6px; padding: 10px 14px; margin: 12px 0 14px; border: 1px solid #ebebeb;">
			<div style="font-size: 12px; font-weight: 600; color: #121212; display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
				<?php if ( $remaining_for_free === 0 ) : ?>
					<span style="color: #008060; display: inline-flex; align-items: center; gap: 4px;">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#008060" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
						You unlocked FREE Delivery!
					</span>
				<?php else : ?>
					<span>Add <?php echo esc_html( $remaining_for_free ); ?> more shirt<?php echo $remaining_for_free > 1 ? 's' : ''; ?> for <strong>FREE Delivery</strong></span>
				<?php endif; ?>
				<span style="font-size: 11px; color: #777; font-weight: 500;"><?php echo esc_html( $total_count ); ?>/3</span>
			</div>
			<div style="background: #e2e8f0; height: 5px; border-radius: 3px; overflow: hidden;">
				<div style="background: <?php echo $remaining_for_free === 0 ? '#008060' : '#121212'; ?>; height: 100%; width: <?php echo esc_attr( $progress_pct ); ?>%; transition: width 0.3s ease;"></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="wl-cart-drawer__columns-header">
		<span>PRODUCT</span>
		<span>TOTAL</span>
	</div>

	<?php if ( $has_items ) : ?>
		<div class="wl-cart-drawer__items">
			<?php
			foreach ( $cart_items as $cart_item_key => $cart_item ) :
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_subtotal  = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
					?>
					<div class="wl-cart-drawer__item" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
						<div class="wl-cart-drawer__item-img">
							<?php if ( empty( $product_permalink ) ) : ?>
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
							<?php endif; ?>
						</div>

						<div class="wl-cart-drawer__item-details">
							<div class="wl-cart-drawer__item-header">
								<h4 class="wl-cart-drawer__item-title">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo wp_kses_post( $_product->get_name() ); ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo wp_kses_post( $_product->get_name() ); ?></a>
									<?php endif; ?>
								</h4>
								<span class="wl-cart-drawer__item-total"><?php echo $product_subtotal; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</div>

							<div class="wl-cart-drawer__item-unit-price">
								<?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>

							<?php
							// Output variations e.g. Size: L, Color: White
							echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>

							<div class="wl-cart-drawer__item-actions">
								<div class="wl-cart-drawer__qty" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
									<button type="button" class="wl-cart-drawer__qty-btn" data-qty-change="-1" aria-label="Decrease">&minus;</button>
									<span class="wl-cart-drawer__qty-val"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
									<button type="button" class="wl-cart-drawer__qty-btn" data-qty-change="1" aria-label="Increase">&#43;</button>
								</div>
								<button type="button" class="wl-cart-drawer__item-remove" data-remove-key="<?php echo esc_attr( $cart_item_key ); ?>" aria-label="Remove item">
									<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
										<polyline points="3 6 5 6 21 6"></polyline>
										<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
									</svg>
								</button>
							</div>
						</div>
					</div>
				<?php
				endif;
			endforeach;
			?>
		</div>
	<?php else : ?>
		<div class="wl-cart-drawer__empty" style="text-align: center; padding: 48px 20px;">
			<svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; display: block;">
				<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
				<line x1="3" y1="6" x2="21" y2="6"></line>
				<path d="M16 10a4 4 0 0 1-8 0"></path>
			</svg>
			<p style="font-size: 16px; font-weight: 600; color: #121212; margin: 0 0 6px; text-transform: uppercase; letter-spacing: 0.03em;"><?php esc_html_e( 'Your cart is empty', 'wearlab' ); ?></p>
			<p style="font-size: 13px; color: #666; margin: 0 0 24px; line-height: 1.5;"><?php esc_html_e( 'Looks like you haven\'t added any items yet.', 'wearlab' ); ?></p>
			<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary" style="display: inline-block; padding: 12px 28px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; text-decoration: none;">
				<?php esc_html_e( 'Start Shopping', 'wearlab' ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>

<div class="wl-cart-drawer__footer"<?php echo ! $has_items ? ' style="display:none;"' : ''; ?>>
	<div class="wl-cart-drawer__total-row">
		<span class="wl-cart-drawer__total-label">Estimated total</span>
		<span class="wl-cart-drawer__total-val">
			<?php echo $has_items ? $subtotal_raw : 'Rs 0.00'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</span>
	</div>
	<p class="wl-cart-drawer__taxes-note">
		Taxes, Discounts and <a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>">shipping</a> calculated at checkout
	</p>
	<a href="<?php echo esc_url( $checkout_url ); ?>" class="wl-cart-drawer__checkout-btn">
		Check out
	</a>

	<!-- Trust Badges (Same Day Dispatch, Carefully Packed & Shipped, Free Shipping & Easy Returns) -->
	<div class="wl-cart-drawer__trust-badges">
		<div class="wl-cart-drawer__trust-badge">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
				<rect x="1" y="3" width="15" height="13"></rect>
				<polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
				<circle cx="5.5" cy="18.5" r="2.5"></circle>
				<circle cx="18.5" cy="18.5" r="2.5"></circle>
			</svg>
			<span>Same Day Dispatch</span>
		</div>
		<div class="wl-cart-drawer__trust-badge">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
				<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
				<polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
				<line x1="12" y1="22.08" x2="12" y2="12"></line>
			</svg>
			<span>Carefully Packed &amp; Shipped</span>
		</div>
		<div class="wl-cart-drawer__trust-badge">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
				<polyline points="23 4 23 10 17 10"></polyline>
				<polyline points="1 20 1 14 7 14"></polyline>
				<path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
			</svg>
			<span>Free Shipping &amp; Easy Returns</span>
		</div>
	</div>
</div>
