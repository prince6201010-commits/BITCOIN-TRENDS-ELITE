<?php
/**
 * Bitcoin Trend Elite Theme Functions and Definitions
 *
 * @package Bitcoin_Trend_Elite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function bte_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 750, true );
	add_image_size( 'bte-card', 800, 500, true );
	add_image_size( 'bte-hero', 1600, 1000, true );

	// Register Navigation Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Header Navigation', 'bitcoin-trend-elite' ),
		'footer'  => __( 'Footer Navigation', 'bitcoin-trend-elite' ),
	) );

	// Switch default core markup to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Custom Logo Support
	add_theme_support( 'custom-logo', array(
		'height'      => 44,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
}
add_action( 'after_setup_theme', 'bte_theme_setup' );

/**
 * Enqueue Styles and Scripts
 */
function bte_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Tailwind CSS CDN
	wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=forms,container-queries', array(), null, false );

	// Google Fonts
	wp_enqueue_style( 'bte-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Space+Grotesk:wght@300..700&family=Geist:wght@100..900&family=Inter:wght@400;600;700&display=swap', array(), null );

	// Material Symbols Outlined
	wp_enqueue_style( 'bte-material-symbols', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

	// Main Theme Stylesheet
	wp_enqueue_style( 'bitcoin-trend-elite-style', get_stylesheet_uri(), array(), $theme_version );

	// Canvas Scroll Engine Script (main.js)
	wp_enqueue_script( 'bte-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );
	wp_localize_script( 'bte-main-script', 'BTE_CONFIG', array(
		'themeUrl'  => get_template_directory_uri(),
		'framesUrl' => get_template_directory_uri() . '/assets/frames/',
		'totalFrames' => 210,
	) );

	// Interactive App Connector Script (app.js)
	wp_enqueue_script( 'bte-app-script', get_template_directory_uri() . '/assets/js/app.js', array(), $theme_version, true );
	wp_localize_script( 'bte-app-script', 'BTE_APP', array(
		'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
		'restUrl'  => esc_url_raw( rest_url( 'bte/v1/' ) ),
		'siteName' => get_bloginfo( 'name' ),
		'nonce'    => wp_create_nonce( 'wp_rest' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'bte_enqueue_scripts' );

/**
 * Configure Tailwind inline config in head
 */
function bte_tailwind_head_config() {
	?>
	<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            surface: "#121414",
            "surface-container": "#1e2020",
            "surface-container-low": "#1a1c1c",
            "surface-container-high": "#282a2b",
            "surface-container-highest": "#333535",
            primary: "#ffb874",
            "primary-container": "#f7931a",
            "on-surface": "#e2e2e2",
            "on-surface-variant": "#dbc2ae",
            "outline-variant": "#554335"
          },
          fontFamily: {
            display: ["Playfair Display", "serif"],
            mono: ["Space Grotesk", "sans-serif"],
            body: ["Geist", "Inter", "sans-serif"]
          }
        }
      }
    }
  </script>
	<?php
}
add_action( 'wp_head', 'bte_tailwind_head_config', 2 );

/**
 * Helper: Calculate Read Time for a Post
 */
function bte_get_read_time( $post_id = null ) {
	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( strip_tags( $content ) );
	$minutes    = max( 1, ceil( $word_count / 200 ) );
	return $minutes . ' Min Read';
}

/**
 * Helper: Get Post Featured Image URL with high quality fallback
 */
function bte_get_featured_image_url( $post_id = null, $size = 'bte-card' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		$url = get_the_post_thumbnail_url( $post_id, $size );
		if ( $url ) return $url;
	}
	// Fallback high-res image
	return 'https://lh3.googleusercontent.com/aida-public/AB6AXuB-sTPQESIBdIhICUMh9Ckd08_dxtQklxCVYbhmEL-m3HNhh8T7XSqLCGYPfxiN5ds0wL6Vnw6Zd9_gQoG9vnhTrTw9id_bPO2LOVzM7iw_hsSYOop56XS8P54nNsf75eh31da_wt-uOVyDoyv-a7XHn1qjniIQwCH-ES1_HT4BS9ABBNt7wEIRE_YfqsJYee9kozGMncMUP_3aaO7o3gJvzhqAibd5H_QPlxpFkWhF4c86DsmT9TN1IX-GkByqEALh86c_xLZnv7H3';
}

/**
 * REST API Endpoint: Search Dispatches
 */
function bte_register_rest_routes() {
	register_rest_route( 'bte/v1', '/search', array(
		'methods'  => 'GET',
		'callback' => 'bte_rest_search_callback',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'bte/v1', '/subscribe', array(
		'methods'  => 'POST',
		'callback' => 'bte_rest_subscribe_callback',
		'permission_callback' => '__return_true',
	) );
}
add_action( 'rest_api_init', 'bte_register_rest_routes' );

function bte_rest_search_callback( $request ) {
	$query = sanitize_text_field( $request->get_param( 'q' ) );
	if ( empty( $query ) ) {
		return new WP_REST_Response( array( 'success' => true, 'count' => 0, 'results' => array() ), 200 );
	}

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		's'              => $query,
		'posts_per_page' => 8,
	);

	$wp_query = new WP_Query( $args );
	$results  = array();

	if ( $wp_query->have_posts() ) {
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$categories = get_the_category();
			$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Bitcoin';

			$results[] = array(
				'id'       => get_the_ID(),
				'slug'     => get_post_field( 'post_name', get_the_ID() ),
				'title'    => get_the_title(),
				'category' => $cat_name,
				'snippet'  => wp_strip_all_tags( get_the_excerpt() ),
				'url'      => get_permalink(),
				'image'    => bte_get_featured_image_url( get_the_ID(), 'thumbnail' ),
			);
		}
		wp_reset_postdata();
	}

	return new WP_REST_Response( array(
		'success' => true,
		'query'   => $query,
		'count'   => count( $results ),
		'results' => $results,
	), 200 );
}

function bte_rest_subscribe_callback( $request ) {
	$params = $request->get_json_params();
	$email  = isset( $params['email'] ) ? sanitize_email( $params['email'] ) : '';

	if ( ! is_email( $email ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Please provide a valid email address.',
		), 400 );
	}

	// Store in WordPress option / subscriber list
	$subscribers = get_option( 'bte_editorial_subscribers', array() );
	if ( ! is_array( $subscribers ) ) {
		$subscribers = array();
	}

	if ( in_array( $email, $subscribers, true ) ) {
		return new WP_REST_Response( array(
			'success'           => true,
			'alreadySubscribed' => true,
			'message'           => 'You are already registered in the Editorial Circle.',
		), 200 );
	}

	$subscribers[] = $email;
	update_option( 'bte_editorial_subscribers', $subscribers );

	return new WP_REST_Response( array(
		'success'           => true,
		'alreadySubscribed' => false,
		'message'           => 'Welcome to the Editorial Circle. Dispatch authorization granted.',
		'subscriberCount'   => count( $subscribers ),
	), 200 );
}

/**
 * Ensure default initial categories exist upon theme activation
 */
function bte_create_default_categories() {
	$categories = array( 'Bitcoin', 'News', 'Trends' );
	foreach ( $categories as $cat ) {
		if ( ! category_exists( $cat ) ) {
			wp_insert_term( $cat, 'category' );
		}
	}
}
add_action( 'after_switch_theme', 'bte_create_default_categories' );
