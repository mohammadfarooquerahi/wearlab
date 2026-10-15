<?php
/**
 * Template Name: FAQ
 * Location: page-faq.php
 */
get_header();

$faqs = array(
    array('q' => 'How long does shipping take?', 'a' => 'Standard shipping within Pakistan takes 3-5 business days.'),
    array('q' => 'Do you offer international shipping?', 'a' => 'Currently, we only ship within Pakistan. We plan to expand soon!'),
    array('q' => 'What is your return policy?', 'a' => 'We accept exchanges within 7 days of delivery for unworn items with tags attached.'),
    array('q' => 'How do I track my order?', 'a' => 'You can track your order using the tracking number provided in your confirmation email on our Track Order page.'),
    array('q' => 'Are your sizes standard?', 'a' => 'Our drop shoulder items are oversized by design. Please check the size guide on the product page for exact measurements.'),
    array('q' => 'What payment methods do you accept?', 'a' => 'We primarily offer Cash on Delivery (COD). Bank transfers can be arranged upon request.'),
    array('q' => 'Can I cancel my order?', 'a' => 'Orders can be canceled within 12 hours of placement. Please contact us immediately.')
);
?>

<div class="wl-container wl-faq-page">
    <h1 class="wl-page-title wl-text-center"><?php the_title(); ?></h1>
    
    <?php
    $custom_content = get_post_field( 'post_content', get_the_ID() );
    if ( ! empty( trim( $custom_content ) ) ) :
        while ( have_posts() ) :
            the_post();
            echo '<div class="wl-page-content" style="max-width: 800px; margin: 0 auto 40px;">';
            the_content();
            echo '</div>';
        endwhile;
    endif;
    ?>

    <div class="wl-accordion">
        <?php foreach ( $faqs as $faq ) : ?>
            <div class="wl-accordion-item">
                <button class="wl-accordion-header">
                    <span class="wl-accordion-title"><?php echo esc_html( $faq['q'] ); ?></span>
                    <span class="wl-accordion-icon">+</span>
                </button>
                <div class="wl-accordion-content">
                    <p><?php echo esc_html( $faq['a'] ); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php get_footer(); ?>
