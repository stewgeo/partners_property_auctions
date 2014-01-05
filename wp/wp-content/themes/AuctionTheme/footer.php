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
			<div class="span12">
				<div class="pull-left">

					<h3>Copyright &copy; Partners Property Auctions <?php 
					$time = time () ; 
					$year= date("Y",$time) . "<br>"; 
					echo $year;
					?> </h3>

				</div>
				<div class="pull-right">
					<a href="<?php echo get_page_link(1607); ?>">Conditions of Sale</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<div class="pull-left">
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
			</div>
		</div>
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