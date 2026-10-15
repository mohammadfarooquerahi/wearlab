<?php
/**
 * Template Name: My Account Page
 * Wraps WooCommerce My Account content in clean KhushPosh layout
 */

get_header();
?>

<div class="wl-account-page">
    <div class="wl-container wl-account-container">
        
        <div class="wl-account-header">
            <h1 class="wl-account-header__title"><?php the_title(); ?></h1>
            <p class="wl-account-header__subtitle">Manage your account and view previous streetwear orders</p>
        </div>

        <?php
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
        ?>

    </div>
</div>

<?php get_footer(); ?>
