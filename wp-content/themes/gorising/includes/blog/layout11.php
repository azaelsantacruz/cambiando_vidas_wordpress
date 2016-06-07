<div class="col-md-9">
<?php include( locate_template( 'includes/pagination.php' ) ); ?>
<?php
	$counter = 0;
	if( $main_query->have_posts() ):
?>
	<!-- posts -->
	<div class="posts">
		<div class="masonry">
			
			<?php 
			while( $main_query->have_posts() ): 
				$main_query->the_post();
			?>
			<!-- 1 -->
			<div class="col-md-4 post-box">
				<div class="masonry-margin-space">
					<div class="box-wrapper">
						<div <?php post_class( 'box' ); ?>>
							<div class="latest-box">

								<!-- .media -->
								<div class="media">

									<!-- image -->
									<?php get_template_part( 'includes/share' ); ?>
									<?php if( has_post_thumbnail() ): ?>
										<a href="<?php the_permalink() ?>">
											<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'img-responsive' ) ); ?>
										</a>
									<?php endif; ?>
									<!-- image -->
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
											<h6><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h6>
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
			</div>
			<!-- .1 -->
			<?php endwhile; ?>
		</div>
	</div>
	<?php include( locate_template( 'includes/pagination.php' ) ); ?>
<?php 
	else:
		include( locate_template( 'includes/404_text.php' ) );
	endif;
?>
</div>
<!-- sidebar -->
<div class="col-md-3">
	<?php get_sidebar( 'blog' ); ?>
</div
<!-- .sidebar -->