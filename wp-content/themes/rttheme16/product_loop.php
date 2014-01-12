<?php
/* 
* rt-theme product loop
*/
global $args,$wp_query,$item_width,$content_width,$paged,$box_border,$this_column_width_pixel,$item_width,$cotent_generator;

if(is_tax()) $args = array_merge( $wp_query->query, $args);

//keep posts
$keep              = query_posts($args);

//layout names and values
$layout_names      = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one"); 

//is crop active	
$crop              = get_option(THEMESLUG.'_product_image_crop');

$reset_row_count   = 0;
$counter           = 0; 

#
#	item width 
#
$item_width 		=  ($item_width) ?  $item_width  : get_option(THEMESLUG."_product_layout");
 
#
#	column width - pixel  
#
$this_column_width_pixel =  ($this_column_width_pixel) ? intval ($this_column_width_pixel/$item_width) : intval ( ($content_width) / $item_width);

		
if ( have_posts() ) : while ( have_posts() ) : the_post();

	// Values
	$image 			=	find_image_org_path(get_post_meta($post->ID, THEMESLUG.'product_image_url', true));
	$title 			=	get_the_title();
	$desc 			=	get_post_meta($post->ID, THEMESLUG.'product_desc', true);
	$permalink	 	=	get_permalink();
	$short_desc		=	get_post_meta($post->ID, THEMESLUG.'short_description', true); 
	$custom_thumb		= 	get_post_meta($post->ID, THEMESLUG.'product_thumb_image', true);

	//box counter
	if(!isset($box_counter)) $box_counter = 1;
 
	//this column width	- grid 
	$this_column_width_grid = 60 / $item_width; 
	
	// Reset Counter	
	$reset=false;
	$reset_row_count =  $reset_row_count + $this_column_width_grid;

	
	//Thumbnail dimensions
	$w = $this_column_width_pixel-40;
	$h = $cotent_generator ? $this_column_width_pixel/2 : get_option('rttheme_product_image_height'); 

	// Crop
	if($crop) $crop="true"; else $h=10000;	

	// Resize Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' );
	  
	
	//firt and last
	if($item_width==1){
		$addClass        ="first";
		$addClass        .=" last";
		$box_counter     =0;
		$reset_row_count = 0;		
	}	
	elseif($box_counter==1){
		$addClass ="first";
	}  
	elseif ($reset_row_count+$this_column_width_grid > 60){
		$addClass        ="last";
		$box_counter     =0;
		$reset_row_count = 0;
	}
	else{
		$addClass ="";
	}
	 
?>

	<!-- product -->
	<div class="box <?php echo $layout_names[$item_width];?> <?php echo $addClass;?> product"> 
			<?php if(isset($image_thumb)):?>
			<!-- product image -->
			<span class="frame block"><a href="<?php echo $permalink;?>" class="imgeffect link"><img src="<?php echo $image_thumb['url'];?>"  alt="<?php echo $title;?>" /></a></span>
			<?php endif;?>
			
			<div class="product_info">
			<!-- title-->
			<h5><a href="<?php echo $permalink;?>" title="<?php echo $title;?>"><?php echo $title;?></a></h5> 				
			<!-- text-->
			<?php echo (do_shortcode($short_desc));?>				
		</div>
	</div>
	<!-- / product -->
	 

			
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
	 