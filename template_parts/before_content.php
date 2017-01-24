<?php
/**
 * Add Meta Data Before Content of the Composer Post
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

$composer_name = get_post_meta( get_the_ID(), 'compositions_composer_name', true );
$composition_date = get_post_meta( get_the_ID(), 'compositions_composition_date', true );
$embed_code = get_post_meta( get_the_ID(), 'compositions_audio_file', true );

?>

<div class="compositions_author_meta">
    <p>
        <span class="name"><?php echo $composer_name; ?></span> |
        <span class="name"><?php echo $composition_date; ?></span>
    </p>
</div>

<div class="audio-sample">
    <p><?php echo wp_audio_shortcode( array( 'src' => esc_url( $embed_code ) ) ); ?></p>
</div>

<?php
