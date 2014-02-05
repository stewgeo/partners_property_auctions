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

function auctionTheme_colorbox_stuff()
{	
	
	echo '<link media="screen" type="text/css" rel="stylesheet" href="'.get_bloginfo('template_url').'/css/colorbox.css" />';
	/*echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>'; */
	echo '<script src="'.get_bloginfo('template_url').'/js/jquery.colorbox.js" type="text/javascript"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/js/jquery.confirm.js" type="text/javascript"></script>';
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/jquery.confirm.css" />';


	?>

	<script type="text/javascript">

	var $ = jQuery;
	var my_post_ok = 0;

	function precise_round(num,decimals){
		return Math.round(num*Math.pow(10,decimals))/Math.pow(10,decimals);
	}

	function add_my_currency(num){
		<?php

		if(get_option('AuctionTheme_currency_position') == "front"):
			
			?> return '<?php echo auctiontheme_get_currency(); ?>' + num;
		<?php else: ?>
		return num + '<?php echo auctiontheme_get_currency(); ?>';
		<?php endif; ?>
	} 

	function confirm_my_bid() {

		if(my_post_ok == 1) return true;

		var bid_am1			= parseFloat($("#bids_val").val());
		var bid_am 			= add_my_currency(bid_am1); 
		var bid_fee_en 		= <?php echo (get_option('AuctionTheme_add_fee_to_bid_enable') == "yes" ? 1 : 0 ); ?>;
		var bid_fee_percent = <?php $zg = get_option('AuctionTheme_add_fee_to_bid'); echo (empty($zg) ? 0 : $zg ); ?>;

		if(bid_fee_en == 1)
		{
			var bid_fee = parseFloat(precise_round(bid_am1 * 0.01 * bid_fee_percent, 2));

			bid_fee_ens = '<tr>'+
			'<td><?php _e('Bid Fee:','AuctionTheme'); ?></td>'+
			'<td>' + add_my_currency(parseFloat(bid_fee)) + '</td>' +
			'</tr>';

			bid_fee_ens2 = '<tr>'+
			'<td><?php _e('Total:','AuctionTheme'); ?></td>'+
			'<td>' + add_my_currency(parseFloat(precise_round(bid_fee + bid_am1,2)))  + '</td>' +
			'</tr>';

			bid_fee_ens = bid_fee_ens + bid_fee_ens2;

		}
		else
			bid_fee_ens = '';

		var mess = '<table width="100%" class="sitemile-table">'+
		'<tr>'+
		'<td><?php _e('Your bid amount:','AuctionTheme'); ?></td>'+
		'<td>'+ bid_am + '</td>' +
		'</tr>'
		+ bid_fee_ens + 
		'</table>';

		if(isNaN(bid_am1)) mess = '<?php _e('Please type in a bid value.','AuctionTheme'); ?>';

		$.confirm({
			'title'		: '<?php _e('Bid Confirmation','AuctionTheme'); ?>',
			'message'	: mess
			,
			'buttons'	: {
				'<?php _e('Yes, Place Bid','AuctionTheme'); ?>'	: {
					'class'	: 'blue',
					'action': function(){
						
						my_post_ok = 1; 
						$("#my_bid_form_1").submit();
						return true;
						
					}
				},
				'<?php _e('No','AuctionTheme'); ?>'	: {
					'class'	: 'gray',
					'action': function(){ return false; }	// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});
		
		return false;
		
	} 



	$(document).ready(function(){



		$("a[rel='image_gal1']").colorbox();
		$("a[rel='image_gal2']").colorbox();

		$("#report-this-link").click( function() {

			if($("#report-this").css('display') == 'none')					
				$("#report-this").show('slow');
			else
				$("#report-this").hide('slow');

			return false;
		});


		$("#contact_seller-link").click( function() {

			if($("#contact-seller").css('display') == 'none')					
				$("#contact-seller").show('slow');
			else
				$("#contact-seller").hide('slow');

			return false;
		});

	});
	</script>

	<?php
}

add_action('wp_head','auctionTheme_colorbox_stuff');	
	//=============================

global $current_user;
get_currentuserinfo();
$uid = $current_user->ID;
global $wpdb;


/*****************************************************
*
*	Post bid for reverse auction type.
*	Auction Theme since v4.3 - sitemile.com
*
******************************************************/	




if(isset($_POST['bid_now_reverse']))
{

	
	if(is_user_logged_in()):
		if(isset($_POST['control_id']))
		{
			$pid 		= base64_decode($_POST['control_id']);	
			$post 		= get_post($pid);
			$bid 		= trim($_POST['bid']);	
			$post 		= get_post($pid);
			$reverse    = get_post_meta(get_the_ID(), "reverse", true);
			$tm 		= current_time('timestamp',0);
			

			if($reverse == 'yes' || $reverse == '1'):

				$query = "select * from ".$wpdb->prefix."auction_bids where uid='$uid' AND pid='$pid'";
			$r = $wpdb->get_results($query);
			


			if(!is_numeric($bid)):
				
				$bid_posted = "0";
			$errors['numeric_bid_tp'] = __("Your bid must be numeric type. Eg: 9.99",'AuctionTheme');

			elseif($uid == $post->post_author):

				$bid_posted = "0";
			$errors['not_yours'] = __("You cannot bid your own auctions.",'AuctionTheme');

			elseif(count($r) > 0):

				$row 	= $r[0];
			$id 	= $row->id;


			$query 	= "update ".$wpdb->prefix."auction_bids set bid='$bid',date_made='$tm',uid='$uid' where id='$id'";
			$wpdb->query($query);
			$bid_posted = 1;

			
			add_post_meta($pid,'bid',$uid);


			else:

				$query = "insert into ".$wpdb->prefix."auction_bids (bid, uid, pid, date_made) values('$bid','$uid','$pid','$tm')";
			$wpdb->query($query);
			$bid_posted = 1;


			add_post_meta($pid,'bid',$uid);

				endif; // endif has bid already
				
			endif; //endif yes reverse
			
			
		}
		
		


		if($bid_posted == 1):
			
			

			//---------------------
			
			wp_redirect(get_permalink(get_the_ID()) . "/?bid_posted=1"); 
		exit;

		
		endif; //endif bid posted

		else:

		//$pid 		= base64_decode($_POST['control_id']);	
		//wp_redirect(get_bloginfo('siteurl')."/wp-login.php");
		//$_SESSION['redirect_me_back'] = get_permalink($pid);	
		//exit;

			$bid_posted = "0";
		
		$reeg = get_bloginfo('siteurl')."/wp-login.php?action=register";
		$loog = get_bloginfo('siteurl')."/wp-login.php";
		
		$errors['reg_bid'] = sprintf(__("You need to <a href='%s'>register</a> or <a href='%s'>login</a> to bid.",'AuctionTheme'),$reeg, $loog);
		
		endif;
	}
	
/*****************************************************
*
*	buy now for normal auction type.
*	Auction Theme since v4.3 - sitemile.com
*
******************************************************/	



if(isset($_POST['make_offer']))
{
	if(!is_user_logged_in())
	{
		$bid_posted = "0";

		$reeg = get_bloginfo('siteurl')."/wp-login.php?action=register";
		$loog = get_bloginfo('siteurl')."/wp-login.php";
		
		$errors['reg_bid'] = sprintf(__("You need to <a href='%s'>register</a> or <a href='%s'>login</a> to submit an offer.",'AuctionTheme'),$reeg, $loog);
		
	}
	elseif(isset($_POST['control_id']))
	{
		$pid 		= base64_decode($_POST['control_id']);	
		$post 		= get_post($pid);
		$closed    	= get_post_meta(get_the_ID(), "closed", true);

		if($closed == "0"):
			
			if($uid == $post->post_author):

				$bid_posted = "0";
			$errors['not_yours'] = __("You cannot submit an offer for your own auctions.",'AuctionTheme');

			else:

				wp_redirect(get_bloginfo('siteurl')."/?a_action=make_offer&pid=".$pid."&offered_price=" . $_POST['offered_price']);
			exit;
			
			endif;
			endif;
			
			
		}
	}
	
	if(isset($_POST['buy_now']))
	{
		if(!is_user_logged_in())
		{
			$bid_posted = "0";
			
			$reeg = get_bloginfo('siteurl')."/wp-login.php?action=register";
			$loog = get_bloginfo('siteurl')."/wp-login.php";

			$errors['reg_bid'] = sprintf(__("You need to <a href='%s'>register</a> or <a href='%s'>login</a> to bid.",'AuctionTheme'),$reeg, $loog);

		}
		elseif(isset($_POST['control_id']))
		{
			$pid 		= base64_decode($_POST['control_id']);	
			$post 		= get_post($pid);
			$closed    	= get_post_meta(get_the_ID(), "closed", true);
			
			if($closed == "0"):

				if($uid == $post->post_author):
					
					$bid_posted = "0";
				$errors['not_yours'] = __("You cannot bid your own auctions.",'AuctionTheme');
				
				else:

					wp_redirect(get_bloginfo('siteurl')."/?a_action=buy_now_commit&pid=".$pid);
				exit;

				endif;
				endif;


			}
		}


/*****************************************************
*
*	Post bid for normal auction type.
*	Auction Theme since v4.3 - sitemile.com
*
******************************************************/	

if(isset($_POST['bid_now']) or isset($_POST['bid_now_cc']))
{
	if(!is_user_logged_in())
	{
		$bid_posted = "0";

		$reeg = get_bloginfo('siteurl')."/wp-login.php?action=register";
		$loog = get_bloginfo('siteurl')."/wp-login.php";

		$errors['reg_bid'] = sprintf(__("You need to <a href='%s'>register</a> or <a href='%s'>login</a> to bid.",'AuctionTheme'),$reeg, $loog);
		
	}
	elseif(isset($_POST['control_id']))
	{
		$pid 		= base64_decode($_POST['control_id']);	
		$bid 		= trim($_POST['bid']);	
		$post 		= get_post($pid);
		$reverse    = get_post_meta(get_the_ID(), "reverse", true);
		$tm 		= current_time('timestamp',0);
		$closed    	= get_post_meta(get_the_ID(), "closed", true);
		$reserve    	= get_post_meta(get_the_ID(), "reserve", true);
		$bid_posted 	= 1;

		$AuctionTheme_add_fee_to_bid = get_option('AuctionTheme_add_fee_to_bid');
		$AuctionTheme_add_fee_to_bid_enable = get_option('AuctionTheme_add_fee_to_bid_enable');

		if($AuctionTheme_add_fee_to_bid_enable == "yes")
		{
			$bid = $bid + round(($AuctionTheme_add_fee_to_bid * 0.01 * $bid), 2);	
		}

		$isOK_to_bid = 1;

		$auctionTheme_enable_custom_bidding = get_option('auctionTheme_enable_custom_bidding');
		if($auctionTheme_enable_custom_bidding == "yes"):


			$credits = auctiontheme_get_credits($uid);
		$auctionTheme_get_bidding_fee = auctionTheme_get_bidding_fee($pid);



		if($auctionTheme_get_bidding_fee > $credits)
		{
			$lnk1 = AuctionTheme_get_payments_page_url('deposit');
			$errors['no_credts_bids'] = sprintf(__("You do not have enough balance for this action. The bidding fee for this item is %s. 
				<a href='%' target='_blank'>Click here</a> to deposit more.","AuctionTheme"), auctiontheme_get_show_price($auctionTheme_get_bidding_fee), $lnk1);
			$bid_posted = "0";	
			$has_credits_ok_ok = 0;
		}
		else
		{
			$has_credits_ok_ok = 1;	
		}

		endif;


		if($isOK_to_bid == 1):
			
			//---------------------------------------
			
			global $current_user;
		get_currentuserinfo();
		$uid = $current_user->ID;

		$buy_now = get_post_meta(get_the_ID(),'buy_now',true);

		if($closed == "0"):
			
			$highest_bid = auctionTheme_get_highest_bid($pid);
		$ownera = auctionTheme_get_highest_bid_owner($pid);


		$AuctionTheme_enable_increase_bid_limit = get_option('AuctionTheme_enable_increase_bid_limit');
		if($AuctionTheme_enable_increase_bid_limit == "yes" and $reverse != "yes")
		{
			$AuctionTheme_increase_bid_limit = get_option('AuctionTheme_increase_bid_limit');
			if(empty($AuctionTheme_increase_bid_limit)) $AuctionTheme_increase_bid_limit = 1;

			$AuctionTheme_enable_next_bid_custom_leves = get_option('AuctionTheme_enable_next_bid_custom_leves');
			if($AuctionTheme_enable_next_bid_custom_leves == "yes")
			{
				$highest_bid_temp = auctiontheme_get_custom_increase_value(auctionTheme_get_current_price($pid));	
				if($highest_bid_temp != false) 	$AuctionTheme_increase_bid_limit = 	$highest_bid_temp;

			}

			$highest_bid = $AuctionTheme_increase_bid_limit + $highest_bid;

		}


		if(!is_numeric($bid) and  $bid_posted != 0):

			$bid_posted = "0";
		$errors['numeric_bid_tp'] = __("Your bid must be numeric type. Eg: 9.99",'AuctionTheme');

		elseif($uid == $post->post_author and  $bid_posted != 0):

			$bid_posted = "0";
		$errors['not_yours'] = __("You cannot bid your own auctions.",'AuctionTheme');

		elseif(!empty($buy_now) && $bid >= $buy_now and  $bid_posted != 0):

			$bid_posted = "0";
		$errors['big_bigger'] = __("Your bid is greater than the buy now price. Use buy now instead.",'AuctionTheme');	

		elseif(trim($uid) == trim($ownera) and empty($reserve) and  $bid_posted != 0 ):

			$bid_posted = "0";

		if($reverse == "yes" or $reverse == "1")
			$errors['own_bid'] = __("Your bid is already the lowest bid.",'AuctionTheme');
		else					
			$errors['own_bid'] = __("Your bid is already the highest bid.",'AuctionTheme');

		elseif($highest_bid > $bid and $reverse == 'yes' and $bid_posted != 0):


			$opt = get_option('AuctionTheme_last_min_bid_ext');
		if($opt == "yes")
		{
			$extend_by = get_option('AuctionTheme_ext_time_by') * 60;
			$if_ending_time = get_option('AuctionTheme_ext_time_last') * 60;	

			$ending = get_post_meta($pid, 'ending', true);
			$tmleft = $ending - current_time('timestamp',0);

			if($tmleft < $if_ending_time) update_post_meta($pid,'ending', ($ending + $extend_by ));
		}

		$query = "insert into ".$wpdb->prefix."auction_bids (bid, uid, pid, date_made) values('$bid','$uid','$pid','$tm')";
		$wpdb->query($query);
		$bid_posted = 1;

		add_post_meta($pid,'bid',$uid);
		update_post_meta($pid,'current_bid',$bid);


		AuctionTheme_send_email_when_bid_item_bidder($pid, $uid, $bid);
		AuctionTheme_send_email_when_bid_item_owner($pid, $uid, $bid);

		$post_auts = get_post($pid);
		$uids_to_avoid = $post_auts->post_author;

		global $wpdb;
		$s_o = "select distinct uid from ".$wpdb->prefix."auction_bids where uid!='$uids_to_avoid' AND pid='$pid' order by bid asc limit 2";
		$r_0 = $wpdb->get_results($s_o);

		foreach($r_0 as $row_0)
		{							

			AuctionTheme_send_email_when_bid_item_outbid($pid, $row_0->uid, $bid);
		}

		if($has_credits_ok_ok == 1)	
			auctiontheme_charge_user_for_bidding($pid, $uid);


		$prm = AuctionTheme_using_permalinks();
		if($prm == true)			
			wp_redirect(get_permalink(get_the_ID()) . "/?bid_posted=1"); 
		else
		{
			wp_redirect(get_permalink(get_the_ID()) . "&bid_posted=1"); 	
		}


		elseif($highest_bid < $bid and $reverse != 'yes'):
				//bid ok, lets put it in DB

					/**************************
					*
					*	Addition since v4.4.8.3
					*	AuctionTheme - sitemile.com
					*
					**************************/
					
					$automatic_bid_enable = get_option('AuctionTheme_automatic_bid_enable');
					
					if($automatic_bid_enable == "yes"):


						$qq = "update ".$wpdb->prefix."auction_max_bids set reached='1' where uid='$uid' AND pid='$pid' ";
					$wpdb->query($qq);					
					
					$query = "insert into ".$wpdb->prefix."auction_max_bids (bid, uid, pid, date_made) values('$bid','$uid','$pid','$tm')";
					$wpdb->query($query);					
					
					$query = "select * from ".$wpdb->prefix."auction_max_bids where reached='0' AND pid='$pid' order by bid asc, date_made desc ";
					$res = $wpdb->get_results($query);
					
					$first = count($res) - 1;
					$i = 0;
					
					foreach($res as $row) 
					{

						$uid 	= $row->uid;
						$tm 	= current_time('timestamp',0);
						$bid	= $row->bid;

						if($i == $first)
						{
						//is the highest get_costPrice_gen2
							$current_bid 	= get_post_meta($pid,'current_bid', $bid);
						$diff 			= 1; // get_costPrice_gen2($current_bid);
						//echo $diff;
						
						$AuctionTheme_enable_increase_bid_limit = get_option('AuctionTheme_enable_increase_bid_limit');
						if($AuctionTheme_enable_increase_bid_limit == "yes")
						{
							$AuctionTheme_increase_bid_limit = get_option('AuctionTheme_increase_bid_limit');
							if(empty($AuctionTheme_increase_bid_limit)) $AuctionTheme_increase_bid_limit = 1;
							
							$AuctionTheme_enable_next_bid_custom_leves = get_option('AuctionTheme_enable_next_bid_custom_leves');
							if($AuctionTheme_enable_next_bid_custom_leves == "yes")
							{
								$highest_bid_temp = auctiontheme_get_custom_increase_value(auctionTheme_get_current_price($pid));	
								if($highest_bid_temp != false) 	$AuctionTheme_increase_bid_limit = 	$highest_bid_temp;

							}
							

						} else $AuctionTheme_increase_bid_limit = 1;

						
						if(($current_bid + $AuctionTheme_increase_bid_limit) < $bid)
						{
							$bid = $current_bid + $AuctionTheme_increase_bid_limit;	
						}
						else
						{
							$wpdb->query("update ".$wpdb->prefix."auction_max_bids set reached='1' where id='{$row->id}'");	
						}

					}
					else
					{
						$wpdb->query("update ".$wpdb->prefix."auction_max_bids set reached='1' where id='{$row->id}'");							
					}
					
					//-------
					
					$query = "insert into ".$wpdb->prefix."auction_bids (bid, uid, pid, date_made) values('$bid','$uid','$pid','$tm')";
					$wpdb->query($query);
					$bid_posted = 1;
					
					add_post_meta($pid,'bid',$uid);
					update_post_meta($pid, 'current_bid', $bid);
					
					AuctionTheme_send_email_when_bid_item_bidder($pid, $uid, $bid);
					AuctionTheme_send_email_when_bid_item_owner($pid, $uid, $bid);
					
					//-----email to the other lower bidders-----
					
					global $wpdb;
					$s_o = "select distinct uid from ".$wpdb->prefix."auction_bids where uid!='$uid' AND pid='$pid' order by bid desc limit 2";
					$r_o = $wpdb->get_results($s_o);
					
					foreach($r_o as $row_o)
					{							
						AuctionTheme_send_email_when_bid_item_outbid($pid, $row_o->uid, $bid);
					}

					$i++;

				}
					//----------

				elseif($bid_posted != "0"):

					if($has_credits_ok_ok == 1)	
						auctiontheme_charge_user_for_bidding($pid, $uid);

					$opt = get_option('AuctionTheme_last_min_bid_ext');
					if($opt == "yes")
					{
						$extend_by = get_option('AuctionTheme_ext_time_by') * 60;
						$if_ending_time = get_option('AuctionTheme_ext_time_last') * 60;	

						$ending = get_post_meta($pid, 'ending', true);
						$tmleft = $ending - current_time('timestamp',0);

						if($tmleft < $if_ending_time) update_post_meta($pid,'ending', ($ending + $extend_by ));
					}

					$query = "insert into ".$wpdb->prefix."auction_bids (bid, uid, pid, date_made) values('$bid','$uid','$pid','$tm')";
					$wpdb->query($query);
					$bid_posted = 1;

					add_post_meta($pid,'bid',$uid);
					update_post_meta($pid,'current_bid',$bid);


					AuctionTheme_send_email_when_bid_item_bidder($pid, $uid, $bid);
					AuctionTheme_send_email_when_bid_item_owner($pid, $uid, $bid);


					global $wpdb;
					$s_o = "select distinct uid from ".$wpdb->prefix."auction_bids where uid!='$uid' AND pid='$pid'";
					$r_0 = $wpdb->get_results($s_o);
					
					foreach($r_0 as $row_0)
					{							

						AuctionTheme_send_email_when_bid_item_outbid($pid, $row_0->uid, $bid);
					}


					endif;
					
					if($bid_posted != "0"):


						$prm = AuctionTheme_using_permalinks();
					if($prm == true)			
						wp_redirect(get_permalink(get_the_ID()) . "/?bid_posted=1"); 
					else
					{
						wp_redirect(get_permalink(get_the_ID()) . "&bid_posted=1"); 	
					}


					exit; 
					endif;
					
					elseif($reverse != "yes"):

						$errors['higher_bid'] = sprintf(__("Your bid must be higher than %s.","AuctionTheme"), auctiontheme_get_show_price($highest_bid));
					$bid_posted = "0";

					elseif($reverse != "no"):

						$errors['lower_bid'] = __("Your bid must be lower than the last bid.","AuctionTheme");
					$bid_posted = "0";	
					
				endif; // endif has bid already
				
			endif; //endif yes reverse
			endif;
			
		}
		
		
	}
	

	
	
	//=============================
	
	get_header();
	?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="content">
		<?php 

		if(function_exists('bcn_display'))
		{
			echo '<div class="my_box3"> <div class="padd10"> ';	
			bcn_display();
			echo '</div></div> <div class="clear10"></div>';
		}

		?>	




		<?php

		$reverse    = get_post_meta(get_the_ID(), "reverse", true);
		$location   = get_post_meta(get_the_ID(), "Location", true);
		$ending     = get_post_meta(get_the_ID(), "ending", true);

		$views    	= get_post_meta(get_the_ID(), "views", true);
		$views 		= $views + 1;

		if(!AuctionTheme_is_owner_of_post())
			update_post_meta(get_the_ID(), "views", $views);

		global $current_user;
		get_currentuserinfo();
		$uid = $current_user->ID;

		$pid = get_the_ID();

	//$bid = get_post_meta(get_the_ID(), 'bid');
	//print_r($bid);
		?>	

		<?php

		if(isset($_POST['report_this']))
		{
			$ss = $_SESSION['reported_id_' . get_the_ID()];

			if(empty($ss))
			{
				$_SESSION['reported_id_' . get_the_ID()] = 'done';
				AuctionTheme_send_email(get_bloginfo('admin_email'), 'Reported item: '.get_the_title(), $_POST['reason_report']);
				echo '<div class="saved_thing">'.__('Item was reported to the administrator of the website.','AuctionTheme').'</div>';
				echo '<div class="clear10"></div>';
			}
		}


		?>


		<div id="report-this" style="display:none">
			<div class="my_box3">


				<div class="box_title"><?php echo __("Report this auction",'AuctionTheme'); ?></div>
				<div class="box_content">
					<?php
					
					if(is_user_logged_in()):	

						?>


					<form method="post"><input type="hidden" value="<?php the_ID(); ?>" name="pid_rep" />
						<ul class="post-new5">


							<li>
								<h2><?php echo __('Reason for reporting','AuctionTheme'); ?>:</h2>
								<p><textarea rows="4" cols="40" class="do_input"  name="reason_report"></textarea></p>
							</li>




							<li>
								<h2>&nbsp;</h2>
								<p><input type="submit" name="report_this" value="<?php _e('Submit Report','AuctionTheme'); ?>" /></p>
							</li>


						</ul>
					</form>
					<?php else:

					echo __('You need to be logged in to report.','AuctionTheme');

					?>

				<?php endif; ?>     


			</div>
		</div>

		<div class="clear10"></div>

	</div>



	<?php do_action('AuctionTheme_auction_page_before_title_div'); ?>


	<div id="single-property-details" class="row">
		<div class="col-md-8">
			<div class="auction_page_title">
				<div class="pull-left">
					<h1><?php the_title() ?>
						<br>
						<small>
							<?php
								$location = get_post_meta($pid, "Location", true);	
								echo $location;
							?>
						</small>
					</h1>
				</div>
				<div class="pull-right">
					<h4>
						<small><?php echo __("Guide Price","AuctionTheme"); ?></small>
						<br>
						<?php echo get_post_meta(get_the_ID(), 'guide_price' ,true); ?>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="ad-page-image-holder">
						<?php echo AuctionTheme_get_first_post_image(get_the_ID(), 750, 600, 'img_class'); ?>

						<?php
						
						$arr = AuctionTheme_get_post_images(get_the_ID(), 12);

						if($arr)
						{
							

							echo '<ul class="image-gallery" style="padding-top:10px">';
							foreach($arr as $image)
							{
								echo '<li><a href="'.AuctionTheme_wp_get_attachment_image($image, array(900, 700)).'" rel="image_gal1">'.wp_get_attachment_image( $image, array(50, 50) ).'</a></li>';
							}
							echo '</ul>';


						}
						//else { echo __('No images.') ;}
						
						?>

					</div>

					<?php

					$start_price = auctionTheme_get_start_price(get_the_ID());
					$current	 = auctionTheme_get_current_price(get_the_ID());
					$buy_now	 = auctionTheme_get_buy_it_now_price(get_the_ID());
					$closed 	 = get_post_meta(get_the_ID(),'closed',true);

					?>
          <div>
            <span class="auction-resource-item"><?php 
              if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):        
                ?>
              <span class='glyphicon glyphicon-bookmark'></span>
              <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('Favourites','AuctionTheme'); ?></a>
              <?php else: ?>
              <span class='glyphicon glyphicon-bookmark'></span>
              <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('Favourites','AuctionTheme'); ?></a>
              <?php endif; ?>   
            </span>     
          
            <span class="auction-resource-item">
              <span class="glyphicon glyphicon-leaf"></span>
              <a href="<?php global $post;
              $pid = $post->ID;
              echo get_post_meta($pid, 'epc', true); ?>" title="Energy Performance Certificate">Energy Performance Certificate</a>
            </span>
            <span class="auction-resource-item">
              <?php 
              
              global $post;
              $pid = $post->ID;
              
              $legal=get_post_meta($pid, 'legal_pack', true);
              if(empty($legal)){?>
              <span class='glyphicon glyphicon-file'></span>
              <a href = '#contact' class='open-contact' data-toggle='modal' data-to='info@partnerspropertyauctions.co.uk' data-contact-subject="Register interest for legal pack for <?php $location = get_post_meta($pid, "Location", true); 
              echo $location; ?>">Legal Pack Being Prepared</a><?php
              }
              else {
                echo "<span class='glyphicon glyphicon-file'></span>";
                echo "<a href = '" . $legal . " ' title='Legal Pack'>Legal Pack</a></li>";
              }
              ?>
            </span>
            <span class="auction-resource-item">
              <span class='glyphicon glyphicon-print'></span>
              <a href="javascript:window.print()">Click to Print This Page</a>
            </span>
          </div>
        </div>      
			</div>

      <!-- ########### Specifics ############ -->
      <div class="row">
        <?php

        $arrms = get_auction_fields_values($post->ID);
        if(count($arrms) > 0) 
        {
        } ?>
        <div class="col-md-12">
          <div class="box_title"><?php _e("At a Glance",'AuctionTheme'); ?></div>
          <div class="box_content">
            <p>
              <ul class="other-dets5">
                <li>            
                  <?php
                    if(count($arrms) > 0) 
                    {
                  ?>
                
                  <table width="100%">
                    <?php
                    for($i=0;$i<count($arrms);$i++)
                    {

                      ?>
                      <tr>

                        <th class="gold_thing_th"><?php echo $arrms[$i]['field_name'];?></th>
                        <th><?php 


                        if(is_array($arrms[$i]['field_value'][0]))
                        {

                          foreach($arrms[$i]['field_value'][0] as $vl)
                          {

                            echo $vl  .'<br/>';
                          }
                        }
                        else echo $arrms[$i]['field_value'][0];
                        ?></th>
                      </tr>
                      <?php } ?>
                  </table>
                <?php } ?>
              </ul>
            </p>
          </div>
        </div>
      </div>

			<!-- ########### DESCRIPTION ############ -->
			<div class="row">
				<?php do_action('AuctionTheme_auction_page_before_description_div'); ?>
				<div class="col-md-12">
					<div class="box_title"><?php echo __("Description","AuctionTheme"); ?></div>
					<div class="box_content">
						<p><?php the_content(); ?></p>
					</div>
				</div>
			</div>

			<!-- ########### MAP ############ -->

			<div class="row">
				<?php do_action('AuctionTheme_auction_page_before_map_div'); ?>

				<?php

				$AuctionTheme_enable_locations = get_option('AuctionTheme_enable_locations');
				if($AuctionTheme_enable_locations != 'no'):	
				?>

				<div class="col-md-12">
					<div class="box_title"><?php echo __("Map Location",'AuctionTheme'); ?></div>
					<div class="box_content">

						<div id="map" style="width: 100%; height: 300px;border:2px solid #ccc;float:left"></div>

						<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 

						<script type="text/javascript"
						src="<?php echo get_bloginfo('template_url'); ?>/js/mk.js"></script> 
						<script type="text/javascript"> 

						var geocoder;
						var map;
						function initialize() {
							geocoder = new google.maps.Geocoder();
							var latlng = new google.maps.LatLng(-34.397, 150.644);
							var myOptions = {
								zoom: 13,
								center: latlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							}
							map = new google.maps.Map(document.getElementById("map"), myOptions);
						}

						function codeAddress(address) {

							geocoder.geocode( { 'address': address}, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									map.setCenter(results[0].geometry.location);
									var marker = new MarkerWithLabel({

										position: results[0].geometry.location,
										map: map,
										labelContent: address,
										labelAnchor: new google.maps.Point(22, 0),
				   	labelClass: "labels", // the CSS class for the label
				   	labelStyle: {opacity: 1.0}
						});
											} else {
						    //alert("Geocode was not successful for the following reason: " + status);
						}
						});
						}

						initialize();

						codeAddress("<?php 

							global $post;
							$pid = $post->ID;

							$terms = wp_get_post_terms($pid,'auction_location');
							foreach($terms as $term)
							{
								echo $term->name.",";
							}

							$location = get_post_meta($pid, "Location", true);	
							echo $location;

							?>");
						</script> 
					</div>
				</div>
				<div class="clear10"></div>
				<div class="tags-placeholder">
					<?php /*?>            <div class="tg1"><img src="<?php echo get_bloginfo('template_url'); ?>/images/tag.png" width="20" height="20" /> </div>
					<?php */?>            <div class="tg2"> 	 <?php the_tags(__('Tags', 'AuctionTheme').": ", ', ', ', '); ?></div> 
					<div class="tg3"> 	

						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style addthis_24x24_style">
							<a class="addthis_button_preferred_1"></a>
							<a class="addthis_button_preferred_2"></a>
							<a class="addthis_button_preferred_3"></a>
							<a class="addthis_button_preferred_4"></a>
							<a class="addthis_button_compact"></a>
							<a class="addthis_counter addthis_bubble_style"></a>
						</div>
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df68b4a2795dcd9"></script>
						<!-- AddThis Button END -->

					</div>
				</div>
			</div>
		</div>

		<!--###### Partners Right Panel#####-->
		<?php
		echo '<div class="col-md-4" class="page-sidebar">';
		?>
			<div class="arrange-viewing-btn">
				<?php $viewing=get_post_meta($pid, 'viewing_days' ,true);
				if(!empty($viewing)){
					echo "<h3>Viewing Day:</h3>" . $viewing . " or";?>
					<a href = "#contact" class="btn btn-success open-contact" data-toggle="modal" data-to="<?php

					if(get_the_author_meta('display_name') =="Hudson Moody"){
						echo "property@hudson-moody.com";
					}
					elseif(get_the_author_meta('display_name') =="YHomes"){
						echo "admin@yorkshirehomes.co.uk";
					}
					else {echo "jonnyrharper@gmail.com";}

					?>" data-contact-subject="Arrange a Viewing of <?php $location = get_post_meta($pid, "Location", true);	
					echo $location; ?>">Arrange a Viewing</a>
					<?php
				}
				else {?>
					<a href = "#contact" class="btn btn-success open-contact" role="button" data-toggle="modal" data-to="<?php

					if(get_the_author_meta('display_name') =="Hudson Moody"){
						echo "property@hudson-moody.com";
					}
					elseif(get_the_author_meta('display_name') =="YHomes"){
						echo "admin@yorkshirehomes.co.uk";
					}
					else {echo "jonnyrharper@gmail.com";}

					?>" data-contact-subject="Arrange a Viewing of <?php $location = get_post_meta($pid, "Location", true);	
					echo $location; ?>">Arrange a Viewing</a>
				<?php } ?>
			</div>		
			<ul class="xoxo">
        <li class="widget-container widget_text" id="ad-other-details">
          <h3 class="widget-title"><?php _e("Auction Details",'AuctionTheme'); ?></h3>
          <div class="my-only-widget-content">
          <ul class="auction-details">


            <?php /*?> <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="20" height="20" /> 
                <h3><?php echo __("Auction ID","AuctionTheme"); ?>:</h3>
                <p>#<?php the_ID(); ?></p>
              </li>
                        
                 <?php
             
             $reserve = get_post_meta(get_the_ID(),'reserve',true);
             
             if(!empty($reserve)):
             ?>    
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" width="20" height="20" /> 
                <h3><?php echo __("Reserve","AuctionTheme"); ?>:</h3>
                <p><?php 
                
                $prc = auctionTheme_get_current_price(get_the_ID());
                if($prc >= $reserve) echo __('Reserve price met.',"AuctionTheme");
                else echo __('Reserve price not met.',"AuctionTheme");
                 ?></p>
              </li> 
            <?php endif; ?>   <?php */?>
                           <?php /*?>                 
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/location.png" width="20" height="20" /> 
                <h3><?php echo __("Location","AuctionTheme"); ?>:</h3>
                <p><?php echo get_the_term_list( get_the_ID(), 'auction_location', '', ', ', '' ); ?></p>
              </li><?php */?>
              
              <?php /*?><li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="20" height="20" /> 
                <h3><?php echo __("Posted on","AuctionTheme"); ?>:</h3>
                <p><?php the_time("jS \o\\f F Y \a\\t g:i A"); ?></p>
              </li><?php */?>
              
              <?php
              
              if($closed == "0"): 
                $AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
              if($only_buy_now == "1" and $AuctionTheme_no_time_on_buy_now == "yes"): 
              //asd
                else:
                  ?>  
              <?php /*?><li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/clock.png" width="20" height="20" /> 
                <h3><?php echo __("Time Left","AuctionTheme"); ?>:</h3>
                                
                                <p class="expiration_auction_p"><?php echo ($closed == "0" ? ($ending - current_time('timestamp',0)) 
                : __("Expired/Closed","AuctionTheme")); ?></p>
                                
              <!--  <p><?php echo ($closed == "0" ? AuctionTheme_prepare_seconds_to_words($ending - current_time('timestamp',0)) 
                : __("Expired/Closed","AuctionTheme")); ?></p> -->
              </li><?php */?>
            <?php endif; endif; ?>
            <li>
              <?php /*?>                                      
              <img src="<?php echo get_bloginfo('template_url'); ?>/images/clock.png" width="20" height="20" /> 
              <?php */?>
              <span class="glyphicon glyphicon-calendar"></span>
              <span><?php _e("National Science Learning Centre, York",'AuctionTheme');?></span>
              </br>
              <?php echo get_the_term_list( $post->ID, 'auction_info', '', ' in ', '' ); ?>
            </li>
          </ul>            

          <?php if(AuctionTheme_is_owner_of_post()): ?>
          <div class="owner_act">
            <div class="padd10">

              <?php if($closed == "1"): ?>

              <?php printf(__('You are the owner of this auction. <a href="%s">Relist Auction</a>.','AuctionTheme'), get_bloginfo('siteurl').'/?a_action=relist_auction&pid='.get_the_ID()); ?>

            <?php else: ?>
            <?php

            if(auctionTheme_number_of_bid_see_and_buy_now(get_the_ID()) != false) { $mms = 1;
              
              ?>
              <?php printf(__('You are the owner of this auction. <a href="%s">Edit auction</a>.','AuctionTheme'), get_bloginfo('siteurl').'/?a_action=edit_auction&pid='.get_the_ID()); ?>

              <?php }


              if($mms != 1){ 
                if( get_option('AuctionTheme_enable_editing_when_bid_placed') == "yes"){        
                  ?>
                  <?php printf(__('You are the owner of this auction. <a href="%s">Edit auction</a>.','AuctionTheme'), get_bloginfo('siteurl').'/?a_action=edit_auction&pid='.get_the_ID()); ?>


                  <?php }} endif; ?>

            </div>
          </div>

          <?php endif; ?>

          <?php

          if($closed == "0") :
            if($bid_posted == "0"): ?> 

          <div class="bid_panel_err">
            <div class="padd10">
              <?php _e("Your bid has not been posted. Please correct the errors and try again.","AuctionTheme");
              echo '<br/>';
              foreach($errors as $err)
                echo $err.'<br/>';
              ?>
            </div>
          </div>

          <?php endif; ?>


          <?php if($_GET['rejected_offer'] == 1): ?>

          <div class="bid_panel_ok">
            <div class="padd10">
              <?php _e("You have rejected the offer.","AuctionTheme");

              ?>
            </div>
          </div>

          <?php endif; ?>

          <?php if($_GET['accepted_offer'] == 1): ?>

          <div class="bid_panel_ok">
            <div class="padd10">
              <?php _e("You have accepted the offer.","AuctionTheme");

              ?>
            </div>
          </div>

          <?php endif; ?>

          <?php if($_GET['offer_posted'] == 1): ?>
          
          <div class="bid_panel_ok">
            <div class="padd10">
              <?php _e("Your offer has been submitted to the buyer.","AuctionTheme");

              ?>
            </div>
          </div>

          <?php endif; ?>

          <?php if($_GET['bid_posted'] == 1): ?>

          <div class="bid_panel_ok">
            <div class="padd10">
              <?php _e("Your bid has been posted.","AuctionTheme");

              ?>
            </div>
          </div>

          <?php endif; ?>

          <?php

          $shipping = get_post_meta(get_the_ID(), 'shipping', true);
          if(is_numeric($shipping) && $shipping > 0 && !empty($shipping))
            $shp = '<b>'.auctionTheme_get_show_price($shipping).'</b><br/>';
          else $shipping = 0;

          if($shipping != 0):

            ?>  

                          <?php /*?><div class="bid_panel">
                          <div class="padd10">
                          <ul class="auction-details">
                        <li>
                          <h3><?php echo __("Shipping","AuctionTheme"); ?>:</h3>
                          <p><?php echo $shp; ?></p>
                        </li>
                          </ul>
                          </div>
                      </div><?php */?>
                  <?php endif; ?>



          <?php

          $only_buy_now = get_post_meta(get_the_ID(), 'only_buy_now', true);


          if($only_buy_now != '1'):

            ?>
          <!-- ######### -->

          <div>
            <div>
              <?php /*?>                
              <form method="post" id="my_bid_form_1" onsubmit="return confirm_my_bid();">
              <input type="hidden" value="1" name="bid_now_cc" /><?php */?>
              <ul class="auction-details">

                <?php /*?>
                <li>
                  <h3>&nbsp;</h3>
                  <p><input type="text" name="bid" id="bids_val" size="10" /> 
                  <input type="hidden" name="control_id" value="<?php echo base64_encode(get_the_ID()); ?>" />
                  <input class="my-buttons" type="submit" id="place_bid" name="bid_now" value="<?php _e("Place Bid","AuctionTheme"); ?>" /></p>
                </li><?php */?>
                              
              </ul>
              <?php /*?></form><?php */?>
            </div>
          </div>
                  
          <?php endif; ?>
          <?php 

          $allow_offers = get_post_meta(get_the_ID(),'allow_offers',true);
          if(!auctiontheme_see_if_offer_posted(get_the_ID(), $uid) and $allow_offers == "1"): 

            $AuctionTheme_currency_position = get_option('AuctionTheme_currency_position'); 

          ?>

          <div class="bid_panel">
            <div class="padd10">
              <form method="post"> <input type="hidden" name="control_id" value="<?php echo base64_encode(get_the_ID()); ?>" />
                <ul class="auction-details">

                  <li>
                    <h3><?php echo __("Make an Offer","AuctionTheme"); ?>:</h3>
                      <?php if($AuctionTheme_currency_position == "front") echo auctiontheme_get_currency(); ?>
                      <input type="text" size="5" name="offered_price" /> <?php if($AuctionTheme_currency_position != "front") echo auctiontheme_get_currency(); ?>
      
                      <input type="submit" class="btn btn-primary btn-sm" name="make_offer" value="<?php _e("Submit Offer","AuctionTheme"); ?>" />
                    </li>

                  </ul>
                </form>
              </div>
            </div>

              <?php endif; ?>
              <?php

              $offr = auctiontheme_waiting_to_answer_offer(get_the_ID(), $uid);

              if( $offr != false):

                ?>

              <div class="bid_panel">
                <div class="padd10">

                  <ul class="auction-details">

                    <li>
                      <?php

                      if($offr->counteroffer_sent == 0 and $offr->counteroffer_accepted == 0 and $offr->counteroffer_rejected == 0)               
                        echo sprintf(__("Your offer of %s was submitted. Waiting the seller's answer.","AuctionTheme"), auctiontheme_get_sumitted_offer_price(get_the_ID(),$uid)); ?>
                      <?php

                      if($offr->counteroffer_sent == 1 and $offr->counteroffer_accepted == 0 and $offr->counteroffer_rejected == 0)
                      {
                        if(get_post_meta(get_the_ID(), 'closed', true) == 0)
                        {
                          echo '<br/>' . sprintf(__('Seller sent counter offer of: %s','AuctionTheme'), auctiontheme_get_show_price($offr->counteroffer_price));
                          echo '<br/>' . '<a href="'.get_bloginfo('siteurl').'/?a_action=accept_counter_offer&pid='.get_the_ID().'&ids='.$offr->id.'">'.__('Accept Offer','AuctionTheme').'</a> | 
                          <a href="'.get_bloginfo('siteurl').'/?a_action=reject_counter_offer&pid='.get_the_ID().'&ids='.$offr->id.'">'.__('Reject Offer','AuctionTheme').'</a> ';    
                        }
                      }

                      ?>
                    </li>



                  </ul>

                </div>
              </div>


          <?php endif; ?>

          <?php 

          else: 
          // auction closed
            ?>

          <div class="bid_panel">
            <div class="padd10">

              <?php

              $pid = get_the_ID();
              $winner = get_post_meta(get_the_ID(), 'winner', true);
              if(!empty($winner))
              {

                global $wpdb;
                $q = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid' and winner='1'";
                $r = $wpdb->get_results($q);
                $r = $r[0];

                _e("Auction closed for price: ","AuctionTheme");
                echo auctionTheme_get_show_price($r->bid);

              }

              ?>

            </div>
          </div>
          <?php endif; ?>
        </li>
				<li class="widget-container widget_text" id="ad-other-details">
					<h3 class="widget-title"><?php _e("Partner Agent",'AuctionTheme'); ?></h3>
					<div class="my-only-widget-content">
						<p>

							<ul class="other-dets5">
								<li>
									<div class="pull-right" ><?php echo get_avatar( get_the_author_meta('email'), 96 );; ?></div>
									<p><?php the_author_description(); ?></p>
									<p class="auto-width"><a href="<?php echo AuctionTheme_get_user_profile_link($post->post_author);?>">See more properties by <?php the_author();?> </a></p>
								</li>
								<li>
										<a href = "#contact" data-toggle="modal" class="btn btn-default open-contact" data-to="<?php

										if(get_the_author_meta('display_name') =="Hudson Moody"){
											echo "property@hudson-moody.com";
										}
										elseif(get_the_author_meta('display_name') =="YHomes"){
											echo "admin@yorkshirehomes.co.uk";
										}
										else {echo "jonnyrharper@gmail.com";}
										
										?>" data-contact-subject="<?php $location = get_post_meta($pid, "Location", true);	
										echo $location; ?>">Contact <?php the_author() ?></a>       		</p>
								</li>
							</ul>
						</p>
					</div>
				</li>		
			</ul>
			<?php
				dynamic_sidebar( 'auction-widget-area' );
	 		?>
		</div>
	</div>


	<div class="clear10"></div>

	<?php do_action('AuctionTheme_auction_page_before_bids_div'); 

	$post = get_post(get_the_ID());
	$allow_offers = get_post_meta(get_the_ID(),'allow_offers',true);
	global $wpdb;

	if($allow_offers == "1" and $uid == $post->post_author):

		?>
	<!-- ####################### -->

	<div class="my_box3">
		<div class="box_title"><?php echo __("Received Offers",'AuctionTheme'); ?></div>
		<div class="box_content">
			<?php

			$s = "select * from ".$wpdb->prefix."auction_offers where pid='".get_the_ID()."'";
			$r = $wpdb->get_results($s);

			if(count($r) > 0)
			{
				echo '<table width="100%">';
				echo '<thead><tr>';
				echo '<th>'.__('Username','AuctionTheme').'</th>';
				echo '<th>'.__('Offer Price','AuctionTheme').'</th>';
				echo '<th>'.__('Date Made','AuctionTheme').'</th>';
				echo '<th>'.__('Options','AuctionTheme').'</th>';							
				echo '</tr></thead><tbody>';



				foreach($r as $row)
				{
					$user = $row->uid;
					$user = get_userdata($user); 

					echo '<tr>';
					echo '<th>'.$user->user_login.'</th>';
					echo '<th>'.auctiontheme_get_show_price($row->price).'</th>';
					echo '<th>'.date_i18n("d-m-Y H:i:s", $row->datemade).'</th>';

					$off_prc = sprintf(__('Counter Offer of %s sent', 'AuctionTheme'), auctiontheme_get_show_price($row->counteroffer_price));

					echo '<th>'.(($row->approved == 0 and $row->rejected == 0) ? ( $row->counteroffer_sent == 1 ? (

						($row->counteroffer_accepted == 0 and $row->counteroffer_rejected == 0) ? $off_prc : 
						($row->counteroffer_accepted == 1 ? __('Counter Offer Accepted','AuctionTheme') : __('Counter Offer Rejected','AuctionTheme'))

						) : (
						'<a href="'.get_bloginfo('siteurl').'/?a_action=accept_offer&pid='.get_the_ID().'&ids='.$row->id.'">'.__('Accept Offer','AuctionTheme').'</a> | 
						<a href="'.get_bloginfo('siteurl').'/?a_action=reject_offer&pid='.get_the_ID().'&ids='.$row->id.'">'.__('Reject Offer','AuctionTheme').'</a> | '.
						'<a href="'.get_bloginfo('siteurl').'/?a_action=counter_offer&pid='.get_the_ID().'&ids='.$row->id.'">'.__('CounterOffer','AuctionTheme').'</a>' )) :						
					auctiontheme_show_status_offer($row->approved, $row->rejected)		 ).'</th>';							
					echo '</tr>	';

				}

				echo '</tbody></table>';


			}
			else _e('You have not received any offers yet.','AuctionTheme');


			?>


		</div>
	</div>
	<div class="clear10"></div>
	<?php endif; ?>
	<?php /*?>
	<!-- ####################### -->
		<?php do_action('AuctionTheme_auction_page_before_image_gallery_div'); ?>
	<div class="my_box3">

        
        	<div class="box_title"><?php echo __("Image Gallery",'AuctionTheme'); ?></div>
            <div class="box_content">
		<?php
		
		$arr = AuctionTheme_get_post_images(get_the_ID());
		
		if($arr)
		{
			
		
		echo '<ul class="image-gallery">';
		foreach($arr as $image)
		{
			echo '<li><a href="'.AuctionTheme_wp_get_attachment_image($image, array(900, 700)).'" rel="image_gal2">'.wp_get_attachment_image( $image, array(100, 80) ).'</a></li>';
		}
		echo '</ul>';
		
		}
		else { echo __('No images.','AuctionTheme') ;}
		
		?>
		
		
		 
	</div>
	</div>
	
	<div class="clear10"></div><?php */?>
	
	<!-- ####################### -->
	<?php

	endif;

	global $post;
	$pid = $post->ID;

	function AuctionTheme_add_comments_before()
	{
	?>
	<div class="clear10"></div>

	<!-- ####################### -->
	<?php do_action('AuctionTheme_auction_page_before_comments_div'); ?>
	<div class="my_box3">


		<div class="box_title"><?php echo __("Comments",'AuctionTheme'); ?></div>
		<div class="box_content">

			<?php	
		}

		function AuctionTheme_add_comments_after()
		{
			echo '</div></div> ';	
			do_action('AuctionTheme_auction_page_after_comments_div');
		}

		add_filter('sitemile_before_comments', 'AuctionTheme_add_comments_before');
		add_filter('sitemile_after_comments', 'AuctionTheme_add_comments_after');


		?>
		<?php

		$opt = get_option('AuctionTheme_enable_comments');

		if($opt == "yes") { AuctionTheme_add_comments_before(); 	
			comments_template(); AuctionTheme_add_comments_after(); } ?>

	</div>

 
 <?php
 endwhile; // end of the loop. 
 get_footer();
 ?>