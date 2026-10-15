<?php
/**
 * Login & Register Form for WooCommerce My Account
 * Location: woocommerce/myaccount/form-login.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="wl-auth-wrap" id="customer_login">

	<!-- Login Column -->
	<div class="wl-auth-card">
		<h2 class="wl-auth-card__title"><?php esc_html_e( 'Login', 'wearlab' ); ?></h2>
		<p class="wl-auth-card__desc">Sign in with your email to view your orders and track shipments.</p>

		<form class="woocommerce-form woocommerce-form-login login wl-auth-form" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'wearlab' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required />
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'wearlab' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row" style="margin-top: 14px; margin-bottom: 20px;">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'wearlab' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			</p>

			<button type="submit" class="woocommerce-button button woocommerce-form-login__submit wl-btn wl-btn--primary" style="width: 100%;" name="login" value="<?php esc_attr_e( 'Log in', 'wearlab' ); ?>"><?php esc_html_e( 'Log in', 'wearlab' ); ?></button>

			<p class="woocommerce-LostPassword lost_password" style="text-align: center; margin-top: 16px;">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'wearlab' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>

	<!-- Register Column -->
	<div class="wl-auth-card">
		<h2 class="wl-auth-card__title"><?php esc_html_e( 'Create an Account', 'wearlab' ); ?></h2>
		<p class="wl-auth-card__desc">Join WEARLAB for faster checkout, order tracking, and exclusive drop access.</p>

		<form method="post" class="woocommerce-form woocommerce-form-register register wl-auth-form" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'wearlab' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required />
				</p>
			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'wearlab' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'wearlab' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required />
				</p>
			<?php else : ?>
				<p style="font-size: 13px; color: #666; margin-bottom: 20px; line-height: 1.5;"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'wearlab' ); ?></p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row" style="margin-top: 24px;">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit wl-btn wl-btn--outline" style="width: 100%;" name="register" value="<?php esc_attr_e( 'Register', 'wearlab' ); ?>"><?php esc_html_e( 'Create Account', 'wearlab' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>
	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
