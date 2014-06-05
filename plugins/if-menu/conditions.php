<?php

add_filter( 'if_menu_conditions', 'if_menu_basic_conditions' );

function if_menu_basic_conditions( $conditions ) {
	
	$conditions[] = array(
		'name'		=>	__( 'User is logged in', 'if-menu' ),
		'condition'	=>	'is_user_logged_in'
	);

	$conditions[] = array(
		'name'		=>	__( 'User is Admin', 'if-menu' ),
		'condition'	=>	'if_menu_basic_condition_admin'
	);

	$conditions[] = array(
		'name'		=>	__( 'User is Editor', 'if-menu' ),
		'condition'	=>	'if_menu_basic_condition_editor'
	);

	$conditions[] = array(
		'name'		=>	__( 'User is Subscriber', 'if-menu' ),
		'condition'	=>	'if_menu_basic_condition_subscriber'
	);

	$conditions[] = array(
		'name'		=>	__( 'User is Author', 'if-menu' ),
		'condition'	=>	'if_menu_basic_condition_author'
	);

	$conditions[] = array(
		'name'		=>	__( 'User is Contributor', 'if-menu' ),
		'condition'	=>	'if_menu_basic_condition_contributor'
	);

	$conditions[] = array(
		'name'		=>	__( 'Front Page', 'if-menu' ),
		'condition'	=>	'is_front_page'
	);

	$conditions[] = array(
		'name'		=>	__( 'Single Post', 'if-menu' ),
		'condition'	=>	'is_single'
	);

	$conditions[] = array(
		'name'		=>	__( 'Page', 'if-menu' ),
		'condition'	=>	'is_page'
	);

	return $conditions;
}

function if_menu_basic_condition_admin() {
	global $current_user;
	if( is_user_logged_in() ) return in_array( 'administrator', $current_user->roles );
	return false;
}

function if_menu_basic_condition_editor() {
	global $current_user;
	if( is_user_logged_in() ) foreach( array( 'administrator', 'editor' ) as $role ) if( in_array( $role, $current_user->roles ) ) return true;
	return false;
}

function if_menu_basic_condition_author() {
	global $current_user;
	if( is_user_logged_in() ) foreach( array( 'administrator', 'editor', 'author' ) as $role ) if( in_array( $role, $current_user->roles ) ) return true;
	return false;
}

function if_menu_basic_condition_contributor() {
	global $current_user;
	if( is_user_logged_in() ) foreach( array( 'administrator', 'editor', 'author', 'contributor' ) as $role ) if( in_array( $role, $current_user->roles ) ) return true;
	return false;
}

function if_menu_basic_condition_subscriber() {
	global $current_user;
	if( is_user_logged_in() ) foreach( array( 'administrator', 'editor', 'author', 'contributor', 'subscriber' ) as $role ) if( in_array( $role, $current_user->roles ) ) return true;
	return false;
}
