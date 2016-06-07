<?php
/*
	Template Name: Boxed With Right Sidebar
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
                <div class="box-wrapper">
                    <div class="box">            
                        <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'full' ) ); ?>
                        <div class="content">
                            <?php if( !has_post_thumbnail() ): ?>
                                <br />
                            <?php endif; ?>
                            <?php the_content(); ?>
                        </div>
                    </div>
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