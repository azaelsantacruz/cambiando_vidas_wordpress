<?php

class PT_Latest_Causes extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-folder-open"></span>';
	public $name = 'Latest Causes';
	public $description = 'Add block of latest causes to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'title' => '',
		'element_name' => 'Latest Causes',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$posts = get_posts(array(
			'post_type' => 'cause',
			'post_status' => 'publish',
			'posts_per_page' => $number,
			'meta_query' => array(
				array(
					'key' => 'gorising_type',
					'value' => 'raised',
					'compare' => '!='
				)
			)
		));

		$boxes = '';
		$counter = 0;
		if( !empty( $posts ) ){
			$boxes = '
                <div class="item active">
                    <div class="row">
			';
			$counter = 0;
			for( $i=0; $i<sizeof( $posts ); $i++ ){
				$post = $posts[$i];
				$post_meta = get_post_custom( $post->ID );
				$has = gorising_get_smeta( 'gorising_has', $post_meta, '0' );
				$required = gorising_get_smeta( 'gorising_required', $post_meta, '0' );
                $unit = gorising_get_smeta( 'gorising_unit', $post_meta, '' );
                $front_back = gorising_get_smeta( 'gorising_front_back', $post_meta, '' );
                if( $counter == 4 ){
                	$boxes .= '
                			</div>
                		</div>
		                <div class="item">
		                    <div class="row">
                	';
                	$counter = 0;
                }
                $counter++;
				$boxes .= '
                    <!-- a -->
                    <div class="col-md-3">
                        <div class="box-wrapper">
                            <div class="box">
                                <div class="latest-box">

                                    <!-- .media -->
                                    <div class="media">

                                        <!-- overlay -->
                                        <div class="overlay-wrapper">
                                            <div class="overlay">
                                                <div class="overlay-content">
                                                    <div class="content-hidden">
                                                        <p>'.__( 'SHARE THIS CAUSE', 'gorising' ).'</p>
                                                        <ul class="list-inline list-unstyled">
															<li>
																<a href="https://www.facebook.com/sharer/sharer.php?u='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-facebook-square"></i></a>
															</li>
															<li>
																<a href="http://twitter.com/intent/tweet?text='.get_bloginfo( 'name' ).'&amp;url='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-twitter-square"></i></a>
															</li>
															<li>
																<a href="https://plus.google.com/share?url='.rawurlencode( get_the_permalink( $post->ID ) ).'"><i class="fa fa-google-plus-square"></i></a>
															</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- .overlay -->

	                                    <!-- image -->
	                                    <a href="'.get_the_permalink( $post->ID ).'">
	                                    	'.get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'class' => 'img-responsive' ) ).'
	                                    </a>
	                                    <!-- image -->
                                    </div>
                                    <!-- .media -->

                                    <!-- content -->
                                    <div class="content-wrapper">
                                        <div class="content">

                                            <!-- cause meta -->
                                            <div class="meta clearfix">
                                                '.gorising_the_taxonomies( 'cause_cat', $post->ID ).'
                                                <a class="pull-right share-trigger" data-rel="tooltip" data-target="'.( has_post_thumbnail( $post->ID )  ? 'overlay' : 'modal' ).'" title="'.esc_attr__( 'Share Cause', 'gorising' ).'" href="javascript:;"><i class="fa fa-share-alt"></i>
                                            </div>
                                            <!-- .cause meta -->

                                            <!-- excerpt -->
                                            <div class="excerpt">
                                                <h6><a href="'.get_the_permalink( $post->ID ).'">'.$post->post_title.'</a>
                                                </h6>

                                            </div>
                                            <!-- .excerpt -->

                                            <!-- rised bar -->
                                            <div class="slider-content">
                                                <input class="rised" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="'.$required.'" data-slider-step="1" data-slider-enabled="false" data-slider-value="'.$has.'" />
                                            </div>
                                            <!-- .rised bar -->

                                            <!-- rised slider meta -->
                                            <div class="slider-meta clearfix">
                                                <span class="pull-left">'.gorising_format_number( $has, $front_back, $unit, false ).'</span>
                                                <span class="pull-right">'.gorising_format_number( $required, $front_back, $unit, false ).'</span>
                                            </div>
                                            <!-- .rised slider meta -->


                                        </div>
                                    </div>
                                    <!-- .content -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .a -->
				';
			}
			$boxes .='
        				</div>
        			</div>
        		';
        	wp_reset_query();
		}

		$navs = '';
		if( sizeof( $posts ) > 4 ){
			$navs = '
                <!-- carousel slide -->
                <div class="carousel-control carousel-control-heading">
                    <a class="carousel-control left" href="#latestCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-control right" href="#latestCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a> 
                </div>
			';
		}

		return '
            <!-- heading -->
            <div class="heading">

                <!-- title -->
                <h3>'.$title.'</h3>
                <!-- .title -->

                '.$navs.'

                <div class="border">
                    <div class="border-inner">
                    </div>
                </div>
                <!-- .carousel slide -->

            </div>
            <!-- .heading -->		
		    <div class="carousel-cause">
		        <div id="latestCarousel" class="carousel normal slide" data-ride="carousel" data-interval="false">
		            <div class="carousel-inner">
		            	'.$boxes.'
		            </div>
		        </div>
		    </div>
		';
	}

	public function shortcode_options( $atts ){
		extract( shortcode_atts( $this->default_options, $atts ) );
		$options = array(
			array(
				'id' => 'element_name',
				'title' => __( 'Element Name', 'gorising' ),
				'desc' => __( 'Input custom element name for easy recognition.', 'gorising' ),
				'type' => 'textfield',
				'value' => $element_name
			),
			array(
				'id' => 'number',
				'title' => __( 'Number Of Urgent Causes', 'gorising' ),
				'desc' => __( 'Input how many urgent causes to display.', 'gorising' ),
				'type' => 'textfield',
				'value' => $number
			),
			array(
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Input box title.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
			),			
			array(
				'id' => 'extra_class',
				'title' => __( 'Extra Class', 'gorising' ),
				'desc' => __( 'Input extra class for the element.', 'gorising' ),
				'type' => 'textfield',
				'value' => $extra_class
			),
		);
		
		$options_html = new PT_Options( $options );
		
		return $options_html->get_options();
	}	
}

new PT_Latest_Causes();

?>