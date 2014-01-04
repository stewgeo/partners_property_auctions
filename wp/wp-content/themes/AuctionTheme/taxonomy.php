<?php
/***************************************************************************
*
*	AuctionTheme - copyright (c) - sitemile.com
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/auctionTheme
*	since v4.4
*
***************************************************************************/

global $query_string;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);

//meta_key=keyname&orderby=meta_value&order=ASC
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
		
query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	
	$AuctionTheme_adv_code_cat_page_above_content = stripslashes(get_option('AuctionTheme_adv_code_cat_page_above_content'));
		if(!empty($AuctionTheme_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $AuctionTheme_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	

<div id="content">

<div class="my_box3">
      
            	<div class="box_title"><?php
						if(empty($term_title)) echo __("All Properties",'AuctionTheme');
						else { echo sprintf( __("Properties for Sale in %s",'AuctionTheme'), $term_title);
                        
						}
					?> 
            		<?php
					
						$view = auctiontheme_get_view_grd();
						
						if($view == "normal")
						{
							$list_view = __('List View','AuctionTheme');
							$grid_view = '<a href="'.get_bloginfo('siteurl').'/?switch_to_view=grid&ret_u='.urlencode(auctionTheme_curPageURL()).'">'.__('Grid View','AuctionTheme') . '</a>';	
						}
						else
						{
							$list_view = '<a href="'.get_bloginfo('siteurl').'/?switch_to_view=list&ret_u='.urlencode(auctionTheme_curPageURL()).'">'.__('List View','AuctionTheme') . '</a>';
							$grid_view = __('Grid View','AuctionTheme');	
						}
					
					
					?>
            		<p class="pk_lst_grd"><?php echo $list_view; ?> | <?php echo $grid_view; ?></p>
            		
            	</div> 
                
                              
                <?php $description = term_description(); 
				
				if(!empty($description))
				echo '<div class="box_content">  '.$description . "</div>"; ?>
                
                
				<div class="box_content"> 

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php 

	
	
	

if($view == "normal")
AuctionTheme_get_post();
else AuctionTheme_get_post_grid() ?>

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No items posted.',"AuctionTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>


</div></div></div> 


<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>


<?php

	get_footer();

?>