<?php
global $heading,$emptyContent,$content_width;
?>
	<?php if($heading):?>
	<div class="space margin-b20"></div> 
	<!-- page title --> 
	<div class="head_text"><h2><?php the_title(); ?></h2></div>
	<!-- / page title -->  
	<div class="border-line margin-b20"></div> 
	<?php endif;?>

	<?php
	#
	#  featured image	   
	#
	$thumb 			= get_post_thumbnail_id();
	$image_url 		= wp_get_attachment_image_src($thumb,'false', true);
	$width 			= 300;
	$height 			= 300;
	if($thumb) $image 	= @vt_resize( $thumb, '', $width, $height, 'false' );
	?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
						
		<?php if($thumb)://featured image ?>
			<span class="frame alignleft"><a href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>" data-gal="prettyPhoto[page_featured_image]" class="imgeffect plus">
				<img src="<?php echo $image["url"];?>" alt="<?php the_title(); ?>" />
			</a></span>
		<?php endif;?>
						
		<?php
		$content = the_content();
		$emptyContent = (empty($content)) ? "true" : "false";
	 	?>
		<?php wp_link_pages(); ?>
	<?php endwhile;?>

			<?php if(comments_open() && get_option(THEMESLUG."_allow_page_comments")):?>
				<div class='entry commententry'>
					<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
				    <?php comments_template(); ?>
				</div>
			<?php endif;?>

	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
	<?php endif; ?>
 