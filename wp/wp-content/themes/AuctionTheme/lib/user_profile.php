<?php

	global $wpdb,$wp_rewrite,$wp_query;
	$username = $wp_query->query_vars['post_author'];
	$uid = $username;
	$paged = $wp_query->query_vars['paged'];
	
	global $username;
	
	$user = get_userdata($uid);
	$username = $user->user_login;
	
	
	
	function sitemile_filter_ttl($title){ global $username; return __("User Profile",'AuctionTheme')." - " . $username;}
	add_filter( 'wp_title', 'sitemile_filter_ttl', 10, 3 );	
	
	get_header();
?>
<div class="container">
<div id="content">
	
    		<div class="my_box3">
            
            	<div class="box_title"><?php echo html_entity_decode($username); ?> </div>
            	<div class="box_content">	
                    	
                      
                    
                        <div class="user-profile-description">
                        <?php
                        
                        $info = get_user_meta($uid, 'personal_info', true);
                        if(empty($info)) _e("No personal info defined.",'AuctionTheme');
                        else echo $info;
                        
                        
                        ?>                        
                        </div>
                        
                          <div class="user-profile-avatar"><?php echo get_avatar( $uid, 96 );; ?><br/><br/>
                          
                          <a class="nice_link" href="<?php
                
				
				$using_perm = AuctionTheme_using_permalinks();
	
			if($using_perm)	$privurl_m = get_permalink(get_option('AuctionTheme_my_account_priv_mess_page_id')). "?";
			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_my_account_priv_mess_page_id'). "&";	
			
			echo $privurl_m."priv_act=send&";
			echo 'uid='.$user->ID;
				
				?>"><?php _e('Contact User','AuctionTheme'); ?></a>
                          
                          
                   	 	</div>
                
            </div>
            </div>
                
                
                <div class="clear10"></div>
    
    

			<div class="my_box3">
            
            	<div class="box_title">Properties by <?php echo html_entity_decode($username); ?></div>
            	<div class="box_content">	

        
<?php

	
	$closed = array(
							'key' => 'closed',
							'value' => '0',
							'compare' => '='
						);	
	
	$nrpostsPage = 8;
	$args = array( 'author' => $uid , 'meta_query' => array($closed) ,'posts_per_page' => $nrpostsPage, 'paged' => $paged, 'post_type' => 'auction', 'order' => "DESC" , 'orderby'=>"date");
	$the_query = new WP_Query( $args );
		
		// The Loop
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			auctionTheme_get_post();
	
			
		endwhile;
	
	if(function_exists('wp_pagenavi'))
	wp_pagenavi( array( 'query' => $the_query ) );
	
          ?>
          
          <?php                                
     	else:
		
		echo __('No auctions posted.','AuctionTheme');
		
		endif;
		// Reset Post Data
		wp_reset_postdata();

            
					 
		?>
	


</div>
</div>
<div class="clear10"></div>
</div></div>

          


</div>


<div id="right-sidebar">
	<ul class="xoxo">
	<?php dynamic_sidebar( 'other-page-area' ); ?>
	</ul>
</div>


<?php

	get_footer();
	
?>
