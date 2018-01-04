<style>
<?PHP

	$term = get_cat_id( single_cat_title("",false) );
	$color = get_option( 'popuppigeon_' . $term . '_colour');
	$colour = popuppigeon_hex2rgb($color);
	$rgba = "rgba(" . $colour[0] . "," . $colour[1] . "," . $colour[2] . ",1)";
?>
.archive .page-title:after{
	display: inline-block;
	position: relative;
    content: '';
    top: 0px;
    height: 25px;
    width: 105%;
	left: -17px;
	background-size: 25px 25px;
    background-position: 0px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 35%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}

.archive .page-title h1{
	color: <?PHP echo $rgba; ?>;
}
</style>
<?php 

	if ( have_posts() ) :

	popuppigeon_archive_title();

	?><div id="masonry-loop"><?PHP

	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content/content-author');

	endwhile;
	
	?></div><?PHP
	
	get_template_part('parts/pagination/pagination');
	
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	
	popuppigeon_tag_cloud(_x("Tag Cloud","tag cloud","pop-up-pigeon"), popuppigeon_posts_content("author", $author->ID));

	popuppigeon_featured_posts_content("author", $author->ID);
	
else :

	get_template_part( 'content', 'none' );

endif;

?>