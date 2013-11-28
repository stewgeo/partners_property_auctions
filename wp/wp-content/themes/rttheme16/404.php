<?php
/* 
* rt-theme 404 
*/
get_header();  
?>

<?php
	//call sub page header
	get_template_part( 'sub_page_header', 'sub_page_header_file' ); 
	

	//call the sub content holder 1st part
	sub_page_layout("subheader",$sidebar);
?>

	<h1 style="font-size:120px;">404</h1>
	<h6><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'rt_theme'); ?></h6><br /><br /><br />

<?php

	//call the sub content holder 2nd part
	sub_page_layout("subfooter",$sidebar); 

get_footer();
?>