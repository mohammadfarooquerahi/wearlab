<?php
/**
 * Template Name: Shipping Policy
 * Location: page-shipping-policy.php
 */

get_header();
?>

<div class="wl-policy-page-wrapper">
    <!-- Hero / Breadcrumb Header -->
    <div class="wl-policy-hero">
        <div class="wl-container">
            <div class="wl-policy-breadcrumbs">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <a href="<?php echo esc_url( home_url( '/shipping-policy/' ) ); ?>">Policies</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Shipping Policy</span>
            </div>
            <span class="wl-page-badge">Nationwide Delivery</span>
            <h1 class="wl-page-title">SHIPPING POLICY</h1>
            <p class="wl-page-subtitle">Simple, transparent, and reliable dispatch across Pakistan.</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="wl-container wl-policy-container">
        <div class="wl-policy-layout">
            
            <!-- Sidebar -->
            <?php
            if ( file_exists( get_template_directory() . '/template-parts/policy-sidebar.php' ) ) {
                include get_template_directory() . '/template-parts/policy-sidebar.php';
            }
            ?>

            <!-- Main Content Card -->
            <main class="wl-policy-main-card">
                <!-- Highlights Box -->
                <div class="wl-policy-highlights">
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <strong>1 &ndash; 3 Business Days</strong>
                            <span>Standard dispatch after confirmation</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        <div>
                            <strong>2 &ndash; 5 Business Days</strong>
                            <span>Standard delivery time across Pakistan</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <div>
                            <strong>Direct Order Tracking</strong>
                            <span>Updates via WhatsApp &amp; SMS</span>
                        </div>
                    </div>
                </div>

                <div class="wl-policy-body">
                    <?php
                    $custom_content = get_post_field( 'post_content', get_the_ID() );
                    if ( ! empty( trim( $custom_content ) ) ) :
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                    else :
                        $wa_raw = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
                        $wa_clean = preg_replace( '/[^0-9]/', '', $wa_raw );
                    ?>
                    <p class="wl-policy-lead" style="font-size: 15px; color: #111; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #eee;">
                        At <strong>WEARLAB</strong>, we want your shopping experience to be simple, transparent, and reliable. Please read the following shipping policies before placing your order.
                    </p>

                    <h2>1. Order Processing</h2>
                    <ul class="wl-policy-checklist">
                        <li><strong>Order Confirmation:</strong> Orders are processed after confirmation.</li>
                        <li><strong>Dispatch Timeline:</strong> Orders are normally dispatched within <strong>1&ndash;3 business days</strong>.</li>
                        <li><strong>Customized Drops &amp; Embroidery:</strong> Customized printing and embroidery orders may require additional processing time depending on the design and quantity.</li>
                        <li><strong>Verification Contact:</strong> Customers may be contacted through WhatsApp or phone to confirm order details when required.</li>
                    </ul>

                    <h2>2. Delivery Time</h2>
                    <div class="wl-policy-grid-boxes">
                        <div class="wl-policy-box">
                            <h4>Standard Nationwide Delivery</h4>
                            <p>Standard delivery within Pakistan generally takes <strong>2&ndash;5 business days after dispatch</strong>, depending on the destination and courier service.</p>
                        </div>
                        <div class="wl-policy-box">
                            <h4>Remote Areas &amp; Transit Notes</h4>
                            <p>Delivery to remote areas may take longer. Delivery timelines are estimates and may be affected by courier delays, weather, public holidays, or other circumstances beyond WEARLAB's control.</p>
                        </div>
                    </div>

                    <h2>3. Shipping Charges</h2>
                    <ul class="wl-policy-checklist">
                        <li>Standard shipping charges are calculated and displayed during checkout or communicated before order confirmation.</li>
                        <li>Any applicable additional charges for special delivery requirements will be communicated to the customer.</li>
                    </ul>

                    <h2>4. Order Tracking</h2>
                    <p>Where tracking is available, customers may receive a tracking number through WhatsApp, SMS, or another available communication channel once their package is handed over to our delivery partners.</p>

                    <h2>5. Incorrect Address Responsibility</h2>
                    <div class="wl-policy-box wl-policy-box--cross" style="margin-top: 14px;">
                        <h4>Address Accuracy Notice</h4>
                        <p style="margin: 0; font-size: 13.5px; color: #444;">Customers are responsible for providing a complete and accurate delivery address and contact number. WEARLAB is not responsible for delays or additional charges resulting from incorrect or incomplete information provided by the customer.</p>
                    </div>

                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <h4>Need an urgent update on your shipment?</h4>
                            <p>Our dispatch concierge is available on WhatsApp to assist you with order verification and live courier status.</p>
                            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Hi%20WEARLAB%2C%20I%20have%20a%20question%20regarding%20my%20shipment" class="wl-btn wl-btn--sm wl-btn--primary" target="_blank" rel="noopener noreferrer">Contact Dispatch on WhatsApp</a>
                        </div>
                    </div>

                    <div class="wl-policy-brand-footer" style="margin-top: 36px; padding-top: 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 0.08em;">
                        <span><strong>WEARLAB</strong> &bull; Designed in Pakistan</span>
                        <span>Website: <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #121212; text-decoration: underline;">wearlab.store</a></span>
                    </div>
                    <?php endif; ?>
                </div>
            </main>

        </div>
    </div>
</div>

<?php get_footer(); ?>
