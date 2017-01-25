<?php
/**
  * Plugin Name: Compositions CPT with Native Metaboxes
  * Plugin URI: https://www.mattcromwell.com/custom-meta-box-comparison
  * Description: A simple Custom Post Type to display musical compositions, done with CMB2. This was created as a comparison of several popular Custom MetaBox libraries.
  * Author: Matt Cromwell
  * Version: 1.0
  * Author URI: https://www.mattcromwell.com
  * Text Domain: compositions
  * Domain Path: /languages
  *
 **/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Defines Addon directory for easy reference
if ( ! defined( 'COMPOSITIONS_NATIVE_DIR' ) ) {
    define( 'COMPOSITIONS_NATIVE_DIR', dirname(__FILE__) );
}
if ( ! defined( 'COMPOSITIONS_NATIVE_URL' ) ) {
    define('COMPOSITIONS_NATIVE_URL', plugin_dir_url(__FILE__));
}

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */

add_action( 'init', 'compositions_load_textdomain' );

function compositions_load_textdomain() {
    load_plugin_textdomain( 'compositions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Register CPT
 */
if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/inc/register_cpt.php' ) )
    require_once  COMPOSITIONS_NATIVE_DIR . '/inc/register_cpt.php';

/**
 * Add Meta Fields Compositions CPT
 */
if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/inc/add_meta_fields.php' ) )
    require_once  COMPOSITIONS_NATIVE_DIR . '/inc/add_meta_fields.php';

/**
 * Add Metadata to Compositions CPT
 */
if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/inc/add_meta_to_post.php' ) )
    require_once  COMPOSITIONS_NATIVE_DIR . '/inc/add_meta_to_post.php';

/**
 * Enqueue Admin Assets
 */
if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/assets/enqueue-assets.php' ) )
    require_once  COMPOSITIONS_NATIVE_DIR . '/assets/enqueue-assets.php';
