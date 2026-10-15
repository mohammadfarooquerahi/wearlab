<?php
/**
 * Policy Pages Sidebar Navigation for WEARLAB
 * Shows clean menu of policies and quick support card
 */
$current_slug = get_post_field( 'post_name', get_post() );
$wa_raw = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
$wa_clean = preg_replace( '/[^0-9]/', '', $wa_raw );
?>
<aside class="wl-policy-sidebar">
    <div class="wl-policy-sidebar__card">
        <h3 class="wl-policy-sidebar__title">Store Policies</h3>
        <ul class="wl-policy-sidebar__nav">
            <li class="<?php echo ( 'policies' === $current_slug || 'store-policies' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/policies/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <span>All Store Policies</span>
                </a>
            </li>
            <li class="<?php echo ( 'shipping-policy' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    <span>Shipping Policy</span>
                </a>
            </li>
            <li class="<?php echo ( 'returns-policy' === $current_slug || 'exchange-returns-policy' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/returns-policy/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                    <span>Return &amp; Exchange</span>
                </a>
            </li>
            <li class="<?php echo ( 'privacy-policy' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>Privacy Policy</span>
                </a>
            </li>
            <li class="<?php echo ( 'terms-conditions' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span>Terms &amp; Conditions</span>
                </a>
            </li>
            <li class="<?php echo ( 'payment-policy' === $current_slug ) ? 'is-active' : ''; ?>">
                <a href="<?php echo esc_url( home_url( '/payment-policy/' ) ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                    <span>Payment Methods (COD)</span>
                </a>
            </li>
        </ul>

        <!-- Support Card -->
        <div class="wl-policy-sidebar__support">
            <h4 class="wl-policy-sidebar__support-title">Need Help?</h4>
            <p class="wl-policy-sidebar__support-desc">Have a question not answered here? Our team is available on WhatsApp.</p>
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Hi%20WEARLAB%2C%20I%20have%20a%20question%20regarding%20store%20policies" class="wl-btn wl-btn--sm wl-btn--primary wl-policy-sidebar__btn" target="_blank" rel="noopener noreferrer">
                <span>Chat on WhatsApp</span>
            </a>
        </div>
    </div>
</aside>
