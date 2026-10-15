<?php
/**
 * Template Name: All Store Policies
 * Location: page-policies.php
 */

get_header();

$wa_raw = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
$wa_clean = preg_replace( '/[^0-9]/', '', $wa_raw );
$contact_email = get_theme_mod( 'wearlab_contact_email', 'orders@wearlab.store' );
?>

<div class="wl-policy-page-wrapper">
    <!-- Hero / Breadcrumb Header -->
    <div class="wl-policy-hero">
        <div class="wl-container">
            <div class="wl-policy-breadcrumbs">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <span class="wl-policy-breadcrumbs__sep">/</span>
                <span class="wl-policy-breadcrumbs__current">Store Policies</span>
            </div>
            <span class="wl-page-badge">Customer Transparency</span>
            <h1 class="wl-page-title">STORE POLICIES</h1>
            <p class="wl-page-subtitle">At WEARLAB, we want your shopping experience to be simple, transparent, and reliable. Please read the following policies before placing your order.</p>
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

                <!-- Quick Section Tabs / Anchors -->
                <div class="wl-policy-quick-tabs" style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 32px; padding-bottom: 20px; border-bottom: 2px solid #111;">
                    <a href="#shipping-policy" class="wl-btn wl-btn--sm wl-btn--outline" style="font-size: 12px; letter-spacing: 0.05em;">1. Shipping Policy</a>
                    <a href="#return-exchange-policy" class="wl-btn wl-btn--sm wl-btn--outline" style="font-size: 12px; letter-spacing: 0.05em;">2. Return &amp; Exchange</a>
                    <a href="#privacy-policy" class="wl-btn wl-btn--sm wl-btn--outline" style="font-size: 12px; letter-spacing: 0.05em;">3. Privacy Policy</a>
                    <a href="#terms-conditions" class="wl-btn wl-btn--sm wl-btn--outline" style="font-size: 12px; letter-spacing: 0.05em;">4. Terms &amp; Conditions</a>
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
                    ?>
                    
                    <!-- ==========================================
                         1. SHIPPING POLICY
                         ========================================== -->
                    <section id="shipping-policy" style="margin-bottom: 50px; scroll-margin-top: 100px;">
                        <span class="wl-page-badge" style="margin-bottom: 8px;">Section 01</span>
                        <h2 style="margin-top: 6px; font-size: 20px;">1. Shipping Policy</h2>
                        
                        <h3>Order Processing</h3>
                        <ul class="wl-policy-checklist">
                            <li>Orders are processed after confirmation.</li>
                            <li>Orders are normally dispatched within <strong>1&ndash;3 business days</strong>.</li>
                            <li>Customized printing and embroidery orders may require additional processing time depending on the design and quantity.</li>
                            <li>Customers may be contacted through WhatsApp or phone to confirm order details when required.</li>
                        </ul>

                        <h3>Delivery Time</h3>
                        <div class="wl-policy-grid-boxes">
                            <div class="wl-policy-box">
                                <h4>Standard Nationwide Delivery</h4>
                                <p>Standard delivery within Pakistan generally takes <strong>2&ndash;5 business days after dispatch</strong>, depending on the destination and courier service.</p>
                            </div>
                            <div class="wl-policy-box">
                                <h4>Remote Areas</h4>
                                <p>Delivery to remote areas may take longer. Delivery timelines are estimates and may be affected by courier delays, weather, public holidays, or other circumstances beyond WEARLAB's control.</p>
                            </div>
                        </div>

                        <h3>Shipping Charges</h3>
                        <ul class="wl-policy-checklist">
                            <li>Standard shipping charges are calculated and displayed during checkout or communicated before order confirmation.</li>
                            <li>Any applicable additional charges for special delivery requirements will be communicated to the customer.</li>
                        </ul>

                        <h3>Order Tracking</h3>
                        <p>Where tracking is available, customers may receive a tracking number through WhatsApp, SMS, or another available communication channel.</p>

                        <h3>Incorrect Address</h3>
                        <div class="wl-policy-box wl-policy-box--cross" style="margin-top: 10px;">
                            <h4>Customer Address Responsibility</h4>
                            <p style="margin: 0; font-size: 13.5px; color: #444;">Customers are responsible for providing a complete and accurate delivery address and contact number. WEARLAB is not responsible for delays or additional charges resulting from incorrect or incomplete information provided by the customer.</p>
                        </div>
                    </section>

                    <hr style="border: 0; border-top: 1px dashed #ddd; margin: 40px 0;">

                    <!-- ==========================================
                         2. RETURN & EXCHANGE POLICY
                         ========================================== -->
                    <section id="return-exchange-policy" style="margin-bottom: 50px; scroll-margin-top: 100px;">
                        <span class="wl-page-badge" style="margin-bottom: 8px;">Section 02</span>
                        <h2 style="margin-top: 6px; font-size: 20px;">2. Return &amp; Exchange Policy</h2>
                        <p>We want you to be satisfied with your WEARLAB purchase. Our return and exchange policy is designed to keep the process fair for both customers and our brand.</p>

                        <h3>Eligibility for Exchange</h3>
                        <p>An exchange may be requested if:</p>
                        <ul class="wl-policy-checklist">
                            <li>The product received is <strong>damaged or defective</strong>.</li>
                            <li>The wrong product, size, or item was sent by WEARLAB.</li>
                            <li>The product has a manufacturing or printing defect.</li>
                        </ul>
                        <div class="wl-policy-box wl-policy-box--check" style="margin: 12px 0 20px;">
                            <h4>Exchange Window</h4>
                            <p style="margin: 0; font-size: 13.5px;">Exchange requests should be made within <strong>7 days of receiving the order</strong>.</p>
                        </div>

                        <h3>Product Condition</h3>
                        <p>To qualify for an exchange:</p>
                        <ul class="wl-policy-checklist">
                            <li>The product must be <strong>unused and unwashed</strong>.</li>
                            <li>The product must be in its original condition.</li>
                            <li>Original tags and packaging should be retained where applicable.</li>
                            <li>The customer may be required to provide clear photographs or videos of the issue before the exchange is approved.</li>
                        </ul>

                        <h3>Size Exchanges &amp; Customized Pieces</h3>
                        <div class="wl-policy-grid-boxes">
                            <div class="wl-policy-box">
                                <h4>Size Exchanges</h4>
                                <p>If you ordered the wrong size, WEARLAB may offer an exchange subject to product availability.</p>
                                <p style="margin: 0; font-size: 12.5px; color: #666;"><em>Customers may be responsible for the applicable return and reshipping costs for size-related exchanges.</em></p>
                            </div>
                            <div class="wl-policy-box" style="border-left: 3px solid #f59e0b;">
                                <h4 style="color: #b45309;">Customized Products</h4>
                                <p style="margin: 0; font-size: 13px; color: #444;">Customized, personalized, printed, or embroidered products are <strong>not eligible for return or exchange due to change of mind, incorrect size selection, or personal preference</strong>, unless the item is defective or WEARLAB sent the wrong product.</p>
                            </div>
                        </div>

                        <h3>Non-Returnable Conditions</h3>
                        <div class="wl-policy-box wl-policy-box--cross">
                            <h4>Returns/exchanges may NOT be accepted when:</h4>
                            <ul>
                                <li>The product has been worn, washed, altered, or damaged by the customer.</li>
                                <li>Tags have been removed where applicable.</li>
                                <li>The product has been damaged due to improper washing or care.</li>
                                <li>The request is made outside the applicable exchange period.</li>
                                <li>The customer simply changes their mind after receiving the product.</li>
                            </ul>
                        </div>

                        <h3>How to Request an Exchange</h3>
                        <p>Contact WEARLAB through our official customer support/WhatsApp channel with:</p>
                        <ol class="wl-policy-steps" style="background: #fafafa; border: 1px solid #e8e8e8; border-radius: 6px; padding: 18px 20px 18px 40px; margin: 14px 0 20px;">
                            <li>Order number</li>
                            <li>Customer name</li>
                            <li>Product name and size</li>
                            <li>Reason for exchange</li>
                            <li>Clear photos/videos showing the issue</li>
                        </ol>
                        <p>Our team will review the request and provide the next steps.</p>
                    </section>

                    <hr style="border: 0; border-top: 1px dashed #ddd; margin: 40px 0;">

                    <!-- ==========================================
                         3. PRIVACY POLICY
                         ========================================== -->
                    <section id="privacy-policy" style="margin-bottom: 50px; scroll-margin-top: 100px;">
                        <span class="wl-page-badge" style="margin-bottom: 8px;">Section 03</span>
                        <h2 style="margin-top: 6px; font-size: 20px;">3. Privacy Policy</h2>
                        <p>WEARLAB respects your privacy and is committed to protecting the information you provide when using our website or purchasing our products.</p>

                        <h3>Information We Collect</h3>
                        <p>When you place an order or interact with our website, we may collect information such as:</p>
                        <ul class="wl-policy-checklist">
                            <li>Name</li>
                            <li>Phone number</li>
                            <li>Email address</li>
                            <li>Delivery address</li>
                            <li>City</li>
                            <li>Order details</li>
                            <li>Payment-related information where necessary for processing your order</li>
                            <li>Messages or information you provide to customer support</li>
                        </ul>
                        <p><em>We only collect information that is reasonably necessary to provide our services.</em></p>

                        <h3>How We Use Your Information</h3>
                        <p>Your information may be used to:</p>
                        <ul class="wl-policy-checklist">
                            <li>Process and deliver your orders</li>
                            <li>Confirm orders and contact you regarding your purchase</li>
                            <li>Provide customer support</li>
                            <li>Process exchanges or resolve order issues</li>
                            <li>Improve our products and services</li>
                            <li>Maintain order and transaction records</li>
                            <li>Send promotional communications where permitted and where you have chosen to receive them</li>
                        </ul>

                        <h3>Information Protection</h3>
                        <p>WEARLAB takes reasonable measures to protect customer information against unauthorized access, misuse, alteration, or disclosure.</p>
                        <p style="font-size: 13px; color: #666;">However, no online transmission or electronic storage system can be guaranteed to be completely secure.</p>

                        <h3>Sharing of Information</h3>
                        <p><strong>WEARLAB does not sell or rent your personal information.</strong> Information may be shared with trusted service providers when necessary to complete an order or provide a service, such as:</p>
                        <ul class="wl-policy-checklist">
                            <li>Courier and delivery companies</li>
                            <li>Payment service providers</li>
                            <li>Website and technology service providers</li>
                        </ul>
                        <p>Only information necessary for the relevant service should be shared.</p>

                        <h3>Cookies &amp; Third-Party Services</h3>
                        <p>Our website may use cookies and similar technologies to improve website functionality, understand website usage, and provide a better shopping experience. You may manage or disable cookies through your browser settings.</p>
                        <p>Our website may contain links or integrations involving third-party services. WEARLAB is not responsible for the privacy practices or content of external websites. Customers should review the privacy policies of third-party services when providing information directly to them.</p>

                        <h3>Children's Privacy &amp; Policy Updates</h3>
                        <p>WEARLAB does not knowingly collect personal information from children for purposes that require parental consent. If you believe a child has provided personal information to us inappropriately, please contact us so that we can review and remove it where appropriate.</p>
                        <p>WEARLAB may update this Privacy Policy from time to time to reflect changes in our business, website, or applicable requirements. Any updated version will be published on this page.</p>
                    </section>

                    <hr style="border: 0; border-top: 1px dashed #ddd; margin: 40px 0;">

                    <!-- ==========================================
                         4. TERMS & CONDITIONS
                         ========================================== -->
                    <section id="terms-conditions" style="margin-bottom: 50px; scroll-margin-top: 100px;">
                        <span class="wl-page-badge" style="margin-bottom: 8px;">Section 04</span>
                        <h2 style="margin-top: 6px; font-size: 20px;">4. Terms &amp; Conditions</h2>
                        <p>By using the WEARLAB website or placing an order, you agree to the applicable policies and terms published on this website.</p>

                        <h3>Product Information</h3>
                        <p>We make reasonable efforts to ensure that product descriptions, photographs, colors, sizes, and prices are accurate. However, slight differences in color may occur due to lighting, photography, or differences between device screens.</p>

                        <h3>Pricing</h3>
                        <p>WEARLAB reserves the right to change product prices, offers, availability, and product specifications without prior notice.</p>

                        <h3>Order Cancellation</h3>
                        <div class="wl-policy-box" style="border-left: 3px solid #111;">
                            <h4>Cancellation Terms</h4>
                            <p style="margin: 0; font-size: 13.5px;">Orders may be cancelled before dispatch, subject to confirmation by WEARLAB. Once an order has been dispatched, cancellation may no longer be possible.</p>
                        </div>

                        <h3>Product Availability</h3>
                        <p>All products are subject to availability. If an ordered product becomes unavailable, WEARLAB may contact the customer regarding an alternative, replacement, or applicable refund.</p>

                        <h3>Customer Support Contact</h3>
                        <p>For questions regarding shipping, returns, exchanges, privacy, or orders, please contact WEARLAB through our official customer support channels.</p>
                    </section>

                    <!-- Notice / Support Action Card -->
                    <div class="wl-policy-notice-card">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#121212" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <div>
                            <h4>Have a question regarding any of our policies?</h4>
                            <p>Our concierge team is available to assist you promptly via WhatsApp or Email.</p>
                            <div style="display: flex; gap: 10px; margin-top: 12px; flex-wrap: wrap;">
                                <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=Hi%20WEARLAB%2C%20I%20have%20a%20question%20regarding%20store%20policies" class="wl-btn wl-btn--sm wl-btn--primary" target="_blank" rel="noopener noreferrer">Message on WhatsApp</a>
                                <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="wl-btn wl-btn--sm wl-btn--outline">Email Support</a>
                            </div>
                        </div>
                    </div>

                    <!-- Client Brand Signature -->
                    <div class="wl-policy-brand-footer" style="margin-top: 40px; padding-top: 24px; border-top: 2px solid #111; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #555; text-transform: uppercase; letter-spacing: 0.1em; flex-wrap: wrap; gap: 10px;">
                        <span><strong>WEARLAB</strong> &bull; Designed in Pakistan</span>
                        <span>Website: <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #121212; text-decoration: underline; font-weight: 700;">wearlab.store</a></span>
                    </div>

                    <?php endif; ?>
                </div>
            </main>

        </div>
    </div>
</div>

<?php get_footer(); ?>
