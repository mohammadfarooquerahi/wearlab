<?php
/**
 * Template Name: About
 * Location: page-about.php
 */
get_header();
?>

<div class="wl-page-hero">
    <div class="wl-container">
        <h1 class="wl-page-hero__title"><?php the_title(); ?></h1>
    </div>
</div>

<div class="wl-container wl-about-content">
    <?php
    $custom_content = get_post_field( 'post_content', get_the_ID() );
    if ( ! empty( trim( $custom_content ) ) ) :
        while ( have_posts() ) :
            the_post();
            echo '<div class="wl-page-content">';
            the_content();
            echo '</div>';
        endwhile;
    else :
    ?>
    <div class="wl-about-story">
        <p>WEARLAB was born out of a desire to create something better. In a market flooded with fast fashion and loud logos, we wanted to build a brand that focuses on what truly matters: quality, fit, and timeless style.</p>
        <p>We source the finest materials and work with skilled artisans right here in Pakistan. Our goal is to elevate your everyday wardrobe with pieces that you'll reach for time and time again.</p>
        <p>This is modern streetwear. This is WEARLAB.</p>
    </div>

    <div class="wl-about-vision-mission">
        <div class="wl-about-vision">
            <h2>OUR VISION</h2>
            <p>To redefine everyday wear by setting a new standard for quality and design in the local market, eventually taking our aesthetic to a global audience.</p>
        </div>
        <div class="wl-about-mission">
            <h2>OUR MISSION</h2>
            <p>To provide modern, comfortable, and versatile clothing that empowers individuals to express their personal style with confidence and ease.</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
