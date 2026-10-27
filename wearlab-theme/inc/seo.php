<?php
/**
 * WEARLAB High-Performance SEO & Schema Engine
 * Automatic meta tags, OpenGraph, Twitter Cards, and JSON-LD structured data
 * Compatible with Rank Math & Yoast SEO (auto-disables if 3rd party SEO plugin active)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Dynamic Title Enhancement for Google Search Ranking
add_filter( 'document_title_parts', 'wearlab_seo_document_title_parts', 10 );
function wearlab_seo_document_title_parts( $title_parts ) {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return $title_parts;
	}

	$site_name = get_bloginfo( 'name' );

	if ( is_front_page() || is_home() ) {
		$title_parts['title']   = 'WEARLAB';
		$title_parts['tagline'] = 'Modern Pakistani Streetwear & Everyday Fashion';
	} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$title_parts['title']   = 'Shop Streetwear Drops';
		$title_parts['site']    = 'WEARLAB Pakistan';
	} elseif ( class_exists( 'WooCommerce' ) && is_product() ) {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product ) {
			$title_parts['title'] = $product->get_name() . ' — Streetwear';
			$title_parts['site']  = 'WEARLAB';
		}
	} elseif ( class_exists( 'WooCommerce' ) && is_product_category() ) {
		$title_parts['title'] = single_term_title( '', false ) . ' Collection';
		$title_parts['site']  = 'WEARLAB Streetwear';
	} elseif ( is_page() ) {
		$title_parts['title'] = get_the_title();
		$title_parts['site']  = 'WEARLAB Pakistan';
	}

	return $title_parts;
}

// 2. Comprehensive Meta Tags & OpenGraph Engine
add_action( 'wp_head', 'wearlab_seo_meta', 1 );
function wearlab_seo_meta() {
	if ( is_admin() ) {
		return;
	}

	// If Rank Math or Yoast is installed, let them handle meta tags
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$site_name = get_bloginfo( 'name' ) ?: 'WEARLAB';
	$site_url  = home_url();
	$url       = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$title     = '';
	$desc      = '';
	$image     = '';
	$type      = 'website';
	$price     = '';

	if ( is_front_page() || is_home() ) {
		$title = $site_name . ' | Modern Pakistani Streetwear & Everyday Fashion';
		$desc  = 'Discover WEARLAB — minimalist modern streetwear engineered in Pakistan. Shop oversized drop shoulders, boxy fit tees, hoodies and pants. Cash on Delivery (COD) available nationwide.';
		$image = get_template_directory_uri() . '/assets/images/hero-banner.jpg';
	} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$title = 'Shop Modern Streetwear Pakistan | Hoodies, Tees, Polos | ' . $site_name;
		$desc  = 'Explore the latest drops from WEARLAB. High-density combed cotton, clean tailored cuts, and nationwide doorstep delivery with Cash on Delivery.';
	} elseif ( class_exists( 'WooCommerce' ) && is_product() ) {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product ) {
			$type  = 'product';
			$title = $product->get_name() . ' | ' . $site_name . ' Pakistan';
			$short = $product->get_short_description() ?: $product->get_description();
			$desc  = wp_trim_words( wp_strip_all_tags( $short ), 24, '...' );
			if ( empty( $desc ) ) {
				$desc = 'Shop the ' . $product->get_name() . ' from WEARLAB. Premium streetwear manufactured with pride in Pakistan. Cash on Delivery available.';
			}
			$img_id = $product->get_image_id();
			if ( $img_id ) {
				$image = wp_get_attachment_url( $img_id );
			}
			$price = $product->get_price();
		}
	} elseif ( class_exists( 'WooCommerce' ) && is_product_category() ) {
		$term  = get_queried_object();
		$title = $term->name . ' Streetwear Collection | ' . $site_name;
		$desc  = $term->description ? wp_trim_words( wp_strip_all_tags( $term->description ), 24, '...' ) : 'Shop ' . $term->name . ' at WEARLAB. Contemporary aesthetics and everyday streetwear delivered across Pakistan.';
	} elseif ( is_page() ) {
		global $post;
		$slug  = $post->post_name;
		$title = get_the_title() . ' | ' . $site_name;
		if ( 'shipping-policy' === $slug ) {
			$desc = 'WEARLAB Shipping Policy: Fast 1-3 business day dispatch, 2-5 day nationwide delivery across Pakistan, and automated tracking.';
		} elseif ( 'returns-policy' === $slug || 'exchange-returns-policy' === $slug ) {
			$desc = 'WEARLAB Return & Exchange Policy: 7-day hassle-free exchange guarantee, 100% free defect replacement, and easy WhatsApp support.';
		} elseif ( 'privacy-policy' === $slug ) {
			$desc = 'WEARLAB Privacy Policy: 256-bit SSL encrypted checkout, strict data protection, and transparent customer privacy charter.';
		} elseif ( 'contact' === $slug || 'contact-us' === $slug ) {
			$desc = 'Contact WEARLAB customer concierge desk via WhatsApp or email. Fast sizing recommendations and order support.';
		} else {
			$desc = wp_trim_words( wp_strip_all_tags( $post->post_content ), 24, '...' );
		}
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( null, 'large' );
		}
	}

	if ( empty( $title ) ) {
		$title = wp_get_document_title();
	}
	if ( empty( $desc ) ) {
		$desc = 'WEARLAB — Minimal, modern, high-density streetwear designed and produced in Pakistan.';
	}
	if ( empty( $image ) ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id ) {
			$logo_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			if ( $logo_src ) {
				$image = $logo_src[0];
			}
		}
		if ( empty( $image ) ) {
			$image = get_template_directory_uri() . '/assets/images/logo-horizontal.png';
		}
	}

	// Standard Meta Tags
	echo "\n<!-- WEARLAB SEO Meta Tags -->\n";
	echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";

	// OpenGraph (Facebook, WhatsApp, Instagram, LinkedIn)
	echo '<meta property="og:locale" content="en_PK">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	if ( $image ) {
		echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
		echo '<meta property="og:image:alt" content="' . esc_attr( $title ) . '">' . "\n";
	}
	if ( 'product' === $type && ! empty( $price ) ) {
		echo '<meta property="product:price:amount" content="' . esc_attr( $price ) . '">' . "\n";
		echo '<meta property="product:price:currency" content="PKR">' . "\n";
	}

	// Twitter Card
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	if ( $image ) {
		echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
	}

	// Output Structured Data Schema
	wearlab_output_schema_jsonld();
}

// 3. Schema.org JSON-LD Structured Data
function wearlab_output_schema_jsonld() {
	$site_name = get_bloginfo( 'name' ) ?: 'WEARLAB';
	$site_url  = home_url( '/' );

	// Logo detection
	$logo_url = '';
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		if ( $src ) {
			$logo_url = $src[0];
		}
	}
	if ( empty( $logo_url ) ) {
		$logo_url = get_template_directory_uri() . '/assets/images/logo-horizontal.png';
	}

	// Organization & Store Schema
	$wa_num = get_theme_mod( 'wearlab_whatsapp_number', '+92 300 1234567' );
	$social_links = array_filter( array(
		get_theme_mod( 'wearlab_social_instagram', 'https://www.instagram.com/' ),
		get_theme_mod( 'wearlab_social_facebook', '' ),
		get_theme_mod( 'wearlab_social_tiktok', '' ),
	) );

	$store_schema = array(
		'@context'           => 'https://schema.org',
		'@type'              => 'ClothingStore',
		'name'               => $site_name,
		'url'                => $site_url,
		'logo'               => $logo_url,
		'image'              => $logo_url,
		'description'        => 'Modern Pakistani streetwear and everyday essentials designed with clean silhouettes and high-density fabrics.',
		'currenciesAccepted' => 'PKR',
		'paymentAccepted'    => 'Cash on Delivery, Bank Transfer, Raast, Nayapay, Sadapay',
		'priceRange'         => '₨₨',
		'areaServed'         => array(
			'@type' => 'Country',
			'name'  => 'Pakistan',
		),
		'address'            => array(
			'@type'           => 'PostalAddress',
			'addressCountry'  => 'PK',
		),
	);

	if ( ! empty( $social_links ) ) {
		$store_schema['sameAs'] = array_values( $social_links );
	}

	if ( ! empty( $wa_num ) ) {
		$store_schema['contactPoint'] = array(
			'@type'       => 'ContactPoint',
			'telephone'   => $wa_num,
			'contactType' => 'customer service',
			'areaServed'  => 'PK',
			'availableLanguage' => array( 'en', 'ur' ),
		);
	}

	// WebSite Schema with Sitelinks Searchbox
	$website_schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'WebSite',
		'name'            => $site_name,
		'url'             => $site_url,
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => $site_url . '?s={search_term_string}',
			'query-input' => 'required name=search_term_string',
		),
	);

	echo "\n<!-- WEARLAB Schema.org JSON-LD -->\n";
	echo '<script type="application/ld+json">' . wp_json_encode( $store_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
	echo '<script type="application/ld+json">' . wp_json_encode( $website_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

	// Single Product Schema
	if ( class_exists( 'WooCommerce' ) && is_product() ) {
		global $post;
		$product = wc_get_product( $post->ID );
		if ( $product ) {
			$product_schema = array(
				'@context'    => 'https://schema.org/',
				'@type'       => 'Product',
				'name'        => $product->get_name(),
				'image'       => wp_get_attachment_url( $product->get_image_id() ) ?: $logo_url,
				'description' => wp_strip_all_tags( $product->get_short_description() ?: $product->get_description() ),
				'sku'         => $product->get_sku() ?: 'WL-' . $product->get_id(),
				'brand'       => array(
					'@type' => 'Brand',
					'name'  => 'WEARLAB',
				),
				'offers'      => array(
					'@type'           => 'Offer',
					'url'             => get_permalink( $product->get_id() ),
					'priceCurrency'   => 'PKR',
					'price'           => $product->get_price(),
					'priceValidUntil' => gmdate( 'Y-12-31' ),
					'itemCondition'   => 'https://schema.org/NewCondition',
					'availability'    => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
					'seller'          => array(
						'@type' => 'Organization',
						'name'  => 'WEARLAB',
					),
				),
			);
			echo '<script type="application/ld+json">' . wp_json_encode( $product_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
		}
	}
}
