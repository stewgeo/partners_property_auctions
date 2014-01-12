 
	<div id="footer">
	<footer>
		<?php if(get_option(THEMESLUG.'_show_footer_widgets')): ?>
			<div class="border-line margin-t30 margin-b10"></div>
			<div class="row color1 clearfix">
				<div class="footer_widgets"> 
					<?php if (function_exists('dynamic_sidebar')){  dynamic_sidebar('sidebar-for-footer'); } ?>				
				</div> 			
			</div>
		<?php endif; ?>
		
		<div class="border-line margin-t10 margin-b20"></div>

		<div class="footer_info">				
				
				<div class="part1">
				<?php if ( has_nav_menu( 'rt-theme-footer-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
				<!-- footer links -->
				    <?php  
				    //call the footer menu
				    $topmenuVars = array(
					   'depth'		 => 1,
					   'menu_id'         => '',
					   'menu_class'      => 'footer_links', 
					   'echo'            => false,
					   'container'       => '', 
					   'container_class' => '', 
					   'container_id'    => '',
					   'theme_location'  => 'rt-theme-footer-navigation' 
				    );
				    
				    $footer_menu=wp_nav_menu($topmenuVars);
				    echo add_class_first_item($footer_menu);
				    ?>		  
				<!-- / footer links -->
				<?php else:?>
				<!-- footer links -->
				    <?php  
				    //call the footer menu
				    $topmenuVars = array(
					   'menu'            => 'RT Theme Footer Navigation Menu',
					   'depth'		 => 1,
					   'menu_id'         => '',
					   'menu_class'      => 'footer_links', 
					   'echo'            => false,
					   'container'       => '', 
					   'container_class' => '', 
					   'container_id'    => '',
					   'theme_location'  => 'rt-theme-footer-navigation' 
				    );
				    
				    $footer_menu=wp_nav_menu($topmenuVars);
				    echo add_class_first_item($footer_menu);
				    ?>		  
				<!-- / footer links -->
				<?php endif;?>

				<!-- copyright text -->
				<div class="copyright"><?php echo do_shortcode(wpml_t(THEMESLUG, 'Footer Copyright Text', get_option(THEMESLUG.'_footer_copy')));?></div>
				<!-- / copyright text --> 				
				</div>
				
				<?php 
				//social media icons
				global $social_media_icons;
				$social_media_output ='';
				
				foreach ($social_media_icons as $key => $value){
					
					if($value=="email_icon"){//e-mail icon link 
						$link = 'mailto:'.str_replace("mailto:", "", get_option( THEMESLUG.'_'.$value ));
					}else{
						$link = get_option( THEMESLUG.'_'.$value );
					}
					
					//all icons
					if(get_option( THEMESLUG.'_'.$value )){
						$social_media_output .= '<li>';
						$social_media_output .= '<a target="_blank" href="'. $link .'" class="j_ttip" title="'.$key.'">';
						$social_media_output .= '<img src="'.THEMEURI.'/images/assets/social_media/icon-'.$value.'.png" alt="" />';
						$social_media_output .= '</a>';
						$social_media_output .= '</li>';
					}
				}
				if($social_media_output) echo '<ul class="social_media_icons">'.$social_media_output.'</ul>';
				?>

		</div>
	</footer>
	<div class="clear"></div>
	</div><!--! end of #footer -->

  </div><!--! end of #container --> 

<?php echo get_option( THEMESLUG.'_google_analytics');?> 
<?php wp_footer();?>
</body>
</html> 