<style>
<?PHP
	$colour = popuppigeon_hex2rgb(get_post_meta(get_the_ID(), "popuppigeon_post_colour", true));
	$rgba = "rgba(" . $colour[0] . "," . $colour[1] . "," . $colour[2] . ",1)";
?>
.page article .entry-header:before{
	position: absolute;
    content: '';
    top: 32px;
    height: 25px;
    left: 34%;
	width: 55.5%;
	background-size: 25px 25px;
    background-position: -2px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 35%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}

.page article .entry-content:before{
	display: inline-block;
	position: relative;
    content: '';
    top: -30px;
    height: 25px;
    width: 105%;
	left: -17px;
	background-size: 25px 25px;
    background-position: -2px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 35%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}

.page article .entry-header h1{
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
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php popuppigeon_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'pop-up-pigeon' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->