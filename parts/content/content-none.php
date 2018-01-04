<article id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<h1 class="entry-title">
			<?PHP
				echo sprintf(
					 __( 'Sorry, Nothing found for %s', 'pop-up-pigeon' ), $_GET['s']
				);
			?>
		</h1>
	</header>
	<div class="entry-content">
		<p><?PHP echo __( 'Search again?', 'pop-up-pigeon' ); ?></p>
		<?PHP get_search_form(); ?>
	</div>
</article><!-- #post-## -->
