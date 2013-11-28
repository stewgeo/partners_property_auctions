<?php
		$options    = array (
	
		array(
		"name"        => __("Info",'rt_theme_admin'),
		"desc"        => __('Use these options to customize the theme. You can also find styling options related with the main menu on <a href="admin.php?page=rt_menu_options">Menu Styling Options</a>. In order to customize site typography use <a href="admin.php?page=rt_typography_options">Typography Options</a>','rt_theme_admin'),
		"hr"          => "true",
		"type"        => "info"),				

		array(
		"name"      => __("Theme Style",'rt_theme_admin'),
		"desc"      => __("Please choose a style for your theme.",'rt_theme_admin'),
		"id"        => THEMESLUG."_style",
		"options"   =>	array(
						"light"     => "Light Style",
						"dark"      => "Dark Style", 
						),
		"default"   => "light",
		"hr"        => "true",
		"type"      => "select"), 
		
		array(
		"name"      => __("Boxed Design",'rt_theme_admin'),
		"desc"      => __("Turn ON this option if you would like to use this theme with boxed design.",'rt_theme_admin'),				
		"id"        => THEMESLUG."_boxed_design",
		"type"      => "checkbox",),
				
		array(
		"name" 		=> __("SITE ELEMENTS",'rt_theme_admin'), 
		"type" 		=> "heading"),		
				
		array(
		"name"      => __("Primary Color",'rt_theme_admin'),
		"desc"      => __("You can change change heading colors, slider button colors etc. Leave blank if you want to use default colors.",'rt_theme_admin'),
		"id"        => THEMESLUG."_primary_color",
		"hr"        => "true", 
		"default"   => "#e77927",
		"dont_save" => "true",
		"type"      => "colorpicker"),
		
		array(
		"name"      => __("Content Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_body_font_color",
		"hr"        => "true",
		"default"   => "#5B5B5B", 
		"dont_save" => "true",
		"type"      => "colorpicker"),
		
		array(
		"name"      => __("Custom Link Color",'rt_theme_admin'),
		"desc"      => __("Leave blank if you want to use default colors.",'rt_theme_admin'),
		"id"        => THEMESLUG."_link_color",
		"hr"        => "true", 
		"type"      => "colorpicker"),
		
		array(
		"name"      => __("Custom Link Color (Hover State)",'rt_theme_admin'),
		"desc"      => __("Leave blank if you want to use default colors.",'rt_theme_admin'),
		"id"        => THEMESLUG."_link_color_hover",
		"type"      => "colorpicker"),			

		array(
		"name" 		=> __("HEADER AND FOOTER STYLING",'rt_theme_admin'), 
		"type" 		=> "heading"),
		
		array(
		"name"      => __("Select a Pattern",'rt_theme_admin'),
		"id"        => THEMESLUG."_pattern_selection",
		"options"   => array(		
						"1"         =>"Pattern 1",
						"2"         =>"Pattern 2",
						"3"         =>"Pattern 3",
						"4"         =>"Pattern 4",
						"5"         =>"Pattern 5",
						"6"         =>"Pattern 6",
						"7"         =>"Pattern 7",
						"8"         =>"Pattern 8",
						"9"         =>"Pattern 9",
						"10"        =>"Pattern 10",
						"-1"          =>"No Pattern"
						), 
						
		"hr"        => "true",
		"class"     => "pattern_list",
		"type"      => "radio"),

		array(
		"name" => __("Upload your own pattern",'rt_theme_admin'),
		"id"   => THEMESLUG."_custom_pattern",
		"hr"   => "true",
		"type" => "upload"),		
		
		array(
		"name"      => __("Custom Background Color for Header and Footer",'rt_theme_admin'),
		"desc"      => __("Leave blank if you want to use default colors.",'rt_theme_admin'),
		"id"        => THEMESLUG."_header_footer_color",
		"hr"        => "true", 
		"type"      => "colorpicker"),


		array(
		"name"      => __("Header and Footer Font Color",'rt_theme_admin'),
		"id"        => THEMESLUG."_header_footer_font_color",
		"default"   => "#5B5B5B", 
		"dont_save" => "true",
		"type"      => "colorpicker"),

		array(
		"name" 		=> __("MORE CUSTOMIZATION",'rt_theme_admin'), 
		"type" 		=> "heading"),	
		
		array(
		"name"      => __("Custom CSS Codes",'rt_theme_admin'),
		"desc"      => __("Paste your css codes. Do not include &lt;stlye&gt;&lt;/stlye&gt; tags or any html tag in this field.",'rt_theme_admin'),
		"id"        => THEMESLUG."_custom_css",
		"hr"        => "true", 
		"type"      => "textarea"),
		);
?>