<?php
/**
 * The template for displaying the front page
 * Location: front-page.php
 */
get_header();

$theme_uri = get_template_directory_uri();

// 1. Hero Settings
$custom_hero_img = get_theme_mod( 'wearlab_hero_image', '' );
$hero_img_url    = ! empty( $custom_hero_img ) ? $custom_hero_img : $theme_uri . '/assets/images/hero-banner.jpg';
$hero_title      = get_theme_mod( 'wearlab_hero_heading', 'Summer 2026' );
$hero_btn_text   = get_theme_mod( 'wearlab_hero_btn_text', 'Live Now' );
$hero_btn_link   = get_theme_mod( 'wearlab_hero_btn_link', '/shop/' );

// 2. Featured Products Settings
$featured_overline = get_theme_mod( 'wearlab_featured_overline', 'THE LATEST DROP' );
$featured_title    = get_theme_mod( 'wearlab_featured_title', 'MADE FOR YOUR EVERYDAY.' );
$featured_desc     = get_theme_mod( 'wearlab_featured_desc', 'Discover our latest essentials — designed with clean silhouettes, modern details and the confidence to stand on their own.' );
$featured_btn_text = get_theme_mod( 'wearlab_featured_btn_text', 'SHOP ALL' );

// 3. Brand Statement Settings
$brand_overline = get_theme_mod( 'wearlab_brand_overline', 'THE WEARLAB STANDARD' );
$brand_title    = get_theme_mod( 'wearlab_brand_title', 'LESS NOISE. MORE STYLE.' );
$brand_text     = get_theme_mod( 'wearlab_brand_text', 'We believe in creating high-quality, modern streetwear that speaks for itself. No loud logos, no fast fashion compromises. Just premium fabrics, thoughtful cuts, and designs made for your everyday life.' );
$brand_btn_text = get_theme_mod( 'wearlab_brand_btn_text', 'OUR STORY' );
$brand_btn_link = get_theme_mod( 'wearlab_brand_btn_link', '/about/' );

// 4. Collection Banner Settings
$feature_overline = get_theme_mod( 'wearlab_feature_overline', 'THE COLLECTION' );
$feature_title    = get_theme_mod( 'wearlab_feature_title', 'QUIETLY BOLD.' );
$feature_text     = get_theme_mod( 'wearlab_feature_text', 'Engineered for the modern wardrobe, our pieces combine minimalist aesthetics with superior craftsmanship.' );
$feature_btn_text = get_theme_mod( 'wearlab_feature_btn_text', 'SHOP WEARLAB' );
$feature_btn_link = get_theme_mod( 'wearlab_feature_btn_link', '/shop/' );
$feature_img      = get_theme_mod( 'wearlab_feature_img', '' ) ?: $theme_uri . '/assets/images/p2 pic3.jpeg';

// 6. Reviews Settings
$reviews_overline = get_theme_mod( 'wearlab_reviews_overline', 'CUSTOMER LOVE' );
$reviews_title    = get_theme_mod( 'wearlab_reviews_title', 'REAL FITS. REAL FEEDBACK.' );
$reviews_desc     = get_theme_mod( 'wearlab_reviews_desc', 'What people across Pakistan are saying about WEARLAB everyday wear.' );

$review_1 = array(
	'author'   => get_theme_mod( 'wearlab_review_1_author', 'Ali H.' ),
	'city'     => get_theme_mod( 'wearlab_review_1_city', 'Lahore' ),
	'text'     => get_theme_mod( 'wearlab_review_1_text', 'Amazing quality and fit. The drop shoulder tees are my new everyday favorites — clean silhouette, no loud branding.' ),
	'initials' => 'AH',
);
$review_2 = array(
	'author'   => get_theme_mod( 'wearlab_review_2_author', 'Sara K.' ),
	'city'     => get_theme_mod( 'wearlab_review_2_city', 'Karachi' ),
	'text'     => get_theme_mod( 'wearlab_review_2_text', 'Minimalist design but great attention to detail. Polo stitching and fabric feel premium for the price.' ),
	'initials' => 'SK',
);
$review_3 = array(
	'author'   => get_theme_mod( 'wearlab_review_3_author', 'Omer T.' ),
	'city'     => get_theme_mod( 'wearlab_review_3_city', 'Islamabad' ),
	'text'     => get_theme_mod( 'wearlab_review_3_text', 'Fast shipping and the material is premium. Finally streetwear that looks as good in person as it does online.' ),
	'initials' => 'OT',
);

// 7. Newsletter & Final CTA
$newsletter_heading = get_theme_mod( 'wearlab_newsletter_heading', 'JOIN THE LAB.' );
$newsletter_desc    = get_theme_mod( 'wearlab_newsletter_desc', 'Sign up for exclusive drops and updates.' );

$cta_heading  = get_theme_mod( 'wearlab_cta_heading', 'YOUR EVERYDAY FIT.' );
$cta_desc     = get_theme_mod( 'wearlab_cta_desc', 'Elevate your wardrobe with WEARLAB.' );
$cta_btn_text = get_theme_mod( 'wearlab_cta_btn_text', 'SHOP NOW' );
$cta_btn_link = get_theme_mod( 'wearlab_cta_btn_link', '/shop/' );
?>

<!-- 1. Hero Section -->
<section class="wl-hero" style="background-image: url('<?php echo esc_url( $hero_img_url ); ?>');">
    <div class="wl-hero__overlay"></div>
    <div class="wl-hero__content">
        <h1 class="wl-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
        <div class="wl-hero__actions">
            <a href="<?php echo esc_url( home_url( $hero_btn_link ) ); ?>" class="wl-hero__btn"><?php echo esc_html( $hero_btn_text ); ?></a>
        </div>
    </div>
</section>

<!-- 2. Featured Products Section -->
<section class="wl-featured">
    <div class="wl-container">
        <div class="wl-featured__header">
            <p class="wl-overline"><?php echo esc_html( $featured_overline ); ?></p>
            <h2 class="wl-section-title"><?php echo esc_html( $featured_title ); ?></h2>
            <p class="wl-section-desc"><?php echo esc_html( $featured_desc ); ?></p>
        </div>

        <div class="wl-products-grid">
            <?php
            $has_woo_products = false;
            if ( class_exists( 'WooCommerce' ) ) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 4,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() && $loop->found_posts > 0 ) {
                    $has_woo_products = true;
                    while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
                            $product = wc_get_product( get_the_ID() );
                        }
                        if ( empty( $product ) ) {
                            continue;
                        }
                        $badge = '';
                        if ( $product->is_featured() ) {
                            $badge = 'BEST SELLER';
                        } elseif ( $product->is_on_sale() ) {
                            $badge = 'SALE';
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="wl-product-card">
                            <div class="wl-product-card__image-wrap">
                                <?php if ( $badge ) : ?>
                                    <span class="wl-product-card__badge"><?php echo esc_html( $badge ); ?></span>
                                <?php endif; ?>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'wl-product-card__img' ) ); ?>
                                <?php else : ?>
                                    <div class="wl-product-card__placeholder"></div>
                                <?php endif; ?>
                                <span class="wl-product-card__cta">Shop now</span>
                            </div>
                            <div class="wl-product-card__info">
                                <h3 class="wl-product-card__name"><?php the_title(); ?></h3>
                                <p class="wl-product-card__price"><?php echo $product->get_price_html(); ?></p>
                                <?php
                                if ( $product->is_type( 'variable' ) ) {
                                    $attributes = $product->get_variation_attributes();
                                    foreach ( $attributes as $attribute_name => $options ) {
                                        if ( stripos( $attribute_name, 'size' ) !== false || stripos( $attribute_name, 'pa_size' ) !== false ) {
                                            echo '<div class="wl-product-card__sizes">';
                                            foreach ( $options as $option ) {
                                                echo '<span class="wl-product-card__size">' . esc_html( $option ) . '</span>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </a>
                        <?php
                    endwhile;
                }
                wp_reset_postdata();
            }

            if ( ! $has_woo_products ) :
                $sample_products = array(
                    array(
                        'name'  => 'Drop Shoulder Retro',
                        'price' => 'PKR 1,700',
                        'badge' => 'NEW ARRIVAL',
                        'sizes' => array( 'S', 'M', 'L', 'XL' ),
                        'link'  => '/product-category/drop-shoulders/',
                        'img'   => $theme_uri . '/assets/images/p2 pic1.jpeg',
                    ),
                    array(
                        'name'  => 'Drop Shoulder Vibes',
                        'price' => 'PKR 1,800',
                        'badge' => 'BEST SELLER',
                        'sizes' => array( 'S', 'M', 'L', 'XL' ),
                        'link'  => '/product-category/drop-shoulders/',
                        'img'   => $theme_uri . '/assets/images/p1 pic1.jpeg',
                    ),
                    array(
                        'name'  => 'WEARLAB Polo',
                        'price' => 'PKR 1,550',
                        'badge' => '',
                        'sizes' => array( 'S', 'M', 'L', 'XL' ),
                        'link'  => '/product-category/polos/',
                        'img'   => $theme_uri . '/assets/images/product-placeholder-3.jpg',
                    ),
                    array(
                        'name'  => 'Essential Tee',
                        'price' => 'PKR 1,200',
                        'badge' => '',
                        'sizes' => array( 'S', 'M', 'L', 'XL' ),
                        'link'  => '/product-category/t-shirts/',
                        'img'   => $theme_uri . '/assets/images/product-placeholder-4.jpg',
                    ),
                );
                foreach ( $sample_products as $sp ) :
                ?>
                <a href="<?php echo esc_url( home_url( $sp['link'] ) ); ?>" class="wl-product-card">
                    <div class="wl-product-card__image-wrap">
                        <?php if ( ! empty( $sp['badge'] ) ) : ?>
                            <span class="wl-product-card__badge"><?php echo esc_html( $sp['badge'] ); ?></span>
                        <?php endif; ?>
                        <div class="wl-product-card__placeholder" style="background-image: url('<?php echo esc_url( $sp['img'] ); ?>');"></div>
                        <span class="wl-product-card__cta">Shop now</span>
                    </div>
                    <div class="wl-product-card__info">
                        <h3 class="wl-product-card__name"><?php echo esc_html( $sp['name'] ); ?></h3>
                        <p class="wl-product-card__price"><?php echo esc_html( $sp['price'] ); ?></p>
                        <?php if ( ! empty( $sp['sizes'] ) ) : ?>
                        <div class="wl-product-card__sizes">
                            <?php foreach ( $sp['sizes'] as $size ) : ?>
                                <span class="wl-product-card__size"><?php echo esc_html( $size ); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endforeach;
            endif;
            ?>
        </div>

        <div class="wl-featured__action">
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary"><?php echo esc_html( $featured_btn_text ); ?></a>
        </div>
    </div>
</section>

<!-- 3. Brand Statement Section -->
<section class="wl-brand-statement">
    <div class="wl-container wl-container--narrow">
        <p class="wl-overline"><?php echo esc_html( $brand_overline ); ?></p>
        <h2 class="wl-section-title"><?php echo esc_html( $brand_title ); ?></h2>
        <p class="wl-brand-statement__text"><?php echo esc_html( $brand_text ); ?></p>
        <a href="<?php echo esc_url( home_url( $brand_btn_link ) ); ?>" class="wl-btn wl-btn--outline"><?php echo esc_html( $brand_btn_text ); ?></a>
    </div>
</section>

<!-- 5. Product Feature Banner -->
<section class="wl-product-feature">
    <div class="wl-product-feature__inner">
        <div class="wl-product-feature__content">
            <p class="wl-overline"><?php echo esc_html( $feature_overline ); ?></p>
            <h2 class="wl-section-title"><?php echo esc_html( $feature_title ); ?></h2>
            <p><?php echo esc_html( $feature_text ); ?></p>
            <a href="<?php echo esc_url( home_url( $feature_btn_link ) ); ?>" class="wl-btn wl-btn--primary"><?php echo esc_html( $feature_btn_text ); ?></a>
        </div>
        <div class="wl-product-feature__image-wrapper">
            <img src="<?php echo esc_url( $feature_img ); ?>" alt="<?php echo esc_attr( $feature_title ); ?>" class="wl-product-feature__image">
        </div>
    </div>
</section>

<!-- 6. Why Choose Us -->
<section class="wl-why-us">
    <div class="wl-container">
        <div class="wl-why-us__grid">
            <div class="wl-icon-box">
                <div class="wl-icon-box__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l2.2 4.6L19 8.2l-3.5 3.4.8 4.9L12 14.8 7.7 16.5l.8-4.9L5 8.2l4.8-.6L12 3z"/></svg>
                </div>
                <h4 class="wl-icon-box__title">QUALITY FIRST</h4>
                <p class="wl-icon-box__desc">Premium materials that stand the test of time.</p>
            </div>
            <div class="wl-icon-box">
                <div class="wl-icon-box__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 7h16v13H4z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg>
                </div>
                <h4 class="wl-icon-box__title">MODERN FITS</h4>
                <p class="wl-icon-box__desc">Silhouettes designed for contemporary style.</p>
            </div>
            <div class="wl-icon-box">
                <div class="wl-icon-box__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="8"/><path d="M12 8v4l3 2"/></svg>
                </div>
                <h4 class="wl-icon-box__title">EVERYDAY WEAR</h4>
                <p class="wl-icon-box__desc">Versatile pieces for any occasion.</p>
            </div>
            <div class="wl-icon-box">
                <div class="wl-icon-box__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s7-4.4 7-10a7 7 0 1 0-14 0c0 5.6 7 10 7 10z"/><circle cx="12" cy="11" r="2.2"/></svg>
                </div>
                <h4 class="wl-icon-box__title">DESIGNED IN PAKISTAN</h4>
                <p class="wl-icon-box__desc">Proudly crafted by local artisans.</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. Social Media & Streetwear Community Showcase -->
<?php
$social_bg       = get_theme_mod( 'wearlab_social_bg_img', '' ) ?: $theme_uri . '/assets/images/p2 pic3.jpeg';
$social_overline = get_theme_mod( 'wearlab_social_overline', 'COMMUNITY & STREET CULTURE' );
$social_title    = get_theme_mod( 'wearlab_social_title', 'FOLLOW THE LAB.' );
$social_subtitle = get_theme_mod( 'wearlab_social_subtitle', 'Tag @wearlab_official to be featured in upcoming drops.' );
$ig_url          = get_theme_mod( 'wearlab_social_instagram', 'https://instagram.com/wearlab_official' );
$tt_url          = get_theme_mod( 'wearlab_social_tiktok', 'https://www.tiktok.com/@wearlab' );
$wa_num          = get_theme_mod( 'wearlab_social_whatsapp', '923001234567' );
$wa_link         = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_num ) . '?text=' . rawurlencode( 'Hi WEARLAB! I want to join the WhatsApp drop alerts.' );

$social_photos = array(
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_1', '' ) ?: $theme_uri . '/assets/images/p1 pic1.jpeg',
		'title' => 'Drop Shoulder Vibes Tee',
		'tag'   => '#VIBES',
		'alt'   => 'WEARLAB Vibes Drop Shoulder Tee - Back Graphic Artwork',
	),
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_2', '' ) ?: $theme_uri . '/assets/images/p2 pic1.jpeg',
		'title' => 'Drop Shoulder Retro Tee',
		'tag'   => '#RETRO',
		'alt'   => 'WEARLAB Retro Drop Shoulder Tee - Back Floral Artwork',
	),
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_3', '' ) ?: $theme_uri . '/assets/images/p1 pic2.jpeg',
		'title' => 'Good Vibes Only Fit',
		'tag'   => '#STREETWEAR',
		'alt'   => 'WEARLAB Good Vibes Only Front Graphic',
	),
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_4', '' ) ?: $theme_uri . '/assets/images/p2 pic3.jpeg',
		'title' => 'Quietly Bold Campaign',
		'tag'   => '#QUIETLYBOLD',
		'alt'   => 'WEARLAB Quietly Bold Campaign Poster',
	),
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_5', '' ) ?: $theme_uri . '/assets/images/p2 pic2.jpeg',
		'title' => 'SSTZZ Retro Fit',
		'tag'   => '#WEARLABFIT',
		'alt'   => 'WEARLAB SSTZZ Retro Streetwear Tee Front',
	),
	array(
		'img'   => get_theme_mod( 'wearlab_social_img_6', '' ) ?: $theme_uri . '/assets/images/p1 pic3.jpeg',
		'title' => 'Desert Sand Silhouette',
		'tag'   => '#LABDROP',
		'alt'   => 'WEARLAB Vibes Oversized Tee Desert Sand Mockup',
	),
);
?>
<section class="wl-instagram wl-social-showcase" style="background-image: url('<?php echo esc_url( $social_bg ); ?>');">
    <div class="wl-social-showcase__overlay-bg" aria-hidden="true"></div>
    <div class="wl-container">
        <div class="wl-instagram__header">
            <?php if ( ! empty( $social_overline ) ) : ?>
                <span class="wl-social-showcase__overline"><?php echo esc_html( $social_overline ); ?></span>
            <?php endif; ?>
            <h2 class="wl-section-title wl-social-showcase__title"><?php echo esc_html( $social_title ); ?></h2>
            <?php if ( ! empty( $social_subtitle ) ) : ?>
                <p class="wl-social-showcase__subtitle"><?php echo esc_html( $social_subtitle ); ?></p>
            <?php endif; ?>

            <div class="wl-social-pills-wrap">
                <?php if ( ! empty( $ig_url ) ) : ?>
                <a href="<?php echo esc_url( $ig_url ); ?>" class="wl-social-pill wl-social-pill--ig" target="_blank" rel="noopener" aria-label="Follow WEARLAB on Instagram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor" stroke="none"/></svg>
                    <span>@WEARLAB_OFFICIAL</span>
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $tt_url ) ) : ?>
                <a href="<?php echo esc_url( $tt_url ); ?>" class="wl-social-pill wl-social-pill--tt" target="_blank" rel="noopener" aria-label="Follow WEARLAB on TikTok">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.89 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.35 0 .68.06.98.17v-3.52a6.34 6.34 0 0 0-.98-.08 6.34 6.34 0 0 0-6.34 6.32 6.34 6.34 0 0 0 6.34 6.33 6.34 6.34 0 0 0 6.33-6.33V9.17a8.28 8.28 0 0 0 4.77 1.48V7.19c-.35 0-.7-.17-1-.5z"/></svg>
                    <span>TikTok</span>
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $wa_link ) ) : ?>
                <a href="<?php echo esc_url( $wa_link ); ?>" class="wl-social-pill wl-social-pill--wa" target="_blank" rel="noopener" aria-label="Join WEARLAB WhatsApp Drop Alerts">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    <span>WhatsApp VIP Alerts</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="wl-instagram__grid">
        <?php foreach ( $social_photos as $photo ) : ?>
        <a href="<?php echo esc_url( $ig_url ); ?>" class="wl-instagram__item" target="_blank" rel="noopener" title="<?php echo esc_attr( $photo['title'] ); ?>">
            <img src="<?php echo esc_url( $photo['img'] ); ?>" alt="<?php echo esc_attr( $photo['alt'] ); ?>" loading="lazy">
            <span class="wl-instagram__overlay">
                <span class="wl-instagram__overlay-tag"><?php echo esc_html( $photo['tag'] ); ?></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                <span class="wl-instagram__overlay-label"><?php echo esc_html( $photo['title'] ); ?></span>
            </span>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="wl-social-showcase__ticker">
        <div class="wl-social-showcase__ticker-inner">
            <span>STREETWEAR CULTURE</span>
            <span class="wl-dot">•</span>
            <span>100+ STREETWEAR FITS</span>
            <span class="wl-dot">•</span>
            <span>CASH ON DELIVERY NATIONWIDE</span>
            <span class="wl-dot">•</span>
            <span>FREE DELIVERY ON 3+ SHIRTS</span>
            <span class="wl-dot">•</span>
            <span>DESIGNED IN PAKISTAN</span>
            <span class="wl-dot">•</span>
            <span>WEARLAB.STORE</span>
        </div>
    </div>
</section>

<!-- 8. Customer Reviews -->
<section class="wl-reviews">
    <div class="wl-container">
        <div class="wl-reviews__header">
            <p class="wl-overline"><?php echo esc_html( $reviews_overline ); ?></p>
            <h2 class="wl-section-title"><?php echo esc_html( $reviews_title ); ?></h2>
            <p class="wl-section-desc"><?php echo esc_html( $reviews_desc ); ?></p>
        </div>
        <div class="wl-reviews__grid">
            <?php
            $reviews = array( $review_1, $review_2, $review_3 );
            foreach ( $reviews as $rev ) :
            ?>
            <article class="wl-review-card">
                <div class="wl-review-card__stars" aria-label="5 stars">★★★★★</div>
                <p class="wl-review-card__text"><?php echo esc_html( $rev['text'] ); ?></p>
                <div class="wl-review-card__footer">
                    <span class="wl-review-card__avatar"><?php echo esc_html( $rev['initials'] ); ?></span>
                    <div class="wl-review-card__meta">
                        <p class="wl-review-card__author">
                            <?php echo esc_html( $rev['author'] ); ?>
                            <span class="wl-review-card__verified">Verified</span>
                        </p>
                        <span class="wl-review-card__city"><?php echo esc_html( $rev['city'] ); ?>, Pakistan</span>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 9. Newsletter Section -->
<section class="wl-newsletter">
    <div class="wl-container wl-container--narrow wl-text-center">
        <h2 class="wl-section-title"><?php echo esc_html( $newsletter_heading ); ?></h2>
        <p class="wl-newsletter__desc"><?php echo esc_html( $newsletter_desc ); ?></p>
        <form class="wl-newsletter-form wl-newsletter-form--large">
            <input type="email" class="wl-newsletter-form__input" placeholder="Enter your email" required>
            <button type="submit" class="wl-btn wl-btn--primary">SUBSCRIBE</button>
        </form>
    </div>
</section>

<!-- 10. Final Call to Action -->
<section class="wl-final-cta">
    <div class="wl-container wl-text-center">
        <h2 class="wl-section-title"><?php echo esc_html( $cta_heading ); ?></h2>
        <p class="wl-final-cta__desc"><?php echo esc_html( $cta_desc ); ?></p>
        <a href="<?php echo esc_url( home_url( $cta_btn_link ) ); ?>" class="wl-btn wl-btn--primary"><?php echo esc_html( $cta_btn_text ); ?></a>
    </div>
</section>

<?php get_footer(); ?>
