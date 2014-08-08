<?php

// =============================================================================
// FUNCTIONS/GLOBAL/STACK-DATA.PHP
// -----------------------------------------------------------------------------
// Get stack information.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get View
//   02. Get Option
//   03. Get Stack
//   04. Get Site Layout
//   05. Get Content Layout
// =============================================================================

// Get View
// =============================================================================

if ( ! function_exists( 'x_get_view' ) ) :
  function x_get_view( $stack, $base, $extension = '' ) {

    $file = $stack . '_' . $base . ( ( empty( $extension ) ) ? '' : '-' . $extension );

    do_action( 'x_before_view_' . $file );

    get_template_part( 'framework/views/' . $stack . '/' . $base, $extension );

    do_action( 'x_after_view_' . $file );

  }
endif;



// Get Option
// =============================================================================

if ( ! function_exists( 'x_get_option' ) ) :
  function x_get_option( $option, $default = false ) {

    $output = get_option( $option, $default );

    return apply_filters( 'x_option_' . $option, $output );

  }
endif;



// Get Stack
// =============================================================================

if ( ! function_exists( 'x_get_stack' ) ) :
  function x_get_stack() {

    return x_get_option( 'x_stack', 'integrity' );

  }
  add_action( 'customize_save', 'x_get_stack' );
endif;



// Get Site Layout
// =============================================================================

if ( ! function_exists( 'x_get_site_layout' ) ) :
  function x_get_site_layout() {

    return x_get_option( 'x_' . x_get_stack() . '_layout_site', 'full-width' );

  }
  add_action( 'customize_save', 'x_get_site_layout' );
endif;



// Get Content Layout
// =============================================================================

//
// First checks if the global content layout is "full-width." If the global
// content layout is not "full-width," (i.e. displays a sidebar) then it runs
// through all possible pages to determine the correct layout for that template.
//

if ( ! function_exists( 'x_get_content_layout' ) ) :
  function x_get_content_layout() {

    $stack          = x_get_stack();
    $content_layout = x_get_option( 'x_' . $stack . '_layout_content', 'content-sidebar' );

    if ( $content_layout != 'full-width' ) {
      if ( is_home() ) {
        $opt    = x_get_option( 'x_blog_layout', 'sidebar' );
        $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
      } elseif ( is_singular( 'post' ) ) {
        $meta   = get_post_meta( get_the_ID(), '_x_post_layout', true );
        $layout = ( $meta == 'on' ) ? 'full-width' : $content_layout;
      } elseif ( x_is_portfolio_item() ) {
        $layout = 'full-width';
      } elseif ( x_is_portfolio() ) {
        $meta   = get_post_meta( get_the_ID(), '_x_portfolio_layout', true );
        $layout = ( $meta == 'sidebar' ) ? $content_layout : $meta;
      } elseif ( is_page_template( 'template-layout-content-sidebar.php' ) ) {
        $layout = 'content-sidebar';
      } elseif ( is_page_template( 'template-layout-sidebar-content.php' ) ) {
        $layout = 'sidebar-content';
      } elseif ( is_page_template( 'template-layout-full-width.php' ) ) {
        $layout = 'full-width';
      } elseif ( is_archive() ) {
        if ( x_is_shop() || x_is_product_category() || x_is_product_tag() ) {
          $opt    = x_get_option( 'x_woocommerce_shop_layout_content', 'sidebar' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        } else {
          $opt    = x_get_option( 'x_archive_layout', 'sidebar' );
          $layout = ( $opt == 'sidebar' ) ? $content_layout : $opt;
        }
      } elseif ( x_is_product() ) {
        $layout = 'full-width';
      } elseif ( is_404() ) {
        $layout = 'full-width';
      } else {
        $layout = $content_layout;
      }
    } else {
      $layout = $content_layout;
    }

    return $layout;

  }
  add_action( 'customize_save', 'x_get_content_layout' );
endif;