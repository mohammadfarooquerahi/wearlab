<?php
/**
 * Template Name: Privacy Policy
 * Location: page-privacy-policy.php
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
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Policies</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Privacy Policy</span>
            </div>
            <span class="wl-page-badge">Data Protection</span>
            <h1 class="wl-page-title">PRIVACY POLICY</h1>
            <p class="wl-page-subtitle">WEARLAB respects your privacy and is committed to protecting your personal information.</p>
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
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <div>
                            <strong>SSL Encrypted</strong>
                            <span>256-bit encrypted checkout transmission</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                        <div>
                            <strong>No Rent or Sell</strong>
                            <span>We never sell or rent your personal info</span>
                        </div>
                    </div>
                    <div class="wl-policy-highlight-item">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <div>
                            <strong>Minimal Collection</strong>
                            <span>Only data necessary for order delivery</span>
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
                        $contact_email = get_theme_mod( 'wearlab_contact_email', 'orders@wearlab.store' );
                    ?>
                    <p class="wl-policy-lead" style="font-size: 15px; color: #111; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #eee;">
                        <strong>WEARLAB</strong> respects your privacy and is committed to protecting the information you provide when using our website or purchasing our products.
                    </p>

                    <h2>1. Information We Collect</h2>
                    <p>When you place an order or interact with our website, we may collect information such as:</p>
                    <ul class="wl-policy-checklist">
                        <li>Name</li>
                        <li>Phone number</li>
                        <li>Email address</li>
                        <li>Delivery address &amp; City</li>
                        <li>Order details</li>
                        <li>Payment-related information where necessary for processing your order</li>
                        <li>Messages or information you provide to customer support</li>
                    </ul>
                    <div class="wl-policy-box" style="margin-bottom: 24px; background: #fafafa;">
                        <p style="margin: 0; font-size: 13.5px; font-weight: 500; color: #121212;">We only collect information that is reasonably necessary to provide our services.</p>
                    </div>

                    <h2>2. How We Use Your Information</h2>
                    <p>Your information may be used to:</p>
                    <div class="wl-policy-grid-boxes">
                        <div class="wl-policy-box">
                            <h4>Order Fulfillment</h4>
                            <ul style="margin: 0; padding-left: 18px; font-size: 13px;">
                                <li>Process and deliver your orders</li>
                                <li>Confirm orders and contact you regarding your purchase</li>
                                <li>Process exchanges or resolve order issues</li>
                            </ul>
                        </div>
                        <div class="wl-policy-box">
                            <h4>Service Improvement</h4>
                            <ul style="margin: 0; padding-left: 18px; font-size: 13px;">
                                <li>Provide responsive customer support</li>
                                <li>Improve our products and online services</li>
                                <li>Maintain order and transaction records</li>
                                <li>Send promotional communications where permitted &amp; chosen</li>
                            </ul>
                        </div>
                    </div>

                    <h2>3. Information Protection</h2>
                    <p>WEARLAB takes reasonable measures to protect customer information against unauthorized access, misuse, alteration, or disclosure.</p>
                    <p style="font-size: 13px; color: #666;"><em>However, no online transmission or electronic storage system can be guaranteed to be completely secure.</em></p>

                    <h2>4. Sharing of Information</h2>
                    <p><strong>WEARLAB does not sell or rent your personal information.</strong></p>
                    <p>Information may be shared with trusted service providers when necessary to complete an order or provide a service, such as:</p>
                    <ul class="wl-policy-checklist">
                        <li>Courier and delivery companies (for doorstep package handoff)</li>
                        <li>Payment service providers</li>
                        <li>Website and technology service providers</li>
                    </ul>
                    <p>Only information necessary for the relevant service should be shared.</p>

                    <h2>5. Cookies &amp; Browser Tracking</h2>
                    <p>Our website may use cookies and similar technologies to improve website functionality, understand website usage, and provide a better shopping experience.</p>
                    <p>You may be able to manage or disable cookies through your browser settings. Some website features may not function properly if certain cookies are disabled.</p>

                    <h2>6. Third-Party Services</h2>
                    <p>Our website may contain links or integrations involving third-party services. WEARLAB is not responsible for the privacy practices or content of external websites. Customers should review the privacy policies of third-party services when providing information directly to them.</p>

                    <h2>7. Children's Privacy</h2>
                    <p>WEARLAB does not knowingly collect personal information from children for purposes that require parental consent. If you believe a child has provided personal information to us inappropriately, please contact us so that we can review and remove it where appropriate.</p>

                    <h2>8. Policy Updates</h2>
                    <p>WEARLAB may update this Privacy Policy from time to time to reflect changes in our business, website, or applicable requirements. Any updated version will be published on this page.</p>

                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <div>
                            <h4>Questions regarding your personal information?</h4>
                            <p>Our support team is available to address any data privacy inquiries.</p>
                            <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="wl-btn wl-btn--sm wl-btn--primary">Contact Privacy Team</a>
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
