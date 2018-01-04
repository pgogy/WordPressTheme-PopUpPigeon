	</div><!-- .site-content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer-content">
			<?PHP
				get_sidebar("sidebar-bottom");
			?>
		</div>
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>
<script>

	jQuery(document)
		.ready(
			function(){
				
				height = jQuery(document).height() + "px";
				
				<?PHP
					$hex = pop-up-pigeon_hex2rgb(get_theme_mod('page_border_colour'));
				?>
	
				jQuery("head").append("<style>html:before{position: absolute;content: '';top: 0px;left: 5%;height: " + height + ";width: 15px;background-size: 15px 15px;background-position: -1px 0px;background-image: -webkit-radial-gradient(50% 50%, circle, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 35%, transparent 50%);background-image: -moz-radial-gradient(50% 50%, circle, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 50%, transparent 50%);background-image: radial-gradient(circle at 50% 50%, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 50%, transparent 50%);}</style>");
				jQuery("head").append("<style>html:after{position: absolute;content: '';top: 0px;left: 95%;height: " + height + ";width: 15px;background-size: 15px 15px;background-position: -1px 0px;background-image: -webkit-radial-gradient(50% 50%, circle, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 35%, transparent 50%);background-image: -moz-radial-gradient(50% 50%, circle, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 50%, transparent 50%);background-image: radial-gradient(circle at 50% 50%, rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1) 50%, transparent 50%);}</style>");
			
		}
	);

</script>
</body>
</html>
