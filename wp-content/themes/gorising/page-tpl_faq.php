<?php
/*
	Template name: FAQ
*/

get_header();
the_post();
get_template_part( 'includes/breadcrumbs' );
$main_query = new WP_Query(
	array(
		'posts_per_page'	=> -1,
		'post_type'		=> 'faq',
		'post_status' => 'publish'
	)
);
?>

<!-- tabs & accordion -->
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-12">

            	<?php if( $main_query->have_posts() ): $counter = 0; ?>
	                <!-- accordion -->
	                <div class="panel-group" id="accordion">
	                	<?php 
	                		while( $main_query->have_posts() ): 
	                		$main_query->the_post();
	                	?>
		                    <!-- 1 -->
		                    <div class="panel panel-default">
		                        <div class="panel-heading">
		                            <h4 class="panel-title">
		                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?php echo $counter; ?>"><?php the_title(); ?></a>
		                            </h4>
		                        </div>
		                        <div id="collapseOne_<?php echo $counter; ?>" class="panel-collapse collapse <?php echo $counter == 0 ? 'in' : ''; $counter++; ?>">
		                            <div class="panel-body">
		                                <?php the_content(); ?>
		                            </div>
		                        </div>
		                    </div>
		                    <!-- .1 -->
		                <?php endwhile; ?>

	                </div>
	                <!-- .accordion -->
           		<?php endif; ?>

            </div>

        </div>
    </div>
</section>
<!-- tabs & accordion -->\
<?php
get_footer();
?>