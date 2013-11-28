<?php
/* 
* rt-theme portfolio loop
*/
global $args,$wp_query,$item_width,$content_width,$paged,$box_border,$this_column_width_pixel,$item_width;

if(is_tax()) $args = array_merge( $wp_query->query, $args);

//keep posts
$keep                   = query_posts($args); 

// portfolio layout
$portfolio_layout_names = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one"); 

//is crop active	
$crop                   = get_option('rttheme_portfolio_image_crop');


$reset_row_count        = 0;
$counter                = 0;   


#
#	item width 
#
$item_width 		=  ($item_width) ?  $item_width  : get_option(THEMESLUG."_portfolio_layout");
 
#
#	column width - pixel  
#
$this_column_width_pixel =  ($this_column_width_pixel) ? intval ($this_column_width_pixel/$item_width) : intval ( ($content_width) / $item_width);


		
if ( have_posts() ) : while ( have_posts() ) : the_post();

	// Values
	$image           =	find_image_org_path(get_post_meta($post->ID, THEMESLUG.'_portfolio_image', true));
	$title           =	get_the_title();
	$video           =	str_replace("&","&amp;",get_post_meta($post->ID, 'rttheme_portfolio_video', true));
	$video_thumbnail =	find_image_org_path(get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true)); 
	$desc            =	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
	$permalink       =	get_permalink();
	$remove_link     = 	get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
	$custom_thumb    = 	get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);
	
	//box counter
	if(!isset($box_counter)) $box_counter = 1;
 
	//this column width	- grid 
	$this_column_width_grid = 60 / $item_width;
	
	// Reset Counter	
	$reset=false;
	$reset_row_count =  $reset_row_count + $this_column_width_grid;

	//Thumbnail dimensions
	$w = $this_column_width_pixel-40;
	$h = $this_column_width_pixel/2;
	
	// Crop
	if($crop) $crop="true"; else $h=10000;
	
	// Resize Portfolio Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' );
	
	
	// Resize Video Image
	if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, $h, ''.$crop.'' );
	
	
	/* Getting image type */
	if ($video) {
		$button="play";
		$media_link= $video;
	} else {
		$media_link= $image;
		$button="plus";
	}
	
	
	//firt and last
	if($item_width==1){
		$addClass="first";
		$addClass.=" last";
		$box_counter=0;
		$reset_row_count = 0;		
	}	
	elseif($box_counter==1){
		$addClass="first";
	}  
	elseif ($reset_row_count+$this_column_width_grid > 60){
		$addClass="last";
		$box_counter=0;
		$reset_row_count = 0;
	}
	else{
		$addClass="";
	}

?>
				
	<!-- box -->
	<div class="box <?php echo $portfolio_layout_names[$item_width];?> <?php echo $addClass;?> portfolio">

	
		<?php if ($image || $video_thumbnail || $custom_thumb):?>
		<!-- portfolio image -->
		<span class="frame block">
			
			<?php if($media_link):?><a href="<?php echo $media_link;?>" title="<?php echo $title; ?>" data-gal="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>

				<?php if($custom_thumb)://auto resize not active?>
				    <img src="<?php echo $custom_thumb;?>" alt="<?php echo $title; ?>" />
				<?php elseif($video_thumbnail):?>
				    <img src="<?php echo $video_thumbnail["url"];?>" alt="<?php echo $title;?>" />	    
				<?php else:?>
				    <img src="<?php echo $image_thumb["url"];?>" alt="<?php echo $title;?>" />
				<?php endif;?>

			<?php if($media_link):?></a><?php endif;?>
		</span>
		<!-- / portfolio image -->		
		<?php endif;?>

		<div class="portfolio_info">
			<!-- title-->
			<h5><?php if(!$remove_link):?><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>"><?php endif; ?><?php echo $title; ?><?php if(!$remove_link): ?></a><?php endif; ?></h5>	

			<?php if($desc):?>
				<p>
				<!-- text-->
				<?php echo $desc;?>
				
				<?php if(!$remove_link):?>
					<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>" class="read_more"><?php _e( 'read more →', 'rt_theme' ); ?></a>
				<?php endif;?>
				</p>
			<?php endif;?>
    
		</div>

	</div>
	<!-- /box --> 

			
<?php
//get page and post counts
$page_count=get_page_count();
$post_count=$page_count['post_count'];
    
    $counter++; 
    $box_counter++;
    
    //close row
    if(stristr($addClass,"last") || $post_count==$counter){
		
		if ($post_count==$counter  && !$paged){
			echo '<div class="clear"></div><div class="space margin-t30"></div>';
		}

		else{
			echo '<div class="clear"></div><div class="border-line margin-t30 margin-b30"></div>';
		}
    }    

?>

<?php endwhile;?>


<?php if($page_count['page_count']>1 && $paged):?> 
 
	<!-- paging-->
	<div class="paging_wrapper <?php echo $box_border ? 'margin-b30' : '' ?>">
		<ul class="paging">
			<?php get_pagination(); ?>
		</ul>
	</div>			
	<!-- / paging-->
    
<?php endif;?>


<?php endif; wp_reset_query(); ?>