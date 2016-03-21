<?php
/*
Plugin Name: Berkeley Engineering Widgets
Description: Creates custom widgets for the Berkeley Engineering sites.
Author: Stephanie Leary
Version: 1.3
Author URI: http://stephanieleary.com
Text Domain: beng
*/

// initialize all custom widgets
function berkeley_widgets_init() {
	register_widget( 'WP_Nav_Menu_Dropdown_Widget' );
	register_widget( 'Berkeley_Calendar_XML_Widget' );
	register_widget( 'Berkeley_Taxonomy_List_Widget' );
	register_widget( 'Berkeley_Term_Posts_Widget' );
}

add_action( 'widgets_init', 'berkeley_widgets_init' );

add_action( 'admin_head', 'berkeley_widgets_scripts' );

function berkeley_widgets_scripts() {
	$screen = get_current_screen();
	if ( $screen->id !== "widgets" )
		return;
	wp_enqueue_script( 'populate-taxonomy-terms', plugins_url( '/js/populate-terms.js', __FILE__ ), 'jquery' );
	wp_localize_script( 'populate-taxonomy-terms', 'taxonomyTerms', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}

include( 'inc/calendar-feed.php' );
include( 'inc/menu-select.php' );
include( 'inc/posts-by-term.php' );
include( 'inc/taxonomy-list.php' );