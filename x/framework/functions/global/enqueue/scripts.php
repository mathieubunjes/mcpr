<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ENQUEUE/SCRIPTS.PHP
// -----------------------------------------------------------------------------
// Enqueue all scripts for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register and Enqueue Site Scripts
//   02. Register and Enqueue Post Meta Scripts
//   03. Register and Enqueue Customizer Scripts
// =============================================================================

// Register and Enqueue Site Scripts
// =============================================================================

//
// Conditionally adds JavaScript to the footer of the site for improved
// performance and loading time.
//

if ( ! function_exists( 'x_enqueue_site_scripts' ) ) :
  function x_enqueue_site_scripts() {

    $get_template_directory_uri = get_template_directory_uri();

    wp_register_script( 'x-site-head',           $get_template_directory_uri . '/framework/js/dist/site/x-head.min.js',              array( 'jquery' ), NULL, false );
    wp_register_script( 'x-site-body',           $get_template_directory_uri . '/framework/js/dist/site/x-body.min.js',              array( 'jquery' ), NULL, true );
    wp_register_script( 'x-site-icon',           $get_template_directory_uri . '/framework/js/dist/site/x-icon.min.js',              array( 'jquery' ), NULL, true );
    wp_register_script( 'x-customizer-admin-js', $get_template_directory_uri . '/framework/js/dist/admin/x-customizer-admin.min.js', array( 'jquery' ), NULL, true );

    wp_enqueue_script( 'x-site-head' );
    wp_enqueue_script( 'x-site-body' );

    if ( x_get_stack() == 'icon' ) {
      wp_enqueue_script( 'x-site-icon' );
    }

    if ( is_singular() ) {
      wp_enqueue_script( 'comment-reply' );
    }

    if ( is_admin_bar_showing() ) {
      wp_enqueue_script( 'x-customizer-admin-js' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'x_enqueue_site_scripts' );
endif;



// Register and Enqueue Post Meta Scripts
// =============================================================================

if ( ! function_exists( 'x_enqueue_post_meta_scripts' ) ) :
  function x_enqueue_post_meta_scripts( $hook ) {

    GLOBAL $post;

    if ( $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'edit-tags.php' ) {
      return;
    }

    if ( $hook != 'edit-tags.php' ) {

      echo '<script type="text/javascript">'
           . 'var x_ajax = {'
             . 'post_id : 0,'
             . 'nonce : ""'
           . '};'
           . 'x_ajax.nonce = "' . wp_create_nonce( 'x-ajax' ) . '";'
           . 'x_ajax.post_id = "' . $post->ID . '";'
         . '</script>';

      wp_enqueue_script( 'media-upload' );
      wp_enqueue_script( 'thickbox' );

    }

    wp_register_script( 'x-meta-js', get_template_directory_uri() . '/framework/js/dist/admin/x-meta.min.js', array( 'jquery', 'media-upload', 'thickbox' ), NULL, true );
    wp_enqueue_script( 'x-meta-js' );
    wp_enqueue_script( 'wp-color-picker');

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_post_meta_scripts' );
endif;



// Register and Enqueue Customizer Scripts
// =============================================================================

//
// Admin scripts.
//

if ( ! function_exists( 'x_enqueue_customizer_admin_scripts' ) ) :
  function x_enqueue_customizer_admin_scripts() {

    wp_register_script( 'x-customizer-admin-js', get_template_directory_uri() . '/framework/js/dist/admin/x-customizer-admin.min.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'x-customizer-admin-js' );

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_customizer_admin_scripts' );
endif;


//
// Controls scripts.
//

if ( ! function_exists( 'x_enqueue_customizer_controls_scripts' ) ) :
  function x_enqueue_customizer_controls_scripts() {

    wp_register_script( 'x-customizer-controls-js', get_template_directory_uri() . '/framework/js/dist/admin/x-customizer-controls.min.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'x-customizer-controls-js' );

  }
  add_action( 'customize_controls_print_footer_scripts', 'x_enqueue_customizer_controls_scripts' );
endif;


//
// Preview scripts.
//

if ( ! function_exists( 'x_enqueue_customizer_preview_scripts' ) ) :
  function x_enqueue_customizer_preview_scripts() {

    GLOBAL $preview_variables;

    wp_register_script( 'x-customizer-preview-js', get_template_directory_uri() . '/framework/js/dist/admin/x-customizer-preview.min.js', array( 'jquery', 'customize-preview', 'heartbeat' ), NULL, true );
    wp_localize_script( 'x-customizer-preview-js', 'mod', $preview_variables );
    wp_enqueue_script( 'x-customizer-preview-js' );

  }
  add_action( 'customize_preview_init', 'x_enqueue_customizer_preview_scripts' );
endif;