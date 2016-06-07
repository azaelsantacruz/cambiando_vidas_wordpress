<?php
	/*=============================
		DEFAULT BLOG LISTING PAGE
	=============================*/
get_header();
global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => 'post' ) );
$main_query = new WP_Query( $args );

$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page
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
				$blog_layout = gorising_get_option( 'bloglayout' );
				switch( $blog_layout ){
					case 'layout1' : include( locate_template( 'includes/blog/layout1.php' ) ); break;
					case 'layout2' : include( locate_template( 'includes/blog/layout2.php' ) ); break;
					case 'layout3' : include( locate_template( 'includes/blog/layout3.php' ) ); break;
					case 'layout4' : include( locate_template( 'includes/blog/layout4.php' ) ); break;
					case 'layout5' : include( locate_template( 'includes/blog/layout5.php' ) ); break;
					case 'layout6' : include( locate_template( 'includes/blog/layout6.php' ) ); break;
					case 'layout7' : include( locate_template( 'includes/blog/layout7.php' ) ); break;
					case 'layout8' : include( locate_template( 'includes/blog/layout8.php' ) ); break;
					case 'layout9' : include( locate_template( 'includes/blog/layout9.php' ) ); break;
					case 'layout10' : include( locate_template( 'includes/blog/layout10.php' ) ); break;	
					case 'layout11' : include( locate_template( 'includes/blog/layout11.php' ) ); break;	
					default : include( locate_template( 'includes/blog/layout1.php' ) );
				}
			?>
		</div><!-- content -->
	</div>
</section>
<?php get_footer(); ?>