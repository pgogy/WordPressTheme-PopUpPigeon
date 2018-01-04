jQuery(document).ready(
	function(){
		if(jQuery("#masonry-loop").length!=0){

			var container = document.querySelector('#masonry-loop');
			//create empty var msnry
			var msnry;
			// initialize Masonry after all images have loaded
			imagesLoaded( container, function() {
				msnry = new Masonry( container, {
					itemSelector: '.masonry-entry'
				});
			});

		}
	
	}
);
