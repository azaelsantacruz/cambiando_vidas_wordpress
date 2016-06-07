<?php

class PT_Team extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-bullhorn"></span>';
	public $name = 'Team Member';
	public $description = 'Add team member element on the page';
	public $category = 'Gorising';
	public $default_options = array(
		'element_name' => 'Team Member',
		'image' => '',
		'name' => '',
		'position' => '',
		'description' => '',
		'link' => '',
		'extra_class' => ''
	);	

	function __construct(){		
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		if( !empty( $image ) ){
			$image_data = wp_get_attachment_image_src( $image, 'full' );
			$image = '<a href="'.( !empty( $link ) ? $link : '' ).'"><img src="'.$image_data[0].'" class="img-responsive" title="" alt=""></a>';
		}

		$html = '
			<div class="box-wrapper">
			    <div class="box">
			        <div class="latest-box">

			            <!-- .media -->
			            <div class="media">

			                <!-- image -->
			                '.$image.'
			                <!-- image -->
			            </div>
			            <!-- .media -->

			            <!-- content -->
			            <div class="content-wrapper">
			                <div class="content">

			                    <!-- cause meta -->
			                    <div class="meta clearfix">
			                        <a class="pull-left" href="'.( !empty( $link ) ? $link : '' ).'">'.$position.'</a>
			                    </div>
			                    <!-- .cause meta -->

			                    <!-- excerpt -->
			                    <div class="excerpt">
			                        <h6><a href="'.( !empty( $link ) ? $link : '' ).'">'.$name.'</a>
			                        </h6>
			                        <p>'.$description.'</p>
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
		';

		return $html;
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
				'id' => 'image',
				'title' => __( 'Image', 'gorising' ),
				'desc' => __( 'Add team member image.', 'gorising' ),
				'type' => 'image',
				'value' => $image
			),	
			array(
				'id' => 'position',
				'title' => __( 'Position', 'gorising' ),
				'desc' => __( 'Input team member position.', 'gorising' ),
				'type' => 'textfield',
				'value' => $position
			),
			array(
				'id' => 'name',
				'title' => __( 'Name', 'gorising' ),
				'desc' => __( 'Input team member name.', 'gorising' ),
				'type' => 'textfield',
				'value' => $name
			),
			array(
				'id' => 'description',
				'title' => __( 'Description', 'gorising' ),
				'desc' => __( 'Input team member description.', 'gorising' ),
				'type' => 'textarea',
				'value' => $description
			),
			array(
				'id' => 'link',
				'title' => __( 'Link', 'gorising' ),
				'desc' => __( 'Input team member link.', 'gorising' ),
				'type' => 'textfield',
				'value' => $link
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

new PT_Team();

?>