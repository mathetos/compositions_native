<?php
/**
 * Add Meta Data Before Content of the Composer Post
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/
global $post;
$download_mp3 = get_post_meta( get_the_ID(), 'compositions_audio_file', true );
$download_pdf = get_post_meta( get_the_ID(), 'compositions_pdf_file', true );

?>
<script>
    jQuery(document).ready(function( $ ) {
        var a = document.createElement('a');
        if (typeof a.download == "undefined") {
            //append some text to inform the user
            //they should right-click the link to download
            //example:
            var downloadDiv = document.getElementById('download');
            downloadDiv.innerHTML = "Right-click the link and select 'Save as...' to download the mp3";

        }
    });

</script>
<div>
    <a class="mp3download" href="<?php echo esc_url( $download_mp3 ); ?>" download="<?php echo get_the_title($post->ID); ?>" style="background: #777; color: white; padding: 12px; border-radius: 4px; display: inline;">Download mp3</a>

    <a class="pdfdownload" href="<?php echo esc_url( $download_pdf ); ?>" download="<?php echo get_the_title($post->ID); ?>" style="background: #777; color: white; padding: 12px; border-radius: 4px; display: inline;">Download PDF</a>

    <div id="download"></div>

</div>