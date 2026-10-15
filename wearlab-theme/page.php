<?php
/**
 * The template for displaying all generic WordPress pages
 * Location: page.php
 */

// 1. Intercept WooCommerce Shop Page, New Arrivals, or Product Archive
if ( ( function_exists( 'is_shop' ) && is_shop() ) || is_post_type_archive( 'product' ) || is_page( 'shop' ) || is_page( 'new-arrivals' ) ) {
    if ( is_page( 'new-arrivals' ) ) {
        $_GET['filter']  = 'new-arrivals';
        $_GET['orderby'] = 'date';
    }
    include get_template_directory() . '/archive-product.php';
    return;
}

// 2. Intercept WooCommerce My Account Page (any slug: my-account, my-account-2, etc.)
if ( ( function_exists( 'is_account_page' ) && is_account_page() ) || is_page( 'my-account' ) || is_page( 'my-account-2' ) || is_page( 21 ) ) {
    include get_template_directory() . '/page-my-account.php';
    return;
}

// 3. Intercept WooCommerce Checkout Page
if ( ( function_exists( 'is_checkout' ) && is_checkout() ) || is_page( 'checkout' ) ) {
    include get_template_directory() . '/page-checkout.php';
    return;
}

// 4. Intercept WooCommerce Cart Page
if ( ( function_exists( 'is_cart' ) && is_cart() ) || is_page( 'cart' ) ) {
    get_header();
    if ( file_exists( get_template_directory() . '/woocommerce/cart/cart.php' ) ) {
        include get_template_directory() . '/woocommerce/cart/cart.php';
        get_footer();
        return;
    }
}

// 5. Intercept Support & Policy Pages (Guarantees custom template loads regardless of page attributes)
if ( is_page( 'contact' ) || is_page( 'contact-us' ) ) {
    include get_template_directory() . '/page-contact.php';
    return;
}
if ( is_page( 'returns-policy' ) || is_page( 'exchange-return-policy' ) || is_page( 'return-policy' ) ) {
    include get_template_directory() . '/page-returns-policy.php';
    return;
}
if ( is_page( 'shipping-policy' ) ) {
    include get_template_directory() . '/page-shipping-policy.php';
    return;
}
if ( is_page( 'payment-policy' ) ) {
    include get_template_directory() . '/page-payment-policy.php';
    return;
}
if ( is_page( 'privacy-policy' ) ) {
    include get_template_directory() . '/page-privacy-policy.php';
    return;
}
if ( is_page( 'terms-conditions' ) || is_page( 'terms-and-conditions' ) ) {
    include get_template_directory() . '/page-terms-conditions.php';
    return;
}
if ( is_page( 'about' ) || is_page( 'about-us' ) ) {
    include get_template_directory() . '/page-about.php';
    return;
}
if ( is_page( 'faq' ) || is_page( 'faqs' ) ) {
    include get_template_directory() . '/page-faq.php';
    return;
}

get_header();
?>

<div class="wl-default-page-wrapper">
    <div class="wl-default-page-hero">
        <div class="wl-container">
            <span class="wl-page-badge"><?php bloginfo( 'name' ); ?></span>
            <h1 class="wl-page-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="wl-container wl-default-page-container">
        <div class="wl-default-page-card">
            <div class="wl-page-content">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
