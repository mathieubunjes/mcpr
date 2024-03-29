<?php

// =============================================================================
// VIEWS/GLOBAL/_CONTENT.PHP
// -----------------------------------------------------------------------------
// Display of the_excerpt() or the_content() for various entries.
// =============================================================================

$is_full_post_content_blog = is_home() && x_get_option( 'x_blog_enable_full_post_content', 0 ) == 1;

?>

<?php

if ( is_singular() || $is_full_post_content_blog ) :
  x_get_view( 'global', '_content', 'the-content' );
  if ( x_get_stack() == 'renew' ) :
    x_get_view( 'renew', '_content', 'post-footer' );
  endif;
else :
  x_get_view( 'global', '_content', 'the-excerpt' );
endif;

?>