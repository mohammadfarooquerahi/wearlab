<?php
/**
 * Template Name: New Arrivals Page
 * Displays newest products in KhushPosh 4-column grid
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$_GET['filter']  = 'new-arrivals';
$_GET['orderby'] = 'date';

include get_template_directory() . '/archive-product.php';
