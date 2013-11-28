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


function AuctionTheme_my_account_not_won_items_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
    
     <div class="my_box3">
            
            	<div class="box_title"><?php _e("Did Not Win Items","AuctionTheme"); ?></div>
            	<div class="box_content">
                
                <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$post_per_page = 5;				
					
						
					$bid = array(
							'key' => 'bid',
							'value' => $uid,
							'compare' => '='
						);	
						
					
					$closed = array(
							'key' => 'closed',
							'value' => "1",
							'compare' => '='
						);
						
					$winner = array(
							'key' => 'winner',
							'value' => $uid,
							'compare' => '!='
						);			
						
					
					$args = array('post_type' => 'auction', 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => $post_per_page,
					'pages' => $query_vars['paged'], 'meta_query' => array($bid, $closed, $winner));
					
					query_posts( $args);
						
					
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						auctionTheme_get_post();
					endwhile;
					
					if(function_exists('wp_pagenavi')):
					wp_pagenavi(); endif;
					
					 else:
					
					_e("There are no items yet.",'AuctionTheme');
					
					endif;
					
					
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