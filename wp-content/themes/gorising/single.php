<?php
/*==================
 SINGLE BLOG POST
==================*/

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
                                	$images = gorising_smeta_images( 'post_images', get_the_ID(), array() );
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
                                    <div class="content">

                                        <!-- title -->
                                        <h2><a href="javascript:;"><?php the_title(); ?></a>
                                        </h2>
                                        <!-- .title -->

                                        <!-- meta -->
                                        <p>
                                            <span class="grey"><?php _e( 'published', 'gorising' ) ?></span> <a href="javascript:;"><?php the_time( 'j M Y' ) ?></a>
                                            <span class="grey"><?php _e( 'by', 'gorising' ) ?></span> <a href="javascript:;"><?php the_author(); ?></a>
                                            <span class="grey"><?php _e( 'in', 'gorising' ) ?></span> <?php echo gorising_the_categories(); ?>
                                            <span class="grey"><?php _e( 'category with', 'gorising' ) ?></span>
                                            <a href="javascript:;"><?php comments_number( '0', '1', '%' ); ?></a>
                                            <span class="grey"><?php comments_number( __( 'comments', 'gorising' ), __( 'comment', 'gorising' ), __( 'comments', 'gorising' ) ); ?></span>
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
                                                    <span class="light-grey"><?php _e( 'Published by', 'gorising' ) ?></span>
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

                <!-- search widget -->
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
                <!-- .search widget -->

                <?php get_sidebar( 'blog' ); ?>

            </div>
            <!-- .sidebar -->

        </div>
    </div>
    <!-- .blog posts & widgets -->

</section>

<?php
$tags = wp_get_post_tags( get_the_ID() );  
	if ($tags): 
		$tag_ids = array();  
		foreach( $tags as $individual_tag ){
			$tag_ids[] = $individual_tag->term_id;  
		}
		$args=array(  
			'tag__in' => $tag_ids,  
			'post__not_in' => array( get_the_ID() ),  
			'posts_per_page'=>4,
            'ignore_sticky_posts' => 1
		);
		$query = new WP_Query( $args );
		if( $query->have_posts() ):
		?>

			<!-- similar posts -->
			<section class="no-top-margin">
			    <div class="container">
			        <div class="row">
			            <div class="col-md-12">

			                <!-- heading -->
			                <div class="heading">

			                    <!-- title -->
			                    <h3><?php _e( 'Similar Posts', 'gorising' ) ?></h3>
			                    <!-- .title -->

			                    <div class="border">
			                        <div class="border-inner">
			                        </div>
			                    </div>
			                    <!-- .carousel slide -->

			                </div>
			                <!-- .heading -->

			            </div>
			        </div>

			        <!-- posts -->
			        <div class="posts">
			            <div class="row">	
			<?php
			while( $query->have_posts() ):
				$query->the_post();
?>
                <!-- 1 -->
                <div class="col-md-3">
                    <div class="box-wrapper">
                        <div class="box">
                            <div class="latest-box">

                                <!-- .media -->
                                <div class="media">

                                    <?php get_template_part( 'includes/share' ); ?>
                                    <?php if( has_post_thumbnail() ): ?>
                                    	<!-- image -->
                                    	<a href="<?php the_permalink(); ?>">
	                                     	<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
                                    	</a>
                                   		<!-- image -->
                                   	<?php endif; ?>
                                </div>
                                <!-- .media -->

                                <!-- content -->
                                <div class="content-wrapper">
                                    <div class="content">

                                        <!-- cause meta -->
                                        <div class="meta clearfix">
                                            <?php echo gorising_the_categories(); ?>
                                            <a class="pull-right share-trigger" data-target="<?php echo has_post_thumbnail() ? 'overlay' : 'modal'; ?>" data-rel="tooltip" title="<?php _e( 'Share Post', 'gorising' ) ?>" href="javascript:;"><i class="fa fa-share-alt"></i></a>
                                        </div>
                                        <!-- .cause meta -->

                                        <!-- excerpt -->
                                        <div class="excerpt">
                                            <h6><a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                            </h6>

                                        </div>
                                        <!-- .excerpt -->

                                        <!-- rised slider meta -->
                                        <div class="slider-meta clearfix">

                                        </div>
                                        <!-- .rised slider meta -->


                                    </div>
                                </div>
                                <!-- .content -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .1 -->
            <?php
            endwhile;
            ?>

			            </div>
			        </div>
			        <!-- .posts -->

			    </div>
			</section>
			<!-- similar posts -->
		<?php endif; ?>
	<?php endif; ?>
<?php
get_footer();
?>