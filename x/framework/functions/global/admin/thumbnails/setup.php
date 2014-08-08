<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/THUMBNAILS/SETUP.PHP
// -----------------------------------------------------------------------------
// Sets up entry thumbnail sizes based on Customizer options.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Path
//   02. Require Files
// =============================================================================

// Set Path
// =============================================================================

$thmb_path = get_template_directory() . '/framework/functions/global/admin/thumbnails';



// Require Files
// =============================================================================

require_once( $thmb_path . '/integrity.php' );
require_once( $thmb_path . '/renew.php' );
require_once( $thmb_path . '/icon.php' );
require_once( $thmb_path . '/ethos.php' );
require_once( $thmb_path . '/height.php' );