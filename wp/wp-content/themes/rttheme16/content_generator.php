	<?php
	global $UserSidebarIDs,$selectedTemplateID;  
	
	$cotent_generator = true;	
	
	#
	#	Get all templates
	#
	$savedTemplates = get_option('rt_page_layouts');
		
	#
	#	Template to use 
	#
	if($selectedTemplateID && isset($savedTemplates->templates[$selectedTemplateID])){
		#
		#	Use user selected template 
		# 	
		$selectedTemplate = $savedTemplates->templates[$selectedTemplateID];
	}else{
		#
		#	no template created - we create default one according sidebars
		#
		$selectedTemplate = new stdClass;
		$selectedTemplate->templateID                = 0;
		$selectedTemplate->templateName              = "Default Template";
		$selectedTemplate->sidebar                   = $sidebar;
		$selectedTemplate->lineup                    = "on";
		@$selectedTemplate->contents[0]->group_id     = 1;
		@$selectedTemplate->contents[0]->content_type = "default_content";
		@$selectedTemplate->contents[0]->layout       = "one";
		@$selectedTemplate->contents[0]->heading      = "on";
	}
 
	#
	#	Temaplate Items
	# 								
	$selectedTemplate_contents = $selectedTemplate->contents;
	
	#
	#	Sidebar 
	# 
	$sidebar=$selectedTemplate->sidebar ? $selectedTemplate->sidebar : str_replace("fullwidth","full",get_page_layout());
	
	#
	#	Content Width 
	#
	$content_width = ($sidebar=="full") ? 960 : 710;
	
	#
	#	Call the holder's 1st part
	#
	sub_page_layout("subheader",$sidebar); 

		
	#
	# 	Layout grid values
	#
	$layout_values	= array("four-five"=>48,"three-four"=>45,"two-three"=>40,"five"=>12,"four"=>15,"three"=>20,"two"=>30,"one"=>60);
	
	
	#
	# 	Prepare counting boxes
	#		
	$boxNumber = 1;
	$box_counter = 1;
	$total_width = 0;
	$emptyContent = "";
	$reset_row_count = 0;
	$fixedRows = 0;
	 
	#
	# 	Do for each content that has been added for this template
	#
	if($selectedTemplate_contents){
	foreach($selectedTemplate_contents as $templateID => $template){	
	
	
			#
			#	Box Layout
			#
			if($template->layout){ 
				$this_item_layout=$template->layout; 
			}
			
			#
			#	Next item box width
			#
			if(isset($selectedTemplate_contents[$templateID+1]->layout)){
				$next_item_layout = $selectedTemplate_contents[$templateID+1]->layout;
				
				if(empty($next_item_layout)) {
					$next_item_layout  = $template->layout;  
				}
			} 
				 
				
			#
			#	this column width	- pixel
			#
			$this_column_width_pixel =  intval ($content_width / (60/$layout_values[$this_item_layout]) );
			
			
			#
			#	first and last box of each row
			#		
			$next_item_width = (isset($next_item_layout)) ? $layout_values[$next_item_layout] : "";
			$total_width     = ($total_width==0) ? $layout_values[$this_item_layout] + $next_item_width : $total_width + $next_item_width;			
			$firstBox        = ($box_counter ==1) ? "first" : false;
			$lastBox         = ($total_width > 60) ? "last" : false;
			$box_counter     = ($total_width > 60) ? $box_counter = 1 : $box_counter+1 ;
			$reset_row_count = ($box_counter == 1) ? 0 : $reset_row_count;
			$total_width     = ($total_width>60) ? 0 : $total_width;
		
				
			#
			#	reset the row
			#		
			$reset = ($lastBox) ? true : false;

					#
					#	Call Slider
					#
					if($template->content_type=="slider_box"){
						
						echo	($template->layout=="one") ? "" :'<div class="template_builder box '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
						
						$slides=array(
							'post_type'           => 'slider',
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'showposts'           => 1000,
							'cat'                 => -0,
							'post__in'            => $template->content_id,
							'orderby'             => $template->list_orderby,
							'order'               => $template->list_order							
						);
						
						$slider_script         =  $template->slider_script;
						$rttheme_slider_height =  $template->slider_height;
						$rttheme_slider_width  =  $sidebar=="full" ? 940 : 690;
						$crop_slider_images    = ($template->image_crop) ? true : false;
						$resize_slider_images  =  $template->image_resize;
						$slider_effect         =  $template->slider_effect;
						$slider_timeout        =  $template->slider_timeout;
						$slider_buttons        =  $template->slider_buttons;
						$group_id              =  $template->group_id; 
						
							if($slider_script=="cycle"){
								get_template_part( 'cycle-slider', 'home_slider' );
							}elseif($slider_script=="nivo"){
								get_template_part( 'nivo-slider', 'home_slider' );
							}else{
								get_template_part( 'accordion-slider', 'home_slider' );
							}
						
						echo	($template->layout=="one") ? "" : '</div>';
					}

					#
					#	Banner Text
					#
					if($template->content_type=="banner_box"){
										
										
						echo $sidebar=="full" ? '</div>' : '';
						
						$template->button_color = isset($template->button_color) ? $template->button_color : "";
						$template->button_link = isset($template->button_link) ? $template->button_link : ""; 
						$template->button_text = isset($template->button_text) ? $template->button_text : ""; 
						$template->button_size = isset($template->button_size) ? $template->button_size : ""; 
						
						echo'	<div class="border-line margin-b10"></div>	';
						echo'	<div class="row color1">	';
						echo'	<div class="template_builder banner clearfix">	';
								
						echo ($template->button_link && $template->button_text) ? '<a href="'.wpml_t( THEMESLUG , 'Button Link for Banner '.$selectedTemplate->templateID, $template->button_link ).'" class="button '.$template->button_color.' '.$template->button_size.' alignright">'.wpml_t( THEMESLUG , 'Button Text for Banner '.$selectedTemplate->templateID, $template->button_text ).'</a>' : '';						
						echo ($template->button_link && $template->button_text) ? '<p class="featured_text text_shadow withbutton">': '<p class="featured_text text_shadow">';
						echo		stripslashes(wpml_t( THEMESLUG , 'Text for Banner '.$selectedTemplate->templateID, $template->text ));
						echo'	</p>	';									
						
						echo'	</div>	';
						echo'	</div>	';
						echo'	<div class="border-line margin-t10"></div>	';
						
						
						echo $sidebar=="full" ? '<div class="content fullwidth clearfix">' : '' ;
						
					}

					#
					#	Default Content
					#
					if($template->content_type=="default_content"){
						$heading	= $template->heading;
						
						if(!is_front_page()){
								if(is_page())		get_template_part( 'page_content', 'page_content_file' );
								if(is_single()) 	get_template_part( 'post_content', 'post_content_file' );
						}else{
								$reset="";
						}
						
					}
					
					#
					#	Call Sidebar Box
					#
					if($template->content_type=="sidebar_box"){
						
						$box_width 	= $template->widget_box_width;
						$sidebarID	= $template->sidebar_id;
						$layout        = $template->layout;
						$widget_border	= isset($template->widget_border) ? "border white" : ""; 
						$home_contents_count=0;//reset widget count
						$widget_num=false;//reset widget count 
						
						echo	($template->layout=="one") ? "" :'<div class="template_builder box '.$widget_border.' '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($widget_border) ? '<div class="padding-div">' : '' ;
							
							add_filter('dynamic_sidebar_params', array("RT_Create_Sidebars",'home_page_layout_class'));					
							dynamic_sidebar($template->sidebar_id);
						
						echo ($widget_border) ? '</div>' : '' ;
						echo	($template->layout=="one") ? "" : '</div>';
					}

					#
					#	Call All Content Boxes
					#
					if($template->content_type=="all_content_boxes"){
						$home_page        = array(  'post_type'=> 'home_page', 'post_status'=> 'publish', 'showposts' => -1, 'cat' => -0, 'post__in'  => $template->content_id, 'orderby' => $template->list_orderby, 'order' => $template->list_order);
						$layout           = $template->layout;
						$item_width       = $template->item_width; //item width
						$box_border 	  = isset($template->box_border) ? "border" : "" ; //border of the container box
						$container_border = ($layout != "one" && $box_border) ? "border" : ""; 
						
						echo	($template->layout=="one") ? "" :'<div class="template_builder box '.$container_border.' '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($container_border) ? '<div class="padding-div">' : '' ;
									
						get_template_part( 'home_content_loop', 'home_page' );
						
						echo ($container_border) ? '</div>' : '' ;
						echo	($template->layout=="one") ? "" : '</div>';						
					}
					
					#
					#	Call a Content Box
					#
					if($template->content_type=="home_page_box"){ 
						$home_page	= array(  'post_type'=> 'home_page',   'post_status'=> 'publish',   'showposts' => 1,   'cat' => -0,  'p'  => $template->content_id);
						$layout	 	= $template->layout;
						get_template_part( 'home_content_loop', 'home_page' );
					}
		
	
					#
					#	Call Portfolio Box
					#
					if($template->content_type=="portfolio_box"){ 				
								
						
						$item_width = $template->item_width; //item width
						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout     = $template->layout; 
						
						echo	($layout=="one") ? "" :'<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($box_border) ? '<div class="padding-div">' : '' ;
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 

								$template->categories = isset($template->categories) ? $template->categories : ""; 
	
								//general query
								$args=array( 
									'post_status'    =>	'publish',
									'post_type'      =>	'portfolio',
									'orderby'        =>	$template->portf_list_orderby,
									'order'          =>	$template->portf_list_order,
									'posts_per_page' =>	$template->item_per_page,
									'paged'          => $paged, 
						 
									'tax_query' => array(
										array(
											'taxonomy' =>	'portfolio_categories',
											'field'    =>	'id',
											'terms'    =>	 $template->categories,
											'operator' => 	($template->categories)  ? "IN" : "OR"
										)
									),																		
								);
								 
								
								get_template_part( 'portfolio_loop', 'portfolio_categories' );
						
						echo ($box_border) ? '</div>' : '' ;
						echo	($layout=="one") ? "" : '</div>';
					}


					#
					#	Call Product Box
					#
					if($template->content_type=="product_box"){ 				
								
						
						$item_width = $template->item_width; //item width
						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout     = $template->layout; 
						$template->categories  = isset($template->categories) ? $template->categories : "";

						echo	($layout=="one") ? "" :'<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo 	($box_border) ? '<div class="padding-div">' : '' ;
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 
	
								//general query
								$args=array( 
									'post_status'    =>	'publish',
									'post_type'      =>	'products',
									'orderby'        =>	$template->list_orderby,
									'order'          =>	$template->list_order,
									'posts_per_page' =>	$template->item_per_page,
									'paged'          => $paged, 
						 
									'tax_query' => array(
										array(
											'taxonomy' =>	'product_categories',
											'field'    =>	'id',
											'terms'    =>	 $template->categories,
											'operator' => 	($template->categories)  ? "IN" : "OR"
										)
									),																		
								);
								 
								
								get_template_part( 'product_loop', 'product_categories' );
						
						echo ($box_border) ? '</div>' : '' ;
						echo	($layout=="one") ? "" : '</div>';
					}		


					#
					#	Call Product Box
					#
					if($template->content_type=="blog_box"){ 				
								
						
						$item_width = isset($template->item_width) ? $template->item_width : "" ; //item width
						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout		= $template->layout; 
						
						echo	($layout=="one") ? "" :'<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($box_border) ? '<div class="padding-div">' : '' ;
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 

								//blog cats
								if($template->categories){
									$blog_cats=implode(($template->categories),",");
								}else{
									$blog_cats="";
								}
			
								//general query
								$args=array( 
									'post_status'    =>	'publish',
									'post_type'      =>	'post',
									'orderby'        =>	$template->list_orderby,
									'order'          =>	$template->list_order,
									'posts_per_page' =>	$template->item_per_page,
									'paged'          => $paged, 
									'cat'            =>	$blog_cats,
								);
								 
								
								get_template_part( 'loop', 'archive' );
						
						echo ($box_border) ? '</div>' : '' ;
						echo	($layout=="one") ? "" : '</div>';
					}		


					#
					#	Call Google Map
					#
					if($template->content_type=="google_map"){ 			 

						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout		= $template->layout; 
						
						echo '<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($box_border) ? '<div class="padding-div">' : '' ;
					 
							//try to find view larger map part
							$mapiframeCode        = explode('<br /><small>', stripslashes($template->map_url)); 							
							$mapiframeCode        = is_array($mapiframeCode) ? $mapiframeCode[0] : $mapiframeCode ; //cleaned larger map part
							
							//find width value
							$mapiframeCode_Width  = explode('width="', $mapiframeCode);
							$mapiframeCode_Width  = explode('"', $mapiframeCode_Width[1]);
							$mapiframeCode_Width  = $mapiframeCode_Width[0];
							
							//find height value
							$mapiframeCode_Height = explode('height="', $mapiframeCode);
							$mapiframeCode_Height = explode('"', $mapiframeCode_Height[1]);
							$mapiframeCode_Height = $mapiframeCode_Height[0];
							
							//new map width
							$newMapWidth          = $this_column_width_pixel -20;
							
							//final code 
							$mapiframeCode        = str_replace('width="'.$mapiframeCode_Width.'"','width="'.$newMapWidth.'"', $mapiframeCode);
							$mapiframeCode        = str_replace('height="'.$mapiframeCode_Height.'"','height="'.$template->height.'"', $mapiframeCode);
							 
							echo $mapiframeCode; 
						
						echo ($box_border) ? '</div>' : '' ;
						echo	'</div>';
					}		
					 

					#
					#	Call Contact Form
					#
					if($template->content_type=="contact_form"){ 			 

						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout			= $template->layout; 
						
						echo '<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($box_border) ? '<div class="padding-div">' : '' ;
					 
							echo ($template->title) ? '<h3>'.wpml_t( THEMESLUG , 'Text for Contact Form '.$selectedTemplate->templateID, stripslashes($template->title)).'</h3>' :"";
							echo ($template->description) ? '<div class="space margin-t10"><p class="decs_text"><i>'.wpml_t( THEMESLUG , 'Description for Contact Form '.$selectedTemplate->templateID, stripslashes($template->description)).'</i></div>' :"";
					
							//Default Contact Form
							if($template->email && !$template->shortcode){			
								echo	do_shortcode('[contact_form email="'.$template->email.'"]');
							}
						
							//3rd Party Contact Form Plugins
							if($template->shortcode){
								echo	do_shortcode(stripslashes($template->shortcode));
							}
						
						echo ($box_border) ? '</div>' : '' ;
						echo	'</div>';
					}		

					#
					#	Call Contact Info Box
					#
					if($template->content_type=="contact_info_box"){ 			 
			
						$box_border = isset($template->box_border) ? "border" : "" ; //border of the container box
						$layout		= $template->layout; 
						
						echo '<div class="template_builder box '.$box_border.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						echo ($box_border) ? '<div class="padding-div">' : '' ;
					 
							echo ($template->contact_title) ? '<h3>'.wpml_t( THEMESLUG , 'Title for Contact Info '.$selectedTemplate->templateID, stripslashes($template->contact_title) ).'</h3>' :"";
							echo ($template->contact_text) ? '<div class="space margin-t10"></div><p>'.wpml_t( THEMESLUG , 'Text for Contact Info '.$selectedTemplate->templateID, stripslashes($template->contact_text) ).'</p>' :"";
							echo '<ul class="contact_list">'; 
							echo ($template->address) ? '<li class="home">'.wpml_t( THEMESLUG , 'Address for Contact Info '.$selectedTemplate->templateID, stripslashes($template->address) ).'</li>' :"";
							echo ($template->phone) ? '<li class="phone">'.wpml_t( THEMESLUG , 'Phone for Contact Info '.$selectedTemplate->templateID, $template->phone ).'</li>' :"";
							echo ($template->email) ? '<li class="mail"><a href="mailto:'.wpml_t( THEMESLUG , 'Email for Contact Info '.$selectedTemplate->templateID, $template->email ).'">'.wpml_t( THEMESLUG , 'Email for Contact Info '.$selectedTemplate->templateID, $template->email ).'</a></li>' :"";
							echo ($template->support_email) ? '<li class="help"><a href="mailto:'.wpml_t( THEMESLUG , 'Support Email for Contact Info '.$selectedTemplate->templateID, $template->support_email ).'">'.wpml_t( THEMESLUG , 'Support Email for Contact Info '.$selectedTemplate->templateID, $template->support_email ).'</a></li>' :"";
							echo ($template->fax) ? '<li class="fax">'.wpml_t( THEMESLUG , 'Fax for Contact Info '.$selectedTemplate->templateID, $template->fax ).'</li>' :"";
							echo '</ul>'; 
							
						echo ($box_border) ? '</div>' : '' ;
						echo	'</div>';
					}	 
					
					if ($reset && $emptyContent!="true" && $boxNumber != count($selectedTemplate->contents)): 
						echo '<div class="clear"></div><div class="space margin-b30"></div>';						
					endif;
					$emptyContent = false;
					
		$boxNumber++;
	}
	}

	#
	#	Call the holder's 2nd part
	#
	sub_page_layout("subfooter",$sidebar);
	?>