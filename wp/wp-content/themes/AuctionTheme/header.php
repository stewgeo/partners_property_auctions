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
	<title>
	<?php
		wp_title();
	?>
    </title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />    
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/overrides.css" />  
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>

	<?php

		wp_head();

	?>	

    <?php do_action('AuctionTheme_before_head_tag_open'); ?>
   
     <!-- ########################################### -->
     
             <script type="text/javascript">
			 
			 <?php
			 	
				global $wp_query, $wp_rewrite, $post;
				
				$watchlist_pid = get_option('AuctionTheme_watch_list_id');
				
				if($post->ID == $watchlist_pid)
			 	$on_check_list = 1; else $on_check_list = 0;
				
			 
			 ?>
			
		var $ = jQuery;
			 
			var SITE_URL 			= '<?php echo get_bloginfo('siteurl'); ?>';
			var is_on_check_list 	= '<?php echo $on_check_list; ?>';
			var minus_watchlist 	= "<?php echo __('- watchlist','AuctionTheme'); ?>";
			var plus_watchlist 		= "<?php echo __('+ watchlist','AuctionTheme'); ?>";
			 
	function suggest(inputString){
	
		if(inputString.length == 0) {
			jQuery('#suggestions').fadeOut();
		} else {  
		jQuery('#big-search').addClass('load');
			jQuery.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				
				var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
				
				
				if(data.length >0) {
					jQuery('#suggestions').fadeIn();
					jQuery('#suggestionsList').html(data);
					jQuery('#big-search').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		//jQuery('#big-search').val(thisValue);
		//setTimeout("$('#suggestions').fadeOut();", 600);
	}
	 
	
	jQuery(function(){
		
	jQuery('.expiration_auction_p').each(function(index) 
	{
		var until_now = jQuery(this).html();
		jQuery(this).countdown({until: until_now, format: 'dHMS', compact: false});
											   
	
	});
											 
		
	<?php
		
		if(auctiontheme_is_home()):
	
	?>	
		
	  jQuery('#slider2').bxSlider({
		auto: true,
		speed: 1000,
		pause: 5000,
		autoControls: false,
		 displaySlideQty: 5,
    	moveSlideQty: 1
	  });
	  
	  
	  
	  jQuery("#auction-home-page-main-inner").show();	
	  
	  <?php endif; ?>
	  
	});	
		
	
		
	</script>
     <?php
	 	
		$AuctionTheme_color_for_footer = get_option('AuctionTheme_color_for_footer');
		if(!empty($AuctionTheme_color_for_footer))
		{
			echo '<style> #footer { background:#'.$AuctionTheme_color_for_footer.' }</style>';	
		}
		
		
		$AuctionTheme_color_for_bk = get_option('AuctionTheme_color_for_bk');
		if(!empty($AuctionTheme_color_for_bk))
		{
			echo '<style> body { background:#'.$AuctionTheme_color_for_bk.' }</style>';	
		}
		
		$AuctionTheme_color_for_top_links = get_option('AuctionTheme_color_for_top_links');
		$AuctionTheme_color_for_top_links2 = get_option('AuctionTheme_color_for_top_links2');
		
		if(!empty($AuctionTheme_color_for_top_links))
		{
			echo '<style> .top-links ul li a:link, .top-links ul li a:visited { background:#'.$AuctionTheme_color_for_top_links.' }
			.top-links ul li a:hover { background:#'.$AuctionTheme_color_for_top_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		$AuctionTheme_color_for_main_links = get_option('AuctionTheme_color_for_main_links');

		
		if(!empty($AuctionTheme_color_for_main_links))
		{
			$AuctionTheme_color_for_main_links2 = get_option('AuctionTheme_color_for_main_links2');
			$AuctionTheme_color_for_main_links3 = get_option('AuctionTheme_color_for_main_links3');
			$AuctionTheme_color_for_main_links4 = get_option('AuctionTheme_color_for_main_links4');
		
			echo '<style> 
			
			.main-thing-menu { background: #'.$AuctionTheme_color_for_main_links.'; border-color:#'.$AuctionTheme_color_for_main_links4.' }
			.main-thing-menu ul li a:link, .main-thing-menu ul li a:visited 
			{ background:#'.$AuctionTheme_color_for_main_links.'; color:#'.$AuctionTheme_color_for_main_links3.';  }
			.main-thing-menu ul li a:hover { background:#'.$AuctionTheme_color_for_main_links2.';  color:#'.$AuctionTheme_color_for_main_links3.' }
			
			</style>';	
		}
		
		//----------------------
		
		$AuctionTheme_color_for_text_footer = get_option('AuctionTheme_color_for_text_footer');
		
		if(!empty($AuctionTheme_color_for_top_links))
		{
			echo '<style> 
			
			#footer-widget-area,#site-info, #footer-widget-area div ul li .widget-title, #footer .textwidget{ color:#'.$AuctionTheme_color_for_text_footer.' }
			#footer a:link, #footer a:visited { color:#'.$AuctionTheme_color_for_text_footer.' }
			#footer a:hover { color:#'.$AuctionTheme_color_for_text_footer.' }
			#site-info { border-color: #'.$AuctionTheme_color_for_text_footer.'  }
			
			</style>';	
		}
		
		
		
		//----------------------
		
	 	$AuctionTheme_home_page_layout = get_option('AuctionTheme_home_page_layout');
		if(AuctionTheme_is_home()):
			if($AuctionTheme_home_page_layout == "4"):
				echo '<style>#content { float:right; width:695px } #left-sidebar { float:left; }</style>';
			endif;
			
			if($AuctionTheme_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($AuctionTheme_home_page_layout == "3"):
				echo '<style>#content { width:410px } .title_holder { width:257px; margin-bottom:15px } #left-sidebar{	float:left;margin-right:15px;}
				 </style>';
			endif;
			
			
			if($AuctionTheme_home_page_layout == "2"):
				echo '<style>#content { width:410px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; } .title_holder { width:257px; margin-bottom:15px }
				 </style>';
			endif;
		
		endif;
	 
	 
	 ?>
     
     <!-- ########################################## -->
     
	</head>
	<body <?php body_class(); ?> >
    
    
  <?php  
    
    global $default_search;
		
		?>

     <div id="header" class="navbar navbar-default navbar-static-top" role="navigation" >
      	<div class="container">
		       <!-- start your search bar -->
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
          </div> <!-- middle-header-bg -->
          <div class="navbar-collapse collapse">

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
          
              <?php
              if($m == 0):
              ?>
                 <ul class="nav navbar-nav navbar-right">
                <?php /*?>        
                  <li><a href="<?php echo get_page_link(1375); ?>"><?php echo get_the_title(1375)?></a></li>  
                <?php */?>                    
                <li><a href="<?php echo get_page_link(1287); ?>"><?php echo get_the_title(1287)?></a></li>  
                <li><a href="<?php echo get_page_link(1282); ?>"><?php echo get_the_title(1282)?></a></li>  
                <li><a href="<?php echo get_page_link(1289); ?>"><?php echo get_the_title(1289)?></a></li>  
                <li><a href="<?php echo get_post_type_archive_link('auction'); ?>">All Properties</a></li>
                <li><a href="<?php echo get_page_link(1524); ?>"><?php echo get_the_title(1524)?></a></li>  
                <?php /*?>
                  <li><a href="<?php echo get_permalink(get_option('AuctionTheme_adv_search_id')); ?>"><?php _e('Advanced Search','AuctionTheme'); ?></a></li>     
                  <li><a href="<?php echo get_page_link(1264); ?>"><?php echo get_the_title(1264)?></a></li>     
                <?php */?>
              </ul>
              <?php else: 
          
                $event = 'hover';
                $effect = 'fade';
                $fullWidth = ',fullWidth: true';
                $speed = 0;
                $submenu_width = 200;
                $menuwidth = 100;
        
              ?>
            
                <script type="text/javascript">
                  var $ = jQuery;
                  
                  jQuery(document).ready(function($) {
                    jQuery('#<?php echo 'item_main_menus'; ?> .menu').dcMegaMenu({
                      rowItems: <?php echo $menuwidth; ?>,
                      subMenuWidth: '<?php echo $submenu_width; ?>',
                      speed: <?php echo $speed; ?>,
                      effect: '<?php echo $effect; ?>',
                      event: '<?php echo $event; ?>'
                      <?php echo $fullWidth; ?>
                    });
                  });
                </script>

                <div class="dcjq-mega-menu" id="<?php echo 'item_main_menus'; ?>">    
                  <?php
                    
                    $menu_name = 'primary-auction-main-header';

                    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) 
                      $nav_menu = wp_get_nav_menu_object( $locations[ $menu_name ] );         
                      wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
                  ?>    
                </div>
              <?php endif; ?>
              <?php 
              else:
              //--------
              endif;
              ?>
          </div>   
        </div>
      </div>
    <?php if ( ! is_home() ) {?>

    <div class="container">

    <?php }?>

      