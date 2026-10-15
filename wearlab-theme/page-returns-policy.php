<?php
/**
 * Template Name: Returns Policy
 * Location: page-returns-policy.php
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
                <a href="<?php echo esc_url( home_url( '/returns-policy/' ) ); ?>">Policies</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Return &amp; Exchange Policy</span>
            </div>
            <span class="wl-page-badge">Customer Guarantee</span>
            <h1 class="wl-page-title">RETURN &amp; EXCHANGE POLICY</h1>
            <p class="wl-page-subtitle">We want you to be satisfied with your WEARLAB purchase. Read our fair exchange policy below.</p>
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
                            <strong>7-Day Window</strong>
                            <span>Request within 7 days of delivery</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <div>
                            <strong>Defect Guarantee</strong>
                            <span>Exchanges for damaged or wrong items</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        <div>
                            <strong>Tags Retained</strong>
                            <span>Unused, unwashed with original packaging</span>
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
                        $contact_email = get_theme_mod( 'wearlab_contact_email', 'orders@wearlab.store' );
                    ?>
                    <p class="wl-policy-lead" style="font-size: 15px; color: #111; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #eee;">
                        We want you to be satisfied with your <strong>WEARLAB</strong> purchase. Our return and exchange policy is designed to keep the process fair for both customers and our brand.
                    </p>

                    <h2>1. Eligibility for Exchange</h2>
                    <p>An exchange may be requested if:</p>
                    <ul class="wl-policy-checklist">
                        <li>The product received is <strong>damaged or defective</strong>.</li>
                        <li>The wrong product, size, or item was sent by WEARLAB.</li>
                        <li>The product has a manufacturing or printing defect.</li>
                    </ul>
                    <div class="wl-policy-box wl-policy-box--check" style="margin-bottom: 24px;">
                        <h4>Timeframe Requirement</h4>
                        <p style="margin: 0; font-size: 13.5px; color: #121212;">Exchange requests should be made within <strong>7 days of receiving the order</strong>.</p>
                    </div>

                    <h2>2. Product Condition Requirements</h2>
                    <p>To qualify for an exchange:</p>
                    <ul class="wl-policy-checklist">
                        <li>The product must be <strong>unused and unwashed</strong>.</li>
                        <li>The product must be in its original condition.</li>
                        <li>Original tags and packaging should be retained where applicable.</li>
                        <li>The customer may be required to provide clear photographs or videos of the issue before the exchange is approved.</li>
                    </ul>

                    <h2>3. Size Exchanges &amp; Customized Pieces</h2>
                    <div class="wl-policy-grid-boxes">
                        <div class="wl-policy-box">
                            <h4>Size Exchanges</h4>
                            <p>If you ordered the wrong size, WEARLAB may offer an exchange subject to product availability.</p>
                            <p style="margin-bottom: 0; font-size: 12.5px; color: #666;"><em>Customers may be responsible for the applicable return and reshipping costs for size-related exchanges.</em></p>
                        </div>
                        <div class="wl-policy-box" style="border-left: 3px solid #f59e0b;">
                            <h4 style="color: #b45309;">Customized Products</h4>
                            <p style="margin: 0; font-size: 13px; color: #444;">Customized, personalized, printed, or embroidered products are <strong>not eligible for return or exchange due to change of mind, incorrect size selection, or personal preference</strong>, unless the item is defective or WEARLAB sent the wrong product.</p>
                        </div>
                    </div>

                    <h2>4. Non-Returnable Conditions</h2>
                    <div class="wl-policy-box wl-policy-box--cross">
                        <h4>Returns &amp; Exchanges may NOT be accepted when:</h4>
                        <ul>
                            <li>The product has been worn, washed, altered, or damaged by the customer.</li>
                            <li>Tags have been removed where applicable.</li>
                            <li>The product has been damaged due to improper washing or care.</li>
                            <li>The request is made outside the applicable exchange period (after 7 days).</li>
                            <li>The customer simply changes their mind after receiving the product.</li>
                        </ul>
                    </div>

                    <h2>5. How to Request an Exchange</h2>
                    <p>Contact WEARLAB through our official customer support or WhatsApp channel with the following details:</p>
                    <ol class="wl-policy-steps" style="background: #fafafa; border: 1px solid #e8e8e8; border-radius: 6px; padding: 20px 20px 20px 40px; margin: 16px 0 24px;">
                        <li><strong>Order Number</strong> (e.g., #74)</li>
                        <li><strong>Customer Name</strong></li>
                        <li><strong>Product Name and Size</strong></li>
                        <li><strong>Reason for Exchange</strong></li>
                        <li><strong>Clear Photos or Videos</strong> showing the issue</li>
                    </ol>
                    <p>Our team will review the request and provide the next steps promptly.</p>

                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <h4>Ready to initiate an exchange?</h4>
                            <p>Send your Order ID and photo proof directly to our support team on WhatsApp.</p>
                            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Hi%20WEARLAB%2C%20I%20would%20like%20to%20request%20an%20exchange%20for%20my%20order" class="wl-btn wl-btn--sm wl-btn--primary" target="_blank" rel="noopener noreferrer">Message Support on WhatsApp</a>
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
