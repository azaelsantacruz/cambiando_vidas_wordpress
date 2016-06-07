<div class="col-md-12">
<?php include( locate_template( 'includes/pagination.php' ) ); ?>
<?php
	$counter = 0;
	if( $main_query->have_posts() ):
?>
	<!-- posts -->
	<div class="posts">
		<div class="row">
			
			<?php 
			while( $main_query->have_posts() ): 
				$main_query->the_post();
				if( $counter == 4 ){
					$counter = 0;
					?>
					</div>
					<div class="row">
					<?php
				}
				$counter++;
			?>
			<!-- 1 -->
			<div class="col-md-3">
				<div class="box-wrapper">
					<div class="box">
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
										<?php echo gorising_the_categories( get_the_ID(), 'cause_cat' ); ?>
										<a class="pull-right share-trigger" data-target="<?php echo has_post_thumbnail() ? 'overlay' : 'modal'; ?>" data-rel="tooltip" title="<?php _e( 'Share Cause', 'gorising' ) ?>" href="javascript:;"><i class="fa fa-share-alt"></i></a>
									</div>
									<!-- .cause meta -->

									<!-- excerpt -->
									<div class="excerpt">
										<h6><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h6>
									</div>
									<!-- .excerpt -->
									<?php
									$cause_meta = get_post_meta( get_the_ID() );
									$has = !empty( $cause_meta['gorising_has'] ) ? $cause_meta['gorising_has'][0] : 0;
									$required = !empty( $cause_meta['gorising_required'] ) ? $cause_meta['gorising_required'][0] : 0;
									$unit = !empty( $cause_meta['gorising_unit'] ) ? $cause_meta['gorising_unit'][0] : '$';
									$front_back = !empty( $cause_meta['gorising_front_back'] ) ? $cause_meta['gorising_front_back'][0] : 'front';
									?>
                                    <!-- rised bar -->
                                    <div class="slider-content">
                                        <input class="rised" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="<?php echo $required; ?>" data-slider-step="1" data-slider-enabled="false" data-slider-value="<?php echo $has; ?>" />
                                    </div>
                                    <!-- .rised bar -->

                                    <!-- rised slider meta -->
                                    <div class="slider-meta clearfix">
                                        <span class="pull-left">
                                            <?php 
                                                echo $front_back == 'front' ? $unit : '';
                                                echo number_format( $has, 2, ",", "." );
                                                echo $front_back == 'back' ? $unit : '';
                                            ?>
                                        </span>
                                        <span class="pull-right">
                                            <?php 
                                                echo $front_back == 'front' ? $unit : '';
                                                echo number_format( $required, 2, ",", "." );
                                                echo $front_back == 'back' ? $unit : '';
                                            ?>                                        	
                                        </span>
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