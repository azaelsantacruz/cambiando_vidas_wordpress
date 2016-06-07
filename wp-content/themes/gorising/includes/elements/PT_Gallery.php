<?php

class PT_Gallery extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-file-picture-o"></span>';
	public $name = 'Gallery';
	public $description = 'Add block of galleries to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'number' => '',
		'selected' => '',
		'title' => '',
		'element_name' => 'Gallery',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$args = array(
			'post_type' => 'gallery',
			'post_status' => 'publish',
			'posts_per_page' => $number,
		);
		if( !empty( $selected ) ){
			$args['posts_per_page'] = '-1';
			$args['post__in'] = explode( ",", $selected );
		}

		$posts = get_posts( $args );


		$boxes = '';
		if( !empty( $posts ) ){
			$counter = 0;
			for( $i=0; $i<sizeof( $posts ); $i++ ){
				$post = $posts[$i];
            	$gallery_meta = get_post_meta( $post->ID );                        	
            	$gallery_el = gorising_get_smeta( 'video', $gallery_meta, '' );
            	if( empty( $gallery_el ) ){
            		if( has_post_thumbnail( $post->ID ) ){
            			$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
            			$gallery_el = $image_data[0];
            		}
            	}
				$boxes .= '
                    <!-- 1 -->
                    <div class="col-md-4 col-xs-6">
                        <div class="box-wrapper">
                            <div class="box">
                                <div class="media">
                                    <a href="'.$gallery_el.'" data-toggle="lightbox" data-title="'.$post->post_title.'" data-gallery="multiimages">
                                    	'.get_the_post_thumbnail( $post->ID, 'gallery' ).'
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 1 -->
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

                <div class="border">
                    <div class="border-inner">
                    </div>
                </div>

            </div>
            <!-- .heading -->		
            <!-- gallery wrapper -->
            <div class="row">
                <div class="col-md-12">
                    <!-- a -->
                    <div class="row gallery">
		            	'.$boxes.'
		            </div>
		        </div>
		    </div>
		';
	}

	public function get_galleries(){
		$posts = get_posts(array(
			'posts_per_page' => '-1',
			'post_type' => 'gallery',
			'post_status' => 'publish'
		));
		$galleries = array();
		if( !empty( $posts ) ){
			foreach( $posts as $post ){
				$galleries[$post->ID] = $post->post_title;
			}
		}

		return $galleries;
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
				'title' => __( 'Number Of Images', 'gorising' ),
				'desc' => __( 'Input how many images to display.', 'gorising' ),
				'type' => 'textfield',
				'value' => $number
			),
			array(
				'id' => 'title',
				'title' => __( 'Title', 'gorising' ),
				'desc' => __( 'Input element title.', 'gorising' ),
				'type' => 'textfield',
				'value' => $title
			),
			array(
				'id' => 'selected',
				'title' => __( 'Select Images', 'gorising' ),
				'desc' => __( 'Select which images to display (it will override the number of images to show).', 'gorising' ),
				'type' => 'multiple',
				'options' => $this->get_galleries(),
				'value' => $selected
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

new PT_Gallery();

?>