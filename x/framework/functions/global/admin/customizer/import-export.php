<?php 

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/IMPORT-EXPORT.PHP
// -----------------------------------------------------------------------------
// Sets up import/export functionality for the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Turn on Output Buffering
//   02. Import Functionality
//   03. Import Page
//   04. Export Functionality
//   05. Export Page
// =============================================================================

// Turn on Output Buffering
// =============================================================================

ob_start();



// Import Functionality
// =============================================================================

function x_customizer_import() {

  if ( isset( $_FILES['import'] ) && check_admin_referer( 'x-customizer-import' ) ) {
    if ( $_FILES['import']['error'] > 0 ) {
      wp_die( 'An import error occured. Please try again.' );
    } else {
      $file_name  = $_FILES['import']['name'];
      $file_array = explode( '.', $file_name );
      $file_ext   = strtolower( end( $file_array ) );
      $file_size  = $_FILES['import']['size'];
      if ( ( $file_ext == 'json' ) && ( $file_size < 500000 ) ) {
        $encoded_options = file_get_contents( $_FILES['import']['tmp_name'] );
        $options         = json_decode( $encoded_options, true );
        foreach ( $options as $key => $value ) {
          update_option( $key, $value );
        }
        echo '<div class="updated"><p>All options were successfully restored!</p></div>';
      } else {
        echo '<div class="error"><p>Invalid file type or file size too big.</p></div>';
      }
    }
  }

}



// Import Page
// =============================================================================

function x_customizer_import_option_page() { ?>

  <div class="wrap x-customizer-import-export x-customizer-import">
    <h2>Customizer Import</h2>
    <?php x_customizer_import(); ?>
    <form method="post" enctype="multipart/form-data">
      <?php wp_nonce_field( 'x-customizer-import' ); ?>
      <p>Howdy! Upload your X Customizer Settings (XCS) file and we&apos;ll import the options into this site.</p>
      <p>Choose a XCS (.json) file to upload, then click Upload file and import.</p>
      <p>Choose a file from your computer: <input type="file" id="customizer-upload" name="import"></p>
      <p class="submit">
        <input type="submit" name="submit" id="customizer-submit" class="button" value="Upload file and import" disabled>
      </p>
    </form>
  </div>

<?php }



// Export Functionality
// =============================================================================

function x_customizer_export() {

  $blogname  = strtolower( str_replace( ' ', '-', get_option( 'blogname' ) ) );
  $file_name = $blogname . '-xcs';
  $options   = array( 'x_stack', 'x_integrity_layout_site', 'x_integrity_sizing_site_max_width', 'x_integrity_sizing_site_width', 'x_integrity_layout_content', 'x_integrity_sizing_content_width', 'x_integrity_design', 'x_integrity_topbar_transparency_enable', 'x_integrity_navbar_transparency_enable', 'x_integrity_footer_transparency_enable', 'x_integrity_light_bg_color', 'x_integrity_light_bg_image_pattern', 'x_integrity_light_bg_image_full', 'x_integrity_light_bg_image_full_fade', 'x_integrity_dark_bg_color', 'x_integrity_dark_bg_image_pattern', 'x_integrity_dark_bg_image_full', 'x_integrity_dark_bg_image_full_fade', 'x_integrity_blog_header_enable', 'x_integrity_blog_title', 'x_integrity_blog_subtitle', 'x_integrity_portfolio_archive_sort_button_text', 'x_integrity_portfolio_archive_post_sharing_enable', 'x_renew_layout_site', 'x_renew_sizing_site_max_width', 'x_renew_sizing_site_width', 'x_renew_layout_content', 'x_renew_sizing_content_width', 'x_renew_topbar_background', 'x_renew_logobar_background', 'x_renew_navbar_background', 'x_renew_navbar_button_color', 'x_renew_navbar_button_background', 'x_renew_navbar_button_background_hover', 'x_renew_footer_background', 'x_renew_bg_color', 'x_renew_bg_image_pattern', 'x_renew_bg_image_full', 'x_renew_bg_image_full_fade', 'x_renew_topbar_text_color', 'x_renew_topbar_link_color_hover', 'x_renew_footer_text_color', 'x_renew_blog_title', 'x_renew_entry_icon_color', 'x_renew_entry_icon_position', 'x_renew_entry_icon_position_horizontal', 'x_renew_entry_icon_position_vertical', 'x_icon_layout_site', 'x_icon_sizing_site_max_width', 'x_icon_sizing_site_width', 'x_icon_layout_content', 'x_icon_sidebar_width', 'x_icon_bg_color', 'x_icon_bg_image_pattern', 'x_icon_bg_image_full', 'x_icon_bg_image_full_fade', 'x_icon_post_standard_colors_enable', 'x_icon_post_standard_color', 'x_icon_post_standard_background', 'x_icon_post_image_colors_enable', 'x_icon_post_image_color', 'x_icon_post_image_background', 'x_icon_post_gallery_colors_enable', 'x_icon_post_gallery_color', 'x_icon_post_gallery_background', 'x_icon_post_video_colors_enable', 'x_icon_post_video_color', 'x_icon_post_video_background', 'x_icon_post_audio_colors_enable', 'x_icon_post_audio_color', 'x_icon_post_audio_background', 'x_icon_post_quote_colors_enable', 'x_icon_post_quote_color', 'x_icon_post_quote_background', 'x_icon_post_link_colors_enable', 'x_icon_post_link_color', 'x_icon_post_link_background', 'x_ethos_layout_site', 'x_ethos_sizing_site_max_width', 'x_ethos_sizing_site_width', 'x_ethos_layout_content', 'x_ethos_sizing_content_width', 'x_ethos_topbar_background', 'x_ethos_navbar_background', 'x_ethos_sidebar_widget_headings_color', 'x_ethos_sidebar_color', 'x_ethos_bg_color', 'x_ethos_bg_image_pattern', 'x_ethos_bg_image_full', 'x_ethos_bg_image_full_fade', 'x_ethos_post_carousel_enable', 'x_ethos_post_carousel_count', 'x_ethos_post_carousel_display', 'x_ethos_post_carousel_featured', 'x_ethos_post_carousel_display_count_extra_large', 'x_ethos_post_carousel_display_count_large', 'x_ethos_post_carousel_display_count_medium', 'x_ethos_post_carousel_display_count_small', 'x_ethos_post_carousel_display_count_extra_small', 'x_ethos_post_slider_blog_enable', 'x_ethos_post_slider_blog_height', 'x_ethos_post_slider_blog_count', 'x_ethos_post_slider_blog_display', 'x_ethos_post_slider_blog_featured', 'x_ethos_post_slider_archive_enable', 'x_ethos_post_slider_archive_height', 'x_ethos_post_slider_archive_count', 'x_ethos_post_slider_archive_display', 'x_ethos_post_slider_archive_featured', 'x_ethos_navbar_desktop_link_side_padding', 'x_ethos_filterable_index_enable', 'x_ethos_filterable_index_categories', 'x_custom_fonts', 'x_custom_font_subsets', 'x_custom_font_subset_cyrillic', 'x_custom_font_subset_greek', 'x_custom_font_subset_vietnamese', 'x_logo_font_family', 'x_logo_font_color_enable', 'x_logo_font_color', 'x_logo_font_size', 'x_logo_font_weight', 'x_logo_letter_spacing', 'x_logo_uppercase_enable', 'x_navbar_font_family', 'x_navbar_link_color', 'x_navbar_link_color_hover', 'x_navbar_font_size', 'x_navbar_font_weight', 'x_navbar_uppercase_enable', 'x_headings_font_family', 'x_headings_font_color_enable', 'x_headings_font_color', 'x_headings_font_weight', 'x_headings_letter_spacing', 'x_headings_uppercase_enable', 'x_headings_widget_icons_enable', 'x_body_font_family', 'x_body_font_color_enable', 'x_body_font_color', 'x_body_font_size', 'x_content_font_size', 'x_body_font_weight', 'x_site_link_color', 'x_site_link_color_hover', 'x_button_style', 'x_button_shape', 'x_button_size', 'x_button_color', 'x_button_background_color', 'x_button_border_color', 'x_button_bottom_color', 'x_button_color_hover', 'x_button_background_color_hover', 'x_button_border_color_hover', 'x_button_bottom_color_hover', 'x_navbar_positioning', 'x_logo_navigation_layout', 'x_logobar_adjust_spacing_top', 'x_logobar_adjust_spacing_bottom', 'x_navbar_height', 'x_navbar_width', 'x_logo', 'x_logo_width', 'x_header_search_enable', 'x_logo_adjust_navbar_top', 'x_navbar_adjust_links_top', 'x_logo_adjust_navbar_side', 'x_navbar_adjust_links_side', 'x_navbar_adjust_button', 'x_navbar_adjust_button_size', 'x_header_widget_areas', 'x_widgetbar_button_background', 'x_widgetbar_button_background_hover', 'x_topbar_display', 'x_topbar_content', 'x_breadcrumb_display', 'x_footer_widget_areas', 'x_footer_bottom_display', 'x_footer_menu_display', 'x_footer_social_display', 'x_footer_content_display', 'x_footer_content', 'x_footer_scroll_top_display', 'x_footer_scroll_top_position', 'x_footer_scroll_top_display_unit', 'x_blog_style', 'x_blog_layout', 'x_blog_masonry_columns', 'x_archive_style', 'x_archive_layout', 'x_archive_masonry_columns', 'x_blog_enable_post_meta', 'x_blog_enable_full_post_content', 'x_blog_excerpt_length', 'x_custom_portfolio_slug', 'x_portfolio_enable_cropped_thumbs', 'x_portfolio_enable_post_meta', 'x_portfolio_tag_title', 'x_portfolio_launch_project_title', 'x_portfolio_launch_project_button_text', 'x_portfolio_share_project_title', 'x_portfolio_enable_facebook_sharing', 'x_portfolio_enable_twitter_sharing', 'x_portfolio_enable_google_plus_sharing', 'x_portfolio_enable_linkedin_sharing', 'x_portfolio_enable_pinterest_sharing', 'x_portfolio_enable_reddit_sharing', 'x_portfolio_enable_email_sharing', 'x_social_facebook', 'x_social_twitter', 'x_social_googleplus', 'x_social_linkedin', 'x_social_foursquare', 'x_social_youtube', 'x_social_vimeo', 'x_social_instagram', 'x_social_pinterest', 'x_social_dribbble', 'x_social_behance', 'x_social_tumblr', 'x_social_rss', 'x_icon_favicon', 'x_icon_touch', 'x_icon_tile', 'x_icon_tile_bg_color', 'x_custom_styles', 'x_custom_scripts' );

  foreach( $options as $key ) {
    $value      = maybe_unserialize( get_option( $key ) );
    $data[$key] = $value;
  }

  $json_data = json_encode( $data );


  //
  // We wrap the content of our JSON data with ob_clean() and exit() to ensure
  // that $json_data doesn't contain any extra data. This works in conjunction
  // with ob_start() at the top of the file, which prevents header errors from
  // occuring (i.e. extra whitespace somewhere in the code).
  //

  ob_clean();

  echo $json_data;

  header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
  header( 'Content-Disposition: attachment; filename="' . $file_name . '.json"' );

  exit();

}



// Export Page
// =============================================================================

function x_customizer_export_option_page() {

  if ( ! isset( $_POST['export'] ) ) {

  ?>

    <div class="wrap x-customizer-import-export x-customizer-export">
      <h2>Customizer Export</h2>
      <form method="post">
        <?php wp_nonce_field( 'x-customizer-export' ); ?>
        <p>When you click the button below WordPress will create a JSON file for you to save to your computer.</p>
        <p>This format, which we call X Customizer Settings or XCS, will contain your Customizer settings for X.</p>
        <p>Once you&apos;ve saved the download file, you can use the X Customizer Import function to import the previusly exported settings.</p>
        <p class="submit">
          <input type="submit" name="export" class="button button-primary" value="Download XCS File">
        </p>
      </form>
    </div>

  <?php

  } elseif ( check_admin_referer( 'x-customizer-export' ) ) {
    x_customizer_export();
  }

}