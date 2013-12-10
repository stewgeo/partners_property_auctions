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

?>

<?php
	global $wp;
	
	if(is_home()):
		$AuctionTheme_adv_code_home_below_content = stripslashes(get_option('AuctionTheme_adv_code_home_below_content'));
		if(!empty($AuctionTheme_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "auction"):
		$AuctionTheme_adv_code_job_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_job_page_below_content'));
		if(!empty($AuctionTheme_adv_code_job_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_job_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if(is_single() or is_page()):
		$AuctionTheme_adv_code_single_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_single_page_below_content'));
		if(!empty($AuctionTheme_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$AuctionTheme_adv_code_cat_page_below_content = stripslashes(get_option('AuctionTheme_adv_code_cat_page_below_content'));
		if(!empty($AuctionTheme_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>

</div> 
</div> <!-- end some_wide_header -->
</div>
</div>

<div id="footer">
	<div class="container">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	
		<div id="site-info">
				<div id="site-info-left">
					
					<h3><?php echo stripslashes(get_option('AuctionTheme_left_side_footer')); ?></h3>
					
				</div>
				<div id="site-info-right">
					<?php echo stripslashes(get_option('AuctionTheme_right_side_footer')); ?>
				</div>
			</div>
	              <ul class="nav navbar-nav pull-right" id="right-header-nav">
                <?php 
                
                  if(is_home())
                  $home_class_active = 'active';  
                  
                  global $wp_query, $pagenow;
                  $vars = $wp_query->query_vars;
                  $special_page = $vars['special_page'];
                  
                  if($special_page == "post-new")   $post_new_class   = 'active'; 
                  if($special_page == "adv-sea")    $adv_sea_new_class  = 'active';
                  if($special_page == "account")    $account_new_class  = 'active';
                  if($special_page == "blog")     $blog_new_class   = 'active'; 
                  if($special_page == "watch")    $watch_class    = 'active';                 
                  if($pagenow == "wp-login.php" and !isset($_GET['action']))    $class_log      = "active"; 
                  if($pagenow == "wp-login.php" and $_GET['action'] == 'register')  $class_register   = "active"; 
                  
                    $AuctionTheme_show_blue_menu = get_option('AuctionTheme_show_main_menu');
                    
                    if($AuctionTheme_show_blue_menu != "yes"):
                ?>
              
                  <li>
                    <a href="<?php bloginfo('siteurl') ?>" class="<?php echo $home_class_active; ?>"><?php echo __("Home","AuctionTheme"); ?></a>
                  </li>
                                                       
                 <?php
                  
                  endif;
                  
                  $menu_name = 'primary-auctiontheme-header';

                  if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                
                  $menu_items = wp_get_nav_menu_items($menu->term_id);
              
                
                  foreach ( (array) $menu_items as $key => $menu_item ) {
                    $title = $menu_item->title;
                    $url = $menu_item->url;
                    
                    if(!empty($title))
                    {echo '<li><a href="' . $url . '">' . $title . '</a></li>'; }
                  }
                    
                  } 
                ?>
                  <li>
                    <a class="<?php echo $watch_class; ?>" href="<?php echo AuctionTheme_watch_list(); ?>"><?php echo __("Watch List","AuctionTheme"); ?></a>
                  </li>
             
                            
                <?php if(get_option('auctionTheme_enable_blog') == "yes") { ?>
                  <li>
                    <a class="<?php echo $blog_new_class; ?>" href="<?php echo AuctionTheme_blog_link(); ?>"><?php echo __("Blog","AuctionTheme"); ?></a> 
                  </li>
                <?php } ?>
                            
                <?php
                  if($AuctionTheme_show_blue_menu != "yes"):
                ?>
                  <li>
                    <a href="<?php echo AuctionTheme_advanced_search_link(); ?>" 
                            class="<?php echo $adv_sea_new_class; ?>"><?php _e("Advanced Search","AuctionTheme");?></a>
                  </li> 
                <?php
              
                  endif;
              
                  if(is_user_logged_in())
                  {
                    ?>
                  
                    <li>
                      <a href="<?php echo AuctionTheme_my_account_link(); ?>" 
                            class="<?php echo $account_new_class; ?>"><?php echo __("My Account","AuctionTheme"); ?></a>
                    </li>
                    <li>
                      <a href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","AuctionTheme"); ?></a>
                    </li>                 
                  <?php
                  }
                  else
                  {     
                    ?>
                    
                    <li>
                      <a class="<?php echo $class_register; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register">
                        <?php echo __("Register","AuctionTheme"); ?>
                      </a>
                    </li>
                    <li>
                      <a class="<?php echo $class_log; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php">
                        <?php echo __("Log In","AuctionTheme"); ?>
                      </a>
                    </li>
                <?php } ?>             
              </ul> 
		</div>

</div>


</div>
<?php

	$AuctionTheme_enable_google_analytics = get_option('AuctionTheme_enable_google_analytics');
	if($AuctionTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('AuctionTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$AuctionTheme_enable_other_tracking = get_option('AuctionTheme_enable_other_tracking');
	if($AuctionTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('AuctionTheme_other_tracking_code'));	
	endif;


?>
<?php wp_footer(); ?>
</body>
</html>