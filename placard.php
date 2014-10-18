<?php
/**
* Plugin Name: Placard
* Description: Ties together a bunch of noize
* Author: Ændrew Rininsland
* Author URI: http://www.aendrew.com
* Version: 1.0.0
* Plugin URI: https://ec2-54-171-79-22.eu-west-1.compute.amazonaws.com
*/

defined( 'ABSPATH' ) OR exit;

add_action( 'plugins_loaded', array( 'Placard', 'init' ) );

class Placard {
	protected static $instance;

	function __construct() {
		add_action( 'init', array( $this, 'register_columns_custom_post_type' ) );
		add_action( 'init', array( $this, 'register_campaign_custom_post_type' ) );

		// Setup defaults
		$this->plugin = new StdClass;
		$this->plugin->title = 'Placard';
		$this->plugin->name = 'placard';
	}

	function register_columns_custom_post_type() {
		$labels = array(
			'name'							 => _x( 'Columns', 'post type general name', $this->plugin->name ),
			'singular_name'			 => _x( 'Columns', 'post type singular name', $this->plugin->name ),
			'menu_name'					 => _x( 'Columns', 'admin menu', $this->plugin->name ),
			'name_admin_bar'		 => _x( 'Column', 'add new on admin bar', $this->plugin->name ),
			'add_new'						 => _x( 'Add New', 'column', $this->plugin->name ),
			'add_new_item'			 => __( 'Add New Column', $this->plugin->name ),
			'new_item'					 => __( 'New Column', $this->plugin->name ),
			'edit_item'					 => __( 'Edit Column', $this->plugin->name ),
			'view_item'					 => __( 'View Column', $this->plugin->name ),
			'all_items'					 => __( 'All Columns', $this->plugin->name ),
			'search_items'			 => __( 'Search Columns', $this->plugin->name ),
			'parent_item_colon'	 => __( 'Parent Columns:', $this->plugin->name ),
			'not_found'					 => __( 'No columns found.', $this->plugin->name ),
			'not_found_in_trash' => __( 'No columns found in Trash.', $this->plugin->name )
		);

		$args = array(
			'labels'						 => $labels,
			'public'						 => true,
			'publicly_queryable' => true,
			'show_ui'					 	 => true,
			'show_in_menu'			 => true,
			'query_var'					 => true,
			'rewrite'						 => array( 'slug' => 'column' ),
			'capability_type'		 => 'post',
			'has_archive'				 => true,
			'hierarchical'			 => false,
			'menu_position'			 => null,
			'supports'					 => array( 'title', 'excerpt'),
			'menu_icon' 		 		 => 'dashicons-hammer',
			// 'taxonomies' 		     => array( 'post_tag' )
		);

		register_post_type( 'column', $args );
	}

	function register_campaign_custom_post_type() {
		$labels = array(
			'name'							 => _x( 'Campaigns', 'post type general name', $this->plugin->name ),
			'singular_name'			 => _x( 'Campaigns', 'post type singular name', $this->plugin->name ),
			'menu_name'					 => _x( 'Campaigns', 'admin menu', $this->plugin->name ),
			'name_admin_bar'		 => _x( 'Campaign', 'add new on admin bar', $this->plugin->name ),
			'add_new'						 => _x( 'Add New', 'campaign', $this->plugin->name ),
			'add_new_item'			 => __( 'Add New Campaign', $this->plugin->name ),
			'new_item'					 => __( 'New Campaign', $this->plugin->name ),
			'edit_item'					 => __( 'Edit Campaign', $this->plugin->name ),
			'view_item'					 => __( 'View Campaign', $this->plugin->name ),
			'all_items'					 => __( 'All Campaigns', $this->plugin->name ),
			'search_items'			 => __( 'Search Campaigns', $this->plugin->name ),
			'parent_item_colon'	 => __( 'Parent Campaigns:', $this->plugin->name ),
			'not_found'					 => __( 'No campaigns found.', $this->plugin->name ),
			'not_found_in_trash' => __( 'No campaigns found in Trash.', $this->plugin->name )
		);

		$args = array(
			'labels'						 => $labels,
			'public'						 => true,
			'publicly_queryable' => true,
			'show_ui'					 	 => true,
			'show_in_menu'			 => true,
			'query_var'					 => true,
			'rewrite'						 => array( 'slug' => 'campaign' ),
			'capability_type'		 => 'post',
			'has_archive'				 => true,
			'hierarchical'			 => false,
			'menu_position'			 => null,
			'supports'					 => array( 'title', 'editor', 'author', 'thumbnail' ),
			'menu_icon' 		 		 => 'dashicons-hammer',
			// 'taxonomies' 		     => array( 'post_tag' )
		);

		register_post_type( 'campaign', $args );
	}

	// Based on: http://wordpress.stackexchange.com/a/25979/1682
	public static function init() {
		is_null( self::$instance ) AND self::$instance = new self;
		return self::$instance;
	}
}
