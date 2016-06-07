<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;

$page_links_total = $wp_query->max_num_pages;
$page_links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
	'base'         => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
	'format'       => '',
	'current'      => max( 1, get_query_var( 'paged' ) ),
	'total'        => $page_links_total,
	'prev_text'    => '&larr;',
	'next_text'    => '&rarr;',
	'prev_next'    => false,
	'type'         => 'array',
	'end_size'     => 2,
	'mid_size'     => 2
) ) );	

$pagination = gorising_format_pagination( $page_links );

include( locate_template( 'includes/pagination.php' ) );	
?>