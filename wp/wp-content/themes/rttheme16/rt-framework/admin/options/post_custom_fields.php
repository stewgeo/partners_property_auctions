<?php
#-----------------------------------------
#	RT-Theme post_custom_fields.php
#	version: 1.0
#-----------------------------------------

#
# 	Post Custom Fields
#

/**
* @var  array  $customFields  Defines the custom fields available
*/

$customFields = array(
	array(
		"title" 			=> __("FEATURED IMAGE",'rt_theme_admin'), 
		"type" 			=> "heading"),
	
	array(
		"title" 			=> __("Resize Featured Images.",'rt_theme_admin'),
		"name"			=> "blog_image_resize",
		"description" 		=> "Your featured image will be resized for the content. You can control the resize process with the features below.",
		"default" 		=> "on",
		"hr" 			=> "true",
		"type" 			=> "checkbox"
	),
	
	array(
		"title" 			=> __("Featured Image Width",'rt_theme_admin'),
		"name" 			=> "blog_image_width",
		"description" 		=> "The feautured image will be resized to fit the content area if the the resize feature is ON. You can set a maximum width value for the image or leave as \"0\" to use default values.",
		"hr" 			=> "true",
		"min"			=> "0",
		"max"			=> "924",
		"default"			=> "0",
		"type" 			=> "rangeinput"
	),

	array(
		"title" 			=> __("Featured Image Heght",'rt_theme_admin'),
		"name" 			=> "blog_image_height",
		"description" 		=> "You can change set a maximum height value for the featured image. As default the height value is not defined (0) and the image height will be automatically scaled. ",
		"hr" 			=> "true",
		"min"			=> "0",
		"max"			=> "700",
		"default"			=> "0",
		"type" 			=> "rangeinput"
	),
	 
	array(
		"title" 			=> __("Crop Featured Images.",'rt_theme_admin'),
		"name"			=> "blog_image_crop",
		"description" 		=> "If you turn on the crop feature, the image will be cropped as the width and the height values.",
		"default" 		=> "on",
		"hr" 			=> "true",
		"type" 			=> "checkbox"
	),

	array(
		"title" 			=> __("Featured Image Position",'rt_theme_admin'), 
		"name"			=> "featured_image_position",
		"options" 		=>  array(
							"center" 		=> "Stand alone", 
							"left" 		=> "Left aligned",
							"right" 		=> "Right aligned",
						 ),
		"select" 			=> __("Select Layout",'rt_theme_admin'),
		"type" 			=> "select"
	),	
	
	array(
		"title"			 => __("VIDEO",'rt_theme_admin'), 
		"type"			 => "heading"
	),
				
	array(
		"title" 			=> __("Video Url for Video format posts",'rt_theme_admin'), 
		"name"			=> "video_url",
		"description" 		=> __("paste a video URL from YouTube or Vimeo. Select the Video options from the list on the \"Format\" box to use this feature.",'rt_theme_admin'),
		"type" 			=> "text"
	),

	array(
		"title"			 => __("GALLERY",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "gallery_slider",
		"title"			=> __("Gallery Images",'rt_theme_admin'),
		"description"		=> __("Paste image URLs line by line that you want to show in the gallery slider. ",'rt_theme_admin'),
		"hr" => "true",
		"type"			=> "textarea" 
	),


	array(
		"title" 			=> __("Crop Gallery Images",'rt_theme_admin'),
		"name" 			=> "gallery_images_crop",
		"default" 		=> "on",
		"hr" => "true",
		"hr"				=> true,
		"type" 			=> "checkbox"
	),
			
	array(
		"title" 			=> __("Maximum Image Heght",'rt_theme_admin'),
		"name" 			=> "gallery_images_height",
		"description"		=> __('You can use this option if the "Crop Gallery Images" feature is on','rt_theme_admin'),
		"min"			=>"60",
		"max"			=>"400",
		"default"			=>"300",
		"type" 			=> "rangeinput"
	),


	array(
		"title"			 => __("LINK",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "post_format_link",
		"title"			=> __("URL",'rt_theme_admin'),
		"description"		=> __("Write an URL for the link post type.",'rt_theme_admin'),
		"type"			=> "text" 
	),	

	array(
		"title"			 => __("QUOTE",'rt_theme_admin'), 
		"type"			 => "heading"
	),
	
	array(
		"name"			=> "quote_text",
		"title"			=> __("Text",'rt_theme_admin'),
		"hr"				=> "true",
		"type"			=> "textarea" 
	),	
	 
	array(
		"name"			=> "quote_author",
		"title"			=> __("Author",'rt_theme_admin'),
		"hr"				=> "true",
		"type"			=> "text" 
	),

	//hidden value
	array(
		"name"			=> "is_old_post",  
		"type"			=> "hidden",
		"statical_value"	=> "1"
	),		
	 
);

$settings  = array( 
	"name"		=> THEMENAME ." Post Format Options",
	"scope"		=> array('post'),
	"slug"		=> "rt_post_custom_fields",
	"capability"	=> "edit_page",
	"context"		=> "normal",
	"priority"	=> "high" 
);

?>