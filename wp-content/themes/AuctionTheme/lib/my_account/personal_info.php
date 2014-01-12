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

function AuctionTheme_my_account_pers_info_area_function()
{	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	
?>	
		<div id="content">
        
          <?php do_action('AuctionTheme_before_pers_info_i_page'); ?>
        
        
        <div class="my_box3">
    
            
            	<div class="box_title"><?php _e("Personal Information",'AuctionTheme'); ?></div>
                <div class="box_content">    
				<?php
				
				if(isset($_POST['save-info']))
				{
					$personal_info = strip_tags(nl2br($_POST['personal_info']), '<br />');
					update_user_meta($uid, 'personal_info', $personal_info);
					
					$shipping_info = trim($_POST['shipping_info']);
					update_user_meta($uid, 'shipping_info', $shipping_info);
					
					
					
					if(isset($_POST['password']) && !empty($_POST['password']))
					{
						$p1 = trim($_POST['password']);
						$p2 = trim($_POST['reppassword']);
						
						if($p1 == $p2)
						{
							global $wpdb;
							$newp = md5($p1);
							$sq = "update $wpdb->users set user_pass='$newp' where ID='$uid'" ;
							$wpdb->query($sq);
							
							do_action('AuctionTheme_update_password_success',$uid);
						}
						else
						echo __("Passwords do not match!","AuctionTheme");
					}
					
					
					$paypal_email = trim($_POST['paypal_email']);
					update_user_meta($uid, 'paypal_email', $paypal_email);
				 
					
					if(!empty($_FILES['avatar']['name'])):
	  
						$upload_overrides 	= array( 'test_form' => false );
						$uploaded_file 		= wp_handle_upload($_FILES['avatar'], $upload_overrides);
						
						$file_name_and_location = $uploaded_file['file'];
						$file_title_for_media_library = $_FILES['avatar']['name'];
								
						$arr_file_type 		= wp_check_filetype(basename($_FILES['avatar']['name']));
						$uploaded_file_type = $arr_file_type['type'];
		
						if($uploaded_file_type == "image/png" or $uploaded_file_type == "image/jpg" or $uploaded_file_type == "image/jpeg" or $uploaded_file_type == "image/gif" )
						{
						
							$attachment = array(
											'post_mime_type' => $uploaded_file_type,
											'post_title' => 'Uploaded avatar ' . addslashes($file_title_for_media_library),
											'post_content' => '',
											'post_status' => 'inherit',
											'post_parent' =>  0,			
											'post_author' => $current_user->ID,
										);
									 
							$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, 0 );
							$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
							wp_update_attachment_metadata($attach_id,  $attach_data);
							
							update_user_meta($uid, 'avatar_new', $attach_id);
						
						}
						
					endif;
					
					
					echo '<div class="saved_thing">'.__('Your profile information was updated.','AuctionTheme').'</div>';
					echo '<div class="clear10"></div>';
					
				}
				
				?>
                <form method="post"  enctype="multipart/form-data">
                  <ul class="post-new3">
        <li>
        	<h2><?php echo __('PayPal Email','AuctionTheme'); ?>:</h2>
        	<p><input type="text" name="paypal_email" class="do_input" value="<?php echo get_user_meta($uid, 'paypal_email', true); ?>" size="40" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Shipping Info','AuctionTheme'); ?>:</h2>
        	<p><textarea type="shipping_info" cols="40" class="do_input" rows="3" name="shipping_info"><?php echo stripslashes(get_user_meta($uid, 'shipping_info', true)); ?></textarea></p>
        </li>
        
        <li>
        	<h2><?php echo __('Profile Description','AuctionTheme'); ?>:</h2>
        	<p><textarea type="textarea" cols="40" class="do_input" rows="5" name="personal_info"><?php echo stripslashes(get_user_meta($uid, 'personal_info', true)); ?></textarea></p>
        </li>
        
        
         <li>
        	<h2><?php echo __('New Password', "AuctionTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="password" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Repeat Password', "AuctionTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="reppassword" size="35"  /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Profile Avatar','AuctionTheme'); ?>:</h2>
        	<p> <input type="file" name="avatar" /> <br/>
           <?php _e('max file size: 1mb. Formats: jpeg, jpg, png, gif'); ?>
            <br/>
            <img width="50" height="50" border="0" src="<?php echo auctionTheme_get_avatar($uid,50,50); ?>" /> 
            </p>
        </li>
        
        
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-info" value="<?php _e("Save" ,'AuctionTheme'); ?>" /></p>
        </li>
        
        </ul>
                </form>
                </div>
           </div>
           </div>     
        
   

<?php	auctionTheme_get_users_links();	
}

?>