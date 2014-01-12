<?php
/* 
* rt-theme nivo slider
*/
global $slides, $rttheme_slider_height, $crop_slider_images, $resize_slider_images,$slider_effect,$slider_timeout,$slider_buttons,$group_id,$sidebar;

#
#	uniqueness
#
$slider_unique_name 	= $group_id."_slider";
$slider_buttons_name 	= $group_id."_slider_buttons";

echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */
		jQuery(document).ready(function(){
    
	    if (jQuery('#$slider_unique_name').length>0){
		   jQuery('#$slider_unique_name').nivoSlider({ 
				pauseTime:$slider_timeout*1000, // How long each slide will show	
				captionOpacity:1,
				controlNav: false 	  
		    });
	    }
		});
	/* ]]> */	
	</script>
SCRIPT;

?>

<?php if(!get_option("rttheme_remove_slider")): ?>
<div class="home_slider_background">
<div id="slider_area" class="nivo">    
<div class="slider-wrapper nivo"> 
<div id="<?php echo $slider_unique_name;?>" class="nivoSlider">
	 
	
		<?php
	 
 
		query_posts($slides); 
	 
		$slider_image_width		= ($resize_slider_images) ? ($sidebar=="full") ? 918 : 668 : 100000; //max slider width
		$slider_image_height	= ($resize_slider_images && $crop_slider_images) ? $rttheme_slider_height : 100000;
		
		$background_images="";
		$captions=""; 
		$hide_title_and_text = ""; 
		$custom_link = "";	
		$title = "";
		$slide_text = "";
		$thumb = ""; 
		$image = "";	


		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
			$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
			$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
			$title = get_the_title();
			$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
			$thumb = get_post_thumbnail_id(); 
			$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );		  
	 
			if (!get_post_meta($post->ID, 'rt_hide_titles', true)):
				$nivo_title = '#slide_'.$post->ID.'_caption';
				$nivo_alt  = trim(strip_tags($title));
			else:
				$nivo_title = '';
				$nivo_alt  = trim(strip_tags($title));
			endif;
			?>			
			
			<?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
				<!-- slide image -->
				<img src="<?php echo $image["url"];?>" alt="<?php echo $nivo_alt; ?>" width="640" height="<?php echo $rttheme_slider_height;?>" title="<?php echo $nivo_title;?>" />
				<!-- /slide image -->
			<?php if($custom_link):?></a><?php endif;?>
			
			  
			<?php
			if ($hide_title_and_text):
							
				$captions.='<div id="slide_'.$post->ID.'_caption" class="nivo-html-caption"><div class="transparent_bg"><div class="pattern_bg"><div class="text_holder">'."\n";  
				if($custom_link) : $captions.='<div class="nivo-title">'."\n"; else: $captions.='<div class="nivo-title no-link">'."\n"; endif;
				$captions.='<h3 class="nocufon">';
				if($custom_link)  $captions.='<a href="'.$custom_link.'" title="'.$title.'">'."\n"; 
				$captions.= $title."\n"; 
				if($custom_link) $captions.='</a>'."\n";
				$captions.='</h3>';
				$captions.= "</div>\n"; 
				if($slide_text) $captions.= '<div class="nivo-text">'.$slide_text.'</div>'."\n"; 
				$captions.='</div></div></div></div>'."\n";
	
			endif;
			?>         
		 
		<?php endwhile;endif;?> 

		</div>

	<!-- captions  -->
	<?php echo $captions;?>
	<!-- /captions -->
	

</div> 
</div>
</div>
<div class="clear"></div>
<?php endif;wp_reset_query();?> 