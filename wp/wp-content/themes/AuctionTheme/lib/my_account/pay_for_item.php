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


function AuctionTheme_my_account_pay4item_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

 	global $wp, $wpdb;
	global $wp_query, $wp_rewrite, $post;
	$bid_id 	=  $wp_query->query_vars['bid_id'];
	
	$s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
	$r = $wpdb->get_results($s);
	$row = $r[0]; $bid = $row;
	
	$pid = $row->pid;
	$post_au = get_post($pid);
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
      <div class="my_box3">
            	<div class="box_title"><?php printf(__("Pay for Item - %s","AuctionTheme"), $post_au->post_title);; ?></div>
            	<div class="box_content">
                
             		
                    
                    
                     
                <div class="post" id="post-<?php the_ID(); ?>">
                <div class="padd10">
                <div class="image_holder">
                <a href="<?php echo get_permalink($pid); ?>"><?php echo AuctionTheme_get_first_post_image($pid,75,65); ?></a>
                </div>
                <div  class="title_holder3" > 
                     <h2><a href="<?php echo get_permalink($pid) ?>" rel="bookmark" title="Permanent Link to <?php echo $post->post_title; ?>">
                        <?php 
                        
                        echo $post_au->post_title;
                    
                        
                        ?></a></h2>
      			</div>
                
                <div class="details_holder3">
             <?php echo __('You are about to pay for this auction. Use the accepted methods below to pay for it.','AuctionTheme'); ?>
              
              <?php
					
					$shipping = get_post_meta($pid, 'shipping', true);
					if(is_numeric($shipping) && $shipping > 0 && !empty($shipping))
						echo '<b>'.__('Shipping','AuctionTheme')."</b>: ".auctionTheme_get_show_price($shipping).'<br/>';
					else $shipping = 0;
				
              ?>
              
              <br/><br/>
               
             
              
              <a href="<?php 
			
			$using_perm = AuctionTheme_using_permalinks();
	
			if($using_perm)	$privurl_m = get_permalink(get_option('AuctionTheme_my_account_priv_mess_page_id')). "?";
			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_my_account_priv_mess_page_id'). "&";	
			
			echo $privurl_m."priv_act=send&";
            $post1 = get_post($pid);
			echo 'pid='.$pid.'&uid='.$post1->post_author;
			
			?>" class="post_bid_btn"><?php _e('Contact Seller','AuctionTheme'); ?></a><br/><br/>
              
              
                <b><?php echo __('The price for the auction is','AuctionTheme'); ?>:  
				<?php 
				
				
				
				$quant_tk = $bid->quant;
				if($quant_tk > 0)
				{
					
						
					echo auctionTheme_get_show_price($bid->bid)." x ". $quant_tk." = ".auctionTheme_get_show_price($bid->bid * $quant_tk + $shipping);
				}
				else				
				echo auctionTheme_get_show_price($bid->bid + $shipping); ?></b>
                <br/><br/>
                <?php
				
				$AuctionTheme_paypal_enable = get_option('AuctionTheme_paypal_enable');
				if($AuctionTheme_paypal_enable == "yes"):
				
				?>
                <a href="<?php bloginfo('siteurl'); ?>/?pay_for_item=paypal&bid_id=<?php echo $bid_id; ?>" class="post_bid_btn"><?php _e('Pay by PayPal','AuctionTheme'); ?></a><br/><br/>
                
                <?php
				
				endif;
				
				
				$AuctionTheme_alertpay_enable = get_option('AuctionTheme_alertpay_enable');
				if($AuctionTheme_alertpay_enable == "yes"):
				
				?>
                <a class="post_bid_btn" href="<?php bloginfo('siteurl'); ?>/?pay_for_item=payza&bid_id=<?php echo $bid_id; ?>"><?php _e('Pay by Payza','AuctionTheme'); ?></a><br/><br/>
                
                <?php
				
				endif;
				
				
					//lets see if we enabled pay by credits
					$AuctionTheme_enable_pay_credits = get_option('AuctionTheme_enable_pay_credits');
					if($AuctionTheme_enable_pay_credits != 'no'):
				
				?>
                
                <a class="post_bid_btn" href="<?php echo auctionTheme_pay_for_item_by_credits_link($bid_id); ?>"><?php echo __('Pay by credits','AuctionTheme'); ?></a> <br/><br/>
                <a class="post_bid_btn" href="<?php echo AuctionTheme_get_payments_page_url('escrow', $bid_id ); ?>"><?php echo __('Pay by escrow','AuctionTheme'); ?></a>
                
                
                
                
                <?php endif; ?>
                
                
                <?php
				
				$AuctionTheme_offline_payments = get_option('AuctionTheme_offline_payments');
				if($AuctionTheme_offline_payments == "yes"):
				
				
				?>
                
                <br/><br/>
                
                <?php echo sprintf(__('Bank Details: %s','AuctionTheme'), get_option('AuctionTheme_offline_payment_dets')); ?>
                
                <?php
					endif;
					
					do_action('AuctionTheme_pay_for_item_page', $bid_id);
				
				?>
                </div>
                
                </div>
                </div>
      
                    
             
                
                </div>
                </div>
         
    
    
    
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	auctionTheme_get_users_links();
	
}

?>