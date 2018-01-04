<?php 

	$post_categories = get_categories( array('exclude' => get_option("popuppigeon_featured")) );
	$cats = array();
		
	foreach($post_categories as $c){
		$cat = get_category( $c );
		?><style>
			<?PHP
				$colour = popuppigeon_hex2rgb(get_option( 'popuppigeon_' . $c->term_id . '_colour'));
				$rgba = "rgba(" . $colour[0] . "," . $colour[1] . "," . $colour[2] . ",1)";
			?>
			.home <?PHP echo "#category-" . $c->term_id; ?> div.home-entry:before{
				position: absolute;
				content: '';
				top: 108px;
				left: 0px;
				height: 25px;
				width: 100%;
				background-size: 25px 25px;
				background-position: -2px 0px;
				background-image: -webkit-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
				background-image: -moz-radial-gradient(50% 50%, circle, <?PHP echo $rgba; ?> 50%, transparent 50%);
				background-image: radial-gradient(circle at 50% 50%, <?PHP echo $rgba; ?> 50%, transparent 50%);
			}

			</style>
			<article id="category-<?php echo $c->term_id; ?>" <?php post_class("home-page masonry-entry"); ?>>
				<div class='home-picture' style="<?PHP echo popuppigeon_category_thumbnail_background($c->term_id); ?>">
				</div>
				<div class='home-entry'>
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?PHP echo get_category_link($c); ?>">
								<?PHP echo $cat->name; ?>
							</a>
						</h2>
					</header><!-- .entry-header -->
				</div>
			</article><!-- #post-## --><?PHP
	}
	
?>