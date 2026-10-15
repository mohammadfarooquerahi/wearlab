<?php
/**
 * My Account Dashboard template for WEARLAB
 * Shows quick summary cards for Orders, Addresses, and Account Details
 */

defined( 'ABSPATH' ) || exit;

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="wl-account-welcome">
	<p>
		<?php
		printf(
			/* translators: 1: user display name 2: logout url */
			wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'wearlab' ), $allowed_html ),
			'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
			esc_url( wc_logout_url() )
		);
		?>
	</p>
	<p style="color: #666; font-size: 14px; margin-top: 6px;">
		From your WEARLAB account dashboard you can track your recent orders, manage your shipping addresses, and edit your password and profile details.
	</p>
</div>

<!-- Quick Action Cards -->
<div class="wl-account-cards">
	<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="wl-account-card-link">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
		<strong>Orders</strong>
		<span>Track and review your purchases</span>
	</a>

	<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="wl-account-card-link">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
		<strong>Addresses</strong>
		<span>Manage your delivery locations</span>
	</a>

	<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="wl-account-card-link">
		<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
		<strong>Account Details</strong>
		<span>Update name, email &amp; password</span>
	</a>
</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
?>
