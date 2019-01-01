import { tat } from 'tat-js';

var bangMeta = {

	init: function() {
		
		jQuery(document).ready(function() { 
			jQuery('.js-sortable tbody').sortable({ handle: ".handle" });
		});
		
		this.metaImgListeners();
		
/*
		jQuery('#postcustomstuff tbody').on('rowAdded', function(event) {
			metaBoxImgListeners();
		});
*/
		
	},
	
	metaImgListeners: function() {
		
		let handles = document.querySelectorAll('.js-upload-meta-img');
		if (handles) {
			Array.from(handles).forEach(handle => {
				handle.addEventListener('click', bangMeta.metaImgUpload);	
			});
		}
		
		let handels = document.querySelectorAll('.delete-meta-img');
		if (handels) {
			Array.from(handels).forEach(handel => {
				handel.addEventListener('click', bangMeta.metaImgDelete);	
			});
		}
		
	},
	
	metaImgUpload: function(event) {
				
		event.preventDefault();
    
	    var frame;
	    var metaBox = jQuery(this).closest('.meta-img-field');
	    var addImgLink = metaBox.find('.upload-meta-img');
	    var delImgLink = metaBox.find( '.delete-meta-img');
	    var imgContainer = metaBox.find( '.meta-img-container');
	    var imgIdInput = metaBox.find( '.meta-img-id' );
	    var postID = metaBox.data('postid'); 
	    
	    // If the media frame already exists, reopen it.
	    if ( frame ) {
	      frame.open();
	      return;
	    }
	    
	    // Create a new media frame
	    frame = wp.media({
	      title: 'Select or Upload Media',
	      button: {
	        text: 'Use this media'
	      },
	      multiple: false,  // Set to true to allow multiple files to be selected
	      library: {
	                type: 'image',
	                post_parent: postID // some post id
	            }
	    });
	
	    
	    // When an image is selected in the media frame...
	    frame.on( 'select', function() {
	      
	      // Get media attachment details from the frame state
	      var attachment = frame.state().get('selection').first().toJSON();
	
	      // Send the attachment URL to our custom image input field.
	      imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-height:50px; width: auto;" />' );
	
	      // Send the attachment id to our hidden input
	      imgIdInput.val( attachment.id );
	
	      // Hide the add image link
	      addImgLink.addClass( 'hidden' );
	
	      // Unhide the remove image link
	      delImgLink.removeClass( 'hidden' );
	    });
	
	    // Finally, open the modal on click
	    frame.open();
	
	},
	
	metaImgDelete: function(event) {
	
		event.preventDefault();

		var metaBox = jQuery(this).closest('.meta-img-field');
	    var addImgLink = metaBox.find('.upload-meta-img');
	    var delImgLink = metaBox.find( '.delete-meta-img');
	    var imgContainer = metaBox.find( '.meta-img-container');
	    var imgIdInput = metaBox.find( '.meta-img-id' );
	    
	    // Clear out the preview image
	    imgContainer.html( '' );
	
	    // Un-hide the add image link
	    addImgLink.removeClass( 'hidden' );
	
	    // Hide the delete image link
	    delImgLink.addClass( 'hidden' );
	
	    // Delete the image id from the hidden input
	    imgIdInput.val( '' );
		
	}
	
}

bangMeta.init();
