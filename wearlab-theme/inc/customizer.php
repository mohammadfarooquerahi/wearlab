<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WEARLAB Theme Customizer
 * Comprehensive visual editing controls for all pages, sections, and brand settings.
 */
function wearlab_customize_register( $wp_customize ) {

	/* ==========================================================================
	   1. Brand Identity & Announcement Bar
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_brand_identity', array(
		'title'    => __( 'Brand & Announcement Bar', 'wearlab' ),
		'priority' => 20,
	) );

	// Announcement Bar Enable
	$wp_customize->add_setting( 'wearlab_announcement_enable', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'wearlab_announcement_enable', array(
		'label'   => __( 'Enable Top Announcement Bar', 'wearlab' ),
		'section' => 'wearlab_brand_identity',
		'type'    => 'checkbox',
	) );

	// Top Marquee Item 1
	$wp_customize->add_setting( 'wearlab_topbar_item_1', array(
		'default'           => 'FREE SHIPPING NATIONWIDE',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_topbar_item_1', array(
		'label'   => __( 'Announcement Ticker 1', 'wearlab' ),
		'section' => 'wearlab_brand_identity',
		'type'    => 'text',
	) );

	// Top Marquee Item 2
	$wp_customize->add_setting( 'wearlab_topbar_item_2', array(
		'default'           => '100+ STREETWEAR FITS',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_topbar_item_2', array(
		'label'   => __( 'Announcement Ticker 2', 'wearlab' ),
		'section' => 'wearlab_brand_identity',
		'type'    => 'text',
	) );

	// Top Marquee Item 3
	$wp_customize->add_setting( 'wearlab_topbar_item_3', array(
		'default'           => 'CASH ON DELIVERY (COD) AVAILABLE NATIONWIDE',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_topbar_item_3', array(
		'label'   => __( 'Announcement Ticker 3', 'wearlab' ),
		'section' => 'wearlab_brand_identity',
		'type'    => 'text',
	) );

	/* ==========================================================================
	   2. Social Links & WhatsApp Concierge
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_social_links', array(
		'title'    => __( 'Social Links & WhatsApp', 'wearlab' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'wearlab_social_instagram', array(
		'default'           => 'https://instagram.com/wearlab_official',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_social_instagram', array(
		'label'   => __( 'Instagram URL', 'wearlab' ),
		'section' => 'wearlab_social_links',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'wearlab_social_facebook', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_social_facebook', array(
		'label'   => __( 'Facebook URL', 'wearlab' ),
		'section' => 'wearlab_social_links',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'wearlab_social_tiktok', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_social_tiktok', array(
		'label'   => __( 'TikTok URL', 'wearlab' ),
		'section' => 'wearlab_social_links',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'wearlab_social_whatsapp', array(
		'default'           => '923001234567',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_social_whatsapp', array(
		'label'       => __( 'WhatsApp Number (e.g. 923001234567)', 'wearlab' ),
		'description' => __( 'Used for customer support concierge and floating WhatsApp button.', 'wearlab' ),
		'section'     => 'wearlab_social_links',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_whatsapp_float_enable', array(
		'default'           => true,
		'sanitize_callback' => 'wp_validate_boolean',
	) );
	$wp_customize->add_control( 'wearlab_whatsapp_float_enable', array(
		'label'   => __( 'Enable Floating WhatsApp Chat Button', 'wearlab' ),
		'section' => 'wearlab_social_links',
		'type'    => 'checkbox',
	) );

	/* ==========================================================================
	   3. Homepage - Hero Banner Section
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_hero', array(
		'title'    => __( 'Homepage: Hero Banner', 'wearlab' ),
		'priority' => 41,
	) );

	$wp_customize->add_setting( 'wearlab_hero_heading', array(
		'default'           => 'Summer 2026',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_hero_heading', array(
		'label'   => __( 'Hero Main Heading', 'wearlab' ),
		'section' => 'wearlab_home_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_hero_image', array(
		'label'       => __( 'Hero Background Image', 'wearlab' ),
		'description' => __( 'Upload full-width banner image (recommended 1920x800px).', 'wearlab' ),
		'section'     => 'wearlab_home_hero',
	) ) );

	$wp_customize->add_setting( 'wearlab_hero_btn_text', array(
		'default'           => 'Live Now',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_hero_btn_text', array(
		'label'   => __( 'Hero Button Label', 'wearlab' ),
		'section' => 'wearlab_home_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_hero_btn_link', array(
		'default'           => '/shop/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_hero_btn_link', array(
		'label'   => __( 'Hero Button Link', 'wearlab' ),
		'section' => 'wearlab_home_hero',
		'type'    => 'text',
	) );

	/* ==========================================================================
	   4. Homepage - Featured Products Section
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_featured', array(
		'title'    => __( 'Homepage: Featured Products', 'wearlab' ),
		'priority' => 42,
	) );

	$wp_customize->add_setting( 'wearlab_featured_overline', array(
		'default'           => 'THE LATEST DROP',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_featured_overline', array(
		'label'   => __( 'Overline Text', 'wearlab' ),
		'section' => 'wearlab_home_featured',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_featured_title', array(
		'default'           => 'MADE FOR YOUR EVERYDAY.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_featured_title', array(
		'label'   => __( 'Section Title', 'wearlab' ),
		'section' => 'wearlab_home_featured',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_featured_desc', array(
		'default'           => 'Discover our latest essentials — designed with clean silhouettes, modern details and the confidence to stand on their own.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_featured_desc', array(
		'label'   => __( 'Section Description', 'wearlab' ),
		'section' => 'wearlab_home_featured',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'wearlab_featured_btn_text', array(
		'default'           => 'SHOP ALL',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_featured_btn_text', array(
		'label'   => __( 'Button Text', 'wearlab' ),
		'section' => 'wearlab_home_featured',
		'type'    => 'text',
	) );

	/* ==========================================================================
	   5. Homepage - Shop by Fit (Denim & Streetwear)
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_fits', array(
		'title'    => __( 'Homepage: Shop by Fit Cards', 'wearlab' ),
		'priority' => 43,
	) );

	$wp_customize->add_setting( 'wearlab_fit_overline', array(
		'default'           => 'DENIM & STREETWEAR',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_overline', array(
		'label'   => __( 'Overline', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_fit_title', array(
		'default'           => 'Shop by Fit',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_title', array(
		'label'   => __( 'Title', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );

	// Fit Card 1
	$wp_customize->add_setting( 'wearlab_fit_1_name', array(
		'default'           => 'Wide Leg',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_1_name', array(
		'label'   => __( 'Fit 1: Title', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_1_price', array(
		'default'           => 'Rs.3,995.00 PKR',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_1_price', array(
		'label'   => __( 'Fit 1: Price / Tagline', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_1_link', array(
		'default'           => '/shop/?filter_fit=wide-leg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_fit_1_link', array(
		'label'   => __( 'Fit 1: Link URL', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_1_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_fit_1_img', array(
		'label'   => __( 'Fit 1: Custom Image', 'wearlab' ),
		'section' => 'wearlab_home_fits',
	) ) );

	// Fit Card 2
	$wp_customize->add_setting( 'wearlab_fit_2_name', array(
		'default'           => 'Straight Leg',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_2_name', array(
		'label'   => __( 'Fit 2: Title', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_2_price', array(
		'default'           => 'Rs.3,995.00 PKR',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_2_price', array(
		'label'   => __( 'Fit 2: Price / Tagline', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_2_link', array(
		'default'           => '/shop/?filter_fit=straight-leg',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_fit_2_link', array(
		'label'   => __( 'Fit 2: Link URL', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_2_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_fit_2_img', array(
		'label'   => __( 'Fit 2: Custom Image', 'wearlab' ),
		'section' => 'wearlab_home_fits',
	) ) );

	// Fit Card 3
	$wp_customize->add_setting( 'wearlab_fit_3_name', array(
		'default'           => 'Bootcut',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_3_name', array(
		'label'   => __( 'Fit 3: Title', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_3_price', array(
		'default'           => 'Rs.3,995.00 PKR',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_3_price', array(
		'label'   => __( 'Fit 3: Price / Tagline', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_3_link', array(
		'default'           => '/shop/?filter_fit=bootcut',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_fit_3_link', array(
		'label'   => __( 'Fit 3: Link URL', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_3_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_fit_3_img', array(
		'label'   => __( 'Fit 3: Custom Image', 'wearlab' ),
		'section' => 'wearlab_home_fits',
	) ) );

	// Fit Card 4
	$wp_customize->add_setting( 'wearlab_fit_4_name', array(
		'default'           => 'Wide Leg Low Rise',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_4_name', array(
		'label'   => __( 'Fit 4: Title', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_4_price', array(
		'default'           => 'Rs.3,995.00 PKR',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_fit_4_price', array(
		'label'   => __( 'Fit 4: Price / Tagline', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_4_link', array(
		'default'           => '/shop/?filter_fit=wide-leg-low-rise',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_fit_4_link', array(
		'label'   => __( 'Fit 4: Link URL', 'wearlab' ),
		'section' => 'wearlab_home_fits',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_fit_4_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_fit_4_img', array(
		'label'   => __( 'Fit 4: Custom Image', 'wearlab' ),
		'section' => 'wearlab_home_fits',
	) ) );

	/* ==========================================================================
	   6. Homepage - Brand Statement Section
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_statement', array(
		'title'    => __( 'Homepage: Brand Statement', 'wearlab' ),
		'priority' => 44,
	) );

	$wp_customize->add_setting( 'wearlab_brand_overline', array(
		'default'           => 'THE WEARLAB STANDARD',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_brand_overline', array(
		'label'   => __( 'Overline', 'wearlab' ),
		'section' => 'wearlab_home_statement',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_brand_title', array(
		'default'           => 'LESS NOISE. MORE STYLE.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_brand_title', array(
		'label'   => __( 'Title', 'wearlab' ),
		'section' => 'wearlab_home_statement',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_brand_text', array(
		'default'           => 'We believe in creating high-quality, modern streetwear that speaks for itself. No loud logos, no fast fashion compromises. Just premium fabrics, thoughtful cuts, and designs made for your everyday life.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_brand_text', array(
		'label'   => __( 'Statement Paragraph', 'wearlab' ),
		'section' => 'wearlab_home_statement',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'wearlab_brand_btn_text', array(
		'default'           => 'OUR STORY',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_brand_btn_text', array(
		'label'   => __( 'Button Label', 'wearlab' ),
		'section' => 'wearlab_home_statement',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_brand_btn_link', array(
		'default'           => '/about/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_brand_btn_link', array(
		'label'   => __( 'Button Link URL', 'wearlab' ),
		'section' => 'wearlab_home_statement',
		'type'    => 'text',
	) );

	/* ==========================================================================
	   7. Homepage - Collection Feature Banner
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_feature_banner', array(
		'title'    => __( 'Homepage: Collection Banner', 'wearlab' ),
		'priority' => 45,
	) );

	$wp_customize->add_setting( 'wearlab_feature_overline', array(
		'default'           => 'THE COLLECTION',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_feature_overline', array(
		'label'   => __( 'Overline', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_feature_title', array(
		'default'           => 'QUIETLY BOLD.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_feature_title', array(
		'label'   => __( 'Title', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_feature_text', array(
		'default'           => 'Engineered for the modern wardrobe, our pieces combine minimalist aesthetics with superior craftsmanship.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_feature_text', array(
		'label'   => __( 'Description', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'wearlab_feature_btn_text', array(
		'default'           => 'SHOP WEARLAB',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_feature_btn_text', array(
		'label'   => __( 'Button Text', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_feature_btn_link', array(
		'default'           => '/shop/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_feature_btn_link', array(
		'label'   => __( 'Button Link', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_feature_img', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wearlab_feature_img', array(
		'label'   => __( 'Banner Image', 'wearlab' ),
		'section' => 'wearlab_home_feature_banner',
	) ) );

	/* ==========================================================================
	   8. Homepage - Customer Love (Reviews)
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_reviews', array(
		'title'    => __( 'Homepage: Customer Reviews', 'wearlab' ),
		'priority' => 46,
	) );

	$wp_customize->add_setting( 'wearlab_reviews_overline', array(
		'default'           => 'CUSTOMER LOVE',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_reviews_overline', array(
		'label'   => __( 'Overline', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_reviews_title', array(
		'default'           => 'REAL FITS. REAL FEEDBACK.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_reviews_title', array(
		'label'   => __( 'Section Title', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_reviews_desc', array(
		'default'           => 'What people across Pakistan are saying about WEARLAB everyday wear.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_reviews_desc', array(
		'label'   => __( 'Section Subtitle', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'textarea',
	) );

	// Review 1
	$wp_customize->add_setting( 'wearlab_review_1_author', array(
		'default'           => 'Ali H.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_1_author', array(
		'label'   => __( 'Review 1: Author Name', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_1_city', array(
		'default'           => 'Lahore',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_1_city', array(
		'label'   => __( 'Review 1: City', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_1_text', array(
		'default'           => 'Amazing quality and fit. The drop shoulder tees are my new everyday favorites — clean silhouette, no loud branding.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_review_1_text', array(
		'label'   => __( 'Review 1: Review Text', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'textarea',
	) );

	// Review 2
	$wp_customize->add_setting( 'wearlab_review_2_author', array(
		'default'           => 'Sara K.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_2_author', array(
		'label'   => __( 'Review 2: Author Name', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_2_city', array(
		'default'           => 'Karachi',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_2_city', array(
		'label'   => __( 'Review 2: City', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_2_text', array(
		'default'           => 'Minimalist design but great attention to detail. Polo stitching and fabric feel premium for the price.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_review_2_text', array(
		'label'   => __( 'Review 2: Review Text', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'textarea',
	) );

	// Review 3
	$wp_customize->add_setting( 'wearlab_review_3_author', array(
		'default'           => 'Omer T.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_3_author', array(
		'label'   => __( 'Review 3: Author Name', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_3_city', array(
		'default'           => 'Islamabad',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_review_3_city', array(
		'label'   => __( 'Review 3: City', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'text',
	) );
	$wp_customize->add_setting( 'wearlab_review_3_text', array(
		'default'           => 'Fast shipping and the material is premium. Finally streetwear that looks as good in person as it does online.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_review_3_text', array(
		'label'   => __( 'Review 3: Review Text', 'wearlab' ),
		'section' => 'wearlab_home_reviews',
		'type'    => 'textarea',
	) );

	/* ==========================================================================
	   9. Homepage - Newsletter & Final Call to Action
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_home_cta', array(
		'title'    => __( 'Homepage: Newsletter & Final CTA', 'wearlab' ),
		'priority' => 47,
	) );

	$wp_customize->add_setting( 'wearlab_newsletter_heading', array(
		'default'           => 'JOIN THE LAB.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_newsletter_heading', array(
		'label'   => __( 'Newsletter Heading', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_newsletter_desc', array(
		'default'           => 'Sign up for exclusive drops and updates.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_newsletter_desc', array(
		'label'   => __( 'Newsletter Subtext', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'wearlab_cta_heading', array(
		'default'           => 'YOUR EVERYDAY FIT.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_cta_heading', array(
		'label'   => __( 'Final CTA Heading', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_cta_desc', array(
		'default'           => 'Elevate your wardrobe with WEARLAB.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'wearlab_cta_desc', array(
		'label'   => __( 'Final CTA Subtext', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'wearlab_cta_btn_text', array(
		'default'           => 'SHOP NOW',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_cta_btn_text', array(
		'label'   => __( 'Final CTA Button Text', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_cta_btn_link', array(
		'default'           => '/shop/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'wearlab_cta_btn_link', array(
		'label'   => __( 'Final CTA Button Link', 'wearlab' ),
		'section' => 'wearlab_home_cta',
		'type'    => 'text',
	) );

	/* ==========================================================================
	   10. Footer Settings
	   ========================================================================== */
	$wp_customize->add_section( 'wearlab_footer', array(
		'title'    => __( 'Footer Settings', 'wearlab' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'wearlab_footer_country', array(
		'default'           => 'Pakistan',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_footer_country', array(
		'label'   => __( 'Country / Region Label', 'wearlab' ),
		'section' => 'wearlab_footer',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'wearlab_copyright_text', array(
		'default'           => '© ' . date('Y') . ', WEARLAB',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'wearlab_copyright_text', array(
		'label'   => __( 'Copyright Text', 'wearlab' ),
		'section' => 'wearlab_footer',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'wearlab_customize_register' );
