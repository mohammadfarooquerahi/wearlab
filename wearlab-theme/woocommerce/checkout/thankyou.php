<?php
/**
 * Thankyou / Order Confirmation Template for WEARLAB
 * Matches KhushPosh Shopify-style order status & confirmation
 * Location: woocommerce/checkout/thankyou.php
 */

defined( 'ABSPATH' ) || exit;

global $wp;
if ( ! isset( $order ) || ! $order ) {
	$order_id = isset( $wp->query_vars['order-received'] ) ? absint( $wp->query_vars['order-received'] ) : 0;
	if ( ! $order_id && isset( $_GET['order_id'] ) ) {
		$order_id = absint( $_GET['order_id'] );
	}
	if ( ! $order_id && preg_match( '#order-received[=/](\d+)#i', $_SERVER['REQUEST_URI'] ?? '', $m ) ) {
		$order_id = absint( $m[1] );
	}
	if ( $order_id ) {
		$order = wc_get_order( $order_id );
	}
}

// Build WhatsApp instant confirmation link
$wa_num       = get_theme_mod( 'wearlab_social_whatsapp', '923001234567' );
$wa_num_clean = preg_replace( '/[^0-9]/', '', $wa_num );
$customer_name = $order ? trim( $order->get_formatted_billing_full_name() ) : '';
$order_items_text = array();
if ( $order ) {
	foreach ( $order->get_items() as $item ) {
		$order_items_text[] = $item->get_name() . ' x' . $item->get_quantity();
	}
}
$wa_order_msg = sprintf(
	"Hi WEARLAB! I just placed Order #%s on wearlab.store.\nCustomer: %s\nTotal: %s (COD)\nItems: %s\nPlease confirm and dispatch my order. Thank you!",
	$order ? $order->get_order_number() : '',
	$customer_name,
	$order ? strip_tags( $order->get_formatted_order_total() ) : '',
	implode( ', ', $order_items_text )
);
$wa_order_url = ! empty( $wa_num_clean ) ? 'https://wa.me/' . $wa_num_clean . '?text=' . rawurlencode( $wa_order_msg ) : '#';

get_header();
?>

<div class="wl-order-confirmation-page">
    <div class="wl-container wl-order-confirmation-container">
        <?php if ( $order ) :

            do_action( 'woocommerce_before_thankyou', $order->get_id() );
            ?>

            <?php if ( $order->has_status( 'failed' ) ) : ?>

                <div class="wl-order-status-card wl-order-status-card--failed">
                    <div class="wl-order-status-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#d93838" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <h1 class="wl-order-title">Unfortunately your order cannot be processed.</h1>
                    <p class="wl-order-subtitle">Please attempt your purchase again or contact support.</p>
                    <div class="wl-order-actions">
                        <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="wl-btn wl-btn--primary">Pay Now</a>
                    </div>
                </div>

            <?php else : ?>

                <div class="wl-order-status-card">
                    <div class="wl-order-status-icon">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#008060" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    
                    <span class="wl-order-badge">Order Confirmed</span>
                    <h1 class="wl-order-title">Thank you for your order!</h1>
                    <p class="wl-order-subtitle">
                        Order <strong>#<?php echo esc_html( $order->get_order_number() ); ?></strong> has been received and is being prepped for dispatch.
                    </p>

                    <!-- Key KhushPosh highlights -->
                    <div class="wl-order-highlights">
                        <div class="wl-order-highlight-item">
                            <span class="wl-order-highlight-label">Payment Method</span>
                            <span class="wl-order-highlight-value wl-order-highlight-value--cod">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                    <line x1="2" y1="10" x2="22" y2="10"></line>
                                </svg>
                                Cash on Delivery (COD)
                            </span>
                        </div>
                        <div class="wl-order-highlight-item">
                            <span class="wl-order-highlight-label">Estimated Delivery</span>
                            <span class="wl-order-highlight-value">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="3" width="15" height="13"></rect>
                                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                </svg>
                                3 &ndash; 5 Business Days
                            </span>
                        </div>
                        <div class="wl-order-highlight-item">
                            <span class="wl-order-highlight-label">Delivery Charges</span>
                            <span class="wl-order-highlight-value">Rs. 350 (Nationwide Courier)</span>
                        </div>
                    </div>

                    <?php if ( ! empty( $wa_num_clean ) ) : ?>
                    <!-- WhatsApp Instant Confirmation Box -->
                    <div class="wl-wa-confirm-banner" style="display: flex; align-items: center; justify-content: space-between; gap: 16px; background-color: #f0faf4; border: 1.5px solid #25D366; border-radius: 8px; padding: 16px 20px; margin-bottom: 24px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="#25D366" style="flex-shrink: 0;"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.78 14.07c-.24.68-1.22 1.26-1.83 1.33-.56.07-1.29.1-3.69-.89-3.08-1.26-5.06-4.39-5.21-4.6-.15-.2-1.24-1.65-1.24-3.15 0-1.5.78-2.24 1.06-2.54.28-.3.62-.37.82-.37.21 0 .42 0 .6.01.19.01.45-.07.7.54.26.63.89 2.16.97 2.32.08.16.13.35.03.56-.1.21-.16.34-.31.52-.16.18-.33.4-.47.54-.15.15-.31.32-.13.63.18.31.8 1.32 1.72 2.14 1.18 1.05 2.17 1.37 2.48 1.53.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.84.87 2.15 1.03.32.15.53.23.61.37.08.14.08.82-.16 1.5z"/></svg>
                            <div>
                                <strong style="display: block; font-size: 15px; color: #121212;">Confirm Order via WhatsApp</strong>
                                <span style="font-size: 13px; color: #555555;">Send your order details to WhatsApp for 1-day express priority dispatch.</span>
                            </div>
                        </div>
                        <a href="<?php echo esc_url( $wa_order_url ); ?>" target="_blank" rel="noopener noreferrer" class="wl-btn wl-btn--whatsapp" style="display: inline-flex; align-items: center; gap: 8px; background-color: #25D366; color: #ffffff; padding: 10px 20px; font-weight: 600; border-radius: 6px; text-decoration: none; font-size: 14px;">
                            Chat on WhatsApp
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Order Details Grid (2 Columns) -->
                    <div class="wl-order-details-grid">
                        
                        <!-- Order Items Card -->
                        <div class="wl-order-card">
                            <h2 class="wl-order-card__title">Order Summary</h2>
                            <div class="wl-order-items-list">
                                <?php
                                foreach ( $order->get_items() as $item_id => $item ) :
                                    $product = $item->get_product();
                                    $item_name = $item->get_name();
                                    $quantity = $item->get_quantity();
                                    $subtotal = $order->get_formatted_line_subtotal( $item );
                                    $thumbnail = $product ? $product->get_image( array( 64, 78 ) ) : '';
                                    ?>
                                    <div class="wl-order-item">
                                        <div class="wl-order-item__thumb">
                                            <?php if ( $thumbnail ) : ?>
                                                <?php echo $thumbnail; // phpcs:ignore ?>
                                            <?php else : ?>
                                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/product-placeholder-1.jpg' ); ?>" alt="<?php echo esc_attr( $item_name ); ?>">
                                            <?php endif; ?>
                                            <span class="wl-order-item__qty"><?php echo esc_html( $quantity ); ?></span>
                                        </div>
                                        <div class="wl-order-item__info">
                                            <h3 class="wl-order-item__name"><?php echo esc_html( $item_name ); ?></h3>
                                            <?php
                                            $formatted_meta = wc_display_item_meta( $item, array( 'echo' => false ) );
                                            if ( $formatted_meta ) {
                                                echo '<div class="wl-order-item__meta">' . wp_kses_post( $formatted_meta ) . '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="wl-order-item__price">
                                            <?php echo wp_kses_post( $subtotal ); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Totals recap -->
                            <div class="wl-order-totals">
                                <div class="wl-order-totals__row">
                                    <span>Subtotal</span>
                                    <span><?php echo wp_kses_post( $order->get_subtotal_to_display() ); ?></span>
                                </div>
                                <div class="wl-order-totals__row">
                                    <span>Delivery Charges</span>
                                    <span>Rs. 350</span>
                                </div>
                                <div class="wl-order-totals__row wl-order-totals__row--total">
                                    <span>Total Amount Due (COD)</span>
                                    <span><strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong></span>
                                </div>
                            </div>
                        </div>

                        <!-- Customer & Delivery Info Card -->
                        <div class="wl-order-card">
                            <h2 class="wl-order-card__title">Customer &amp; Shipping Details</h2>
                            
                            <div class="wl-order-info-block">
                                <h4 class="wl-order-info-subtitle">Shipping Address</h4>
                                <address class="wl-order-address">
                                    <?php echo wp_kses_post( $order->get_formatted_shipping_address() ? $order->get_formatted_shipping_address() : $order->get_formatted_billing_address() ); ?>
                                </address>
                            </div>

                            <div class="wl-order-info-block">
                                <h4 class="wl-order-info-subtitle">Contact Information</h4>
                                <p class="wl-order-contact-line">
                                    <strong>Email:</strong> <?php echo esc_html( $order->get_billing_email() ); ?>
                                </p>
                                <?php if ( $order->get_billing_phone() ) : ?>
                                    <p class="wl-order-contact-line">
                                        <strong>Phone:</strong> <?php echo esc_html( $order->get_billing_phone() ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="wl-order-info-block">
                                <h4 class="wl-order-info-subtitle">Payment Instructions</h4>
                                <div class="wl-order-notice-box">
                                    <p>Please keep exact change ready of <strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong> when the courier arrives at your doorstep.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="wl-order-footer-actions">
                        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary">Continue Shopping</a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wl-btn wl-btn--outline">Back to Home</a>
                    </div>
                </div>

            <?php endif; ?>

            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

        <?php else : ?>

            <div class="wl-order-status-card">
                <div class="wl-order-status-icon">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h1 class="wl-order-title"><?php esc_html_e( 'Order Details', 'wearlab' ); ?></h1>
                <p class="wl-order-subtitle">
                    <?php esc_html_e( 'No recent order details were found. If you just placed an order, please check your email confirmation.', 'wearlab' ); ?>
                </p>
                <div class="wl-order-footer-actions">
                    <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary">Continue Shopping</a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wl-btn wl-btn--outline">Back to Home</a>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
