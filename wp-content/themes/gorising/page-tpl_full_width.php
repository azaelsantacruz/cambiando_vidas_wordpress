<?php
/*
	Template Name: Full Width Page Opened
*/
get_header();
the_post();
get_template_part( 'includes/breadcrumbs' );
?>
<!-- full width -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'full' ) ); ?>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php comments_template( '', true ) ?>
            </div>
        </div>
    </div>
</section>
<!-- full width -->
<?php
get_footer();
?>