<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
    <!-- Preconnect to external resource domains for instant loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <?php
    if ( is_front_page() || is_home() ) :
        $custom_hero = get_theme_mod( 'wearlab_hero_image', '' );
        $hero_preload_url = ! empty( $custom_hero ) ? $custom_hero : get_template_directory_uri() . '/assets/images/hero-banner.jpg';
    ?>
    <!-- Preload Hero Banner for fast LCP -->
    <link rel="preload" as="image" href="<?php echo esc_url( $hero_preload_url ); ?>" fetchpriority="high">
    <?php endif; ?>

    <!-- Critical Brand Preloader Styles (Zero FOUC on slow networks) -->
    <style id="wl-preloader-critical">
        #wl-preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #ffffff;
            z-index: 99999999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: auto;
        }
        #wl-preloader.is-loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .wl-preloader__brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .wl-preloader__logo-text {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 26px;
            font-weight: 900;
            letter-spacing: 0.22em;
            color: #111111;
            text-transform: uppercase;
            animation: wlPreloadPulse 1.6s ease-in-out infinite;
        }
        .wl-preloader__logo-img {
            max-width: 150px;
            max-height: 52px;
            height: auto;
            width: auto;
            object-fit: contain;
            animation: wlPreloadPulse 1.6s ease-in-out infinite;
        }
        .wl-preloader__track {
            width: 52px;
            height: 2px;
            background: #f0f0f0;
            border-radius: 2px;
            margin-top: 18px;
            position: relative;
            overflow: hidden;
        }
        .wl-preloader__bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: #111111;
            transform: translateX(-100%);
            animation: wlPreloadSlide 1.2s cubic-bezier(0.65, 0, 0.35, 1) infinite;
        }
        .wl-preloader__caption {
            margin-top: 10px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #888888;
        }
        @keyframes wlPreloadPulse {
            0%, 100% { opacity: 0.45; transform: scale(0.98); }
            50% { opacity: 1; transform: scale(1); }
        }
        @keyframes wlPreloadSlide {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(0); }
            100% { transform: translateX(100%); }
        }
        @media (prefers-reduced-motion: reduce) {
            .wl-preloader__logo-text, .wl-preloader__logo-img, .wl-preloader__bar {
                animation: none;
            }
        }
    </style>
    <noscript>
        <style>#wl-preloader { display: none !important; }</style>
    </noscript>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Brand Preloader (Guarantees zero unstyled HTML on slow internet) -->
<div id="wl-preloader" aria-hidden="true">
    <div class="wl-preloader__brand">
        <?php
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo_data = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id, 'medium' ) : false;
        if ( $logo_data ) :
        ?>
            <img src="<?php echo esc_url( $logo_data[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="wl-preloader__logo-img">
        <?php else : ?>
            <span class="wl-preloader__logo-text">WEARLAB</span>
        <?php endif; ?>
        <div class="wl-preloader__track">
            <div class="wl-preloader__bar"></div>
        </div>
        <span class="wl-preloader__caption">Modern Streetwear</span>
    </div>
</div>

<?php if ( get_theme_mod( 'wearlab_announcement_enable', true ) ) : ?>
<!-- Top Announcement / Marquee Bar like KhushPosh -->
<div class="wl-topbar">
    <div class="wl-topbar__marquee">
        <div class="wl-topbar__track">
            <?php for ( $i = 0; $i < 3; $i++ ) : ?>
                <div class="wl-topbar__item">
                    <svg class="wl-topbar__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>FREE SHIPPING NATIONWIDE</span>
                </div>
                <div class="wl-topbar__divider"></div>
                <div class="wl-topbar__item">
                    <svg class="wl-topbar__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    <span>100+ STREETWEAR FITS</span>
                </div>
                <div class="wl-topbar__divider"></div>
                <div class="wl-topbar__item">
                    <svg class="wl-topbar__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    <span>CASH ON DELIVERY (COD) AVAILABLE NATIONWIDE</span>
                </div>
                <div class="wl-topbar__divider"></div>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<header class="wl-header">
    <div class="wl-header__inner">
        <!-- Left: Mobile Menu Toggle -->
        <button class="wl-mobile-toggle" aria-label="Toggle Menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <!-- Brand Logo (New WEARLAB Mark + Name) -->
        <div class="wl-logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wl-logo__link" title="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-horizontal.png' ); ?>" 
                         alt="<?php bloginfo( 'name' ); ?>" 
                         class="wl-logo__img">
                </a>
            <?php endif; ?>
        </div>

        <!-- Center: Primary Navigation (KhushPosh Style) -->
        <nav class="wl-nav" aria-label="Main Navigation">
            <ul class="wl-nav__list">
                <li class="wl-nav__item"><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-nav__link">Shop All</a></li>
                <li class="wl-nav__item"><a href="<?php echo esc_url( home_url( '/product-category/new-arrivals/' ) ); ?>" class="wl-nav__link">New Arrivals</a></li>
                <li class="wl-nav__item wl-has-dropdown menu-item-has-children">
                    <a href="<?php echo esc_url( home_url( '/product-category/men/' ) ); ?>" class="wl-nav__link">
                        Men
                        <svg class="wl-icon-dropdown" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <ul class="wl-nav__dropdown">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/men/' ) ); ?>" class="wl-nav__link">All Men</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>" class="wl-nav__link">Drop Shoulders</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>" class="wl-nav__link">Polos</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>" class="wl-nav__link">T-Shirts</a></li>
                    </ul>
                </li>
                <li class="wl-nav__item wl-has-dropdown menu-item-has-children">
                    <a href="<?php echo esc_url( home_url( '/product-category/women/' ) ); ?>" class="wl-nav__link">
                        Women
                        <svg class="wl-icon-dropdown" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <ul class="wl-nav__dropdown">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/women/' ) ); ?>" class="wl-nav__link">All Women</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>" class="wl-nav__link">Oversized Fits</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>" class="wl-nav__link">Graphic Tees</a></li>
                    </ul>
                </li>
                <li class="wl-nav__item wl-has-dropdown menu-item-has-children">
                    <a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>" class="wl-nav__link">
                        Drop Shoulders
                        <svg class="wl-icon-dropdown" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <ul class="wl-nav__dropdown">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>" class="wl-nav__link">All Drop Shoulders</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/oversized/' ) ); ?>" class="wl-nav__link">Oversized Fits</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/retro/' ) ); ?>" class="wl-nav__link">Retro Series</a></li>
                    </ul>
                </li>
                <li class="wl-nav__item wl-has-dropdown menu-item-has-children">
                    <a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>" class="wl-nav__link">
                        Polos
                        <svg class="wl-icon-dropdown" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <ul class="wl-nav__dropdown">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>" class="wl-nav__link">All Polos</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/classic-polos/' ) ); ?>" class="wl-nav__link">Classic Polos</a></li>
                    </ul>
                </li>
                <li class="wl-nav__item wl-has-dropdown menu-item-has-children">
                    <a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>" class="wl-nav__link">
                        T-Shirts
                        <svg class="wl-icon-dropdown" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <ul class="wl-nav__dropdown">
                        <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>" class="wl-nav__link">All T-Shirts</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/product-category/graphic-tees/' ) ); ?>" class="wl-nav__link">Graphic Tees</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Right Side: Region Selector, Search, Account, Cart like KhushPosh -->
        <div class="wl-header__icons">

            <!-- Search Trigger -->
            <button class="wl-header__icon wl-search-trigger" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>

            <!-- User Account -->
            <?php
            $account_url = class_exists( 'WooCommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : home_url( '/my-account/' );
            $cart_url    = class_exists( 'WooCommerce' ) ? wc_get_cart_url() : home_url( '/cart/' );
            $cart_count  = ( class_exists( 'WooCommerce' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
            ?>
            <a href="<?php echo esc_url( $account_url ); ?>" class="wl-header__icon" aria-label="Account">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>

            <!-- Cart Icon (Minimal Tote Bag like KhushPosh) -->
            <a href="<?php echo esc_url( $cart_url ); ?>" class="wl-header__icon wl-header__cart" aria-label="Cart">
                <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <span class="wl-cart-count"><?php echo esc_html( $cart_count ); ?></span>
            </a>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer Backdrop -->
<div class="wl-mobile-menu-backdrop" data-close-menu></div>

<!-- Mobile Navigation Drawer -->
<div class="wl-mobile-menu">
    <div class="wl-mobile-menu__inner">
        <div class="wl-mobile-menu__header">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="wl-logo__link" title="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-horizontal.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:32px; width:auto; object-fit:contain;">
                </a>
            <?php endif; ?>
            <button class="wl-mobile-menu__close" aria-label="Close Menu">&times;</button>
        </div>
        
        <ul class="wl-mobile-menu__nav">
            <li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="wl-mobile-nav__link">Shop All</a></li>
            <li><a href="<?php echo esc_url( home_url( '/product-category/new-arrivals/' ) ); ?>" class="wl-mobile-nav__link">New Arrivals</a></li>
            
            <li class="wl-mobile-nav__item has-submenu">
                <div class="wl-mobile-nav__row">
                    <a href="<?php echo esc_url( home_url( '/product-category/men/' ) ); ?>" class="wl-mobile-nav__link">Men</a>
                    <button type="button" class="wl-mobile-nav__toggle" aria-label="Toggle Men Submenu">
                        <svg class="wl-mobile-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
                <ul class="wl-mobile-nav__submenu">
                    <li><a href="<?php echo esc_url( home_url( '/product-category/men/' ) ); ?>">All Men</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>">Drop Shoulders</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>">Polos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>">T-Shirts</a></li>
                </ul>
            </li>

            <li class="wl-mobile-nav__item has-submenu">
                <div class="wl-mobile-nav__row">
                    <a href="<?php echo esc_url( home_url( '/product-category/women/' ) ); ?>" class="wl-mobile-nav__link">Women</a>
                    <button type="button" class="wl-mobile-nav__toggle" aria-label="Toggle Women Submenu">
                        <svg class="wl-mobile-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
                <ul class="wl-mobile-nav__submenu">
                    <li><a href="<?php echo esc_url( home_url( '/product-category/women/' ) ); ?>">All Women</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>">Oversized Fits</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>">Graphic Tees</a></li>
                </ul>
            </li>

            <li class="wl-mobile-nav__item has-submenu">
                <div class="wl-mobile-nav__row">
                    <a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>" class="wl-mobile-nav__link">Drop Shoulders</a>
                    <button type="button" class="wl-mobile-nav__toggle" aria-label="Toggle Drop Shoulders Submenu">
                        <svg class="wl-mobile-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
                <ul class="wl-mobile-nav__submenu">
                    <li><a href="<?php echo esc_url( home_url( '/product-category/drop-shoulders/' ) ); ?>">All Drop Shoulders</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/oversized/' ) ); ?>">Oversized Fits</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/retro/' ) ); ?>">Retro Series</a></li>
                </ul>
            </li>

            <li class="wl-mobile-nav__item has-submenu">
                <div class="wl-mobile-nav__row">
                    <a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>" class="wl-mobile-nav__link">Polos</a>
                    <button type="button" class="wl-mobile-nav__toggle" aria-label="Toggle Polos Submenu">
                        <svg class="wl-mobile-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
                <ul class="wl-mobile-nav__submenu">
                    <li><a href="<?php echo esc_url( home_url( '/product-category/polos/' ) ); ?>">All Polos</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/classic-polos/' ) ); ?>">Classic Polos</a></li>
                </ul>
            </li>

            <li class="wl-mobile-nav__item has-submenu">
                <div class="wl-mobile-nav__row">
                    <a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>" class="wl-mobile-nav__link">T-Shirts</a>
                    <button type="button" class="wl-mobile-nav__toggle" aria-label="Toggle T-Shirts Submenu">
                        <svg class="wl-mobile-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
                <ul class="wl-mobile-nav__submenu">
                    <li><a href="<?php echo esc_url( home_url( '/product-category/t-shirts/' ) ); ?>">All T-Shirts</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/product-category/graphic-tees/' ) ); ?>">Graphic Tees</a></li>
                </ul>
            </li>

            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="wl-mobile-nav__link">About WEARLAB</a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="wl-mobile-nav__link">Contact</a></li>
            <li><a href="<?php echo esc_url( home_url( '/track-order/' ) ); ?>" class="wl-mobile-nav__link">Track Order</a></li>
        </ul>
        
        <div class="wl-mobile-menu__footer">
            <?php
            $account_url = class_exists( 'WooCommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : home_url( '/my-account/' );
            ?>
            <a href="<?php echo esc_url( $account_url ); ?>" class="wl-mobile-menu__account">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>My Account / Log In</span>
            </a>
        </div>
    </div>
</div>

<!-- Search Overlay (KhushPosh Style) -->
<div class="wl-search-overlay">
    <button class="wl-search-overlay__close" aria-label="Close Search">&times;</button>
    <div class="wl-search-overlay__inner">
        <p class="wl-search-overlay__heading">SEARCH OUR STORE</p>
        <?php get_search_form(); ?>
        <div class="wl-search-quick-tags">
            <a href="<?php echo esc_url( home_url( '/?s=drop+shoulder&post_type=product' ) ); ?>" class="wl-search-quick-tag">Drop Shoulder</a>
            <a href="<?php echo esc_url( home_url( '/?s=polo&post_type=product' ) ); ?>" class="wl-search-quick-tag">Polo</a>
            <a href="<?php echo esc_url( home_url( '/?s=oversized&post_type=product' ) ); ?>" class="wl-search-quick-tag">Oversized</a>
            <a href="<?php echo esc_url( home_url( '/?s=tee&post_type=product' ) ); ?>" class="wl-search-quick-tag">Graphic Tees</a>
        </div>
    </div>
</div>

<!-- KhushPosh Style Side Cart Drawer -->
<div class="wl-cart-drawer" id="wlCartDrawer" aria-hidden="true">
    <div class="wl-cart-drawer__backdrop" data-close-cart></div>
    <div class="wl-cart-drawer__panel">
        <div class="wl-cart-drawer__header">
            <h2 class="wl-cart-drawer__title">Your cart</h2>
            <button type="button" class="wl-cart-drawer__close" data-close-cart aria-label="Close cart">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="wl-cart-drawer__content" id="wlCartDrawerContent">
            <?php
            if ( file_exists( get_template_directory() . '/woocommerce/cart/mini-cart.php' ) ) {
                include get_template_directory() . '/woocommerce/cart/mini-cart.php';
            }
            ?>
        </div>
    </div>
</div>

<main id="main" class="wl-site-main">
