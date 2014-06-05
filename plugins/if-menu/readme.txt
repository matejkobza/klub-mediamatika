=== Plugin Name ===
Contributors: andrei.igna
Tags: menu, if, conditional, statements, hide, show, dispaly
Requires at least: 3.0.0
Tested up to: 3.4
Stable tag: trunk
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show/hide menu items with conditional statements

== Description ==

Simple plugin that adds extra functionality to Menu Items. The plugin will allow to show or hide menu items based on condition statements (Is single page, User is Logged In, etc).

The management is very easy, each menu item will have a "Enable Conditional Logic" check, that will allow to select a conditional statement (Example in Screenshots)

Basic conditional statements are included in the plugin, other will be included in future releases or can be added nu another plugin or theme.

Example of adding a new conditional statement is described in the FAQ section

== Installation ==

To install the plugin, follow the steps below

1. Upload `if-menu` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enable conditional statements for your Menu Items in Appearance -> Menus page

== Frequently Asked Questions ==

= How can I add a conditinal statement =

New conditional statements can be added by any other plugin or theme.

Example of adding a new conditional statement

``
add_filter( 'if_menu_conditions', 'my_new_menu_conditions' );

function my_new_menu_conditions( $conditions ) {	
	$conditions[] = array(
		'name'		=>	'If single custom-post-type',	// name of the condition
		'condition'	=>	function() {					// callback - must return TRUE or FALSE
			return is_singular( 'my-custom-post-type' );
		}
	);
}
``

== Screenshots ==

1. Enable conditional statements for Menu Items

== Changelog ==

= 0.1 =
Plugin release. Included basic menu conditional statements
