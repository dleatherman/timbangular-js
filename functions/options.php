<?php
/*
    :: Options Page
*/

//  ================
//  :: Options Page
//  ================

add_action( 'init', 'add_theme_acf_options_page' );
function add_theme_acf_options_page() {
  if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
      'page_title'  => 'Site Settings',
      'menu_title'  => 'Site Settings',
      'menu_slug'   => 'site-settings',
      'capability'  => 'edit_posts',
      'redirect'    => true
    ));

    acf_add_options_sub_page(array(
      'page_title'  => 'Above Average Theme Settings',
      'menu_title'  => 'AA Settings',
      'menu_slug'   => 'aa-features',
      'parent_slug' => 'site-settings'
    ));

    acf_add_options_sub_page(array(
      'page_title'  => 'The Kicker Theme Settings',
      'menu_title'  => 'TK Settings',
      'menu_slug'   => 'tk-features',
      'parent_slug' => 'site-settings'
    ));

  }
}

?>