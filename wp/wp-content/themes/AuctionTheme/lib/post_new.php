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

function AuctionTheme_post_new_area_function()
{
	
	$new_auction_step =  $_GET['step'];
	if(empty($new_auction_step)) $new_auction_step = 1;
	
	$pid = $_GET['auction_id'];
	global $error, $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	$uploaders = auctiontheme_get_uploaders_tp();
		
?>	

	<div class="my_box3" style="margin-top:5px;">            
    <div class="box_title"><?php echo __("Post new Auction", 'AuctionTheme'); ?></div>
    <div class="box_content">
    
    
    
    	<div class="special_breadcrumb"><div class="padd10">
    		
            <?php
			
				if($new_auction_step >= 1):			
				echo '<span class="cate_tax-bold">'.__('Write Auction','AuctionTheme').'</span> > ';					
				endif;// endif step 3
				
				if($new_auction_step >= 2):			
					echo '<span class="cate_tax-bold">'.__('Add Photos','AuctionTheme').'</span> > ';					
				endif;// endif step 4
				
				if($new_auction_step >= 3):			
					echo '<span class="cate_tax-bold">'.__('Review & Publish','AuctionTheme').'</span> ';					
				endif;// endif step 4
			?>
            
            </div></div>
            
            <?php
				
				echo '<div id="steps">';
		
					echo '<ul>';
					
					if($general_reverse == "no" && $individual_reverse == "yes"):
						echo '<li '.($new_auction_step == '0' ? "class='active_step' " : "").'>'.__("Auction Type", 'AuctionTheme').'</li>';
					endif;

						echo '<li '.($new_auction_step == '1' ? "class='active_step' " : "").'>'.__("Write Auction", 'AuctionTheme').'</li>';
						echo '<li '.($new_auction_step == '2' ? "class='active_step' " : "").'>'.__("Add Photos", 'AuctionTheme').'</li>';
						echo '<li '.($new_auction_step == '3' ? "class='active_step' " : "").'>'.__("Review & Publish", 'AuctionTheme').'</li>';
					echo '</ul>';
					
				echo '</div>';

				
				
			?>
    
    	
    

    
<!-- ####################################### Step 1 ######################################### -->
<?php

if($new_auction_step == "1")
{
	//-----------------
	$post 		= get_post($pid);
	$location 	= wp_get_object_terms($pid, 'auction_location');
	$cat 		= wp_get_object_terms($pid, 'auction_cat');
 
	
	if(is_array($error))
	if($auctionOK == 0)
	{
		echo '<div class="errrs">';
		
			foreach($error as $e)		
			echo '<div class="newad_error">'.$e. '</div>';	
	
		echo '</div>';
		
	}
	
	do_action('AuctionTheme_step1_before');
	
	?>
    <script type="text/javascript">
	
		function check_quant()
		{
			jQuery('#quantity_li').toggle('slow');
			jQuery('#start_prc').toggle('slow');
			jQuery('#res_prc').toggle('slow');		
			<?php
					$AuctionTheme_no_time_on_buy_now = get_option('AuctionTheme_no_time_on_buy_now');
					if($AuctionTheme_no_time_on_buy_now == "yes"):
			?>	
					jQuery('#ending_li').toggle('slow');	
			<?php endif; ?>
		}
	
	</script>
    
 	<form method="post" action="<?php echo AuctionTheme_post_new_with_pid_stuff_thg($pid, $new_auction_step);?>">  
    <ul class="post-new">
        <li>
        	<h2><?php echo __('Your auction title', 'AuctionTheme'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="auction_title" 
            value="<?php echo (empty($_POST['auction_title']) ? 
			($post->post_title == "Auto Draft" ? "" : $post->post_title) : $_POST['auction_title']); ?>" /> <?php do_action('AuctionTheme_step1_after_title_field');  ?></p>
        </li>
        
        <?php do_action('ActionTheme_after_title_li'); ?>

		<?php
		
			$AuctionTheme_currency_position = get_option('AuctionTheme_currency_position');	
			
			
			$AuctionTheme_enable_locations = get_option('AuctionTheme_enable_locations');
			if($AuctionTheme_enable_locations != 'no'):
		
		?>
        <li>
        	<h2><?php echo __('Location', 'AuctionTheme'); ?>:</h2>
        <p><?php	echo AuctionTheme_get_categories("auction_location", 
		empty($_POST['auction_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : $_POST['auction_location_cat'], __("Select Location","AuctionTheme"), "do_input"); ?></p>
        </li>
        <?php endif; ?>
        <?php do_action('ActionTheme_after_location_li'); ?>
        
        <li><h2><?php echo __('Category', 'AuctionTheme'); ?>:</h2>
        	<p>
			<?php if(get_option('AuctionTheme_enable_multi_cats') == "yes"): ?>
			<div class="multi_cat_placeholder_thing">
            
            	<?php 
					
					$selected_arr = AuctionTheme_build_my_cat_arr($pid);
					echo AuctionTheme_get_categories_multiple('auction_cat', $selected_arr); 
										
				?>
            
            </div>
            
            <?php else: ?>
            
			<?php	echo AuctionTheme_get_categories("auction_cat",  
			!isset($_POST['auction_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['auction_cat_cat']
			, __("Select Category","AuctionTheme"), "do_input"); ?>
            <?php endif; ?>
            
            </p>
        </li>
        
        
        <?php do_action('ActionTheme_after_category_li'); ?>
        
        
        <?php do_action('ActionTheme_after_category_li'); ?>
		<?php
			
			$only_buy_now = get_post_meta($pid, 'only_buy_now', true);
		
		?>
        <li id='start_prc' style="<?php echo ($only_buy_now == "1" ? 'display:none' : '');  ?>">
        	<h2><?php echo __('Start Price', 'AuctionTheme'); ?>:</h2>
        <p><?php if($AuctionTheme_currency_position == "front") echo auctiontheme_get_currency(); ?>
        <input type="text" size="10" name="start_price" class="do_input" 
        	value="<?php echo empty($_POST['start_price']) ? get_post_meta($pid, 'start_price', true) : $_POST['start_price']; ?>" /> 
			<?php if($AuctionTheme_currency_position != "front") echo auctiontheme_get_currency(); ?> <?php do_action('AuctionTheme_step1_after_start_rpice_field');  ?></p>
        </li>
        
        
        <?php do_action('ActionTheme_after_start_price_li'); ?>
        
         <li id="res_prc" style="<?php echo ($only_buy_now == "1" ? 'display:none' : '');  ?>">
        	<h2><?php echo __('Reserve Price', 'AuctionTheme'); ?>:</h2>
        <p><?php if($AuctionTheme_currency_position == "front") echo auctiontheme_get_currency(); ?>
        <input type="text" size="10" name="reserve" class="do_input" 
        	value="<?php echo empty($_POST['reserve']) ? get_post_meta($pid, 'reserve', true) : $_POST['reserve']; ?>" /> 
			<?php if($AuctionTheme_currency_position != "front") echo auctiontheme_get_currency(); ?> 
            <?php do_action('AuctionTheme_step1_after_reserve_price_field');  ?></p>
        </li>
        
        <?php do_action('ActionTheme_after_reserve_price_li'); ?>
        
         <li>
        	<h2><?php echo __('Buy Now Price', 'AuctionTheme'); ?>:</h2>
        <p><?php if($AuctionTheme_currency_position == "front") echo auctiontheme_get_currency(); ?>
        <input type="text" size="10" name="buy_now" class="do_input" 
        	value="<?php echo (empty($_POST['buy_now']) ? get_post_meta($pid, 'buy_now', true) : $_POST['buy_now']); ?>" /> <?php if($AuctionTheme_currency_position != "front") echo auctiontheme_get_currency(); ?>
             <input onchange="check_quant();"; name="only_buy_now" value="1" type="checkbox" <?php if(get_post_meta($pid,'only_buy_now',true) == "1") echo 'checked="checked"'; ?> /> <?php _e('Only buy now auction','AuctionTheme'); ?>
             <?php do_action('AuctionTheme_step1_after_buy_now_field');  ?>
             </p>
        </li>
        
        <?php do_action('ActionTheme_after_buy_now_li'); ?>
        
        
         <li>
        <h2><?php _e("Allow Offers?",'AuctionTheme');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="allow_offers" <?php echo (get_post_meta($pid,'allow_offers', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('AuctionTheme_step1_after_allow_offers_field');  ?>
        
       </p>
        </li>
        
        
        <li id="quantity_li" style="<?php echo ($only_buy_now != "1" ? 'display:none' : '');  ?>">
        	<h2><?php echo __('Quantity', 'AuctionTheme'); ?>:</h2>
        <p><input type="text" size="10" name="quant" class="do_input" 
        	value="<?php echo (empty($_POST['quant']) ? get_post_meta($pid, 'quant', true) : $_POST['quant']); ?>" /> 
            <?php do_action('AuctionTheme_step1_after_quantity_field');  ?></p>
        </li>
        
        
        <?php do_action('ActionTheme_after_quantity_li'); ?>
        
	
        <li>
        	<h2><?php echo __('Shipping Cost', 'AuctionTheme'); ?>:</h2>
        <p><?php if($AuctionTheme_currency_position == "front") echo auctiontheme_get_currency(); ?>
        <input type="text" size="10" name="shipping" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'shipping', true); ?>" /> <?php if($AuctionTheme_currency_position != "front") echo auctiontheme_get_currency(); ?>
            
            <input type="checkbox" value="1" name="do_not_require_shipping" /> <?php _e('This item does not require shipping.','AuctionTheme'); ?>
			
			<?php do_action('AuctionTheme_step1_after_shipping_field');  ?>
            
            
            </p>
        </li>
        
        
        <?php do_action('ActionTheme_after_shipping_li'); ?>
        
                 <li id="ending_li">
        <h2>
      

        
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/ui-thing.css" />
		<script type="text/javascript" language="javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon.js"></script>
 
       <?php _e("Auction Ending On",'AuctionTheme'); ?>:</h2>
        <p><input type="text" name="ending" id="ending" class="do_input" value='<?php 
		
		$dts = get_post_meta($pid, 'ending', true);
		if(!empty($dts))
		echo date_i18n('m/d/Y H:i:s',$dts); 
		
		
		?>' /> 
        <?php do_action('AuctionTheme_step1_after_ending_field');  ?>
        </p>
        </li> <?php do_action('ActionTheme_after_ending_li'); ?>
        
		 <script>
        
        jQuery(document).ready(function() {
             jQuery('#ending').datetimepicker({
            showSecond: true,
			dateFormat: 'dd-mm-yy',
            timeFormat: 'hh:mm:ss'
        });});
         
         </script>
                

        
        
        <li>
        	<h2><?php echo __('Private Bids', 'AuctionTheme'); ?>:</h2>
        <p><select name="private_bids" class="do_input">
        <option value="no" <?php if(get_post_meta($pid,'private_bids',true) == "no") echo 'selected="selected"'; ?>><?php _e("No",'AuctionTheme'); ?></option>
        <option value="yes" <?php if(get_post_meta($pid,'private_bids',true) == "yes") echo 'selected="selected"'; ?>><?php _e("Yes",'AuctionTheme'); ?></option>
        </select>        
        <?php do_action('AuctionTheme_step1_after_private_bids_field');  ?>
        </p>
        </li>
        
        <?php do_action('ActionTheme_after_private_bids_li'); ?>
        
        
        <li>
        	<h2><?php echo __('Address','AuctionTheme'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="auction_location_addr" value="<?php echo !isset($_POST['auction_location_addr']) ? 
		get_post_meta($pid, 'Location', true) : $_POST['auction_location_addr']; ?>" /> 
        <?php do_action('AuctionTheme_step1_after_address_field');  ?>
        </p>
        </li>
        
        <?php do_action('ActionTheme_after_address_li'); ?>
        
 
        
		<?php
		
			$AuctionTheme_enable_html_description = get_option('AuctionTheme_enable_html_description');
 
		?>		
        <li>
        	<h2><?php echo __('Description', 'AuctionTheme'); ?>:</h2>
        <p>
        <?php if($AuctionTheme_enable_html_description == 'yes'): ?>
        
        <div class="description_html_box_placeholder">
        <?php wp_editor( $post->post_content, 'auction_description', array('media_buttons' => false) ); ?>  
        </div>
        <?php else: ?>
        
         <textarea rows="6" cols="60" class="do_input" id="textareaID"  name="auction_description"><?php 
		echo empty($_POST['auction_description']) ? trim($post->post_content) : $_POST['auction_description']; ?></textarea>
        
        <?php endif; ?>
       </p> 
        
        
        <?php do_action('AuctionTheme_step1_after_description_field');  ?>
        
        </li>


		<?php do_action('ActionTheme_after_description_li'); ?>

	 <li>
        <h2><?php _e("Feature auction?",'AuctionTheme');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('AuctionTheme_step1_after_featured_field');  ?>
        
       </p>
        </li>
        
        <?php do_action('ActionTheme_after_feature_li'); ?>
        
       <!--         
        <li>
        <h2><?php _e("Coupon", "AuctionTheme"); ?>:</h2>
        <p><input type="text" class="do_input" name="coupon" size="30" /> <?php if($false_cup == 0 && isset($_POST['auction_submit2'])) _e('The coupon code you used is wrong.','AuctionTheme'); ?> 
        <?php do_action('AuctionTheme_step1_after_coupon_field');  ?>
        </p>
        </li>-->
        
		<?php do_action('ActionTheme_after_coupon_li'); ?>
        
       
       <?php
	    
		$auction_tags = '';
	   
	   	$t = wp_get_post_tags($pid);
		foreach($t as $tg)
		{
			$auction_tags .= $tg->name . ', ';	
		}
	   
	   ?>

		<li>
        	<h2><?php echo __('Tags', 'AuctionTheme'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="auction_tags" value="<?php echo $auction_tags; ?>" /> 
        <?php do_action('AuctionTheme_step1_after_tags_field');  ?> </p>
        </li>
        
        
     	<?php do_action('ActionTheme_after_tags_li'); ?>
        
        <li>
        <h2>&nbsp;</h2>
        <p>
        <?php 
		
		//echo '<a class="goback-link" href="'.AuctionTheme_post_new_link().'/step/1/?substep='.(count($_SESSION['AuctionTheme_stored_categories'])).'&post_new_auction_id='.  $pid.'">
		//'.__('Go Back','AuctionTheme').'</a>';
		
		 ?>
        <input type="submit" name="auction_submit_1" value="<?php _e("Next Step", 'AuctionTheme'); ?> >>" /></p>
        </li>
    
    	<?php do_action('ActionTheme_after_submit_li'); ?>
    
    </ul>
    </form>
    
  <?php } ?>  
    
 <!-- ####################################### Step 2 ######################################### -->   
    
    
    
    
    
    
<?php
    
if($new_auction_step == 2)
{

	$img_nr = get_option("ad_theme_pic_nr");
	$catid 	= $_SESSION['posted_thing_cat'];
	$wii = get_option('ad_uploaded_image_width');
	
	if(empty($img_nr)) $img_nr = 5;
	
	global $current_user;
	get_currentuserinfo();
	$cid = $current_user->ID;

	
	if($uploaders == "html") $enc = 'enctype="multipart/form-data"';
	
	?>
    <!-- ###########################  -->
    <?php
		
		if($uploaders == "jquery"):
	
	?>
    
    <ul class="post-new">
    <li>
                            <h2><?php echo __('Images', 'AuctionTheme'); ?>:</h2>
                            <p>
    					
	<div id="mcont">
    <form id="fileupload" action="<?php bloginfo('siteurl'); ?>/?uploady_thing=1&pid=<?php echo $pid; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
    
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                 
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    
 
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
 

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>

</div>

    
    						</p>
    						</li>
    
    </ul>    
    
    
    <?php endif; //endif jquery uploads ?>
    
    <!-- ########################## -->
    
    <form method="post" <?php echo $enc; ?>  action="<?php echo AuctionTheme_post_new_with_pid_stuff_thg($pid, $new_auction_step);?>" > 
      <ul class="post-new">
      
      <?php
	  	if($uploaders == "html"):
	  ?>
      
 <li>
                            <h2><?php echo __('Images', 'AuctionTheme'); ?>:</h2>
                            <p>
          <?php
		  
		  		$args = array(
				'order'          => 'ASC',
				'orderby'        => 'post_date',
				'post_type'      => 'attachment',
				'post_parent'    => $pid,
				'post_mime_type' => 'image',
				'numberposts'    => -1,
				); $i = 0;
				
				$attachments = get_posts($args);
				
				$default_nr = get_option('AuctionTheme_nr_max_of_images');
		  		if(empty($default_nr)) $default_nr = 5;
				
				$actual_nr = count($attachments);
				$dis = $default_nr - $actual_nr;
		  
		  		for($i=1;$i<=$dis;$i++):
				?>                   
        		
                	<input type="file" class="do_input file_inpt" name="file_<?php echo $i; ?>" />
				
				<?php	endfor; ?>
       
                          </p>
                            </li>
                           
                           <li>
                           
                            <div id="thumbnails" style="overflow:hidden;">
                            
                                          <script type="text/javascript">
	
	function delete_this3(id)
	{
		 jQuery.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   jQuery('#image_ss'+id).remove(); window.location.reload();  }
					 });
		  //alert("a");
	
	}
	
</script>
                            
    
    <?php

	

	if($pid > 0)
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div2"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			AuctionTheme_wp_get_attachment_image($attachment->ID, array(70, 70)). '" />
			<a href="javascript: void(0)" onclick="delete_this3(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
                           
                           </li>

 	<?php endif; //image uploaders html ?>
 
 
 		<?php /*-------  custom fields  -------- */ ?>
        <?php
		
		$auction_cat = wp_get_object_terms($pid, 'auction_cat');
		$cate = array($auction_cat[0]->term_id);
		
		$arr 	= get_auction_category_fields($cate, $pid);
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<li>';
					echo '<h2>'.$arr[$i]['field_name'].$arr[$i]['id'].':</h2>';
					echo '<p>'.$arr[$i]['value'];
					do_action('AuctionTheme_step2_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
					
					do_action('ActionTheme_after_field_'.$arr[$i]['id'].'_li');
			
			
		}	
		
		
		do_action('AuctionTheme_step2_form_thing', $pid);
		
		
		?>        
 
 
        <li>
        <h2>&nbsp;</h2>
        <p>
        <?php
        
		echo '<a class="goback-link" href="'.AuctionTheme_post_new_with_pid_stuff_thg($pid, ($new_auction_step-1)).'">'.__('Go Back','AuctionTheme').'</a>';
		
		?>
        <input type="submit" name="auction_submit_photos" value="<?php _e("Next Step", 'AuctionTheme'); ?> >>" /></p>
        </li>
    
    
    </ul>
    </form>
    
  <?php } //end step2 ?>  
    

<?php


if($new_auction_step == "3")
{
	if($_GET['finalise'] == "yes") $finalise = true;
	else $finalise = false;
	
	
	//-----------------------
	
	$AuctionTheme_new_auction_listing_fee = get_option('AuctionTheme_new_auction_listing_fee');
	if(empty($AuctionTheme_new_auction_listing_fee)) $AuctionTheme_new_auction_listing_fee = 0;
	
	$AuctionTheme_new_auction_feat_listing_fee = get_option('AuctionTheme_new_auction_feat_listing_fee');
	if(empty($AuctionTheme_new_auction_feat_listing_fee)) $AuctionTheme_new_auction_feat_listing_fee = 0;
	
	$AuctionTheme_new_auction_sealed_bidding_fee = get_option('AuctionTheme_new_auction_sealed_bidding_fee');
	if(empty($AuctionTheme_new_auction_sealed_bidding_fee)) $AuctionTheme_new_auction_sealed_bidding_fee = 0;
	
	$AuctionTheme_get_images_cost_extra = AuctionTheme_get_images_cost_extra($pid); 
	$catid 								= AuctionTheme_get_item_primary_cat($pid);
	
	//---------------------------------
	
	$custom_set = get_option('auctionTheme_enable_custom_posting');
	if($custom_set == 'yes')
	{
		$posting_fee = get_option('auctionTheme_theme_custom_cat_'.$catid);
		if(empty($posting_fee)) $posting_fee = 0;		
	}
	else
	{
		$posting_fee = $AuctionTheme_new_auction_listing_fee;
	}
	
	
	//---------------------------------
	
	$payment_arr = array();
	$AuctionTheme_enable_membership = get_option('AuctionTheme_enable_membership');
	
	if($posting_fee > 0 and $AuctionTheme_enable_membership != "yes")
	{
	
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'base_fee';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $posting_fee;
		$my_small_arr['description'] 	= __('Base Listing Fee','AuctionTheme');
		array_push($payment_arr, $my_small_arr);
		
	}
	//--------------------------------
	
	$featured = get_post_meta($pid, 'featured', true);
	
	if($featured == "1"):
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'feat_fee';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $AuctionTheme_new_auction_feat_listing_fee;
		$my_small_arr['description'] 	= __('Featured Listing Fee','AuctionTheme');
		array_push($payment_arr, $my_small_arr);
	endif;
	
	//--------------------------------
	
	$private_bids = get_post_meta($pid, 'private_bids', true);
	
	if($private_bids == "yes"):
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'sealed_fee';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $AuctionTheme_new_auction_sealed_bidding_fee;
		$my_small_arr['description'] 	= __('Sealed Bidding Fee','AuctionTheme');
		array_push($payment_arr, $my_small_arr);
	endif;
	
	
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'extra_img';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $AuctionTheme_get_images_cost_extra;
		$my_small_arr['description'] 	= __('Extra Images Fee','AuctionTheme');
		array_push($payment_arr, $my_small_arr);
	
	//--------------------------------
	
	$post 			= get_post($pid);
		
	//---------------------------------------------
	
	$new_total 		= 0;
		
	foreach($payment_arr as $payment_item):			
		if($payment_item['amount'] > 0):				
			$new_total += $payment_item['amount'];			
		endif;			
	endforeach;
	
	//----------------------------------------
	
	$total 			= $new_total;
	$total 			= apply_filters('AuctioTheme_total_price_to_pay' , 			$total, $pid);

	$opt = get_option('AuctionTheme_admin_approve_auction');
	if($opt == "yes") $admin_must_approve = true;
	else $admin_must_approve = false;
	
	//-----------------------------------------
	
	do_action('AuctionTheme_action_when_posting_auction', $pid);
	do_action('AuctionTheme_action_when_posting_auction_payment_arr', $payment_arr, $new_total);
	
	if($total == 0)
	{
			global $current_user;
			get_currentuserinfo();
			
			echo '<div >';
			echo __('Thank you for posting your item with us.','AuctionTheme');
			update_post_meta($pid, "paid", "1");
			

			if($finalise):
				if($admin_must_approve)
				{
					$my_post = array();
					$my_post['ID'] = $pid;
					$my_post['post_status'] = 'draft';
	
					wp_update_post( $my_post );
					
					AuctionTheme_send_email_posted_item_not_approved($pid);
					AuctionTheme_send_email_posted_item_approved_admin($pid);
					
					echo '<br/>'.__("Your auction isn't yet live, the admin needs to approve it.", "AuctionTheme");
					
	
				
				}
				else
				{
					$my_post = array();
					$my_post['ID'] = $pid;
					$my_post['post_status'] = 'publish';
	
					wp_update_post( $my_post );
					
					AuctionTheme_send_email_posted_item_approved($pid);
					AuctionTheme_send_email_posted_item_not_approved_admin($pid);
					
				}
				
			endif;
			echo '</div>';
			
	
	}
	else
	{
			update_post_meta($pid, "paid", "0");
			
			echo '<div >';
			echo __('Thank you for posting your auction with us. Below is the total price that you need to pay in order to put your auction live.<br/>
			Click the pay button and you will be redirected...', 'AuctionTheme');
			echo '</div>';
			
			
			
	}
	
	//----------------------------------------
	
	
	
	echo '<table style="margin-top:25px">';
	
	if($total > 0) :
	foreach($payment_arr as $payment_item):
			
			if($payment_item['amount'] > 0):
			
				echo '<tr>';
				echo '<td>'.$payment_item['description'].'&nbsp; &nbsp;</td>';
				echo '<td>'.auctionTheme_get_show_price($payment_item['amount'],2).'</td>';
				echo '</tr>';

			endif;
			
		endforeach;
	
	
				echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '<tr>';
	echo '<td><strong>'.__('Total to Pay','AuctionTheme').'</strong></td>';
	echo '<td><strong>'.auctionTheme_get_show_price($total,2).'</strong></td>';
	echo '<tr>';
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	endif;
	
	if($total == 0)
	{
		if(!$admin_must_approve && $finalise):
		
			echo '<tr>';
			echo '<td></td>';
			echo '<td><a href="'.get_permalink($pid).'" class="pay_now">'.__('See your auction','AuctionTheme') .'</a></td>';
			echo '<tr>';	
		
		endif;
		
	}
	else
	{
		update_post_meta($pid,'unpaid','1');
		
		$AuctionTheme_enable_pay_credits = get_option('AuctionTheme_enable_pay_credits');		
		if($AuctionTheme_enable_pay_credits != 'no'):
			
			
			echo '<tr>';
			echo '<td><strong>'.__('Your Total Credits','AuctionTheme').'</strong></td>';
			echo '<td><strong>'.auctionTheme_get_show_price(auctionTheme_get_credits($uid),2).'</strong></td>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td>'.__('Pay by Credits','AuctionTheme').'</td>';
			echo '<td><a href="'.get_bloginfo('siteurl').'/?tms='.current_time('timestamp',0).'&a_action=credits_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay Now','AuctionTheme').'</a></td>';
			echo '<tr>';
		
		endif;
						
						echo '<tr>';
						echo '<td></td><td>';
		
						$AuctionTheme_paypal_enable 		= get_option('AuctionTheme_paypal_enable');
						$AuctionTheme_alertpay_enable 		= get_option('AuctionTheme_alertpay_enable');
						$AuctionTheme_moneybookers_enable 	= get_option('AuctionTheme_moneybookers_enable');
						
						
						if($AuctionTheme_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=paypal_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by PayPal','AuctionTheme').'</a>';
						
						if($AuctionTheme_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=mb_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by MoneyBookers/Skrill','AuctionTheme').'</a>';
						
						if($AuctionTheme_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=payza_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by Payza','AuctionTheme').'</a>';
						
						do_action('AuctionTheme_add_payment_options_to_post_new_project', $pid);
						
						echo '</td></tr>';
		
		

	}
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '</table>';
	
	
	
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	
	if(!$finalise)
	echo '<a href="'. AuctionTheme_post_new_with_pid_stuff_thg($pid, '2') .'" class="go_back_btn" >'.__('Go Back','AuctionTheme').'</a>';
	
	if($total == 0 && !$finalise)
	echo '<a href="'. AuctionTheme_post_new_with_pid_stuff_thg($pid, '3', 'finalise').'" 
	class="go_back_btn" >'.__('Finalize and Publish Item','AuctionTheme').'</a>';

}


 ?>

    
    
    
    
   <!-- end --> 
 
    </div>
    </div>
    







<?php
	
}

?>