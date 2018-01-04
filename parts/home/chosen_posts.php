<?php 

	$ids = explode(" ", get_theme_mod("front_page_posts_list"));
	$ids = array_splice($ids,0,$wp_query->post_count);
	
	foreach($ids as $id){
		$post = get_post($id);
		get_template_part( 'parts/content/content-index', get_post_format() );
	}

?>