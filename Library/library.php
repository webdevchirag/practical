<?php 

/*
Plugin Name: Library Book Search
Description: Library Book Search Plugin
Version: 0.0.1
Author: admin
Text Domain: wplibrary
*/


class custom_library {
	public static function __constructer(){
		add_action('init',array('custom_library','library_post_type'));
	}
	public static function library_post_type()
	{
	    $labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'wplibrary' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'wplibrary' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'wplibrary' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'wplibrary' ),
        'add_new'               => __( 'Add New', 'wplibrary' ),
        'add_new_item'          => __( 'Add New Book', 'wplibrary' ),
        'new_item'              => __( 'New Book', 'wplibrary' ),
        'edit_item'             => __( 'Edit Book', 'wplibrary' ),
        'view_item'             => __( 'View Book', 'wplibrary' ),
	    );
	    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
	    register_post_type( 'book', $args );
	}
}
