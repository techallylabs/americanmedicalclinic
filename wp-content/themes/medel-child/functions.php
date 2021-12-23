<?php 

/**
 * Enqueue child scripts and styles.
 */
function medel_child_scripts() {
	wp_enqueue_script( 'medel-child-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'medel_child_scripts', 202 );