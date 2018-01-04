<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<?PHP
	get_template_part( 'parts/header/main');
?>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="header-area" class="sidebar sidebar-centre">
			<header id="masthead" class="site-header" role="banner">
				<div>
					<?php if ( get_header_image() ) : ?>
						<div id="site-header" style="background:url('<?php header_image(); ?>');">
						</div>
					<?php endif; ?>
				</div>
				<div id='site-name' class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?PHP echo get_bloginfo('name'); ?></a></h1>
					<h2 class="site-description"><?PHP echo get_bloginfo('description'); ?></h2>
				</div><!-- .site-branding -->
			</header><!-- .site-header -->
			<?PHP
				
				get_template_part( 'parts/header/menu/standard'); 
			
			?>
			<div id="sidebar-left">
				<?php get_sidebar( 'sidebar-left' ); ?>
			</div>
		</div>
		<div id="content" class="site-content">
