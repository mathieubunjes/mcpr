<?php

// =============================================================================
// FUNCTIONS/GLOBAL/BREADCRUMBS.PHP
// -----------------------------------------------------------------------------
// Sets up the breadcrumb navigation for the theme.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Breadcrumbs
// =============================================================================

// Breadcrumbs
// =============================================================================

if ( ! function_exists( 'x_breadcrumbs' ) ) :
  function x_breadcrumbs() {

    if ( x_get_option( 'x_breadcrumb_display', 1 ) ) {

      GLOBAL $post;

      $is_ltr         = ! is_rtl();
      $stack          = x_get_stack();
      $delimiter      = ' <span class="delimiter"><i class="x-icon-angle-' . ( ( $is_ltr ) ? 'right' : 'left' ) . '"></i></span> ';
      $home_text      = '<span class="home"><i class="x-icon-home"></i></span>';
      $home_link      = home_url();
      $current_before = '<span class="current">';
      $current_after  = '</span>';
      $page_title     = get_the_title();
      $blog_title     = get_the_title( get_option( 'page_for_posts', true ) );
      $post_parent    = $post->post_parent;

      if ( function_exists( 'woocommerce_get_page_id' ) ) {
        $shop_url   = x_get_shop_link();
        $shop_title = x_get_option( 'x_' . $stack . '_shop_title', __( 'The Shop', '__x__' ) );
        $shop_link  = '<a href="'. $shop_url .'">' . $shop_title . '</a>';
      }

      echo '<div class="x-breadcrumbs"><a href="' . $home_link . '">' . $home_text . '</a>' . $delimiter;

        if ( is_home() ) {

          echo $current_before . $blog_title . $current_after;

        } elseif ( is_category() ) {

          $the_cat = get_category( get_query_var( 'cat' ), false );
          if ( $the_cat->parent != 0 ) echo get_category_parents( $the_cat->parent, TRUE, $delimiter );
          echo $current_before . single_cat_title( '', false ) . $current_after;

        } elseif ( x_is_product_category() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . single_cat_title( '', false ) . $current_after;
          } else {
            echo $current_before . single_cat_title( '', false ) . $current_after . $delimiter . $shop_link;
          }

        } elseif ( x_is_product_tag() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . single_tag_title( '', false ) . $current_after;
          } else {
            echo $current_before . single_tag_title( '', false ) . $current_after . $delimiter . $shop_link;
          }

        } elseif ( is_search() ) {

          echo $current_before . __( 'Search Results for ', '__x__' ) . '&#8220;' . get_search_query() . '&#8221;' . $current_after;

        } elseif ( is_singular( 'post' ) ) {

          if ( get_option( 'page_for_posts' ) == is_front_page() ) {
            echo $current_before . $page_title . $current_after;
          } else {
            if ( $is_ltr ) {
              echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="' . esc_attr( __( 'See All Posts', '__x__' ) ) . '">' . $blog_title . '</a>' . $delimiter . $current_before . $page_title . $current_after;
            } else {
              echo $current_before . $page_title . $current_after . $delimiter . '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title="' . esc_attr( __( 'See All Posts', '__x__' ) ) . '">' . $blog_title . '</a>';
            }
          }

        } elseif ( x_is_portfolio() ) {

          echo $current_before . get_the_title() . $current_after;

        } elseif ( x_is_portfolio_item() ) {

          $link  = x_get_parent_portfolio_link();
          $title = x_get_parent_portfolio_title();

          if ( $is_ltr ) {
            echo '<a href="' . $link . '" title="' . esc_attr( __( 'See All Posts', '__x__' ) ) . '">' . $title . '</a>' . $delimiter . $current_before . $page_title . $current_after;
          } else {
            echo $current_before . $page_title . $current_after . $delimiter . '<a href="' . $link . '" title="' . esc_attr( __( 'See All Posts', '__x__' ) ) . '">' . $title . '</a>';
          }

        } elseif ( x_is_product() ) {

          if ( $is_ltr ) {
            echo $shop_link . $delimiter . $current_before . $page_title . $current_after;
          } else {
            echo $current_before . $page_title . $current_after . $delimiter . $shop_link;
          }

        } elseif ( is_page() && ! $post_parent ) {

          echo $current_before . $page_title . $current_after;

        } elseif ( is_page() && $post_parent ) {

          $parent_id   = $post_parent;
          $breadcrumbs = array();

          if ( is_rtl() ) {
            echo $current_before . $page_title . $current_after . $delimiter;
          }

          while ( $parent_id ) {
            $page          = get_page( $parent_id );
            $breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
            $parent_id     = $page->post_parent;
          }

          if ( $is_ltr ) {
            $breadcrumbs = array_reverse( $breadcrumbs );
          }

          for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
            echo $breadcrumbs[$i];
            if ( $i != count( $breadcrumbs ) -1 ) echo $delimiter;
          }

          if ( $is_ltr ) {
            echo $delimiter . $current_before . $page_title . $current_after;
          }

        } elseif ( is_tag() ) {

          echo $current_before . single_tag_title( '', false ) . $current_after;

        } elseif ( is_author() ) {

          GLOBAL $author;
          $userdata = get_userdata( $author );
          echo $current_before . __( 'Posts by ', '__x__' ) . '&#8220;' . $userdata->display_name . $current_after . '&#8221;';

        } elseif ( is_404() ) {

          echo $current_before . __( '404 (Page Not Found)', '__x__' ) . $current_after;

        } elseif ( is_archive() ) {

          if ( x_is_shop() ) {
            echo $current_before . $shop_title . $current_after;
          } else {
            echo $current_before . __( 'Archives ', '__x__' ) . $current_after;
          }

        }

      echo '</div>';

    }

  }
endif;