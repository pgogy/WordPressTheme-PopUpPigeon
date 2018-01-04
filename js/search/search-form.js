jQuery(document).ready(
	function(){
		jQuery(".muqaddimah_search_box")
			.on("focus", function(event){
					jQuery(event.target).attr("value","");
				}
			);
	}
);