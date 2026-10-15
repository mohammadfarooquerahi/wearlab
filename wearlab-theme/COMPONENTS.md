# WEARLAB — Components Registry

> Update this file every time you add or modify a component.  
> Check this before modifying any shared CSS class or template part.

| Component | File(s) | CSS Classes | Dependencies | Status |
|-----------|---------|-------------|--------------|--------|
| Announcement Bar | `header.php`, `style.css` | `.wl-announcement` | Customizer `wl_announcement_text` | ✅ Done |
| Sticky Header | `header.php`, `style.css`, `main.js` | `.wl-header`, `.wl-header--scrolled`, `.wl-header__inner`, `.wl-logo`, `.wl-header__icons` | Nav Walker, WooCommerce cart count | ✅ Done |
| Navigation | `header.php`, `style.css` | `.wl-nav`, `.wl-nav__menu`, `.wl-nav-link`, `.wl-icon-dropdown` | `Wearlab_Nav_Walker`, `primary` nav menu | ✅ Done |
| Mobile Menu | `header.php`, `style.css`, `main.js` | `.wl-mobile-toggle`, `.wl-mobile-menu`, `.wl-mobile-menu--open`, `.wl-mobile-menu__close` | — | ✅ Done |
| Search Overlay | `header.php`, `searchform.php`, `style.css`, `main.js` | `.wl-search-overlay`, `.wl-search-overlay--open`, `.wl-search-icon` | `get_search_form()` | ✅ Done |
| Hero Section | `front-page.php`, `style.css` | `.wl-hero`, `.wl-hero__bg`, `.wl-hero__content`, `.wl-hero__title`, `.wl-hero__actions` | — | ✅ Done |
| Featured Collection | `front-page.php`, `style.css` | `.wl-featured`, `.wl-products-grid`, `.wl-overline`, `.wl-section-title` | WP_Query, dummy products fallback | ✅ Done |
| Shop by Category | `front-page.php`, `style.css` | `.wl-categories`, `.wl-cat-grid`, `.wl-cat-card` | — | ✅ Done |
| Reviews Section | `front-page.php`, `style.css` | `.wl-reviews`, `.wl-reviews__grid`, `.wl-review-card`, `.wl-review-card__stars` | Dummy reviews | ✅ Done |
| Brand Statement | `front-page.php`, `style.css` | `.wl-brand-statement`, `.wl-container--narrow` | — | ✅ Done |
| Product Feature | `front-page.php`, `style.css` | `.wl-product-feature`, `.wl-product-feature__inner`, `.wl-product-feature__content`, `.wl-product-feature__image` | — | ✅ Done |
| Why WEARLAB | `front-page.php`, `style.css` | `.wl-why-us`, `.wl-why-us__grid`, `.wl-icon-box` | — | ✅ Done |
| Instagram Section | `front-page.php`, `style.css` | `.wl-instagram`, `.wl-instagram__grid`, `.wl-instagram__item` | — | ✅ Done |
| Reviews Section | `front-page.php`, `style.css` | `.wl-reviews`, `.wl-reviews__grid`, `.wl-review-card`, `.wl-stars` | — | ✅ Done |
| Newsletter | `front-page.php`, `footer.php`, `style.css`, `main.js` | `.wl-newsletter`, `.wl-newsletter-form`, `.wl-newsletter-form__input` | AJAX handler `wearlab_newsletter` | ✅ Done |
| Final CTA | `front-page.php`, `style.css` | `.wl-final-cta` | — | ✅ Done |
| Footer | `footer.php`, `style.css` | `.wl-footer`, `.wl-footer__top`, `.wl-footer__col`, `.wl-footer__title`, `.wl-footer__menu`, `.wl-footer__bottom`, `.wl-social-links` | Footer nav menus, newsletter form | ✅ Done |
| Product Card | `content-product.php`, `style.css`, `woocommerce.js` | `.wl-product-card`, `.wl-product-card__image-wrapper`, `.wl-product-card__img`, `.wl-product-card__img--hover`, `.wl-product-card__info`, `.wl-product-card__title`, `.wl-product-card__price`, `.wl-product-card__sizes`, `.wl-size-pill` | WooCommerce product loop | ✅ Done |
| Shop/Archive | `archive-product.php`, `style.css` | `.wl-shop-container`, `.wl-shop-sidebar`, `.wl-shop-grid` | `content-product.php`, WooCommerce loop | ✅ Done |
| Single Product | `single-product.php`, `style.css`, `woocommerce.js` | `.wl-single-product`, `.wl-single-product__layout`, `.wl-single-product__gallery`, `.wl-single-product__info`, `.wl-size-selector`, `.wl-quantity`, `.wl-tab-*` | WooCommerce product gallery, reviews | ✅ Done |
| About Page | `page-about.php`, `style.css` | `.wl-about`, `.wl-about__hero`, `.wl-about__story`, `.wl-about__vision` | — | ✅ Done |
| Contact Page | `page-contact.php`, `style.css`, `main.js` | `.wl-contact`, `.wl-contact__form` | AJAX handler `wearlab_contact` | ✅ Done |
| Customization Page | `page-customization.php`, `style.css`, `main.js` | `.wl-customization`, `.wl-customization__form` | AJAX handler `wearlab_customization` | ✅ Done |
| FAQ Page | `page-faq.php`, `style.css`, `main.js` | `.wl-faq`, `.wl-faq__item`, `.wl-faq__question`, `.wl-faq__answer`, `.wl-faq__item--open` | — | ✅ Done |
| Track Order | `page-track-order.php`, `style.css` | `.wl-track-order` | — | ✅ Done |
| Policy Pages | `page-shipping-policy.php`, `page-returns-policy.php`, `page-payment-policy.php`, `page-privacy-policy.php`, `page-terms-conditions.php`, `style.css` | `.wl-policy` | — | ✅ Done |
| 404 Page | `404.php`, `style.css` | `.wl-404` | — | ✅ Done |
| Search Results | `search.php`, `style.css` | `.wl-search-results` | `searchform.php` | ✅ Done |
| Buttons | `style.css` | `.wl-btn`, `.wl-btn--primary`, `.wl-btn--secondary`, `.wl-btn--outline`, `.wl-btn--full`, `.wl-btn--small` | — | ✅ Done |
| Breadcrumbs | `functions.php`, `style.css` | `.wl-breadcrumbs` | — | ✅ Done |
