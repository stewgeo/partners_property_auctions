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


		<div id="site-info" class="row">
			<div class="col-md-6">
					<h4>Contact Us</h4>
					<h5><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:sales@partnerspropertyauctions.co.uk">sales@partnerspropertyauctions.co.uk</a></h5>
					<h5><span class="glyphicon glyphicon-earphone"></span> <a href="tel:07732374685">07732 374685</a></h5>
			</div>
			<div class="col-md-6">
				<div class="pull-right">
					<a href="<?php echo get_page_link(1607); ?>">Conditions of Sale</a> | 
					<a href="<?php echo get_page_link(1851); ?>">Privacy Policy</a> | 
					<a href="<?php echo get_page_link(1849); ?>">Partner Download Area</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
					<a href="http://www.tpos.co.uk/">
						<img src="<?php echo get_bloginfo('template_url');?>/images/footer/ombudsman.jpg">
					</a>
					<a href="http://www.nava.org.uk/">
						<img src="<?php echo get_bloginfo('template_url');?>/images/footer/nava.jpg">
					</a>
					<a href="http://www.tradingstandards.gov.uk/">
						<img src="<?php echo get_bloginfo('template_url');?>/images/footer/trading_standards_logo.png">
					</a>
				</div>
				<div class="col-md-6">
					<div class="pull-right">				
						<div class="text-muted">Copyright &copy; Partners Property Auctions <?php 
						$time = time () ; 
						$year= date("Y",$time) . "<br>"; 
						echo $year;
						?> </div>			
					</div>	
				</div>
			</div>
		</div>
	</div>

</div>


</div>
<div class = "modal fade" id = "contact" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <form role="form" class="form-horizontal" method="post" action="<?php echo get_bloginfo('template_url');?>/contact_action.php">
                                <div class = "modal-header">
                                    <h4>Contact Us</h4>
                                </div>
                                <div class = "modal-body">
                               
                                    <div class = "form-group hide">
                                       
                                        <label for = "to" class = "col-lg-2 control-label">To:</label>
                                        <div class = "col-lg-10">
                                           
                                            <input type = "text" class = "form-control" id = "to" name="to" value="">
                                           
                                        </div>
                                       
                                    </div>
                                    <div class = "form-group">
                                       
                                        <label for = "contact-name" class = "col-lg-2 control-label">Name:</label>
                                        <div class = "col-lg-10">
                                           
                                            <input type = "text" class = "form-control" id = "contact-name" name="contact-name" placeholder = "Full Name">
                                           
                                        </div>
                                       
                                    </div>
                                   
                                    <div class = "form-group">
                                       
                                        <label for = "contact-email" class = "col-lg-2 control-label">Email:</label>
                                        <div class = "col-lg-10">
                                           
                                            <input type = "email" class = "form-control" id = "contact-email" name = "contact-email" placeholder = "you@example.com">
                                           
                                        </div>
                                       
                                    </div>
                                    
                                   <div class = "form-group">
                                       
                                        <label for = "contact-subject" class = "col-lg-2 control-label">Subject:</label>
                                        <div class = "col-lg-10">
                                           
                                            <input type = "text" class = "form-control" id = "contact-subject" name = "contact-subject" placeholder = "Message Subject">
                                           
                                        </div>
                                       
                                    </div>
                                    
                                    <div class = "form-group">
                                       
                                        <label for = "contact-msg" class = "col-lg-2 control-label">Message:</label>
                                        <div class = "col-lg-10">
                                           
                                            <textarea class = "form-control" name="contact-msg" rows = "8" id="contact-msg"></textarea>
                                           
                                        </div>
                                       
                                    </div>
                               
                                </div>
                                <div class = "modal-footer">
                            <a class = "btn btn-default" data-dismiss = "modal">Close</a>    
                                    <button class = "btn btn-primary" type = "submit" value="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

<?php wp_footer(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />    
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.css" />
  	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/overrides.css" />  
<script type="text/javascript">
	$(document).on("click", ".open-contact", function () {
     var toField = $(this).data('to');
     $(".modal-body #to").val( toField );
	 
	 var subjectField = $(this).data('contact-subject');
     $(".modal-body #contact-subject").val( subjectField );
});
</script>
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
			var minus_watchlist 	= "<?php echo __('- Favourites','AuctionTheme'); ?>";
			var plus_watchlist 		= "<?php echo __('+ Favourites','AuctionTheme'); ?>";
			 
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
	  
	  
	  
	  jQuery("#auction-home-page-main-inner").show();	
	  
	  <?php endif; ?>
	  
	});	
		
	
		
	</script>

     
     <!-- ########################################## -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-47293646-1', 'partnerspropertyauctions.co.uk');
	  ga('send', 'pageview');

	</script>
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
</body>
</html>