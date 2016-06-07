<?php
/*
	Template Name: Causes Listing
*/
get_header();
global $wp_query;
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page

$args = array(
	'post_type'			=> 'cause',
	'post_status'		=> 'publish',
	'paged' 			=> $cur_page,
	'post_title'		=> isset( $_GET['search'] ) ? urldecode( $_GET['search'] ) : '',
	'meta_query'		=> array(
		'relation'	=> 'AND'
	)
);

if( !empty( $_GET['cause_cat'] ) ){
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'cause_cat',
			'field' => 'term_id',
			'terms' => $_GET['cause_cat'],
		)
	);
}

if( !empty( $_GET['type'] ) ){
	$args['meta_query'][] = array(
		'meta_key' => 'gorising_type',
		'compare' => '=',
		'value' => $_GET['type'],
	);
}

if( !empty( $_GET['unit'] ) ){
	$args['meta_query'][] = array(
		'meta_key' => 'gorising_unit',
		'compare' => '=',
		'value' => $_GET['unit'],
	);
}


if( !empty( $_GET['min_funds_val'] ) && !empty( $_GET['max_funds_val'] ) ){
	$args['meta_query'][] = array(
		'meta_key' => 'gorising_required',
		'compare' => 'BETWEEN',
		'value' => array( $_GET['min_funds_val'], $_GET['max_funds_val'] ),
		'type' => 'NUMERIC'
	);
}

add_filter('posts_where', 'gorising_filter_where');
$main_query = new WP_Query( $args );
remove_filter('posts_where', 'gorising_filter_where');

$page_links_total =  $main_query->max_num_pages;

$page_links = paginate_links( 
	array(		'base' => add_query_arg( 'paged', '%#%' ),
		'prev_next' => true,
		'end_size' => 2,
		'mid_size' => 2,
		'total' => $page_links_total,
		'current' => $cur_page,	
		'prev_next' => false,
		'type' => 'array'
	)
);	

$pagination = gorising_format_pagination( $page_links );
get_template_part( 'includes/breadcrumbs' );
$masonry = gorising_get_option( 'use_masonry' );
?>
<section>
	<div class="container">
		<div class="row">
			<?php
				$cause_layout = gorising_get_option( 'causelayout' );
				switch( $cause_layout ){
					case 'layout1' : include( locate_template( 'includes/cause/layout1.php' ) ); break;
					case 'layout2' : include( locate_template( 'includes/cause/layout2.php' ) ); break;
					case 'layout3' : include( locate_template( 'includes/cause/layout3.php' ) ); break;
					case 'layout4' : include( locate_template( 'includes/cause/layout4.php' ) ); break;
					case 'layout5' : include( locate_template( 'includes/cause/layout5.php' ) ); break;
					default : include( locate_template( 'includes/cause/layout1.php' ) );
				}
			?>
		</div><!-- content -->
	</div>
</section>
<?php get_footer(); ?>