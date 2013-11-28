<?php
$options = array (
	
	array(
	"name"        => __("Info",'rt_theme_admin'),
	"desc"        => __('Use these options to customize the main navigation menu. You can also find related options for the typography of the menu in <a href="admin.php?page=rt_typography_options">Typography Options</a>','rt_theme_admin'),
	"hr"          => "true",
	"type"        => "info"),		
	
	array(
	"name"        => __("Select Main Menu Style",'rt_theme_admin'),
	"desc"        => __("Please choose a style for your theme.",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_style",
					"options"     =>  array(
					"navigation"  => "Style 1: Visible Second Level Menu Items",
					"navigation2" => "Style 2: Regular Menu - Only First Level Menu Items", 
					),
	"default"     => "navigation",
	"hr"          => "true",
	"type"        => "select"),			
	
	array(
	"name"        => __("Gap between menu and top of the page (px)",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_top_padding",
	"min"         => "10",
	"max"         => "200",
	"default"     => "40",
	"dont_save"   => "true",
	"type"        => "rangeinput"),
	
	array(
	"name"        => __("MENU ITEM COLORS",'rt_theme_admin'), 
	"type"        => "heading"
	),
	
	array(
	"name"        => __("Custom Menu Font Color - First Level",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color",
	"hr"          => "true",
	"default"     => "#7c7c7c",
	"dont_save"   => "true",	 				   
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("Custom Menu Font Color - First Level (mouse over states)",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color_hover",
	"hr"          => "true",
	"default"     => "#A9A9A9",
	"dont_save"   => "true",	 				   
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("Custom Menu Font Color - Sub Levels",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_sub_color",
	"hr"          => "true",
	"default"     => "#7c7c7c",
	"dont_save"   => "true",	 
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("Custom Menu Font Color - Sub Levels (mouse hover states)",'rt_theme_admin'),
	"id"          => THEMESLUG."_menu_font_color_sub_hover",
	"default"     => "#A9A9A9",
	"dont_save"   => "true",	 						   
	"type"        => "colorpicker"),
	
	
	array(
	"name"        => __("UNDERLINES",'rt_theme_admin'), 
	"type"        => "heading"
	),
	
	array(
	"name"        => __("Menu Item Underlines",'rt_theme_admin'),
	"desc"        => __("If you would like to remove underlines from the top level menu items, you can turn off this option.",'rt_theme_admin'),
	"id"          => THEMESLUG."_underlines",
	"default"     => "on", 
	"type"        => "checkbox"), 
	
	array(
	"name"        => __("UNDERLINE COLORS",'rt_theme_admin'), 
	"type"        => "heading"
	),
	
	array(
	"name"        => __("1st Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_first_underline_color",
	"hr"          => "true",
	"default"     =>"#f76900",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("2nd Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_second_underline_color",
	"hr"          => "true",
	"default"     =>"#fcd04a",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("3nd Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_third_underline_color",
	"hr"          => "true",
	"default"     =>"#b9d482",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("4th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_fourth_underline_color",
	"hr"          => "true",
	"default"     =>"#3d92c2",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("5th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_fifth_underline_color",
	"hr"          => "true",
	"default"     =>"#c078d0",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("6th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_sixth_underline_color",
	"hr"          => "true",
	"default"     =>"#83DBE3",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("7th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_seventh_underline_color",
	"hr"          => "true",
	"default"     =>"#E351BE",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("8th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_eighth_underline_color",
	"hr"          => "true",
	"default"     =>"#f76900",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("9th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_ninth_underline_color",
	"hr"          => "true",
	"default"     =>"#fcd04a",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
	
	array(
	"name"        => __("10th Item Underline Color",'rt_theme_admin'),
	"id"          => THEMESLUG."_tenth_underline_color",
	"hr"          => "true",
	"default"     =>"#b9d482",
	"dont_save"   =>"true",
	"type"        => "colorpicker"),
);

 
?>