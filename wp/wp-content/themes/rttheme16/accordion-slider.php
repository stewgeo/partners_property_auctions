<?php
/* 
* rt-theme accordion slider
*/
global $slides, $rttheme_slider_height, $crop_slider_images, $resize_slider_images,$group_id,$sidebar;


#
#	slider heights
#
	
$kw_holder 	= $rttheme_slider_height + 22;
$kw_holder 	= 'style="height:'.$kw_holder.'px"';
$kw_li		= $rttheme_slider_height + 20;
$kw_li		= 'style="height:'.$kw_li.'px"';
$kw_images	= $rttheme_slider_height;
$kw_images	= 'style="height:'.$kw_images.'px"';
$kw_desc		= $rttheme_slider_height * (0.19);
$kw_desc		= 'style="top:'.$kw_desc.'"'; 


#
#	uniqueness
#
$slider_unique_name 	= $group_id."_slider";
$slider_buttons_name 	= $group_id."_slider_buttons";

$SlideWidth = $sidebar=="full" ? 940 : 689;
$max_single = $sidebar=="full" ? 700 : 500;

echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */
		jQuery(document).ready(function(){
    
				//size of the slides
				var SlideCount = jQuery('#$slider_unique_name li').length; 
				
				//width of slides
				var SlideWidth = ( $SlideWidth - ((SlideCount-1)*20) ) / SlideCount;
				jQuery('#$slider_unique_name li').css( 'width', SlideWidth+"px" );
				
				//extend kwicks
				jQuery('#$slider_unique_name li').rt_accordion_effect();
				
				//start kwicks
				if (jQuery('#$slider_unique_name li').length>1){
				    
				    jQuery('#$slider_unique_name').kwicks({
					    max : $max_single,
					    spacing : 20,
					    duration: 500
				    }); 
				
				}
		});
	/* ]]> */	
	</script>
SCRIPT;
?>

 
<?php if(!get_option("rttheme_remove_slider")): ?>
<div class="home_slider_background">
<div class="slider_area accordion_slider">    
		
		<ul id="<?php echo $slider_unique_name;?>" class="kwicks"  <?php echo $kw_holder;?>>

		<?php 
		
		$slider_image_width		= ($resize_slider_images) ? $max_single : 100000; //kwicks max slide width
		$slider_image_height	= ($resize_slider_images) ? $rttheme_slider_height : 100000; 
   
		query_posts($slides);
		$image_list="";
		
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
			$hide_title_and_text = get_post_meta($post->ID, THEMESLUG.'hide_titles', true); 
			$custom_link = get_post_meta($post->ID, THEMESLUG.'custom_link', true);	
			$title = get_the_title();
			$slide_text = get_post_meta($post->ID, THEMESLUG.'slide_text', true);
			$thumb = get_post_thumbnail_id(); 
			
			$image = @vt_resize( $thumb, '', $slider_image_width, $slider_image_height, $crop_slider_images );
			
			$accordion_ID= $slider_unique_name.'kwicks-image-'.$post->ID;
			$altText  = trim(strip_tags($title));
			$titleHTML =  ($custom_link) ? '<div class="title cufon"><a href="'.$custom_link.'" title="'.$title.'">'.$title.'</a></div>' : '<div class="title">'.$title.'</div>' ;
			?>
		  
				<!-- slide -->	
				<li class="link" <?php echo $kw_li;?>>
				   <div class="kwicks-border">
						<!-- slide photo -->
						<div class="kwicks-image" id="<?php echo $accordion_ID;?>" <?php echo $kw_images;?>></div>
				 
						<?php if ($hide_title_and_text): ?>
							<!-- slide description -->
							<div style="width:<?php echo ($max_single*0.55);?>px" class="desc_accordion">
								<div class="blur_background">
								
									<div class="text">
									<!-- slide title - hidden  -->
									<?php echo $titleHTML; ?>
									<!-- text -->
									<p>
										<?php echo $slide_text;?>
									</p>
									
									</div>
								</div>
								
							</div>
							<!-- /slide description -->
						<?php endif;?>
				   </div>
				</li>
				<!-- / slide  -->
				
				<?php
				if ($image):  
					$image_list.='<li> <img src="'.$image["url"].'" alt="'.$altText.'" class="'.$accordion_ID.'" data-gal="'.$custom_link.'" /> </li>'; 
				endif;
				?>
		 
		<?php endwhile;endif;?> 
	</ul>
		
	<ul class="kwicks-images">
	<!-- captions  -->
	<?php echo $image_list;?>
	<!-- /captions -->
	</ul>

</div>
</div>
<div class="clear"></div>
<?php endif;wp_reset_query();?> 