<?php
/*
	Template Name: Opened With Right Sidebar
*/
get_header();
the_post();
get_template_part( 'includes/breadcrumbs' );
?>
<!-- full width -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9">           
                <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'full' ) ); ?>
                <div class="content">
    	           <?php the_content(); ?>
                </div>

                <?php comments_template( '', true ) ?>
                
            </div>
            <div class="col-md-3">      
                <?php get_sidebar( 'page' ); ?>
            </div>
        </div>
    </div>
</section>
<!-- full width -->
<?php
get_footer();
?>