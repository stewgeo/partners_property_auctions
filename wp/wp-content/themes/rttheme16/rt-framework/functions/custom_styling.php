<?php
#-----------------------------------------
#	RT-Theme custom_styling.php
#	version: 1.0
#-----------------------------------------

function rt_custom_styling(){
	echo '<style type="text/css">';
	
	#
	#   Custom Menu Underline Color
	#
	
	$menuItemArray = array('first','second','third','fourth','fifth','sixth','seventh','eight','ninth','tenth'); 
	foreach($menuItemArray as $value){ 
		$color = get_option(THEMESLUG.'_'.$value.'_underline_color'); 
		if($color) echo '#navigation_bar > ul > li.'.$value.' > a{ border-bottom:5px solid '.$color.'; }'; 
	}
	
	#
	#   Custom Menu Font Color
	#
	$rttheme_menu_font_color=get_option(THEMESLUG.'_menu_font_color'); // menu item color
	$rttheme_menu_font_color_hover=get_option(THEMESLUG.'_menu_font_color_hover'); // menu item hover color
	$rttheme_menu_sub_font_color=get_option(THEMESLUG.'_menu_font_sub_color'); // menu item color
	$rttheme_menu_sub_font_color_hover=get_option(THEMESLUG.'_menu_font_color_sub_hover'); // menu item hover color
	
	if($rttheme_menu_font_color){// menu item color
		echo '#navigation_bar > ul > li > a{color:'.$rttheme_menu_font_color.';}';
	}
	
	if($rttheme_menu_font_color_hover){// menu active item color
		echo '#navigation_bar > ul > li > a:hover {color:'.$rttheme_menu_font_color_hover.';}';	
	}
	
	if($rttheme_menu_sub_font_color){// menu item color
		echo '#navigation_bar ul ul li a{color:'.$rttheme_menu_sub_font_color.' !important;}';
	}
	
	if($rttheme_menu_sub_font_color_hover){// menu active item color
		echo '#navigation_bar ul li li a:hover,#navigation_bar li.hasSubMenu:hover > a {color:'.$rttheme_menu_sub_font_color_hover.' !important;}';	
	} 
	
	#
	#   Custom Menu Font Size
	#
	$rttheme_menu_font_size=get_option(THEMESLUG.'_menu_font_size');
	if($rttheme_menu_font_size){
		echo '#navigation_bar > ul > li > a {font-size:'.$rttheme_menu_font_size.'px;}';
	}
	 
	#
	#   Custom Navigation Top Padding
	#
	$rttheme_menu_top_padding=get_option(THEMESLUG.'_menu_top_padding');
	if($rttheme_menu_top_padding){
		echo '#navigation_bar.navigation2, #navigation_bar.navigation {padding-top:'.$rttheme_menu_top_padding.'px;}';
	}
		
	
	#
	#   Custom Logo Padding
	#
	$rttheme_logo_padding=get_option(THEMESLUG.'_logo_padding');
	if($rttheme_logo_padding){
		echo '#logo {padding:'.$rttheme_logo_padding.'px 0;}';
	}
	
	
	#
	#   Custom Primary Colors
	#
	$rttheme_primary_color=get_option(THEMESLUG.'_primary_color');
	if($rttheme_primary_color){
		echo '
	
			body #container h1,body #container h2,body #container h3,body #container h4,body #container h5,body #container h6, body #container h1 a, body #container h2 a, body #container h3 a, body #container h4 a, body #container h5 a, body #container h6 a{color:'.$rttheme_primary_color.' !important;}		
			
			.banner .featured_text a{ 
			    border-bottom:1px solid '.$rttheme_primary_color.';
		     }
		    
			.kwicks li .desc_accordion .title a:hover,
			ul.tabs a:hover,
			.paging li a:hover, .paging li a:hover, .paging li.active a{		
				color:'.$rttheme_primary_color.' !important;		
			}
					
			.nivo-directionNav a, 
			.slider_buttons a.activeSlide,
			.numbers a.activeSlide {
				background-color:'.$rttheme_primary_color.' ;		
			}	
	
			/* text selection */
			::selection {
				background: '.$rttheme_primary_color.'; 
			}
			
			::-moz-selection {
				background: '.$rttheme_primary_color.';  
			}
				
		';
	
		; 
	}
	
	
	#
	#   Custom Link Colors
	#
	$rttheme_link_color=get_option(THEMESLUG.'_link_color');
	$rttheme_link_color_hover=get_option(THEMESLUG.'_link_color_hover');
	
	if($rttheme_link_color){
		echo 'a,.content a, #footer .box.footer.widget a{color:'.$rttheme_link_color.';}'; 
	}
	if($rttheme_link_color_hover){
		echo 'a:hover,.content a:hover,, #footer .box.footer.widget a:hover{color:'.$rttheme_link_color_hover.';text-shadow:none;}'; 
	}
	
	#
	#   Custom Body Font Color
	#
	$rttheme_body_font_color=get_option('rttheme_body_font_color');
	if($rttheme_body_font_color){
		echo 'body,.banner .featured_text {color:'.$rttheme_body_font_color.';text-shadow:none;}';
	}
	
	#
	#   Custom Header Footer Font Color
	#
	$rttheme_header_footer_font_color=get_option(THEMESLUG.'_header_footer_font_color');
	if($rttheme_header_footer_font_color){
		echo '.row,span.date,.banner .featured_text, #footer blockquote p, #footer blockquote span, #footer h5, #footer h5 a {color:'.$rttheme_header_footer_font_color.' !important;}';
	}
	
	#
	#   Custom Header Footer Background Color
	#
	$rttheme_header_footer_color=get_option(THEMESLUG.'_header_footer_color');
	if($rttheme_header_footer_color){
		echo '
		
		.row,#navigation ul ul, #navigation2 ul {background-color:'.$rttheme_header_footer_color.' !important;}.banner .featured_text {text-shadow:none;} body.boxed #container {border:none;} 
		#navigation ul ul, #navigation2 ul  {border:1px solid RGBa(255,255,255, 0.15);} 
		#navigation ul ul li a, #navigation2 ul li a{ border-bottom:1px solid RGBa(255,255,255, 0.15) !important;} 
		img.recent-posts-thumb{ background-color:RGBa(255,255,255, 0.1) !important; border-color:RGBa(255,255,255, 0.1) !important;}
		';
	} 
	
	
	#
	#   Custom Pattern
	#
	$rttheme_custom_pattern    = get_option(THEMESLUG.'_custom_pattern');
	$rttheme_pattern_selection = get_option(THEMESLUG.'_pattern_selection');
	
	if($rttheme_pattern_selection!="-1" || $rttheme_custom_pattern){
	
		if($rttheme_custom_pattern || $rttheme_pattern_selection){
		
			if($rttheme_custom_pattern){
				echo ' .row,body.boxed {background-image:url('.$rttheme_custom_pattern.') !important;} ';
			}else{
				echo ' .row,body.boxed {background-image:url('.THEMEURI.'/images/assets/patterns/grid'.$rttheme_pattern_selection.'.png) !important;} ';
			} 
		
			echo '
			body.boxed #container {border:none;}
			.banner .featured_text {text-shadow:none;}
			#footer .footer_info{ padding: 0 0 20px 0; }
			';
		
		}
	}else{
		echo ' .row.color1,.row.color2,body.boxed {background-image:none;} ';
	}
	
	#
	#   Custom Heading Sizes
	#
	for ($i = 1; $i <= 6; $i++) {
		$this_heading=get_option('rttheme_h'.$i.'_font_size');
		if($this_heading){ 
			echo 'h'.$i.'{ font-size:'.$this_heading.'px;line-height:140%; }'; 
		}
	}
	
	
	#
	#   Custom Body Font Size
	#
	$rttheme_body_font_size=get_option('rttheme_body_font_size');
	if($rttheme_body_font_size){
		echo 'body {font-size:'.$rttheme_body_font_size.'px;line-height:160%;}';
	}
	
	#
	#   Custom Body Font Family
	#
	$rttheme_body_font_family=get_option('rttheme_body_font_family');
	if($rttheme_body_font_family){
		echo 'body {font-family:'.$rttheme_body_font_family.';}';
	}
	
	
	#
	#   Custom CSS Codes
	#
	echo get_option(THEMESLUG.'_custom_css');
	
	echo '</style>';
}
add_filter('wp_head','rt_custom_styling');
?>