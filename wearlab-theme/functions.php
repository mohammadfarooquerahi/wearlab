<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Includes
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/seo.php';

// Nav Walker
class Wearlab_Nav_Walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'wl-has-dropdown';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= '<li' . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' class="wl-nav-link">';
		$item_output .= $args->link_before . $title . $args->link_after;
		
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$item_output .= ' <svg class="wl-icon-dropdown" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
		}
		
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// Setup
function wearlab_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Ensure classic PHP templates are used (prevent FSE/block template takeover)
	remove_theme_support( 'block-templates' );
	remove_theme_support( 'block-template-parts' );

	// Declare HFE support so external plugin does not inject fallback override templates
	add_theme_support( 'header-footer-elementor' );

	// WooCommerce Support
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 600,
		'gallery_thumbnail_image_width' => 300,
		'single_image_width'    => 800,
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Image Sizes
	add_image_size( 'product-card', 400, 533, true ); // 3:4 aspect ratio
	add_image_size( 'product-single', 800, 1066, true ); // 3:4
	add_image_size( 'hero-banner', 1920, 800, true );

	// Menus
	register_nav_menus( array(
		'primary'        => __( 'Primary Menu', 'wearlab' ),
		'footer-shop'    => __( 'Footer Shop Menu', 'wearlab' ),
		'footer-help'    => __( 'Footer Help Menu', 'wearlab' ),
		'footer-company' => __( 'Footer Company Menu', 'wearlab' ),
	) );
}
add_action( 'after_setup_theme', 'wearlab_setup' );

// Auto-migrate theme mods if folder name changes (e.g. wearlab vs wearlab-theme)
add_action( 'after_setup_theme', 'wearlab_migrate_theme_mods', 20 );
function wearlab_migrate_theme_mods() {
	$current_theme = get_stylesheet();
	if ( 'wearlab-theme' !== $current_theme ) {
		$old_mods = get_option( 'theme_mods_wearlab-theme' );
		if ( ! empty( $old_mods ) && ! get_option( "theme_mods_{$current_theme}" ) ) {
			update_option( "theme_mods_{$current_theme}", $old_mods );
		}
	}
}

// Auto-ensure New Arrivals category exists in WooCommerce
add_action( 'init', 'wearlab_ensure_taxonomies' );
function wearlab_ensure_taxonomies() {
	if ( taxonomy_exists( 'product_cat' ) ) {
		if ( ! term_exists( 'new-arrivals', 'product_cat' ) ) {
			wp_insert_term( 'New Arrivals', 'product_cat', array( 'slug' => 'new-arrivals' ) );
		}
	}
}

// Auto-ensure required store policy and support pages exist in WordPress
add_action( 'init', 'wearlab_ensure_policy_pages' );
function wearlab_ensure_policy_pages() {
	$pages_to_check = array(
		'contact' => array(
			'title'    => 'Contact Us',
			'template' => 'page-contact.php',
		),
		'returns-policy' => array(
			'title'    => 'Exchange & Returns Policy',
			'template' => 'page-returns-policy.php',
		),
		'shipping-policy' => array(
			'title'    => 'Shipping Policy',
			'template' => 'page-shipping-policy.php',
		),
		'payment-policy' => array(
			'title'    => 'Payment Policy',
			'template' => 'page-payment-policy.php',
		),
		'privacy-policy' => array(
			'title'    => 'Privacy Policy',
			'template' => 'page-privacy-policy.php',
		),
		'terms-conditions' => array(
			'title'    => 'Terms & Conditions',
			'template' => 'page-terms-conditions.php',
		),
	);

	foreach ( $pages_to_check as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( ! $existing ) {
			$post_id = wp_insert_post( array(
				'post_title'   => $data['title'],
				'post_name'    => $slug,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			) );
			if ( $post_id && ! is_wp_error( $post_id ) && ! empty( $data['template'] ) ) {
				update_post_meta( $post_id, '_wp_page_template', $data['template'] );
			}
		} else {
			if ( 'publish' !== $existing->post_status ) {
				wp_update_post( array(
					'ID'          => $existing->ID,
					'post_status' => 'publish',
				) );
			}
			$current_tpl = get_post_meta( $existing->ID, '_wp_page_template', true );
			if ( empty( $current_tpl ) || 'default' === $current_tpl ) {
				update_post_meta( $existing->ID, '_wp_page_template', $data['template'] );
			}
		}
	}

	$privacy_id = get_option( 'wp_page_for_privacy_policy' );
	if ( $privacy_id ) {
		$priv_post = get_post( $privacy_id );
		if ( $priv_post && 'publish' !== $priv_post->post_status ) {
			wp_update_post( array(
				'ID'          => $privacy_id,
				'post_status' => 'publish',
				'post_name'   => 'privacy-policy',
			) );
		}
		update_post_meta( $privacy_id, '_wp_page_template', 'page-privacy-policy.php' );
	}
}

// Fallback routing for policy and contact pages so they never 404
add_action( 'template_redirect', 'wearlab_policy_page_redirect_fallback', 5 );
function wearlab_policy_page_redirect_fallback() {
	if ( is_404() && ! empty( $_SERVER['REQUEST_URI'] ) ) {
		$request_path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
		$routes = array(
			'contact'                => 'page-contact.php',
			'contact-us'             => 'page-contact.php',
			'returns-policy'         => 'page-returns-policy.php',
			'exchange-return-policy' => 'page-returns-policy.php',
			'return-policy'          => 'page-returns-policy.php',
			'shipping-policy'        => 'page-shipping-policy.php',
			'payment-policy'         => 'page-payment-policy.php',
			'privacy-policy'         => 'page-privacy-policy.php',
			'terms-conditions'       => 'page-terms-conditions.php',
			'terms-and-conditions'   => 'page-terms-conditions.php',
		);
		if ( isset( $routes[ $request_path ] ) ) {
			status_header( 200 );
			global $wp_query;
			if ( is_object( $wp_query ) ) {
				$wp_query->is_404 = false;
				$wp_query->is_page = true;
			}
			$template_file = get_template_directory() . '/' . $routes[ $request_path ];
			if ( file_exists( $template_file ) ) {
				include $template_file;
				exit;
			}
		}
	}
}

// Enqueue Scripts & Styles (High Performance & Cache-Busting)
function wearlab_enqueue() {
	$theme_ver   = wp_get_theme()->get( 'Version' );
	$style_path  = get_stylesheet_directory() . '/style.css';
	$style_ver   = file_exists( $style_path ) ? filemtime( $style_path ) : $theme_ver;
	$js_path     = get_template_directory() . '/assets/js/main.js';
	$js_ver      = file_exists( $js_path ) ? filemtime( $js_path ) : $theme_ver;

	// Google Fonts with font-display:swap
	wp_enqueue_style( 'wearlab-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap', array(), null );

	// Main Theme Stylesheet with automatic filemtime cache-busting
	wp_enqueue_style( 'wearlab-style', get_stylesheet_uri(), array(), $style_ver );

	// Main Theme Script (Deferred for maximum speed)
	wp_enqueue_script( 'wearlab-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $js_ver, true );
	wp_script_add_data( 'wearlab-main', 'defer', true );

	if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
		$wc_js_path = get_template_directory() . '/assets/js/woocommerce.js';
		$wc_js_ver  = file_exists( $wc_js_path ) ? filemtime( $wc_js_path ) : $theme_ver;
		wp_enqueue_script( 'wearlab-woocommerce', get_template_directory_uri() . '/assets/js/woocommerce.js', array( 'jquery' ), $wc_js_ver, true );
		wp_script_add_data( 'wearlab-woocommerce', 'defer', true );
	}
	
	wp_localize_script( 'wearlab-main', 'wearlab_ajax', array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'wearlab_nonce' )
	) );
}
add_action( 'wp_enqueue_scripts', 'wearlab_enqueue' );

// Disable block editor for pages
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// Security & Header Hardening
add_action( 'send_headers', 'wearlab_security_headers' );
function wearlab_security_headers() {
	if ( ! is_admin() ) {
		header( 'X-Content-Type-Options: nosniff' );
		header( 'X-Frame-Options: SAMEORIGIN' );
		header( 'X-XSS-Protection: 1; mode=block' );
		header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	}
}

// Clean head tags for speed & security
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Remove X-Pingback header
add_filter( 'wp_headers', 'wearlab_remove_x_pingback' );
function wearlab_remove_x_pingback( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
}

// Block Author Enumeration Scans
add_action( 'template_redirect', 'wearlab_block_author_enumeration' );
function wearlab_block_author_enumeration() {
	if ( ! is_admin() && isset( $_REQUEST['author'] ) && is_numeric( $_REQUEST['author'] ) ) {
		wp_safe_redirect( home_url( '/' ), 301 );
		exit;
	}
}

// Widgets
function wearlab_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'wearlab' ),
		'id'            => 'sidebar-shop',
		'before_widget' => '<div class="wl-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wl-widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Newsletter', 'wearlab' ),
		'id'            => 'footer-newsletter',
		'before_widget' => '<div class="wl-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="wl-widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'wearlab_widgets_init' );

// Body Classes
function wearlab_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'wl-home';
	}
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		$classes[] = 'wl-shop';
	}
	return $classes;
}
add_filter( 'body_class', 'wearlab_body_classes' );

// Breadcrumbs
function wearlab_breadcrumbs() {
	if ( is_front_page() || is_home() ) {
		return;
	}
	echo '<div class="wl-breadcrumbs"><a href="' . home_url() . '">Home</a>';
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		echo ' / ';
		if ( is_product() ) {
			$terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
			if ( ! empty( $terms ) ) {
				$main_term = $terms[0];
				echo '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a> / ';
			}
			the_title();
		} elseif ( is_product_category() ) {
			single_term_title();
		} else {
			echo 'Shop';
		}
	} elseif ( is_page() || is_single() ) {
		echo ' / ';
		the_title();
	}
	echo '</div>';
}

/* ==============================================================================
   WooCommerce Customizations
============================================================================== */
if ( class_exists( 'WooCommerce' ) ) {
	
	// Remove default wrappers
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	// Add custom wrappers
	add_action( 'woocommerce_before_main_content', 'wearlab_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'wearlab_wrapper_end', 10 );

	function wearlab_wrapper_start() {
		if ( ! is_shop() && ! is_product_taxonomy() && ! is_product() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
			echo '<main class="wl-main"><div class="wl-container wl-shop-container">';
		}
	}

	function wearlab_wrapper_end() {
		if ( ! is_shop() && ! is_product_taxonomy() && ! is_product() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
			echo '</div></main>';
		}
	}

	// Disable default styles (we will load our own)
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

	// Return false to prevent redirect so side drawer opens seamlessly
	add_filter( 'woocommerce_add_to_cart_redirect', '__return_false' );

	// ---- Shop Page Filter Queries ----

	// Filter by pa_size attribute
	add_action( 'woocommerce_product_query', 'wearlab_filter_by_size' );
	function wearlab_filter_by_size( $q ) {
		if ( ! empty( $_GET['filter_size'] ) ) {
			$meta_query = $q->get( 'tax_query', array() );
			$meta_query[] = array(
				'taxonomy' => 'pa_size',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['filter_size'] ),
			);
			$q->set( 'tax_query', $meta_query );
		}
	}

	// Filter by pa_color attribute
	add_action( 'woocommerce_product_query', 'wearlab_filter_by_color' );
	function wearlab_filter_by_color( $q ) {
		if ( ! empty( $_GET['filter_color'] ) ) {
			$meta_query = $q->get( 'tax_query', array() );
			$meta_query[] = array(
				'taxonomy' => 'pa_color',
				'field'    => 'slug',
				'terms'    => sanitize_text_field( $_GET['filter_color'] ),
			);
			$q->set( 'tax_query', $meta_query );
		}
	}

	// Support New Arrivals query
	add_action( 'woocommerce_product_query', 'wearlab_new_arrivals_query', 20 );
	function wearlab_new_arrivals_query( $q ) {
		if ( is_admin() ) return;

		if ( is_product_category( 'new-arrivals' ) || ( ! empty( $_GET['filter'] ) && $_GET['filter'] === 'new-arrivals' ) ) {
			$q->set( 'orderby', 'date' );
			$q->set( 'order', 'DESC' );

			// Check if new-arrivals term has 0 posts
			$term = get_term_by( 'slug', 'new-arrivals', 'product_cat' );
			if ( ! $term || empty( $term->count ) || 0 === (int) $term->count ) {
				$tax_query = $q->get( 'tax_query', array() );
				$filtered = array();
				foreach ( $tax_query as $t ) {
					if ( isset( $t['taxonomy'] ) && $t['taxonomy'] === 'product_cat' ) {
						if ( ( is_array( $t['terms'] ) && in_array( 'new-arrivals', $t['terms'] ) ) || ( is_string( $t['terms'] ) && 'new-arrivals' === $t['terms'] ) ) {
							continue;
						}
					}
					$filtered[] = $t;
				}
				$q->set( 'tax_query', $filtered );
			}
		}
	}

	// Filter by stock status
	add_action( 'woocommerce_product_query', 'wearlab_filter_by_stock' );
	function wearlab_filter_by_stock( $q ) {
		if ( ! empty( $_GET['stock_status'] ) && $_GET['stock_status'] === 'instock' ) {
			$meta_query = $q->get( 'meta_query', array() );
			$meta_query[] = array(
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '=',
			);
			$q->set( 'meta_query', $meta_query );
		}
	}

	// Set products per page
	add_filter( 'loop_shop_per_page', function() { return 16; } );

	// Custom product card
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

	add_action( 'woocommerce_shop_loop_item_title', 'wearlab_template_loop_product_title', 10 );
	function wearlab_template_loop_product_title() {
		echo '<h3 class="wl-product-card-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
	}

	// Auto-ensure COD gateway is enabled in WooCommerce options
	add_action( 'init', 'wearlab_ensure_cod_enabled' );
	function wearlab_ensure_cod_enabled() {
		$cod_settings = get_option( 'woocommerce_cod_settings', array() );
		$updated = false;
		if ( ! isset( $cod_settings['enabled'] ) || $cod_settings['enabled'] !== 'yes' ) {
			$cod_settings['enabled'] = 'yes';
			$updated = true;
		}
		if ( ! isset( $cod_settings['enable_for_virtual'] ) || $cod_settings['enable_for_virtual'] !== 'yes' ) {
			$cod_settings['enable_for_virtual'] = 'yes';
			$updated = true;
		}
		if ( isset( $cod_settings['enable_for_methods'] ) && ! empty( $cod_settings['enable_for_methods'] ) ) {
			$cod_settings['enable_for_methods'] = array();
			$updated = true;
		}
		$cod_settings['title'] = 'Cash on Delivery (COD)';
		$cod_settings['description'] = 'Pay with cash upon delivery.';
		if ( $updated || ! get_option( 'woocommerce_cod_settings' ) ) {
			update_option( 'woocommerce_cod_settings', $cod_settings );
		}
	}

	// Ensure WooCommerce store is live and not blocked by coming soon mode
	add_action( 'init', 'wearlab_disable_coming_soon' );
	function wearlab_disable_coming_soon() {
		if ( get_option( 'woocommerce_coming_soon' ) === 'yes' ) {
			update_option( 'woocommerce_coming_soon', 'no' );
		}
		if ( get_option( 'woocommerce_store_pages_only' ) === 'yes' ) {
			update_option( 'woocommerce_store_pages_only', 'no' );
		}
	}

	// Remove duplicate unstyled default WooCommerce order details table on thankyou page
	add_action( 'init', 'wearlab_clean_thankyou_page', 20 );
	add_action( 'template_redirect', 'wearlab_clean_thankyou_page', 20 );
	function wearlab_clean_thankyou_page() {
		remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
	}

	// Force COD payment method only and ensure gateway instance is valid
	add_filter( 'woocommerce_available_payment_gateways', 'wearlab_force_cod', 999 );
	function wearlab_force_cod( $available_gateways ) {
		if ( is_admin() ) return $available_gateways;
		
		if ( isset( $available_gateways['cod'] ) ) {
			return array( 'cod' => $available_gateways['cod'] );
		}

		if ( function_exists( 'WC' ) && isset( WC()->payment_gateways ) ) {
			$all_gateways = WC()->payment_gateways->payment_gateways();
			if ( isset( $all_gateways['cod'] ) ) {
				$all_gateways['cod']->enabled = 'yes';
				$all_gateways['cod']->enable_for_virtual = true;
				$all_gateways['cod']->enable_for_methods = array();
				return array( 'cod' => $all_gateways['cod'] );
			}
		}

		if ( class_exists( 'WC_Gateway_COD' ) ) {
			$cod_gw = new WC_Gateway_COD();
			$cod_gw->enabled = 'yes';
			$cod_gw->enable_for_virtual = true;
			$cod_gw->enable_for_methods = array();
			return array( 'cod' => $cod_gw );
		}
		return $available_gateways;
	}

	// Unrequire State & Postcode in country locale
	add_filter( 'woocommerce_get_country_locale', 'wearlab_country_locale' );
	function wearlab_country_locale( $locales ) {
		if ( ! isset( $locales['PK'] ) ) {
			$locales['PK'] = array();
		}
		$locales['PK']['state'] = array(
			'required' => false,
			'hidden'   => false,
		);
		$locales['PK']['postcode'] = array(
			'required' => false,
			'hidden'   => false,
		);
		return $locales;
	}

	// Unrequire State & Postcode fields for Pakistan
	add_filter( 'woocommerce_billing_fields', 'wearlab_unrequire_state_fields', 999 );
	add_filter( 'woocommerce_shipping_fields', 'wearlab_unrequire_state_fields', 999 );
	add_filter( 'woocommerce_default_address_fields', 'wearlab_unrequire_default_state', 999 );
	function wearlab_unrequire_state_fields( $fields ) {
		if ( isset( $fields['billing_state'] ) ) {
			$fields['billing_state']['required'] = false;
		}
		if ( isset( $fields['shipping_state'] ) ) {
			$fields['shipping_state']['required'] = false;
		}
		if ( isset( $fields['billing_postcode'] ) ) {
			$fields['billing_postcode']['required'] = false;
		}
		if ( isset( $fields['shipping_postcode'] ) ) {
			$fields['shipping_postcode']['required'] = false;
		}
		return $fields;
	}
	function wearlab_unrequire_default_state( $fields ) {
		if ( isset( $fields['state'] ) ) {
			$fields['state']['required'] = false;
		}
		if ( isset( $fields['postcode'] ) ) {
			$fields['postcode']['required'] = false;
		}
		return $fields;
	}

	// Auto-fill state and postcode if empty on checkout creation
	add_action( 'woocommerce_checkout_create_order', 'wearlab_set_default_order_state', 20, 2 );
	function wearlab_set_default_order_state( $order, $data ) {
		if ( empty( $order->get_billing_state() ) ) {
			$order->set_billing_state( 'IS' );
		}
		if ( empty( $order->get_shipping_state() ) ) {
			$order->set_shipping_state( 'IS' );
		}
		if ( empty( $order->get_billing_postcode() ) ) {
			$order->set_billing_postcode( '44000' );
		}
		if ( empty( $order->get_shipping_postcode() ) ) {
			$order->set_shipping_postcode( '44000' );
		}
	}

	// Clear state, postcode, and payment method errors during checkout validation
	add_action( 'woocommerce_after_checkout_validation', 'wearlab_clear_checkout_errors', 999, 2 );
	function wearlab_clear_checkout_errors( $data, $errors ) {
		if ( is_wp_error( $errors ) ) {
			$errors->remove( 'billing_state_required' );
			$errors->remove( 'shipping_state_required' );
			$errors->remove( 'billing_state_validation' );
			$errors->remove( 'shipping_state_validation' );
			$errors->remove( 'billing_postcode_required' );
			$errors->remove( 'shipping_postcode_required' );
			$errors->remove( 'payment' );
		}
	}

	// WooCommerce Fragments for Drawer updates
	add_filter( 'woocommerce_add_to_cart_fragments', 'wearlab_cart_fragments' );
	function wearlab_cart_fragments( $fragments ) {
		// Update header cart count
		$cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
		$fragments['span.wl-cart-count'] = '<span class="wl-cart-count">' . esc_html( $cart_count ) . '</span>';

		// Update cart drawer HTML content
		ob_start();
		if ( file_exists( get_template_directory() . '/woocommerce/cart/mini-cart.php' ) ) {
			include get_template_directory() . '/woocommerce/cart/mini-cart.php';
		}
		$fragments['div#wlCartDrawerContent'] = '<div class="wl-cart-drawer__content" id="wlCartDrawerContent">' . ob_get_clean() . '</div>';

		return $fragments;
	}

	// AJAX update cart item quantity from drawer
	add_action( 'wp_ajax_wearlab_update_cart_qty', 'wearlab_ajax_update_cart_qty' );
	add_action( 'wp_ajax_nopriv_wearlab_update_cart_qty', 'wearlab_ajax_update_cart_qty' );
	function wearlab_ajax_update_cart_qty() {
		check_ajax_referer( 'wearlab_nonce', 'nonce' );

		$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] ?? '' );
		$qty = intval( $_POST['quantity'] ?? 1 );

		if ( $cart_item_key && WC()->cart ) {
			if ( $qty <= 0 ) {
				WC()->cart->remove_cart_item( $cart_item_key );
			} else {
				WC()->cart->set_quantity( $cart_item_key, $qty, true );
			}
			WC()->cart->calculate_totals();

			ob_start();
			if ( file_exists( get_template_directory() . '/woocommerce/cart/mini-cart.php' ) ) {
				include get_template_directory() . '/woocommerce/cart/mini-cart.php';
			}
			$html = ob_get_clean();

			wp_send_json_success( array(
				'count' => WC()->cart->get_cart_contents_count(),
				'total' => WC()->cart->get_cart_total(),
				'html'  => $html,
			) );
		}
		wp_send_json_error( array( 'message' => 'Invalid cart item key' ) );
	}

	// AJAX remove cart item from drawer
	add_action( 'wp_ajax_wearlab_remove_cart_item', 'wearlab_ajax_remove_cart_item' );
	add_action( 'wp_ajax_nopriv_wearlab_remove_cart_item', 'wearlab_ajax_remove_cart_item' );
	function wearlab_ajax_remove_cart_item() {
		check_ajax_referer( 'wearlab_nonce', 'nonce' );

		$cart_item_key = sanitize_text_field( $_POST['cart_item_key'] ?? '' );

		if ( $cart_item_key && WC()->cart ) {
			WC()->cart->remove_cart_item( $cart_item_key );
			WC()->cart->calculate_totals();

			ob_start();
			if ( file_exists( get_template_directory() . '/woocommerce/cart/mini-cart.php' ) ) {
				include get_template_directory() . '/woocommerce/cart/mini-cart.php';
			}
			$html = ob_get_clean();

			wp_send_json_success( array(
				'count' => WC()->cart->get_cart_contents_count(),
				'total' => WC()->cart->get_cart_total(),
				'html'  => $html,
			) );
		}
		wp_send_json_error( array( 'message' => 'Invalid cart item key' ) );
	}

	// Enable WooCommerce registration on My Account page
	add_filter( 'option_woocommerce_enable_myaccount_registration', '__return_true' );

	// Clean stale error notices on account login/register
	add_action( 'template_redirect', 'wearlab_clean_stale_notices' );
	function wearlab_clean_stale_notices() {
		if ( function_exists( 'wc_clear_notices' ) && is_account_page() && ! is_user_logged_in() ) {
			wc_clear_notices();
		}
	}

	// Remove 2XL / XXL from WooCommerce attribute options and dropdowns
	add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'wearlab_remove_2xl_from_dropdown', 999 );
	function wearlab_remove_2xl_from_dropdown( $args ) {
		if ( ! empty( $args['options'] ) ) {
			$args['options'] = array_values( array_filter( $args['options'], function( $opt ) {
				$name = strtoupper( trim( is_string( $opt ) ? $opt : ( $opt->name ?? $opt->slug ?? '' ) ) );
				return ! in_array( $name, array( '2XL', 'XXL' ) );
			} ) );
		}
		return $args;
	}

	// AJAX Add to Cart (Handles simple & variable products seamlessly)
	add_action( 'wp_ajax_wearlab_add_to_cart', 'wearlab_ajax_add_to_cart' );
	add_action( 'wp_ajax_nopriv_wearlab_add_to_cart', 'wearlab_ajax_add_to_cart' );
	
	function wearlab_ajax_add_to_cart() {
		$raw_pid = ! empty( $_POST['product_id'] ) ? $_POST['product_id'] : ( ! empty( $_POST['add-to-cart'] ) ? $_POST['add-to-cart'] : 0 );
		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $raw_pid ) );
		$quantity = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
		$variation_id = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
		$variations = array();

		foreach ( $_POST as $key => $value ) {
			if ( 0 === strpos( $key, 'attribute_' ) ) {
				$variations[ sanitize_text_field( $key ) ] = sanitize_text_field( wp_unslash( $value ) );
			}
		}

		// Block 2XL size
		foreach ( $variations as $vk => $vv ) {
			if ( false !== strpos( strtolower( $vk ), 'size' ) && in_array( strtoupper( trim( $vv ) ), array( '2XL', 'XXL' ) ) ) {
				wp_send_json_error( array( 'message' => '2XL size is not available.' ) );
				return;
			}
		}

		// If it's a variable product but variation_id was not explicitly resolved
		if ( $product_id && ( ! $variation_id || 0 === $variation_id ) ) {
			$product = wc_get_product( $product_id );
			if ( $product && $product->is_type( 'variable' ) ) {
				$data_store = WC_Data_Store::load( 'product' );
				$matched_var_id = $data_store->find_matching_product_variation( $product, $variations );
				if ( $matched_var_id ) {
					$variation_id = $matched_var_id;
				} else {
					// Match child variation that matches provided attributes (e.g. size)
					$children = $product->get_children();
					foreach ( $children as $child_id ) {
						$child_var = wc_get_product( $child_id );
						if ( $child_var ) {
							$child_attrs = $child_var->get_attributes();
							$match = true;
							foreach ( $variations as $vk => $vv ) {
								$clean_k = str_replace( 'attribute_', '', $vk );
								if ( isset( $child_attrs[ $clean_k ] ) && $child_attrs[ $clean_k ] !== '' && strtolower( $child_attrs[ $clean_k ] ) !== strtolower( $vv ) ) {
									$match = false;
									break;
								}
							}
							if ( $match ) {
								$variation_id = $child_id;
								break;
							}
						}
					}
					// Fallback to first available child variation
					if ( ! $variation_id && ! empty( $children ) ) {
						$variation_id = absint( $children[0] );
					}
				}
			}
		}

		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations );
		
		$is_buy_now = ! empty( $_POST['buy_now'] );

		if ( $passed_validation && $product_id && WC()->cart ) {
			if ( $is_buy_now ) {
				// Buy It Now: empty cart first so checkout has exact item and quantity
				WC()->cart->empty_cart();
				if ( function_exists( 'wc_clear_notices' ) ) {
					wc_clear_notices();
				}
				if ( method_exists( WC()->cart, 'remove_coupons' ) ) {
					WC()->cart->remove_coupons();
				}
				$cart_item_key = ( $variation_id > 0 ) 
					? WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations )
					: WC()->cart->add_to_cart( $product_id, $quantity );
			} else {
				// Check if this product/variation is already in the cart
				$found_cart_item_key = null;
				foreach ( WC()->cart->get_cart() as $existing_key => $cart_item ) {
					if ( $cart_item['product_id'] == $product_id ) {
						if ( $variation_id > 0 && isset( $cart_item['variation_id'] ) && $cart_item['variation_id'] == $variation_id ) {
							$found_cart_item_key = $existing_key;
							break;
						} elseif ( 0 === $variation_id ) {
							$found_cart_item_key = $existing_key;
							break;
						}
					}
				}

				if ( $found_cart_item_key ) {
					// Set quantity directly to match what user chose on PDP
					WC()->cart->set_quantity( $found_cart_item_key, $quantity, true );
					$cart_item_key = $found_cart_item_key;
				} else {
					$cart_item_key = ( $variation_id > 0 ) 
						? WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations )
						: WC()->cart->add_to_cart( $product_id, $quantity );
				}
			}

			if ( $cart_item_key ) {
				WC()->cart->calculate_totals();

				ob_start();
				if ( file_exists( get_template_directory() . '/woocommerce/cart/mini-cart.php' ) ) {
					include get_template_directory() . '/woocommerce/cart/mini-cart.php';
				}
				$drawer_html = ob_get_clean();

				$data = array(
					'count'        => WC()->cart->get_cart_contents_count(),
					'total'        => WC()->cart->get_cart_total(),
					'html'         => $drawer_html,
					'checkout_url' => home_url( '/checkout/' ),
					'cart_url'     => wc_get_cart_url(),
				);
				wp_send_json_success( $data );
				return;
			}
		}

		// If WC had an error notice, grab it
		$error_message = 'Failed to add product to cart.';
		if ( function_exists( 'wc_get_notices' ) ) {
			$notices = wc_get_notices( 'error' );
			if ( ! empty( $notices ) ) {
				$error_message = wp_strip_all_tags( $notices[0]['notice'] );
				wc_clear_notices();
			}
		}

		wp_send_json_error( array( 'message' => $error_message ) );
	}
}

// Contact Form AJAX Handler
add_action( 'wp_ajax_wearlab_contact', 'wearlab_ajax_contact' );
add_action( 'wp_ajax_nopriv_wearlab_contact', 'wearlab_ajax_contact' );
function wearlab_ajax_contact() {
	check_ajax_referer( 'wearlab_nonce', 'nonce' );
	
	$name = sanitize_text_field( $_POST['name'] );
	$email = sanitize_email( $_POST['email'] );
	$message = sanitize_textarea_field( $_POST['message'] );
	
	$to = get_option( 'admin_email' );
	$subject = 'New Contact Form Submission - WEARLAB';
	$body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
	
	if ( wp_mail( $to, $subject, $body ) ) {
		wp_send_json_success( array( 'message' => 'Message sent successfully.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Failed to send message.' ) );
	}
}

// Customization Request Form AJAX Handler
add_action( 'wp_ajax_wearlab_customization', 'wearlab_ajax_customization' );
add_action( 'wp_ajax_nopriv_wearlab_customization', 'wearlab_ajax_customization' );
function wearlab_ajax_customization() {
	check_ajax_referer( 'wearlab_nonce', 'nonce' );
	
	$name = sanitize_text_field( $_POST['name'] );
	$email = sanitize_email( $_POST['email'] );
	$phone = sanitize_text_field( $_POST['phone'] );
	$details = sanitize_textarea_field( $_POST['details'] );
	
	$to = get_option( 'admin_email' );
	$subject = 'New Customization Request - WEARLAB';
	$body = "Name: $name\nEmail: $email\nPhone: $phone\n\nDetails:\n$details";
	
	if ( wp_mail( $to, $subject, $body ) ) {
		wp_send_json_success( array( 'message' => 'Request submitted successfully.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Failed to submit request.' ) );
	}
}

// Newsletter Subscription AJAX Handler
add_action( 'wp_ajax_wearlab_newsletter', 'wearlab_ajax_newsletter' );
add_action( 'wp_ajax_nopriv_wearlab_newsletter', 'wearlab_ajax_newsletter' );
function wearlab_ajax_newsletter() {
	check_ajax_referer( 'wearlab_nonce', 'nonce' );
	
	$email = sanitize_email( $_POST['email'] );
	
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
	}
	
	$subscribers = get_option( 'wearlab_subscribers', array() );
	if ( ! in_array( $email, $subscribers ) ) {
		$subscribers[] = $email;
		update_option( 'wearlab_subscribers', $subscribers );
		wp_send_json_success( array( 'message' => 'Successfully subscribed!' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Already subscribed.' ) );
	}
}

// Ensure checkout URL always points to native theme checkout (/checkout/)
add_filter( 'woocommerce_get_checkout_url', 'wearlab_ensure_native_checkout_url', 9999 );
function wearlab_ensure_native_checkout_url( $url ) {
	return home_url( '/checkout/' );
}

// 1. Completely disable coupons store-wide as requested by client
add_filter( 'woocommerce_coupons_enabled', '__return_false' );

// 2. Automatically remove any coupons if present in cart
add_action( 'woocommerce_before_calculate_totals', 'wearlab_remove_all_coupons', 1 );
function wearlab_remove_all_coupons( $cart ) {
	if ( ! empty( $cart->get_applied_coupons() ) ) {
		$cart->remove_coupons();
	}
}

// 3. Automatically clear coupons and stale notices on checkout/cart
add_action( 'template_redirect', 'wearlab_clear_coupons_on_checkout', 1 );
function wearlab_clear_coupons_on_checkout() {
	if ( ( is_checkout() || is_cart() ) && function_exists( 'WC' ) && WC()->cart ) {
		if ( ! empty( WC()->cart->get_applied_coupons() ) ) {
			WC()->cart->remove_coupons();
		}
		if ( function_exists( 'wc_clear_notices' ) ) {
			wc_clear_notices();
		}
	}
}

// 4. If anything lands on a broken third-party funnel step like /step/checkout-2/, redirect directly to native /checkout/
add_action( 'template_redirect', 'wearlab_redirect_broken_funnel_steps', 2 );
function wearlab_redirect_broken_funnel_steps() {
	if ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], '/step/' ) ) {
		wp_safe_redirect( home_url( '/checkout/' ), 301 );
		exit;
	}
}

// 5. Prevent Elementor Header & Footer Builder (HFE) or Theme Builder from hijacking theme footer
add_filter( 'enable_hfe_render_footer', '__return_false', 9999 );
add_filter( 'hfe_footer_enabled', '__return_false', 9999 );
add_filter( 'hfe_render_footer', '__return_false', 9999 );
add_filter( 'get_hfe_footer_id', '__return_false', 9999 );
add_filter( 'hfe_footer_id', '__return_false', 9999 );
add_filter( 'elementor/theme/need_override_location', '__return_false', 9999 );

// Guarantee get_footer loads theme's native footer.php and remove any HFE/third-party hijacking
add_action( 'template_redirect', 'wearlab_prevent_footer_hijack', 999 );
function wearlab_prevent_footer_hijack() {
	remove_all_actions( 'get_footer' );
	remove_action( 'wp_footer', 'hfe_render_footer', 10 );
	remove_action( 'wp_footer', 'hfe_render_footer', 0 );
	remove_action( 'wp_footer', 'hfe_render_footer', 99 );
}

// 6. Guarantee Customer Order Confirmation Email is Dispatched on Checkout
add_action( 'woocommerce_thankyou', 'wearlab_ensure_customer_order_confirmation_email', 10, 1 );
add_action( 'woocommerce_checkout_order_processed', 'wearlab_ensure_customer_order_confirmation_email', 10, 1 );
function wearlab_ensure_customer_order_confirmation_email( $order_id ) {
	if ( ! $order_id ) {
		return;
	}
	$order = wc_get_order( $order_id );
	if ( ! $order ) {
		return;
	}

	// Avoid duplicate dispatches on page reloads
	$already_dispatched = $order->get_meta( '_wearlab_order_confirmation_dispatched' );
	if ( 'yes' === $already_dispatched ) {
		return;
	}

	if ( function_exists( 'WC' ) && WC()->mailer() ) {
		$mailer = WC()->mailer();
		$emails = $mailer->get_emails();

		// For Cash on Delivery or standard orders, dispatch customer confirmation email
		if ( isset( $emails['WC_Email_Customer_Processing_Order'] ) && $order->has_status( array( 'processing', 'pending', 'on-hold' ) ) ) {
			$emails['WC_Email_Customer_Processing_Order']->trigger( $order_id, $order );
			$order->update_meta_data( '_wearlab_order_confirmation_dispatched', 'yes' );
			$order->save();
		} elseif ( isset( $emails['WC_Email_Customer_On_Hold_Order'] ) ) {
			$emails['WC_Email_Customer_On_Hold_Order']->trigger( $order_id, $order );
			$order->update_meta_data( '_wearlab_order_confirmation_dispatched', 'yes' );
			$order->save();
		}
	}
}

// 7. Ensure WooCommerce 'From' Email matches the store name and domain
add_filter( 'wp_mail_from', 'wearlab_custom_mail_from', 99 );
function wearlab_custom_mail_from( $original_email_address ) {
	if ( empty( $original_email_address ) || false !== strpos( $original_email_address, 'wordpress@' ) ) {
		$host = ! empty( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'wearlab.store';
		return 'orders@' . preg_replace( '/^www\./', '', $host );
	}
	return $original_email_address;
}

add_filter( 'wp_mail_from_name', 'wearlab_custom_mail_from_name', 99 );
function wearlab_custom_mail_from_name( $original_email_from ) {
	return 'WEARLAB';
}



