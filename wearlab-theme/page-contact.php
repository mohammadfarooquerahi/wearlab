<?php
/**
 * Template Name: Contact
 * Streetwear Customer Support & Contact Page for WEARLAB
 * Location: page-contact.php
 */

get_header();
?>

<div class="wl-contact-page-wrapper">
    <!-- Header / Banner -->
    <div class="wl-contact-hero">
        <div class="wl-container">
            <span class="wl-page-badge">Customer Care &amp; Inquiries</span>
            <h1 class="wl-page-title">LET'S TALK.</h1>
            <p class="wl-page-subtitle">Have a question about an order, sizing, custom streetwear drops, or bulk orders? We'd love to hear from you.</p>
        </div>
    </div>

    <div class="wl-container wl-contact-container">
        <div class="wl-contact-layout">
            
            <!-- Left Column: Direct Contact Info Cards -->
            <div class="wl-contact-info-col">
                <div class="wl-contact-card">
                    <h2 class="wl-contact-card__title">Get In Touch</h2>
                    <p class="wl-contact-card__desc">Choose your preferred channel below. For instant order assistance, WhatsApp is recommended.</p>
                    
                    <div class="wl-contact-methods">
                        <?php
                        $contact_wa       = get_theme_mod( 'wearlab_social_whatsapp', '923001234567' );
                        $contact_wa_clean = preg_replace( '/[^0-9]/', '', $contact_wa );
                        $contact_ig       = get_theme_mod( 'wearlab_social_instagram', 'https://instagram.com/wearlab_official' );
                        $contact_email    = get_option( 'admin_email', 'info@wearlab.store' );
                        ?>
                        <!-- WhatsApp -->
                        <?php if ( ! empty( $contact_wa_clean ) ) : ?>
                        <a href="https://wa.me/<?php echo esc_attr( $contact_wa_clean ); ?>?text=<?php echo rawurlencode( 'Hi WEARLAB! I have an inquiry' ); ?>" class="wl-contact-method-item" target="_blank" rel="noopener noreferrer">
                            <div class="wl-contact-method-item__icon wl-contact-method-item__icon--whatsapp">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                            </div>
                            <div class="wl-contact-method-item__text">
                                <span class="wl-contact-method-item__label">WhatsApp Concierge</span>
                                <strong class="wl-contact-method-item__val">+<?php echo esc_html( $contact_wa_clean ); ?></strong>
                                <span class="wl-contact-method-item__sub">Instant chat &bull; Mon &ndash; Sat</span>
                            </div>
                        </a>
                        <?php endif; ?>

                        <!-- Email -->
                        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="wl-contact-method-item">
                            <div class="wl-contact-method-item__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div class="wl-contact-method-item__text">
                                <span class="wl-contact-method-item__label">Email Support</span>
                                <strong class="wl-contact-method-item__val"><?php echo esc_html( $contact_email ); ?></strong>
                                <span class="wl-contact-method-item__sub">Response within 24 hours</span>
                            </div>
                        </a>

                        <!-- Instagram -->
                        <?php if ( ! empty( $contact_ig ) ) : ?>
                        <a href="<?php echo esc_url( $contact_ig ); ?>" class="wl-contact-method-item" target="_blank" rel="noopener noreferrer">
                            <div class="wl-contact-method-item__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </div>
                            <div class="wl-contact-method-item__text">
                                <span class="wl-contact-method-item__label">Instagram Community</span>
                                <strong class="wl-contact-method-item__val">@WEARLAB_OFFICIAL</strong>
                                <span class="wl-contact-method-item__sub">Drop previews &bull; Stories</span>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="wl-contact-extra-info">
                        <div class="wl-contact-extra-block">
                            <span class="wl-contact-extra-label">Operating Hours</span>
                            <span class="wl-contact-extra-val">Monday &ndash; Saturday: 10:00 AM &ndash; 8:00 PM (PKT)</span>
                        </div>
                        <div class="wl-contact-extra-block">
                            <span class="wl-contact-extra-label">Dispatch Hubs</span>
                            <span class="wl-contact-extra-val">Lahore &amp; Islamabad, Pakistan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Send A Message Form Card -->
            <div class="wl-contact-form-col">
                <div class="wl-contact-card wl-contact-card--form">
                    <h2 class="wl-contact-card__title">Send Us A Message</h2>
                    <p class="wl-contact-card__desc">Have a specific question? Leave a note and our customer team will get back to you promptly.</p>

                    <form id="wl-contact-form" class="wl-contact__form wl-form" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">
                        <input type="hidden" name="action" value="wearlab_contact">
                        <?php wp_nonce_field( 'wearlab_nonce', 'nonce' ); ?>

                        <div class="wl-contact__message" style="display: none;"></div>

                        <div class="wl-form-row wl-form-row--2cols">
                            <div class="wl-form-group">
                                <label for="contact_name" class="wl-form-label">Full Name <span class="wl-required">*</span></label>
                                <input type="text" id="contact_name" name="name" class="wl-input" placeholder="e.g. Ali Khan" required>
                            </div>
                            <div class="wl-form-group">
                                <label for="contact_email" class="wl-form-label">Email Address <span class="wl-required">*</span></label>
                                <input type="email" id="contact_email" name="email" class="wl-input" placeholder="e.g. ali@example.com" required>
                            </div>
                        </div>

                        <div class="wl-form-row wl-form-row--2cols">
                            <div class="wl-form-group">
                                <label for="contact_phone" class="wl-form-label">Phone / WhatsApp</label>
                                <input type="tel" id="contact_phone" name="phone" class="wl-input" placeholder="e.g. 0300 1234567">
                            </div>
                            <div class="wl-form-group">
                                <label for="contact_subject" class="wl-form-label">Subject</label>
                                <input type="text" id="contact_subject" name="subject" class="wl-input" placeholder="e.g. Sizing inquiry, Exchange..." required>
                            </div>
                        </div>

                        <div class="wl-form-group">
                            <label for="contact_message" class="wl-form-label">Message <span class="wl-required">*</span></label>
                            <textarea id="contact_message" name="message" class="wl-textarea" rows="5" placeholder="Write your message here..." required></textarea>
                        </div>

                        <button type="submit" class="wl-btn wl-btn--primary wl-contact-submit-btn" id="wlContactSubmitBtn">
                            <span>SEND MESSAGE</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
