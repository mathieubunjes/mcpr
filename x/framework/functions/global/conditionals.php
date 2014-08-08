<?php

// =============================================================================
// FUNCTIONS/GLOBAL/CONDITIONALS.PHP
// -----------------------------------------------------------------------------
// Conditional functions to check the status of various locations.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Is Blank Page Template
//   02. Is Portfolio
//   03. Is Portfolio Item
//   04. Is Portfolio Category
//   05. Is Portfolio Tag
//   06. Is Shop
//   07. Is Product
//   08. Is Product Category
//   09. Is Product Tag
//   10. Is bbPress
//   11. Is Font Italic
// =============================================================================

// Is Blank Page Template
// =============================================================================

function x_is_blank( $number ) {

  if ( is_page_template( 'template-blank-' . $number . '.php' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio
// =============================================================================

function x_is_portfolio() {

  if ( is_page_template( 'template-layout-portfolio.php' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Item
// =============================================================================

function x_is_portfolio_item() {

  if ( is_singular( 'x-portfolio' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Category
// =============================================================================

function x_is_portfolio_category() {

  if ( is_tax( 'portfolio-category' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Tag
// =============================================================================

function x_is_portfolio_tag() {

  if ( is_tax( 'portfolio-tag' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Shop
// =============================================================================

function x_is_shop() {

  if ( function_exists( 'is_shop' ) && is_shop() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product
// =============================================================================

function x_is_product() {

  if ( function_exists( 'is_product' ) && is_product() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product Category
// =============================================================================

function x_is_product_category() {

  if ( function_exists( 'is_product_category' ) && is_product_category() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product Tag
// =============================================================================

function x_is_product_tag() {

  if ( function_exists( 'is_product_tag' ) && is_product_tag() ) {
    return true;
  } else {
    return false;
  }

}



// Is bbPress
// =============================================================================

function x_is_bbpress() {

  if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
    return true;
  } else {
    return false;
  }

}