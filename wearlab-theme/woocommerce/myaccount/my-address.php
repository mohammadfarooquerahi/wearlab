<?php
/**
 * My Addresses template for WEARLAB
 * Clean, modern 2-column KhushPosh card layout for Billing & Shipping addresses
 * Location: woocommerce/myaccount/my-address.php
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}
?>

<div class="wl-account-addresses-wrap">
	<p class="wl-account-addresses-intro" style="font-size: 14px; color: #666666; margin-bottom: 24px; line-height: 1.6;">
		<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
	</p>

	<div class="woocommerce-Addresses col2-set addresses wl-account-addresses">
		<?php foreach ( $get_addresses as $name => $address_title ) : ?>
			<?php
			$address = wc_get_account_formatted_address( $name );
			?>
			<div class="woocommerce-Address wl-account-address-box">
				<header class="woocommerce-Address-title title">
					<div style="display: flex; align-items: center; gap: 8px;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="1.8">
							<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
							<circle cx="12" cy="10" r="3"></circle>
						</svg>
						<h3 style="margin: 0; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #121212;">
							<?php echo esc_html( $address_title ); ?>
						</h3>
					</div>
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit">
						<?php
						printf(
							$address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ),
							esc_html( $address_title )
						);
						?>
					</a>
				</header>
				<address>
					<?php
					if ( $address ) {
						echo wp_kses_post( $address );
					} else {
						esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
					}

					do_action( 'woocommerce_my_account_after_my_address', $name );
					?>
				</address>
			</div>
		<?php endforeach; ?>
	</div>
</div>
