<?php
/* 
* rt-theme slider
*/
global $slides, $rttheme_slider_height, $crop_slider_images, $resize_slider_images,$slider_effect,$slider_timeout,$slider_buttons,$group_id,$sidebar,$this_item_layout,$rttheme_slider_width;

#
#	uniqueness
#
$slider_unique_name 	= $group_id."_slider";
$slider_buttons_name 	= $group_id."_slider_buttons";

#
#	slider heights
#
$rttheme_slider_width = $rttheme_slider_width -22; //cycle needs 22px padding

$css 		= 'style="height:'.$rttheme_slider_height.'px !important;width:'.$rttheme_slider_width.'px !important;"';
$theme_uri 	= THEMEURI;

echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */
		jQuery(document).ready(function(){
		
			jQuery('.$slider_unique_name').cycle({ 
				fx:     			'$slider_effect',  // Effect 
				timeout:  		$slider_timeout*1000,  // Timeout value (ms) 
				easing: 			'backout', 
				pager:  			'#$slider_buttons_name', 
				cleartype:  		1,
				after:   			onAfter,
				before:  			onBefore,
				pause:           	true,     // true to enable "pause on hover"
				pauseOnPagerHover: 	true,   // true to pause when hovering over pager link					
				pagerAnchorBuilder: function(idx) { 
					return '<a href="#" title=""><img src="$theme_uri/images/pixel.gif" width="8" heigth="8"></a>'; 
				}
			});
		});
	/* ]]> */	
	</script>
SCRIPT;
?>

<div class="home_slider_background">
<!-- Slider -->	
 <div class="slider">
	<div class="slider_area <?php echo $slider_unique_name; ?> cycle" <?php echo $css;?>>

		<?php
		query_posts($slides); 

		$slider_image_width		= ($resize_slider_images) ? ($sidebar=="full" ) ? 918 : 668 : 100000; //kwicks max slide width
		$slider_image_height	= ($resize_slider_images && $crop_slider_images) ? $rttheme_slider_height : 100000; 		
		$background_images		= "";
		
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		
		$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
		$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
		$title = get_the_title();
		$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
		$thumb = get_post_thumbnail_id(); 
		$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );		  
		?>
		
		<!-- slide -->
		<div class="slide"  <?php echo $css;?>>
			
			<?php if($hide_title_and_text):?>
				<!-- slide description -->
				<div class="desc">
					<div class="pattern_bg"><div class="transparent_bg">
						<!-- title -->
						<div class="title"><h3>
						    <?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php else:?><span><?php endif;?>
								<?php echo $title; ?>
						    <?php if($custom_link):?></a><?php else:?></span><?php endif;?></h3>
						</div>
						<!-- text -->
						<div class="text">
						    <!-- slide text -->
						    <?php echo $slide_text; ?>
						</div>
					</div></div>
				</div>
				<!-- /slide description -->
			<?php endif;?>
			
			<!-- slide right-side image -->
			<img src="<?php echo $image["url"];?>" alt="<?php echo $title; ?>" />
			<!-- /slide right-side image -->
			
		</div>
		<!--/ slide -->

		<?php 
		endwhile;endif;?>  	 
	</div>
	
	<?php if($slider_buttons):?>
		<!-- slider buttons -->
		<div id="<?php echo $slider_buttons_name;?>" class="numbers"></div>
	<?php endif;?>
</div>
</div>
<div class="clear"></div>
<?php wp_reset_query();?> 