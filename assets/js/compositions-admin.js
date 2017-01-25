/**
 * Created by autot on 1/24/2017.
 */

jQuery(document).ready(function($){

    var mediaUploader;

    $('#upload-mp3-button').click(function(e) {
        e.preventDefault();
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose MP3',
            button: {
                text: 'Choose MP3'
            }, multiple: false });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#composition_mp3_url').val(attachment.url);
        });
        // Open the uploader dialog
        mediaUploader.open();
    });

    $('#upload-pdf-button').click(function(e) {
        e.preventDefault();
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose PDF',
            button: {
                text: 'Choose PDF'
            }, multiple: false });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#composition_pdf_url').val(attachment.url);
        });
        // Open the uploader dialog
        mediaUploader.open();
    });

});

jQuery(document).ready(function($){
    $('#compositions_date').datepicker();
});
