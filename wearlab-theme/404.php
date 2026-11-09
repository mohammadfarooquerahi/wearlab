<?php
/**
 * 404 Error Page & Fallback Routing
 */

// Safety catch: If this 404 was actually an order-received / checkout thankyou request
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
if ( preg_match( '#order-received[=/](\d+)#i', $request_uri, $matches ) || ( false !== stripos( $request_uri, 'order-received' ) && ! empty( $_GET['order_id'] ) ) ) {
	$order_id = ! empty( $matches[1] ) ? absint( $matches[1] ) : absint( $_GET['order_id'] ?? 0 );
	status_header( 200 );
	global $wp, $wp_query;
	if ( is_object( $wp_query ) ) {
		$wp_query->is_404  = false;
		$wp_query->is_page = true;
	}
	if ( is_object( $wp ) ) {
		$wp->query_vars['order-received'] = $order_id;
	}
	$thankyou_file = get_template_directory() . '/woocommerce/checkout/thankyou.php';
	if ( file_exists( $thankyou_file ) ) {
		include $thankyou_file;
		exit;
	}
}

get_header(); ?>

<div class="wl-container wl-404 wl-text-center">
    <h1 class="wl-page-title">LOST YOUR WAY?</h1>
    <p class="wl-404-text">Looks like this page went somewhere else.</p>
    <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary">BACK TO SHOP</a>
</div>

<?php get_footer(); ?>
