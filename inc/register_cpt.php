<?php
/**
 * Register our main Compositions CPT
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

if ( ! function_exists('register_compositions_cpt') ) {

// Register Custom Post Type
    function register_compositions_cpt() {

        $labels = array(
            'name'                  => _x( 'Compositions', 'Post Type General Name', 'compositions' ),
            'singular_name'         => _x( 'Composition', 'Post Type Singular Name', 'compositions' ),
            'menu_name'             => __( 'Compositions', 'compositions' ),
            'name_admin_bar'        => __( 'Compositions', 'compositions' ),
            'archives'              => __( 'Compositions', 'compositions' ),
            'attributes'            => __( 'Compositions Attributes', 'compositions' ),
            'parent_item_colon'     => __( 'Parent Composition:', 'compositions' ),
            'all_items'             => __( 'All Compositions', 'compositions' ),
            'add_new_item'          => __( 'Add New Composition', 'compositions' ),
            'add_new'               => __( 'Add Composition', 'compositions' ),
            'new_item'              => __( 'New Composition', 'compositions' ),
            'edit_item'             => __( 'Edit Composition', 'compositions' ),
            'update_item'           => __( 'Update Composition', 'compositions' ),
            'view_item'             => __( 'View Composition', 'compositions' ),
            'view_items'            => __( 'View Compositions', 'compositions' ),
            'search_items'          => __( 'Search Compositions', 'compositions' ),
            'not_found'             => __( 'Not Compositions found', 'compositions' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'compositions' ),
            'featured_image'        => __( 'Featured Image', 'compositions' ),
            'set_featured_image'    => __( 'Set featured image', 'compositions' ),
            'remove_featured_image' => __( 'Remove featured image', 'compositions' ),
            'use_featured_image'    => __( 'Use as featured image', 'compositions' ),
            'insert_into_item'      => __( 'Insert into Composition', 'compositions' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Composition', 'compositions' ),
            'items_list'            => __( 'Compositions list', 'compositions' ),
            'items_list_navigation' => __( 'Items list navigation', 'compositions' ),
            'filter_items_list'     => __( 'Filter items list', 'compositions' ),
        );
        $args = array(
            'label'                 => __( 'Composition', 'compositions' ),
            'description'           => __( 'Display Compositions with relevant composer data and downloadable files', 'compositions' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
            //'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'menu_icon'             => 'dashicons-playlist-audio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => 'compositions',
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'compositions', $args );

    }
    add_action( 'init', 'register_compositions_cpt', 0 );

}