</main>

<footer class="wl-footer">
    <div class="wl-footer__inner">
        <div class="wl-footer__cols">
            <div class="wl-footer__col">
                <h2 class="wl-footer__heading"><?php esc_html_e( 'Quick links', 'wearlab' ); ?></h2>
                <ul class="wl-footer__list">
                    <li><a href="#" class="wl-footer__link wl-search-trigger"><?php esc_html_e( 'Search', 'wearlab' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="wl-footer__link"><?php esc_html_e( 'Contact', 'wearlab' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/returns-policy/' ) ); ?>" class="wl-footer__link"><?php esc_html_e( 'Exchange/Return Policy', 'wearlab' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>" class="wl-footer__link"><?php esc_html_e( 'Shipping Policy', 'wearlab' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/payment-policy/' ) ); ?>" class="wl-footer__link"><?php esc_html_e( 'Payment Policy', 'wearlab' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="wl-footer__link"><?php esc_html_e( 'Privacy Policy', 'wearlab' ); ?></a></li>
                </ul>
            </div>

            <div class="wl-footer__col">
                <h2 class="wl-footer__heading"><?php esc_html_e( 'Find Us On', 'wearlab' ); ?></h2>
                <?php
                $instagram_url = get_theme_mod( 'wearlab_social_instagram', '' );
                if ( empty( $instagram_url ) ) {
                    $instagram_url = 'https://www.instagram.com/';
                }
                ?>
                <a href="<?php echo esc_url( $instagram_url ); ?>" class="wl-footer__social-item" target="_blank" rel="noopener noreferrer">
                    <svg class="wl-footer__ig-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.6"/>
                        <circle cx="12" cy="12" r="4.2" stroke="currentColor" stroke-width="1.6"/>
                        <circle cx="17.4" cy="6.6" r="1" fill="currentColor"/>
                    </svg>
                    <span><?php esc_html_e( 'Instagram', 'wearlab' ); ?></span>
                </a>
            </div>

            <div class="wl-footer__col">
                <h2 class="wl-footer__heading"><?php esc_html_e( 'Subscribe to our emails', 'wearlab' ); ?></h2>
                <form class="wl-footer__subscribe-form" novalidate>
                    <label class="screen-reader-text" for="wl-footer-email"><?php esc_html_e( 'Email', 'wearlab' ); ?></label>
                    <input id="wl-footer-email" type="email" name="email" class="wl-footer__subscribe-input" placeholder="<?php esc_attr_e( 'Email', 'wearlab' ); ?>" required>
                    <button type="submit" class="wl-footer__subscribe-btn" aria-label="<?php esc_attr_e( 'Subscribe', 'wearlab' ); ?>">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="wl-footer__divider"></div>

    <div class="wl-footer__inner">
        <div class="wl-footer__meta">
            <div class="wl-footer__localization">
                <label class="wl-footer__localization-label" for="wl-footer-country"><?php esc_html_e( 'Country/region', 'wearlab' ); ?></label>
                <div class="wl-footer__select-wrap">
                    <select id="wl-footer-country" class="wl-footer__select" name="country" aria-label="<?php esc_attr_e( 'Country/region', 'wearlab' ); ?>">
                        <option value="PK" selected><?php echo esc_html( get_theme_mod( 'wearlab_footer_country', 'Pakistan' ) ); ?></option>
                    </select>
                    <svg class="wl-footer__select-caret" width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <ul class="wl-footer__payments" aria-label="<?php esc_attr_e( 'Payment methods', 'wearlab' ); ?>">
                <li>
                    <span class="wl-pay-badge wl-pay-badge--amex" title="American Express" aria-label="American Express">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#006FCF"/><text x="19" y="16" text-anchor="middle" fill="#fff" font-size="8" font-family="Arial,sans-serif" font-weight="700">AMEX</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Apple Pay" aria-label="Apple Pay">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><text x="19" y="16" text-anchor="middle" fill="#111" font-size="8" font-family="Arial,sans-serif" font-weight="700"> Pay</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Diners Club" aria-label="Diners Club">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><circle cx="19" cy="12" r="7.5" fill="none" stroke="#0079BE" stroke-width="2"/><path d="M19 5.5v13" stroke="#0079BE" stroke-width="3"/></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Discover" aria-label="Discover">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><text x="8" y="15.5" fill="#111" font-size="6.5" font-family="Arial,sans-serif" font-weight="700">DISCOVER</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Google Pay" aria-label="Google Pay">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><text x="19" y="16" text-anchor="middle" fill="#5F6368" font-size="8" font-family="Arial,sans-serif" font-weight="700">G Pay</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Klarna" aria-label="Klarna">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#FFB3C7"/><text x="19" y="16" text-anchor="middle" fill="#0B051D" font-size="8" font-family="Arial,sans-serif" font-weight="700">Klarna</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Mastercard" aria-label="Mastercard">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><circle cx="15.5" cy="12" r="6.2" fill="#EB001B"/><circle cx="22.5" cy="12" r="6.2" fill="#F79E1B"/><path d="M19 7.4a6.2 6.2 0 0 1 0 9.2 6.2 6.2 0 0 1 0-9.2z" fill="#FF5F00"/></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Shop Pay" aria-label="Shop Pay">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#5A31F4"/><text x="19" y="16" text-anchor="middle" fill="#fff" font-size="8" font-family="Arial,sans-serif" font-weight="700">shop</text></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="UnionPay" aria-label="UnionPay">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><rect x="8" y="6" width="7" height="12" rx="1" fill="#D10429"/><rect x="15.5" y="6" width="7" height="12" rx="1" fill="#0169B7"/><rect x="23" y="6" width="7" height="12" rx="1" fill="#007B3E"/></svg>
                    </span>
                </li>
                <li>
                    <span class="wl-pay-badge" title="Visa" aria-label="Visa">
                        <svg viewBox="0 0 38 24" width="38" height="24" role="img"><rect width="38" height="24" rx="3" fill="#fff" stroke="#E0E0E0"/><text x="19" y="16.5" text-anchor="middle" fill="#1A1F71" font-size="11" font-family="Georgia,serif" font-weight="700" font-style="italic">VISA</text></svg>
                    </span>
                </li>
            </ul>
        </div>

        <p class="wl-footer__copyright">
            <?php
            $copyright = get_theme_mod( 'wearlab_copyright_text', '' );
            if ( $copyright ) {
                echo esc_html( $copyright );
            } else {
                echo '&copy; ' . esc_html( date( 'Y' ) ) . ', WEARLAB';
            }
            ?>
        </p>

        <div class="wl-footer__dev">
            <a href="https://www.linkedin.com/in/mohammadfarooque/" target="_blank" rel="noopener noreferrer" class="wl-footer__dev-link" onmouseover="this.style.opacity='0.2'" onmouseout="this.style.opacity='0.1'">Developed by Mohammad Farooque</a>
        </div>
    </div>
</footer>

<?php
$wa_enabled   = get_theme_mod( 'wearlab_whatsapp_float_enable', true );
$wa_num       = get_theme_mod( 'wearlab_social_whatsapp', '923001234567' );
$wa_num_clean = preg_replace( '/[^0-9]/', '', $wa_num );
if ( $wa_enabled && ! empty( $wa_num_clean ) ) :
?>
<a href="https://wa.me/<?php echo esc_attr( $wa_num_clean ); ?>?text=<?php echo rawurlencode( 'Hi WEARLAB! I have an inquiry about an order / fit.' ); ?>" class="wl-whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="#ffffff" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm5.78 14.07c-.24.68-1.22 1.26-1.83 1.33-.56.07-1.29.1-3.69-.89-3.08-1.26-5.06-4.39-5.21-4.6-.15-.2-1.24-1.65-1.24-3.15 0-1.5.78-2.24 1.06-2.54.28-.3.62-.37.82-.37.21 0 .42 0 .6.01.19.01.45-.07.7.54.26.63.89 2.16.97 2.32.08.16.13.35.03.56-.1.21-.16.34-.31.52-.16.18-.33.4-.47.54-.15.15-.31.32-.13.63.18.31.8 1.32 1.72 2.14 1.18 1.05 2.17 1.37 2.48 1.53.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.84.87 2.15 1.03.32.15.53.23.61.37.08.14.08.82-.16 1.5z"/></svg>
    <span class="wl-whatsapp-float__badge">WhatsApp</span>
</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
