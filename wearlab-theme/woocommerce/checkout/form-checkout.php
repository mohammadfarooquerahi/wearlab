<?php
/**
 * Custom Checkout Template for WEARLAB
 * Matches KhushPosh Shopify-style two-column checkout exactly:
 * - Left column: Brand logo, Contact, Delivery, Shipping method (FREE), Payment (Cash on Delivery COD only), Billing address toggle, Complete order button, Policy links footer
 * - Right column: Items summary list with quantity badges, Discount code input + Apply, Subtotal, Free Shipping, Total in PKR
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Gather cart items or sample demo items if cart is empty
$has_wc = class_exists( 'WooCommerce' ) && WC()->cart;
$cart_items = $has_wc ? WC()->cart->get_cart() : array();
$subtotal_val = $has_wc ? WC()->cart->get_cart_subtotal() : 'Rs 0.00';
$total_val = $has_wc ? WC()->cart->get_total() : 'PKR Rs 0.00';
$total_count = $has_wc ? WC()->cart->get_cart_contents_count() : 0;

$checkout = $has_wc ? WC()->checkout() : null;
?>

<div class="wl-checkout-page">
	<div class="wl-checkout-container">
		<!-- LEFT COLUMN: Forms -->
		<div class="wl-checkout-main">
			<div class="wl-checkout-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wl-checkout-brand__logo">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-horizontal.png' ); ?>" alt="WEARLAB">
				</a>
				<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_cart_url() : home_url( '/cart/' ) ); ?>" class="wl-checkout-brand__cart-icon" aria-label="Cart">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
						<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
						<line x1="3" y1="6" x2="21" y2="6"></line>
						<path d="M16 10a4 4 0 0 1-8 0"></path>
					</svg>
				</a>
			</div>

			<form name="checkout" method="post" class="checkout woocommerce-checkout wl-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
				
				<?php if ( function_exists( 'woocommerce_output_all_notices' ) ) : ?>
					<div class="wl-co-notices">
						<?php woocommerce_output_all_notices(); ?>
					</div>
				<?php endif; ?>

				<!-- Hidden Address Defaults for Pakistan Checkout -->
				<input type="hidden" name="billing_state" id="billing_state" value="IS">
				<input type="hidden" name="shipping_state" id="shipping_state" value="IS">
				<input type="hidden" name="shipping_country" id="shipping_country" value="PK">
				<input type="hidden" name="ship_to_different_address" id="ship_to_different_address" value="0">
				
				<!-- 1. CONTACT -->
				<section class="wl-co-section">
					<div class="wl-co-section__header">
						<h2 class="wl-co-section__title">Contact</h2>
						<?php if ( ! is_user_logged_in() ) : ?>
							<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="wl-co-link">Sign in</a>
						<?php endif; ?>
					</div>
					<div class="wl-co-field-wrap">
						<input type="text" name="billing_email" id="billing_email" class="wl-co-input" placeholder="Email or mobile phone number" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_email' ) : '' ); ?>">
						<button type="button" class="wl-co-help-tooltip" aria-label="Help" title="In case we need to contact you about your order">?</button>
					</div>
					<label class="wl-co-checkbox-label">
						<input type="checkbox" name="newsletter_opt_in" value="1" checked>
						<span class="wl-co-checkbox-custom"></span>
						<span>Email me with news and offers</span>
					</label>
				</section>

				<!-- 2. DELIVERY -->
				<section class="wl-co-section">
					<div class="wl-co-section__header">
						<h2 class="wl-co-section__title">Delivery</h2>
					</div>

					<div class="wl-co-field-group">
						<!-- Country -->
						<div class="wl-co-field-wrap">
							<label class="wl-co-floating-label">Country/Region</label>
							<div class="wl-co-select-wrap">
								<select name="billing_country" id="billing_country" class="wl-co-select">
									<option value="PK" selected>Pakistan</option>
								</select>
								<svg class="wl-co-select-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</div>
						</div>

						<!-- First Name & Last Name (2 Cols) -->
						<div class="wl-co-row-2">
							<div class="wl-co-field-wrap">
								<input type="text" name="billing_first_name" id="billing_first_name" class="wl-co-input" placeholder="First name" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_first_name' ) : '' ); ?>">
							</div>
							<div class="wl-co-field-wrap">
								<input type="text" name="billing_last_name" id="billing_last_name" class="wl-co-input" placeholder="Last name" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_last_name' ) : '' ); ?>">
							</div>
						</div>

						<!-- Address -->
						<div class="wl-co-field-wrap">
							<input type="text" name="billing_address_1" id="billing_address_1" class="wl-co-input" placeholder="Address" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_address_1' ) : '' ); ?>">
						</div>

						<!-- Apartment, suite, etc. -->
						<div class="wl-co-field-wrap">
							<input type="text" name="billing_address_2" id="billing_address_2" class="wl-co-input" placeholder="Apartment, suite, etc. (optional)" value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_address_2' ) : '' ); ?>">
						</div>

						<!-- City & Postal Code (2 Cols) -->
						<div class="wl-co-row-2">
							<div class="wl-co-field-wrap">
								<input type="text" name="billing_city" id="billing_city" class="wl-co-input" placeholder="City" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_city' ) : '' ); ?>">
							</div>
							<div class="wl-co-field-wrap">
								<input type="text" name="billing_postcode" id="billing_postcode" class="wl-co-input" placeholder="Postal code (optional)" value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_postcode' ) : '' ); ?>">
							</div>
						</div>

						<!-- Phone -->
						<div class="wl-co-field-wrap">
							<input type="tel" name="billing_phone" id="billing_phone" class="wl-co-input" placeholder="Phone" required value="<?php echo esc_attr( $checkout ? $checkout->get_value( 'billing_phone' ) : '' ); ?>">
							<button type="button" class="wl-co-help-tooltip" aria-label="Help" title="Required for order delivery updates and courier dispatch">?</button>
						</div>
					</div>
				</section>

				<!-- 3. SHIPPING METHOD -->
				<section class="wl-co-section">
					<div class="wl-co-section__header">
						<h2 class="wl-co-section__title">Shipping method</h2>
					</div>
					<div class="wl-co-method-box">
						<div class="wl-co-method-box__left">
							<strong class="wl-co-method-box__title">Shipping</strong>
							<span class="wl-co-method-box__sub">Tracking number provided</span>
						</div>
						<div class="wl-co-method-box__price">
							FREE
						</div>
					</div>
				</section>

				<!-- 4. PAYMENT (COD ONLY) -->
				<section class="wl-co-section">
					<div class="wl-co-section__header">
						<h2 class="wl-co-section__title">Payment</h2>
						<p class="wl-co-section__subtitle">All transactions are secure and encrypted.</p>
					</div>

					<div class="wl-co-payment-group">
						<!-- Cash on Delivery (Selected) -->
						<div class="wl-co-payment-option is-selected">
							<label class="wl-co-radio-label">
								<input type="radio" name="payment_method" value="cod" checked>
								<span class="wl-co-radio-circle"></span>
								<span class="wl-co-payment-name">Cash on Delivery (COD)</span>
							</label>
							<div class="wl-co-payment-notice">
								Only Available in Pakistan
							</div>
						</div>

						<!-- Other disabled methods for visual match with KhushPosh SS -->
						<div class="wl-co-payment-option is-disabled">
							<label class="wl-co-radio-label">
								<input type="radio" name="payment_method_disabled" value="card" disabled>
								<span class="wl-co-radio-circle"></span>
								<span class="wl-co-payment-name">Credit card</span>
							</label>
							<div class="wl-co-card-icons">
								<span class="wl-co-card-badge wl-co-visa">VISA</span>
								<span class="wl-co-card-badge wl-co-mc">MC</span>
								<span class="wl-co-card-badge wl-co-more">+5</span>
							</div>
						</div>

						<div class="wl-co-payment-option is-disabled">
							<label class="wl-co-radio-label">
								<input type="radio" name="payment_method_disabled_bank" value="bank" disabled>
								<span class="wl-co-radio-circle"></span>
								<span class="wl-co-payment-name">Bank Transfer</span>
							</label>
						</div>
					</div>
				</section>

				<!-- 5. BILLING ADDRESS -->
				<section class="wl-co-section">
					<div class="wl-co-section__header">
						<h2 class="wl-co-section__title">Billing address</h2>
					</div>
					<div class="wl-co-billing-group">
						<div class="wl-co-billing-option is-selected">
							<label class="wl-co-radio-label">
								<input type="radio" name="bill_to_different_address" value="0" checked>
								<span class="wl-co-radio-circle"></span>
								<span>Same as shipping address</span>
							</label>
						</div>
						<div class="wl-co-billing-option">
							<label class="wl-co-radio-label">
								<input type="radio" name="bill_to_different_address" value="1">
								<span class="wl-co-radio-circle"></span>
								<span>Use a different billing address</span>
							</label>
						</div>
					</div>
				</section>

				<!-- 6. SUBMIT BUTTON -->
				<div class="wl-co-submit-wrap">
					<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
					<input type="hidden" name="woocommerce_checkout_place_order" value="1">
					<button type="submit" class="wl-co-complete-btn" id="place_order" name="woocommerce_checkout_place_order" value="Complete order" data-value="Complete order">
						Complete order
					</button>
				</div>

				<!-- 7. FOOTER POLICY LINKS -->
				<footer class="wl-co-footer-links">
					<a href="<?php echo esc_url( home_url( '/returns-policy/' ) ); ?>">Refund policy</a>
					<a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>">Shipping</a>
					<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy policy</a>
					<a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>">Terms of service</a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
				</footer>
			</form>
		</div>

		<!-- RIGHT COLUMN: Order Summary -->
		<aside class="wl-checkout-sidebar">
			<div class="wl-co-summary-sticky">
				<!-- Items List -->
				<div class="wl-co-items">
					<?php if ( $has_wc && ! empty( $cart_items ) ) : ?>
						<?php
						foreach ( $cart_items as $cart_item_key => $cart_item ) :
							$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
								$thumbnail = $_product->get_image( array( 64, 78 ) );
								$product_subtotal = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
								$variation_data = wc_get_formatted_cart_item_data( $cart_item, true );
								?>
								<div class="wl-co-item">
									<div class="wl-co-item__thumb">
										<?php echo $thumbnail; // phpcs:ignore ?>
										<span class="wl-co-item__qty-badge"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
									</div>
									<div class="wl-co-item__info">
										<h4 class="wl-co-item__title"><?php echo esc_html( $_product->get_name() ); ?></h4>
										<?php if ( $variation_data ) : ?>
											<span class="wl-co-item__variant"><?php echo esc_html( $variation_data ); ?></span>
										<?php endif; ?>
									</div>
									<div class="wl-co-item__price">
										<?php echo $product_subtotal; // phpcs:ignore ?>
									</div>
								</div>
								<?php
							endif;
						endforeach;
						?>
					<?php else : ?>
						<p class="wl-co-empty-notice" style="padding: 24px 0; color: #666; font-size: 14px;">Your cart is currently empty. <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" style="color: #121212; text-decoration: underline; font-weight: 600;">Return to shop</a></p>
					<?php endif; ?>
				</div>


				<!-- Subtotals & Totals -->
				<div class="wl-co-totals">
					<div class="wl-co-total-row">
						<span>Subtotal &bull; <?php echo esc_html( $total_count ); ?> items</span>
						<span class="wl-co-total-num"><?php echo $subtotal_val; // phpcs:ignore ?></span>
					</div>
					<div class="wl-co-total-row">
						<span>Shipping <button type="button" class="wl-co-shipping-tooltip" title="Free standard shipping across Pakistan">?</button></span>
						<span class="wl-co-shipping-free">FREE</span>
					</div>
					<div class="wl-co-total-row wl-co-total-final">
						<span class="wl-co-total-final__label">Total</span>
						<span class="wl-co-total-final__amount">
							<small>PKR</small> <strong><?php echo $has_wc ? WC()->cart->get_total() : 'Rs 7,997.00'; // phpcs:ignore ?></strong>
						</span>
					</div>
				</div>
			</div>
		</aside>
	</div>
</div>

<?php get_footer(); ?>
