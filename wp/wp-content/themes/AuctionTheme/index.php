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
	
	<div class="row panel-starter">
  <div class="container">
		<div class="col-md-9">
      <h2>Partners Property Auctions. Yorkshire's Property Auction<h2>
      <h4>Simply connecting buyers with sellers.</h4>
      <ul>
        <li>Largest Range</li>
        <li>Buyers and Sellers Win</li>
        <li>Coverage for the whole of Yorkshire</li>
      </ul>
		</div>
    <div class="col-md-3">

  		<div id="news-panel">
  			<div class="panel panel-default">
  			  <div class="panel-heading">
            <strong>  News</strong>
          </div>
  			  <div class="panel-body">
            <p>
  			     First Auction on 14th March.
            </p>
            <p>
              3 new partners signed up.
            </p>       
  			  </div>
  			</div>			
  		</div>
  </div>

  </div>
	</div>
<div class="container">

  <div class="row">
    <div class="col-md-8">
      <h3>Partner Logos?</h3>
    </div>
    <div id="newsletter-panel" class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Newsletter</strong>
        </div>
        <div class="panel-body">
          <form method="post" action="#mc4wp-form-1" id="mc4wp-form-1" role="form" class="form form-inline">
            <label for="mc4wp_email">Receive regular updates on new properties and auction details.</label>
            <div class="form-group">
              <input class="form-control" type="email" id="mc4wp_email" name="EMAIL" required="" placeholder="Your email address">
            </div>

            <input type="submit" class="btn" value="Subscribe">
            <textarea name="mc4wp_required_but_not_really" style="display: none;"></textarea><input type="hidden" name="mc4wp_form_submit" value="1"><input type="hidden" name="mc4wp_form_instance" value="1"><input type="hidden" name="mc4wp_form_nonce" value="69577a4867"></form>    
        </div>
      </div>      
    </div>
  </div>

	<div id="featured-properties" class="row">
      <div class="col-md-12">
        <h3>Featured Properties</h3>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36085/36085_822430/Photo/36085_822430_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">Hamilton Way, Holgate</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36217/36217_1023180/Photo/36217_1023180_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">High Catton Road, Stamford Bridge, York</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36085/36085_124172/Photo/36085_124172_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">Sand Hutton, Sand Hutton</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36217/36217_1023219/Photo/36217_1023219_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">The Granary, Low Catton, York</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
  </div>      
  <div class="row">      
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36085/36085_123097/Photo/36085_123097_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">The Square, Tadcaster Road</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36217/36217_1021775/Photo/36217_1021775_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">New House Covert, Knapton</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36660/36660_1023315/Photo/36660_1023315_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">Gracious Street, York</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div> 
      <div class="img-panel col-md-3">
        <a href="http://localhost:8888/partners_property_auctions/wp/?auction=house-3">
          <img src="http://thumbs.rt-sb.net/Image.ashx?File=media/properties/36085/36085_1023684/Photo/36085_1023684_IMG_01.JPG" class="img-rounded-top img-responsive" alt="Uploaded image houses-by-the-river.jpg">
        </a>
        <div class="description">
          <div class="title">Bishopthorpe Road, Bishopthorpe Road</div>
          <div class="price">Guide $230,0000</div>
        </div>
      </div>       
  </div> 
    
    

<?php get_footer(); ?>