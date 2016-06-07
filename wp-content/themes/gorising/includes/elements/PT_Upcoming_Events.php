<?php

class PT_Upcoming_Events extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-clock-o"></span>';
	public $name = 'Upcoming Events';
	public $description = 'Add block of upcomning events to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'title' => '',
		'element_name' => 'Upcoming Events',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$posts = get_posts(array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => $number,
			'suppress_filters' => '0',
			'meta_key' => 'start_date',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'meta_query' => array(
				array(
					'key' => 'start_date',
					'value' => time(),
					'compare' => '>'
				)
			)
		));

		$boxes = '';
		if( !empty( $posts ) ){
			$counter = 0;
			for( $i=0; $i<sizeof( $posts ); $i++ ){
				$post = $posts[$i];
				$post_meta = get_post_custom( $post->ID );
				$gmap_link = gorising_get_smeta( 'gmap_link', $post_meta, '' );
				$address = gorising_get_smeta( 'address', $post_meta, '' );
				$start_date = gorising_get_smeta( 'start_date', $post_meta, '' );
				$boxes .= '
                    <!-- 1 -->
                    <div class="item '.( $counter == 0 ? 'active' : '' ).'">
                        <div class="row">

                            <!-- post -->
                            <div class="col-md-12">
                                <div class="box-wrapper">
                                    <div class="box">
                                        <div class="latest-box">

                                            <!-- content -->
                                            <div class="content-wrapper">
                                                <div class="content">

                                                    <!-- cause meta -->
                                                    <div class="meta clearfix">
                                                        <a class="pull-left" href="'.get_the_permalink( $post->ID ).'">'.date_i18n( 'j M Y', $start_date ).' '.__( 'at', 'gorising' ).' '.date_i18n( 'H:i', $start_date ).'</a>
                                                        <a class="pull-right cart" data-rel="tooltip" title="'.esc_attr__( 'All Events', 'gorising' ).'" href="'.gorising_get_permalink_by_tpl( 'page-tpl_event_listing' ).'"><i class="fa fa-map-marker"></i></a>
                                                    </div>
                                                    <!-- .cause meta -->

                                                    <!-- excerpt -->
                                                    <div class="excerpt">
                                                        <h6><a href="'.get_the_permalink( $post->ID ).'">'.$post->post_title.'</a>
                                                        </h6>

                                                    </div>
                                                    <!-- .excerpt -->

                                                </div>
                                            </div>
                                            <!-- .content -->

                                            <!-- .media -->
                                            <div class="media">
                                                <div class="embed-container">
                                                    <iframe class="map" src="'.$gmap_link.'"></iframe>
                                                </div>
                                            </div>
                                            <!-- .media -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .post -->

                        </div>
                    </div>
                    <!-- .1 -->
				';

				$counter++;
			}
		}
		wp_reset_query();

		$navs = '';
		if( sizeof( $posts ) > 1 ){
			$navs = '
                <!-- carousel slide -->
                <div class="carousel-control carousel-control-heading">
                    <a class="carousel-control left" href="#eventsCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="carousel-control right" href="#eventsCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a> 
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
		        <div id="eventsCarousel" class="carousel normal slide" data-ride="carousel" data-interval="false">
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
				'title' => __( 'Number Of Upcoming Events', 'gorising' ),
				'desc' => __( 'Input how many upcoming events to display.', 'gorising' ),
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

new PT_Upcoming_Events();

?>