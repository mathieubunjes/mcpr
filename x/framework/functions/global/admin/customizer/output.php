<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT.PHP
// -----------------------------------------------------------------------------
// Sets up custom output from the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Customizer Options CSS Output
// =============================================================================

// Customizer Options CSS Output
// =============================================================================
 
function x_customizer_options_output_css() {

  $outp_path = get_template_directory() . '/framework/functions/global/admin/customizer/output';

  require_once( $outp_path . '/variables.php' );

  ob_start();

  ?>

  <style id="x-customizer-css-output" type="text/css">

    <?php

    require_once( $outp_path . '/' . $x_stack . '.php' );
    require_once( $outp_path . '/base.php' );
    require_once( $outp_path . '/masthead.php' );
    require_once( $outp_path . '/buttons.php' );
    require_once( $outp_path . '/widgets.php' );
    require_once( $outp_path . '/gravity-forms.php' );

    ?>

  </style>

  <?php

  $css = ob_get_contents(); ob_end_clean();


  //
  // 1. Remove comments.
  // 2. Remove whitespace.
  // 3. Remove starting whitespace.
  //

  $output = preg_replace( '#/\*.*?\*/#s', '', $css );            // 1
  $output = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output ); // 2
  $output = preg_replace( '/\s\s+(.*)/', '$1', $output );        // 3

  echo $output;

}

add_action( 'wp_head', 'x_customizer_options_output_css', 9998, 0 );