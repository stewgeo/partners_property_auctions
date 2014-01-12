<?php
global $sidebar,$heading,$content_width;
?> 

<?php
//varialbles
$video_width 		= ($content_width 	=="960") ? 924 : 674; 
$video_height 		= ($content_width 	=="960") ? 500 : 380;
$image_width 		= ($content_width 	=="960") ? 922 : 672; 
$image_height		= ($content_width 	=="960") ? 500 : 380;
?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            


	<?php 
	#
	#	featured image
	#

	$thumb 			= get_post_thumbnail_id();
	$resize 			= (get_post_meta($post->ID, THEMESLUG.'blog_image_resize', true)) ? true : false;
	$is_old_post	 	= (get_post_meta($post->ID, THEMESLUG.'is_old_post', true)=="1") ? false : true; 
	$crop 			= (get_post_meta($post->ID, THEMESLUG.'blog_image_crop', true)) ? true : false; 
	$width 			= (get_post_meta($post->ID, THEMESLUG.'blog_image_width', true)) ? get_post_meta($post->ID, THEMESLUG.'blog_image_width', true) : $image_width;
	$meta_height 		= get_post_meta($post->ID, THEMESLUG.'blog_image_height', true);
	$height 			= (!$meta_height && !$crop) ? 10000 : (($meta_height && !$crop) ? $meta_height : ($meta_height && $crop) ? $meta_height : $image_height); 
	$img_position 		= (get_post_meta($post->ID, THEMESLUG.'featured_image_position', true)) ? get_post_meta($post->ID, THEMESLUG.'featured_image_position', true): "center";
	$post_class_img	= "featured_image_".$img_position;
	
	if($is_old_post && !$resize) $resize = true; //activate resizer for old posts
	
	if($thumb &&  $resize) $image = @vt_resize( $thumb, '', $width, $height, $crop );
	if($thumb && !$resize) $image = wp_get_attachment_image_src($thumb, 'full'); 
	
	$imageURL = isset($image) ? ($resize) ? $image["url"] : $image[0] : "";

	#
	#	post formats
	#
	
	$post_format = !get_post_format() ? "post" : get_post_format(); 


	//post format images
	switch($post_format)
	{
		case 'gallery'; 	$post_format_image = "images.png";  	break;
		case 'aside'; 		$post_format_image = "post.png";  		break;
		case 'link'; 		$post_format_image = "link.png";  		break;
		case 'quote'; 		$post_format_image = "comment.png";  	break;
		case 'video'; 		$post_format_image = "video.png"; 		break;			
		default; 			$post_format_image = "post.png";  		break;
	}

	$post_format_image = THEMEURI.'/images/assets/icons/'.$post_format_image;
	
	?>
		
		<!-- blog box-->
		<div id="post-<?php the_ID(); ?>" <?php post_class('box full blog blog_list '.$post_class_img.''); ?>>
		
			
			<!-- post type -->
			<div class="post_type <?php echo $post_format;?>"><img src="<?php echo $post_format_image;?>"></div>
			
			<?php
			#
			#	link
			#
			if($post_format=="link"){
				$link 		= get_post_meta($post->ID, THEMESLUG.'post_format_link', true);
				$link_html  	= '<span class="post_url">⎯ <a href="'.$link.'" target="_new" title="'.get_the_title().'">'.$link.'</a></span>';
			}else{$link_html=false;}
			?>

			<?php
			#
			#	quote
			#
			if($post_format=="quote"){
				$quote_text 		= get_post_meta($post->ID, THEMESLUG.'quote_text', true);
				$quote_author  	= get_post_meta($post->ID, THEMESLUG.'quote_author', true);
				

				echo '<div class="comment_quote clearfix"><p>';
				echo $quote_text;
				echo ($quote_author) ? '<span class="comment_author">⎯ '. $quote_author .'</span>' : ''; 
				echo	'</p></div>';
			}
			?>


			
			<?php if($post_format!="quote"):?>
				
					<?php if($heading):?>
						<div class="space margin-b20"></div> 
						<!-- blog headline-->
						<h2><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> <?php echo $link_html;?>
						<!-- / blog headline-->
						
						
					
						<?php if($post_format!="aside"):?>
							<div class="border-line"></div>
							<div class="post_data">
								<div class="date"><?php the_time(get_option('rttheme_date_format')) ?></div>
								<span class="user"><?php the_author_posts_link();?></span>
								<a href="<?php comments_link(); ?>" title="<?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?>" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a>
							</div>
						<?php else://aside?>
							<div class="border-line margin-b20"></div> 
						<?php endif;?>
				
					<?php endif;?>
				
			<?php endif;?>
		
			<?php
			#
			#	video
			#
			$video_url = get_post_meta($post->ID, THEMESLUG.'video_url', true);
			if ($video_url){
				 
				if( strpos($video_url, 'youtube')  ) { //youtube
					echo '<iframe class="frame" width="'.$video_width.'" height="'.$video_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($video_url).'" frameborder="0" allowfullscreen></iframe>';
				}
				
				if( strpos($video_url, 'vimeo')  ) { //vimeo
					echo '<iframe class="frame" src="http://player.vimeo.com/video/'.find_tube_video_id($video_url).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="'.$video_width.'" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
				
				echo '<div class="space margin-t20"></div>';
			}
			?>
		
							
			<?php
			#
			#	gallery
			#
			$gallery_slider = get_post_meta($post->ID, THEMESLUG.'gallery_slider', true);
					
			if ($gallery_slider){ 
				//resize the photo 
				$gallery_crop			= (get_post_meta($post->ID, THEMESLUG.'gallery_images_crop', true)) ? true : false;
				$gallery_images_height	= get_post_meta($post->ID, THEMESLUG.'gallery_images_height', true);
				$gallery_w			= $image_width;  
				$gallery_h			= ($gallery_crop) ? $gallery_images_height:10000;
				$gallery_list			= "";			 								
				$gallery_images_split 	= explode("\n", $gallery_slider);
				$gallery_style			= ($gallery_crop) ? 'style="height:'.$gallery_images_height.'px;overflow:hidden;"' :"";
		
					foreach ($gallery_images_split as &$photo_url) {						
						if($photo_url){	 					
							$gallery_image_resized 		= vt_resize("" , trim($photo_url) , $gallery_w, $gallery_h, true);
							$gallery_list				.= "<li>";
							$gallery_list				.= '<img src="'.$gallery_image_resized['url'].'" alt="" /></li>';																
						}
					}
							
				echo '<div class="frame slider" '.$gallery_style.'><div class="photo_gallery_cycle"><ul>'.$gallery_list.'</ul><div class="clear"></div><div class="slider_buttons"></div></div></div>';
				echo '<div class="space margin-t20"></div>';
			}
			?>
			
			
			<?php if ($thumb):?>
			<!-- blog image-->
			<div class="blog_image align<?php echo $img_position;?>">
			    <span class="frame align<?php echo $img_position;?>"><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>" class="imgeffect link">
				   <img src="<?php echo $imageURL;?>" alt="<?php echo get_the_title(); ?>" />
			    </a></span>
			</div>
			<!-- / blog image -->
			
			<?php if($img_position=="center"):?>
				<div class="space margin-t20"></div> 
			<?php endif;?>
			
			<?php endif;?>		
					
				<!-- blog text-->
				<?php the_content(); ?> 
				<!-- /blog text-->		
					 
			<?php if($img_position!="center"):?><div class="space margin-t10"></div><?php endif;?>
			<div class="clear"></div>  
		</div>
		
		<!-- blog box-->

 
			 
		<?php if(get_the_tags()):?>
		<div class="tags">
		    <!-- tags -->
		    <?php echo the_tags( '<span>', '</span>, <span>', '</span>');?>  
		    <!-- / tags -->
		</div>
		<?php endif;?>
		 
		<!-- / blog box -->
		
		<?php if(comments_open() || get_option(THEMESLUG."_hide_author_info")):?>
		<div class="clear"></div>
		<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
		<?php endif;?>
		
		
		<?php endwhile;?>
		
		<?php if(get_option(THEMESLUG."_hide_author_info")):?>
		<!-- Info Box -->		
			<div class="author_info margin-b30">
			<h5><?php _e( 'About the Author', 'rt_theme' ); ?></h5>
			
			<span class="alignleft frame"><span class="avatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '60' ); }?></span></span>
			<p>				 
				<strong><?php the_author_posts_link(); ?></strong><br />
				<?php the_author_meta('description'); ?>
			</p>
		</div>
		<div class="space marhin_b30"></div>
		<div class="line"></div><!-- line -->	 
		<?php endif;?>            

		<div class='entry commententry'>
		    <?php comments_template(); ?>
		</div>
		
		<?php else: ?>
		    <p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
		<?php endif; ?>
 