<?php 
$options = array ();
	array_push($options, 
			array(
				"name" => __("Info",'rt_theme_admin'),
				"desc" => __("Type URL of your social media page in the related fields to display with it's icon bottom of the pages." ,'rt_theme_admin'),
				"type" => "info",
				"hr"   => true,
			)
	);
	foreach($this->social_media_icons as $key => $value){
			array_push($options, 
						array(
						"name" 	=> $key. __(" icon link",'rt_theme_admin'), 
						"id" 	=> THEMESLUG."_".$value."",
						"type" 	=> "text", "hr" => "true"
						)
					);  
	} 
?>