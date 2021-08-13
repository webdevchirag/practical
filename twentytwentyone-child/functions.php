<?php

function library_post_type()
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

        register_post_type( 'Book', $args );

        register_taxonomy(
        'author',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'book',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Author', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'themes',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            )
        )
    );
        register_taxonomy(
        'publisher',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'book',             // post type name
        array(
            'hierarchical' => true,
            'label' => 'Publisher', // display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'themes',    // This controls the base slug that will display before each term
                'with_front' => false  // Don't display the category base before
            )
        )
    );
	}
    add_action('init','library_post_type');


    function prefix_teammembers_metaboxes( ) {
   global $wp_meta_boxes;
   add_meta_box('Books', __('Function'), 'prefix_teammembers_metaboxes_html', 'prefix_teammembers', 'normal', 'high');
}
add_action( 'add_meta_boxes_prefix-teammembers', 'prefix_teammembers_metaboxes' );


function prefix_teammembers_metaboxes_html()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $function = isset($custom["function"][0])?$custom["function"][0]:'';
?>
    <label>Function:</label><input name="function" value="<?php echo $function; ?>">
<?php
}


function prefix_teammembers_save_post()
{
    if(empty($_POST)) return; //why is prefix_teammembers_save_post triggered by add new? 
    global $post;
    update_post_meta($post->ID, "function", $_POST["function"]);
}   

add_action( 'save_post_prefix-teammembers', 'prefix_teammembers_save_post' );   

