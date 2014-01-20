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

  function AuctionTheme_adv_search_where_thing($where)
  {
      global $local_long, $local_lat, $radius ; 
      global $wpdb; 
          
      $where .= " AND 
      
      ((ACOS(SIN($local_lat * PI() / 180) * SIN(`auction_lat` * PI() / 180) + COS($local_lat * PI() / 180) * COS(`auction_lat` * PI() / 180) * 
      COS(($local_long - `auction_long`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)
      
      < '$radius'";
  
    return $where;
  }
  
  
  function AuctionTheme_get_lat_stuff_join($wp_join)
  {

      global $wpdb;
      $wp_join .= " LEFT JOIN (
          SELECT post_id, meta_value as auction_lat
          FROM $wpdb->postmeta
          WHERE meta_key =  'auction_lat' ) AS DD1
          ON $wpdb->posts.ID = DD1.post_id ";
  
    return ($wp_join);
  }
  
  
  function AuctionTheme_get_long_stuff_join($wp_join)
  {
      global $wpdb;
      $wp_join .= " LEFT JOIN (
          SELECT post_id, meta_value as auction_long
          FROM $wpdb->postmeta
          WHERE meta_key =  'auction_long' ) AS DD2
          ON $wpdb->posts.ID = DD2.post_id ";
  
    return ($wp_join);
  }
  
  //------------
  
  function auctionTheme_posts_where( $where ) {

      global $wpdb, $term;  
      $term1 = explode(" ",$term);
      $xl = '';
      
      foreach($term1 as $tt)
      {
        $xl .= " AND ({$wpdb->posts}.post_title LIKE '%$tt%' OR {$wpdb->posts}.post_content LIKE '%$tt%')";
        
      }
          
      $where .= " AND (({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%') $xl )";
  
    return $where;
  }
  
function atheme_actAct($s)
{
  if($_GET['meta_key'] == $s) echo 'class="active-search-link"';
  if($s == 'title' && $_GET['orderby'] == $s) echo 'class="active-search-link"';
}


function AuctionTheme_adv_search_area_function()
{
  global $current_user;
  get_currentuserinfo();
  $uid = $current_user->ID;

  
  
  if(isset($_GET['pj'])) $pj = $_GET['pj'];
  else $pj = 1;
  
  $my_page = $pj;
  
  if(isset($_GET['order'])) $order = $_GET['order'];
  else $order = "DESC";
  
  if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
  else $orderby = "meta_value";
  
  if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
  else $meta_key = "featured";


  if(isset($_GET['price_max']) || isset($_GET['price_max'])) {
    
    if(!empty($_GET['price_max'])) $max =  $_GET['price_max']; else $max = 99999999;
    if(!empty($_GET['price_min'])) $min =  $_GET['price_min']; else $min = 0;
    
    $price_q = array(
      'key' => 'current_bid',
      'value' => array($min, $max),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
    ); 
    
  
    
  }
  
  $closed = array(
      'key' => 'closed',
      'value' => "0",
      //'type' => 'numeric',
      'compare' => '='
    );
    
  
  if(isset($_GET['featured']))
  {
    if($_GET['featured'] == "1"):
      $featured = array(
        'key' => 'featured',
        'value' => "1",
        //'type' => 'numeric',
        'compare' => '='
      );        
    endif;
  }
    
  

  if(!empty($_GET['auction_location_cat'])) $loc = array(
      'taxonomy' => 'auction_location',
      'field' => 'slug',
      'terms' => $_GET['auction_location_cat']
    
  );
  else $loc = '';
  
  
  
  
  if(!empty($_GET['auction_cat_cat'])) $adsads = array(
      'taxonomy' => 'auction_cat',
      'field' => 'slug',
      'terms' => $_GET['auction_cat_cat']
    
  );
  else $adsads = '';

  //------------
  
  if(!empty($_GET['zip_code']))
  {
    global $local_long, $local_lat, $radius ; 
    
    $country = ''; //"UK";  
    $zip = trim($_GET['zip_code']);
    $radius = trim($_GET['radius']); 
    
    if(empty($radius)) $radius = 10;
    
    global $mak_address;
    
    $mak_address = $country.",".$zip;
    
    $data   = AuctionTheme_get_geo_coordinates($country.",".$zip);
    $local_long   = $data[3];
    $local_lat    = $data[2]; 
    
    add_filter('posts_join', 'AuctionTheme_get_lat_stuff_join' );
    add_filter('posts_join', 'AuctionTheme_get_long_stuff_join' );
    add_filter('posts_where', 'AuctionTheme_adv_search_where_thing');

    
  }
  
    global $term;
  $term = (strip_tags($_GET['term']));
  
  if(!empty($_GET['term']))
  {
    add_filter( 'posts_where' , 'auctionTheme_posts_where' );
    
  }
  
  //------------
  

  

  if(!empty($_GET['meta_key']) && $_GET['meta_key'] == 'buy_now')
  {
    $buy_now_custom_meta = array(
      'key' => 'buy_now',
      'value' => array(1, 999999999999),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
    );
      
  }
  
  if(!empty($_GET['meta_key']) && $_GET['meta_key'] == 'start_price')
  {
    $start_price_custom_meta = array(
      'key' => 'start_price',
      'value' => array(1, 999999999999),
      'type' => 'numeric',
      'compare' => 'BETWEEN'
    );
      
  }
  

  
      $meta_querya = array();

      $arr = $_GET['custom_field_id'];
      
      for($i=0;$i<count($arr);$i++)
      {
        $ids  = $arr[$i];
        $value  = $_GET['custom_field_value_'.$ids];
        
        if(!empty($value)) {
        
        
        if(is_array($value))
        {
          $val = array();
          
          for($j=0;$j<count($value);$j++)           
            $val[] = $value[$j];
          
        }
        elseif(!empty($value)) {
        
          $val = $value;
        
        }
        
        $stuff = array(
          'key' => "custom_field_ID_".$ids,
          'value' => $val,
          'compare' => 'LIKE'
        );
        
        array_push($meta_querya,$stuff);
        
        }
      }
  

    array_push($meta_querya,$price_q);
    array_push($meta_querya,$buy_now_custom_meta);
    array_push($meta_querya,$closed);
    array_push($meta_querya,$featured);
    array_push($meta_querya,$start_price_custom_meta);


//orderby price - meta_value_num

  $nrpostsPage = 10;
  $AuctionTheme_listings_per_page_adv_search = get_option('AuctionTheme_listings_per_page_adv_search');
  if(!empty($AuctionTheme_listings_per_page_adv_search)) $nrpostsPage = $AuctionTheme_listings_per_page_adv_search;

  $idas = $_GET['auction_ID'];

  $args = array( 'p' => $idas, 'posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'auction', 'order' => $order , 'meta_query' => $meta_querya ,'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($loc, $adsads));
  $the_query = new WP_Query( $args );


  $nrposts = $the_query->found_posts;
  $totalPages = ceil($nrposts / $nrpostsPage);
  $pagess = $totalPages;
  
  

  ?>
  <div class="row">
    <div class="col-md-12">
      <ul class="xoxo">
        <li id="text-6" class="widget-container widget_text">
          <h3 class="widget-title">
            <?php _e('Search Options','AuctionTheme'); ?>
          </h3>
          <div class="textwidget" style="overflow:hidden">
            <div style="float:left;width:100%">
              <form method="get" action="<?php echo AuctionTheme_advanced_search_link(); ?>" role="form" class="form">
                <?php
                                                            
                if(AuctionTheme_using_permalinks() == false)
                echo '<input type="hidden" value="'.get_option('AuctionTheme_adv_search_id').'" name="page_id" />';
                
                ?>
                <div class="row">
                  <div class="col-md-3">
                    <label for="term">Keyword:</label>
                    <input class="do_input_afs form-control" size="10" value="<?php echo strip_tags($_GET['term']); ?>" name="term" />
                    <label for="price_min">Min Price:</label>
                    <input class="do_input_afs form-control" size="10" value="<?php echo strip_tags($_GET['price_min']); ?>" name="price_min" />
                    <label for="price_max">Max Price:</label>
                    <input class="do_input_afs form-control" size="10" value="<?php echo strip_tags($_GET['price_max']); ?>" name="price_max" />
                  </div>
                  <div class="col-md-3">
                    <label for="zip_code">Postcode:</label>
                    <input class="do_input_afs form-control" size="10" value="<?php echo strip_tags($_GET['zip_code']); ?>" name="zip_code" />
                    <label for="radius">Search Radius (miles):</label>
                    <input class="do_input_afs form-control" size="10" value="<?php echo strip_tags($_GET['radius']); ?>" name="radius" />
                  </div>
                  <div class="col-md-3">
                    <?php
                      
                      $get_catID = AuctionTheme_get_CATID($_GET['auction_cat_cat']);
                      
                      if(empty($get_catID)) $get_catID = 0;
                      
                      $get_catID = array($get_catID);
                      $arr = AuctionTheme_get_auction_category_fields_without_vals($get_catID, 'no');
                      
                      for($i=0;$i<count($arr);$i++)
                      {
                              
                                    
                                              echo '<label>'.$arr[$i]['field_name'].$arr[$i]['id'].':</label>';
                                              echo ''.$arr[$i]['value'].'<br>';
      
                              
                              
                      }        
                      
                      
                      ?>
                  </div>
                  <div class="col-md-3">              
                    <br>
                    <input type="submit" value="<?php _e("Refine Search","AuctionTheme"); ?>" name="ref-search" class="pull-right btn-success btn" />
                    <br>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </li>
        <?php dynamic_sidebar( 'other-page-area'); ?>
      </ul>
    </div>
  </div>
    
  <div class="row">

    <div class="col-md-12">
            
      <div class="box_title">
        <?php _e("Search Results","AuctionTheme"); ?>
      </div>
      <div class="box_content">            
        <?php      
        // The Loop
        $my_arr = array(); $i = 0;
        
        if($the_query->have_posts()):
        while ( $the_query->have_posts() ) : $the_query->the_post();
          
          auctionTheme_get_post($post, $i);
          
          $lat = get_post_meta(get_the_ID(), 'auction_lat', true);
          $lon = get_post_meta(get_the_ID(), 'auction_long', true);
          
          if(empty($lat)) $lat = 0;
          if(empty($lon)) $lon = 0;
          
          
          $my_arr[$i]['lat'] = $lat;
          $my_arr[$i]['long'] = $lon;
          $my_arr[$i]['ttl'] = get_the_title();
          $my_arr[$i]['lnk'] = get_permalink(get_the_ID());
          $i++;
        endwhile;
        //********************** pagination ***********************************
        ?>
    </div>    
     <div class="nav">
                     <?php
            
    $batch = 10; //ceil($page / $nrpostsPage );
    $end = $batch * $nrpostsPage;
    $pages_curent = $my_page;

    if ($end > $pagess) {
      $end = $pagess;
    }
    $start = $end - $nrpostsPage + 1;
    
    if($start < 1) $start = 1;
    
    $links = '';
  
    
    $raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
    
    $start    = $raport * $batch + 1; 
    $end    = $start + $batch - 1;
    $end_me   = $end + 1;
    $start_me   = $start - 1;
    
    if($end > $totalPages) $end = $totalPages;
    if($end_me > $totalPages) $end_me = $totalPages;
    
    if($start_me <= 0) $start_me = 1;
    
    $previous_pg = $page - 1;
    if($previous_pg <= 0) $previous_pg = 1;
    
    $next_pg = $pages_curent + 1;
    if($next_pg > $totalPages) $next_pg = 1;
    
    
    
    //PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
    
    if($my_page > 1)
    echo '<a href="'.AuctionTheme_get_adv_search_pagination_link($previous_pg).'"><< '.__('Previous','AuctionTheme').'</a>';
    echo '<a href="'.AuctionTheme_get_adv_search_pagination_link($start_me).'"><<</a>';   
    
    //------------------------
    //echo $start." ".$end;
    for($i = $start; $i <= $end; $i ++) {
      if ($i == $pages_curent) {
        echo '<a class="activee" href="#">'.$i.'</a>';
      } else {
  
        echo '<a href="'.AuctionTheme_get_adv_search_pagination_link($i).'">'.$i.'</a>';
        
      }
    }
    
    //----------------------
    
    if($totalPages > $my_page)
    echo '<a href="'.AuctionTheme_get_adv_search_pagination_link($end_me).'">>></a>';
    echo '<a href="'.AuctionTheme_get_adv_search_pagination_link($next_pg).'">'.__('Next','AuctionTheme').' >></a>';            
        
           ?> 
                     </div> <?php
    
    
    
    //*********************************************************************
    
    else:
    
    _e('There are no auctions.','AuctionTheme');
    
    endif;

?>
    
                    
             
                
                </div>
                </div>
               
    
    <?php
  
  $AuctionTheme_enable_locations = get_option('AuctionTheme_enable_locations');
  if($AuctionTheme_enable_locations != "no"):
  
  ?>
    
                <div class="clear10"></div>
    
    
    
      <div class="my_box3">
           
            
              <div class="box_title"><?php _e("Map Results","AuctionTheme"); ?></div>
              <div class="box_content"> 
                
                <div id="map" style="width: 100%; height: 300px;border:2px solid #ccc;float:left"></div>
                
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
            
         
              
                </div>
                </div>
                
    <?php endif; ?>
    
    <script>
<?php global $local_long, $local_lat, $radius ;  ?>
 var myLatlng = new google.maps.LatLng(1,1);
  var myOptions = {
    zoom: 11,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map"), myOptions);
  var bounds = new google.maps.LatLngBounds();
  
    
    
    <?php
  
  foreach($my_arr as $item):
  
  ?>

  var Marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php echo $item['lat']; ?>,<?php echo $item['long']; ?>),
      map: map,
      title:"<?php echo $item['ttl']; ?>"
  });
  
  google.maps.event.addListener(Marker, 'click', function() {
    window.location = '<?php echo $item['lnk']; ?>';
  });
  
  var ll = new google.maps.LatLng(<?php echo $item['lat']; ?>, 
        <?php echo $item['long']; ?>);
    bounds.extend(ll);

  
<?php endforeach; ?>
    
    
map.fitBounds(bounds);
</script>
    
    <!-- ############################################# -->    
    
    <?php
  
  
  
}

?>