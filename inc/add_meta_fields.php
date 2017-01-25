<?php
/**
 * Add Meta Data to Compositions CPT Native
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

/**
 *  Add Top Metabox
 *
 **/

add_action("add_meta_boxes", "compositions_add_top_meta_box");

function compositions_add_top_meta_box()
{
    add_meta_box("composition-author", "Composition Info", "compositions_top_meta_box_markup", "compositions", "advanced", "high", null);
}

// The Top Metabox Markup

function compositions_top_meta_box_markup()
{
    global $post;

    wp_nonce_field(basename(__FILE__), "compositions-nonce");

    $composer_name_value = get_post_meta($post->ID, "compositions_composer-name", true );

    $composition_date_value = get_post_meta($post->ID, "compositions_composition-date", true );

    $composition_mp3_value = get_post_meta($post->ID, "composition_mp3_url", true );
    ?>

    <div id="compositions_composer-name" class="compositions_metabox_div">
        <label for="compositions_composer-name">Composer Name</label>
        <input name="compositions_composer-name" type="text" value="<?php echo $composer_name_value; ?>">
    </div>

    <div id="compositions_composition-date" class="compositions_metabox_div">
        <label for="compositions_composition-date">Date Composition was Published</label>
        <input name="compositions_composition-date" type="text" value="<?php echo $composition_date_value; ?>" id="compositions_date" class="ll-skin-nigran" style="position: relative; z-index: 100000;">
    </div>

    <div id="composition_mp3" class="compositions_metabox_div wide">
        <label for="composition_mp3_url">Upload Composition PDF</label>
        <input id="composition_mp3_url" type="url" name="composition_mp3_url" value="<?php echo $composition_mp3_value; ?>" />
        <input id="upload-mp3-button" type="button" class="button" value="Upload MP3" />
    </div>

    <?php
}

/**
 *  Add Bottom Metabox
 *
 **/

add_action("add_meta_boxes", "compositions_add_bottom_meta_box");

function compositions_add_bottom_meta_box()
{
    add_meta_box("composition-media", "Composition Media", "compositions_bottom_meta_box_markup", "compositions", "normal", "high", null);
}

function compositions_bottom_meta_box_markup(){

    global $post;

    $composition_pdf_value = get_post_meta($post->ID, "composition_pdf_url", true );

    ?>

    <div id="composition_pdf" class="compositions_metabox_div wide">
        <label for="composition_pdf_url">Upload Composition PDF</label>
        <input id="composition_pdf_url" type="url" name="composition_pdf_url" value="<?php echo $composition_pdf_value; ?>" />
        <input id="upload-pdf-button" type="button" class="button" value="Upload PDF" />
    </div>

<?php }

/**
 * Save Top Metabox Values
 *
 **/
add_action("save_post", "save_compositions_top_metabox", 10, 3);

function save_compositions_top_metabox($post_id, $post, $update)
{
    if ( !isset($_POST["compositions-nonce"] ) || !wp_verify_nonce( $_POST["compositions-nonce"], basename(__FILE__)) )
        return $post_id;

    if( !current_user_can("edit_post", $post_id) )
        return $post_id;

    if( defined("DOING_AUTOSAVE") && DOING_AUTOSAVE )
        return $post_id;

    $slug = "compositions";
    if( $slug != $post->post_type )
        return $post_id;

    $composer_name_value = "";
    $composition_date_value = "";
    $composition_mp3_value = "";
    $composition_pdf_value = "";

    if(isset($_POST["compositions_composer-name"]))
    {
        $composer_name_value = $_POST["compositions_composer-name"];
    }
    update_post_meta($post_id, "compositions_composer-name", $composer_name_value);

    if(isset($_POST["compositions_composition-date"]))
    {
        $composition_date_value = $_POST["compositions_composition-date"];
    }
    update_post_meta($post_id, "compositions_composition-date", strip_tags( $composition_date_value) );

    if(isset($_POST["composition_mp3_url"]))
    {
        $composition_mp3_value = $_POST["composition_mp3_url"];
    }
    update_post_meta($post_id, "composition_mp3_url", strip_tags( $composition_mp3_value) );

    if(isset($_POST["composition_pdf_url"]))
    {
        $composition_pdf_value = $_POST["composition_pdf_url"];
    }
    update_post_meta($post_id, "composition_pdf_url", strip_tags( $composition_pdf_value) );

}


/**
 * Move all "advanced" metaboxes to directly below the title field
 *
 */

add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});
