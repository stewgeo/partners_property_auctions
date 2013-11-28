<?php
#-----------------------------------------
#	RT-Theme home_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Home Page Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(

			array(
				"name"			=> "sub_title", 
				"title"			=> __("Sub Title",'rt_theme_admin'),
				"type"			=> "text" 
			), 

			array(
				"name"			=> "custom_link", 
				"title"			=> __("Custom Link",'rt_theme_admin'),
				"type"			=> "text" 
			),

			array(
				"name"			=> "custom_link_text",
				"title"			=> __("Custom Link Text",'rt_theme_admin'),
                    "description"		=> "ex: read more",
				"type"			=> "text" 
			),

			array(
					"title" => __("FEATURED IMAGE",'rt_theme_admin'), 
					"type" => "heading"
				),
			
			array(
					"title" 	=> __("Crop Featured Image",'rt_theme_admin'),
					"name" 	=> "homepage_image_crop",
					"default" => "",
					"hr"		=> true,
					"type" 	=> "checkbox"
				),
			
			array(
				   "title" 	=> __("Maximum Image Heght",'rt_theme_admin'),
				   "name" 	=> "homepage_image_height",
				   "description"		=> __('You can use this option if the "Crop Featured Image" feature is on','rt_theme_admin'),
				   "min"		=>"60",
				   "max"		=>"400",
				   "default"	=>"120",
				   "type" 	=> "rangeinput"
				), 
			  
);

$settings  = array( 
	"name"		=> THEMENAME ." Home Page Options",
	"scope"		=> "home_page",
	"slug"		=> "rt_home_custom_fields",
	"capability"	=> "edit_post",
	"context"		=> "normal",
	"priority"	=> "high" 
);