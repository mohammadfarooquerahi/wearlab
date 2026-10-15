<?php
/**
 * Template Name: Track Order
 */
get_header();
?>

<div class="wl-container wl-track-order-page wl-text-center" style="max-width: 680px; margin: 60px auto; padding: 0 20px;">
    <h1 class="wl-page-title" style="font-size: 28px; letter-spacing: 0.1em; margin-bottom: 12px;"><?php the_title(); ?></h1>
    
    <?php
    $custom_content = get_post_field( 'post_content', get_the_ID() );
    if ( ! empty( trim( $custom_content ) ) ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    else :
        $wa_raw = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
        $wa_clean = preg_replace( '/[^0-9]/', '', $wa_raw );
    ?>
    <p class="wl-track-order-desc" style="color: #666; margin-bottom: 30px;">Enter your Order ID or Courier Tracking number below to check the real-time shipping status of your parcel.</p>
    
    <?php
    // If WooCommerce Order Tracking shortcode exists, render it cleanly
    if ( shortcode_exists( 'woocommerce_order_tracking' ) ) {
        echo do_shortcode( '[woocommerce_order_tracking]' );
    } else {
    ?>
    <form class="wl-track-form" onsubmit="event.preventDefault(); window.open('https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=' + encodeURIComponent('Hi WEARLAB, I want to track my order: ' + document.getElementById('wl-track-num').value), '_blank');" style="display: flex; gap: 10px; max-width: 480px; margin: 0 auto;">
        <input type="text" id="wl-track-num" class="wl-input wl-track-input" placeholder="Order ID (e.g. #74) or Tracking No." required style="flex: 1; padding: 12px 16px; border: 1px solid #ddd; font-size: 14px;">
        <button type="submit" class="wl-btn wl-btn--primary" style="padding: 12px 24px; white-space: nowrap;">TRACK ORDER</button>
    </form>
    <?php } ?>

    <div style="margin-top: 40px; padding: 20px; background: #fafafa; border: 1px solid #eaeaea; text-align: center;">
        <p style="margin: 0 0 8px; font-weight: 600; font-size: 14px; color: #121212;">Need instant tracking assistance?</p>
        <p style="margin: 0; font-size: 13px; color: #666;">
            Chat directly with our dispatch concierge on 
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" rel="noopener noreferrer" style="color: #121212; font-weight: 600; text-decoration: underline;">WhatsApp (<?php echo esc_html( $wa_raw ); ?>)</a>
        </p>
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
