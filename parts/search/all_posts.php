<?php 

	global $query_string;
	query_posts( $query_string . '&order=ASC&orderby=title' );

	if ( have_posts() ) : 
	
		popuppigeon_archive_title();
			
		while ( have_posts() ) : the_post(); 

			get_template_part( 'parts/content/content-search' );

		endwhile;

		get_template_part('parts/pagination/pagination');
			
	else :
			
		get_template_part( 'content', 'none' );

	endif;
	
?>