<?php
/*
Plugin Name: Confirm Publish
Version: 0.1
Author: Josh Eaton
Author URI: http://www.josheaton.org/
Description: Makes publishing a two-step process. No more accidental posts.
License: GPL2
*/

/*  Copyright 2012  Josh Eaton  (email : josh at josheaton org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Main plugin Class
 *
 * Class that holds all functions for the class
 *
 * @since 0.1
 * @param none
 * @return none
 */
 
if (!class_exists( 'JJEConfirmPublish' )) {

	class JJEConfirmPublish {

		var $hook           = 'jje-confirm-publish';
		var $filename	    = 'confirm-publish/confirm-publish.php';
		var $longname	    = 'Confirm Publish';
		
		/**
		 * JJEConfirmPublish Constructor
		 *
		 * Adds hooks, sets up objects for use
		 *
		 * @since 0.1
		 * @param none
		 * @return instance of JJEConfirmPublish
		 */
		function __construct() {
			add_action( 'admin_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		}
		
		function enqueue_scripts($hook) {
			if ( $hook == 'post-new.php' || $hook == 'post.php') {
				global $post;

				// Only use if the post hasn't been published yet
				if ( $post->post_status != 'publish' ) {
					wp_enqueue_style( 'confirm-publish-css', plugins_url('confirm-publish.css', __FILE__ ), array(), '0.1', 'all' );
					wp_enqueue_script( 'confirm-publish-js', plugins_url('confirm-publish.js', __FILE__ ), array('jquery'), '0.1', true );
				}
			}
		}

	} // class JJEConfirmPublish
	
	// Instantiate RDS class
	$jje_confirm_publish = new JJEConfirmPublish();
} // if !class_exists
?>
