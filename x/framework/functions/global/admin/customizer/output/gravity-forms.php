<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/GRAVITY-FORMS.PHP
// -----------------------------------------------------------------------------
// Global CSS output for Gravity Forms.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Base Styles
// =============================================================================

?>

/* Base Styles
// ========================================================================== */

<?php if ( $gravity_forms_is_active ) : ?>

  body .gform_wrapper .gfield_required,
  body .gform_wrapper span.ginput_total {
    color: <?php echo $x_site_link_color; ?>;
  }

  body .gform_wrapper h2.gsection_title,
  body .gform_wrapper h3.gform_title {
    font-weight: <?php echo $x_headings_font_weight; ?>;
    letter-spacing: <?php echo $x_headings_letter_spacing . 'px !important'; ?>;
  }

  body .gform_wrapper .top_label .gfield_label,
  body .gform_wrapper .left_label .gfield_label,
  body .gform_wrapper .right_label .gfield_label {
    font-weight: <?php echo $x_body_font_weight; ?>;
  }

<?php endif; ?>