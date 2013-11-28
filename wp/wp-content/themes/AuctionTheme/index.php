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



get_header();

//-----------------------------------------------

	$AuctionTheme_adv_code_home_above_content = stripslashes(get_option('AuctionTheme_adv_code_home_above_content'));
		if(!empty($AuctionTheme_adv_code_home_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo stripslashes($AuctionTheme_adv_code_home_above_content);
			echo '</div>';
		
		endif;
		
//----------------------------------------------		
		
		if(AuctionTheme_is_home())
		{
			$opt = get_option('AuctionTheme_show_stretch');
			
			if(	$opt != "no"):
								
				echo '<div class="stretch-area"> <ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div>';	
				
			endif;	
		}	
		
		
		
		
		
		$AuctionTheme_home_page_layout = get_option('AuctionTheme_home_page_layout');
		
		if($AuctionTheme_home_page_layout == "3" or $AuctionTheme_home_page_layout == "4" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
		
		

?>
	
    


	<div id="content">
    	<ul class="xoxo">
        	<li class="widget-container latest-posted-auctions-big">
        		<?php
				
					include 'latest-posted-auctions.php';
				
				?>
        	</li>
            
            <?php dynamic_sidebar( 'main-page-widget-area' ); ?>
            
        </ul>   
    </div>
    
    <!-- ############################ -->
    
   <?php if($AuctionTheme_home_page_layout != "5" && $AuctionTheme_home_page_layout != "4"): ?>
	
    <div id="right-sidebar">
		<ul class="xoxo">
	 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>

	<?php endif; ?>
    
    
    <?php
	
		if($AuctionTheme_home_page_layout == "2" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
	
	?>
    
    

<?php get_footer(); ?>