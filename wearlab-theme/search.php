<?php
/**
 * Search Results Page for WEARLAB
 * Shows clean 4-column product grid with count, sort, and empty state
 */

get_header();

global $wp_query;
$search_query = get_search_query();
$total_results = $wp_query->found_posts;
?>

<div class="wl-search-page">
    <div class="wl-container">
        
        <!-- Search Page Header -->
        <div class="wl-search-header">
            <h1 class="wl-search-header__title">
                Search Results
            </h1>
            <p class="wl-search-header__query">
                <?php if ( ! empty( $search_query ) ) : ?>
                    Showing results for <strong>&ldquo;<?php echo esc_html( $search_query ); ?>&rdquo;</strong> (<?php echo esc_html( $total_results ); ?> items)
                <?php else : ?>
                    All items
                <?php endif; ?>
            </p>

            <div class="wl-search-header__form">
                <?php get_search_form(); ?>
            </div>
        </div>

        <?php if ( have_posts() ) : ?>

            <!-- Toolbar with sort & count -->
            <div class="wl-shop-toolbar">
                <div class="wl-shop-toolbar__left">
                    <span class="wl-shop-toolbar__count">
                        Found <?php echo esc_html( $total_results ); ?> <?php echo _n( 'product', 'products', $total_results, 'wearlab' ); ?>
                    </span>
                </div>
                <div class="wl-shop-toolbar__right">
                    <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <?php woocommerce_catalog_ordering(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 4-Column Product Grid -->
            <div class="wl-shop-products wl-search-products">
                <ul class="products wl-search-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        if ( class_exists( 'WooCommerce' ) && get_post_type() === 'product' ) {
                            wc_get_template_part( 'content', 'product' );
                        } else {
                            // Non-product fallback card
                            ?>
                            <li class="wl-product-card">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" class="wl-product-card__link">
                                    <div class="wl-product-card__image-wrapper">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium', array( 'class' => 'wl-product-card__img' ) ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/product-placeholder-1.jpg' ); ?>" class="wl-product-card__img" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="wl-product-card__info">
                                        <h2 class="wl-product-card__title"><?php the_title(); ?></h2>
                                        <p class="wl-product-card__price">View details &rarr;</p>
                                    </div>
                                </a>
                            </li>
                            <?php
                        }
                    endwhile;
                    ?>
                </ul>

                <!-- Pagination -->
                <div class="wl-shop-pagination">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => '&larr; Prev',
                        'next_text' => 'Next &rarr;',
                    ) );
                    ?>
                </div>
            </div>

        <?php else : ?>

            <!-- No Results Found State -->
            <div class="wl-search-empty">
                <div class="wl-search-empty__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                </div>
                <h2 class="wl-search-empty__title">No matches found</h2>
                <p class="wl-search-empty__text">We couldn't find any products matching &ldquo;<?php echo esc_html( $search_query ); ?>&rdquo;. Try checking for typos or searching for a broader term like &ldquo;drop shoulder&rdquo;, &ldquo;polo&rdquo;, or &ldquo;oversized&rdquo;.</p>
                <div class="wl-search-empty__actions">
                    <a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ); ?>" class="wl-btn wl-btn--primary">Explore All Products</a>
                </div>
            </div>

            <!-- Popular Drops fallback recommendations -->
            <?php
            $popular_loop = new WP_Query( array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
            ) );
            if ( $popular_loop->have_posts() ) :
            ?>
                <div class="wl-search-recommendations" style="margin-top: 60px; border-top: 1px solid #eeeeee; padding-top: 40px;">
                    <h3 style="font-size: 16px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 24px; text-align: center; color: #121212;">Popular Streetwear Drops</h3>
                    <div class="products wl-search-grid">
                        <?php
                        while ( $popular_loop->have_posts() ) :
                            $popular_loop->the_post();
                            wc_get_template_part( 'content', 'product' );
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
