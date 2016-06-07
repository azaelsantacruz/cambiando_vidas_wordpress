<?php

class PT_Urgent_Causes extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-folder"></span>';
	public $name = 'Urgent Causes';
	public $description = 'Add block of urgent causes to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'title' => '',
		'element_name' => 'Urgent Causes',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		if( $orderby == 'date' ){
			$posts = get_posts(array(
				'post_type' => 'cause',
				'post_status' => 'publish',
				'posts_per_page' => $number,
				'orderby' => $orderby ,
				'order' => $order,
				'meta_query' => array(
					array(
						'key' => 'gorising_type',
						'value' => 'raised',
						'compare' => '!='
					)
				)
			));
		}
		else{
			global $wpdb;
			$limit = '';
			if( !empty( $number ) ){
				$limit = ' LIMIT '.$number;
			}
			$res = $wpdb->get_col( "SELECT meta1.post_id AS post_ids FROM ".$wpdb->posts." LEFT JOIN ".$wpdb->postmeta." AS meta1 ON ID=meta1.post_id LEFT JOIN ".$wpdb->postmeta." AS meta2 ON meta1.post_id = meta2.post_id LEFT JOIN ".$wpdb->postmeta." AS meta3 ON meta2.post_id = meta3.post_id WHERE meta1.meta_key = 'gorising_required' AND meta2.meta_key = 'gorising_has' AND meta3.meta_key = 'gorising_type' AND meta3.meta_value != 'raised' AND post_status = 'publish' AND post_type='cause' ORDER BY meta1.meta_value - meta2.meta_value ".$order.$limit );
			$posts = get_posts( array( 'post_type' => 'cause', 'posts_per_page' => '-1', 'post__in' => $res, 'orderby' => 'post__in' ) );
		}
		$boxes = '';
		$counter = 0;
		if( !empty( $posts ) ){
			foreach( $posts as $post ){
				$post_meta = get_post_custom( $post->ID );
				$has = gorising_get_smeta( 'gorising_has', $post_meta, '0' );
				$required = gorising_get_smeta( 'gorising_required', $post_meta, '0' );
                $unit = gorising_get_smeta( 'gorising_unit', $post_meta, '' );
                $front_back = gorising_get_smeta( 'gorising_front_back', $post_meta, '' );				
				$boxes .= '
	                <!-- 1 -->
	                <div class="item '.( $counter == 0 ? 'active' : '' ).'">
	                    <div class="box-wrapper">
	                        <div class="box">

	                            <!-- urgent box -->
	                            <div class="urgent-box clearfix">

	                                <!-- .media -->
	                                <div class="media pull-left">

	                                    <!-- overlay -->
	                                    <div class="overlay-wrapper">
	                                        <div class="overlay">
	                                            <div class="overlay-content">
	                                                <div class="content-hidden">
	                                                    <p class="lead">'.__( 'SHARE THIS CAUSE', 'gorising' ).'</p>
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
	                                    	'.get_the_post_thumbnail( $post->ID, 'urgent_element', array( 'class' => 'img-responsive' ) ).'
	                                    </a>
	                                    <!-- image -->
	                                </div>
	                                <!-- .media -->

	                                <!-- content -->
	                                <div class="content-wrapper pull-right">
	                                    <div class="content">

	                                        <!-- cause meta -->
	                                        <div class="meta clearfix">
	                                            '.gorising_the_taxonomies( 'cause_cat', $post->ID ).'
	                                            <a class="pull-right share-trigger" data-rel="tooltip" data-target="'.( has_post_thumbnail( $post->ID )  ? 'overlay' : 'modal' ).'" title="'.esc_attr__( 'Share Cause', 'gorising' ).'" href="javascript:;"><i class="fa fa-share-alt"></i></a>
	                                        </div>
	                                        <!-- .cause meta -->

	                                        <!-- excerpt -->
	                                        <div class="excerpt">
	                                            <h5><a href="'.get_the_permalink( $post->ID ).'">'.$post->post_title.'</a>
	                                            </h5>
	                                            <p>'.$post->post_excerpt.'</p>
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

	                                        <!-- donate button -->
	                                        <div class="urgent-donate">
	                                            <a class="button-normal full blue" href="'.gorising_donate_link( $post->ID ).'">'.__( 'DONATE', 'gorising' ).'</a>
	                                        </div>
	                                        <!-- .donate button -->

	                                    </div>
	                                </div>
	                                <!-- .content -->

	                            </div>
	                            <!-- .urgent box -->

	                        </div>
	                    </div>
	                </div>
	                <!-- .1 -->
				';
				$counter++;
			}
			wp_reset_query();
		}

		$navs = '';
		if( sizeof( $posts ) > 1 ){
			$navs = '
                <!-- carousel slide -->
                <div class="carousel-control carousel-control-heading">
                    <a class="carousel-control left" href="#urgentCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-control right" href="#urgentCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a> 
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
		        <div id="urgentCarousel" class="carousel normal slide" data-ride="carousel" data-interval="false">
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
				'id' => 'order',
				'title' => __( 'Sort', 'gorising' ),
				'desc' => __( 'Select sort order.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'ASC' => __( 'Ascending', 'gorising' ),
					'DESC' => __( 'Descending', 'gorising' )
				),
				'value' => $order
			),
			array(
				'id' => 'orderby',
				'title' => __( 'Sort By', 'gorising' ),
				'desc' => __( 'Select how to sort urgent causes.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'date' => __( 'Date', 'gorising' ),
					'urgency' => __( 'Urgency', 'gorising' )
				),
				'value' => $orderby
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

new PT_Urgent_Causes();

?>