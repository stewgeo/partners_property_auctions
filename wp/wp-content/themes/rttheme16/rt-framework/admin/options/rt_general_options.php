<?php

$options = array (

	array(
	"name"      => __("Logo",'rt_theme_admin'),
	"desc"      => __("Please choose an image file or write url of your logo.",'rt_theme_admin'),
	"id"        => THEMESLUG."_logo_url",
	"hr"        => "true",
	"type"      => "upload"),
	
	array(
	"name"      => __("Top and bottom space of logo",'rt_theme_admin'),
	"id"        => THEMESLUG."_logo_padding",
	"min"       =>"0",
	"max"       =>"200",
	"default"   =>"40",
	"dont_save" =>"true",
	"hr"        => "true",
	"type"      => "rangeinput"),
	
	array(
	"name"      => __("Custom Favicon",'rt_theme_admin'),
	"desc"      => __("You can put url of an ico image that will represent your website's favicon (16px x 16px) ",'rt_theme_admin'),
	"id"        => THEMESLUG."_favicon_url",
	"type"      => "text"),	   

	array(
	"name"      => __("BACKGROUND OPTIONS",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Background Image",'rt_theme_admin'),
	"desc"      => __('Please choose an image or write an url which you want as a backgroud image. Go to <a href="themes.php?page=custom-background">WordPress Background</a> page for more background options.','rt_theme_admin'),
	"id"        => THEMESLUG."_background_image_url",
	"hr"        => "true",
	"type"      => "upload"),
	
	
	array(
	"name"      => __("Randomized Background Images",'rt_theme_admin'),
	"desc"      => __("To activate the random background images enter image urls line by line",'rt_theme_admin'),
	"id"        => THEMESLUG."_background_image_urls",
	"help"      => "true",
	"type"      => "textarea"),
	
	array(
	"name"      => __("SUB PAGE TOP BAR",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Show Search",'rt_theme_admin'),
	"id"        => THEMESLUG."_show_search",
	"desc"      => __('Show search form field on top of the sub pages.','rt_theme_admin'),	
	"type"      => "checkbox",
	"default"   => "checked",
	"help"      => "true"),  
	
	array(
	"name"      => __("BREADCRUMB MENU",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Breadcrumb Menus",'rt_theme_admin'),
	"desc"      => __("You can turn on/off bredcrumb menus",'rt_theme_admin'),
	"id"        => THEMESLUG."_breadcrumb_menus",
	"hr"        => "true",
	"default"   => "checked",
	"type"      => "checkbox"),
	
	array(
	"name"      => __("Breadcrumb Menu Text",'rt_theme_admin'),
	"desc"      => __("The text before the breadcrumb menu",'rt_theme_admin'),
	"id"        => THEMESLUG."_breadcrumb_text",
	"default"   => __("You are here:",'rt_theme_admin'), 
	"type"      => "text"),
	
	array(
	"name"      => __("SIDEBAR POSITION",'rt_theme_admin'), 
	"type"      => "heading"),
	
	array(
	"name"      => __("Default Sidebar Position for Sub Pages",'rt_theme_admin'),
	"desc"      => __("Select the position of the sidebar.",'rt_theme_admin'),
	"id"        => THEMESLUG."_sidebar_position",
	"options"   =>  array(
	"right"     => "Right", 
	"left"      => "Left",
	),
	"default"   => "right",
	"type"      => "select"),	
	
	array(
	"name"      => __("FOOTER RELATED FIELDS",'rt_theme_admin'), 
	"type"      => "heading"), 
	
	array(
	"name"      => __("Footer Copyright Text",'rt_theme_admin'),
	"desc"      => __("The copyright text area on left side of footer. You can also use shorcodes and HTML within this field.",'rt_theme_admin'),
	"id"        => THEMESLUG."_footer_copy",
	"default"   => "Copyright &copy; 2011 Company Name, Inc.",
	"hr"        => "true",	
	"type"      => "textarea"),
	
	array(
	"name"      => __("Footer Widgets",'rt_theme_admin'),
	"desc"      => __("Show footer widgets and use 'Sidebar for Footer'.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_show_footer_widgets",
	"type"      => "checkbox",
	"hr"        => "true",
	"default"	=> "on"
	),
	
	array(
	"name"      => __("Footer Widget Layout",'rt_theme_admin'),
	"desc"      => __("Select the layout of the footer widgets.",'rt_theme_admin'),
	"id"        => THEMESLUG."_footer_box_width",
	"options"   =>  array(
						5 => "1/5", 
						4 => "1/4",
						3 => "1/3",
						2 => "1/2",
						1 => "1/1"
					),
	"default"   => "4",
	"hr"        => "true",
	"help"      => "true",
	"type"      => "select"),
	
	array(
	"name"      => __("Boxed Footer Widgets",'rt_theme_admin'),
	"desc"      => __("Show the footer widgets in boxed design.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_footer_widget_styles",
	"type"      => "checkbox"
	),		 
	
	array(
	"name"      => __("GOOGLE ANALYTICS",'rt_theme_admin'), 
	"type"      => "heading"), 
	
	array(
	"name"      => __("Analytics Code",'rt_theme_admin'),
	"desc"      => __("Paste your full google analytics code or any other tracking code that needs to be placed in the footer of html body.",'rt_theme_admin'),
	"id"        => THEMESLUG."_google_analytics",
	"type"      => "textarea",				
	),

	array(
	"name"      => __("PAGE COMMENTS",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Allow comments on pages",'rt_theme_admin'),
	"desc"      => __("Turn ON this option if you would like to allow comments on regular pages. Make sure 'Allow Comments' box is also checked for individual pages. ",'rt_theme_admin'),				
	"id"        => THEMESLUG."_allow_page_comments",
	"type"      => "checkbox"
	), 			

	array(
	"name"      => __("UPDATE NOTIFICATIONS",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Close Update Notifications",'rt_theme_admin'),
	"desc"      => __("Turn OFF this option if you don't want to be informed about theme updates.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_update_notifications",
	"type"      => "checkbox",
	"default"	=> "on"
	),
	
	array(
	"name"      => __("WPML PLUGIN",'rt_theme_admin'), 
	"type"      => "heading"), 
	array(
	"name"      => __("Show Flags",'rt_theme_admin'),
	"desc"      => __("Show language flags of WPML plugin on top of the page.",'rt_theme_admin'),				
	"id"        => THEMESLUG."_show_flags",
	"default"   => "checked",
	"type"      => "checkbox",
	"hr"        => "true"
	), 			
); 
?>