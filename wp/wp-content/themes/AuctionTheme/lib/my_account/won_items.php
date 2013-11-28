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


function AuctionTheme_my_account_won_items_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
     <div class="my_box3">
            
            	<div class="box_title"><?php _e("Won Items","AuctionTheme"); ?></div>
            	<div class="box_content">
                
                 
                 <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$post_per_page = 5;				
					
					
				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids 
					WHERE 
					
					wposts.ID=bids.pid AND
					bids.uid='$uid' AND 
					bids.winner='1'  
					
					ORDER BY wposts.post_date DESC LIMIT 28 ";
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php 
                 				
                      			auctionTheme_get_post();  
                     
                     ?>

                     <?php endforeach; ?>
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','AuctionTheme'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
                
                </div>
                </div>
          
    
    
    
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	auctionTheme_get_users_links();
	
}

?>