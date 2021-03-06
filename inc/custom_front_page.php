<?php

class popuppigeonCustomFrontPage extends WP_Customize_Control
{
    public $type = 'textarea';

    public function __construct($manager, $id, $args = array())
    {
        parent::__construct($manager, $id, $args);
    }

    public function enqueue()
    {
        wp_enqueue_style( 'popuppigeon-customizer-draggable', get_template_directory_uri() . '/css/customizer/customizer.css' );
        wp_enqueue_script("jquery-ui-sortable", array('jquery'));
    }
	
    public function render_content()
    {
	
	    ?><input type="text" value="<?php echo $this->value(); ?>" <?php $this->link(); ?> id="front_page_posts_list" /><?PHP
		$data = $this->value();
		$ids = explode(" ", trim($data));
		$ids = array_filter($ids);
		$excludes = array();
		
		$query_posts_args = array( 'post_type' => array('page','post'), 'post_status' => 'publish' );	

		$query_posts = new WP_Query( $query_posts_args );
	
		?>
		<div class="scroll"><ul id='pppsortable'><?PHP
	
	
		foreach ( $ids as $post) {
			$post = get_post($post);
			if(isset($post->ID)){
				array_push($excludes, $post->ID);
				echo "<li page_id='" . $post->ID . "'>Title : " . $post->post_title . "<b class='pppright ppptop'>Top</b>  <b class='pppright pppend'>Bottom</b></li>";
			}
		}
		
		foreach ( $query_posts->posts as $post) {
			if(isset($post->ID)){	
				if(!in_array($post->ID, $excludes)){
					echo "<li page_id='" . $post->ID . "'>Title : " . $post->post_title . " <b class='pppright ppptop'>Jump</b>  <b class='pppright pppend'>Bottom</b></li>";
				}
			}
		}
		?></ul></div>
			<script type="text/javascript">
				jQuery(document).keydown(function(ev) {
					console.log(ev);
				});
				jQuery( ".ppptop" )
					.each(
						function(index, value){
							jQuery(value)
								.on("click", function(event){
										jQuery(event.currentTarget)
											.parent()
											.parent()
											.prepend(jQuery(event.currentTarget).parent());
										list = "";
										jQuery( "#pppsortable" )
											.children()
											.each(
												function(index, value){
													if(jQuery(value).attr("page_id")!=undefined){
														list += jQuery(value).attr("page_id") + " ";
													}
												}
											);
										jQuery("#front_page_posts_list")
											.val(list);
										var e = jQuery.Event("change");	
										jQuery("#front_page_posts_list")
											.trigger(e);
											
									}
								);
						}
					);
				jQuery( ".pppend" )
					.each(
						function(index, value){
							jQuery(value)
								.on("click", function(event){
										jQuery(event.currentTarget)
											.parent()
											.parent()
											.append(jQuery(event.currentTarget).parent());
										list = "";
										jQuery( "#pppsortable" )
											.children()
											.each(
												function(index, value){
													if(jQuery(value).attr("page_id")!=undefined){
														list += jQuery(value).attr("page_id") + " ";
													}
												}
											);
										jQuery("#front_page_posts_list")
											.val(list);
										var e = jQuery.Event("change");	
										jQuery("#front_page_posts_list")
											.trigger(e);
									}
								);
						}
					);	
				jQuery( "#pppsortable" ).disableSelection();	
				jQuery( "#pppsortable" )
					.sortable({
						hoverClass: "sortable-ui-state-hover",
						stop: function( event, ui ) {
							list = "";
							jQuery( "#pppsortable" )
								.children()
								.each(
									function(index, value){
										if(jQuery(value).attr("page_id")!=undefined){
											list += jQuery(value).attr("page_id") + " ";
										}
									}
								);
							jQuery("#front_page_posts_list")
								.val(list);
							var e = jQuery.Event("change");	
							jQuery("#front_page_posts_list")
								.trigger(e);								
						}
					}
				);
			</script>		
		<?PHP
    }
	
    protected function theTitle()
    {
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>
        </label>
        <?php
    }
	
    protected function getImages()
    {
        $options = $this->value();
        if (!isset($options['image_sources'])) {
            return '';
        }
        return $options['image_sources'];
    }
	
    public function theButtons()
    {
        ?>
        <div>
            <input type="hidden" value="<?php echo $this->value(); ?>" <?php $this->link(); ?> class="multi-images-control-input"/>
            <a href="#" class="button-secondary multi-images-upload">
                <?php echo 'Upload'; ?>
            </a>
            <a href="#" class="button-secondary multi-images-remove">
               <?php echo 'Remove all images'; ?>
           </a>
       </div>
       <?php
   }
   
   public function theUploadedImages($srcs = array())
   {
    ?>
    <div class="customize-control-content">
        <ul class="thumbnails">
            <?php if (is_array($srcs)): ?>
                <?php foreach ($srcs as $src): ?>
                    <?php if ($src != ''): ?>
                        <li class="thumbnail" style="background-image: url(<?php echo $src; ?>);" data-src="<?php echo $src; ?>" >
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?> 
            <?php endif; ?>
        </ul>
    </div>
    <?php
	}
}