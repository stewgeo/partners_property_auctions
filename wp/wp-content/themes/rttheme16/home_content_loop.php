<?php
/* 
* rt-theme home page content loop
*/

global $home_page,$which_theme,$row,$layout_values,$layout,$firstBox,$lastBox,$reset,$this_column_width_pixel,$item_width,$box_border,$layout_values,$content_width,$container_border;
 
	
		//keep posts
		$keep = query_posts($home_page);
		$count_home_boxes=1;
		
		#
		#	Reset counter for all content listing option
		#
		$reset_counter = ($item_width) ? 1 : false;			


		#
		#	this column width	- pixel - for all content listing option
		#
		$this_column_width_pixel =  ($item_width!=1) ? intval ($this_column_width_pixel/$item_width) : $this_column_width_pixel;


		if (have_posts() ) : while ( have_posts() ) : the_post();
		
		#
		#	Values 
		#
		
		$box_title			=	get_the_title();
		$box_sub_title			=	get_post_meta($post->ID, THEMESLUG.'sub_title', true);
		$custom_link 			= 	get_post_meta($post->ID, THEMESLUG.'custom_link', true);
		$custom_link_text 		= 	get_post_meta($post->ID, THEMESLUG.'custom_link_text', true);
		$image 				=	get_post_thumbnail_id();
		$crop				=	get_post_meta($post->ID, THEMESLUG.'homepage_image_crop', true);
		$custom_image_height	=	get_post_meta($post->ID, THEMESLUG.'homepage_image_height', true); 
		
		#
 		#	Layout names
 		# 		
		$layout_names	= array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");			 
			
		#
		#	Thumbnail dimensions
		# 
		$w = intval ($this_column_width_pixel-40);
		$h = intval ($this_column_width_pixel/2); 
			  
		#
		#	Crop
		#
		if($crop) $h=intval($custom_image_height); else $h=10000;
		
		#
		#	Resize Image
		#
		if($image) $image_thumb = vt_resize( $image, '', $w, $h, $crop );
		 

		#
		#	Box border
		#
		$addClass2 = ($box_border) ? "border white" : "" ;


		#
		#	Box Size
		#
		$layout 	= ($item_width) ? $layout_names[$item_width] : $layout;
		$firstBox = ($reset_counter == 1) ? "first" : false;
		$lastBox 	= ($reset_counter == $item_width) ? "last" : false;
			
		?>

		<!-- box -->
		<div class="template_builder box <?php echo $layout;?> <?php echo $firstBox .' '. $lastBox  .' '. $addClass2;?>" id="post-<?php echo $post->ID;?>">
			<?php echo (!$container_border) ? '<div class="padding-div">' : '' ;?>
				<?php if($box_title):?>
				<!-- box title-->
				<h3><?php if($custom_link):?><a href="<?php echo $custom_link;?>" title="<?php echo $box_title;?>"><?php endif;?><?php echo $box_title;?><?php if($custom_link):?></a><?php endif;?></h3>
				<?php endif;?>
								
				<?php if($box_sub_title):?>
				<!-- box subtitle-->
				<div class="sub_title"><?php echo $box_sub_title;?></div>
				<?php endif;?>
				
				<?php if($box_title || $box_sub_title):?>
				<div class="space margin-b10"></div>
				<?php endif;?>

				<?php if($image):?>
				<!-- featured image -->
				<img src="<?php echo @$image_thumb["url"];?>" class="featured" alt="<?php echo $box_title;?>" /> 
				<?php endif;?>				

				<?php
				if ($custom_link && $custom_link_text):
					$read_more =  "<a href=\"". $custom_link ."\" title=\"". $box_title ."\" class=\"read_more\">". $custom_link_text ." →</a>";
				else:
					$read_more ="";
				endif;
				?>
			
				<!-- text-->
				<?php  echo apply_filters('the_content',(get_the_content().$read_more));?>
			<?php echo (!$container_border) ? '</div>' : '' ;?>
		</div>
		<!-- /box -->
    
		<?php
		#
		#	Reset columns - for all content listing option
		#
		$page_count = get_page_count();
		$post_count = $page_count['post_count'];
		$margin  = ($item_width==1) ? 0 : 30 ;
		if ($reset_counter && $item_width==$reset_counter && $count_home_boxes != $post_count):
			echo '<div class="clear"></div><div class="space margin-b'.$margin.'"></div>';
			$reset_counter=1;
		else:
			$reset_counter++;
		endif;
		
		$count_home_boxes ++;
		?>		
    
		<?php endwhile;endif;?>
            
<?php wp_reset_query();?> 