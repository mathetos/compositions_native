<?php
/**
 * Adds Custom Meta Date to the Compositions CPT
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

add_filter('the_content', 'compositions_before_after');

function compositions_before_after( $content ) {

    if( is_singular('compositions') ) {

        ob_start();
            $beforecontent = compositions_load_before_content();
            echo $content;
            $aftercontent = compositions_load_after_content();
        $fullcontent = ob_get_contents();

        ob_end_clean();

    } else {
        $fullcontent = $content;
    }

    return $fullcontent;
}

function compositions_load_before_content() {
    if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/template_parts/before_content.php' ) )
        include( COMPOSITIONS_NATIVE_DIR . '/template_parts/before_content.php' );
}

function compositions_load_after_content() {
    if ( file_exists(  COMPOSITIONS_NATIVE_DIR . '/template_parts/after_content.php' ) )
        include( COMPOSITIONS_NATIVE_DIR . '/template_parts/after_content.php');
}
