<?php
/**
 * Standalone WordPress Import Script
 *
 * Usage via WP-CLI:
 *   wp eval-file migration/import-to-wordpress.php
 *
 * Or place in WordPress root directory and access via browser/CLI.
 */

if ( ! defined( 'ABSPATH' ) ) {
	// If executed directly, try loading wp-load.php
	$wp_load = dirname( __DIR__ ) . '/wp-load.php';
	if ( file_exists( $wp_load ) ) {
		require_once $wp_load;
	} else {
		die( "Error: Unable to locate wp-load.php. Please run via WP-CLI or place script in WordPress root.\n" );
	}
}

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$json_file = __DIR__ . '/export-blogs.json';
if ( ! file_exists( $json_file ) ) {
	die( "Error: export-blogs.json not found in " . __DIR__ . "\n" );
}

$articles = json_decode( file_get_contents( $json_file ), true );
if ( empty( $articles ) ) {
	die( "Error: export-blogs.json is empty or invalid.\n" );
}

echo "Starting import of " . count( $articles ) . " dispatches...\n";

foreach ( $articles as $item ) {
	$slug = sanitize_title( $item['slug'] );

	// Check for existing post by slug to prevent duplicates
	$existing = get_page_by_path( $slug, OBJECT, 'post' );
	if ( $existing ) {
		echo "[-] Post already exists: {$item['title']} (ID: {$existing->ID})\n";
		continue;
	}

	// Ensure category exists
	$cat_id = 0;
	if ( ! empty( $item['category'] ) ) {
		$term = get_term_by( 'name', $item['category'], 'category' );
		if ( ! $term ) {
			$inserted_term = wp_insert_term( $item['category'], 'category' );
			if ( ! is_wp_error( $inserted_term ) ) {
				$cat_id = $inserted_term['term_id'];
			}
		} else {
			$cat_id = $term->term_id;
		}
	}

	// Insert Post
	$post_data = array(
		'post_title'    => $item['title'],
		'post_name'     => $slug,
		'post_content'  => $item['content'],
		'post_excerpt'  => $item['snippet'],
		'post_status'   => 'publish',
		'post_type'     => 'post',
		'post_category' => $cat_id ? array( $cat_id ) : array(),
		'post_date'     => date( 'Y-m-d H:i:s', strtotime( $item['date'] ) ),
	);

	$post_id = wp_insert_post( $post_data );
	if ( is_wp_error( $post_id ) ) {
		echo "[!] Error inserting post {$item['title']}: " . $post_id->get_error_message() . "\n";
		continue;
	}

	echo "[+] Successfully created post: {$item['title']} (ID: {$post_id})\n";

	// Side-load featured image if URL provided
	if ( ! empty( $item['image'] ) ) {
		$attach_id = media_sideload_image( $item['image'], $post_id, $item['title'], 'id' );
		if ( ! is_wp_error( $attach_id ) ) {
			set_post_thumbnail( $post_id, $attach_id );
			echo "    [i] Attached featured image (Media ID: {$attach_id})\n";
		}
	}
}

echo "Import complete!\n";
