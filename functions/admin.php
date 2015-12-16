<?php
/*
    :: Login logo link
    :: Disable Auto Save
    :: Remove W from Admin Bar
*/

// add_editor_style('editor-style.css');

//*-------------------------
// :: Login Logo Link
/*--------------------------*///

add_action('login_head', 'my_login_head');
function my_login_head() {
  echo "
  <style>
  body.login #login h1 a {
    background: url('".get_bloginfo('template_url')."/images/favicon.png') no-repeat scroll center top transparent;
  }
  </style>
  ";
}
function loginpage_custom_link() {
  return get_bloginfo( 'wpurl' );
}
add_filter('login_headerurl','loginpage_custom_link');
function change_title_on_logo() {
  return 'Above Average';
}
add_filter('login_headertitle', 'change_title_on_logo');


//*-------------------------
// :: Disable Auto Save
/*--------------------------*///

function disableAutoSave(){
    wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disableAutoSave' );

function checkboxes_to_radio_buttons_show_categories_taxonomy( $args ) {
    if ( ! empty( $args['taxonomy'] ) && ($args['taxonomy'] === 'series') /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, $args = array() ) {
                        $output = parent::walk( $elements, $max_depth, $args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

//*-------------------------
// :: Remove W from Admin Bar
/*--------------------------*///

function admin_bar_remove() {
  global $wp_admin_bar;

  /* Remove their stuff */
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove', 0);


//*-------------------------
// :: Enable JS API for YouTube embeds
/*--------------------------*///

add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  if (strstr($html, 'youtube.com/embed/')) {
    $html = str_replace('?feature=oembed', '?feature=oembed&amp;enablejsapi=1', $html);
  }
  return $html;
}

?>