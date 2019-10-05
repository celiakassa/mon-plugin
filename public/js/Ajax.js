(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	   $(document).ready(function(){

	   		$('form').submit(function(event){
	   			event.preventDefault();
	   			var formData= $('form').serializeArray();
	   			$.post(
	   				ajax_object.ajax_url,
	   				{
	   					action : 'monpost',
	   					data : formData,
	   				},function(answer){
	   					//alert(answer);
	   					//print_r(answer);
	   			        alert('post bien enrégistré');
	   			        console.log(answer);
	   				})
	   					.fail(function(response){
	   					   alert('il y a un problème');
	   					});		
	   		});
                   
            /*- function displayImage(e){
                 if (e.files[0]){
                  var reader= new FileReader();
                   reader.onload= function(e){
                   document.querySelector("#profileDisplay").setAttribute("src",e.target.result);
            }
            reader.readAsDataURL(e.file[0]);
        }
    }  */        
                });

})( jQuery );
