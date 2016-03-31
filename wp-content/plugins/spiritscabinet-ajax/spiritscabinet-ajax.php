<?php 
/**
 * Plugin Name: Spirits Cabinet AJAX
 * Plugin URI: http://spiritscabinet.com
 * Description: This is a custom plugin for Spirits Cabinet that allows for Spirits to be added to the user profile asyncronous using Ajax functionality in WordPress.
 * Version: 0.0.1
 * Author: Johnny Michaelsen
 * Author URI: http://johnnymichaelsen.com.com
 * License: GPL2
 */

//
function spirits_cabinet_ajax() {
	wp_enqueue_script( 'spirits-cabinet-ajax', plugins_url() . '/spiritscabinet-ajax/ajax.js', array('jquery'), '1.0', true );

	wp_localize_script( 'spirits-cabinet-ajax', 'add_spirit', array('ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'spirits_cabinet_ajax' );


//
function add_spirit_add() {

	//$post = $wp_query->post;
	$id = $_POST['post_id']; //get_the_ID(); //$post->ID
	$user_id = get_current_user_id();

	$field_value = get_field('user_spirits_cabinet', 'user_' . $user_id);
	$field_value[] = array('user_spirits_cabinet_id' => $id, 'user_spirits_cabinet_notes' => 'PHP submitted note');

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		update_field( 'user_spirits_cabinet', $field_value, 'user_' . $user_id );
		echo 'Congrats! This spirit has been added to your cabinet.';
	}
	die();
}
// For guests - this should be changed to "sign-up to add things response"
add_action( 'wp_ajax_nopriv_add_spirit_add', 'add_spirit_add' );
// For logged in users
add_action( 'wp_ajax_add_spirit_add', 'add_spirit_add' );



/*
function add_spirit_remove() {

	//$post = $wp_query->post;
	$id = $_POST['post_id']; //get_the_ID(); //$post->ID
	$user_id = get_current_user_id();

	$field_value = get_field('user_spirits_cabinet', 'user_' . $user_id);
	$field_value[] = array('user_spirits_cabinet_id' => $id, 'user_spirits_cabinet_notes' => 'PHP submitted note');
	

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		//update_field( 'user_spirits_cabinet', $field_value, 'user_' . $user_id );
		echo 'Awww';
	}
	
	die();
}
// For guests - this should be changed to "sign-up to add things response"
add_action( 'wp_ajax_nopriv_add_spirit_remove', 'add_spirit_remove' );

// For logged in users
add_action( 'wp_ajax_add_spirit_remove', 'add_spirit_remove' );
*/

