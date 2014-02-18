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

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title><?php
    if(is_front_page()){
		bloginfo('description');
		}
		else 
		{
			wp_title('') ;
			echo  " | ";
		}
		?><?php bloginfo('name'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_enqueue_script("jquery"); ?>

    <?php do_action('AuctionTheme_before_head_tag_open'); ?>
   
     <!-- ########################################### -->
     
     
	</head>
	<body <?php body_class(); ?> >
    
    
  <?php  
    
    global $default_search;
		
		?>
    <div class="top">
        <div class="container">         
            <ul class="loginbar pull-right" id="right-header-nav">
                <li>
                  <a href = "#contact" data-toggle="modal" class="open-contact"  data-to="info@partnerspropertyauctions.co.uk" data-contact-subject="">Contact Us</a>
                </li>
                <li class="devider"></li>
                <li>
                  <a class="<?php echo $watch_class; ?>" href="<?php echo AuctionTheme_watch_list(); ?>"><?php echo __("Favourites","AuctionTheme"); ?></a>
                </li>
                <li class="devider"></li>
                      
                <?php
                    if(is_user_logged_in())
                    {
                      global $current_user;
                      get_currentuserinfo();
                      $user = $current_user->user_login;
                      ?>
                    
                      <?php /*?><li>
                        <a href="<?php echo AuctionTheme_my_account_link(); ?>" 
                              class="<?php echo $account_new_class; ?>"><?php echo __("My Account","AuctionTheme"); ?></a>
                      </li><?php */?>
                      <li>
                        <a href="<? echo get_bloginfo('url').'/wp-admin/'?>" class="<?php echo $account_new_class; ?>">My Account</a> 
                      </li>
                                      <li class="devider"></li>

                      <li>
                        <a href="<?php echo wp_logout_url(); ?>">Log Out</a>
                      </li>                 
                    <?php
                    }
                    else
                    {     
                      ?>
                      
                     <?php /*?> <li>
                        <a class="<?php echo $class_register; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register">
                          <?php echo __("Register","AuctionTheme"); ?>
                        </a>
                      </li><?php */?>
                      <li>
                        <a class="<?php echo $class_log; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php">
                          <?php echo __("Log In","AuctionTheme"); ?>
                        </a>
                      </li>
                      
                  <?php } ?>             
       
            </ul>
        </div>      
    </div>
     <div id="header" class="navbar navbar-default navbar-static-top" role="navigation" >
      	<div class="container">
		       <!-- start your search bar -->
            <div class="row">
  					<div class="navbar-header">
  						<div class="navbar-brand"> 
    						<?php
    							$logo = get_option('auctionTheme_logo_url');
    							if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
    						?>
    						<a href="<?php bloginfo('siteurl'); ?>">
    							<img id="logo" alt="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" src="<?php echo $logo; ?>" />
    						</a>               
  		        </div>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              	<span class="pull-left text-muted">Menu</span>
              	<div class="nav-button-paddding">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
                </div>
              </button>               
  					</div> <!-- middle-header-bg -->
            <nav class="collapse navbar-collapse bs-navbar-collapse" id="bs-example-navbar-collapse-1" role="navigation">
                <div id="site-search">
                  <form method="get" action="<?php echo AuctionTheme_advanced_search_link(); ?>/" class="navbar-form navbar-right" role="search">
                    <div class="input-group">
                      <?php
                        if(AuctionTheme_using_permalinks() == false)
                          echo '<input type="hidden" value="'.get_option('AuctionTheme_adv_search_id').'" name="page_id" />';
                      ?>
                      <input type="text" class="form-control" placeholder="Search Properties" name="srch-term" id="srch-term" onfocus="this.value=''" name="term" autocomplete="off" onkeyup="suggest(this.value);" 
                      onblur="fill();" />
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        
                      </div>
                    </div>
                  </form>
                    
                  <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> 
                    <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                    <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                  </div>
                </div>

              <?php
              if($m == 0):
              ?>
                 <ul class="nav navbar-nav navbar-left">                      
                    <li><a href="<?php echo get_page_link(1287); ?>"><?php echo get_the_title(1287)?></a></li>  
                    <li><a href="<?php echo get_page_link(1282); ?>"><?php echo get_the_title(1282)?></a></li>  
                    <li><a href="<?php echo get_page_link(1289); ?>"><?php echo get_the_title(1289)?></a></li>  
                    <li><a href="<?php echo get_post_type_archive_link('auction'); ?>">All Properties</a></li>
                    <li><a href="<?php echo get_page_link(1524); ?>"><?php echo get_the_title(1524)?></a></li>
                    <li><a href="<?php echo get_page_link(1375); ?>"><?php echo get_the_title(1375)?></a></li>
					
                 </ul>
              <?php endif; ?>              
            </nav>
            </div>
            <!-- main menu place here -->
            <?php

              $AuctionTheme_show_main_menu = get_option('AuctionTheme_show_main_menu');
              if($AuctionTheme_show_main_menu != 'no'):     
                $menu_name = 'primary-auction-main-header';

              if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
                $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                $menu_items = wp_get_nav_menu_items($menu->term_id);
                $m = 0;     
                foreach ( (array) $menu_items as $key => $menu_item ) {
                  $title = $menu_item->title;
                  $url = $menu_item->url;
                  if(!empty($title))
                  $m++;
                }}
            ?>    
        </div>
      <?php 
      else:
      //--------
      endif;
      ?>
       
       <!-- main menu ending -->      
    </div>
	</div>	
    
    <?php if ( ! is_home() ) {?>

    <div class="container">

    <?php }?>

        