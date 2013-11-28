<?php
# 
# rt-theme product detail page
#
 
//flush rewrite rules
add_action('init', 'flush_rewrite_rules');

//taxonomy
$taxonomy = 'product_categories';

//page link
$link_page = get_permalink(get_option('rttheme_product_list'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat=get_term_link($taxitem->slug,$taxonomy);
		$term_slug = $taxitem->slug;
		$term_id = $taxitem->term_id;
		}
	$i++;
	}
}

get_header();

//variables
$photo_count=0;
$other_photos="";
$tabbed_page = "";
?>


<?php
#
# page layout - sidebar
#
$sidebar 	= 	(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : get_option(THEMESLUG."_sidebar_position_product");

#
# content width
#
$content_width = ($sidebar=="full") ? 960 : 710;

#
#	call sub page header
#
get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

#
#	call the sub content holder 1st part
#
sub_page_layout("subheader",$sidebar);
?>

	<?php
	if (have_posts()) : while (have_posts()) : the_post();
	
		//values
		$rt_other_images 		= trim(get_post_meta($post->ID, THEMESLUG.'other_images', true));
		$rt_attached_documents   = get_post_meta($post->ID, THEMESLUG.'attached_documents', true); 
		$content				= apply_filters('the_content',(get_the_content())); 
		$title				= get_the_title();
		$order_button			= get_post_meta($post->ID, THEMESLUG.'order_button', true);
		$order_button_text		= get_post_meta($post->ID, THEMESLUG.'order_button_text', true);
		$order_button_link		= get_post_meta($post->ID, THEMESLUG.'order_button_link', true);
		$related_products		= get_post_meta($post->ID, THEMESLUG.'related_products[]', true);
		$short_desc			= get_post_meta($post->ID, THEMESLUG.'short_description', true);

		//free tabs count
		$tab_count=3;
		for($i=0; $i<$tab_count+1; $i++){
		    if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true)))  $tabbed_page="yes";
		}
	?>

	<!-- product title and button --> 

					
	<!-- product title --> 
	<h2 class="product"><?php the_title(); ?></h2>
	<!-- / product title -->

	<?php if($order_button):?>
	<!-- order button -->
	<a href="<?php echo $order_button_link;?>" class="button small alignright <?php echo get_option( THEMESLUG."_style" )=="dark" ? "dark" : "default"; ?>"><span class="mail"><?php if($order_button_text): echo $order_button_text; else: _e('Order Enquiry','rt_theme'); endif; ?></span></a>
	<!-- / order button -->
	<?php endif;?>
	
	<div class="border-line margin-t10 margin-b30"></div>

	<!-- / product title and button -->



	<!-- product images --> 

		<?php //photos
		
		//default photo
		if(get_post_meta($post->ID, THEMESLUG.'product_image_url', true)):
		    $default_photo  = get_post_meta($post->ID, THEMESLUG.'product_image_url', true);
		    $total_photo 	= 1;
		endif;
		
		
		//other photos
		if(trim($rt_other_images)):
		    $other_photos 	= trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $rt_other_images));  
		    $total_photo	= $total_photo + count( explode("\n", $other_photos) );
		endif;
		
		//merge all
		$product_photos=@$default_photo ."\n".@$other_photos;
					
		?>
		
		<?php if (trim($product_photos)):
				
		//is crop active		
		$crop = (get_option(THEMESLUG.'_single_product_image_crop')) ? true : false ;


		//Thumbnail dimensions
		$w = (get_option(THEMESLUG.'_single_product_image_width')) ? get_option(THEMESLUG.'_single_product_image_width') : 147; // image max width 
		$h = ($crop) ? (get_option(THEMESLUG.'_single_product_image_height')) ? get_option(THEMESLUG.'_single_product_image_height') : 147 : 10000; // image max height 
		?>
		
			<?php if($total_photo>1):?>
				<!-- product image slider -->
	
					<?php  
					//Product Photos 
					$product_photos_split=explode("\n", $product_photos);
					$imagesHTML = "";
					$maxHeight  = 0;
				
					foreach ($product_photos_split as &$photo_url) {
					
						if($photo_url){
							//resize the photo  
							$photo_url 		= find_image_org_path($photo_url);
							$image_thumb 		= @vt_resize( '', trim($photo_url), $w, $h, $crop );													
							$maxHeight 		= ($image_thumb['height']>$maxHeight) ? $image_thumb['height'] : $maxHeight ;
							 
							$imagesHTML .=  '<li><a href="'.$photo_url.'" data-gal="prettyPhoto[rt_theme_products]" title=""><img src="'.$image_thumb['url'].'" width="'.$w.'" alt="" /></a></li>';

							@$photo_count++;
						}
					}
					?>
					
				<div class="carousel" style="height:<?php echo $maxHeight+42;?>px;overflow:hidden;"><ul id="product_thumbnails" class="jcarousel-skin-rt"><?php echo $imagesHTML;?></ul></div>
				<div class="space margin-t10 margin-b20"></div>
			<?php endif;?>
		<?php endif;?>
	<!-- / product images -->  
	

	<!-- PRODUCT TABS -->
	<div class="box product_detail full">

		<!-- TABS WRAP -->				
		<?php if(@$tabbed_page):?>
		<div class="taps_wrap">
		    <!-- the tabs -->
		    <ul class="tabs">
				<?php if($content):?><li><a href="#"><?php _e('General Details','rt_theme');?></a></li><?php endif;?>
				<?php
				#
				#	Free Tabs
				#	
				for($i=0; $i<$tab_count+1; $i++){ 
					if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true))){
						echo '<li><a href="#">'.get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true).'</a></li>';
					}
				}
				
				#
				#	Attached Documents
				# 		
				if($rt_attached_documents){
					echo '<li><a href="#">'.__('Attached Documents','rt_theme').'</a></li>';
				}
				?>
		
		    </ul>
		<?php endif;?>
		
		<?php if($content):?>								
		<!-- General Details -->
		
		<?php if(@$tabbed_page):?><div class="pane"><?php else:?><div class="box"><?php endif;?> 
			<div>
			<?php if($total_photo==1): // only 1 image for this product ?>	
				<?php 
				//resize the photo  
				$photo_url 		= find_image_org_path($default_photo);
				$image_thumb 		= @vt_resize( '', trim($photo_url), 300, 600, $crop );		
				?>
				<span class="frame alignleft"><a href="<?php echo $photo_url;?>" title="" data-gal="prettyPhoto[rt_theme_products]" class="imgeffect plus" ><img src="<?php echo $image_thumb['url'];?>" alt="" /></a></span>
			<?php endif;?>
			
			<?php echo $content;?>
			</div>
			<div class="clear"></div>
		</div>
		<?php endif;?>

		<?php
		#
		#	Free Tabs' Content
		#	
		for($i=0; $i<$tab_count+1; $i++){ 
			if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true))){				  
				echo '<div class="pane">';
				echo (apply_filters('the_content',get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_content', true)));
				echo '<div class="clear"></div></div>';
			}
		}
		?>

		<?php if($rt_attached_documents):?>
		
		

				
			<?php if(@!$tabbed_page):?><div class="line"></div><?php endif;?>
			<div class="pane">
				<!-- document icons -->
				<ul class="doc_icons">
					
					<?php

					if(trim($rt_attached_documents)):
					    $rt_attached_documents 	= trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $rt_attached_documents));  
					    $rt_attached_documents	= explode("\n", $rt_attached_documents);
					endif;
					
					if(is_array($rt_attached_documents)){
						foreach($rt_attached_documents as $fileURL){ 
							
							if(strpos($fileURL, ".doc")){
								echo '<a href="'.$fileURL.'" title="'.__('Download Word File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/Word.png" alt="'.__('Download Word File','rt_theme').'" class="png" /></a>';
							}

							elseif(strpos($fileURL, ".xls")){
								echo '<a href="'.$fileURL.'" title="'.__('Download Excel File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_Excel.png" alt="'.__('Download Excel File','rt_theme').'" class="png" /></a>';
							}

							elseif(strpos($fileURL, ".pdf")){
								echo '<a href="'.$fileURL.'" title="'.__('Download PDF File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_Pdf.png" alt="'.__('Download PDF File','rt_theme').'" class="png" /></a>';
							}							

							elseif(strpos($fileURL, ".ppt")){
								echo '<a href="'.$fileURL.'" title="'.__('Download PowerPoint File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_PowerPoint.png" alt="'.__('Download PowerPoint File','rt_theme').'" class="png" /></a>';
							}							

							else{
								echo '<a href="'.$fileURL.'" title="'.__('Download File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File.png" alt="'.__('Download File','rt_theme').'" class="png" /></a>';
							}
							
						}
					}
					?>

				</ul>
				<!-- document icons -->
			</div>
		<?php endif;?>
				
				
		<?php if(@$tabbed_page):?>        
		</div><div class="clear"></div>
		<?php endif;?>
		
	</div>
	<!-- / PRODUCT TABS -->
				
	<div class="space v_10"></div>
	<!-- / content --> 		

	
	<!-- RELATED PRODUCTS --> 
		<?php
		if($related_products){
			echo '<h4>'.__("Related Products",'rt_theme').'</h4><div class="border-line margin-t10 margin-b30"></div>';		
			//taxonomy 
			$args=array(
				'post_type'           => 'products', 
				'post_status'         => 'publish',
				'orderby'             => 'menu_order', 
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => 1000, 
				'post__in'            => $related_products
			);

			//item width - column count
			$item_width = get_option(THEMESLUG."_related_product_layout");
		    get_template_part( 'product_loop', 'product_categories' );
		}
		?>

	<!-- / RELATED PRODUCTS -->


	<?php endwhile;?>
	
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
	<?php endif; ?>
	
	
<?php
#
#	call the sub content holder 2nd part
#
sub_page_layout("subfooter",$sidebar); 

get_footer();
?>