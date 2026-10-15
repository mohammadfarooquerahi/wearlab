<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wearlab_seo_meta() {
	if ( is_admin() ) {
		return;
	}

	$woo_active = class_exists( 'WooCommerce' );

	// Only run on relevant pages
	$is_relevant = is_front_page() || is_singular() || is_home();
	if ( $woo_active ) {
		$is_relevant = $is_relevant || is_shop() || is_product_category();
	}
	if ( ! $is_relevant ) {
		return;
	}

	$site_name = get_bloginfo( 'name' );
	$title = '';
	$description = '';
	$url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$image = '';

	if ( is_front_page() || is_home() ) {
		$title = $site_name . ' | Modern Pakistani Streetwear';
		$description = 'Discover WEARLAB — modern Pakistani streetwear designed for everyday wear. Shop drop shoulders, polos, T-shirts and customized apparel.';
	} elseif ( $woo_active && is_shop() ) {
		$title = 'Shop | ' . $site_name;
		$description = 'Shop the latest collection of modern Pakistani streetwear from WEARLAB.';
	} elseif ( $woo_active && is_product() ) {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product ) {
			$title = $product->get_name() . ' | ' . $site_name;
			$description = wp_trim_words( wp_strip_all_tags( $product->get_short_description() ? $product->get_short_description() : $product->get_description() ), 20, '...' );
			$image = wp_get_attachment_url( $product->get_image_id() );
		}
	} elseif ( is_page() || is_single() ) {
		global $post;
		$title = get_the_title() . ' | ' . $site_name;
		$description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 20, '...' );
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( null, 'large' );
		}
	}
	
	if ( empty( $title ) ) {
		$title = $site_name;
	}
	if ( empty( $description ) ) {
		$description = 'Discover WEARLAB — modern Pakistani streetwear designed for everyday wear.';
	}

	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
	
	// Open Graph
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	}
	
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

	wearlab_structured_data();
}
add_action( 'wp_head', 'wearlab_seo_meta', 1 );

function wearlab_structured_data() {
	$site_name = get_bloginfo( 'name' );
	$site_url = home_url();
	
	// Organization Schema
	$org_schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Organization',
		'name'     => $site_name,
		'url'      => $site_url,
	);
	
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		if ( $image ) {
			$org_schema['logo'] = $image[0];
		}
	}
	
	echo '<script type="application/ld+json">' . wp_json_encode( $org_schema ) . '</script>' . "\n";
	
	// Product Schema — only if WooCommerce is active
	if ( class_exists( 'WooCommerce' ) && is_product() ) {
		global $product;
		if ( ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( get_the_ID() );
		}
		if ( ! $product ) {
			return;
		}
		
		$product_schema = array(
			'@context'    => 'https://schema.org/',
			'@type'       => 'Product',
			'name'        => $product->get_name(),
			'image'       => wp_get_attachment_url( $product->get_image_id() ),
			'description' => wp_strip_all_tags( $product->get_short_description() ),
			'sku'         => $product->get_sku(),
			'offers'      => array(
				'@type'         => 'Offer',
				'url'           => get_permalink( $product->get_id() ),
				'priceCurrency' => get_woocommerce_currency(),
				'price'         => $product->get_price(),
				'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
			)
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $product_schema ) . '</script>' . "\n";
	}
}
