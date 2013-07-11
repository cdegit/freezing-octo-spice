<?php
/*
Plugin Name: Works Gallery
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A plugin that allows user to create a fancy gallery of works for a portfolio.
Version: 1.0
Author: Cassandra de Git
Author URI: http://cassandradegit.com
License: GPL3
*/

include 'wg_widget.php';
include 'wg_options.php';

add_action( 'init', 'wg_create_post_type' );
add_action( 'add_meta_boxes', 'wg_add_post_meta_boxes' );
add_action( 'save_post', 'wg_add_works_fields', 10, 2 );
//add_filter( 'single_template', 'wg_single_template' );  
add_filter( 'template_include', 'wg_template_check' );  

function wg_create_post_type() {
	register_post_type( 'works',
		array(
			'labels' => array(
				'name' => __( 'Works' ),
				'singular_name' => __( 'Work' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}

function wg_add_post_meta_boxes() {
    add_meta_box( 'works_meta_box',
        'Works Details',
        'wg_display_works_meta_box',
        'works', 'normal', 'high'
    );
}

function wg_display_works_meta_box( $work ) {
	$year = intval( get_post_meta( $work->ID, 'year', true ) );
    $client = esc_html( get_post_meta( $work->ID, 'client', true ) );
	$role = esc_html( get_post_meta( $work->ID, 'role', true ) );
	$tools = esc_html( get_post_meta( $work->ID, 'tools', true ) );
	$link = esc_html( get_post_meta( $work->ID, 'link', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%"><label for="wg-year">Year</label></td>
            <td><input type="text" size="80" name="wg-year" id="wg-year" value="<?php echo $year; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px"><label for="wg-client">Client</label></td>
            <td>
                <input type="text" size="80" name="wg-client" id="wg-client" value="<?php echo $client; ?>" />
            </td>
        </tr>
		<tr>
            <td style="width: 150px"><label for="wg-role">Role</label></td>
            <td>
                <input type="text" size="80" name="wg-role" id="wg-role" value="<?php echo $role; ?>" />
            </td>
        </tr>
		<tr>
            <td style="width: 150px"><label for="wg-tools">Tools</label></td>
            <td>
                <input type="text" size="80" name="wg-tools" id="wg-tools" value="<?php echo $tools; ?>" />
            </td>
        </tr>
		<tr>
            <td style="width: 150px"><label for="wg-link">Link</label></td>
            <td>
                <input type="text" size="80" name="wg-link" id="wg-link" value="<?php echo $link; ?>" />
            </td>
        </tr>
    </table>
    <?php
   
}

function wg_add_works_fields( $work_id, $work ) {
    // Check post type for movie reviews
    if ( $work->post_type == 'works' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['year'] ) && $_POST['year'] != '' ) {
            update_post_meta( $work_id, 'year', $_POST['year'] );
        }
        if ( isset( $_POST['client'] ) && $_POST['client'] != '' ) {
            update_post_meta( $work_id, 'client', $_POST['client'] );
        }
		if ( isset( $_POST['role'] ) && $_POST['role'] != '' ) {
            update_post_meta( $work_id, 'role', $_POST['role'] );
        }
		if ( isset( $_POST['tools'] ) && $_POST['tools'] != '' ) {
            update_post_meta( $work_id, 'tools', $_POST['tools'] );
        }
		if ( isset( $_POST['link'] ) && $_POST['link'] != '' ) {
            update_post_meta( $work_id, 'link', $_POST['link'] );
        }
    }
}

function wg_include_template_function( $template_path ) {
    //if ( get_post_type() == 'works' ) {
        $template_path = plugin_dir_path( __FILE__ ) . '/single-works.php';
    //}
    return $template_path;
}

function wg_template_check( $template_path ) {  
	// check if has widget stuff
    wp_enqueue_script( 'unslider', plugins_url( '/unslider.js' , __FILE__ ), array('jquery') );  
    //wp_enqueue_style( '{unique name for stylesheet}', get_stylesheet_directory_uri() . '{path/to/stylesheet}' );  
  
    return $template_path;  
}  

function register_wg_options_page() {
	add_menu_page( "wg-options", "Works Gallery Options", "manage_options", "Works Gallery", "create_wg_options");
}

add_action( 'admin_menu', 'register_wg_options_page' );
?>