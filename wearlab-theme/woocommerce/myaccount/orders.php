<?php
/**
 * Orders template for WEARLAB
 * Shows orders on the account page in clean KhushPosh streetwear table
 * Location: woocommerce/myaccount/orders.php
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table wl-account-table">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th scope="col" class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<tbody>
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order );
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :
						$is_order_number = 'order-number' === $column_id;
					?>
						<?php if ( $is_order_number ) : ?>
							<th class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>" scope="row">
						<?php else : ?>
							<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php endif; ?>

							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( $is_order_number ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" style="font-weight: 600; color: #121212; text-decoration: underline;">
									<?php echo esc_html( _x( '#', 'hash before order number', 'wearlab' ) . $order->get_order_number() ); ?>
								</a>

							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

							<?php elseif ( 'order-status' === $column_id ) : ?>
								<span class="wl-order-status-pill wl-order-status-pill--<?php echo esc_attr( $order->get_status() ); ?>" style="display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; background: #f0f0f0; color: #333;">
									<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
								</span>

							<?php elseif ( 'order-total' === $column_id ) : ?>
								<span style="font-weight: 600;">
									<?php echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'wearlab' ), $order->get_formatted_order_total(), $item_count ) ); ?>
								</span>

							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );

								if ( ! empty( $actions ) ) {
									foreach ( $actions as $key => $action ) {
										echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button wl-btn wl-btn--sm wl-btn--outline ' . sanitize_html_class( $key ) . '" style="padding: 6px 14px; font-size: 11px; text-transform: uppercase; font-weight: 600; text-decoration: none; border: 1px solid #121212; border-radius: 4px; color: #121212; background: #fff;">' . esc_html( $action['name'] ) . '</a>';
									}
								}
								?>
							<?php endif; ?>

						<?php if ( $is_order_number ) : ?>
							</th>
						<?php else : ?>
							</td>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-Pagination" style="display: flex; gap: 12px; margin-top: 24px;">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button button wl-btn wl-btn--outline" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'wearlab' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button button wl-btn wl-btn--primary" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'wearlab' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<div class="wl-account-empty-orders" style="text-align: center; padding: 48px 24px; background: #fafafa; border: 1px solid #e8e8e8; border-radius: 8px;">
		<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888888" stroke-width="1.6" style="margin-bottom: 16px;">
			<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
			<line x1="3" y1="6" x2="21" y2="6"></line>
			<path d="M16 10a4 4 0 0 1-8 0"></path>
		</svg>
		<h3 style="font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #121212; margin: 0 0 8px;">No orders found</h3>
		<p style="font-size: 14px; color: #666; margin: 0 0 24px;">You haven't placed any streetwear orders yet.</p>
		<a class="wl-btn wl-btn--primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" style="display: inline-block; padding: 12px 28px; background: #121212; color: #fff; text-decoration: none; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; border-radius: 4px;">
			Start Shopping
		</a>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
