<?php
/*
Plugin Name: If Menu
Plugin URI: http://morewp.net/plugin/if-menu
Description: Show/hide menu items with conditional statements
Version: 0.1
Author: More WordPress
Author URI: http://morewp.net
License: GPL2
*/

/*  Copyright 2012 More WordPress (email: hello@morewp.net)

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


class If_Menu {

	protected static $has_custom_walker = null;

	public static function init() {
		self::$has_custom_walker = 'Walker_Nav_Menu_Edit' !== apply_filters( 'wp_edit_nav_menu_walker', 'Walker_Nav_Menu_Edit' );

		if( is_admin() && ! self::$has_custom_walker ) {
			add_action( 'admin_init', 'If_Menu::admin_init' );
			add_action( 'wp_update_nav_menu_item', 'If_Menu::wp_update_nav_menu_item', 10, 2 );
			add_filter( 'wp_edit_nav_menu_walker', create_function( '', 'return "If_Menu_Walker_Nav_Menu_Edit";' ) );
		} elseif( is_admin() && self::$has_custom_walker ) {
			add_action( 'admin_notices', 'If_Menu::admin_notices' );
		} elseif( ! is_admin() && ! self::$has_custom_walker ) {
			add_filter( 'wp_get_nav_menu_items', 'If_Menu::wp_get_nav_menu_items' );
		}
	}

	public static function admin_notices() {
		global $pagenow;
		if( current_user_can( 'edit_theme_options' ) && ( $pagenow == 'plugins.php' || $pagenow == 'nav-menus.php' ) ) {
			echo '<div class="updated"><p>' . __( '<b>If Menu</b> plugin detected another plugin(s) that modify the menus, and to don\'t break them <b>If Menu</b> plugin is disabled.', 'if-menu' ) . '</p></div>';
		}
	}

	public static function get_conditions( $for_testing = false ) {
		$conditions = apply_filters( 'if_menu_conditions', array() );

		if( $for_testing ) {
			$c2 = array();
			foreach( $conditions as $condition ) $c2[$condition['name']] = $condition;
			$conditions = $c2;
		}

		return $conditions;
	}

	public static function wp_get_nav_menu_items( $items ) {
		$conditions = If_Menu::get_conditions( $for_testing = true );
		$hidden_items = array();

		foreach( $items as $key => $item ) {
			if( in_array( $item->menu_item_parent, $hidden_items ) ) {
				unset( $items[$key] );
				$hidden_items[] = $item->ID;
			} elseif( get_post_meta( $item->ID, 'if_menu_enable', true ) ) {
				$condition_type = get_post_meta( $item->ID, 'if_menu_condition_type', true );
				$condition = get_post_meta( $item->ID, 'if_menu_condition', true );

				$condition_result = call_user_func( $conditions[$condition]['condition'] );
				if( $condition_type == 'show' ) $condition_result = ! $condition_result;

				if( $condition_result ) {
					unset( $items[$key] );
					$hidden_items[] = $item->ID;
				}
			}
		}

		return $items;
	}

	public static function admin_init() {
		global $pagenow;
		if( $pagenow == 'nav-menus.php' ) {
			wp_enqueue_script( 'if-menu-js', plugins_url( 'if-menu.js' , __FILE__ ), array( 'jquery' ) );
		}
	}

	public static function edit_menu_item_settings( $item ) {
		$conditions = If_Menu::get_conditions();
		$if_menu_enable = get_post_meta( $item->ID, 'if_menu_enable', true );
		$if_menu_condition_type = get_post_meta( $item->ID, 'if_menu_condition_type', true );
		$if_menu_condition = get_post_meta( $item->ID, 'if_menu_condition', true );
		ob_start();
		?>

		<p class="if-menu-enable description description-wide">
			<label>
				<input <?php checked( $if_menu_enable, 1 ) ?> type="checkbox" value="1" class="menu-item-if-menu-enable" name="menu-item-if-menu-enable[<?php echo $item->ID; ?>]" />
				<?php _e( 'Enable Conditional Logic', 'if-menu' ) ?>
			</label>
		</p>

		<p class="if-menu-condition description description-wide">
			<select id="edit-menu-item-if-menu-condition-type-<?php echo $item->ID; ?>" name="menu-item-if-menu-condition-type[<?php echo $item->ID; ?>]">
				<option <?php selected( 'show', $if_menu_condition_type ) ?> value="show"><?php _e( 'Show', 'if-menu' ) ?></option>
				<option <?php selected( 'hide', $if_menu_condition_type ) ?> value="hide"><?php _e( 'Hide', 'if-menu' ) ?></option>
			</select>
			<?php _e('if', 'if-menu'); ?>
			<select id="edit-menu-item-if-menu-condition-<?php echo $item->ID; ?>" name="menu-item-if-menu-condition[<?php echo $item->ID; ?>]">
				<?php foreach( $conditions as $condition ): ?>
					<option <?php selected( $condition['name'], $if_menu_condition ) ?>><?php echo $condition['name']; ?></option>
				<?php endforeach ?>
			</select>
		</p>

		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function wp_update_nav_menu_item( $menu_id, $menu_item_db_id ) {
		$if_menu_enable = isset( $_POST['menu-item-if-menu-enable'][$menu_item_db_id] ) && $_POST['menu-item-if-menu-enable'][$menu_item_db_id] == 1;
		update_post_meta( $menu_item_db_id, 'if_menu_enable', $if_menu_enable ? 1 : 0 );

		if( $if_menu_enable ) {
			update_post_meta( $menu_item_db_id, 'if_menu_condition_type', $_POST['menu-item-if-menu-condition-type'][$menu_item_db_id] );
			update_post_meta( $menu_item_db_id, 'if_menu_condition', $_POST['menu-item-if-menu-condition'][$menu_item_db_id] );
		}
	}

}



/* ------------------------------------------------
	Custom Walker for nav items
------------------------------------------------ */

require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

class If_Menu_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

	function start_el(&$output, $item, $depth, $args) {
		$desc_snipp = '<div class="menu-item-actions description-wide submitbox">';
		parent::start_el($output, $item, $depth, $args);

		$pos = strrpos( $output, $desc_snipp );
		if( $pos !== false ) {
			$output = substr_replace($output, If_Menu::edit_menu_item_settings( $item ) . $desc_snipp, $pos, strlen( $desc_snipp ) );
		}
	}

}



/* ------------------------------------------------
	Include default conditions for menu items
------------------------------------------------ */

include 'conditions.php';



/* ------------------------------------------------
	Run the plugin
------------------------------------------------ */

add_action( 'init', 'If_Menu::init' );
