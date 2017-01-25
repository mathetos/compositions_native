<?php
/**
 * Enqueue Admin Assets for Compositions CPT Native
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

add_action( 'admin_enqueue_scripts', 'add_compositions_admin_scripts', 10, 1 );

function add_compositions_admin_scripts( $hook ) {

    global $post;

    wp_register_style( 'compositions_admin-css', COMPOSITIONS_NATIVE_URL . '/assets/css/compositions-admin.css');
    wp_register_style( 'jquery_datepicker', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false, '1.12.1' );
    wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', false, '1.12.1');
    wp_register_script( 'compositions_admin-js', COMPOSITIONS_NATIVE_URL . '/assets/js/compositions-admin.js', true, '1.0');

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'compositions' === $post->post_type ) {
            wp_enqueue_media();

            wp_enqueue_style('thickbox');
            wp_enqueue_style( 'jquery_datepicker' );
            wp_enqueue_style( 'compositions_admin-css' );

            wp_enqueue_script('jquery-ui');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_script('compositions_admin-js');
        }
    }
}

add_action( 'wp_print_scripts', 'compositions_frontend_scripts', 10, 1 );

function compositions_frontend_scripts() {
    wp_register_script( 'compositions_frontend-js', COMPOSITIONS_NATIVE_URL . '/assets/js/compositions-frontend.js', true, '1.0');

    if (is_singular('compositions')) {
        wp_enqueue_script('compositions_frontend-js');
    }
}