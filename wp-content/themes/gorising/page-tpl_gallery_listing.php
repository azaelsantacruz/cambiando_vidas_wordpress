<?php
/*
	Template Name: Gallery Listing
*/
get_header();
global $wp_query;
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page

$main_query = new WP_Query(array(
	'post_type'			=> 'gallery',
	'post_status'		=> 'publish',
	'paged' 			=> $cur_page,
));

$page_links_total =  $main_query->max_num_pages;

$page_links = paginate_links( 
	array(
		'base' => add_query_arg( 'paged', '%#%' ),
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
				$gallery_layout = gorising_get_option( 'gallerylayout' );
				switch( $gallery_layout ){
					case 'layout1' : include( locate_template( 'includes/gallery/layout1.php' ) ); break;
					case 'layout2' : include( locate_template( 'includes/gallery/layout2.php' ) ); break;
					case 'layout3' : include( locate_template( 'includes/gallery/layout3.php' ) ); break;
					case 'layout4' : include( locate_template( 'includes/gallery/layout4.php' ) ); break;
					case 'layout5' : include( locate_template( 'includes/gallery/layout5.php' ) ); break;
					case 'layout6' : include( locate_template( 'includes/gallery/layout6.php' ) ); break;
					case 'layout7' : include( locate_template( 'includes/gallery/layout7.php' ) ); break;
					case 'layout8' : include( locate_template( 'includes/gallery/layout8.php' ) ); break;
					case 'layout9' : include( locate_template( 'includes/gallery/layout9.php' ) ); break;
					case 'layout10' : include( locate_template( 'includes/gallery/layout10.php' ) ); break;
					default : include( locate_template( 'includes/gallery/layout1.php' ) );
				}
			?>
		</div><!-- content -->
	</div>
</section>
<?php get_footer(); ?>