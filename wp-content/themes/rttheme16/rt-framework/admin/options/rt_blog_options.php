<?php

$options = array (

	array(
	"name"    => __("Info",'rt_theme_admin'),
	"desc"    => __('These options are only related with post category, archive and single post pages. If you would like to have more control on how to display your posts, customize "<a href="admin.php?page=rt_template_options">Default Blog Template</a>" or create a new one according your preferences. To learn more, go to <a href="admin.php?page=rt_setup_assistant">Setup Assistant</a> and read "How To Create Blog" steps.','rt_theme_admin'),
	"type"    => "info"),				

	array(
	"name"    => __("SINGLE POST PAGES",'rt_theme_admin'), 
	"type"    => "heading"),

	array(
	"name"    => __("Author info box under posts.",'rt_theme_admin'),
	"id"      => THEMESLUG."_hide_author_info",
	"desc"    => 'You can place a little information box under the posts about the author of the post. Turn ON this option and update your "Biographical Info" on your <a href="profile.php">profile page</a>.',
	"type"    => "checkbox"), 

	array(
	"name"    => __("BLOG CATEGORIES AND ARCHVIES",'rt_theme_admin'), 
	"type"    => "heading"),

	array(
	"name"    => __("Date Format",'rt_theme_admin'),
	"id"      => THEMESLUG."_date_format",
	"default" => "F j, Y",
	"desc"    => "<a href='http://codex.wordpress.org/Formatting_Date_and_Time' target='_blank'>Formatting Date and Time</a>",
	"type"    => "text"),	

	array(
	"name"    => __("SIDEBAR OPTIONS FOR BLOG CATEGORIES",'rt_theme_admin'), 
	"type"    => "heading"), 

	array(
	"name"    => __("Default Sidebar Position for Blog",'rt_theme_admin'),
	"desc"    => __('Select a default sidebar position for your categories and single post pages.','rt_theme_admin'),
	"id"      => THEMESLUG."_sidebar_position_blog",
	"select"  => __("Select",'rt_theme_admin'),
				"options" =>  array(
				"right"   => 	"Content + Right Sidebar", 
				"left"    => 	"Content + Left Sidebar",
				"full"    => 	"Full Width - No Sidebar",
				),
	"hr"      => true,
	"default" => "right",
	"type"    => "select"),				

); 
?>