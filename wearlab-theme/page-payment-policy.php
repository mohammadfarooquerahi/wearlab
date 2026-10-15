<?php
/**
 * Template Name: Payment Policy
 * Location: page-payment-policy.php
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
                <span>Policies</span>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Payment Methods</span>
            </div>
            <span class="wl-page-badge">Billing &amp; Payments</span>
            <h1 class="wl-page-title">PAYMENT POLICY</h1>
            <p class="wl-page-subtitle">Simple, safe, and flexible payment options tailored for customers across Pakistan.</p>
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
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                        <div>
                            <strong>Cash on Delivery (COD)</strong>
                            <span>Pay at your doorstep across Pakistan</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <div>
                            <strong>100% Secure</strong>
                            <span>Zero hidden fees or extra surcharges</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <div>
                            <strong>PKR Currency</strong>
                            <span>All prices include federal taxes</span>
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
                    <h2>1. Cash on Delivery (COD)</h2>
                    <p>For your convenience and complete peace of mind, <strong>Cash on Delivery (COD)</strong> is our primary and default payment method. You only pay for your items when the courier hands the package directly to you at your doorstep.</p>
                    <ul class="wl-policy-checklist">
                        <li>Available for 100% of pin codes and postal delivery addresses across Pakistan.</li>
                        <li>Please ensure exact cash is ready upon the arrival of the delivery rider.</li>
                        <li>An automated order confirmation call or SMS may be placed prior to dispatch.</li>
                    </ul>

                    <h2>2. Bank Transfer / Digital Wallets (Optional)</h2>
                    <p>For corporate bulk purchases, customized garments, or international gifts dispatched to Pakistan, we accept direct digital transfers through:</p>
                    <div class="wl-policy-grid-boxes">
                        <div class="wl-policy-box">
                            <h4>Direct Online Banking &amp; Raast</h4>
                            <p>Instant interbank bank transfer via Meezan Bank, HBL, Bank Alfalah, or any Raast ID.</p>
                        </div>
                        <div class="wl-policy-box">
                            <h4>Nayapay &amp; Sadapay</h4>
                            <p>Seamless instant wallet transfers directly to our official corporate digital accounts.</p>
                        </div>
                    </div>

                    <h2>3. Currency &amp; Pricing Transparency</h2>
                    <p>All prices displayed on <strong>WEARLAB</strong> are strictly in <strong>Pakistani Rupees (PKR)</strong>. What you see at checkout is the exact amount due—no hidden handling fees, card processing fees, or post-purchase surprises.</p>

                    <h2>4. Advance Deposits for Customization</h2>
                    <p>Custom tailored items or bespoke streetwear prints produced on order require a 50% advance confirmation deposit, with the remaining 50% payable via COD upon delivery.</p>

                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <h4>Need banking details or advance invoice for a bulk order?</h4>
                            <p>Chat directly with our billing desk on WhatsApp for instant invoice generation.</p>
                            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Hi%20WEARLAB%2C%20I%20need%20payment%20details" class="wl-btn wl-btn--sm wl-btn--primary" target="_blank" rel="noopener noreferrer">Contact Accounts Desk</a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </main>

        </div>
    </div>
</div>

<?php get_footer(); ?>
