<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ENQUEUE/STYLES.PHP
// -----------------------------------------------------------------------------
// Enqueue all styles for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register and Enqueue Site Styles
//   02. Register and Enqueue Post Meta Styles
//   03. Register and Enqueue Customizer Styles
//   04. Register and Enqueue Visual Composer Styles
//   05. Deregister WooCommerce Styles
//   06. Deregister Contact Form 7 Styles
// =============================================================================

// Register and Enqueue Site Styles
// =============================================================================

//
// Register and enqueue all styles for the site with the exception of custom
// output generated by the Customizer.
//

if ( ! function_exists( 'x_enqueue_site_styles' ) ) :
  function x_enqueue_site_styles() {

    //
    // Stack data.
    //

    $get_stylesheet_directory_uri = get_stylesheet_directory_uri();
    $get_template_directory_uri   = get_template_directory_uri();
    $stack                        = x_get_stack();
    $design                       = x_get_option( 'x_integrity_design', 'light' );

    if ( $stack == 'integrity' && $design == 'light' ) {
      $ext = '-light';
    } elseif ( $stack == 'integrity' && $design == 'dark' ) {
      $ext = '-dark';
    } else {
      $ext = '';
    }


    //
    // Font data.
    //

    $body_font_family_query         = x_get_font_family_query( x_get_option( 'x_body_font_family', 'Lato' ) );
    $body_font_weight_and_style     = x_get_option( 'x_body_font_weight', '400' );
    $body_font_weight               = x_get_font_weight( $body_font_weight_and_style );

    $headings_font_family_query     = x_get_font_family_query( x_get_option( 'x_headings_font_family', 'Lato' ) );
    $headings_font_weight_and_style = x_get_option( 'x_headings_font_weight', '400' );
    $headings_font_weight           = x_get_font_weight( $headings_font_weight_and_style );

    $logo_font_family_query         = x_get_font_family_query( x_get_option( 'x_logo_font_family', 'Lato' ) );
    $logo_font_weight_and_style     = x_get_option( 'x_logo_font_weight', '400' );
    $logo_font_weight               = x_get_font_weight( $logo_font_weight_and_style );

    $navbar_font_family_query       = x_get_font_family_query( x_get_option( 'x_navbar_font_family', 'Lato' ) );
    $navbar_font_weight_and_style   = x_get_option( 'x_navbar_font_weight', '400' );
    $navbar_font_weight             = x_get_font_weight( $navbar_font_weight_and_style );

    $subsets                        = 'latin,latin-ext';

    if ( x_get_option( 'x_custom_font_subsets', 0 ) == 1 ) {
      if ( x_get_option( 'x_custom_font_subset_cyrillic', 0 ) == 1   ) { $subsets .= ',cyrillic,cyrillic-ext'; }
      if ( x_get_option( 'x_custom_font_subset_greek', 0 ) == 1      ) { $subsets .= ',greek,greek-ext'; }
      if ( x_get_option( 'x_custom_font_subset_vietnamese', 0 ) == 1 ) { $subsets .= ',vietnamese'; }
    }

    $custom_font_args   = array(
      'family' => $body_font_family_query . ':' . $body_font_weight . ',' . $body_font_weight . 'italic,700,700italic|' . $navbar_font_family_query . ':' . $navbar_font_weight_and_style . '|' . $headings_font_family_query . ':' . $headings_font_weight_and_style . '|' . $logo_font_family_query . ':' . $logo_font_weight_and_style,
      'subset' => $subsets
    );

    $standard_font_args = array(
      'family' => 'Lato:' . $body_font_weight . ',' . $body_font_weight . 'italic,' . $navbar_font_weight_and_style . ',' . $headings_font_weight_and_style . ',' . $logo_font_weight_and_style . ',700,700italic',
      'subset' => $subsets
    );

    $get_custom_font_family   = add_query_arg( $custom_font_args,   '//fonts.googleapis.com/css' );
    $get_standard_font_family = add_query_arg( $standard_font_args, '//fonts.googleapis.com/css' );


    //
    // Enqueue styles.
    //

    if ( is_child_theme() ) {
      wp_enqueue_style( 'x-stack', $get_stylesheet_directory_uri . '/style.css', NULL, NULL, 'all' );
    } else {
      wp_enqueue_style( 'x-stack', $get_stylesheet_directory_uri . '/framework/css/site/stacks/' . $stack . $ext . '.css', NULL, NULL, 'all' );
    }

    if ( is_rtl() ) {
      wp_enqueue_style( 'x-rtl', $get_template_directory_uri . '/framework/css/site/rtl/' . $stack . '.css', NULL, NULL, 'all' );
    }

    if ( class_exists( 'WC_API' ) ) {
      wp_enqueue_style( 'x-woocommerce', $get_template_directory_uri . '/framework/css/site/woocommerce/' . $stack . $ext . '.css', NULL, NULL, 'all' );
    }

    if ( class_exists( 'GFForms' ) ) {
      wp_enqueue_style( 'x-gravity-forms', $get_template_directory_uri . '/framework/css/site/gravity_forms/' . $stack . $ext . '.css', NULL, NULL, 'all' );
    }

    if ( x_get_option( 'x_custom_fonts', 0 ) == 1 ) {
      wp_enqueue_style( 'x-font-custom', $get_custom_font_family, NULL, NULL, 'all' );
    } else {
      wp_enqueue_style( 'x-font-standard', $get_standard_font_family, NULL, NULL, 'all' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'x_enqueue_site_styles' );
endif;



// Register and Enqueue Post Meta Styles
// =============================================================================

if ( ! function_exists( 'x_enqueue_post_meta_styles' ) ) :
  function x_enqueue_post_meta_styles() {

    $get_template_directory_uri = get_template_directory_uri();

    wp_enqueue_style( 'x-meta-css',     $get_template_directory_uri . '/framework/css/admin/meta.css',     NULL, NULL, 'all' );
    wp_enqueue_style( 'x-sidebars-css', $get_template_directory_uri . '/framework/css/admin/sidebars.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'wp-color-picker' );

  }
  add_action( 'admin_enqueue_scripts', 'x_enqueue_post_meta_styles' );
endif;



// Register and Enqueue Customizer Styles
// =============================================================================

if ( ! function_exists( 'x_enqueue_customizer_controls_styles' ) ) :
  function x_enqueue_customizer_controls_styles() {

    wp_enqueue_style( 'x-customizer-controls',  get_template_directory_uri() . '/framework/css/admin/customizer-controls.css', NULL, NULL, 'all' );

  }
  add_action( 'customize_controls_print_styles', 'x_enqueue_customizer_controls_styles' );
endif;



// Register and Enqueue Visual Composer Styles
// =============================================================================

if ( class_exists( 'WPBakeryVisualComposer' ) ) :
  if ( ! function_exists( 'x_enqueue_visual_composer_styles' ) ) :
    function x_enqueue_visual_composer_styles() {

      wp_enqueue_style( 'x-visual-composer', get_template_directory_uri() . '/framework/css/admin/visual-composer.css', NULL, NULL, 'all' );

    }
    add_action( 'admin_enqueue_scripts', 'x_enqueue_visual_composer_styles' );
  endif;
endif;



// Deregister WooCommerce Styles
// =============================================================================

if ( class_exists( 'WC_API' ) ) :
  if ( ! function_exists( 'x_deregister_woocommerce_styles' ) ) :
    function x_deregister_woocommerce_styles() {

      wp_deregister_style( 'woocommerce-layout' );
      wp_deregister_style( 'woocommerce-general' );
      wp_deregister_style( 'woocommerce-smallscreen' );

    }
    add_action( 'wp_enqueue_scripts', 'x_deregister_woocommerce_styles' );
  endif;
endif;



// Deregister Contact Form 7 Styles
// =============================================================================
 
if ( class_exists( 'WPCF7_ContactForm' ) ) :
  if ( ! function_exists( 'x_deregister_contact_form_7_styles' ) ) :
    function x_deregister_contact_form_7_styles() {

      wp_deregister_style( 'contact-form-7' );

    }
    add_action( 'wp_enqueue_scripts', 'x_deregister_contact_form_7_styles' );
  endif;
endif;