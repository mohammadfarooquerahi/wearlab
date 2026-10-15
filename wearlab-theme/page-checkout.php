<?php
/**
 * Template Name: Checkout Page
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp;

// 1. Check if this is the Order Received / Thank You page
$is_order_received = ( function_exists( 'is_order_received_page' ) && is_order_received_page() )
	|| ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'order-received' ) )
	|| isset( $wp->query_vars['order-received'] );

if ( $is_order_received ) {
	$order_id = isset( $wp->query_vars['order-received'] ) ? absint( $wp->query_vars['order-received'] ) : 0;
	if ( ! $order_id && isset( $_GET['order_id'] ) ) {
		$order_id = absint( $_GET['order_id'] );
	}
	$order = $order_id ? wc_get_order( $order_id ) : false;

	if ( file_exists( get_template_directory() . '/woocommerce/checkout/thankyou.php' ) ) {
		include get_template_directory() . '/woocommerce/checkout/thankyou.php';
		return;
	}
}

// 2. Standard Checkout Form
if ( file_exists( get_template_directory() . '/woocommerce/checkout/form-checkout.php' ) ) {
	include get_template_directory() . '/woocommerce/checkout/form-checkout.php';
} else {
	get_header();
	echo '<div class="wl-container"><p>Checkout template is loading...</p></div>';
	get_footer();
}
