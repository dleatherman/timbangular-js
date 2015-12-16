<?php

/*
  :: Requires
    :: Timber
    :: Admin Modifications
    :: Timber Routes
  :: Theme Init
    :: Enqueue Scripts & Styles
    :: Timber Helpers
      :: Body Class
      :: Add Menu to Context
  :: Advanced Custom Fields
    :: Hide ACF menu
*/

require_once('lib/timber/timber.php');
require_once('functions/admin.php');

//  ================
//  :: Theme Init
//  ================

remove_action('wp_head', 'rel_canonical');

add_action( 'init', 'theme_setup' );
function theme_setup() {
  add_theme_support( 'post-thumbnails' );
}

// :: Enqueue Scripts & Styles
function enqueue_scripts_and_styles() {

  wp_deregister_script('jquery');

}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );

//  ================
//  :: Timber Helpers
//  ================

// :: Body Class
add_filter( 'body_class', 'add_slug_body_class' );
function add_slug_body_class( $classes ) {
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_name;
  }
  return $classes;
}

// :: Add to Timber Context
add_filter('timber_context', 'add_to_context');
function add_to_context($data){
  global $post;
  // Menus
  $data['primary_menu'] = new TimberMenu('primary');
  return $data;
}

//  ================
//  :: Advanced Custom Fields
//  ================

add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path( $path ) {

    $path = get_stylesheet_directory() . '/lib/acf/';
    return $path;

}

add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/lib/acf/';
    return $dir;
}

// 3. Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');

include_once( get_stylesheet_directory() . '/lib/acf/acf.php' );

 ?>