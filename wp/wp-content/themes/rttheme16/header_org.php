<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head> 
<meta charset="<?php bloginfo( 'charset' ); ?>" />  
	
<title><?php if (is_home() || is_front_page() ): bloginfo('name'); else: wp_title('');endif; ?></title>
<?php if (get_option( 'rttheme_favicon_url')):?><link rel="icon" type="image/png" href="<?php echo get_option( 'rttheme_favicon_url');?>"><?php endif;?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); //thread comments?>		

<?php 
#
# Add specific CSS class by filter
#
add_filter('body_class','rt_body_class_name');

#
#  Wordpress Background
#
$background 		= get_background_image();
$background_color 	= get_background_color();
?>

<?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>

<?php
#
#	Variables for javascript
#
echo '
<script type="text/javascript">
/* <![CDATA[ */
	var rttheme_template_dir = "'.THEMEURI.'";  
/* ]]> */	
</script>
';
?>
	
<?php
#
# Static 100% & Randomized Backgrounds
#
if(!$background){ //if wordpress background tool has not been used
	$background_image= get_option( THEMESLUG.'_background_image_url' );
	$randomized_banckground_images =  trim(get_option( THEMESLUG.'_background_image_urls'));
	
	//Static 100% Bakcround
	if($background_image && !$randomized_banckground_images){
		echo '<img src="'.$background_image.'" alt="" id="background" />';	
	}

	//Randomized 100% Backgrounds
	if($randomized_banckground_images){
	    $random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $randomized_banckground_images)); 
	    $images=explode("\n",  $random_background);    
	    $random_number = rand(0, count($images)-1);    
	    echo '<img src="'.$images[$random_number].'" alt="" id="background" />'; 
	}	
}
?>

<!-- background wrapper -->
<div id="container">
	
	<!-- row for header -->	
	<div class="row color1">
	
		<!-- header -->
		<div id="header" class="clearfix"><header>
			
			<!-- logo -->
			<div id="logo">
				<?php if(get_option('rttheme_logo_url')):?>
					<a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><img src="<?php echo get_option('rttheme_logo_url'); ?>" alt="<?php echo bloginfo('name');?>" class="png" /></a>
				<?php else:?>
					<h1 class="cufon logo"><a href="<?php echo BLOGURL; ?>" title="<?php echo bloginfo('name');?>"><?php echo bloginfo('name');?></a></h1>
				<?php endif;?>
			</div>
			<!-- /logo --> 

		
			<!-- navigation -->
			<?php
			#
			#	Menu Styling
			#
			
			$menu_style = get_option(THEMESLUG.'_menu_style');
			$menu_style = ($menu_style) ? $menu_style : 'navigation';
			$underlines = (get_option(THEMESLUG.'_underlines')) ? '' : 'no-underline';
			?>
			<nav><div id="navigation_bar" class="<?php echo $menu_style;?>">
	 
				<?php if ( has_nav_menu( 'rt-theme-main-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
					<!-- Navigation -->
					<?php            
					//call the main menu
					$menuVars = array(
						'menu_id'         => $menu_style,
						'menu_class'      => $underlines,
						'echo'            => false,
						'container'       => '', 
						'container_class' => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'container_id'    => '',
						'walker' => new Menu_Class_Walker,
						'theme_location'  => 'rt-theme-main-navigation' 
					);
					
					$main_menu=wp_nav_menu($menuVars);
					echo add_class_first_item($main_menu);
					?>
					<!-- / Navigation -->
				<?php else:?>
					<!-- Navigation -->
					<?php            
					//call the main menu
					$menuVars = array(
						'menu'            => 'RT Theme Main Navigation Menu',  
						'menu_id'         => $menu_style,
						'menu_class'      => $underlines,
						'echo'            => false,
						'container'       => '', 
						'container_class' => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'container_id'    => '',
						'walker' => new Menu_Class_Walker,
						'theme_location'  => 'rt-theme-main-navigation' 
					);
					
					$main_menu=wp_nav_menu($menuVars);
					echo add_class_first_item($main_menu);
					?>
					<!-- / Navigation -->
				<?php endif;?>
		
			</div></nav>
			<!-- / navigation  -->

			<?php if(get_option(THEMESLUG.'_show_flags')):?>
				<!-- / flags -->	
				    <?php if(function_exists('icl_get_languages')){ languages_list(); } ?>		  
				<!-- / flags -->
			<?php endif;?>
			
		</header></div>
		<!-- /header -->

	</div>
	<!-- /row -->	
	

	<?php if(!is_front_page()):?>
		<div class="border-line margin-b10"></div>
	<?php else:?>
		<div class="border-line margin-t10 margin-b30"></div>
	<?php endif;?> 
	 
			