(function( $ ) {
	'use strict';
    jQuery(document).ready(function($) {
        jQuery("#amount_placeholder").click(function() {
            var $txt = jQuery("#txt");
            var caretPos = $txt[0].selectionStart;
            var textAreaTxt = $txt.val();
            var txtToAdd = "[%interest_saving%]";
            $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
        });
    });

})( jQuery );
