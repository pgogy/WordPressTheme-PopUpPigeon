<style>
<?PHP
	$colour = popuppigeon_hex2rgb(get_post_meta(get_the_ID(), "popuppigeon_post_colour", true));
	$rgba = "rgba(" . $colour[0] . "," . $colour[1] . "," . $colour[2] . ",1)";
?>
.author <?PHP echo "#post-" . get_the_ID(); ?> div.category-entry:before{
	position: absolute;
    content: '';
    top: 125px;
    height: 25px;
    width: 100%;
    background-size: 25px 25px;
    background-position: -2px 0px;
    background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
    background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class("home-page"); ?>>
	<div class='category-picture' <?PHP echo popuppigeon_get_post_background() ?>>
	</div>
	<div class='category-entry'>
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?PHP echo get_permalink(); ?>" rel="bookmark"><?PHP echo the_title(); ?></a>
			</h2>
		</header><!-- .entry-header -->
	</header><!-- .entry-header -->
</article><!-- #post-## -->