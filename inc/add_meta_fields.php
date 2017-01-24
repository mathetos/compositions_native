<?php
/**
 * Add Meta Data to Compositions CPT
 * Version: 1.0
 * Author: Matt Cromwell
 * Author URI: https://www.mattcromwell.com
 * License: GPLv2
 *
 **/

// Add Top Metabox

add_action("add_meta_boxes", "compositions_add_top_meta_box");

function compositions_add_top_meta_box()
{
    add_meta_box("composition-author", "Composition Info", "compositions_top_meta_box_markup", "compositions", "advanced", "high", null);
}

function compositions_top_meta_box_markup()
{
    global $post;

    wp_nonce_field(basename(__FILE__), "compositions-nonce");
    $composer_name_value = get_post_meta($post->ID, "compositions_composer-name", true );
    $composition_date_value = get_post_meta($post->ID, "compositions_composition-date", true );
    ?>
    <script>
        jQuery(document).ready(function($){
            $('#compositions_date').datepicker();
        });
    </script>

    <div id="compositions_composer-name" class="compositions_metabox_div">
        <label for="compositions_composer-name">Composer Name</label>
        <input name="compositions_composer-name" type="text" value="<?php echo $composer_name_value; ?>">
    </div>

    <div id="compositions_composition-date" class="compositions_metabox_div">
        <label for="compositions_composition-date">Date Compoition was Published</label>
        <input name="compositions_composition-date" type="text" value="<?php echo $composition_date_value; ?>" id="compositions_date" class="ll-skin-nigran" style="position: relative; z-index: 100000;">
    </div>
    <?php
}

// Save Top Metabox
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

}


// Move all "advanced" metaboxes to directly below the title field
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});

add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

function add_admin_scripts( $hook ) {

    global $post;
    wp_register_style( 'compositions_admin-css', COMPOSITIONS_NATIVE_URL . '/assets/css/compositions-admin.css');
    wp_register_style( 'jquery_datepicker', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false, '1.12.1' );
    wp_register_script( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', false, '1.12.1');


    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'compositions' === $post->post_type ) {
            wp_enqueue_script('jquery-ui');
            wp_enqueue_style( 'jquery_datepicker' );
            wp_enqueue_style( 'compositions_admin-css' );
        }
    }
}