<?php

// =============================================================================
// VIEWS/ETHOS/WP-BBPRESS.PHP
// -----------------------------------------------------------------------------
// bbPress output for Ethos.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container-fluid max width main">
    <div class="offset cf">
      <div class="<?php x_main_content_class(); ?>" role="main">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php x_get_view( 'ethos', 'content', 'bbpress' ); ?>
        <?php endwhile; ?>

      </div>

      <?php get_sidebar(); ?>

    </div>
  </div>

<?php get_footer(); ?>