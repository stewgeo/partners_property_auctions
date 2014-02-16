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
		
/**----------------------------------------------		
		
		if(AuctionTheme_is_home())
		{
			$opt = get_option('AuctionTheme_show_stretch');
			
			if(	$opt != "no"):
								
				echo '<div class="stretch-area"> <ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div>';	
				
			endif;	
		}	
		
**/
		
		
		
		$AuctionTheme_home_page_layout = get_option('AuctionTheme_home_page_layout');
		
		if($AuctionTheme_home_page_layout == "3" or $AuctionTheme_home_page_layout == "4" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
		
		

?>
	
	<div class="panel-starter">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h2>Buy and sell property at auction in Yorkshire.</h2>
        <ul class="lead">
          <li>Independent Auctioneers</li>
          <li>Established estate agent partners</li>
          <li>Faster route to market </li>
          <li>Large local audience</li>
          <li>Highly competitive rates</li>
        </ul>
  		</div>
      <div id="newsletter-panel" class="col-md-4 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Newsletter</strong>
          </div>
          <div class="panel-body">
          <form action="http://partnerspropertyauctions.us3.list-manage.com/subscribe/post" method="POST" role="form" class="form form-inline">
            <input type="hidden" name="u" value="ff1e4de7554ad2af54c92698f">
            <input type="hidden" name="id" value="f21d2e6f30">
            <label for="email">Receive regular updates on new properties and auction details.</label>
            <div class="form-group">
              <input type="email" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" class="form-control" size="25" value="" required="" placeholder="Your email address">

            </div>
            <input type="submit" class="btn" name="submit" value="Subscribe"></form>
            </div>
        </div>
      </div>   
    </div>    
  </div>

  </div>
	</div>
<div class="container">

  <div class="row">
    <div class="col-md-8 partners-featured">
      <h3>Featured Partners</h3>      
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=7"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/yhomes.png" class="img-responsive"></a>
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=5"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/churchills.png" class="img-responsive"></a>
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=4"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/hudson-moody.png" class="img-responsive"></a> 
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=10"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/giles-edwards.png" class="img-responsive"></a>
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=6"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/quantum.gif" class="img-responsive"></a>
        <a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=8"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/austin-brooks.png" class="img-responsive"></a>
		<a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=11"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/ribston-pippin.png" class="img-responsive"></a>
		<a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=12"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/martin_&_co.png" class="img-responsive"></a>
		<a href="<?php bloginfo('wpurl'); ?>/?a_action=user_profile&post_author=13"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/partners/peter-moody.png" class="img-responsive"></a>

    </div>
    <div id="news-panel" class="col-md-4">
      <h4>Latest News</h4>
      <div>
       <?php get_news_posts(); ?> 
      </div>
    </div>
  </div>
  <?php auctionTheme_get_homepage_post_function();?>     

<?php get_footer(); ?>