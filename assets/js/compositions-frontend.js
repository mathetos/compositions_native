/**
 * Created by autot on 1/24/2017.
 */

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
