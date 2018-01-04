<style>
<?PHP
	$colour = popuppigeon_hex2rgb(get_post_meta(get_the_ID(), "popuppigeon_post_colour", true));
	$rgba = "rgba(" . $colour[0] . "," . $colour[1] . "," . $colour[2] . ",1)";
?>
.single article .entry-header:before{
	display: inline-block;
	position: relative;
	content: '';
    top: -30px;
    height: 25px;
    left: -12px;
	width: 103%;
	background-size: 25px 25px;
    background-position: -2px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 35%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}

.single article .entry-content:before{
	display: inline-block;
	position: relative;
    content: '';
    top: -45px;
    height: 25px;
    width: 105%;
	left: -17px;
	background-size: 25px 25px;
    background-position: -2px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 35%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}

.single article .entry-header h1{
	color: <?PHP echo $rgba; ?>;
}
</style>
<article id="post-<?php the_ID(); ?>">
	<header class="entry-header" <?PHP echo popuppigeon_get_post_background() ?>>
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'pop-up-pigeon' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pop-up-pigeon' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'pop-up-pigeon' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php popuppigeon_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'pop-up-pigeon' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->