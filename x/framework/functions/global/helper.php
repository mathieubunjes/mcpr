<?php

// =============================================================================
// FUNCTIONS/GLOBAL/HELPER.PHP
// -----------------------------------------------------------------------------
// Helper functions for various tasks.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Get Featured Image URL
//   02. Return an Array of Integer Values from String
//   03. Make Protocol Relative
// =============================================================================

// Get Featured Image URL
// =============================================================================

if ( ! function_exists( 'x_get_featured_image_url' ) ) :
  function x_get_featured_image_url( $size = 'full' ) {

    $featured_image     = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
    $featured_image_url = $featured_image[0];

    return $featured_image_url;

  }
endif;



// Return an Array of Integer Values from String
// =============================================================================

//
// Removes all whitespace from the provided string, separates values delimited
// by comma, and returns an array of integer values.
//

function x_intval_explode( $string ) {

  $output = array_map( 'intval', explode( ',', preg_replace( '/\s+/', '', $string ) ) );

  return $output;

}



// Make Protocol Relative
// =============================================================================

//
// Accepts a string and replaces any instances of "http://" and "https://" with
// the protocol relative "//" instead.
//

function x_make_protocol_relative( $string ) {

  $output = str_replace( array( 'http://', 'https://' ), '//', $string );

  return $output;

}