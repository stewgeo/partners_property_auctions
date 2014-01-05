<?php
/***************************************************************************
*
*	AuctionTheme - copyright (c) - sitemile.com
*	The most popular auction theme for wordress on the internet. Launch your
*	auction site in minutes from purchasing. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/auctionTheme
*	since v4.4.7.1
*
***************************************************************************/


global $query_string, $wp_query;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
	
query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
	
	
	
			
//======================================================

	get_header();
	
	$AuctionTheme_adv_code_cat_page_above_content = stripslashes(get_option('AuctionTheme_adv_code_cat_page_above_content'));
		if(!empty($AuctionTheme_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	

<div id="content">

<div class="my_box3">
         
            	<div class="box_title"><?php
						
						if(is_tag())
 {
		 				
$tgs = $wp_query->queried_object->name;
							echo sprintf(__("All Auctions Tagged: '%s'",'AuctionTheme'), $tgs);	
						}
						else
						{
						
						if(empty($term_title)) echo __("All Properties",'AuctionTheme');
						else echo sprintf( __("Latest Posted Auctions in %s",'AuctionTheme'), $term_title);
						
						}
					?>
            		
            		
            		
                    
                    <?php
					
						$view = auctiontheme_get_view_grd();
						
						if($view == "normal")
						{
							$list_view = __('List View','AuctionTheme');
							$grid_view = '<a href="'.get_bloginfo('siteurl').'/?switch_to_view=grid&ret_u='.urlencode(auctionTheme_curPageURL()).'">'.__('Grid View','AuctionTheme') . '</a>';	
						}
						else
						{
							$list_view = '<a href="'.get_bloginfo('siteurl').'/?switch_to_view=list&ret_u='.urlencode(auctionTheme_curPageURL()).'">'.__('List View','AuctionTheme') . '</a>';
							$grid_view = __('Grid View','AuctionTheme');	
						}
					
					
					?>
            		<p class="pk_lst_grd"><?php echo $list_view; ?> | <?php echo $grid_view; ?></p>
            		
                    
            	</div> 
				<div class="box_content">

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php 

if($view == "normal")
AuctionTheme_get_post();
else AuctionTheme_get_post_grid() ?>

 

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No auctions posted.',"AuctionTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>


</div></div></div>


<div id="right-sidebar">
    <ul class="xoxo">
    	<li id="text-6" class="widget-container widget_text">
        <h3 class="widget-title"><?php _e('Search Options','AuctionTheme'); ?></h3>	
        <div class="textwidget" style="overflow:hidden">
        
                <div style="float:left;width:100%">
                <table width="100%">
                
                
                <form method="get" action="<?php echo AuctionTheme_advanced_search_link(); ?>">
                
                <?php
							
							if(AuctionTheme_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('AuctionTheme_adv_search_id').'" name="page_id" />';
							
							?>
                <tr><td><?php _e('Auction ID#',"AuctionTheme"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['auction_ID']); ?>" name="auction_ID" />
                   </td></tr>	
                    
                    
                   <tr><td><?php _e('Keyword',"AuctionTheme"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['term']); ?>" name="term" />
                   </td></tr>
                   
                   <tr><td><?php _e('Min Price',"AuctionTheme"); ?>:</td><td>
                    <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['price_min']); ?>" name="price_min" /></td></tr> 
                    
                   <tr><td><?php _e('Max Price',"AuctionTheme"); ?>:</td><td> 
                   <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['price_max']); ?>" name="price_max" /></td></tr>
          			<?php
					
					$AuctionTheme_enable_locations = get_option('AuctionTheme_enable_locations');
					if($AuctionTheme_enable_locations != "no"):
					
					?>
                   <tr><td><?php _e('Postcode',"AuctionTheme"); ?>:</td><td> 
                   <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['zip_code']); ?>" name="zip_code" /></td></tr>
                   
                   <tr><td><?php _e('Radius',"AuctionTheme"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo strip_tags($_GET['radius']); ?>" name="radius" />
                   <?php _e('miles','AuctionTheme'); ?></td></tr>
                    
                   <tr><td><?php _e('Filter by Location',"AuctionTheme"); ?>:</td><td> 
				   <?php	echo AuctionTheme_get_categories_slug("auction_location", $_GET['auction_location_cat'], __("Select Location","AuctionTheme"), "do_input_afs2"); ?></td></tr>
                   
                   <?php endif; ?>
                   
                   <tr><td><?php _e('Filter by Category',"AuctionTheme"); ?>: </td><td>
				   <?php	echo AuctionTheme_get_categories_slug("auction_cat", $_GET['auction_cat_cat'], __("Select Category","AuctionTheme"), "do_input_afs2"); ?></td></tr>

                        <?php
		
		$get_catID = AuctionTheme_get_CATID($_GET['auction_cat_cat']);
		
		if(empty($get_catID)) $get_catID = 0;
		
		$get_catID = array($get_catID);
		$arr = AuctionTheme_get_auction_category_fields_without_vals($get_catID, 'no');
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<tr>';
					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';
					echo '<td>'.$arr[$i]['value'].'</td>';
					echo '</tr>';
			
			
		}	
		
		
		?>  
                
               

                   <tr><td></td><td>
                   <input type="submit" value="<?php _e("Refine Search","AuctionTheme"); ?>" name="ref-search" class="big-search-submit2" /></td></tr>
                   </form>
</table> </div>
</div>
</li>

<?php dynamic_sidebar( 'other-page-area'); ?>

  	</ul>  
    </div>


<?php

	get_footer();

?>