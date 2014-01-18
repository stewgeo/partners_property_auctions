=== Confirm Publish ===
Contributors: jjeaton
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JKWPDXGYLASCY
Tags: posts, confirmation, publish, submit, admin, author
Requires at least: 3.0.1
Tested up to: 3.4.2
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Confirms whether you really want to publish the post to prevent accidental publishing.

== Description ==

Confirms whether you really want to publish the post to prevent accidental publishing. Works on the post.php and post-new.php pages.

Only confirms when the post status doesn't equal 'publish', updates and deletions aren't affected. There are no plugin options, this is just a stop-gap measure to help prevent accidentally publishing posts and having them go to RSS and Twitter.

== Installation ==

1. Upload `confirm-publish.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Enjoy the extra reminder to not accidentally publish a post!

== Frequently Asked Questions ==

= Are there any options in this plugin? =

Not at this time.

== Changelog ==

= 0.1 =
Initial plugin version. Prevents accidental publishing on post edit page when post has not yet been published.