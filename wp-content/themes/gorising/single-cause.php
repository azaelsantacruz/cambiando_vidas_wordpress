<?php
get_header();
get_template_part( 'includes/breadcrumbs' );
the_post();
?>
<!-- blog posts & widgets -->
<section class="no-bottom-margin">
    <div class="container">
        <div class="row">

            <!-- paginate & posts -->
            <div class="col-md-9">

                <!-- post -->
                <div class="posts">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="box-wrapper">
                                <div class="box">
                                <?php
                                $images = gorising_smeta_images( 'cause_images', get_the_ID(), array() );
                                if( !empty( $images ) || has_post_thumbnail() ):
                                ?>
                                    <!-- slider -->
                                    <aside>

                                        <div id="singleCarousel" class="carousel slide single-page normal gorising_slider" data-ride="carousel" data-interval="6000">

                                            <?php if( sizeof( $images ) > 1 ): ?>
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <?php
                                                    for( $i=0; $i<sizeof( $images ); $i++ ){
                                                        ?>
                                                        <li data-target="#singleCarousel" data-slide-to="<?php echo $i ?>" <?php echo $i == 0 ? 'class="active"' : '' ?></li>
                                                        <?php
                                                    }
                                                ?>
                                            </ol>
                                            <?php endif; ?>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner">
                                                <?php
                                                    if( sizeof( $images ) > 0 ){
                                                        for( $i=0; $i<sizeof( $images ); $i++ ){
                                                            $image_id = $images[$i];
                                                            $image_data = wp_get_attachment_image_src( $image_id, 'post-thumbnail' );
                                                            ?>
                                                            <div class="item <?php echo $i == 0 ? 'active' : '' ?>">
                                                                <img src="<?php echo $image_data[0] ?>" alt="" title="" />
                                                            </div>                                                          
                                                            <?php
                                                        }
                                                    }
                                                    else{
                                                        ?>
                                                        <div class="item active">
                                                            <?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ) ?>
                                                        </div>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <!-- /Wrapper for slides .carousel-inner -->

                                            <?php if( sizeof( $images ) > 1 ): ?>
                                                <!-- Controls -->
                                                <div class="control-box">
                                                    <a class="left carousel-control" href="#singleCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                                    <a class="right carousel-control" href="#singleCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                                </div>
                                                <!-- /.control-box -->
                                            <?php endif; ?>


                                        </div>
                                        <!-- carousel -->

                                    </aside>
                                    <!-- .slider -->
                                <?php
                                endif;
                                ?>

                                    <!-- content -->
                                    <div class="content comments clearfix">
                                        <?php
                                        $cause_meta = get_post_meta( get_the_ID() );
                                        $has = gorising_get_smeta( 'gorising_has', $cause_meta, 0 );
                                        $required = gorising_get_smeta( 'gorising_required', $cause_meta, 0 );
                                        $unit = gorising_get_smeta( 'gorising_unit', $cause_meta, '' );
                                        $front_back = gorising_get_smeta( 'gorising_front_back', $cause_meta, '' );
                                        ?>
                                        <!-- rised bar -->
                                        <div class="slider-content cause">
                                            <input class="rised" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="<?php echo $required; ?>" data-slider-step="1" data-slider-enabled="false" data-slider-value="<?php echo $has; ?>" />
                                        </div>
                                        <!-- .rised bar -->

                                        <!-- rised slider meta -->
                                        <div class="clearfix">
                                            <p class="pull-left lead">
                                                <span class="light-grey"><?php _e( 'Recaudado:', 'gorising' ) ?></span>
                                                <?php  gorising_format_number( $has, $front_back, $unit ); ?>
                                            </p>
                                            <p class="pull-right lead">
                                                <span class="light-grey"><?php _e( 'Meta:', 'gorising' ) ?></span>
                                                <?php  gorising_format_number( $required, $front_back, $unit ); ?>
                                            </p>
                                        </div>
                                        <!-- .rised slider meta -->

                                    </div>
                                    <!-- content -->

                                    <!-- border -->
                                    <hr class="inline-hr" />
                                    <!-- .border -->

                                    <!-- content -->
                                    <div class="content">

                                        <!-- title -->
                                        <h2><a href="javascript:;"><?php the_title(); ?></a>
                                        </h2>
                                        <!-- .title -->
                                        <!-- meta -->
                                        <p>
                                            <span class="grey"><?php _e( 'publicado', 'gorising' ) ?></span> <a href="javascript:;"><?php the_time( 'j M Y' ) ?></a>
                                            <span class="grey"><?php _e( 'por', 'gorising' ) ?></span> <a href="javascript:;"><?php the_author(); ?></a>
                                            <span class="grey"><?php _e( 'en', 'gorising' ) ?></span> <?php echo gorising_the_taxonomies( 'cause_cat', get_the_ID() ); ?>
                                            <span class="grey"><?php _e( 'categoría con', 'gorising' ) ?></span>
                                            <a href="javascript:;"><?php comments_number( '0', '1', '%' ); ?></a>
                                            <span class="grey"><?php comments_number( __( 'comentarios', 'gorising' ), __( 'comentario', 'gorising' ), __( 'comentarios', 'gorising' ) ); ?></span>
                                        </p>
                                        <!-- .meta -->

                                    </div>
                                    <!-- content -->

                                    <!-- content single -->
                                    <div class="content single">
                                        <?php the_content(); ?>
                                    </div>
                                    <!-- .content single -->

                                    <!-- border -->
                                    <hr />
                                    <!-- .border -->


                                    <!-- tags & prev next -->
                                    <div class="content">
                                        <div class="row">

                                            <!-- tags -->
                                            <div class="col-md-10">
                                                <ul class="list-unstyled list-inline tags">
                                                    <?php echo gorising_the_tags(); ?>
                                                </ul>
                                            </div>
                                            <!-- .tags -->

                                            <!-- paginate posts -->
                                            <div class="col-md-2">
                                                <div class="paginate single pull-right">
                                                    <ul class="list-unstyled list-inline">
                                                        <?php 
                                                            gorising_previous_post(); 
                                                            gorising_next_post();
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- .paginate posts -->

                                        </div>
                                    </div>
                                    <!-- .tags & prev next -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .post -->

                <!-- comments -->
                <?php 
                $donations = gorising_get_donation_data(); 
                ?>
                <div class="posts">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="box-wrapper">
                                <div class="box">


                                    <!-- content -->
                                    <div class="content comments clearfix">

                                        <!-- title -->
                                        <h5 class="pull-left"><?php _e( 'Donaciones recientes', 'gorising' ); ?></h5>
                                        <!-- .title -->

                                        <!-- title -->
                                        <p class="pull-right grey">
                                            <?php  gorising_format_number( $has, $front_back, $unit ); ?>
                                            <?php 
                                                echo ' ';
                                                _e( 'recaudado por ', 'gorising' );
                                                echo $donations['people'];
                                                _e( ' personas en ', 'gorising' );
                                                echo human_time_diff( get_the_time('U'), current_time('timestamp') );
                                            ?></p>
                                        <!-- .title -->

                                    </div>
                                    <!-- content -->

                                    <hr class="inline-hr" />

                                    <div class="logs-holder">
                                        <?php gorising_generate_logs( $donations['logs'], $front_back, $unit ); ?>
                                    </div>

                                    <?php
                                    if( $donations['people'] > count( $donations['logs'] ) ):
                                    ?>
                                        <!-- tags & prev next -->
                                        <div class="content">
                                            <div class="row">

                                                <!-- paginate posts -->
                                                <div class="col-md-12">
                                                    <div class="paginate single pull-right">
                                                        <ul class="list-unstyled list-inline">
                                                            <li><a href="#" class="donate_logs" data-page="0" data-cause_id="<?php echo get_the_ID(); ?>"><i class="fa fa-angle-right"></i></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- .paginate posts -->

                                            </div>
                                        </div>
                                        <!-- .tags & prev next -->
                                    <?php
                                    endif;
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- .comments -->
                <?php comments_template( '', true ) ?>
                
            </div>
            <!-- .paginate & posts -->

            <!-- sidebar -->
            <div class="col-md-3">

                <!-- author widget -->
                <div class="widget">
                    <div class="widget-author">
                        <div class="box-wrapper">
                            <div class="box">

                                <!-- widget box -->
                                <div class="widget-box text-center">
                                    <div class="media author">
                                        <div class="small-product">
                                            <div class="small-product-wrapper">
                                                <a href="javascript:;">
                                                    <?php
                                                        $avatar = get_avatar( get_the_author_meta( 'ID' ), 150 );
                                                        $avatar_url = gorising_get_avatar_url( $avatar );
                                                    ?>
                                                    <img class="media-object img-circle img-thumbnail " src="<?php echo $avatar_url; ?>" title="" alt="" />
                                                </a>
                                            </div>
                                            <div class="media-body small-product">
                                                <p>
                                                    <span class="light-grey"><?php _e( 'Causa añadida por', 'gorising' ) ?></span>
                                                </p>
                                                <p class="lead">
                                                    <a href="javascript:;"><?php echo get_the_author_meta( 'display_name' ); ?></a> 
                                                </p>
                                                <p>
                                                    <span class="grey"><?php the_time( 'j M Y' ); ?></span>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .author widget -->

                <!-- share widget -->
                <div class="widget">
                    <div class="widget-share">
                        <div class="box-wrapper">
                            <div class="box">

                                <!-- widget box -->
                                <div class="widget-box">
                                    <ul class="clearfix">
                                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" class="facebook"><i class="fa fa-facebook"></i><br /><span class="light-grey"><?php echo gorising_get_shares( 'facebook' ); ?></span></a>
                                        </li>
                                        <li><a target="_blank" href="http://twitter.com/intent/tweet?text=<?php echo bloginfo( 'name' ); ?>&amp;url=<?php echo rawurlencode( get_permalink() ); ?>" class="twitter"><i class="fa fa-twitter"></i><br /><span class="light-grey"><?php echo gorising_get_shares( 'twitter' ); ?></span></a>
                                        </li>
                                        <li><a target="_blank" href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>" class="google-plus"><i class="fa fa-google-plus"></i><br /><span class="light-grey"><?php echo gorising_get_shares( 'google' ); ?></span></a>
                                        </li>
                                    </ul>

                                </div>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .share widget -->

                <!-- to go widget -->
                <div class="widget">
                    <div class="widget-cause">
                        <div class="box-wrapper">
                            <div class="box">

                                <!-- widget box -->
                                <h4 class="text-center">
                                    <?php  gorising_format_number( $required - $has, $front_back, $unit ); ?>                                
                                    <span class="light-grey"><?php _e( 'para alcanzar la meta.', 'gorising' ) ?></span>
                                </h4>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .to go widget -->

                <!-- donate widget -->
                <div class="widget">
                    <div class="widget-donate">
                        <div class="box-wrapper">
                            <div class="box">

                                <!-- widget box -->
                                <h4 class="text-center"><a href="<?php echo gorising_donate_link( get_the_ID() ) ?>"><?php _e( 'DONA AHORA', 'gorising' ) ?></a>
                                </h4>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .donate widget -->

            </div>
            <!-- .sidebar -->

        </div>
    </div>
    <!-- .blog posts & widgets -->

</section>
<?php get_footer(); ?>