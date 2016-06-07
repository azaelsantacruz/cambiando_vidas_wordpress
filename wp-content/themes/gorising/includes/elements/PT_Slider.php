<?php

class PT_Slider extends PT_Shortcode{
	
	public $icon = '<span class="fa fa-camera"></span>';
	public $name = 'Slider';
	public $description = 'Add image slider element to the page';
	public $category = 'Gorising';
	public $default_options = array(
		'images' => '',
		'delay' => 5000,
		'navigation' => 'yes',
		'arrows' => 'yes',
		'element_name' => 'Slider',
		'overlay' => 'yes',
		'opacity' => '',
		'extra_class' => ''
	);	

	function __construct(){
		parent::__construct();
	}
	

	public function shortcode_frontend( $atts, $content ){
		extract( shortcode_atts( $this->default_options, $atts ) );

		$random_string = pt_random_string();
		$content = explode( '/next/', $content );
		$html = '';		
		if( !empty( $images ) ){
			$image_ids = explode( ",", $images );
			$slides = '';
			$indicators = '';
			for( $i=0; $i<sizeof( $image_ids ); $i++ ){
				$image_id = $image_ids[$i];
				$image_data = wp_get_attachment_image_src( $image_id, 'full' );
				if( !empty( $image_data ) ){
					$image_post = get_post( $image_id );
					$indicators .= '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="'.( $i == 0 ? 'active' : '' ).'"></li>';
					$slides .= '<div class="item '.( $i == 0 ? 'active' : '' ).'">
                            		<img src="'.$image_data[0].'">
				                    <div class="carousel-caption">
				                        <div class="carousel-content-wrapper">
				                            <div class="carousel-content slide-content">
				                                '.( !empty( $content[$i] ) ? $content[$i] : '' ).'
				                            </div>
				                        </div>
				                    </div>                          		
                        		</div>';
				}
			} 
			
			$style = '';
			if( !empty( $overlay ) || !empty( $opacity ) ){
				$style = '
					<style>
						.'.$random_string.'.carousel{
							'.( $overlay == 'no' ? 'background: none;' : '' ).'
						}
						
						.'.$random_string.'.carousel img{
							'.( !empty( $opacity ) ? 'opacity: '.$opacity.';' : '' ).'
						}
					</style>
				';
			}
			
			$html = '<aside>'.$style.'<div id="myCarousel" class="carousel slide '.$extra_class.' '.$random_string.' gorising_slider" data-ride="carousel" data-interval="'.$delay.'" data-opacity="'.$opacity.'">';
			if( $navigation == 'yes' ){
				$html .= '<ol class="carousel-indicators">'.$indicators.'</ol>';
			}
			$html .= '<div class="carousel-inner">'.$slides.'</div>'; 
			if( $arrows == 'yes' ){
				$html .= '
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
				';
			}
			$html .= '</div></aside>';
		}

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
				'id' => 'images',
				'title' => __( 'Select Imagess', 'gorising' ),
				'desc' => __( 'Select images you want to add to the slider.', 'gorising' ),
				'type' => 'images',
				'value' => $images
			),
			array(
				'id' => 'pt_content',
				'title' => __( 'Image Captions', 'gorising' ),
				'desc' => __( 'Add image captions separated with the /next/.', 'gorising' ),
				'type' => 'editor',
				'value' => $atts['pt_content']
			),	
			array(
				'id' => 'delay',
				'title' => __( 'Delay', 'gorising' ),
				'desc' => __( 'Set delay between the slides in miliseconds. If the value is 0 than it will not autoplay.', 'gorising' ),
				'type' => 'textfield',
				'value' => $delay
			),
			array(
				'id' => 'navigation',
				'title' => __( 'Show Navigation', 'gorising' ),
				'desc' => __( 'Show or hide navigation bullets.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'yes' => __( 'Yes', 'gorising' ),
					'no' => __( 'No', 'gorising' )
				),
				'value' => $navigation
			),
			array(
				'id' => 'arrows',
				'title' => __( 'Show Arrows', 'gorising' ),
				'desc' => __( 'Show or hide navigation arrows.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'yes' => __( 'Yes', 'gorising' ),
					'no' => __( 'No', 'gorising' )
				),
				'value' => $arrows
			),
			array(
				'id' => 'overlay',
				'title' => __( 'Show Overlay', 'gorising' ),
				'desc' => __( 'Show or hide overlay.', 'gorising' ),
				'type' => 'select',
				'options' => array(
					'yes' => __( 'Yes', 'gorising' ),
					'no' => __( 'No', 'gorising' )
				),
				'value' => $overlay
			),
			array(
				'id' => 'opacity',
				'title' => __( 'Opacity', 'gorising' ),
				'desc' => __( 'Set image opacity.', 'gorising' ),
				'type' => 'textfield',
				'value' => $opacity
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

new PT_Slider();

?>