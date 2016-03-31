/**
 * ajax.js
 *
 * Custom JavaScript managing the adding and removing of spirits from users
 *
 */

// THIS WORKS, BUT NOT DYNAMIC
jQuery(document).on('click', '#addSpiritButton', function() {
    
    var post_id = jQuery(this).val();

    jQuery.ajax({
        url : add_spirit.ajax_url,
        type : 'post',
        data : {
            action : 'add_spirit_add',
            post_id : post_id
        },
        beforeSend : function() {
            // Disable the button as data is transferred
            jQuery(document).off('click', '#addSpiritButton');
        },
        success : function( response ) {
            // SHow user congrats message
            jQuery('#textHint').html( response );
            
            // Update the submit button
            jQuery('#addSpiritButton').html( 'Remove from cabinet');

            // Need the click event back but with the "Remove" functionality
            //
        },
        error: function(xhr) { // if error occured
            // Show error message if unsuccessful
            alert('Error occured. Please try again!');
        },
        complete: function() {
            // Hide message after a few seconds
            jQuery('#textHint').show(0).delay(3000).hide(0);
        }
    })
});


// DOESN"T GET THE RIGHT POST_ID
/*
jQuery(document).on('click', '#addSpiritButton', add_spirit );

function add_spirit( event ) {
    
    var post_id = jQuery( event.target ).val();

    jQuery.ajax({
        url : add_spirit.ajax_url,
        type : 'post',
        data : {
            action : 'add_spirit_add',
            post_id : post_id
        },
        success : function( response ) {
            jQuery('#textHint').html( response );
            jQuery('#addSpiritButton').html( 'Remove from cabinet');

            jQuery(document).off('click', '#addSpiritButton', add_spirit );
            jQuery(document).on('click', '#addSpiritButton', remove_spirit );
        }
    })
}

function remove_spirit( event ) {
    
    var post_id = jQuery( event.target ).val();

    jQuery.ajax({
        url : add_spirit.ajax_url,
        type : 'post',
        data : {
            action : 'add_spirit_remove',
            post_id : post_id
        },
        success : function( response ) {
            jQuery('#textHint').html( response );
            jQuery('#addSpiritButton').html( 'Add to my cabinet');

            jQuery(document).on('click', '#addSpiritButton', add_spirit );
            jQuery(document).off('click', '#addSpiritButton', remove_spirit );
        }
    })
}
*/
