<?php
/***************************************************************************
*
* AuctionTheme - copyright (c) - sitemile.com
* The most popular auction theme for wordress on the internet. Launch your
* auction site in minutes from purchasing. Turn-key solution.
*
* Coder: Andrei Dragos Saioc
* Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
* More info about the theme here: http://sitemile.com/p/auctionTheme
* since v4.4.7.1
*
***************************************************************************/

  load_theme_textdomain( 'AuctionTheme', TEMPLATEPATH . '/languages' );
  
  DEFINE("AUCTIONTHEME_VERSION", "4.5.8");
  DEFINE("AUCTIONTHEME_RELEASE", "23 November 2013");

  global $default_search;
  $default_search = __("Begin to search by typing here...",'AuctionTheme');
 
//---------------------------------- 
  
  add_theme_support( 'post-thumbnails' );
  remove_action('wp_head', 'wp_generator');
   
  global $current_theme_locale_name;  
  $current_theme_locale_name = 'AuctionTheme';
  
  global $category_url_link, $location_url_link, $auctions_url_thing, $auction_thing_list;
  $category_url_link    = get_option("AuctionTheme_category_permalink");
  $location_url_link    = get_option("AuctionTheme_location_permalink");
  $auctions_url_thing   = get_option("AuctionTheme_auction_permalink");
  $auction_thing_list   = "property-list";
  
  if(empty($category_url_link))   $category_url_link = 'section';
  if(empty($location_url_link))   $location_url_link = 'location';
  if(empty($auctions_url_thing))  $auctions_url_thing = 'auctions';

//----------------------------------
  
  include 'autosuggest.php';  
  include 'lib/admin_menu.php';

  include 'lib/first_run.php';
  include 'lib/first_run_emails.php';
  include 'lib/post_new.php';
  include 'lib/login_register/custom2.php';
  include 'lib/ending_soonest_auctions.php';

  
  
  include 'lib/all_categories.php';
  include 'lib/all_locations.php';
  include 'lib/advanced_search.php';
  include 'lib/watch_list.php';
  include 'lib/cronjob.php';
  include 'lib/blog_page.php';
  //include 'lib/social/social.php';
  
//----------------------------------

  add_action('admin_menu',            'AuctionTheme_admin_main_menu_scr');
  add_action('admin_head',            'AuctionTheme_admin_main_head_scr');
  add_action('init',                'AuctionTheme_create_post_type' );  
  add_action('widgets_init',            'AuctionTheme_framework_init_widgets' );
  add_action('wp_head',             'auctionTheme_coin_slider_home');
  add_action("template_redirect",         'auctionTheme_template_redirect');
  add_action('query_vars',            'AuctionTheme_add_query_vars'); 
  add_action('save_post',             'auctionTheme_save_custom_fields');
  add_filter('wp_head',             'AuctionTheme_add_max_nr_of_images');
  
  add_action('the_content',           'AuctionTheme_blog_page_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_all_categories_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_all_locations_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_adv_search_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_post_new_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_pay_item_by_credits_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_pers_info_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_payments_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_priv_mess_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_reviews_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_watch_list_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_active_auctions_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_sold_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_closed_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_unpub_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_aw_pay_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_ending_soonest_look_for_stuff' ); 
  
  add_action('the_content',           'AuctionTheme_my_account_not_shipped_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_shipped_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_pay_4_item_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_seller_offers_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_buyer_offers_for_stuff' );
  
  add_action('the_content',           'AuctionTheme_my_account_won_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_NO_won_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_I_bid_items_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_outstanding_payment_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_paid_n_shipped_look_for_stuff' );
  add_action('the_content',           'AuctionTheme_my_account_paid__items_look_for_stuff' );
  
  add_filter('AuctionTheme_step1_after_private_bids_field',   'AuctionTheme_display_sealed_bidding_notice');
  add_filter('AuctionTheme_step1_after_featured_field',     'AuctionTheme_display_featured_bidding_notice');
  
  add_action("manage_posts_custom_column",          "auctionTheme_my_custom_columns");
  add_filter("manage_edit-auction_columns",         "auctionTheme_my_auctions_columns");
  add_action('generate_rewrite_rules',            'AuctionTheme_rewrite_rules' );
  add_action('wp_enqueue_scripts',              'auctionTheme_add_theme_styles');
  add_action( 'init',                     'AuctionTheme_register_my_menus' );
  add_filter('wp_head', 'AuctionTheme_set_cnt_down_vals', 1);
  
  add_action( 'pre_get_posts',                    'auctiontheme_my_backend_projects_orderby' );   
  add_filter( 'manage_edit-auction_sortable_columns',         'auctiontheme_sortable_cake_column' ); 
  
  add_image_size( 'slider-image', 150, 110, false );
  add_image_size( 'normal-auction-thumb', 75, 65, false );
  add_image_size( 'small_uplomads', 70, 70, false );


  add_action('admin_notices',             'auctionTheme_admin_notices');
  
function auctionTheme_admin_notices(){
    
    if(!function_exists('wp_pagenavi')) {
    echo '<div class="updated">
       <p>For the <strong>Auction Theme</strong> you need to install the wp pagenavi plugin. 
       Install it from <a href="http://wordpress.org/extend/plugins/wp-pagenavi"><strong>here</strong></a>.</p>
    </div>';
                }
                
  if(!function_exists('bcn_display')) {
    echo '<div class="updated">
       <p>For the <strong>Auction Theme</strong> you need to install the Breadcrumb NavXT plugin. 
       Install it from <a href="http://wordpress.org/extend/plugins/breadcrumb-navxt/"><strong>here</strong></a>.</p>
    </div>';
                } 
  }
  

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function auctiontheme_charge_user_for_bidding($pid, $uid)
{
  $post   = get_post($pid);
  $perm   = get_permalink($pid);
  $auctionTheme_get_bidding_fee = auctionTheme_get_bidding_fee($pid);
 
  $reason = sprintf(__('Payment for bidding <a href="%s">%s</a>','AuctionTheme'),$perm, $post->post_title);
  auctionTheme_add_history_log('0', $reason, $auctionTheme_get_bidding_fee, $uid);  
  
  $credits = auctiontheme_get_credits($uid);
  auctiontheme_update_credits($uid, ($credits - $auctionTheme_get_bidding_fee));
  
   
}

function auctionTheme_get_bidding_fee($pid)
{
  $trms = wp_get_object_terms($pid, 'auction_cat'); 
  
  if(is_array($trms))
  {
    $trms = $trms[0]->term_id;  
    $fee = get_option('auctionTheme_theme_bidding_cat_'.$trms);
     
    return $fee;
  }
  return 0;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function auctiontheme_get_custom_increase_value($prc)
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_next_bid_levels order by (high_value+0) asc";  
  $r = $wpdb->get_results($s);
  
  foreach($r as $row)
  {
    if($prc <= $row->high_value) { return $row->increase_value; break; }    
  }
  
  return false;
}
  
function auctiontheme_my_backend_projects_orderby( $query ) {  
    if( ! is_admin() )  
        return;  
    
    $post_type  = $query->query_vars['post_type'];
    $orderby  = $query->get( 'orderby');  
    
  if($post_type == "auction"):
  
    $query->set('meta_key','ending');  
    $query->set('orderby','meta_value_num');
  
    if( 'exp' == $orderby ) {  
        $query->set('meta_key','ending');  
        $query->set('orderby','meta_value_num');  
    }
  
  if( 'feat' == $orderby ) {  
        $query->set('meta_key','featured');  
        $query->set('orderby','meta_value_num');  
    } 
  
  if( 'price' == $orderby ) {  
        $query->set('meta_key','current_bid');  
        $query->set('orderby','meta_value_num');  
    }  
  
  endif;
  
}   
  
function auctiontheme_sortable_cake_column( $columns ) {  
    $columns['exp']   = 'exp';  
  $columns['feat']  = 'feat'; 
  $columns['price']   = 'price';    
    return $columns;  
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function auctiontheme_get_uploaders_tp()
{
  $AuctionTheme_uploader_type = get_option('AuctionTheme_uploader_type');
  if(empty($AuctionTheme_uploader_type)) return "html";
  
  return $AuctionTheme_uploader_type;
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function auctionTheme_username_is_valid($u)
{
  global $wpdb;
  $s = "select ID from ".$wpdb->users." where user_login='$u'";
  $r = $wpdb->get_results($s);
  
  $nr = count($r);
  
  if($nr == 0) return false; 
  return true;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_is_reverse_enabled()
{
  $AuctionTheme_enable_reverse = get_option('AuctionTheme_enable_reverse');
  if($AuctionTheme_enable_reverse == "yes") return true;
  return false; 
}

function AuctionTheme_get_adv_search_pagination_link($pg)
{
  $page_id = get_option('AuctionTheme_adv_search_id');
  
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) $ssk = get_permalink(($page_id)). "?pj=" . $pg ;
  else $ssk = get_bloginfo('siteurl'). "/?page_id=". ($page_id). "&pj=" . $pg ;   
  
  $trif = '';
  foreach($_GET as $key=>$value)
  {
    if($key != "pj" and $key != 'page_id' and $key != "custom_field_id")
    $trif .= '&'.$key."=".$value;
  }
  
  if(is_array($_GET['custom_field_id']))
  foreach($_GET['custom_field_id'] as $values)
  $trif .= "&custom_field_id[]=".$values;
  
  return $ssk.$trif;
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_set_cnt_down_vals()
{
  ?>
    
    <script>
  
    var AT_labels   = ['<?php _e('Years','AuctionTheme'); ?>', 
    '<?php _e('Months','AuctionTheme'); ?>', 
    '<?php _e('Weeks','AuctionTheme'); ?>', 
    '<?php _e('Days','AuctionTheme'); ?>', 
    '<?php _e('Hrs','AuctionTheme'); ?>', 
    '<?php _e('Min','AuctionTheme'); ?>', 
    '<?php _e('Sec','AuctionTheme'); ?>'];
    
    var AT_labels1  = ['<?php _e('Year','AuctionTheme'); ?>', 
    '<?php _e('Month','AuctionTheme'); ?>', 
    '<?php _e('Week','AuctionTheme'); ?>', 
    '<?php _e('Day','AuctionTheme'); ?>', 
    '<?php _e('Hr','AuctionTheme'); ?>', 
    '<?php _e('Min','AuctionTheme'); ?>', 
    '<?php _e('Sec','AuctionTheme'); ?>'];

  </script>
    
    <?php 
  
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/ 
function AuctionTheme_adv_search_featured_ac()
{
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) return get_permalink(get_option('AuctionTheme_adv_search_id')). "?featured=1" ;
    else return get_bloginfo('siteurl'). "/?page_id=". get_option($page_id). "&featured=1"  ;   
}
  
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_is_able_to_post_auctions()
{
  $opt = get_option('AuctionTheme_only_admins_post_auctions');
  if($opt == "yes")
  {
    if(current_user_can( 'manage_options' )) return true;
    else return false;
  }
  
  return true;
  
}
  
  
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function auction_isValidEmail($email){
  return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_pay4project_page_url($pid)
{
  return get_bloginfo('siteurl'); 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_auction_clear_table($spm = '')
{
  return '<tr><td colspan="'.$spm.'"></td></tr>'; 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_total_nr_of_auction()
{
  $query = new WP_Query( "post_type=auction&posts_per_page=1" );  
  return $query->found_posts;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_total_nr_of_open_auction()
{
  remove_filter('pre_get_posts','auctiontheme_my_backend_projects_orderby');
  $query = new WP_Query( "meta_key=closed&meta_value=0&post_type=auction&order=DESC&orderby=id&posts_per_page=1&paged=1" ); 
  return $query->found_posts;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_total_nr_of_closed_auction()
{
  remove_filter('pre_get_posts','auctiontheme_my_backend_projects_orderby');
  $query = new WP_Query( "meta_key=closed&meta_value=1&post_type=auction&order=DESC&orderby=id&posts_per_page=1&paged=1" ); 
  return $query->found_posts;
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/



function AuctionTheme_register_my_menus() {
    register_nav_menu( 'primary-auctiontheme-header', 'AuctionTheme top-header Menu' );
    register_nav_menu( 'primary-auction-main-header', 'AuctionTheme Big Main Menu' );   
    
}
  
  
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_display_featured_bidding_notice()
{
  $AuctionTheme_new_auction_feat_listing_fee = get_option('AuctionTheme_new_auction_feat_listing_fee');
  if(!empty($AuctionTheme_new_auction_feat_listing_fee))
  {
    if($AuctionTheme_new_auction_feat_listing_fee > 0)
    {
      printf(__('Extra fee of %s is applied with this option.','AuctionTheme'), auctionTheme_get_show_price($AuctionTheme_new_auction_feat_listing_fee));     
    }   
  } 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_display_sealed_bidding_notice()
{
  $AuctionTheme_new_auction_sealed_bidding_fee = get_option('AuctionTheme_new_auction_sealed_bidding_fee');
  if(!empty($AuctionTheme_new_auction_sealed_bidding_fee))
  {
    if($AuctionTheme_new_auction_sealed_bidding_fee > 0)
    {
      printf(__('Extra fee of %s is applied with this option.','AuctionTheme'), auctionTheme_get_show_price($AuctionTheme_new_auction_sealed_bidding_fee));     
    }   
  } 
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_browse__special_pg_link($page_id, $page)
{
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) return get_permalink(get_option($page_id)). "?pj=" . $page ;
      else return get_bloginfo('siteurl'). "/?page_id=". get_option($page_id). "&pj=" . $page ;   
  
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_get_field_tp($nr)
{
    if($nr == "1") return "Text field";
    if($nr == "2") return "Select box";
    if($nr == "3") return "Radio Buttons";
    if($nr == "4") return "Check-box";
    if($nr == "5") return "Large text-area";  
    
    
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function auctionTheme_search_into($custid, $val)
  {
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_custom_relations where custid='$custid'";
    $r = $wpdb->get_results($s);
    
    if(count($r) == 0) return 0;
    else
    foreach($r as $row) // = mysql_fetch_object($r))
    {
      if($row->catid == $val) return 1;
    }
  
    return 0;
  }

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_get_post_blog()
{
      
             $arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . get_the_ID());
             
             if($arrImages) 
             {
              $arrKeys  = array_keys($arrImages);
              $iNum     = $arrKeys[0];
                  $sThumbUrl  = wp_get_attachment_thumb_url($iNum);
                  $sImgString = '<a href="' . get_permalink() . '">' .
                            '<img class="image_class" src="' . $sThumbUrl . '" width="100" height="100" />' .
                          '</a>';
                             
             }
             else
             {
                $sImgString = '<a href="' . get_permalink() . '">' .
                            '<img class="image_class" src="' . get_bloginfo('template_url') . '/images/nopic.png" width="100" height="100" />' .
                            '</a>'; 
               
             }
          
      
?>
        <div class="post vc_POST" id="post-<?php the_ID(); ?>">
                <div class="padd10">
                <div class="image_holder" style="width:120px">
                <?php echo $sImgString; ?>
                </div>
                <div  class="title_holder" style="width:510px" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php the_title(); ?></a></h2>
                        <p class="mypostedon"><?php _e('Posted on','AuctionTheme'); ?> <?php the_time('F jS, Y') ?>  <?php _e('by','AuctionTheme'); ?> 
                       <?php the_author() ?>
                  </p>
                       <p class="blog_post_preview"> <?php the_excerpt(); ?></p>
                       
                      
                        <a href="<?php the_permalink() ?>" class="post_bid_btn"><?php _e('Read More','AuctionTheme'); ?></a>
                         
                     </div></div>
                     
                   
                     
                     </div>
<?php
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/ 
function auctionTheme_small_post($param = '')
{
      $ending   = get_post_meta(get_the_ID(), 'ending', true);
      $sec    = $ending - current_time('timestamp',0);
      $location   = get_post_meta(get_the_ID(), 'Location', true);
      
      $only_buy_now = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $price    = get_post_meta(get_the_ID(), 'price', true);     
      $closed   = get_post_meta(get_the_ID(), 'closed', true);
      $views  = get_post_meta(get_the_ID(), 'views', true);
      $rnd = rand(1,999);
      
?>
        <div class="post small-padd-top" >
                <div class="image_holder2">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),50,50, 'attachment-50x50'); ?></a>
                </div>
                <div  class="title_holder2" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php   the_title();  ?></a></h2>
                        
                        <p class="mypostedon2">
                        <?php _e("Posted in",'AuctionTheme');?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?><br/>
                        
                       <?php
             
             $AuctionTheme_enable_locations = get_option('AuctionTheme_enable_locations');
             if($AuctionTheme_enable_locations != "no"):
             
             ?> 
                       <?php _e("Location",'AuctionTheme');?>: <?php 
             
             $lc = get_the_term_list( get_the_ID(), 'auction_location', '', ', ', '' );
             echo (empty($lc) ? __("not defined",'AuctionTheme') : $lc ); ?><br/> 
                       <?php endif; ?>
                       
                       
                       <?php             
                if($param == 'view'):             
              ?>
                        
              <?php _e("Views",'AuctionTheme');?>: <?php echo $views; ?>
                        
              <?php else: 
              
              
              $AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
              if($only_buy_now == "1" and $AuctionTheme_no_time_on_buy_now == "yes"): 
              //asd
              else:
              
              
              ?>
                       
                          <span style="float:left"><?php _e("Ending in",'AuctionTheme');?>: &nbsp; </span>
                                <span class="expiration_auction_p"><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : ($ending - current_time('timestamp',0))); ?></span>
                      
                      <?php endif; endif; ?> 
                        </p>
                       
                     
                
                     
                     </div></div> <?php 
} 
  
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_get_CATID($slug)
{
  $c = get_term_by('slug', $slug, 'auction_cat'); 
  return $c->term_id;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_clear_table($colspan = '')
{
  return '<tr><td colspan="'.$colspan.'">&nbsp;</td></tr>'; 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function auctionTheme_pay_for_item_link($bid_id)
{
  //AuctionTheme_my_account_pay_for_item_id 
    
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) return get_permalink(get_option('AuctionTheme_my_account_pay_for_item_id')). "?bid_id=" . $bid_id ;
      else return get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_my_account_pay_for_item_id'). "&bid_id=" . $bid_id ;  
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function auctionTheme_pay_for_item_by_credits_link($bid_id)
{
  //AuctionTheme_my_account_pay_for_item_id 
    
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) return get_permalink(get_option('AuctionTheme_my_account_pay_item_cr_id')). "?bid_id=" . $bid_id ;
      else return get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_my_account_pay_item_cr_id'). "&bid_id=" . $bid_id ; 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

if (!is_admin()) add_action("wp_enqueue_scripts", "bloglow_custom_jquery_cdn", 11);
function bloglow_custom_jquery_cdn() {
wp_deregister_script('jquery');
wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
wp_enqueue_script('jquery');
}

function auctionTheme_add_theme_styles()  
{ 
  global $wp_query;
    $new_auction_step = $wp_query->query_vars['step'];
    $a_action     = $wp_query->query_vars['a_action'];
  
  
  
  wp_register_script( 'social_pr', get_bloginfo('template_url').'/js/connect.js');
  wp_register_script( 'respond_js', 'http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js');  
  wp_register_script( 'bootstrap_js', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.js');
  wp_register_script( 'rowlink_js', get_bloginfo('template_url').'/js/vendor/bootstrap-rowlink.js');  
  wp_register_script( 'easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js');
  //wp_register_script( 'jquery_cowntdown', get_bloginfo('template_url').'/js/jquery.countdown.js');
  wp_register_script( 'bootstrap_min', 'http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.js');
  wp_register_style( 'bootstrap_style1', get_bloginfo('template_url').'/css/bootstrap_min.css', array(), '20120822', 'all' );
    wp_register_style( 'bootstrap_style2', get_bloginfo('template_url').'/css/css.css', array(), '20120822', 'all' );
  wp_register_style( 'bootstrap_style3', get_bloginfo('template_url').'/css/bootstrap_responsive.css', array(), '20120822', 'all' );
  wp_register_style( 'bootstrap_ie6',   get_bloginfo('template_url').'/css/bootstrap_ie6.css', array(), '20120822', 'all' );
  wp_register_style( 'bootstrap_gal',   get_bloginfo('template_url').'/css/bootstrap_gal.css', array(), '20120822', 'all' );
  wp_register_style( 'fileupload_ui',   get_bloginfo('template_url').'/css/jquery.fileupload-ui.css', array(), '20120822', 'all' );
  wp_register_style( 'uploadify_css',   get_bloginfo('template_url').'/lib/uploadify/uploadify.css', array(), '20120822', 'all' ); 
  wp_register_script( 'html5_js', get_bloginfo('template_url').'/js/html5.js');
  wp_register_script( 'jquery_ui', get_bloginfo('template_url').'/js/vendor/jquery.ui.widget.js');
  wp_register_script( 'templ_min', get_bloginfo('template_url').'/js/templ.min.js');
  wp_register_script( 'load_image', get_bloginfo('template_url').'/js/load_image.min.js');
  wp_register_script( 'canvas_to_blob', get_bloginfo('template_url').'/js/canvas_to_blob.js');
  wp_register_script( 'iframe_transport', get_bloginfo('template_url').'/js/jquery.iframe-transport.js');
  wp_register_script( 'load_image', get_bloginfo('template_url').'/js/load_image.min.js'); 
  wp_register_style( 'fileupload_ui',   get_bloginfo('template_url').'/css/fileupload_ui.css', array(), '20120822', 'all' );
  wp_register_script( 'fileupload_main', get_bloginfo('template_url').'/js/jquery.fileupload.min.js');
  wp_register_script( 'fileupload_fp', get_bloginfo('template_url').'/js/jquery.fileupload-fp.js');
  wp_register_script( 'fileupload_ui', get_bloginfo('template_url').'/js/jquery.fileupload-ui.min.js');
  
  wp_register_script( 'locale_thing', get_bloginfo('template_url').'/js/locale.js');
  
  wp_register_script( 'main_thing', get_bloginfo('template_url').'/js/main.js');
  wp_register_script( 'js_cors_ie8', get_bloginfo('template_url').'/js/cors/jquery.xdr-transport.js');
  //wp_register_script( 'jquery16', get_bloginfo('template_url').'/js/jquery16.min.js');
  
  //wp_deregister_script('jquery');
  //wp_register_script( 'jquery', get_bloginfo('template_url').'/js/jquery19.js');
  wp_register_script( 'my_scripts', get_bloginfo('template_url').'/js/my-script.js');
  wp_register_script( 'jquery_ui_min', get_bloginfo('template_url').'/js/jquery.ui.min.js');
  //wp_enqueue_script( 'dcjqmegamenu', get_bloginfo('template_url') . '/js/jquery.dcmegamenu.1.3.4.min.js', array('jquery') );
  wp_register_style( 'mega_menu_thing',   get_bloginfo('template_url').'/css/menu.css', array(), '20120822', 'all' );  
  
  global $wp_styles, $wp_scripts;
  // enqueing:
      
     wp_enqueue_script( 'social_pr' );
     wp_enqueue_script( 'respond_js' );
     wp_enqueue_script( 'rowlink_js' );
     wp_enqueue_script( 'bootstrap_js' );
     wp_enqueue_script( 'easing' );
     wp_enqueue_script( 'jquery_cowntdown' );
     wp_enqueue_script( 'dcjqmegamenu' );
    wp_enqueue_style( 'mega_menu_thing' );
    
    
    if($new_auction_step == "2" or $new_auction_step == "1" or $a_action == "edit_auction" or $a_action == "repost_auction"):
     
     //wp_enqueue_script( 'jquery16' );
     wp_enqueue_script( 'jquery_ui_min');
 
    
          // enqueing:
      if($new_auction_step == "2" or $a_action == "edit_auction" or $a_action == "repost_auction")
    wp_enqueue_style( 'bootstrap_style1' );
    //wp_enqueue_style( 'bootstrap_style2' );
    //wp_enqueue_style( 'bootstrap_style3' );
    //wp_enqueue_style( 'bootstrap_ie6' );
    //wp_enqueue_style( 'bootstrap_gal' );
    wp_enqueue_style( 'fileupload_ui' );
    wp_enqueue_style( 'uploadify_css' );
    
    wp_enqueue_script( 'html5_js' );


     
     
    $uploaders = auctiontheme_get_uploaders_tp();
    
    if($uploaders == "jquery")
    {
      wp_enqueue_script( 'jquery_ui' );
      wp_enqueue_script( 'templ_min' );
      wp_enqueue_script( 'load_image' );
      wp_enqueue_script( 'bootstrap_min' );
      wp_enqueue_script( 'canvas_to_blob' );
      wp_enqueue_script( 'iframe_transport' );
      wp_enqueue_script( 'fileupload_main' );
      wp_enqueue_script( 'fileupload_fp' );
      wp_enqueue_script( 'fileupload_ui' );
      wp_enqueue_script( 'main_thing' );
      wp_enqueue_script( 'js_cors_ie8' );
      
    }
    
     wp_enqueue_script( 'locale_thing' );
     wp_enqueue_script( 'uploadify_js' );
   
  //$wp_styles->add_data('bootstrap_ie6', 'conditional', 'lte IE 7');
    else:
    
      //wp_enqueue_script('jquery');
      wp_enqueue_script('my_scripts');
    
    endif;
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_add_max_nr_of_images()
{
  ?>
    
    <script type="text/javascript">
    <?php
    $AuctionTheme_enable_max_images_limit = get_option('AuctionTheme_enable_max_images_limit');
    if($AuctionTheme_enable_max_images_limit == "yes")
    {
      $auctionTheme_nr_max_of_images = get_option('auctionTheme_nr_max_of_images');
      if(empty($auctionTheme_nr_max_of_images))  $auctionTheme_nr_max_of_images = 10;
    }
    else $AuctionTheme_enable_max_images_limit = 1000;
    
    if(empty($auctionTheme_nr_max_of_images)) $auctionTheme_nr_max_of_images = 100;
    
    ?>
    
    
    
    var maxNrImages_PT = <?php echo $auctionTheme_nr_max_of_images; ?>;
  
  </script>
    
    <?php 
  
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_categories($taxo, $selected = "", $include_empty_option = "", $ccc = "")
{
  $args = "orderby=name&order=ASC&hide_empty=0&parent=0";
  $terms = get_terms( $taxo, $args );
  
  $ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';
  if(!empty($include_empty_option)) $ret .= "<option value=''>".$include_empty_option."</option>";
  
  if(empty($selected)) $selected = -1;
  
  foreach ( $terms as $term )
  {
    $id = $term->term_id;
    
    $ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';
    
    $args = "orderby=name&order=ASC&hide_empty=0&parent=".$id;
    $sub_terms = get_terms( $taxo, $args ); 
    
    if($sub_terms)
    foreach ( $sub_terms as $sub_term )
    {
      $sub_id = $sub_term->term_id; 
      $ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';
      
      $args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;
      $sub_terms2 = get_terms( $taxo, $args2 ); 
      
      if($sub_terms2)
      foreach ( $sub_terms2 as $sub_term2 )
      {
        $sub_id2 = $sub_term2->term_id; 
        $ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp; 
         '.$sub_term2->name.'</option>';
         
         $args3 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id2;
         $sub_terms3 = get_terms( $taxo, $args3 );  
         
         if($sub_terms3)
         foreach ( $sub_terms3 as $sub_term3 )
        {
          $sub_id3 = $sub_term3->term_id; 
          $ret .= '<option '.($selected == $sub_id3 ? "selected='selected'" : " " ).' value="'.$sub_id3.'">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;|&nbsp; 
           '.$sub_term3->name.'</option>';
        }
      }
    }
    
  }
  
  $ret .= '</select>';
  
  return $ret;
  
}

function AuctionTheme_get_custom_taxonomy_count2($post_type, $tax_term, $taxonomy_name) 
{
  $taxonomy = 'my_taxonomy'; // this is the name of the taxonomy
    $args = array(
        'post_type' => $post_type, 'posts_per_page' => '1',
    'meta_query' => array(
        array(
          'key' => 'closed',
          'value' => '0',
          'compare' => '='
        )
      ),    
        'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy_name,
                        'field' => 'slug',
                        'terms' => $tax_term)
                )
        );

     $my_query = new WP_Query( $args );
   return $my_query->found_posts;
  
}



function AuctionTheme_is_selected_thing($arr, $ids)
{

  if(count($arr) == 0) return false;
  foreach($arr as $a)
  if($ids == $a) {   return true; }
  
  return false; 
}

function AuctionTheme_build_my_cat_arr($pid)
{
  $my_arr   = array();
  $cat    = wp_get_object_terms($pid, 'auction_cat');
  
  if(is_array($cat))
  foreach($cat as $c)
  {
    $my_arr[] = $c->term_id;  
  }
  

  return $my_arr;
}

function AuctionTheme_get_categories_multiple($taxo, $selected_arr = "")
{
  $args = "orderby=name&order=ASC&hide_empty=0&parent=0";
  $terms = get_terms( $taxo, $args );
  
 
  foreach ( $terms as $term )
  {
    $id = $term->term_id;
    
    $ret .= '<input type="checkbox" '.(AuctionTheme_is_selected_thing($selected_arr, $id) == true ? "checked='checked'" : " " ).' value="'.$id.'" name="'.$taxo.'_cat_multi[]"> '.$term->name.'<br/>';
    
    $args = "orderby=name&order=ASC&hide_empty=0&parent=".$id;
    $sub_terms = get_terms( $taxo, $args ); 
    
    if($sub_terms)
    foreach ( $sub_terms as $sub_term )
    {
      $sub_id = $sub_term->term_id; 
      $ret .= '&nbsp; &nbsp; &nbsp; 
      <input type="checkbox" '.(AuctionTheme_is_selected_thing($selected_arr, $sub_id) == true ? "checked='checked'" : " " ).' value="'.$sub_id.'" name="'.$taxo.'_cat_multi[]"> '.$sub_term->name.'<br/>';
 
      
      $args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;
      $sub_terms2 = get_terms( $taxo, $args2 ); 
      
      if($sub_terms2)
      foreach ( $sub_terms2 as $sub_term2 )
      {
        $sub_id2 = $sub_term2->term_id; 
        $ret .= '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
        <input type="checkbox" '.(AuctionTheme_is_selected_thing($selected_arr, $sub_id2) == true ? "checked='checked'" : " " ).' value="'.$sub_id2.'" name="'.$taxo.'_cat_multi[]"> '.$sub_term2->name.'<br/>';
 
       
         
         $args3 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id2;
         $sub_terms3 = get_terms( $taxo, $args3 );  
         
         if($sub_terms3)
         foreach ( $sub_terms3 as $sub_term3 )
        {
          $sub_id3 = $sub_term3->term_id; 
           
          $ret .= '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
          <input type="checkbox" '.(AuctionTheme_is_selected_thing($selected_arr, $sub_id3) == true ? "checked='checked'" : " " ).' value="'.$sub_id2.'" name="'.$taxo.'_cat_multi[]"> '.$sub_term3->name.'<br/>';
  
           
        }
      }
    }
    
  }
  
  
  return $ret;
  
}



function AuctionTheme_send_email($recipients, $subject = '', $message = '') {
    
  $AuctionTheme_email_addr_from   = get_option('AuctionTheme_email_addr_from'); 
  $AuctionTheme_email_name_from   = get_option('AuctionTheme_email_name_from');
  
  $message = stripslashes($message);
  $subject = stripslashes($subject); 
  
  if(empty($AuctionTheme_email_name_from)) $AuctionTheme_email_name_from  = "Auction Theme";
  if(empty($AuctionTheme_email_addr_from)) $AuctionTheme_email_addr_from  = "AuctionTheme@wordpress.org";
    
  $headers = 'From: '. $AuctionTheme_email_name_from .' <'. $AuctionTheme_email_addr_from .'>' . PHP_EOL;
  $AuctionTheme_allow_html_emails = get_option('AuctionTheme_allow_html_emails');
  if($AuctionTheme_allow_html_emails != "yes") $html = false;
  else $html = true;

  $ok_send_email = true;
  $ok_send_email = apply_filters('AuctionTheme_ok_to_send_emails', $ok_send_email);

  if($ok_send_email == true)
  {
    if ($html) {
      $headers .= "MIME-Version: 1.0\n";
      $headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";
      $mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";
      return wp_mail($recipients, $subject, $mailtext, $headers);
      
    } else {
      $headers .= "MIME-Version: 1.0\n";
      $headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";
      $message = preg_replace('|&[^a][^m][^p].{0,3};|', '', $message);
      $message = preg_replace('|&amp;|', '&', $message);
      $mailtext = wordwrap(strip_tags($message), 80, "\n");
      return wp_mail($recipients, stripslashes($subject), stripslashes($mailtext), $headers);
    }

  }

}


function auctionTheme_get_highest_bid_owner($pid)
{
  global $wpdb;
  
  $reverse = get_post_meta($pid, 'reverse', true);  
  $s = "select uid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid desc limit 1";
  
  if($reverse == "yes") $s = "select uid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid asc limit 1";
  
  
  $r = $wpdb->get_results($s);
  
  if(count($r) == 0)
   return false;
  
  $r = $r[0];
  return $r->uid;
}


function auctionTheme_save_custom_fields($pid)
{
  
  $sbr_post = get_post($pid);
  
  if(isset($_POST['fromadmin']) and $sbr_post->post_type == "auction")
  { 
  
  $now      = current_time('timestamp',0);
  $ending     = get_post_meta($pid,"ending",true);
  $views      = get_post_meta($pid,"views",true);
  $closed     = get_post_meta($pid,"closed",true);  
  $reverse    = get_post_meta($pid, "reverse", true); 
  
  if(empty($reverse))
  $reverse = (AuctionTheme_is_reverse_enabled() == true ? 'yes' : 'no' );
  
  $allow_offers = get_post_meta($pid, "allow_offers", true);  
  
  update_post_meta($pid, "quant", trim($_POST['quant'])); 
  update_post_meta($pid,"ending",strtotime($_POST['ending'], $now));  
  
  if(empty($views)) update_post_meta($pid,"views",0); 
  
  
  if($reverse == "yes") update_post_meta($pid, "reverse", "yes");
  else update_post_meta($pid, "reverse", "no");
  
  
  
  
  //--------------------------------------------------
  
  if(isset($_POST['only_buy_now'])) 
  update_post_meta($pid, "only_buy_now", "1");
  else update_post_meta($pid, "only_buy_now", "0");   
  
  //--------------------------------------------------
    
  if($_POST['featureds'] == '1') 
  update_post_meta($pid,"featured",'1');
  else
  update_post_meta($pid,"featured",'0');
  
  
  
    if($_POST['allow_offers'] == '1') 
  update_post_meta($pid,"allow_offers",'1');
  else
  update_post_meta($pid,"allow_offers",'0');
  
    
  if($_POST['closed'] == '1') 
  {
      
      update_post_meta($pid,"closed",'1');
  }
  else
  {
    if($closed == "1" and empty($_POST['ending'])) {  update_post_meta($pid,"ending",current_time('timestamp',0) + 30*24*3600); }   
    update_post_meta($pid,"closed",'0');
    
  }
  
      if(isset($_POST['shipping']))
      update_post_meta($pid, "shipping", auctionTheme_clear_sums_of_cash($_POST['shipping']));
      
      if(isset($_POST['guide_price']))
      update_post_meta($pid, "guide_price", auctionTheme_clear_sums_of_cash($_POST['guide_price']));
      
      if(isset($_POST['viewing_days']))
      update_post_meta($pid, "viewing_days", auctionTheme_clear_sums_of_cash($_POST['viewing_days']));
      if(isset($_POST['start_price']))
      update_post_meta($pid, "start_price", auctionTheme_clear_sums_of_cash($_POST['start_price']));
      
      if(isset($_POST['reserve']))
      update_post_meta($pid, "reserve", auctionTheme_clear_sums_of_cash($_POST['reserve']));
      
      if(isset($_POST['buy_now']))
      update_post_meta($pid, "buy_now", auctionTheme_clear_sums_of_cash($_POST['buy_now']));  
      
      if(isset($_POST['private_bids']))
      update_post_meta($pid, "private_bids", $_POST['private_bids']); 
      
  
  if(isset($_POST['price']))
  update_post_meta($pid,"price",auctionTheme_clear_sums_of_cash($_POST['price']));
  
  if(isset($_POST['Location']))
  update_post_meta($pid,"Location",$_POST['Location']);
  
  //----------------------
  
  for($i=0;$i<count($_POST['custom_field_id']);$i++)
  {
    $id = $_POST['custom_field_id'][$i];
    $valval = $_POST['custom_field_value_'.$id];    
    
    if(is_array($valval))
        update_post_meta($pid, 'custom_field_ID_'.$id, $valval);
    else
      update_post_meta($pid, 'custom_field_ID_'.$id, strip_tags($valval));
  }
  
  
  
  
  update_post_meta($pid,'unpaid','0');
  
  $AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
          if($AuctionTheme_no_time_on_buy_now == "yes" and isset($_POST['only_buy_now'])):
            update_post_meta($pid, 'ending',  current_time('timestamp',0) + 3600*24*5*365); 
          endif;
  
  $ggcbd = get_post_meta($pid, "current_bid", true);
  
      if(empty($ggcbd)) 
      {
          if($reverse == "yes")
            {
              update_post_meta($pid, "current_bid", $_POST['price']);
            }
            else
            {
              update_post_meta($pid, "current_bid", $_POST['start_price']);
              if(empty($_POST['start_price']))
              { 
                if(!empty($_POST['buy_now']))
                update_post_meta($pid, "current_bid", $_POST['buy_now']);
                else update_post_meta($pid, "current_bid", 0);
              }
            }
        }
        else
        {
         if(!empty($_POST['buy_now']))
         update_post_meta($pid, "current_bid", $_POST['buy_now']);
         
          
        }
        //-----------------------------------

        $zip = get_post_meta($pid, "Location", true);
        
        $loc    = wp_get_post_terms( $pid, 'auction_location');
        $loc_a  = '';
       
        foreach($loc as $l)
        $loc_a .= $l->name.',' ;
        
        $loc_a .= $zip;
        
        $data = AuctionTheme_get_geo_coordinates($loc_a);
        $long = $data[3];
        $lat  = $data[2];       
        
        update_post_meta($pid, 'auction_lat',   $lat);
        update_post_meta($pid, 'auction_long',  $long);

// Add epc to custom Meta    
    if(isset($_POST['epc']))
  update_post_meta($pid,"epc",auctionTheme_clear_sums_of_cash($_POST['epc']));
  
// Add legal pack to custom Meta    
    if(isset($_POST['legal_pack']))
  update_post_meta($pid,"legal_pack",auctionTheme_clear_sums_of_cash($_POST['legal_pack']));
    }   
  
}



function auctionTheme_my_auctions_columns($columns) //this function display the columns headings
{
  
    $columns["title"] = __("Auction Title","AuctionTheme");
    $columns["posted"] = __("Posted On","AuctionTheme");
    $columns["price" ] = __("Price","AuctionTheme");
    $columns["exp" ] = __("Expires in","AuctionTheme");
    $columns["feat" ] = __("Featured","AuctionTheme");
    $columns["thumbnail"] = __("Thumbnail","AuctionTheme");
    $columns["options" ] = __("Options","AuctionTheme");
   
  return $columns;
}
  
  
function auctionTheme_my_custom_columns($column)
{
  global $post;
  if ("ID" == $column) echo $post->ID; //displays title
  elseif ("description" == $column) echo $post->ID; //displays the content excerpt
  elseif ("posted" == $column) echo date_i18n('jS \of F, Y \<\b\r\/\>H:i:s',strtotime($post->post_date)); //displays the content excerpt
  elseif ("thumbnail" == $column) 
  {
    echo '<a href="'.get_admin_url(). '/post.php?post='.$post->ID.'&action=edit">'.AuctionTheme_get_first_post_image($post->ID,75,65).'</a>'; //shows up our post thumbnail that we previously created.
  }
  
  elseif ("author" == $column)
  {
    echo $post->post_author;  
  }
  
  
  elseif ("feat" == $column)
  {
    $f = get_post_meta($post->ID,'featured', true); 
    if($f == "1") echo __("Yes","AuctionTheme");
    else  echo __("No","AuctionTheme");
  }
  
  elseif ("price" == $column)
  { 
    echo auctionTheme_get_show_price(auctionTheme_get_current_price($post->ID));
  }
  
  elseif ("exp" == $column)
  {
    $ending = get_post_meta($post->ID, 'ending', true);   
    echo AuctionTheme_prepare_seconds_to_words($ending - current_time('timestamp',0));  
  }
  
  elseif ("options" == $column)
  {
    echo '<div style="padding-top:20px">';
    echo '<a class="awesome" href="'.get_admin_url().'/post.php?post='.$post->ID.'&action=edit">Edit</a> '; 
    echo '<a class="awesome" href="'.get_permalink($post->ID).'" target="_blank">View</a> ';
    echo '<a class="trash" href="'.get_delete_post_link($post->ID).'">Trash</a> ';
    echo '</div>';
  }
  
} 

  
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_login_url()
{
  return get_bloginfo('siteurl') . "/wp-login.php"; 
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_add_query_vars($public_query_vars) 
{  
      $public_query_vars[] = 'jb_action';
    $public_query_vars[] = 'a_action'; 
    $public_query_vars[] = 'orderid';
    $public_query_vars[] = 'bid_id';
     
    $public_query_vars[] = 'step'; 
    $public_query_vars[] = 'my_second_page';
    $public_query_vars[] = 'third_page';
    $public_query_vars[] = 'username';
    $public_query_vars[] = 'pid';
    $public_query_vars[] = 'term_search';   //job_sort, job_category, page
    $public_query_vars[] = 'method';
    $public_query_vars[] = 'post_author';
    $public_query_vars[] = 'page';
    $public_query_vars[] = 'rid';
    $public_query_vars[] = 'ids';
    
      return $public_query_vars;  
}

function auctionTheme_get_winner_bid($bid_id)
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";  
  $r = $wpdb->get_results($s);
  return $r[0];
}

function auctionTheme_prepare_rating($pid, $fromuser, $touser, $winner_bid)
  {

    global $wpdb;
    $tm = current_time('timestamp',0);      
    $s = "insert into ".$wpdb->prefix."auction_ratings (pid, fromuser, touser, bid_id, datemade) values('$pid','$fromuser','$touser', '$winner_bid', '$tm')";       
    $wpdb->query($s);
    
    $ratings_for_bid_id = get_post_meta($pid,'ratings_for_bid_id_' . $winner_bid,true);
    if(empty($ratings_for_bid_id))
    {
      update_post_meta($pid,'ratings_for_bid_id_' . $winner_bid, "donE");
      AuctionTheme_send_email_when_review_needs_to_be_awarded($pid, $fromuser,  $touser);
      AuctionTheme_send_email_when_review_needs_to_be_awarded($pid, $touser,    $fromuser);
    
    }
    //mysql_query($s) or die(mysql_error());
  }


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/  
function AuctionTheme_get_auto_draft($uid)
{
  global $wpdb; 
  $querystr = "
    SELECT distinct wposts.* 
    FROM $wpdb->posts wposts where 
    wposts.post_author = '$uid' AND wposts.post_status = 'auto-draft' 
    AND wposts.post_type = 'auction' 
    ORDER BY wposts.ID DESC LIMIT 1 ";
        
  $row = $wpdb->get_results($querystr, OBJECT);
  if(count($row) > 0)
  {
    $row = $row[0];
    return $row->ID;
  }
  
  return AuctionTheme_create_auto_draft($uid);  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_create_auto_draft($uid)
{
    $my_post = array();
    $my_post['post_title']    = 'Auto Draft';
    $my_post['post_type']     = 'auction';
    $my_post['post_status']   = 'auto-draft';
    $my_post['post_author']   = $uid;
    $pid =  wp_insert_post( $my_post, true );
    
    update_post_meta($pid,'base_fee_paid',    "0");
    update_post_meta($pid,'featured_paid',  "0");
    update_post_meta($pid,'private_bids_paid',  "0");
    
    $AuctionTheme_enable_membership = get_option('AuctionTheme_enable_membership');
    
    if($AuctionTheme_enable_membership == "yes")
    {
      update_post_meta($pid,'base_fee_paid',    "1");
      $ipp = get_user_meta($uid, 'auctions_available', 'true');
      update_user_meta($uid, 'auctions_available', ($ipp - 1));
    }
    
    return $pid;
    
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_using_permalinks()
{
  global $wp_rewrite;
  if($wp_rewrite->using_permalinks()) return true; 
  else return false;  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_post_new_with_pid_stuff_thg($pid, $step = 1, $fin = '')
{
  $using_perm = AuctionTheme_using_permalinks();
  if($using_perm) return get_permalink(get_option('AuctionTheme_post_new_page_id')). "?auction_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : '');
      else return get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_post_new_page_id'). "&auction_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : ''); 
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_clear_sums_of_cash($cash)
{
  $cash = str_replace(" ","",$cash);
  $cash = str_replace(",","",$cash);
  //$cash = str_replace(".","",$cash);
  
  return strip_tags($cash);
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_buy_it_now_price($pid = '')
{

  if(empty($pid)) $pid = get_the_ID();
  $price = get_post_meta($pid, 'buy_now', true);
  
  if(empty($price)) $price = false;
  return $price;  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function get_auction_fields_values($pid)
  {
    $cat = wp_get_object_terms($pid, 'auction_cat');
  
    $catid = $cat[0]->term_id ;
  
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_custom_fields order by ordr asc "; //where cate='all' OR cate like '%|$catid|%' order by ordr asc";  
    $r = $wpdb->get_results($s);
    
  
    
    $arr = array();
    $i = 0;
    
    foreach($r as $row) // = mysql_fetch_object($r))
    {
      
      $pmeta = get_post_meta($pid, "custom_field_ID_".$row->id);
    
      if(!empty($pmeta) && count($pmeta) > 0)
      {
        $arr[$i]['field_name']  = $row->name;
    
        if(!empty($pmeta))
        {
          $arr[$i]['field_name']  = $row->name;
          $arr[$i]['field_value'] = $pmeta;
          $i++;
        }
      
      
      }
    }
    
    return $arr;
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/  

function AuctionTheme_get_auction_stars($rating)
  {
    $full   = get_bloginfo('template_url')."/images/full_star.gif";
    $empty  = get_bloginfo('template_url')."/images/empty_star.gif";  
    
    $r = '';
    
    for($j=1;$j<=$rating;$j++)
    $r .= '<img src="'.$full.'" alt="star" />';
    
    
    for($j=5;$j>$rating;$j--)
    $r .= '<img src="'.$empty.'" alt="star" />';
    
    return $r;
    
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auction_get_star_rating($uid)
  {
  
    global $wpdb;
    $s = "select grade from ".$wpdb->prefix."auction_ratings where touser='$uid' AND awarded='1'";
    $r = $wpdb->get_results($s);
    $i = 0; $s = 0;
    
    if(count($r) == 0)  return __('(no rating)','AuctionTheme');
    else
    foreach($r as $row) // = mysql_fetch_object($r))
    {
      $i++;
      $s = $s + $row->grade;
      
    }
  
    $rating = round($s/$i, 0);
    
    return AuctionTheme_get_auction_stars(round($rating/2));
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_post_images($pid, $limit = -1)
{
  
    //---------------------
    // build the exclude list
    $exclude = array();
    
    $args = array(
    'order'          => 'ASC',
    'post_type'      => 'attachment',
    'post_parent'    => get_the_ID(),
    'meta_key'     => 'another_reserved1',
    'meta_value'   => '1',
    'numberposts'    => -1,
    'post_status'    => null,
    );
    $attachments = get_posts($args);
    if ($attachments) {
      foreach ($attachments as $attachment) {
      $url = $attachment->ID;
      array_push($exclude, $url);
    }
    }
    
    //-----------------
  
  
    $arr = array();
    
    $args = array(
    'order'          => 'ASC',
    'orderby'        => 'post_date',
    'post_type'      => 'attachment',
    'post_parent'    => $pid,
    'exclude'       => $exclude,
    'post_mime_type' => 'image',
    'numberposts'    => $limit,
    ); $i = 0;
    
    $attachments = get_posts($args); 
    if ($attachments) {
    
      foreach ($attachments as $attachment) {
            
        $url = $attachment->ID;
        array_push($arr, $url);
        
    }
      return $arr;
    }
    return false;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_is_owner_of_post()
{
  
  if(!is_user_logged_in())
    return false;
  
  global $current_user;
  get_currentuserinfo();
  
  $post = get_post(get_the_ID());
  if($post->post_author == $current_user->ID) return true;
  return false; 
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_userid_from_username($user)
{     
  $user = get_user_by('login', $user);
  if($user == false) return false;
  
  return $user->ID;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_user_profile_link($uid)
{
  return get_bloginfo('siteurl'). '/?a_action=user_profile&post_author='. $uid; 
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_user_feedback_link($uid)
{
  return get_bloginfo('siteurl'). '/?a_action=user_feedback&post_author='. $uid;  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_update_credits($uid,$am)
{

  update_user_meta($uid,'credits',$am); 

}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auction_get_my_awarded_auctions($uid)
{
  $c = "<select name='auctionss'>";
  global $wpdb;
  
  $querystr = "
          SELECT distinct wposts.* 
          FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, ".$wpdb->prefix."term_relationships rels 
          WHERE wposts.post_author='$uid' 
          AND  wposts.ID = wpostmeta.post_id 
          AND wpostmeta.meta_key = 'closed' 
          AND wpostmeta.meta_value = '1' 
          AND wposts.post_status = 'publish' 
          AND wposts.post_type = 'auction' AND rels.object_id=wposts.ID AND rels.term_taxonomy_id!='$blgid'  
          ORDER BY wposts.post_date DESC";
  
  //echo $querystr;
  $r = $wpdb->get_results($querystr);
  
  foreach($r as $row)
  {
    $pid = $row->ID;
    $winner = get_post_meta($pid, "winner", true);
    if(!empty($winner))
    {
      $c .= '<option value="'.$row->ID.'">'.$row->post_title.'</option>';
      $i = 1;
    }
  }
  
  //----------------------------
  
           $querystr = "
          SELECT distinct wposts.* 
          FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
          WHERE wposts.ID = wpostmeta.post_id 
          AND wpostmeta.meta_key = 'winner' 
          AND wpostmeta.meta_value = '$uid' 
          AND wposts.post_status = 'publish' 
          AND wposts.post_type = 'auction'  
          ORDER BY wposts.post_date DESC ";
  
  
  
  $r = $wpdb->get_results($querystr);
  
  foreach($r as $row)
  {
    $pid = $row->ID;

      $c .= '<option value="'.$row->ID.'">'.$row->post_title.'</option>';
      $i = 1;
  
  }
  
  //-------------------------------
  
  if($i == 1)
  return $c.'</select>';
  
  return false;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_insert_pic_media_lib($author, $pid, $uri, $path, $post_title, $another_reserved1 = '')
{
  require_once(ABSPATH . '/wp-admin/includes/image.php');
    $wp_filetype = wp_check_filetype(basename($path), null );
        
      $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_author' => $author,
      'guid' => $uri,
      'post_parent' => $pid,
      'post_type' => 'attachment',
      'post_title' => $post_title
      );
      
      $id = wp_insert_attachment($attachment, $path, $pid);
      
      if(!empty($another_reserved1))
      {
        update_post_meta($id, 'another_reserved1', '1');  
      }
      
      $dt = wp_generate_attachment_metadata($id, $path);
      wp_update_attachment_metadata($id, $dt);  
      return $id;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_current_user_has_bid($uid, $res)
{
  foreach($res as $row)
    if($row->uid == $uid) { return true; }
  
  return false;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_curPageURL_me() {
   $pageURL = 'http';
   if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
   $pageURL .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   }
   return $pageURL;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_sm_replace_me($s)
{
  return urlencode($s);
}

function auctionTheme_template_redirect()
{
  
  if(isset($_GET['switch_to_view']))
  {
    //auctiontheme_get_view_grd
    
    $_SESSION['view_tp'] = $_GET['switch_to_view'];   
    wp_redirect($_GET['ret_u']);
    exit; 
  }
  
  if(isset($_POST['deposit_pay_me']))
  {
    global $am_err;
    $amount = trim($_POST['amount']);
    if(empty($amount)) $am_err = 1; 
    elseif(!is_numeric($amount)) $am_err = 1;
    else
    {
      wp_redirect(get_bloginfo('siteurl') . "/?a_action=deposit_pay&am=" . $amount);   exit;    
    }
  }
  
  if(isset($_POST['deposit_pay_me_payza']))
  {
    global $am_err;
    $amount = trim($_POST['amount']);
    if(empty($amount)) $am_err = 1; 
    elseif(!is_numeric($amount)) $am_err = 1;
    else
    {
      wp_redirect(get_bloginfo('siteurl') . "/?a_action=deposit_pay_payza&am=" . $amount);   exit;    
    }
  }
  
  global $wp;
  global $wp_query, $wp_rewrite, $post;
  $paagee   =  $wp_query->query_vars['my_custom_page_type'];
  $a_action   =  $wp_query->query_vars['a_action'];
  
  $my_pid = $post->ID;
  $AuctionTheme_post_new_page_id            = get_option('AuctionTheme_post_new_page_id');
  $AuctionTheme_my_account_page_id          = get_option('AuctionTheme_my_account_page_id');
  
  if(isset($_GET['test'])) { include 'test.php'; die(); }
  
  if($post->post_parent == $AuctionTheme_my_account_page_id or $my_pid == $AuctionTheme_my_account_page_id)
  {
    if(!is_user_logged_in())
    {
      wp_redirect(get_bloginfo('siteurl') . "/wp-login.php?redirect_to=" . AuctionTheme_sm_replace_me(AuctionTheme_curPageURL_me()));
      exit; 
    }
      
  }
  
  if(isset($_GET['notify_chained']))
  {
    
    if($_POST['status'] == "COMPLETED")
    {
      $trID   = $_POST['tracking_id'];  
      $trID   = explode("_",$trID);
      $bid_id = $trID[0];
      
      global $wpdb;
    
      $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
      $r = $wpdb->get_results($s);
      $row = $r[0]; $bid = $row;
      
      AuctionTheme_send_email_when_item_is_paid_seller($bid->pid, $bid_id);
      AuctionTheme_send_email_when_item_is_paid_buyer($bid->pid, $bid_id);
      
      $wpdb->query("update ".$wpdb->prefix."auction_bids set paid='1' where id='$bid_id'");
      update_post_meta($pid, 'paid_on_'.$bid_id, current_time('timestamp',0));
    
      
    }
    
    exit; 
  }
  
  if(isset($_GET['return_chained']))
  { 
        
    $ret_id = $_GET['return_chained'];  
  
    $using_perm   = AuctionTheme_using_permalinks();
    $paid_items_id  = get_option('AuctionTheme_my_account_paid_id');
      
    if($using_perm) $paid_itms_m = get_permalink($paid_items_id). "?";
    else $paid_itms_m = get_bloginfo('siteurl'). "/?page_id=". $paid_items_id. "&"; 
  
    wp_redirect($paid_itms_m . "paid_ok=1");

  }
  
  
  if($my_pid == $AuctionTheme_post_new_page_id)
  {
    if(!is_user_logged_in())  { wp_redirect(AuctionTheme_login_url()); exit; }
    
    if(!isset($_GET['auction_id'])) $set_ad = 1; else $set_ad = 0;
    global $current_user;
    get_currentuserinfo();
    
    
    $AuctionTheme_enable_membership = get_option('AuctionTheme_enable_membership');
    if($AuctionTheme_enable_membership == "yes")
    {
      $mem_available   = get_user_meta($current_user->ID, 'mem_available', true);
      $auctions_available    = get_user_meta($current_user->ID, 'auctions_available', true);
      $ct        = current_time('timestamp', 0);
      
      
      if($ct > $mem_available or empty($mem_available) or ($auctions_available <= 0)):
        
        if(auctiontheme_using_permalinks())  $rff_lnk = get_permalink(get_option('AuctionTheme_my_account_payments_page_id')). "?prc_mem=1";
        else  $rff_lnk = get_permalink(get_option('AuctionTheme_my_account_payments_page_id')) . "&prc_mem=1";
              
        wp_redirect($rff_lnk);
        die();
      endif;  
    }
    
    if($set_ad == 1)
    {
      $pid    = AuctionTheme_get_auto_draft($current_user->ID);
      wp_redirect(AuctionTheme_post_new_with_pid_stuff_thg($pid));
    }
    
    if(!empty($_GET['auction_id']))
    {
      $my_main_post = get_post($_GET['auction_id']);
      if($my_main_post->post_author != $current_user->ID)
      {
        wp_redirect(get_bloginfo('siteurl')); exit; 
      }
      
    }
    
    do_action('AuctionTheme_action_post_post_new_redirect');
    
    include 'lib/post_new_post.php';    
  }
  
  if(isset($_GET['deposit_response_payza']))
  {
    include 'lib/gateways/deposit_payza_response.php';;
    die();  
  }

  if(isset($_GET['purchase_mem_paypal']))
  {
    include 'lib/gateways/paypal_purchase_mem.php';
    die();  
  }
  
  if($a_action == 'buy_memberships')
  {
    include 'lib/my_account/buy_memberships.php';
    die();
  }
   
  if($a_action == 'buy_memberships_credits')
  {
    include 'lib/my_account/buy_memberships_credits.php';
    die();
  }
  
  
  if($a_action == 'buy_now_commit')
  {
    include 'lib/buy_now_commit.php';
    die();
  }
  
  if($a_action == 'no_percent_speficied')
  {
    include 'lib/no_percent_speficied.php';
    die();
  }
  
  if($a_action == 'no_paypal_email')
  {
    include 'lib/no_paypal_email.php';
    die();
  }
  
  if($a_action == 'deposit_pay_payza')
  {
    include 'lib/gateways/deposit_pay_payza.php';
    die();
  }
  
  if($a_action == 'accept_counter_offer')
  {
    include 'lib/accept_counter_offer.php';
    die();
  }
  
  if($a_action == 'reject_counter_offer')
  {
    include 'lib/reject_counter_offer.php';
    die();
  }
  
  if($a_action == 'counter_offer')
  {
    include 'lib/counter_offer.php';
    die();
  }

  if($a_action == 'accept_offer')
  {
    include 'lib/accept_offer.php';
    die();
  }
  
  if($a_action == 'reject_offer')
  {
    include 'lib/reject_offer.php';
    die();
  }
 
  if($a_action == 'make_offer')
  {
    include 'lib/make_offer.php';
    die();
  }
  
  if($a_action == 'buy_now')
  {
    include 'lib/buy_now.php';
    die();
  }
  
  if($a_action == 'user_profile')
  {
    include 'lib/user_profile.php';
    die();
  }
  
  if($a_action == 'user_feedback')
  {
    include 'lib/user_feedback.php';
    die();
  }
  
  if($a_action == 'deposit_pay')
  {
    include 'lib/gateways/deposit_pay.php';
    die();
  }
  
  if($a_action == 'relist_auction')
  {
    include 'lib/my_account/relist_auction.php';
    die();
  }
  
  
  
  if($a_action == 'rate_user')
  {
    include 'lib/my_account/rate_user.php';
    die();
  }
  
  
  if($a_action == 'delete_auction')
  {
    include 'lib/my_account/delete_auction.php';
    die();
  }
  
  if($a_action == 'mark_shipped')
  {
    include 'lib/my_account/mark_shipped.php';
    die();
  }
  
  if($a_action == 'mark_paid')
  {
    include 'lib/my_account/mark_paid.php';
    die();
  }
  
  if(isset($_GET['item_response_payza']))
  {
    include 'lib/gateways/item_response_payza.php';
    die();  
  }
  
  if(isset($_GET['pay_for_item']))
  {
    include 'lib/gateways/pay_for_item_'.$_GET['pay_for_item'].'.php';
    die();  
  }
  
  if($a_action == "mb_listing")
  {
    include 'lib/gateways/moneybookers_listing.php';
    die();  
  }
  
  if($a_action == "paypal_listing")
  {
    include 'lib/gateways/paypal_listing.php';
    die();  
  }
  
  if($a_action == "credits_listing")
  {
    include 'lib/gateways/credits_listing.php';
    die();  
  }
  
  if($a_action == "edit_auction")
  {
    include 'lib/my_account/edit_auction.php';
    die();  
  }
  
  if(isset($_GET['uploady_thing']))
  {
 
    include 'my-upload.php';
    die();  
  }
  
  
  
  if(isset($_GET['_bid_delete_pid']))
  {
    global $wpdb;
    $ids = $_GET['_bid_delete_pid'];
    
    $s = "delete from ".$wpdb->prefix."auction_bids where id='$ids'";
    $wpdb->query($s);
 
    
    exit; 
  }
  
  if(isset($_GET['_ad_delete_pid']))
  {
    if(is_user_logged_in())
    {
      $pid  = $_GET['_ad_delete_pid'];
      $pstpst = get_post($pid);
      global $current_user;
      get_currentuserinfo();
      
      if($pstpst->post_author == $current_user->ID)
      {
        wp_delete_post($_GET['_ad_delete_pid']);  
        echo "done";
      }
    }
      
  }

  
}




/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_formats_special($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
  $dec_sep = '.';
  $tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, '' ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, '' ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_active_auctions_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_active_act\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_active_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_active_act\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_pay_4_item_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_pay4item\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_pay4item_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_pay4item\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}


function AuctionTheme_my_account_seller_offers_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_seller_offers\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_seller_offers_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_seller_offers\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

function AuctionTheme_my_account_buyer_offers_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_buyer_offers\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_buyer_offers_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_buyer_offers\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_all_locations_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_show_all_locations\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_all_locations_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_show_all_locations\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_blog_page_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_blog_posts\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_display_blog_page_disp();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_blog_posts\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_all_categories_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_show_all_categories\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_all_categories_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_show_all_categories\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_closed_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_closed_act\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_closed_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_closed_act\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_unpub_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_unpub_act\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_unpub_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_unpub_act\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_adv_search_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_adv_search\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_adv_search_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_adv_search\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_won_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_won_items\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_won_items_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_won_items\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

function AuctionTheme_my_account_paid__items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_paid_\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_paid__area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_paid_\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_paid_n_shipped_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_paid_ship\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_paid_n_shipped_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_paid_ship\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_outstanding_payment_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_outstanding_payments\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_outstanding_payments_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_outstanding_payments\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_I_bid_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_bid_items\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_items_i_bid_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_bid_items\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_NO_won_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_not_won_items\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_not_won_items_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_not_won_items\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_pay_item_by_credits_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_pay_item_by_credits\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_pay_item_by_credits_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_pay_item_by_credits\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_shipped_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_shipped\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_shipped_items_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_shipped\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_not_shipped_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_no_shipped\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_not_shipped_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_no_shipped\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_aw_pay_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_aw_pay\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_awaiting_payment_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_aw_pay\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

function AuctionTheme_ending_soonest_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_ending_soonest_act\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_ending_soonest_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_ending_soonest_act\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}



/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_sold_items_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_sold_act\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_sold_auctions_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_sold_act\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_reviews_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_reviews\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_reviews_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_reviews\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_my_account_payments_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_payments\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_payments_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_payments\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_priv_mess_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_priv_mess\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_priv_mess_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_priv_mess\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_pers_info_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account_personal_info\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_pers_info_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account_personal_info\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_my_account\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_my_account_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_my_account\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

function AuctionTheme_watch_list_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_watch_list\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_watch_list_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_watch_list\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_post_new_look_for_stuff( $content = '' ) 
{
  if ( preg_match( "/\[auction_theme_post_new\]/", $content ) ) 
  {
    ob_start();
    AuctionTheme_post_new_area_function();
    $output = ob_get_contents();
    ob_end_clean();
    $output = str_replace( '$', '\$', $output );
    return preg_replace( "/(<p>)*\[auction_theme_post_new\](<\/p>)*/", $output, $content );
    
  } 
  else {
    return $content;
  }
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_admin_main_head_scr()
{
  
 
  wp_enqueue_script("jquery-ui-widget");
  wp_enqueue_script("jquery-ui-mouse");
  wp_enqueue_script("jquery-ui-tabs");
  wp_enqueue_script("jquery-ui-datepicker");
  
  if($_GET['action'] == "edit" or $_GET['post_type'] == "auction"):
?>  
  
 <?php endif; ?>   
    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />    
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/colorpicker.css" type="text/css" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css" />
  <link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" /> 
  
    <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/ui-thing.css" />
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon.js"></script>
    
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/idtabs.js"></script>  
 
    
    <script type="text/javascript">
      
      var $ = jQuery;
  <?php
  
    if(strstr($_GET['page'], 'AT_') != false or $_GET['page'] == "general-options" or $_GET['page'] == "custom-fields" or $_GET['page'] == "Withdrawals" or $_GET['page'] == "Escrows" 
    or $_GET['page'] == "trans-sites" or $_GET['page'] == "mem-packs"):
  
  ?>    
      
      
    jQuery(document).ready(function() {   
  jQuery("#usual2 ul").idTabs("tabs1"); 
    });
    
    <?php endif; ?>
    
    </script>
  

  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/colorpicker.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/eye.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/utils.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/layout.js?ver=1.0.2"></script>    

<?php 
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_rewrite_rules( $wp_rewrite )
{

    global $category_url_link, $location_url_link;
    $new_rules = array( 
    

    $category_url_link.'/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?auction_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),
        $category_url_link.'/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?auction_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),
        $category_url_link.'/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?auction_cat='.$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(2),
        $category_url_link.'/([^/]+)/?$' => 'index.php?auction_cat='.$wp_rewrite->preg_index(1)
      


    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;

}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_create_post_type() {
  
  global $auctions_url_thing, $auction_thing_list;
  
  $icn = get_bloginfo('template_url')."/images/auctionicon.gif";
  register_post_type( 'auction',
    array(
      'labels' => array(
        'name'      => __( 'Properties','AuctionTheme' ),
        'singular_name' => __( 'Property','AuctionTheme' ),
    'add_new'     => __('Add New Property','AuctionTheme'),
    'new_item'    => __('New Property','AuctionTheme'),
    'edit_item'   => __('Edit Property','AuctionTheme'),
    'add_new_item'  => __('Add New Property','AuctionTheme'),
    'search_items'  => __('Search Properties','AuctionTheme'),
    
    
      ),
      'public' => true,
    'menu_position' => 5,
    'register_meta_box_cb' => 'auctionTheme_set_metaboxes',
    'has_archive' => "property-list",
      'rewrite' => array('slug'=> $auctions_url_thing."/%auction_cat%",'with_front'=>false), 
    'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
    '_builtin' => false,
    'menu_icon' => $icn,
    'publicly_queryable' => true,
    'hierarchical' => false 

    )
  );
  
  global $category_url_link, $location_url_link;

  register_taxonomy( 'auction_cat', 'auction', array( 'hierarchical' => true, 'label' => __('Auction Categories','AuctionTheme'),
  'rewrite'                  =>    true
   )
  
   );
   register_taxonomy( 'auction_info', 'auction', array( 'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Auction Info', 'taxonomy general name' ),
      'singular_name' => _x( 'Auction Info', 'taxonomy singular name' ),
      'all_items' => __( 'All Auction Locations' ),
      'parent_item' => __( 'Auction Location' ),
      'parent_item_colon' => __( 'Auction Location:' ),
      'edit_item' => __( 'Edit Auction' ),
      'update_item' => __( 'Update Auction' ),
      'add_new_item' => __( 'Add New Auction' ),
      'new_item_name' => __( 'New Auction Date' ),
      'menu_name' => __( 'Auctions' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'Auction', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
   ));
  register_taxonomy( 'auction_location', 'auction', array( 'hierarchical' => true, 'label' => __('Locations','AuctionTheme'),
  'rewrite'                       => array('slug'=>$location_url_link,'with_front'=>false)
   ) );
  add_post_type_support( 'auction', 'author' );
   //add_post_type_support( 'auction', 'custom-fields' );
  register_taxonomy_for_object_type('post_tag', 'auction');
  
  flush_rewrite_rules();

}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_set_metaboxes()
{
  
      add_meta_box( 'auction_custom_fields',  'Property Custom Fields', 'auctionTheme_custom_fields_html', 'auction', 'advanced','high' );
    add_meta_box( 'auction_images',     'Property Images',      'auctionTheme_theme_auction_images', 'auction', 'advanced','high' );
    add_meta_box( 'auction_legal_pack',     'Legal Pack',     'auctionTheme_theme_auction_legal_pack', 'auction', 'advanced','high' );
//    add_meta_box( 'auction_bids',       'Property Bids',        'auctionTheme_theme_auction_bids', 'auction', 'advanced','high' );
    add_meta_box( 'auction_dets',       'Property Details',     'auctionTheme_theme_auction_dts', 'auction', 'side','high' );
    do_action('AuctionTheme_meta_boxes_menu');
    remove_meta_box( 'postimagediv', 'auction', 'side');
    remove_meta_box( 'auction_catdiv', 'auction', 'normal');
	remove_meta_box( 'auction_locationdiv', 'auction', 'side');
    remove_meta_box( 'postexcerpt', 'auction', 'normal');
    remove_meta_box( 'tagsdiv-post_tag', 'auction', 'side');
    remove_meta_box( 'commentstatusdiv', 'auction', 'normal');
  
}
add_action( 'admin_menu', 'remove_author_metabox' );
add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );
function remove_author_metabox() {
    remove_meta_box( 'authordiv', 'auction', 'normal' );
}
function move_author_to_publish_metabox() {
    global $post_ID;
    $post = get_post( $post_ID );
    echo '<div id="author" class="misc-pub-section" style="border-top-style:solid; border-top-width:1px; border-top-color:#EEEEEE; border-bottom-width:0px;">Partner Agent: ';
    post_author_meta_box( $post );
    echo '</div>';
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
add_action('admin_enqueue_scripts', 'my_admin_scripts');
 
function my_admin_scripts() {
        wp_enqueue_media();
        wp_register_script('my-admin-js', get_template_directory_uri() . '/my-admin.js', array('jquery'));
        wp_enqueue_script('my-admin-js');
    }

function auctionTheme_theme_auction_legal_pack(){
  global $post;
  $pid = $post->ID;
  ?>
  <label for="upload_legal">Legal Pack: 
    <input id="upload_legal" type="text" size="36" name="legal_pack" value="<?php echo get_post_meta($pid, 'legal_pack', true); ?>" /> 
    <input id="upload_legal_button" class="button" type="button" value="Upload" />
</label><br>
  <label for="upload_image">EPC: 
    <input id="upload_image" type="text" size="36" name="epc" value="<?php echo get_post_meta($pid, 'epc', true); ?>" /> 
    <input id="upload_image_button" class="button" type="button" value="Upload" />
</label>
  <?php
}

function auctionTheme_theme_auction_images()
{

  global $current_user;
  get_currentuserinfo();
  $cid = $current_user->ID;
  
  global $post;
  $pid = $post->ID;


?>
  
    
    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script><link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />
  
    <script type="text/javascript">
  
  function delete_this2(id)
  {
     $.ajax({
            method: 'get',
            url : '<?php echo get_bloginfo('siteurl');?>/index.php?_ad_delete_pid='+id,
            dataType : 'text',
            success: function (text) {   $('#image_ss'+id).remove();  }
           });
      //alert("a");
  
  }

  
  
  $(function() {
    
    $("#fileUpload3").uploadify({
      height        : 30,
      auto:     true,
      swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',
      uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady.php',
      width         : 120,
      fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',
      formData    : {'ID':<?php echo $pid; ?>,'author':<?php echo $cid; ?>},
      onUploadSuccess : function(file, data, response) {
      
      //alert(data);
      var bar = data.split("|");
      
$('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this2('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');
}
  
      
      
      });
    
    
  });
  
  
  </script>
  
    <style type="text/css">
  .div_div
  {
    margin-left:5px; float:left; 
    width:110px;margin-top:10px;
  }
  
  </style>
    
    <div id="fileUpload3">You have a problem with your javascript</div>
    <div id="thumbnails" style="overflow:hidden;margin-top:20px">
    
    <?php

    $args = array(
    'order'          => 'ASC',
    'orderby'        => 'post_date',
    'post_type'      => 'attachment',
    'post_parent'    => $post->ID,
    'post_mime_type' => 'image',
    'numberposts'    => -1,
    ); $i = 0;
    
    $attachments = get_posts($args);



  if ($attachments) {
      foreach ($attachments as $attachment) {
    $url = wp_get_attachment_url($attachment->ID);
    
      echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
      AuctionTheme_generate_thumb($attachment->ID, 70, 70). '" />
      <a href="javascript: void(0)" onclick="delete_this2(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
      </div>';
    
  }
  }


  ?>
    
    </div>
    
<?php 

}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/


function AuctionTheme_get_option_drop_down($arr, $name)
{
  $opts = get_option($name);
  $r = '<select name="'.$name.'">';
  foreach ($arr as $key => $value)
  {
    $r .= '<option value="'.$key.'" '.($opts == $key ? ' selected="selected" ' : "" ).'>'.$value.'</option>';   
    
  }
    return $r.'</select>'; 
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_post_new_link()
{
  return get_permalink(get_option('AuctionTheme_post_new_page_id'));    
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_watch_list()
{
  return get_permalink(get_option('AuctionTheme_watch_list_id'));
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_blog_link()
{
  return get_permalink(get_option('AuctionTheme_blog_home_id'));  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_advanced_search_link()
{
  return get_permalink(get_option('AuctionTheme_adv_search_id'));   
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_my_account_link()
{
  return get_permalink(get_option('AuctionTheme_my_account_page_id'));  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_payments_link()
{
  return get_permalink(get_option('AuctionTheme_my_account_payments_page_id')); 
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_categories_slug($taxo, $selected = "", $include_empty_option = "", $ccc = "")
{
  $args = "orderby=name&order=ASC&hide_empty=0&parent=0";
  $terms = get_terms( $taxo, $args );
  
  $ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';
  if(!empty($include_empty_option)){
    
    if($include_empty_option == "1") $include_empty_option = "Select";
    $ret .= "<option value=''>".$include_empty_option."</option>";
   }
  
  if(empty($selected)) $selected = -1;
  
  foreach ( $terms as $term )
  {
    $id = $term->slug;
    $ide = $term->term_id;
    
    $ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';
    
    $args = "orderby=name&order=ASC&hide_empty=0&parent=".$ide;
    $sub_terms = get_terms( $taxo, $args ); 
    
    if($sub_terms)
    foreach ( $sub_terms as $sub_term )
    {
      $sub_id = $sub_term->slug; 
      $ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';
      
      $args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_term->term_id;
      $sub_terms2 = get_terms( $taxo, $args2 ); 
      
      if($sub_terms2)
      foreach ( $sub_terms2 as $sub_term2 )
      {
        $sub_id2 = $sub_term2->slug; 
        $ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  
        '.$sub_term2->name.'</option>';
        
        $args3 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_term2->term_id;
        $sub_terms3 = get_terms( $taxo, $args3 );
        
        if($sub_terms3)
        foreach ( $sub_terms3 as $sub_term3 )
        {
          $sub_id3 = $sub_term3->slug; 
          $ret .= '<option '.($selected == $sub_id3 ? "selected='selected'" : " " ).' value="'.$sub_id3.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  
          '.$sub_term3->name.'</option>';
          
        }
      
      }
      
    }
    
  }
  
  $ret .= '</select>';
  
  return $ret;
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_insert_pages($page_ids, $page_title, $page_tag, $parent_pg = 0 )
{
  
    $opt = get_option($page_ids);     
    if(!AuctionTheme_check_if_page_existed($opt))
    {
      
      $post = array(
      'post_title'  => $page_title, 
      'post_content'  => $page_tag, 
      'post_status'   => 'publish', 
      'post_type'   => 'page',
      'post_author'   => 1,
      'ping_status'   => 'closed', 
      'post_parent'   => $parent_pg);
      
      $post_id = wp_insert_post($post);
        
      update_post_meta($post_id, '_wp_page_template', 'auction-special-page-template.php');
      update_option($page_ids, $post_id);
    
    }
        
  
}


/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_check_if_page_existed($pid)
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."posts where post_type='page' AND post_status='publish' AND ID='$pid'";
  $r = $wpdb->get_results($s);
  
  if(count($r) > 0) return true;
  return false; 
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctiontheme_get_sumitted_offer_price($pid, $uid)
{
  global $wpdb;   
  
  $s = "select * from ".$wpdb->prefix."auction_offers where pid='$pid' and uid='$uid' and approved='0' and rejected='0'"; 
  $r = $wpdb->get_results($s);
    
  return auctiontheme_get_show_price($r[0]->price); 
}

function auctiontheme_waiting_to_answer_offer($pid, $uid)
{
  global $wpdb;   
  
  $s = "select * from ".$wpdb->prefix."auction_offers where pid='$pid' and uid='$uid' and approved='0' and rejected='0'"; 
  $r = $wpdb->get_results($s);
    
  if(count($r) != 0)
  return $r[0];
    
  return false;
}

function auctiontheme_see_if_offer_posted($pid, $uid)
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_offers where pid='$pid' and uid='$uid' ";  
  $r = $wpdb->get_results($s);
  if(count($r) >= 3) return true;
  else
  {
    $s = "select * from ".$wpdb->prefix."auction_offers where pid='$pid' and uid='$uid' and approved='0' and rejected='0'"; 
    $r = $wpdb->get_results($s);
    
    if(count($r) != 0)
    return true;
      
  }
  
  return false;
  
}


add_filter('post_type_link', 'AuctionTheme_post_type_link_filter_function', 1, 3);

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
 function AuctionTheme_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
   
  global $category_url_link;
   
    if ( strpos('%auction_cat%', $post_link) === 'FALSE' ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'auction' ) {
  
    if(AuctionTheme_using_permalinks())   
      return str_replace("auction_cat", $category_url_link ,$post_link);
    else return $post_link; 
    }
    $terms = wp_get_object_terms($post->ID, 'auction_cat');
    if ( !$terms ) {
      return str_replace('%auction_cat%', 'uncategorized', $post_link);
    }
    return str_replace('%auction_cat%', $terms[0]->slug, $post_link);
  }
  
  
add_filter('term_link', 'AuctionTheme_post_tax_link_filter_function', 1, 3);
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
 function AuctionTheme_post_tax_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
  global $category_url_link;
    
  if(!AuctionTheme_using_permalinks())   return $post_link;
  return str_replace("auction_cat",$category_url_link ,$post_link);
  }
    
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/  
  
  function auctionTheme_get_avatar($uid, $w = 25, $h = 25)
  {
    $av = get_user_meta($uid, 'avatar_new', true);
    if(empty($av)) return get_bloginfo('template_url')."/images/noav.jpg";
    else return AuctionTheme_wp_get_attachment_image($av, array($w, $h));  
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_slider_post()
{
  do_action('auctionTheme_slider_post');  
}

add_filter('auctionTheme_slider_post', 'auctionTheme_slider_post_function');

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_slider_post_function()
{
  ?>
  
  <div class="slider-post">
    <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(), 150, 110, 'attachment-150x110', 'slider-image', 1); ?></a>
                <br/>
                
                 <p><span class="slider-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php 
                      
                        the_title(); 
                  
                        
                        ?></a></span><br/>
                        <?php echo get_the_term_list( get_the_ID(), 'auction_location', '', ', ', '' );   ?><br/>
                        <?php echo auctionTheme_get_show_price(auctionTheme_get_current_price(get_the_ID())); ?><br/><br/>
                        
                        
                        <a href="<?php the_permalink(); ?>" class="buttonlight"><?php _e('Buy Now','AuctionTheme'); ?></a>
                        
                       </p>
    
  </div>
  
  <?php
}

add_filter('auctionTheme_get_post',     'auctionTheme_get_post_function',0,1);
add_filter('auctionTheme_get_post_grid',  'auctionTheme_get_post_function_grid',0,1);

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_get_post($arr = '')
{
  do_action('auctionTheme_get_post', $arr); 
}

function auctionTheme_get_post_grid($arr = '')
{
  do_action('auctionTheme_get_post_grid', $arr);  
}


add_action('init',    'auctionTheme_myStartSession', 1);
add_action('wp_logout', 'auctionTheme_myEndSession');
add_action('wp_login',  'auctionTheme_myEndSession');

function auctionTheme_myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function auctionTheme_myEndSession() {
    session_destroy ();
}
 

function auctiontheme_get_view_grd()
{
  if(isset($_SESSION['view_tp'])) 
  {
    if( $_SESSION['view_tp'] == "grid") return "grid"; else return "normal";
  }
  return "normal";
  
}

function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
  return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

if(!function_exists('auctionTheme_get_post_function_grid'))
{
function auctionTheme_get_post_function_grid( $arr = '')
{

      if($arr[0] == "winner") $pay_this_me = 1;
      if($arr[0] == "unpaid") $unpaid = 1;
      
      $paid = get_post_meta(get_the_ID(),'paid',true);
      
      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $post       = get_post(get_the_ID());
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      //$current_bid    = get_post_meta(get_the_ID(), 'current_bid', true);
      
      $post = get_post(get_the_ID());
      
      global $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      
?>
        <div class="post_grid" id="post-ID-<?php the_ID(); ?>">
                
                
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                
                
                
                <div class="padd10_a">
                <div class="image_holder_grid">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),125,85); ?></a>
                
                <div class="watch-list">
                <?php
        
        
        
        
        
        if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):        
        ?>
                
                 <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>   
                
        
                  </div>   
                </div>
                <div  class="title_holder_grid" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php 
                        
                        
                        the_title(); 
                       
                        
                        ?></a></h2>
                        
                        
                  <?php if(!AuctionTheme_is_different_home_layout()) { 
          
          $author = get_userdata($post->post_author);
          
          
          ?>     
                        
                       
                       
                 
                     </div> 
                     
                   <?php } ?>
                  
                    <div class="details_holder_grid"> 
                  
                   <ul class="auction-details1">
                      <li><p><?php echo get_post_meta($pid, 'guide_price' ,true); ?></p></li>
                  <li><p><?php the_author() ?></p></li>
</ul>
                                     
                     </div>
                      
                
                  </div>   
</div>                     
                   
<?php
} }

function AuctionTheme_any_ptype_on_tag($request) {
  if ( isset($request['tag']) )
    $request['post_type'] = 'auction';

  return $request;
}
add_filter('request', 'AuctionTheme_any_ptype_on_tag');


if(!function_exists('auctionTheme_get_post_function'))
{
function auctionTheme_get_post_function( $arr = '')
{

      if($arr[0] == "winner") $pay_this_me = 1;
      if($arr[0] == "unpaid") $unpaid = 1;
      
      global $bid_ids;
      
      $paid = get_post_meta(get_the_ID(),'paid',true);
      
      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $post       = get_post(get_the_ID());
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      //$current_bid    = get_post_meta(get_the_ID(), 'current_bid', true);
      
      $post = get_post(get_the_ID());
      
      global $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      
      if(!empty($bid_ids))
      {
        global $wpdb;
        $ss = "select * from ".$wpdb->prefix."auction_bids where id='$bid_ids'";  
        $rr = $wpdb->get_results($ss);
        $rows = $rr[0];
        $winner = get_userdata($rows->uid);
        
      }
      ?>
      <div class="row post" id="post-ID-<?php the_ID(); ?>">
          <div class="">
            <div class="col-md-3">
              <a href="<?php the_permalink(); ?>">
                <?php if($featured == "1"): ?>
                  <div class="featured-two"></div>
                <?php endif; ?>
                <?php echo AuctionTheme_get_first_post_image(get_the_ID(), 250, 170, 'img_class'); ?>
              </a>
            </div>
            <div  class="col-md-6" >
              <h4>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                  <?php
                    the_title();
                  ?>
                </a>
              </h4>
              <?php if(!AuctionTheme_is_different_home_layout()) { 
                $author = get_userdata($post->post_author);
              ?>

              <p class="mypostedon">
                <?php the_excerpt(); ?>

                <?php
                if($post->post_status == "draft" && $paid == 1)
                {
                  echo '<br/><span class="awaiting_moderation">'.__('Awaiting admin moderation','AuctionTheme').'</span>';  
                }
                ?>
              </p>
              <?php
              global $asd_paid_items;
              if($asd_paid_items == 1):
              ?> 
                <p class="shipping_info">
                  <?php 
                  $shp = get_user_meta($winner->ID, 'shipping_info', true);         
                  printf(__('Buyer Shipping Info: %s','AuctionTheme'), $shp); ?>
                </p>
              <?php endif; ?>
        
              <!-- ############### -->    
              <div>
                <?php if($pay_this_me == 1): ?>
                  <a href="<?php bloginfo('siteurl'); ?>/my-account/pay-for-auction/<?php echo get_the_ID(); ?>" 
                  class="post_bid_btn"><?php echo __("Pay This", "AuctionTheme");?></a>
                <?php endif; ?>

                <?php if(!AuctionTheme_is_different_home_layout() ) { ?>  
                  <!--
                  <?php if( $pay_this_me != 1): ?>
                    <a href="<?php the_permalink(); ?>" class="post_bid_btn"><?php echo __("Read More", "AuctionTheme");?></a>
                  <?php endif; ?>
                  -->

                  <?php if( $paid != 1 and ($post->post_author == $uid)): ?>
                    <a href="<?php echo AuctionTheme_post_new_with_pid_stuff_thg(get_the_ID(), 3); ?>" class="post_bid_btn"><?php echo __("Publish", "AuctionTheme");?></a>
                  <?php endif; ?>

                  <?php if($post->post_author == $uid) { 

                    if(auctionTheme_number_of_bid_see_and_buy_now(get_the_ID()) != false) { $mms = 1; ?>
                      <a href="<?php bloginfo('siteurl') ?>/?a_action=edit_auction&pid=<?php the_ID(); ?>" class="post_bid_btn">
                        <?php echo __("Edit Auction", "AuctionTheme");?>
                      </a>
                      <?php 
                    } 

                    if($mms != 1){ 
                      if( get_option('AuctionTheme_enable_editing_when_bid_placed') == "yes"){        
                        ?>
                        <a href="<?php bloginfo('siteurl') ?>/?a_action=edit_auction&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Edit Auction", "AuctionTheme");?></a>
                        <?php
                      }
                    }

                    if($rows->paid == '0')
                    {
                      ?>
                      <a href="<?php bloginfo('siteurl') ?>/?a_action=mark_paid&bid_id=<?php echo $bid_ids; ?>" class="post_bid_btn"><?php echo __("Mark Paid", "AuctionTheme");?></a>
                      <?php 
                    }
                  }?>

                  <?php 
                  if($post->post_author == $uid) //$closed == 1) 
                  {
                    if($closed == "1") //$closed == 1) 
                    { ?>
                      <a href="<?php bloginfo('siteurl') ?>/?a_action=relist_auction&pid=<?php the_ID(); ?>" class="post_bid_btn">
                        <?php echo __("Repost Auction", "AuctionTheme");?>
                      </a>

                    <?php } /*} else { */  

                    if(auctionTheme_has_1_bid($pid) == false):?>
                      <a href="<?php bloginfo('siteurl') ?>/?a_action=delete_auction&pid=<?php the_ID(); ?>" class="post_bid_btn_err"><?php echo __("Delete", "AuctionTheme");?></a>
                    <?php endif; } ?>

                <?php } ?>
                  <?php do_action('AuctionTheme_post_content_after_buttons'); ?>
              </div>
              <div class="watch-list">
                <?php if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true): ?>
                  <a class="btn btn-danger btn-xs rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                <?php else: ?>
                  <a class="btn btn-default btn-xs add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>
              </div>
              <!-- ############### -->
            </div> <!--  title_holder -->
            <div  class="col-md-3" >
              <?php } ?>
              <div class="details_holder"> 
                <?php /*?> 
                <ul class="auction-details1">
                  <li>
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                    <h3><?php echo __("Price",'AuctionTheme'); ?>:</h3>
                    <p><?php echo auctionTheme_get_show_price(auctionTheme_get_current_price(get_the_ID())); ?>
                    <?php if($only_buy_now == '1') : ?>
                      [<?php _e("BuyNow",'AuctionTheme'); ?>]                                
                    <?php endif; ?>
                    </p>
                  </li>
            
                  <?php if($only_buy_now != '1') : ?>
                    <?php if(!empty($buy_now)): ?>
                    
                      <li>
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                        <h3><?php echo __("Buy Now",'AuctionTheme'); ?>:</h3>
                        <p><?php echo auctionTheme_get_show_price($buy_now); ?></p>
                      </li>
                    <?php endif; ?>
                    
                    
                    <li>
                      <img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" width="15" alt="posted" height="15" />  
                      <h3><?php _e("Bids",'AuctionTheme');?>:</h3>
                      <p><?php echo auctionTheme_number_of_bid(get_the_ID()); ?></p> 
                    </li>   
                  <?php endif; ?>

                  <li>
                    <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="15" alt="posted" height="15" /> 
                    <h3><?php echo __("Posted on",'AuctionTheme'); ?>:</h3>
                    <p><?php the_time("j F Y g:i A"); ?></p>
                  </li>
                  
                  <?php if($closed == "0"):              
                    $AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
                    if($only_buy_now == "1" and $AuctionTheme_no_time_on_buy_now == "yes"): 
                      //asd
                    else:
                    ?>
                      <li>
                        <img src="<?php echo get_bloginfo('template_url'); ?>/images/clock.png" width="15" alt="clock" height="15" /> 
                        <h3><?php echo __("Expires in",'AuctionTheme'); ?>:</h3>
                                        
                                        <p class="expiration_auction_p"><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : ($ending - current_time('timestamp',0))); ?></p>
                                        
                        <!--<p><?php echo ($closed=="1" ? __('Closed', 'AuctionTheme') : AuctionTheme_prepare_seconds_to_words($ending - current_time('timestamp',0))); ?></p> -->
                      </li>
                  <?php 
                    endif; 
                  endif; 
                  ?>
                                
                  <?php  if($asd_paid_items == 1): ?> 
                    <li>
                      <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="15" alt="posted" height="15" /> 
                      <h3><?php echo __("Buyer",'AuctionTheme'); ?>:</h3>
                      <p> <a href="<?php echo AuctionTheme_get_user_profile_link($winner->ID); ?>"><?php echo $winner->user_login; ?></a></p>
                    </li>
                    <li>
                      <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="15" alt="posted" height="15" /> 
                      <h3><?php echo __("Bought On",'AuctionTheme'); ?>:</h3>
                      <p> <?php echo date_i18n("j F Y g:i A", $rows->date_choosen); ?></p>
                    </li>
                                
                  <?php endif; ?>
                              
              </ul><?php */?>

              <ul class="auction-details1">
                <li class="text-success"><strong>Guide Price: <?php echo get_post_meta($pid, 'guide_price' ,true); ?></strong></li>                
                <li><strong>Auction:</strong> <?php echo get_the_term_list( $post->ID, 'auction_info', '', ' in ', '' ); ?></li>
                <li><strong>Agent:</strong> <?php the_author() ?>
                  <div class="partner_image pull-right"><?php echo get_avatar( get_the_author_meta('email'), 72 );; ?>
                  </div>
                </li>
                <?php $viewing=get_post_meta($pid, 'viewing_days' ,true);
                if(!empty($viewing)){
                  echo "<li><h3>Viewing Days:</h3><p>" . $viewing . "</p></li>";
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>        
<?php
}
}
/*****************************************************************************

              Homepage Function

*****************************************************************************/
function auctionTheme_get_homepage_post_function()
{
  global $wpdb;
  $args = array( 'post_type' => 'auction', 'orderby' => 'rand', 'posts_per_page' => 8 );
  $loop = new WP_Query( $args );
echo '<div id="featured-properties" class="row">
      <div class="col-md-12">
        <h3>Featured Properties</h3>
      </div>';
    if($wpdb->num_rows==0){
    echo "<div class='col-md-12'>We are currently compiling a catalogue of properties for our next auction. Please check back soon!</div>"; 
    }
    else {
          while ( $loop->have_posts() ) : $loop->the_post(); $count++;

  echo '<div class="col-md-3 col-sm-6" id="post-ID-';
  the_ID();
  echo'"> <div class="img-panel"><a href="';
  the_permalink();
  echo' ">';
echo AuctionTheme_get_home_post_image(get_the_ID());
  echo'</a><div class="description"><div class="title">';
      the_title();
      echo '</div><div class="price">Guide Price: ';
      echo get_post_meta(get_the_ID(), 'guide_price' ,true);
      echo '</div></div></div></div>';
      if ( 0 == $count%4 ) {
        echo '</div><div class="row">';
    }
endwhile;
    }
}

function get_news_posts()
{
  $args = array( 'post_type' => 'post', 'orderby' => 'asc', 'posts_per_page' => 4 );
  $loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
  echo '<p>';
      echo '<a href="';
  the_permalink();
  echo '">';
  echo the_title();
      echo '</a></p>';
endwhile;
          
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_item_primary_cat($pid)
{
  $auction_cat = wp_get_object_terms($pid, 'auction_cat');  
  if(is_array($auction_cat))
  {
    return  $auction_cat[0]->term_id;
  }
  
  return 0;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
add_filter('auctionTheme_get_post_not_shipped','auctionTheme_get_post_not_shipped_function');

function auctionTheme_get_post_not_shipped()
{
  do_action('auctionTheme_get_post_not_shipped'); 
}

add_filter('auctionTheme_get_post_received_offer','auctionTheme_get_post_received_offer_function');

function auctionTheme_get_post_received_offer()
{
  do_action('auctionTheme_get_post_received_offer');  
}

add_filter('auctionTheme_get_post_sent_offer','auctionTheme_get_post_sent_offer_function');

function auctionTheme_get_post_sent_offer()
{
  do_action('auctionTheme_get_post_sent_offer');  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_get_post_sent_offer_function()
{


      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      
      global $current_user, $post;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      $user_u = get_userdata($post->uid);

                  
      
?>
        <div class="post" id="post-ID-<?php the_ID(); ?>">
                
                
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                
                
                
                <div class="padd10">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),75,65); ?></a>
                
                <div class="watch-list">
                <?php
      
      
        
        if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):        
        ?>
                
                 <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>   
                
        
                  </div>   
                </div>
                <div  class="title_holder" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php  the_title(); ?></a></h2>
  
                        
                        <p class="mypostedon"><?php echo __("Posted on",'AuctionTheme');?> <?php the_time('F jS, Y'); ?>  by 
                        <a href="<?php echo AuctionTheme_get_user_profile_link($author->ID); ?>"><?php the_author(); ?></a>
                  <br/>
                        <?php _e("Posted in","AuctionTheme");?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?> </p>
                  
          <div>
                    
          
                
                 <?php
         
          if($post->approved == 0 and $post->rejected == 0):
         
         ?>
                
                  <a href="<?php the_permalink(); ?>" class="post_bid_btn"><?php echo __("Waiting for acceptance/rejection", "AuctionTheme");?></a>
                  
              <?php else: ?>
                 
                 <?php if($post->rejected == 1) _e('Your offer has been rejected.','AuctionTheme'); ?>
                 <?php if($post->approved == 1) _e('Your offer has been accepted.','AuctionTheme'); ?>
                 
               
                    <?php endif; ?>
                    
                    
                    </div> </div>
           
                  
                    <div class="details_holder"> 
                  
                  
                  <ul class="auction-details1">
                  
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                <h3 class="offered_thing1"><?php echo __("Offered Price",'AuctionTheme'); ?>:</h3>
                <p class="offered_thing2"><?php echo auctionTheme_get_show_price($post->price); ?></p>
              </li>
                            
    
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" alt="price" width="15" height="15" /> 
                <h3 class="offered_thing1"><?php echo __("Submitted On",'AuctionTheme'); ?>:</h3>
                <p class="offered_thing2"><?php echo date_i18n('d-M-Y H:i:s', $post->datemade); ?></p>
              </li> 
                                        
          </ul>
                      
                
                  </div>   
                     
                     </div> </div>
<?php
}

if(!function_exists('auctionTheme_get_post_received_offer_function')) {
function auctionTheme_get_post_received_offer_function()
{


      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      
      global $current_user, $post;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      $user_u = get_userdata($post->uid);

                  
      
?>
        <div class="post" id="post-ID-<?php the_ID(); ?>">
                
                
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                
                
                
                <div class="padd10">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),75,65); ?></a>
                
                <div class="watch-list">
                <?php
      
      
        
        if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):        
        ?>
                
                 <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>   
                
        
                  </div>   
                </div>
                <div  class="title_holder" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php  the_title(); ?></a></h2>
  
                        
                        <p class="mypostedon"><?php echo __("Posted on",'AuctionTheme');?> <?php the_time('F jS, Y'); ?>  by 
                        <a href="<?php echo AuctionTheme_get_user_profile_link($author->ID); ?>"><?php the_author(); ?></a>
                  <br/>
                        <?php _e("Posted in","AuctionTheme");?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?> </p>
                  
          <div>
                    
          
                
                 <?php
         
          if($post->approved == 0 and $post->rejected == 0):
         
         ?>
                
                  <a href="<?php the_permalink(); ?>" class="post_bid_btn"><?php echo __("Answer/Reject Offer", "AuctionTheme");?></a>
                  
              <?php else: ?>
                 
                 <?php if($post->rejected == 1) _e('You have rejected this offer.','AuctionTheme'); ?>
                 <?php if($post->approved == 1) _e('You have accepted this offer.','AuctionTheme'); ?>
                 
               
                    <?php endif; ?>
                    
                    
                    </div> </div>
           
                  
                    <div class="details_holder"> 
                  
                  
                  <ul class="auction-details1">
                  
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                <h3 class="offered_thing1"><?php echo __("Offered Price",'AuctionTheme'); ?>:</h3>
                <p class="offered_thing2"><?php echo auctionTheme_get_show_price($post->price); ?></p>
              </li>
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" alt="price" width="15" height="15" /> 
                <h3 class="offered_thing1"><?php echo __("User",'AuctionTheme'); ?>:</h3>
                <p class="offered_thing2"><?php echo "<a href='" . AuctionTheme_get_user_profile_link($post->uid) . "'>" . $user_u->user_login . "</a>"; ?></p>
              </li> 
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" alt="price" width="15" height="15" /> 
                <h3 class="offered_thing1"><?php echo __("Submitted On",'AuctionTheme'); ?>:</h3>
                <p class="offered_thing2"><?php echo date_i18n('d-M-Y H:i:s', $post->datemade); ?></p>
              </li> 
                                        
          </ul>
                      
                
                  </div>   
                     
                     </div> </div>
<?php
}}

if(!function_exists('auctionTheme_get_post_not_shipped_function'))
{
function auctionTheme_get_post_not_shipped_function()
{


      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      
      global $current_user, $post;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      
          
            $bid  = auctionTheme_get_winner_bid($post->bid_id);
            $winner = get_userdata($bid->uid);

                  
      
?>
        <div class="post" id="post-ID-<?php the_ID(); ?>">
                
                
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                
                
                
                <div class="padd10">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),75,65); ?></a>
                
                <div class="watch-list">
                <?php
      
      
        
        if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):        
        ?>
                
                 <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>   
                
        
                  </div>   
                </div>
                <div  class="title_holder" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                        <?php  the_title(); ?></a></h2>
  
                        
                        <p class="mypostedon"><?php echo __("Posted on",'AuctionTheme');?> <?php the_time('F jS, Y'); ?>  by 
                        <a href="<?php echo AuctionTheme_get_user_profile_link($author->ID); ?>"><?php the_author(); ?></a>
                  <br/>
                        <?php _e("Posted in","AuctionTheme");?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?> </p>
                  
          <div>
                    
          
                  <p class="shipping_info">
                    <?php 
          
          $shp = get_user_meta($winner->ID, 'shipping_info', true);         
          printf(__('Buyer Shipping Info: %s','AuctionTheme'), $shp); ?>
                    </p>    
                
                 
                
                  <a href="<?php the_permalink(); ?>" class="post_bid_btn"><?php echo __("Read More", "AuctionTheme");?></a>
                  
                  <a href="<?php bloginfo('siteurl'); ?>/?a_action=mark_shipped&bid_id=<?php echo $post->bid_id; ?>" class="post_bid_btn"><?php echo __("Mark as Shipped", "AuctionTheme");?></a>
                  
                  
                 
               
                    
                    
                    
                    </div> </div>
           
                  
                    <div class="details_holder"> 
                  
                  
                  <ul class="auction-details1">
                  
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                <h3><?php echo __("Price",'AuctionTheme'); ?>:</h3>
                <p><?php echo auctionTheme_get_show_price($bid->bid); ?></p>
              </li>
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" alt="price" width="15" height="15" /> 
                <h3><?php echo __("Winner",'AuctionTheme'); ?>:</h3>
                <p><?php echo "<a href='" . AuctionTheme_get_user_profile_link($bid->uid) . "'>" . $winner->user_login . "</a>"; ?></p>
              </li> 
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" alt="price" width="15" height="15" /> 
                <h3><?php echo __("Aquired On",'AuctionTheme'); ?>:</h3>
                <p><?php echo date_i18n('d-M-Y H:i:s', $bid->date_choosen); ?></p>
              </li> 
                                        
          </ul>
                      
                
                  </div>   
                     
                     </div> </div>
<?php
}}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
if(!function_exists('auctionTheme_get_post_outstanding_payment')) {
function auctionTheme_get_post_outstanding_payment( $bid_id )
{

      if($arr[0] == "winner") $pay_this_me = 1;
      if($arr[0] == "unpaid") $unpaid = 1;

      $ending     = get_post_meta(get_the_ID(), 'ending', true);
      $sec      = $ending - current_time('timestamp',0);
      $location     = get_post_meta(get_the_ID(), 'Location', true);    
      $closed     = get_post_meta(get_the_ID(), 'closed', true);
      $post       = get_post(get_the_ID());
      $only_buy_now   = get_post_meta(get_the_ID(), 'only_buy_now', true);
      $buy_now    = get_post_meta(get_the_ID(), 'buy_now', true);
      $featured     = get_post_meta(get_the_ID(), 'featured', true);
      
      
      
      global $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $pid = get_the_ID();
      
      global $wpdb;
      
      $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
      $r = $wpdb->get_results($s);
      $bid = $r[0];
      
      
?>
        <div class="post" id="post-ID-<?php the_ID(); ?>">
                
                
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                
                
                
                <div class="padd10">
                <div class="image_holder">
                <a href="<?php the_permalink(); ?>"><?php echo AuctionTheme_get_first_post_image(get_the_ID(),75,65); ?></a>
                
                <div class="watch-list">
                <?php
        
        
        
         
        
        if(AuctionTheme_check_if_pid_is_in_watchlist(get_the_ID(), $uid) ):       
        ?>
                
                 <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- Favourites','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ Favourites','AuctionTheme'); ?></a>
                <?php endif; ?>   
                
        
                  </div>   
                </div>
                <div  class="title_holder" > 
                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php  the_title();  ?></a></h2>
                        
  
                 <p class="mypostedon"><?php echo __("Posted on",'AuctionTheme');?> <?php the_time('F jS, Y'); ?>. <?php printf(__('Seller: %s','AuctionTheme'),
         
         '<a href="'.auctionTheme_get_user_profile_link($post->post_author).'">'.get_the_author().'</a>'
         
         ) ; ?> 
                       
                  <br/>
                        <?php _e("Posted in","AuctionTheme");?> <?php echo get_the_term_list( get_the_ID(), 'auction_cat', '', ', ', '' ); ?> </p>
                       
                    <!-- ############### -->    
          <div>

                        <a href="<?php echo auctionTheme_pay_for_item_link($bid_id); ?>" 
                        class="post_bid_btn"><?php echo __("Pay This", "AuctionTheme");?></a>
      
                    <?php
             
             global $asd_paid_items;
             if($asd_paid_items == 1):
             
             ?> 
                        <p class="shipping_info">
                    <?php 
          
          $shp = get_user_meta($bid->uid, 'shipping_info', true);         
          printf(__('Buyer Shipping Info: %s','AuctionTheme'), $shp); ?>
                    </p>    
                        
                       <?php endif; ?>
                    </div>
                    <!-- ############### -->
                        
                     </div> 
                     
                  <div class="details_holder"> 
          
                  
                  
                  
                  <ul class="auction-details1">
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" alt="price" width="15" height="15" /> 
                <h3><?php echo __("Price",'AuctionTheme'); ?>:</h3>
                <p><?php echo auctionTheme_get_show_price($bid->bid); ?>           </p>
              </li>
    
              
              <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="15" alt="posted" height="15" /> 
                <h3><?php echo __("Posted on",'AuctionTheme'); ?>:</h3>
                <p><?php the_time("j F Y g:i A"); ?></p>
              </li>
                            
                            
                            <li>
                <img src="<?php echo get_bloginfo('template_url'); ?>/images/cal.png" width="15" alt="posted" height="15" /> 
                <h3><?php echo __("Purchased",'AuctionTheme'); ?>:</h3>
                <p><?php echo date_i18n("j F Y g:i A", $bid->date_choosen); ?></p>
              </li>
              
              
         </ul>
                      
                
                  </div>   
                     
                     </div></div>
<?php
}}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_get_first_post_image($pid, $w = 100, $h = 100, $clss = '', $string_image_size = '', $m = 0)
{
  
  //---------------------
  // build the exclude list
  $exclude = array();
  
  $args = array(
  'order'          => 'ASC',
  'post_type'      => 'attachment',
  'post_parent'    => get_the_ID(),
  'meta_key'     => 'another_reserved1',
  'meta_value'   => '1',
  'numberposts'    => -1,
  'post_status'    => null,
  );
  $attachments = get_posts($args);
  if ($attachments) {
      foreach ($attachments as $attachment) {
    $url = $attachment->ID;
    array_push($exclude, $url);
  }
  }
  
  //-----------------

  $args = array(
  'order'          => 'ASC',
  'orderby'        => 'post_date',
  'post_type'      => 'attachment',
  'post_parent'    => $pid,
  'exclude'       => $exclude,
  'post_mime_type' => 'image',
  'post_status'    => null,
  'numberposts'    => 1,
  );
  $attachments = get_posts($args);
  if ($attachments) {
      foreach ($attachments as $attachment) 
      {
      if($m == 1)
      $url = wp_get_attachment_image( $attachment->ID, $string_image_size );
      else
      $url = wp_get_attachment_image( $attachment->ID, array($w, $h) ); //wp_get_attachment_link($attachment->ID,  array($w, $h));
      
      return $url;    
    }
  }
  else{
      return '<img src="' . get_bloginfo('template_url') .'/images/nopic.png' . '" alt="no image" width="'.$w.'" height="'.$h.'" class="'.$clss.'" />';
      
  }
}

function AuctionTheme_get_home_post_image($pid, $w = 100, $h = 100, $clss = '', $string_image_size = '', $m = 0)
{
  
  //---------------------
  // build the exclude list
  $exclude = array();
  
  $args = array(
  'order'          => 'ASC',
  'post_type'      => 'attachment',
  'post_parent'    => get_the_ID(),
  'meta_key'     => 'another_reserved1',
  'meta_value'   => '1',
  'numberposts'    => -1,
  'post_status'    => null,
  );
  $attachments = get_posts($args);
  if ($attachments) {
      foreach ($attachments as $attachment) {
    $url = $attachment->ID;
    array_push($exclude, $url);
  }
  }
  
  //-----------------

  $args = array(
  'order'          => 'ASC',
  'orderby'        => 'post_date',
  'post_type'      => 'attachment',
  'post_parent'    => $pid,
  'exclude'       => $exclude,
  'post_mime_type' => 'image',
  'post_status'    => null,
  'numberposts'    => 1,
  );
  $attachments = get_posts($args);
  if ($attachments) {
      foreach ($attachments as $attachment) 
      {
      if($m == 1)
      $url = wp_get_attachment_image( $attachment->ID, $string_image_size );
      else
      $url = wp_get_attachment_image($attachment->ID,  medium, 0, array('class' => "img-rounded-top img-responsive")); //wp_get_attachment_link( $attachment->ID, array($w, $h) ); 
      
      return $url;    
    }
  }
  else{
      return '<img src="' . get_bloginfo('template_url') .'/images/nopic.png' . '" alt="no image" width="'.$w.'" height="'.$h.'" class="'.$clss.'" />';
      
  }
}

function AuctionTheme_wp_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {

  $html = '';
  $image = wp_get_attachment_image_src($attachment_id, $size, $icon);
  if ( $image ) {
    list($src, $width, $height) = $image;
    $hwstring = image_hwstring($width, $height);
    if ( is_array($size) )
      $size = join('x', $size);
    $attachment =& get_post($attachment_id);
    $default_attr = array(
      'src' => $src,
      'class' => "attachment-$size",
      'alt' => trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )), // Use Alt field first
      'title' => trim(strip_tags( $attachment->post_title )),
    );
    if ( empty($default_attr['alt']) )
      $default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption
    if ( empty($default_attr['alt']) )
      $default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title

    $attr = wp_parse_args($attr, $default_attr);
    $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment );
    $attr = array_map( 'esc_attr', $attr );
    $html = rtrim("<img $hwstring");
     
    $html = $attr['src'];
  }

  return $html;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_custom_fields_html()
{
  global $post, $wpdb;
  $pid = $post->ID;
  ?>
    <table width="100%">
    <input type="hidden" value="1" name="fromadmin" />
  <?php
    $cat        = wp_get_object_terms($pid, 'auction_cat');
    $catidarr     = array();
    
    foreach($cat as $catids)
    {
      $catidarr[] = $catids->term_id;
    }
  
    $arr  = get_auction_category_fields($catidarr, $pid);
    
    for($i=0;$i<count($arr);$i++)
    {
      
              echo '<tr>';
          echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';
          echo '<td>'.$arr[$i]['value'];
          do_action('AuctionTheme_step3_after_custom_field_'.$arr[$i]['id'].'_field');
          echo '</td>';
          echo '</tr>';
      
      
    } 
  
  ?> 
    
    
    </table>
    <?php 
  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_theme_auction_bids()
{
  global $post;
  $pid = $post->ID;
  
        
        $closed = get_post_meta($pid, 'closed', true);
        $post = get_post($pid);
        global $wpdb;
        
        
        $bids = "select * from ".$wpdb->prefix."auction_bids where pid='$pid' order by id DESC";
        $res  = $wpdb->get_results($bids);
      
        ?>
                
                <script>
                
        $( document ).ready(function() {
              jQuery( ".delete_bid_smka" ).click(function() {
         var ids = jQuery( this ).attr("rel");
         jQuery("#thth_" + ids).hide();
         
          $.ajax({
            method: 'get',
            url : '<?php echo get_bloginfo('siteurl');?>?_bid_delete_pid=' + ids,
            dataType : 'text',
            success: function (text) {   alert('Bid deleted!');  }
           });
         
         
         return false;
         
        });
        
        });
                
        </script>
                
                <?php
        
        if(count($res) > 0)
        {
          
        
          
            echo '<table width="100%">';
            echo '<thead><tr>';
              echo '<th>'.__('Username','AuctionTheme').'</th>';
              echo '<th>'.__('Bid Amount','AuctionTheme').'</th>';
              echo '<th>'.__('Date Made','AuctionTheme').'</th>';
              
              echo '<th>'.__('Winner','AuctionTheme').'</th>';
              echo '<th>'.__('Options','AuctionTheme').'</th>';
              
            echo '</tr></thead><tbody>';
          
          
          //-------------
          
          foreach($res as $row)
          {
            
            
            $user = get_userdata($row->uid);
            echo '<tr id="thth_'.$row->id.'">';
            echo '<th>'.$user->user_login.'</th>';
            echo '<th>'.auctionTheme_get_show_price($row->bid).'</th>';
            echo '<th>'.date_i18n("d-M-Y H:i:s", $row->date_made).'</th>';
            
            
            if($row->winner == 1) echo '<th>Yes</th>'; else echo '<th>&nbsp;</th>'; 
            
            echo '<th><a href="#" rel="'.$row->id.'" class="delete_bid_smka">Delete</a></th>';
            
            echo '</tr>';
            
          }
          
          echo '</tbody></table>';
        }
        else _e("No bids placed yet.");
        ?>  

<?php
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_theme_auction_dts()
{
  global $post;
  $pid = $post->ID;
  $price = get_post_meta($pid, "price", true);
  $location = get_post_meta($pid, "Location", true);
  $f = get_post_meta($pid, "featured", true);
  $t = get_post_meta($pid, "closed", true);
  $allow_offers = get_post_meta($pid, "allow_offers", true);
  $reverse = get_post_meta($pid, "reverse", true);
  
  ?>
    
    <ul id="post-new4"> 
    <input name="fromadmin" type="hidden" value="1" />
    
       <li>
          <h2><?php echo __('Guide Price','AuctionTheme'); ?>:</h2>
        <p><input type="text" name="guide_price" class="do_input" 
          value="<?php echo get_post_meta($pid, 'guide_price', true); ?>" /> 
      </p>
        </li>
        
        
        
         <li>
          <h2><?php echo __('Address','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="15" name="Location" class="do_input" 
          value="<?php echo get_post_meta($pid, 'Location', true); ?>" /></p>
        </li>
 
        
 <?php /*?>       <li>
          <h2><?php echo __('Start Price','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="start_price" class="do_input" 
          value="<?php echo get_post_meta($pid, 'start_price', true); ?>" /> 
      <?php echo auctionTheme_currency(); ?></p>
        </li><?php */?>
        
        
       <?php /*?>  <li>
          <h2><?php echo __('Reserve Price','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="reserve" class="do_input" 
          value="<?php echo get_post_meta($pid, 'reserve', true); ?>" /> 
      <?php echo auctionTheme_currency(); ?></p>
        </li><?php */?>
        
        <?php /*?>
         <li>
          <h2><?php echo __('Buy Now Price','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="buy_now" class="do_input" 
          value="<?php echo get_post_meta($pid, 'buy_now', true); ?>" /> <?php echo auctionTheme_currency(); ?>
            
             <input name="only_buy_now" value="1" type="checkbox" <?php if(get_post_meta($pid,'only_buy_now',true) == "1") echo 'checked="checked"'; ?> /> 
       <?php _e('Only buy now auction','AuctionTheme'); ?>
             
            </p>
        </li>
        
        
        
        
        <li>
          <h2><?php echo __('Quantity','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="quant" class="do_input" 
          value="<?php echo get_post_meta($pid, 'quant', true); ?>" /></p>
        </li>
        
        
   
       <li>
          <h2><?php echo __('Shipping Cost', 'AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="shipping" class="do_input" 
          value="<?php echo get_post_meta($pid, 'shipping', true); ?>" /> <?php echo auctionTheme_currency(); ?></p>
        </li>
        
    
      <li>
          <h2><?php echo __('Private Bids','AuctionTheme'); ?>:</h2>
        <p><select name="private_bids">
        <option value="no" <?php if(get_post_meta($pid,'private_bids',true) == "no") echo 'selected="selected"'; ?>><?php _e("No",'AuctionTheme'); ?></option>
        <option value="yes" <?php if(get_post_meta($pid,'private_bids',true) == "yes") echo 'selected="selected"'; ?>><?php _e("Yes",'AuctionTheme'); ?></option>
        
        </select>
        </p>
        </li><?php */?>
    
      <li>
        <h2><?php _e("Feature this auction",'AuctionTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="featureds" <?php if($f == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        <li>
        <h2><?php _e("Allow Offers",'AuctionTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="allow_offers" <?php if($allow_offers == '1') echo ' checked="checked" '; ?> /></p>
        </li>
        
        
        <li>
        <h2><?php _e("Closed",'AuctionTheme');?>:</h2>
        <p><input type="checkbox" value="1" name="closed" <?php if($t == '1') echo ' checked="checked" '; ?> /></p>
        </li>
                 <li>
        <h2>Viewing Days</h2>
        <p><input type="text" name="viewing_days" id="viewing_days" value="<?php echo get_post_meta($pid,'viewing_days',true);?>" class="do_input"  /></p>
        </li>
        
        
        
                 <li>
        <h2>

          
       <?php _e("Auction Ending On",'AuctionTheme'); ?>:</h2>
        <p><input type="text" name="ending" id="ending" value="<?php
    
    $d = get_post_meta($pid,'ending',true);
    
    if(!empty($d)) {
    $r = date_i18n('m/d/Y H:i:s', $d);
    echo $r;
    }
     ?>" class="do_input"  /></p>
        </li>
        
 <script>

jQuery(document).ready(function() {
             jQuery('#ending').datetimepicker({
            showSecond: true,
      dateFormat: 'dd-mm-yy',
            timeFormat: 'hh:mm:ss'
        });});
    
 </script>
        
        
  </ul>    

  
  <?php
  
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_generate_thumb($img_ID, $width, $height, $cut = true)
{

  return AuctionTheme_wp_get_attachment_image($img_ID, array($width, $height ));
}

function AuctionTheme_generate_thumb_upload_cls($img_ID )
{

  return AuctionTheme_wp_get_attachment_image($img_ID, array(80,80));
}


/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_is_different_home_layout()
{
  //$AuctionTheme_home_page_layout = get_option('AuctionTheme_home_page_layout');
  return false;
  
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_currency()
{
  $sm = get_option('AuctionTheme_currency_symbol');
  $c = trim($sm);
  if(empty($c)) return get_option('AuctionTheme_currency');
  return $c;  
  
}
function auctionTheme_currency()
{
  return AuctionTheme_get_currency(); 
}
/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_get_show_price($price, $cents = 2)
{ 
  $AuctionTheme_currency_position = get_option('AuctionTheme_currency_position'); 
  if($AuctionTheme_currency_position == "front") return AuctionTheme_get_currency()."".AuctionTheme_formats($price, $cents);  
  return AuctionTheme_formats($price,$cents)."".AuctionTheme_get_currency();  
    
}

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/

function AuctionTheme_formats($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always
  
  $dec_sep = get_option('AuctionTheme_decimal_sum_separator');
  if(empty($dec_sep)) $dec_sep = '.';
  
  $tho_sep = get_option('AuctionTheme_thousands_sum_separator');
  if(empty($tho_sep)) $tho_sep = ',';
  
  //dec,thou
  
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, $tho_sep ); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, $tho_sep ); // format
      } // integer or decimal
    } // value
    return $money;
  } // numeric
} // formatMoney

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_prepare_seconds_to_words($seconds)
  {
    $res = AuctionTheme_seconds_to_words_new($seconds); 
    if($res == "Expired") return __('Expired','AuctionTheme');  
    
    if($res[0] == 0) return sprintf(__("%s hours, %s min, %s sec",'AuctionTheme'), $res[1], $res[2], $res[3]);
    if($res[0] == 1){
      
      $plural = $res[1] > 1 ? __('days','AuctionTheme') : __('day','AuctionTheme');
      return sprintf(__("%s %s, %s hours, %s min",'AuctionTheme'), $res[1], $plural , $res[2], $res[3]);
    }
  }

/*************************************************************
*
* AuctionTheme (c) sitemile.com - function
*
**************************************************************/
function AuctionTheme_seconds_to_words_new($seconds)
{
    if($seconds < 0 ) return 'Expired';
      
        /*** number of days ***/
        $days=(int)($seconds/86400); 
        /*** if more than one day ***/
        $plural = $days > 1 ? 'days' : 'day';
        /*** number of hours ***/
        $hours = (int)(($seconds-($days*86400))/3600);
        /*** number of mins ***/
        $mins = (int)(($seconds-$days*86400-$hours*3600)/60);
        /*** number of seconds ***/
        $secs = (int)($seconds - ($days*86400)-($hours*3600)-($mins*60));
        /*** return the string ***/
                if($days == 0 || $days < 0)
        {
          $arr[0] = 0;
          $arr[1] = $hours;
          $arr[2] = $mins;
          $arr[3] = $secs;
          return $arr;//sprintf("%d hours, %d min, %d sec", $hours, $mins, $secs);
        }
        else
        {
          $arr[0] = 1;
          $arr[1] = $days;
          $arr[2] = $hours;
          $arr[3] = $mins;
          
          return $arr; //sprintf("%d $plural, %d hours, %d min", $days, $hours, $mins);
            }     
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_number_of_bid($pid)
{
  global $wpdb;
  $s = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid'";
  $r = $wpdb->get_results($s);
  
  return count($r);
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_number_of_bid_see_and_buy_now($pid)
{
  global $wpdb;
  $s = "select id from ".$wpdb->prefix."auction_bids where pid='$pid'";
  $r = $wpdb->get_results($s);
  $c = count($r);
  
  if($c > 0) 
  {
    $only_buy_now = get_post_meta($pid,'only_buy_now',true);
    if($only_buy_now == "1") return true;
    else return false;
  }
  else return true;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_bid_values($pid)
{
  global $wpdb;
  $s = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid desc";
  $r = $wpdb->get_results($s);
  
  return $r;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_current_price($pid = '')
{
  if(empty($pid)) $pid = get_the_ID(); 
  $only_buy_now = get_post_meta($pid, 'only_buy_now' ,true);
  
  if($only_buy_now == '1') return get_post_meta($pid, 'buy_now', true);
  
  $reverse = get_post_meta($pid, "reverse", true);
  if($reverse == "yes")
  {
    $bids = auctionTheme_get_bid_values($pid);
    
    if(count($bids) == 0) 
    { 
      $start = auctionTheme_get_start_price($pid); 
      return ($start == false ? 0 : $start );  
    }
    else
    {
      return auctionTheme_get_lowest_bid($pid);     
    }
    
  } //return get_post_meta($pid, 'price', true);
  else
  {
    $bids = auctionTheme_get_bid_values($pid);
    
    if(count($bids) == 0) 
    { 
      $start = auctionTheme_get_start_price($pid); 
      return ($start == false ? 0 : $start );  
    }
    else
    {
      return auctionTheme_get_highest_bid($pid);      
    }
    
  }
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_start_price($pid = '')
{
  if(empty($pid)) $pid = get_the_ID();
  $price = get_post_meta($pid, 'start_price', true);
  
  if(empty($price)) $price = false;
  return $price;
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_get_auction_category_fields_without_vals($catid, $clas_op = '')
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_custom_fields order by ordr asc";  
  $r = $wpdb->get_results($s);
  
  $arr1 = array(); $i = 0;
  
  if($clas_op != "no") $clas_op = 'do_input';
  
  foreach($r as $row)
  {
    $ims  = $row->id;
    $name   = $row->name;
    $tp   = $row->tp;
    
    if($row->cate == 'all')
    { 
      $arr1[$i]['id']   = $ims; 
      $arr1[$i]['name']   = $name; 
      $arr1[$i]['tp']   = $tp; 
      $i++; 
    
    }
    else
    {
      $se = "select * from ".$wpdb->prefix."auction_custom_relations where custid='$ims'";
      $re = $wpdb->get_results($se);
      
      if(count($re) > 0)
      foreach($re as $rowe) // = mysql_fetch_object($re))
      {
        if(count($catid) > 0)
        foreach($catid as $id_of_cat)
        {
        
          if($rowe->catid == $id_of_cat)
          {
            $flag_me = 1;
            for($k=0;$k<count($arr1);$k++)
            {
              if( $arr1[$k]['id']   == $ims ) {  $flag_me = 0; break; }           
            }
            
            if($flag_me == 1)
            {
              $arr1[$i]['id']   = $ims; 
              $arr1[$i]['name']   = $name; 
              $arr1[$i]['tp']   = $tp;
              $i++;
            }
          }
        }
      }
    }
  }

  $arr = array();
  $i = 0;
  
  for($j=0;$j<count($arr1);$j++)
  {
    $ids  = $arr1[$j]['id'];
    $tp   = $arr1[$j]['tp'];
    
    $arr[$i]['field_name']  = $arr1[$j]['name'];
    $arr[$i]['id']  = '<input type="hidden" value="'.$ids.'" name="custom_field_id[]" />';
    
    if($tp == 1) 
    {
    
    $teka = ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
  
    $arr[$i]['value']  = '<input class="'.$clas_op.'" type="text" name="custom_field_value_'.$ids.'" 
    value="'.(isset($_GET['custom_field_value_'.$ids]) ? $_GET['custom_field_value_'.$ids] : $teka ).'" />';
    
    }
    
    if($tp == 5)
    {
    
      $teka   = ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
      $value  = isset($_GET['custom_field_value_'.$ids]) ? $_GET['custom_field_value_'.$ids] : $teka;
      
      $arr[$i]['value']  = '<textarea rows="5" cols="40" class="'.$clas_op.'" name="custom_field_value_'.$ids.'">'.$value.'</textarea>';
    
    }
    
    if($tp == 3) //radio
    {
      $arr[$i]['value']  = '';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        $arr[$i]['value']  .= '<span class="radio-spacer"></span>';
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka   = ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
          if(isset($_GET['custom_field_value_'.$ids]))
          {
            if($_GET['custom_field_value_'.$ids] == $row2->valval) $value = 'checked="checked"';
            else $value = '';
          }
          elseif(!empty($pid))
          {
            $v = ''; //get_post_meta($pid, 'custom_field_ID_'.$ids, true);
            if($v == $row2->valval) $value = 'checked="checked"';
            else $value = ''; 
          
          }       
          else $value = '';
          
          $arr[$i]['value']  .= '<label class="radio-inline">'.$row2->valval.'<input type="radio" '.$value.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'"></label>';
        }
    }
    
    
    if($tp == 4) //checkbox
    {
      $arr[$i]['value']  = '';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        
        
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka   = $_GET['custom_field_value_'.$ids]; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

        
          if(is_array($teka))
          { 
            $tekam = '';
            
            foreach($teka as $te)
            {
              
              if($te == $row2->valval) { $tekam = "checked='checked'"; break; }
            } 
            
                  
          }
          else $tekam = '';
          
      
          
          $arr[$i]['value']  .= '<input '.$tekam.' type="checkbox" value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';
        }

    }
    
    if($tp == 2) //select
    {
      $arr[$i]['value']  = '<br><select class="form-control '.$clas_op.'" name="custom_field_value_'.$ids.'" /><option value="">'.__('Select','AuctionTheme').'</option>';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka   = ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;
          
          if(!empty($teka))
          { 
            foreach($teka as $te)
            {
              if($te == $row2->valval) { $teka = "selected='selected'"; break; }
            } 
            
            $teka = '';     
          }
          else $teka = '';
          
          if(isset($_GET['custom_field_value_'.$ids]) && $_GET['custom_field_value_'.$ids] == $row2->valval)
          $value = "selected='selected'" ;
          else $value = $teka;
          
          
          $arr[$i]['value']  .= '<option '.$value.' value="'.$row2->valval.'">'.$row2->valval.'</option>';
        
        }
      $arr[$i]['value']  .= '</select>';
    }
    
    $i++;
  }
  
  return $arr;
}


/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_highest_bid($pid)
{
  $reverse = get_post_meta($pid, 'reverse', true);
  
  global $wpdb;
  $s = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid desc limit 1";
  
  if($reverse == "yes") $s = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid asc limit 1";
  
  $r = $wpdb->get_results($s);
  
  if(count($r) == 0)
  {
    $start_price = get_post_meta($pid, 'start_price', true);
    if(empty($start_price)) return false;
    return ($start_price - 0.01); 
    
  }
  
  
  $r = $r[0];
  return $r->bid;
}

function auctionTheme_has_1_bid($pid)
{
  global $wpdb;
  $s = "select id from ".$wpdb->prefix."auction_bids where pid='$pid' limit 1";
  $r = $wpdb->get_results($s);
  
  if(count($r) == 0)
  {
    return false;
    
  }
  
  return true;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_lowest_bid($pid)
{
  global $wpdb;
  $s = "select bid from ".$wpdb->prefix."auction_bids where pid='$pid' order by bid asc limit 1";
  $r = $wpdb->get_results($s);
  
  if(count($r) == 0)
  {
    $start_price = get_post_meta($pid, 'start_price', true);
    if(empty($start_price)) return false;
    return $start_price;  
    
  }
  
  
  $r = $r[0];
  return $r->bid;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_framework_init_widgets()
{

  
  

  register_sidebar( array(
    'name' => __( 'Single Page Sidebar', 'AuctionTheme' ),
    'id' => 'single-widget-area',
    'description' => __( 'The sidebar area of the single blog post', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
  
  
    
      register_sidebar( array(
    'name' => __( 'AuctionTheme - Stretch Wide MainPage Sidebar', 'AuctionTheme' ),
    'id' => 'main-stretch-area',
    'description' => __( 'This sidebar is site wide stretched in home page, just under the slider/menu.', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
  
  
    register_sidebar( array(
    'name' => __( 'Other Page Sidebar', 'AuctionTheme' ),
    'id' => 'other-page-area',
    'description' => __( 'The sidebar area of any other page than the defined ones', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
  
  
  
  register_sidebar( array(
    'name' => __( 'Home Page Sidebar - Right', 'AuctionTheme' ),
    'id' => 'home-right-widget-area',
    'description' => __( 'The right sidebar area of the homepage', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
  
  
  
  register_sidebar( array(
    'name' => __( 'Home Page Sidebar - Left', 'AuctionTheme' ),
    'id' => 'home-left-widget-area',
    'description' => __( 'The left sidebar area of the homepage', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
  
  
  register_sidebar( array(
    'name' => __( 'First Footer Widget Area', 'AuctionTheme' ),
    'id' => 'first-footer-widget-area',
    'description' => __( 'The first footer widget area', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 4, located in the footer. Empty by default.
  register_sidebar( array(
    'name' => __( 'Second Footer Widget Area', 'AuctionTheme' ),
    'id' => 'second-footer-widget-area',
    'description' => __( 'The second footer widget area', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 5, located in the footer. Empty by default.
  register_sidebar( array(
    'name' => __( 'Third Footer Widget Area', 'AuctionTheme' ),
    'id' => 'third-footer-widget-area',
    'description' => __( 'The third footer widget area', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  // Area 6, located in the footer. Empty by default.
  register_sidebar( array(
    'name' => __( 'Fourth Footer Widget Area', 'AuctionTheme' ),
    'id' => 'fourth-footer-widget-area',
    'description' => __( 'The fourth footer widget area', 'AuctionTheme' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  

    
      register_sidebar( array(
      'name' => __( 'AuctionTheme - Auction Single Sidebar', 'AuctionTheme' ),
      'id' => 'auction-widget-area',
      'description' => __( 'The sidebar of the single auction page', 'AuctionTheme' ),
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget' => '</li>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );
    
    
      register_sidebar( array(
      'name' => __( 'AuctionTheme - HomePage Area','AuctionTheme' ),
      'id' => 'main-page-widget-area',
      'description' => __( 'The sidebar for the main page, just under the slider.', 'AuctionTheme' ),
      'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
      'after_widget' => '</li>',
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    ) );
    

  
}

function auctiontheme_my_widget_content_wrap($content) {
    $content = '<div class="my-only-widget-content">'.$content.'</div>';
    return $content;
}
add_filter('widget_text', 'auctiontheme_my_widget_content_wrap');

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_is_home()
{
  global $current_user, $wp_query;
  $a_action   =  $wp_query->query_vars['a_action']; 
  
  if(!empty($a_action)) return false;
  if(is_home()) return true;
  return false;
  
}

function auctionTheme_coin_slider_home()
  {
    
    ?>
        <script type="text/javascript">
                
           
            jQuery(document).ready(function() {
 
    jQuery('.parent_taxe').click(function () {
      
      var rels = jQuery(this).attr('rel');
      jQuery("#" + rels).toggle();
      jQuery("#img_" + rels).attr("src","<?php bloginfo('template_url'); ?>/images/posted1.png");
      
      return false;
    });
 
 
});
       </script>
        
        <?php
    
    
    if(0) //is_home())
    {
      ?>
      <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_bloginfo('template_url'); ?>/css/skins.css" />
      <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jcar.js"></script>
      
      <script type="text/javascript">
      
      var $ = jQuery;
      
        jQuery(document).ready(function() {
        jQuery('#mycarousel').jcarousel({
          wrap: 'circular',
          scroll: 1,
          visible: 7
        });
      });
  
      </script>
      
      <?php
    }
    
  }
  
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_get_unread_number_messages($uid)
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_pm where user='$uid' and show_to_destination='1' and rd='0'";
        $r = $wpdb->get_results($s);  
        return count($r);
}
  
  
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_get_users_links()
{
    global $current_user, $wpdb;
    get_currentuserinfo();
    //$rd = AuctionTheme_get_unread_number_messages($current_user->ID);
    //if($rd > 0) $ssk = "<span class='notif_a'>".$rd."</span>"; else $ssk = '';
  
    $uid = $current_user->ID;
    
    //------------------
    
    $query = "select id from ".$wpdb->prefix."auction_ratings where fromuser='$uid' AND awarded='0'";
    $r = $wpdb->get_results($query);
    $ttl_fdbks = count($r);
      
    if($ttl_fdbks > 0) 
      $ttl_fdbks2 = "<span class='notif_a'>".$ttl_fdbks."</span>";  
    
  
  

          $rd = auctionTheme_get_unread_number_messages($current_user->ID);
          if($rd > 0) $ssk = "<span class='notif_a'>".$rd.'</span>';
          
          
  
?>
  
      <div id="right-sidebar">
      <ul class="xoxo">
      
      <li class="widget-container widget_text"><h3 class="widget-title"><?php _e("My Account Menu",'AuctionTheme'); ?></h3>
      <div class="my-only-widget-content">
      
            <ul id="my-account-admin-menu">
                    <li><a href="<?php echo auctionTheme_my_account_link(); ?>"><?php _e("MyAccount Home",'AuctionTheme');?></a></li>
                    
                    <?php
          
            if(AuctionTheme_is_able_to_post_auctions()):
          
          ?>
                    <li><a href="<?php echo auctionTheme_post_new_link(); ?>"><?php _e("Post New Auction",'AuctionTheme');?></a></li>
                    
                    <?php endif; ?>
                    
                    <?php
          
          do_action('AuctionTheme_before_payments_user_menu');
          
          $AuctionTheme_enable_pay_credits = get_option('AuctionTheme_enable_pay_credits');   
          if($AuctionTheme_enable_pay_credits != 'no'):
          
          ?>
                    
                    <li><a href="<?php echo auctionTheme_get_payments_link(); ?>"><?php _e("Payments",'AuctionTheme');?></a></li>
                    
                    <?php endif; ?>
                    
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_priv_mess_page_id')); ?>"><?php echo sprintf(__("Private Messages %s",'AuctionTheme'),$ssk);?></a></li>
                    
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_personal_info_page_id')); ?>"><?php _e("Personal Info",'AuctionTheme');?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_reviews_page_id')); ?>"><?php printf(__("Reviews/Feedback %s",'AuctionTheme'), $ttl_fdbks2);?></a></li>
            </ul>
            
            </div>
      </li>
            
            <!-- ###### -->
      <?php
      
        if(AuctionTheme_is_able_to_post_auctions()):
      
      ?>
            <li class="widget-container widget_text"><h3 class="widget-title"><?php _e("Seller Menu",'AuctionTheme'); ?></h3>
      <div class="my-only-widget-content">
      
            <ul id="my-account-admin-menu_seller">
           
           <?php
      

      $querystr = "SELECT distinct wposts.ID , bids.id bid_id
          FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids 
          WHERE wposts.ID=bids.pid AND
          wposts.post_author='$uid' AND 
          bids.winner='1' AND 
          bids.shipped='0' AND
          bids.paid='0'";
          
      $r = $wpdb->get_results($querystr);     
      $rd = count($r);      
      if($rd > 0) $outs = "<span class='notif_a'>".$rd.'</span>'; else $outs = '';
      
      //--------------------------------------------------------------------------------
      
      $querystr = "SELECT distinct wposts.ID, bids.id bid_id 
          FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids 
          WHERE wposts.ID=bids.pid AND
          wposts.post_author='$uid' AND 
          bids.winner='1' AND 
          bids.shipped='0' AND
          bids.paid='1'";
          
      $r = $wpdb->get_results($querystr);     
      $rd1 = count($r);     
      if($rd1 > 0) $outs1 = "<span class='notif_a'>".$rd1.'</span>'; else $outs1 = '';
      
      ?>
           
                <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_offers_seller_id')); ?>"><?php _e("Offers Received",'AuctionTheme');?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_active_auctions_id')); ?>"><?php _e("Active Auctions",'AuctionTheme');?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_sold_auctions_id')); ?>"><?php _e("Sold Items",'AuctionTheme');?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_closed_auctions_id')); ?>"><?php _e("Closed Auctions",'AuctionTheme');?></a></li>
                    
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_unpub_auctions_id')); ?>"><?php _e("Unpublished Auctions",'AuctionTheme');?></a></li>                    
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_aw_pay_auctions_id')); ?>"><?php printf(__("Awaiting Payment Items %s",'AuctionTheme'), $outs);?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_not_shipped_auctions_id')); ?>"><?php printf(__("Not Shipped Items %s",'AuctionTheme'), $outs1);?></a></li>
                    <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_shipped_auctions_id')); ?>"><?php _e("Shipped Items",'AuctionTheme');?></a></li>
   
            </ul>
            
            </div>
      </li>
            <?php endif; ?>
            <!-- ###### -->
      
            <li class="widget-container widget_text"><h3 class="widget-title"><?php _e("Buyer Menu",'AuctionTheme'); ?></h3>
      <div class="my-only-widget-content">
      <?php
      
      
       global $wpdb;  
         $querystr = "
          SELECT distinct wposts.ID , bids.id bid_id
          FROM $wpdb->posts wposts, ".$wpdb->prefix."auction_bids bids 
          WHERE           
          wposts.ID=bids.pid AND
          bids.uid='$uid' AND 
          bids.winner='1' AND 
          bids.shipped='0' AND
          bids.paid='0' ";
          
      $r = $wpdb->get_results($querystr);   
      
      $rd = count($r);
      
      if($rd > 0) $outs = "<span class='notif_a'>".$rd.'</span>'; else $outs = '';
      
      ?>
            <ul id="my-account-admin-menu_buyer">
                 
                 
                <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_offers_buyer_id')); ?>"><?php _e("Submitted Offers",'AuctionTheme');?></a></li>  
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_won_items_id')); ?>"><?php _e("Won Items",'AuctionTheme');?></a></li>
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_not_won_items_id')); ?>"><?php _e("Did not Win Items",'AuctionTheme');?></a></li>
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_bid_items_id')); ?>"><?php _e("Items I bid",'AuctionTheme');?></a></li>
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_otstanding_pay_id')); ?>"><?php printf(__("Outstanding Payments %s",'AuctionTheme'), $outs);?></a></li>
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_paid_id')); ?>"><?php _e("Paid Items",'AuctionTheme');?></a></li>
                 <li><a href="<?php echo get_permalink(get_option('AuctionTheme_my_account_paid_ship_id')); ?>"><?php _e("Paid & Shipped",'AuctionTheme');?></a></li>
                 
            
            </div>
      </li>
            
            
      </ul>
    </div>
    
    
    


<?php
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_get_payments_page_url($subpage = '', $id = '')
{
  $opt = get_option('AuctionTheme_my_account_payments_page_id');
  if(empty($subpage)) $subpage = "home";
  
  $perm = AuctionTheme_using_permalinks();
  
  if($perm) return get_permalink($opt). "?pg=".$subpage.(!empty($id) ? "&id=".$id : '');
  
  return get_permalink($opt). "&pg=".$subpage.(!empty($id) ? "&id=".$id : '');
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function auctionTheme_add_history_log($tp, $reason, $amount, $uid, $uid2 = '')
{
  global $wpdb;
  
  $tm = current_time('timestamp',0); global $wpdb;
  $s = "insert into ".$wpdb->prefix."auction_payment_transactions (tp,reason,amount,uid,datemade,uid2)
  values('$tp','$reason','$amount','$uid','$tm','$uid2')";  
  $wpdb->query($s);
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function auctionTheme_get_credits($uid)
{
  $c = get_user_meta($uid,'credits',true);
  if(empty($c))
  {
    update_user_meta($uid,'credits',"0"); 
    return 0;
  }
  
  return $c;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_post_nr_of_images($pid)
{
  
    //---------------------
    // build the exclude list
    $exclude = array();
    
    $args = array(
    'order'          => 'ASC',
    'post_type'      => 'attachment',
    'post_parent'    => $pid,
    'meta_key'     => 'another_reserved1',
    'meta_value'   => '1',
    'numberposts'    => -1,
    'post_status'    => null,
    );
    $attachments = get_posts($args);
    if ($attachments) {
      foreach ($attachments as $attachment) {
      $url = $attachment->ID;
      array_push($exclude, $url);
    }
    }
    
    //-----------------
  
  
    $arr = array();
    
    $args = array(
    'order'          => 'ASC',
    'orderby'        => 'post_date',
    'post_type'      => 'attachment',
    'post_parent'    => $pid,
    'exclude'       => $exclude,
    'post_mime_type' => 'image',
    'numberposts'    => -1,
    ); $i = 0;
    
    $attachments = get_posts($args); 
    if ($attachments) {
    
      foreach ($attachments as $attachment) {
            
        $url = wp_get_attachment_url($attachment->ID);
        array_push($arr, $url);
        
    }
      return count($arr);
    }
    return 0;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_auction_primary_cat($pid)
{
  $auction_terms = wp_get_object_terms($pid, 'auction_cat');  
  if(is_array($auction_terms))
  {
    return  $auction_terms[0]->term_id;
  }
  
  return 0;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_get_images_cost_extra($pid)
{
  $AuctionTheme_charge_fees_for_images  = get_option('AuctionTheme_charge_fees_for_images');
  $auctionTheme_extra_image_charge    = get_option('auctionTheme_extra_image_charge');

    
  if($AuctionTheme_charge_fees_for_images == "yes")
  {
    $auctionTheme_nr_of_free_images = get_option('auctionTheme_nr_of_free_images');
    if(empty($auctionTheme_nr_of_free_images)) $auctionTheme_nr_of_free_images = 1; 
    
    $AuctionTheme_get_post_nr_of_images = AuctionTheme_get_post_nr_of_images($pid);
    $paid_already_images = get_post_meta($pid, 'paid_already_images', true );
    $AuctionTheme_get_post_nr_of_images = $AuctionTheme_get_post_nr_of_images - $paid_already_images;
    
    
    $nr_imgs = $AuctionTheme_get_post_nr_of_images - $auctionTheme_nr_of_free_images;
    if($nr_imgs > 0)
    {
      return $nr_imgs*  $auctionTheme_extra_image_charge;
    }
    
  }
  
  return 0;
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function get_auction_category_fields($catid, $pid = '')
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_custom_fields order by ordr asc";  
  $r = $wpdb->get_results($s);
  
  $arr1 = array(); $i = 0;
  
  foreach($r as $row)
  {
    $ims  = $row->id;
    $name   = $row->name;
    $tp   = $row->tp;
    
    if($row->cate == 'all')
    { 
      $arr1[$i]['id']   = $ims; 
      $arr1[$i]['name']   = $name; 
      $arr1[$i]['tp']   = $tp; 
      $i++; 
    
    }
    else
    {
      $se = "select * from ".$wpdb->prefix."auction_custom_relations where custid='$ims'";
      $re = $wpdb->get_results($se);
      
      if(count($re) > 0)
      foreach($re as $rowe) // = mysql_fetch_object($re))
      {
        if(count($catid) > 0)
        foreach($catid as $id_of_cat)
        {
        
          if($rowe->catid == $id_of_cat)
          {
            $flag_me = 1;
            for($k=0;$k<count($arr1);$k++)
            {
              if( $arr1[$k]['id']   == $ims ) {  $flag_me = 0; break; }           
            }
            
            if($flag_me == 1)
            {
              $arr1[$i]['id']   = $ims; 
              $arr1[$i]['name']   = $name; 
              $arr1[$i]['tp']   = $tp;
              $i++;
            }
          }
        }
      }
    }
  }

  $arr = array();
  $i = 0;
  
  for($j=0;$j<count($arr1);$j++)
  {
    $ids  = $arr1[$j]['id'];
    $tp   = $arr1[$j]['tp'];
    
    $arr[$i]['field_name']  = $arr1[$j]['name'];
    $arr[$i]['id']  = '<input type="hidden" value="'.$ids.'" name="custom_field_id[]" />';
    
    if($tp == 1) 
    {
    
    $teka   = !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
    
    $arr[$i]['value']  = '<input class="do_input" type="text" name="custom_field_value_'.$ids.'" 
    value="'.(isset($_POST['custom_field_value_'.$ids]) ? $_POST['custom_field_value_'.$ids] : $teka ).'" />';
    
    }
    
    if($tp == 5)
    {
      
      $teka   = !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
      //$teka   = $teka[0];
      $value  = isset($_POST['custom_field_value_'.$ids]) ? $_POST['custom_field_value_'.$ids] : $teka;
      
      $arr[$i]['value']  = '<textarea rows="5" cols="40" name="custom_field_value_'.$ids.'">'.$value.'</textarea>';
    
    }
    
    if($tp == 3) //radio
    {
      $arr[$i]['value']  = '';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka   = !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;
          $teka   = $teka[0];
          
          if(isset($_POST['custom_field_value_'.$ids]))
          {
            if($_POST['custom_field_value_'.$ids] == $row2->valval) $value = 'checked="checked"';
            else $value = '';
          }
          elseif(!empty($pid))
          {
            $v = get_post_meta($pid, 'custom_field_ID_'.$ids, true);
            if($v == $row2->valval) $value = 'checked="checked"';
            else $value = ''; 
          
          }       
          else $value = '';
          
          $arr[$i]['value']  .= '<input type="radio" '.$value.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'"> '.$row2->valval.'<br/>';
        }
    }
    
    
    if($tp == 4) //checkbox
    {
      $arr[$i]['value']  = '';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka     = !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;
          //$teka     = $teka[0];
          $teka_ch  = '';
          
          if(is_array($teka))
          { 
            foreach($teka as $te)
            {
              
              if(($te) == ($row2->valval)) { $teka_ch = "checked='checked'";  break; }
            } 
                
          }
          elseif($row2->valval == $teka) $teka_ch = "checked='checked'";
          else $teka_ch = '';
          
          $teka_ch  = isset($_POST['custom_field_value_'.$ids]) ? "checked='checked'" : $teka_ch;
          
          $arr[$i]['value']  .= '<input type="checkbox" '.$teka_ch.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';
        }
    }
    
    if($tp == 2) //select
    {
      $arr[$i]['value']  = '<select class="do_input" name="custom_field_value_'.$ids.'" /><option value="">'.__('Select','AuctionTheme').'</option>';
      
        $s2 = "select * from ".$wpdb->prefix."auction_custom_options where custid='$ids' order by ordr ASC ";
        $r2 = $wpdb->get_results($s2);
        
        if(count($r2) > 0)
        foreach($r2 as $row2) // = mysql_fetch_object($r2))
        {
          $teka   = !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

          if(!empty($teka))
          { 
            foreach($teka as $te)
            {
              if(($te) == ($row2->valval)) { $teka = "selected='selected'"; break; }
            } 
            
                
          }
          else $teka = '';
          
          if(isset($_POST['custom_field_value_'.$ids]) && $_POST['custom_field_value_'.$ids] == $row2->valval)
          $value = "selected='selected'" ;
          else $value = $teka;
          
          
          $arr[$i]['value']  .= '<option '.$value.' value="'.$row2->valval.'">'.$row2->valval.'</option>';
        
        }
      $arr[$i]['value']  .= '</select>';
    }
    
    $i++;
  }
  
  return $arr;
}

function get_auction_category_fields_for_relisting($catid, $pid = '', $pid2 = '')
{
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."auction_custom_fields order by ordr asc";  
  $r = $wpdb->get_results($s);
  
  $arr1 = array(); $i = 0;
  
  foreach($r as $row)
  {
    $ims  = $row->id;
    $name   = $row->name;
    $tp   = $row->tp;
    
    if($row->cate == 'all')
    { 
      $arr1[$i]['id']   = $ims; 
      $arr1[$i]['name']   = $name; 
      $arr1[$i]['tp']   = $tp; 
      $i++; 
    
    }
    else
    {
      $se = "select * from ".$wpdb->prefix."auction_custom_relations where custid='$ims'";
      $re = $wpdb->get_results($se);
      
      if(count($re) > 0)
      foreach($re as $rowe) // = mysql_fetch_object($re))
      {
        if(count($catid) > 0)
        foreach($catid as $id_of_cat)
        {
        
          if($rowe->catid == $id_of_cat)
          {
            $flag_me = 1;
            for($k=0;$k<count($arr1);$k++)
            {
              if( $arr1[$k]['id']   == $ims ) {  $flag_me = 0; break; }           
            }
            
            if($flag_me == 1)
            {
              $arr1[$i]['id']   = $ims; 
              $arr1[$i]['name']   = $name; 
              $arr1[$i]['tp']   = $tp;
              $i++;
            }
          }
        }
      }
    }
  }

  $arr = array();
  $i = 0;
  
  for($j=0;$j<count($arr1);$j++)
  {
    $ids  = $arr1[$j]['id'];
    $tp   = $arr1[$j]['tp'];
    
    
    
    $v = get_post_meta($pid, 'custom_field_ID_'.$ids);
   
    
    foreach ($v as $values)
    {
      add_post_meta($pid2, 'custom_field_ID_'.$ids, $values);
      
    }
    
     
  }
 
   
  return $arr;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/


function AuctionTheme_get_geo_coordinates($addr)

{

  //http://maps.google.com/maps/geo?output=csv&q=Bucharest&key= 

  $key = get_option('auctionTheme_maps_api_key');

  //$url = "http://maps.google.com/maps/geo?output=csv&q=".urlencode($addr)."&key=".$key;
  $addr = str_replace(" ","+",$addr);
  $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$addr."&sensor=false";

  $data = AuctionTheme_curl_get_data($url);
  $data =  json_decode($data);
  
  //echo '<pre>';
  //print_r($data->results[0]->geometry->location);
  //echo '<pre>';
  //exit;
  
  //$data = explode(",", $data);

  $data1 = array();
  $data1[3] = $data->results[0]->geometry->location->lng;
  $data1[2] = $data->results[0]->geometry->location->lat;



  return $data1;  

}

function AuctionTheme_get_geo_coordinates_old($addr)
{
  //http://maps.google.com/maps/geo?output=csv&q=Bucharest&key= 
  $key = get_option('auctionTheme_maps_api_key');
  $url = "http://maps.google.com/maps/geo?output=csv&q=".urlencode($addr)."&key=".$key;
  
  $data = AuctionTheme_curl_get_data($url);
  $data = explode(",", $data);
  
  return $data; 
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_curl_get_data($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/


  
  add_action('wp_ajax_remove_from_watchlist',     'AuctionTheme_remove_from_watchlist');
  add_action('wp_ajax_nopriv_remove_from_watchlist',  'AuctionTheme_remove_from_watchlist');
  
  add_action('wp_ajax_add_to_watchlist',        'AuctionTheme_add_to_watchlist');
  add_action('wp_ajax_nopriv_add_to_watchlist',     'AuctionTheme_add_to_watchlist');
  
  function AuctionTheme_remove_from_watchlist()
  {
    $pid = $_POST['pid'];
    
    if(is_user_logged_in()):
    
      global $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      AuctionTheme_delete_pid_in_watchlist($pid, $uid);
      
      echo "removed-".$uid."-".$pid."-";
    
    else:
    
      echo "NO_LOGGED"; 
    
    endif;  
    
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/  
  function AuctionTheme_check_if_pid_is_in_watchlist($pid, $uid)
  {
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_watchlist where pid='$pid' AND uid='$uid'";  
    $r = $wpdb->get_results($s);
    
    if(count($r) == 0) return false;    
    return true;
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
  
  function AuctionTheme_add_pid_in_watchlist($pid, $uid)
  {
    global $wpdb;
    $s = "insert into ".$wpdb->prefix."auction_watchlist (pid,uid) values('$pid','$uid')";  
    $wpdb->query($s);
    
  }
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/  
  function AuctionTheme_delete_pid_in_watchlist($pid, $uid)
  {
    global $wpdb;
    $s = "delete from ".$wpdb->prefix."auction_watchlist where pid='$pid' AND uid='$uid'";  
    $wpdb->query($s);
    
  }
  
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

  function AuctionTheme_add_to_watchlist()
  {
    $pid = $_POST['pid'];
    
    if(is_user_logged_in()):
    
      global $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      if(AuctionTheme_check_if_pid_is_in_watchlist($pid, $uid) == false)
        AuctionTheme_add_pid_in_watchlist($pid, $uid);
      
      echo "added-".$uid."-".$pid."-";
      
    else:
    
      echo "NO_LOGGED"; 
    
    endif;
  }

//--------------------------------------------------------------------

    if(isset($_GET['confirm_message_deletion']))
    {
      
      $using_perm = AuctionTheme_using_permalinks();
  
      if($using_perm) $privurl_m = get_permalink(get_option('AuctionTheme_my_account_priv_mess_page_id')). "?";
      else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('AuctionTheme_my_account_priv_mess_page_id'). "&";  
      
      $return   = $_GET['return'];
      $messid   = $_GET['id'];  
      
      global $wpdb, $current_user;
      get_currentuserinfo();
      $uid = $current_user->ID;
      
      $s = "select * from ".$wpdb->prefix."auction_pm where id='$messid' AND (user='$uid' OR initiator='$uid')";
      $r = $wpdb->get_results($s);  
      
      if(count($r) > 0)
      {
        $row = $r[0];
        
        if($row->initiator == $uid)
        {
          $s = "update ".$wpdb->prefix."auction_pm set show_to_source='0' where id='$messid'";
          $wpdb->query($s); 
          
        }
        else
        {
          $s = "update ".$wpdb->prefix."auction_pm set show_to_destination='0' where id='$messid'";
          $wpdb->query($s);           
        }
        
        if($return == "inbox") wp_redirect($privurl_m . "priv_act=inbox/");
        else if($return == "outbox") wp_redirect($privurl_m . "priv_act=sent-items/");
        else if($return == "home") wp_redirect($privurl_m . "priv_act=private-messages");
        else wp_redirect(AuctionTheme_my_account_link());
        
      }
      else wp_redirect(AuctionTheme_my_account_link());
      
    }
    
//====================== EMAILS -------------------------------------------
function AuctionTheme_replace_stuff_for_me($find, $replace, $subject)
{
  $i = 0;
  foreach($find as $item)
  {
    $replace_with = $replace[$i];
    $subject = str_replace($item, $replace_with, $subject); 
    $i++;
  }
  
  return $subject;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctiontTheme_login_url()
{
  return get_bloginfo('siteurl'). '/wp-login.php' ; 
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_posted_item_not_approved($pid)
{
  $enable   = get_option('AuctionTheme_new_item_email_not_approved_enable');
  $subject  = get_option('AuctionTheme_new_item_email_not_approved_subject');
  $message  = get_option('AuctionTheme_new_item_email_not_approved_message'); 
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_posted_item_not_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_offer_received($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_offer_received_email_enable');
  $subject  = get_option('AuctionTheme_offer_received_email_subject');
  $message  = get_option('AuctionTheme_offer_received_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $buyer      = get_userdata($offer_uid);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##buyer_username##', '##seller_username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($buyer->user_login, $user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_posted_item_not_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;  
  
}


function AuctionTheme_send_email_counter_offer_received($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_counter_offer_received_email_enable');
  $subject  = get_option('AuctionTheme_counter_offer_received_email_subject');
  $message  = get_option('AuctionTheme_counter_offer_received_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $buyer      = get_userdata($offer_uid);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##buyer_username##', '##seller_username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($buyer->user_login, $user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_counter_offer_received';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;  
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_offer_accepted($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_offer_accepted_email_enable');
  $subject  = get_option('AuctionTheme_offer_accepted_email_subject');
  $message  = get_option('AuctionTheme_offer_accepted_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $buyer      = get_userdata($offer_uid);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($buyer->user_login, $buyer->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_posted_item_not_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_offer_rejected($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_offer_rejected_email_enable');
  $subject  = get_option('AuctionTheme_offer_rejected_email_subject');
  $message  = get_option('AuctionTheme_offer_rejected_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $buyer      = get_userdata($offer_uid);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($buyer->user_login, $buyer->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_posted_item_not_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;  
  
}

function AuctionTheme_send_email_counter_offer_rejected($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_counter_offer_rejected_email_enable');
  $subject  = get_option('AuctionTheme_counter_offer_rejected_email_subject');
  $message  = get_option('AuctionTheme_counter_offer_rejected_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $buyer      = get_userdata($offer_uid);
    $seller       = get_userdata($post->post_author);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($seller->user_login, $seller->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_counter_offer_rejected';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($seller->user_email, $subject, $message);
  
  endif;  
  
}


function AuctionTheme_send_email_counter_offer_accepted($pid, $price, $offer_uid)
{
  $enable   = get_option('AuctionTheme_counter_offer_accepted_email_enable');
  $subject  = get_option('AuctionTheme_counter_offer_accepted_email_subject');
  $message  = get_option('AuctionTheme_counter_offer_accepted_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $buyer      = get_userdata($offer_uid);
    $seller       = get_userdata($post->post_author);
    
    $site_login_url = AuctiontTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $price = auctiontheme_get_show_price($price);

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##offer_price##');
      $replace  = array($seller->user_login, $seller->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $price);
    
    $tag    = 'AuctionTheme_send_email_counter_offer_rejected';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($seller->user_email, $subject, $message);
  
  endif;  
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_posted_item_not_approved_admin($pid)
{
  $enable   = get_option('AuctionTheme_new_item_email_not_approve_admin_enable');
  $subject  = get_option('AuctionTheme_new_item_email_not_approve_admin_subject');
  $message  = get_option('AuctionTheme_new_item_email_not_approve_admin_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_posted_item_not_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------
    
    $email = get_bloginfo('admin_email');
    AuctionTheme_send_email($email, $subject, $message);
  
  endif;  
  
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_posted_item_approved($pid)
{
  $enable   = get_option('AuctionTheme_new_item_email_approved_enable');
  $subject  = get_option('AuctionTheme_new_item_email_approved_subject');
  $message  = get_option('AuctionTheme_new_item_email_approved_message'); 
  
  if($enable != "no"):
  
    $post_au      = get_post($pid);
    $user       = get_userdata($post_au->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $post     = get_post($pid);
    $item_name  = $post_au->post_title;
    $item_link  = get_permalink($pid);

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $item_name, $item_link);
    
    $tag    = 'AuctionTheme_send_email_posted_item_approved';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------
    
    $email = $user->user_email;
    AuctionTheme_send_email($user->user_email, $subject, $message);
    
  endif;    
  
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_posted_item_approved_admin($pid)
{
  $enable   = get_option('AuctionTheme_new_item_email_approve_admin_enable');
  $subject  = get_option('AuctionTheme_new_item_email_approve_admin_subject');
  $message  = get_option('AuctionTheme_new_item_email_approve_admin_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    

    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_posted_item_approved_admin';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------
    
    $email = get_bloginfo('admin_email');
    AuctionTheme_send_email($email, $subject, $message);
  
  endif;
}   

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_bid_item_owner($pid, $uid, $bid)
{
  $enable   = get_option('AuctionTheme_bid_item_owner_email_enable');
  $subject  = get_option('AuctionTheme_bid_item_owner_email_subject');
  $message  = get_option('AuctionTheme_bid_item_owner_email_message');  
  
  
  
  if($enable != "no"):
    
    $bidder     = get_userdata($uid);
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $bid_val    = AuctionTheme_get_show_price($bid);
    $bidder_username = $bidder->user_login;
    $author     = get_userdata($post->post_author);
    
    
    $find     = array('##username##', '##bid_value##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##', '##bidder_username##');
      $replace  = array($user->user_login, $bid_val, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $bidder_username);
    
    $tag    = 'AuctionTheme_send_email_when_bid_item_owner';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($author->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_no_winner_owner($pid)
{
  $enable   = get_option('AuctionTheme_no_winner_owner_email_enable');
  $subject  = get_option('AuctionTheme_no_winner_owner_email_subject');
  $message  = get_option('AuctionTheme_no_winner_owner_email_message'); 
  
  
  
  if($enable != "no"):
    
    $bidder     = get_userdata($uid);
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
 
 
    $author     = get_userdata($post->post_author);
    
    
    $find     = array('##username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##' );
      $replace  = array($user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_bid_item_owner';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_bid_item_outbid($pid, $uid, $bid)
{
  $enable   = get_option('AuctionTheme_bid_item_outbid_email_enable');
  $subject  = get_option('AuctionTheme_bid_item_outbid_email_subject');
  $message  = get_option('AuctionTheme_bid_item_outbid_email_message'); 
  
  
  
  if($enable != "no"):
    
    $bidder     = get_userdata($uid);
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $bid_val    = AuctionTheme_get_show_price($bid);
    $bidder_username = $bidder->user_login;
    $author     = get_userdata($post->post_author);
    
    
    $find     = array('##username##', '##bid_value##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##', '##bidder_username##');
      $replace  = array($bidder->user_login, $bid_val, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $bidder_username);
    
    $tag    = 'AuctionTheme_send_email_when_bid_item_outbid';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($bidder->user_email, $subject, $message);
  
  endif;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_item_is_paid_buyer($pid, $bid_id) //received by buyer
{
  $enable   = get_option('AuctionTheme_paid_auction_buyer_email_enable');
  $subject  = get_option('AuctionTheme_paid_auction_buyer_email_subject');
  $message  = get_option('AuctionTheme_paid_auction_buyer_email_message');  
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer        = get_userdata($row->uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));

    
    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_item_is_paid_buyer';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_item_is_paid_seller($pid, $bid_id) //received by seller
{
  $enable   = get_option('AuctionTheme_paid_auction_seller_email_enable');
  $subject  = get_option('AuctionTheme_paid_auction_seller_email_subject');
  $message  = get_option('AuctionTheme_paid_auction_seller_email_message'); 
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer        = get_userdata($row->uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_item_is_paid_seller';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($seller->user_email, $subject, $message);
  
  endif;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_item_is_shipped_seller($pid, $bid_id) //received by buyer
{
  $enable   = get_option('AuctionTheme_ship_auction_seller_email_enable');
  $subject  = get_option('AuctionTheme_ship_auction_seller_email_subject');
  $message  = get_option('AuctionTheme_ship_auction_seller_email_message'); 
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer        = get_userdata($row->uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_item_is_shipped_seller';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($seller->user_email, $subject, $message);
  
  endif;
}

function AuctionTheme_send_email_when_item_is_shipped_buyer($pid, $bid_id) //received by buyer
{
  $enable   = get_option('AuctionTheme_ship_auction_buyer_email_enable');
  $subject  = get_option('AuctionTheme_ship_auction_buyer_email_subject');
  $message  = get_option('AuctionTheme_ship_auction_buyer_email_message');  
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer        = get_userdata($row->uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));

    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_item_is_shipped_buyer';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;
}




function AuctionTheme_send_email_when_review_needs_to_be_awarded($pid, $rated_user_uid, $awarding_user_uid) //received by buyer
{
  $enable   = get_option('AuctionTheme_review_to_award_email_enable');
  $subject  = get_option('AuctionTheme_review_to_award_email_subject');
  $message  = get_option('AuctionTheme_review_to_award_email_message'); 
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $rated_user   = get_userdata($rated_user_uid);
    $awarding_user  = get_userdata($awarding_user_uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));

    
    $find     = array('##rated_user##', '##awarding_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($rated_user->user_login, $awarding_user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_review_needs_to_be_awarded';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($awarding_user->user_email, $subject, $message);
  
  endif;
}

function AuctionTheme_send_email_when_review_has_been_awarded($pid, $rated_user_uid, $awarding_user_uid) //received by buyer
{
  $enable   = get_option('AuctionTheme_review_received_email_enable');
  $subject  = get_option('AuctionTheme_review_received_email_subject');
  $message  = get_option('AuctionTheme_review_received_email_message'); 
  
  
  
  if($enable != "no"):
    
    global $wpdb;
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s); $row = $r[0];
    
    $post       = get_post($pid);
    $rated_user   = get_userdata($rated_user_uid);
    $awarding_user  = get_userdata($awarding_user_uid);
    
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));

    
    $find     = array('##rated_user##', '##awarding_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');
      $replace  = array($rated_user->user_login, $awarding_user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));
    
    $tag    = 'AuctionTheme_send_email_when_review_has_been_awarded';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($rated_user->user_email, $subject, $message);
  
  endif;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_when_bid_item_bidder($pid, $uid, $bid)
{
  $enable   = get_option('AuctionTheme_bid_item_bidder_email_enable');
  $subject  = get_option('AuctionTheme_bid_item_bidder_email_subject');
  $message  = get_option('AuctionTheme_bid_item_bidder_email_message'); 
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $bid_val    = AuctionTheme_get_show_price($bid);

    $find     = array('##username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##', '##bid_value##');
      $replace  = array($user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $bid_val );
    
    
    //---------------------------------------------
    
    $tag    = 'AuctionTheme_send_email_when_bid_item_bidder';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/

function AuctionTheme_send_email_on_no_win_owner($pid)
{
  $enable   = get_option('AuctionTheme_on_no_win_email_enable');
  $subject  = get_option('AuctionTheme_on_no_win_email_subject');
  $message  = get_option('AuctionTheme_on_no_win_email_message'); 
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($winner_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $winner_bid   = '';
    
    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##','##winner_bid_value##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $winner_bid);
    
    $tag    = 'AuctionTheme_send_email_on_win_to_bidder';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //--------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/




//-------------------------------------

function AuctionTheme_send_email_on_buy_now_auction_buyer($pid, $buyer_uid, $bid_id = '') //receives buyer
{
  $enable   = get_option('AuctionTheme_buy_now_auction_buyer_email_enable');
  $subject  = get_option('AuctionTheme_buy_now_auction_buyer_email_subject');
  $message  = get_option('AuctionTheme_buy_now_auction_buyer_email_message'); 
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer      = get_userdata($buyer_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $auctionTheme_get_winner_bid = auctionTheme_get_winner_bid($bid_id);
    $winner_bid   = auctiontheme_get_show_price($auctionTheme_get_winner_bid->bid);
    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##','##winner_bid_value##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $winner_bid);
    
    $tag    = 'AuctionTheme_send_email_on_buy_now_auction_buyer';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //--------------------------------------

    AuctionTheme_send_email($buyer->user_email, $subject, $message);
  
  endif;
}

function AuctionTheme_send_email_on_buy_now_auction_seller($pid, $buyer_uid, $bid_id = '') //receives seller
{
  $enable   = get_option('AuctionTheme_buy_now_auction_seller_email_enable');
  $subject  = get_option('AuctionTheme_buy_now_auction_seller_email_subject');
  $message  = get_option('AuctionTheme_buy_now_auction_seller_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $seller     = get_userdata($post->post_author);
    $buyer      = get_userdata($buyer_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $auctionTheme_get_winner_bid = auctionTheme_get_winner_bid($bid_id);
    $winner_bid   = auctiontheme_get_show_price($auctionTheme_get_winner_bid->bid);
    
    $find     = array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##','##winner_bid_value##');
      $replace  = array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $winner_bid);
    
    $tag    = 'AuctionTheme_send_email_on_buy_now_auction_seller';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //--------------------------------------

    AuctionTheme_send_email($seller->user_email, $subject, $message);
  
  endif;
}

function AuctionTheme_send_email_on_win_to_bidder($pid, $winner_uid, $bid_id = '')
{
  $enable   = get_option('AuctionTheme_won_item_winner_email_enable');
  $subject  = get_option('AuctionTheme_won_item_winner_email_subject');
  $message  = get_option('AuctionTheme_won_item_winner_email_message'); 
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($winner_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $auctionTheme_get_winner_bid = auctionTheme_get_winner_bid($bid_id);
    $winner_bid   = auctiontheme_get_show_price($auctionTheme_get_winner_bid->bid);
    
    $find     = array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##','##winner_bid_value##');
      $replace  = array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), $winner_bid);
    
    $tag    = 'AuctionTheme_send_email_on_win_to_bidder';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //--------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_on_win_to_owner($pid, $winner_uid, $bid_id)
{
  $enable   = get_option('AuctionTheme_won_item_owner_email_enable');
  $subject  = get_option('AuctionTheme_won_item_owner_email_subject');
  $message  = get_option('AuctionTheme_won_item_owner_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($post->post_author);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $winner_bid_username = '';
    $winner_bid_value = '';
    
    global $wpdb;
    
    $s = "select * from ".$wpdb->prefix."auction_bids where id='$bid_id'";
    $r = $wpdb->get_results($s);
    $row = $r[0];         
    
    
    $winner_bid_username = get_userdata($winner_uid);
    $winner_bid_username = $winner_bid_username->user_login;
    $winner_bid_value = auctionTheme_get_show_price($row->bid);
    
    //--------------------------------------------------------------------------
    
    $find     = array('##username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##','##winner_bid_value##','##winner_bid_username##');
      $replace  = array($user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid),
    $winner_bid_value,$winner_bid_username );
    
    $tag    = 'AuctionTheme_send_email_on_win_to_owner';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}
/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_on_win_to_loser($pid, $loser_uid, $winner_uid, $winner_bid_value, $loser_bid_val)
{
  $enable   = get_option('AuctionTheme_won_item_loser_email_enable');
  $subject  = get_option('AuctionTheme_won_item_loser_email_subject');
  $message  = get_option('AuctionTheme_won_item_loser_email_message');  
  
  if($enable != "no"):
  
    $post       = get_post($pid);
    $user       = get_userdata($loser_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    
    $winner_usr = get_userdata($winner_uid);
    
    $user_bid_value     = auctionTheme_get_show_price($loser_bid_val);
    $winner_bid_username  = $winner_usr->user_login;
    $winner_bid_value     = auctionTheme_get_show_price($winner_bid_value);
    
    $find     = array('##username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##',
    '##user_bid_value##','##winner_bid_username##','##winner_bid_value##');
      $replace  = array($user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid), 
    $user_bid_value, $winner_bid_username, $winner_bid_value);
    
    $tag    = 'AuctionTheme_send_email_on_win_to_loser';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}

/*****************************************************************************
*
* Function - AuctionTheme -
*
*****************************************************************************/
function AuctionTheme_send_email_on_priv_mess_received($sender_uid, $receiver_uid)
{
  $enable   = get_option('AuctionTheme_priv_mess_received_email_enable');
  $subject  = get_option('AuctionTheme_priv_mess_received_email_subject');
  $message  = get_option('AuctionTheme_priv_mess_received_email_message');  
  
  if($enable != "no"):
  
    $user       = get_userdata($receiver_uid);
    $site_login_url = AuctionTheme_login_url();
    $site_name    = get_bloginfo('name');
    $account_url  = get_permalink(get_option('AuctionTheme_my_account_page_id'));
    $sndr     = get_userdata($sender_uid);

    $find     = array('##sender_username##', '##receiver_username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##');
      $replace  = array($sndr->user_login, $user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url);
    
    $tag    = 'AuctionTheme_send_email_on_priv_mess_received';
    $find     = apply_filters( $tag . '_find',  $find );
    $replace  = apply_filters( $tag . '_replace', $replace );
    
    $message  = AuctionTheme_replace_stuff_for_me($find, $replace, $message);
    $subject  = AuctionTheme_replace_stuff_for_me($find, $replace, $subject);
    
    //---------------------------------------------

    AuctionTheme_send_email($user->user_email, $subject, $message);
  
  endif;
}

function auctiontheme_show_status_offer($approved, $rejected)
{
  if($approved == 0 and $rejected == 1) return __('Rejected','AuctionTheme'); 
  if($approved == 1 and $rejected == 0) return __('Accepted','AuctionTheme'); 
}

// SEND EMAIL ONCE POST IS PUBLISHED

function notify_new_post($post_id) {
    if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
        $post = get_post($post_id);
        $author = get_userdata($post->post_author);
        $author_email = $author->user_email;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email_subject = "Your property has been added to Partners Property Auctions";

        ob_start(); ?>

        <html>
            <body>
                <p>
                    Hi <?php echo $author->display_name ?>,
                </p>
                <p>
                    Your property <a href="<?php echo get_permalink($post->ID) ?>"><?php the_title_attribute() ?></a> has been published.
                </p>
                <p>
                Kind regards,<br />
                Richard Harper
                </p>
            </body>
        </html>

        <?php

        $message = ob_get_contents();

        ob_end_clean();

        wp_mail( $author_email, $email_subject, $message, $headers );
    }		
	
	if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {
        $post = get_post($post_id);
        $author = get_userdata($post->post_author);
		$author_email = "richard@partnerspropertyauctions.co.uk";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email_subject = "Send Invoice to ";
        $email_subject .= $author->display_name;

        ob_start(); ?>

        <html>
            <body>
                <p>
                    The property <a href="<?php echo get_permalink($post->ID) ?>"><?php the_title_attribute() ?></a> has been published.<br>
                    You need to send an invoice to <?php echo $author->display_name ?>.
                </p>
            </body>
        </html>

        <?php

        $message = ob_get_contents();

        ob_end_clean();

        wp_mail($author_email, $email_subject, $message, $headers );
    }
}

add_action( 'publish_auction', 'notify_new_post' ); ?>
