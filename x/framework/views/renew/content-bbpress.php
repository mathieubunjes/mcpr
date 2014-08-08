<?php

// =============================================================================
// VIEWS/RENEW/CONTENT-BBPRESS.PHP
// -----------------------------------------------------------------------------
// bbPress output for Renew.
// =============================================================================

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-wrap">
    <?php x_get_view( 'global', '_content', 'the-content' ); ?>
  </div>
</article>