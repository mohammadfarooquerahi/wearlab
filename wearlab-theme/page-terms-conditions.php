<?php
/**
 * Template Name: Terms & Conditions
 * Location: page-terms-conditions.php
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
                <a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>">Policies</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Terms &amp; Conditions</span>
            </div>
            <span class="wl-page-badge">Terms of Service</span>
            <h1 class="wl-page-title">TERMS &amp; CONDITIONS</h1>
            <p class="wl-page-subtitle">By using the WEARLAB website or placing an order, you agree to the applicable policies and terms.</p>
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
                <div class="wl-policy-body">
                    <?php
                    $custom_content = get_post_field( 'post_content', get_the_ID() );
                    if ( ! empty( trim( $custom_content ) ) ) :
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                    else :
                        $contact_email = get_theme_mod( 'wearlab_contact_email', 'orders@wearlab.store' );
                        $wa_raw = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
                        $wa_clean = preg_replace( '/[^0-9]/', '', $wa_raw );
                    ?>
                    <p class="wl-policy-lead" style="font-size: 15px; color: #111; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #eee;">
                        By using the <strong>WEARLAB</strong> website or placing an order, you agree to the applicable policies and terms published on this website.
                    </p>

                    <h2>1. Product Information</h2>
                    <p>We make reasonable efforts to ensure that product descriptions, photographs, colors, sizes, and prices are accurate. However, slight differences in color may occur due to lighting, photography, or differences between device screens.</p>

                    <h2>2. Pricing &amp; Offers</h2>
                    <p>WEARLAB reserves the right to change product prices, offers, availability, and product specifications without prior notice.</p>

                    <h2>3. Order Cancellation</h2>
                    <div class="wl-policy-box" style="margin: 16px 0; border-left: 3px solid #111;">
                        <h4>Cancellation Policy</h4>
                        <p style="margin: 0; font-size: 13.5px; color: #333;">Orders may be cancelled before dispatch, subject to confirmation by WEARLAB. Once an order has been dispatched, cancellation may no longer be possible.</p>
                    </div>

                    <h2>4. Product Availability</h2>
                    <p>All products are subject to availability. If an ordered product becomes unavailable, WEARLAB may contact the customer regarding an alternative, replacement, or applicable refund.</p>

                    <h2>5. Customer Support &amp; Contact</h2>
                    <p>For questions regarding shipping, returns, exchanges, privacy, or orders, please contact WEARLAB through our official customer support channels.</p>

                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <h4>Need support with your purchase or terms?</h4>
                            <p>Our concierge desk is ready to assist you via WhatsApp or Email.</p>
                            <div style="display: flex; gap: 10px; margin-top: 12px; flex-wrap: wrap;">
                                <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" class="wl-btn wl-btn--sm wl-btn--primary" target="_blank" rel="noopener noreferrer">WhatsApp Support</a>
                                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="wl-btn wl-btn--sm wl-btn--outline">Email Support</a>
                            </div>
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
