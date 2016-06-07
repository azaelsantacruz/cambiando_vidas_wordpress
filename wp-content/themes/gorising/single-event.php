<?php
get_header();
get_template_part( 'includes/breadcrumbs' );
the_post();
$event_meta = get_post_custom( get_the_ID() );
$images = gorising_smeta_images( 'event_images', get_the_ID(), array() );
$indicators = sizeof( $images );
$has_map = !empty( $event_meta['gmap_link'][0]  ) ? true : false;

if( $has_map ){
    $indicators++;
}


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

                                    <!-- slider -->
                                    <aside>

                                        <div id="singleCarousel" class="carousel slide single-page normal gorising_slider" data-ride="carousel" data-interval="false">

                                            <?php if( $indicators > 1 ): ?>
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    <?php 
                                                        for( $i=0; $i<$indicators; $i++ ){
                                                            ?>
                                                            <li data-target="#singleCarousel" data-slide-to="<?php echo $i ?>" class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
                                                            <?php
                                                        } 
                                                    ?>
                                                </ol>
                                            <?php endif; ?>


                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner">

                                                <?php if( $has_map ): ?>
                                                    <!-- 1 -->
                                                    <div class="item active">
                                                        <div class='embed-container'>
                                                            <iframe class="map event" src="<?php echo $event_meta['gmap_link'][0]; ?>"></iframe>
                                                        </div>
                                                    </div>
                                                    <!-- .1 -->
                                                <?php endif; ?>

                                                <?php
                                                    if( sizeof( $images ) > 0 ){
                                                        for( $i=0; $i<sizeof( $images ); $i++ ){
                                                            $image_id = $images[$i];
                                                            $image_data = wp_get_attachment_image_src( $image_id, 'post-thumbnail' );
                                                            ?>
                                                            <div class="item <?php echo ($i == 0 && !$has_map ) ? 'active' : '' ?>">
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

                                            <?php if( $indicators > 1 ): ?>
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

                                    <!-- content -->
                                    <div class="content comments clearfix">

                                        <!-- upcoming event -->
                                        <div class="upcoming-event single">
                                            <div class="event-icon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <div class="event-title">
                                                <h3>
                                                    <a href="javascript:;">
                                                        <?php
                                                            if( $event_meta['start_date'][0] > time()  ){
                                                                _e( 'Empieza:', 'gorising' );
                                                                $target_date = date( 'm/d/Y H:i:s', gorising_get_smeta( 'start_date', $event_meta, '' ) );
                                                            }
                                                            else if( $event_meta['end_date'][0] > time() ){
                                                                _e( 'Termina:', 'gorising' );
                                                                $target_date = date( 'm/d/Y H:i:s', gorising_get_smeta( 'end_date', $event_meta, '0' ) );
                                                            }
                                                            else{
                                                                _e( 'El evento ha terminado.', 'gorising' );
                                                                $target_date = date( 'm/d/Y H:i:s', gorising_get_smeta( 'start_date', $event_meta, '0' ) );
                                                            }
                                                        ?>
                                                    </a>
                                                </h3>
                                            </div>

                                            <div class="event-counter pull-right">

                                                <ul class="countdown list-unstyled list-inline text-center" data-target_time="<?php echo $target_date; ?>" data-offset="<?php echo  gorising_get_smeta( 'zone_offset', $event_meta, '0' ) ?>">
                                                    <li>
                                                        <p class="days_ref"><?php _e( 'Dia', 'gorising' ) ?></p>
                                                        <span class="days">00</span>

                                                    </li>

                                                    <li>
                                                        <p class="hours_ref"><?php _e( 'Hora', 'gorising' ) ?></p>
                                                        <span class="hours">00</span>

                                                    </li>

                                                    <li>
                                                        <p class="minutes_ref"><?php _e( 'Minutos', 'gorising' ) ?></p>
                                                        <span class="minutes">00</span>

                                                    </li>

                                                    <li>
                                                        <p class="seconds_ref"><?php _e( 'Segundos', 'gorising' ) ?></p>
                                                        <span class="seconds">00</span>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- .upcoming event -->

                                    </div>
                                    <!-- content -->

                                    <hr class="inline-hr" />

                                    <!-- content -->
                                    <div class="content">

                                        <!-- title -->
                                        <h2><a href="javascript:;"><?php the_title() ?></a>
                                        </h2>
                                        <!-- .title -->
                                        <!-- meta -->
                                        <p>
                                            <span class="grey"><?php _e( 'Publicado el', 'gorising' ) ?></span> <a href="javascript:;"><?php the_time( 'j M Y' ) ?></a>
                                            <span class="grey"><?php _e( 'por', 'gorising' ) ?></span> <a href="javascript:;"><?php the_author(); ?></a>
                                            <!-- <span class="grey"><?php _e( 'in', 'gorising' ) ?></span> <?php echo gorising_the_taxonomies( 'event_cat', get_the_ID() ); ?>
                                            <span class="grey"><?php _e( 'category with', 'gorising' ) ?></span>
                                            <a href="javascript:;"><?php comments_number( '0', '1', '%' ); ?></a>
                                            <span class="grey"><?php comments_number( __( 'comments', 'gorising' ), __( 'comment', 'gorising' ), __( 'comments', 'gorising' ) ); ?></span> -->
                                        </p>
                                        <!-- .meta -->

                                    </div>
                                    <!-- content -->

                                    <!-- content single -->
                                    <div class="content single">
                                        <?php the_content(); ?>
                                    </div>
                                    <!-- .content single -->

                                    <hr />

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
                <?php // comments_template( '', true ) ?>
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
                                                    <span class="light-grey"><?php _e( 'Evento añadido por', 'gorising' ) ?></span>
                                                </p>
                                                <p class="lead">
                                                    <a href="javascript:;"><?php the_author(); ?></a> 
                                                </p>
                                                <p>
                                                    <span class="grey"><?php the_time( 'j M Y' ) ?></span>
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

                <!-- date widget -->
                <div class="widget">
                    <div class="widget-event">
                        <div class="box-wrapper">
                            <div class="box date">

                                <!-- widget box -->
                                <div class="widget-box">
                                    <p class="grey"><?php _e( 'Empieza - Termina', 'gorising' ) ?></p>
                                    <p class="lead">
                                        <?php 
                                            $start_date = gorising_get_smeta( 'start_date', $event_meta, '' ); 
                                            if( !empty( $start_date ) ){
                                                echo date_i18n( 'j M Y', $start_date );
                                            }
                                        ?>
                                        <?php 
                                            $end_date = gorising_get_smeta( 'end_date', $event_meta, '' ); 
                                            if( !empty( $end_date ) ){
                                                _e( ' - ', 'gorising' );
                                                echo date_i18n( 'j M Y', $end_date );
                                            }
                                        ?>
                                    </p>
                                </div>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .date widget -->

                <!-- time widget -->
                <div class="widget">
                    <div class="widget-event">
                        <div class="box-wrapper">
                            <div class="box time">

                                <!-- widget box -->
                                <div class="widget-box">
                                    <p class="grey"><?php _e( 'Hora de Inicio - Hora de cierre', 'gorising' ); ?></p>
                                    <p class="lead">
                                        <?php 
                                            $start_date = gorising_get_smeta( 'start_date', $event_meta, '' ); 
                                            if( !empty( $start_date ) ){
                                                echo date_i18n( 'H:i', $start_date );
                                            }
                                        ?>
                                        <?php 
                                            $end_date = gorising_get_smeta( 'end_date', $event_meta, '' ); 
                                            if( !empty( $end_date ) ){
                                                _e( ' - ', 'gorising' );
                                                echo date_i18n( 'H:i', $end_date );
                                            }
                                        ?>                                    
                                    </p>

                                </div>
                                <!-- .widget box -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .time widget -->

                <?php 
                $address = gorising_get_smeta( 'address', $event_meta, '' );
                if( !empty( $address ) ):
                ?>
                    <!-- location widget -->
                    <div class="widget">
                        <div class="widget-event">
                            <div class="box-wrapper">
                                <div class="box location">

                                    <!-- widget box -->
                                    <div class="widget-box">
                                        <p class="grey"><?php _e( 'Lugar', 'gorising' ); ?></p>
                                        <p class="lead"><?php echo $address; ?></p>

                                    </div>
                                    <!-- .widget box -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .location widget -->
                <?php
                endif;
                ?>

            </div>
            <!-- .sidebar -->

        </div>
    </div>
    <!-- .blog posts & widgets -->

</section>
<?php
get_footer();
?>