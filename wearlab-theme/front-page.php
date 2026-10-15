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

// 3. Shop by Fit Settings
$fit_overline = get_theme_mod( 'wearlab_fit_overline', 'DENIM & STREETWEAR' );
$fit_title    = get_theme_mod( 'wearlab_fit_title', 'Shop by Fit' );

$fit_1_name  = get_theme_mod( 'wearlab_fit_1_name', 'Wide Leg' );
$fit_1_price = get_theme_mod( 'wearlab_fit_1_price', 'Rs.3,995.00 PKR' );
$fit_1_link  = get_theme_mod( 'wearlab_fit_1_link', '/shop/?filter_fit=wide-leg' );
$fit_1_img   = get_theme_mod( 'wearlab_fit_1_img', '' ) ?: $theme_uri . '/assets/images/fit-card-1.jpg';

$fit_2_name  = get_theme_mod( 'wearlab_fit_2_name', 'Straight Leg' );
$fit_2_price = get_theme_mod( 'wearlab_fit_2_price', 'Rs.3,995.00 PKR' );
$fit_2_link  = get_theme_mod( 'wearlab_fit_2_link', '/shop/?filter_fit=straight-leg' );
$fit_2_img   = get_theme_mod( 'wearlab_fit_2_img', '' ) ?: $theme_uri . '/assets/images/fit-card-2.jpg';

$fit_3_name  = get_theme_mod( 'wearlab_fit_3_name', 'Bootcut' );
$fit_3_price = get_theme_mod( 'wearlab_fit_3_price', 'Rs.3,995.00 PKR' );
$fit_3_link  = get_theme_mod( 'wearlab_fit_3_link', '/shop/?filter_fit=bootcut' );
$fit_3_img   = get_theme_mod( 'wearlab_fit_3_img', '' ) ?: $theme_uri . '/assets/images/fit-card-3.jpg';

$fit_4_name  = get_theme_mod( 'wearlab_fit_4_name', 'Wide Leg Low Rise' );
$fit_4_price = get_theme_mod( 'wearlab_fit_4_price', 'Rs.3,995.00 PKR' );
$fit_4_link  = get_theme_mod( 'wearlab_fit_4_link', '/shop/?filter_fit=wide-leg-low-rise' );
$fit_4_img   = get_theme_mod( 'wearlab_fit_4_img', '' ) ?: $theme_uri . '/assets/images/fit-card-4.jpg';

// 4. Brand Statement Settings
$brand_overline = get_theme_mod( 'wearlab_brand_overline', 'THE WEARLAB STANDARD' );
$brand_title    = get_theme_mod( 'wearlab_brand_title', 'LESS NOISE. MORE STYLE.' );
$brand_text     = get_theme_mod( 'wearlab_brand_text', 'We believe in creating high-quality, modern streetwear that speaks for itself. No loud logos, no fast fashion compromises. Just premium fabrics, thoughtful cuts, and designs made for your everyday life.' );
$brand_btn_text = get_theme_mod( 'wearlab_brand_btn_text', 'OUR STORY' );
$brand_btn_link = get_theme_mod( 'wearlab_brand_btn_link', '/about/' );

// 5. Collection Banner Settings
$feature_overline = get_theme_mod( 'wearlab_feature_overline', 'THE COLLECTION' );
$feature_title    = get_theme_mod( 'wearlab_feature_title', 'QUIETLY BOLD.' );
$feature_text     = get_theme_mod( 'wearlab_feature_text', 'Engineered for the modern wardrobe, our pieces combine minimalist aesthetics with superior craftsmanship.' );
$feature_btn_text = get_theme_mod( 'wearlab_feature_btn_text', 'SHOP WEARLAB' );
$feature_btn_link = get_theme_mod( 'wearlab_feature_btn_link', '/shop/' );
$feature_img      = get_theme_mod( 'wearlab_feature_img', '' ) ?: $theme_uri . '/assets/images/cat-drop-shoulders.jpg';

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
                        'img'   => $theme_uri . '/assets/images/product-placeholder-1.jpg',
                    ),
                    array(
                        'name'  => 'Drop Shoulder Vibes',
                        'price' => 'PKR 1,800',
                        'badge' => 'BEST SELLER',
                        'sizes' => array( 'S', 'M', 'L', 'XL' ),
                        'link'  => '/product-category/drop-shoulders/',
                        'img'   => $theme_uri . '/assets/images/product-placeholder-2.jpg',
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

<!-- 3. Shop by Fit Section -->
<section class="wl-shop-by-fit">
    <div class="wl-container">
        <div class="wl-shop-by-fit__header">
            <span class="wl-shop-by-fit__overline"><?php echo esc_html( $fit_overline ); ?></span>
            <h2 class="wl-shop-by-fit__title"><?php echo esc_html( $fit_title ); ?></h2>
        </div>

        <div class="wl-fit-grid">
            <!-- Fit 1 -->
            <a href="<?php echo esc_url( home_url( $fit_1_link ) ); ?>" class="wl-fit-card">
                <div class="wl-fit-card__image-wrap">
                    <span class="wl-fit-card__badge">#1 BEST SELLER</span>
                    <img src="<?php echo esc_url( $fit_1_img ); ?>" alt="<?php echo esc_attr( $fit_1_name ); ?>" class="wl-fit-card__img">
                </div>
                <div class="wl-fit-card__meta">
                    <h3 class="wl-fit-card__name"><?php echo esc_html( $fit_1_name ); ?></h3>
                    <p class="wl-fit-card__price"><?php echo esc_html( $fit_1_price ); ?></p>
                    <span class="wl-fit-card__tag">BEST SELLER</span>
                </div>
            </a>

            <!-- Fit 2 -->
            <a href="<?php echo esc_url( home_url( $fit_2_link ) ); ?>" class="wl-fit-card">
                <div class="wl-fit-card__image-wrap">
                    <img src="<?php echo esc_url( $fit_2_img ); ?>" alt="<?php echo esc_attr( $fit_2_name ); ?>" class="wl-fit-card__img">
                </div>
                <div class="wl-fit-card__meta">
                    <h3 class="wl-fit-card__name"><?php echo esc_html( $fit_2_name ); ?></h3>
                    <p class="wl-fit-card__price"><?php echo esc_html( $fit_2_price ); ?></p>
                </div>
            </a>

            <!-- Fit 3 -->
            <a href="<?php echo esc_url( home_url( $fit_3_link ) ); ?>" class="wl-fit-card wl-fit-card--active">
                <div class="wl-fit-card__image-wrap">
                    <img src="<?php echo esc_url( $fit_3_img ); ?>" alt="<?php echo esc_attr( $fit_3_name ); ?>" class="wl-fit-card__img">
                </div>
                <div class="wl-fit-card__meta">
                    <h3 class="wl-fit-card__name"><?php echo esc_html( $fit_3_name ); ?></h3>
                    <p class="wl-fit-card__price"><?php echo esc_html( $fit_3_price ); ?></p>
                </div>
            </a>

            <!-- Fit 4 -->
            <a href="<?php echo esc_url( home_url( $fit_4_link ) ); ?>" class="wl-fit-card">
                <div class="wl-fit-card__image-wrap">
                    <img src="<?php echo esc_url( $fit_4_img ); ?>" alt="<?php echo esc_attr( $fit_4_name ); ?>" class="wl-fit-card__img">
                </div>
                <div class="wl-fit-card__meta">
                    <h3 class="wl-fit-card__name"><?php echo esc_html( $fit_4_name ); ?></h3>
                    <p class="wl-fit-card__price"><?php echo esc_html( $fit_4_price ); ?></p>
                </div>
            </a>
        </div>

        <div class="wl-shop-by-fit__action">
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-btn-dark">VIEW ALL FITS</a>
        </div>
    </div>
</section>

<!-- 4. Brand Statement Section -->
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

<!-- 7. Instagram Showcase -->
<section class="wl-instagram">
    <div class="wl-container">
        <div class="wl-instagram__header">
            <h2 class="wl-section-title">FOLLOW THE LAB.</h2>
            <?php
            $ig_url = get_theme_mod( 'wearlab_social_instagram', 'https://instagram.com/wearlab_official' );
            ?>
            <a href="<?php echo esc_url( $ig_url ); ?>" class="wl-instagram__handle" target="_blank" rel="noopener">@WEARLAB_OFFICIAL</a>
        </div>
    </div>
    <div class="wl-instagram__grid">
        <?php
        $ig_images = array(
            'product-placeholder-1.jpg',
            'product-placeholder-2.jpg',
            'product-placeholder-3.jpg',
            'product-placeholder-4.jpg',
            'fit-card-1.jpg',
            'fit-card-3.jpg',
        );
        foreach ( $ig_images as $ig ) :
        ?>
        <a href="<?php echo esc_url( $ig_url ); ?>" class="wl-instagram__item" target="_blank" rel="noopener">
            <img src="<?php echo esc_url( $theme_uri . '/assets/images/' . $ig ); ?>" alt="WEARLAB Instagram">
            <span class="wl-instagram__overlay">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
            </span>
        </a>
        <?php endforeach; ?>
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
